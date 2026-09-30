# Webostics — Build. Learn. Launch.

A responsive PHP website for development services, Saad Ahmad's portfolio, practical resources and planned technology courses. Two free HTML practice lessons cover document structure and navigation, with a sandboxed editor in the first lesson and downloadable starter files for both.

## Requirements

- PHP 8.0+ with OpenSSL, ctype, filter and hash; cURL is recommended for reCAPTCHA verification.
- Apache with `mod_rewrite` and `.htaccess` overrides enabled.
- Composer to install the locked dependencies. PHPMailer is currently locked to 7.1.1.
- No database, Node build, or frontend framework is required to run the website.

## Local setup

1. Clone this repository into an Apache-served directory, such as XAMPP's `htdocs/portfolio`.
2. Run `composer install --no-dev --prefer-dist --optimize-autoloader` in the project directory. `vendor/` is intentionally excluded from Git.
3. Copy `.env.example` to `.env` **only if `.env` does not already exist**. Keep any existing credentials. Fill in SMTP, recipient and reCAPTCHA settings if you want to test inquiries.
4. Start Apache and open `http://localhost/portfolio/`. Links support both a subdirectory and a domain-root deployment.

Pages can be viewed without mail credentials. The form reports an unavailable state until required mail and reCAPTCHA values are configured. Noncanonical hosts, including localhost, are marked noindex. `SITE_URL` should contain the final public origin (and deployment subdirectory, if applicable).

## Deploy to shared hosting

### Deploy using Git

Git contains the application source and composer.lock, but not vendor/ or the private .env. After pulling the source on the live host, install the locked dependencies in the same directory as index.php:

```bash
cd /home/saadigamers/public_html
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
composer check-platform-reqs --no-dev
```

Run these dependency checks as part of each Git deployment, using a CLI PHP version compatible with the site's PHP runtime. Preserve the existing production .env. Do not use composer update as a deployment step: install uses the committed lock file.

If Composer or terminal access is unavailable, extract the complete vendor/ directory from the latest matching release ZIP into public_html/vendor/. Upload all its contents, not just autoload.php. A missing vendor/autoload.php means the dependency installation is absent or incomplete; a normal git pull does not itself delete an existing ignored vendor directory.

### Deploy using a release ZIP

You can either clone/upload the source and run Composer on the host, or prepare a ZIP locally when the host does not provide Composer:

```powershell
composer install --no-dev --prefer-dist --optimize-autoloader
powershell -NoProfile -File .\scripts\build-release.ps1
```

If your local Windows execution policy blocks this repository's script, review it first and run it with `powershell -NoProfile -ExecutionPolicy RemoteSigned -File .\scripts\build-release.ps1`. That option applies only to the new PowerShell process; it does not change your machine policy.

The script checks PHP syntax and that the installed PHPMailer version matches `composer.lock`. It creates a dated ZIP and SHA-256 checksum in `storage/releases/`. The ZIP contains `index.php`, `.htaccess`, `.env.example`, application code, website assets, CSS, JavaScript and installed Composer dependencies. It excludes your real `.env`, Git metadata, local CA bundles, backups, browser profiles, test artifacts and documentation. It does not upload or deploy anything.

1. Back up the existing live site, database if it has one, and its private configuration.
2. Extract the ZIP into the intended web directory. Ensure hidden `.htaccess` files are uploaded too.
3. Preserve or create the host's private `.env`, set the final `SITE_URL`, and configure mail/reCAPTCHA for the actual hostname. Never replace working credentials with the blank example.
4. Verify navigation, missing-page responses, sitemap, robots, HTTPS and access protection for `.env`, `app/` and `vendor/`.
5. Test service, course and general inquiries from a normal browser and confirm inbox receipt. Local mail delivery testing was deferred to the live host at the owner's request.
6. Add redirects for any replaced production URLs before switching the site. That URL inventory still needs confirmation.

The ZIP is a clean file package, not an automatic synchronization tool. It does not remove obsolete files from an existing deployment. Review old files and redirects during the migration.

## Edit content

- `app/content.php`: service copy, courses, categories, resource guides and route metadata.
- `app/data/projects.json`: project records, featured flags, screenshots and attribution.
- `app/views/`: page templates and shared layout.
- `app/components.php`: reusable cards, headings, icons, FAQs and calls to action.
- `css/`, `js/`: local styling and progressive interactions.
- `app/mailer.php`: shared SMTP configuration; real values come from the private environment.

All course outlines remain planned except the explicitly available free practice lesson. Accounts, payments, certificates and course progress are not implemented. Do not publish invented outcomes, ratings, lesson counts or instructor details.

## Project notes

- [Upgrade checklist](docs/UPGRADE-PLAN.md)
- [Deployment details](docs/DEPLOYMENT.md)
- [Mail readiness](docs/MAIL-READINESS.md)
- [Portfolio editing](docs/PORTFOLIO.md)
- [Learning and local test findings](docs/LEARNING-AND-MAIL.md)

Local validation has covered 56 pages, mobile layouts, filtering, form validation and the lesson editor. Live mail delivery, production redirects and field performance still need checks on the actual host.

## Typography and navigation

Space Grotesk is self-hosted as a 22 KB Latin variable WOFF2 in assets/fonts, with its SIL Open Font License included. It is preloaded, uses font-display: swap, and falls back to system fonts. No third-party font requests are needed. Keep the font and license when deploying.

The enhanced mobile/tablet menu is a right-side drawer up to 1100px, with scroll locking, a backdrop, keyboard focus containment, Escape/close controls and reduced-motion support. Navigation remains available without JavaScript. Small content labels and helper text use larger sizes; the Hire Webostics hover keeps white text on green.
