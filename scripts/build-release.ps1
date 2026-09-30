param([string]$PhpExecutable = 'php')

$ErrorActionPreference = 'Stop'
$repoRoot = [System.IO.Path]::GetFullPath((Join-Path $PSScriptRoot '..'))
$releaseRoot = Join-Path $repoRoot 'storage/releases'
$requiredFiles = @('index.php', '.htaccess', '.env.example', 'composer.json', 'composer.lock')
$runtimeDirectories = @('app', 'assets', 'css', 'js', 'vendor')

foreach ($relativeFile in $requiredFiles) {
    if (-not (Test-Path -LiteralPath (Join-Path $repoRoot $relativeFile) -PathType Leaf)) {
        throw "Required release file missing: $relativeFile"
    }
}
foreach ($relativeDirectory in $runtimeDirectories) {
    if (-not (Test-Path -LiteralPath (Join-Path $repoRoot $relativeDirectory) -PathType Container)) {
        throw "Required directory missing: $relativeDirectory. Run composer install first."
    }
}
if (-not (Test-Path -LiteralPath (Join-Path $repoRoot 'vendor/autoload.php'))) {
    throw 'Composer autoload files are missing. Run composer install first.'
}

$lock = Get-Content -LiteralPath (Join-Path $repoRoot 'composer.lock') -Raw | ConvertFrom-Json
$installed = Get-Content -LiteralPath (Join-Path $repoRoot 'vendor/composer/installed.json') -Raw | ConvertFrom-Json
$lockedMailer = @($lock.packages | Where-Object { $_.name -eq 'phpmailer/phpmailer' })
$installedMailer = @($installed.packages | Where-Object { $_.name -eq 'phpmailer/phpmailer' })
if ($lockedMailer.Count -ne 1 -or $installedMailer.Count -ne 1 -or $lockedMailer[0].version -ne $installedMailer[0].version) {
    throw 'Installed PHPMailer does not match composer.lock. Run composer install first.'
}

$phpFiles = @((Get-Item -LiteralPath (Join-Path $repoRoot 'index.php')))
$phpFiles += @(Get-ChildItem -LiteralPath (Join-Path $repoRoot 'app') -Filter '*.php' -File -Recurse)
foreach ($phpFile in $phpFiles) {
    $lintOutput = & $PhpExecutable -l $phpFile.FullName 2>&1
    if ($LASTEXITCODE -ne 0) { throw "PHP syntax check failed for $($phpFile.Name): $lintOutput" }
}

# Use a new staging directory each time. Never delete or overwrite an existing release.
$releaseName = 'webostics-' + (Get-Date -Format 'yyyyMMdd-HHmmss') + '-' + [Guid]::NewGuid().ToString('N').Substring(0, 6)
$stagingRoot = Join-Path $releaseRoot ($releaseName + '-files')
New-Item -ItemType Directory -Path $stagingRoot -Force | Out-Null

foreach ($relativeFile in $requiredFiles) {
    Copy-Item -LiteralPath (Join-Path $repoRoot $relativeFile) -Destination (Join-Path $stagingRoot $relativeFile) -Force
}
foreach ($relativeDirectory in $runtimeDirectories) {
    $sourceDirectory = Join-Path $repoRoot $relativeDirectory
    $linkedDirectories = @(Get-ChildItem -LiteralPath $sourceDirectory -Directory -Recurse -Force | Where-Object { $_.Attributes -band [System.IO.FileAttributes]::ReparsePoint })
    if ($linkedDirectories.Count -gt 0) { throw 'Release inputs must not contain directory symlinks or junctions.' }
    foreach ($sourceFile in Get-ChildItem -LiteralPath $sourceDirectory -File -Recurse -Force) {
        if ($sourceFile.Attributes -band [System.IO.FileAttributes]::ReparsePoint) { throw 'Release inputs must not contain file symlinks.' }
        $relativePath = $sourceFile.FullName.Substring($repoRoot.Length + 1).Replace('\', '/')
        if ($relativePath -match '(^|/)(\.git|\.svn|\.hg)(/|$)' -or $relativePath -like 'app/certs/*') { continue }
        if ($sourceFile.Name -match '^\.env($|\.)|\.(log|tmp|bak|key|p12|pfx)$') { continue }
        $destination = Join-Path $stagingRoot $relativePath
        New-Item -ItemType Directory -Path (Split-Path -Parent $destination) -Force | Out-Null
        Copy-Item -LiteralPath $sourceFile.FullName -Destination $destination -Force
    }
}

# ZipFile includes the hidden .htaccess files that Compress-Archive can omit.
Add-Type -AssemblyName System.IO.Compression.FileSystem
$archivePath = Join-Path $releaseRoot ($releaseName + '.zip')
$pendingArchive = $archivePath + '.pending'
[System.IO.Compression.ZipFile]::CreateFromDirectory($stagingRoot, $pendingArchive, [System.IO.Compression.CompressionLevel]::Optimal, $false)
$archive = [System.IO.Compression.ZipFile]::OpenRead($pendingArchive)
try {
    $entries = @($archive.Entries | ForEach-Object { $_.FullName.Replace('\', '/') })
    foreach ($entry in $entries) {
        if ($entry -match '(^|/)(\.git|\.svn|\.hg)(/|$)|^(storage|docs|scripts)/|^app/certs/|(^|/)\.env$') {
            throw "Unexpected private/development path in archive: $entry"
        }
    }
    foreach ($requiredEntry in @('index.php', '.htaccess', '.env.example', 'vendor/autoload.php', 'app/data/projects.json', 'assets/learning/.htaccess')) {
        if ($entries -notcontains $requiredEntry) { throw "Archive missing required file: $requiredEntry" }
    }
} finally { $archive.Dispose() }
Move-Item -LiteralPath $pendingArchive -Destination $archivePath
$checksum = (Get-FileHash -LiteralPath $archivePath -Algorithm SHA256).Hash.ToLowerInvariant()
[System.IO.File]::WriteAllText($archivePath + '.sha256', $checksum + '  ' + [System.IO.Path]::GetFileName($archivePath) + [Environment]::NewLine)
Write-Output "Release: $archivePath"
Write-Output "Files: $($entries.Count) | PHPMailer: $($installedMailer[0].version)"
Write-Output 'Verified: private .env, Git metadata, diagnostics and backups are excluded.'
