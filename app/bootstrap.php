<?php
declare(strict_types=1);

// Negotiate compressed HTML/XML even on shared hosts without mod_deflate.
if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) ini_set('zlib.output_compression', '1');

require dirname(__DIR__) . '/vendor/autoload.php';
if (is_file(dirname(__DIR__) . '/.env')) {
    foreach (file(dirname(__DIR__) . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) continue;
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim(trim($value), "\"'");
    }
}
function e(mixed $value): string { return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function env(string $key, string $fallback = ''): string { return (string)($_ENV[$key] ?? getenv($key) ?: $fallback); }
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/.');
$siteUrl = rtrim(env('SITE_URL', 'https://webostics.com'), '/');
$host = strtolower(explode(':', $_SERVER['HTTP_HOST'] ?? 'localhost')[0]);
$isProduction = $host === parse_url($siteUrl, PHP_URL_HOST);
function url(string $path = ''): string { global $basePath; return $basePath . '/' . ltrim($path, '/'); }
function canonical(string $path = ''): string { global $siteUrl; return $siteUrl . ($path === '' ? '/' : '/' . ltrim($path, '/')); }
function asset(string $path): string { return url($path) . '?v=' . filemtime(dirname(__DIR__) . '/' . $path); }
function posted(string $name, string $fallback = ''): string { return is_string($_POST[$name] ?? null) ? trim($_POST[$name]) : $fallback; }
$contactEmail = 'dev.saadahmad@gmail.com';
$linkedin = 'https://www.linkedin.com/in/saadidk';
$requestPath = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/');
$route = trim(substr($requestPath, strlen($basePath)), '/');
if ($route === 'index.php') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') { header('Location: ' . url(), true, 301); exit; }
    $route = 'contact';
}
if (!$isProduction) header('X-Robots-Tag: noindex, nofollow');
require __DIR__ . '/content.php';
