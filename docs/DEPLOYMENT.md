# Webostics: maintenance and release notes

## Local preview

Open http://localhost/portfolio/ with Apache and PHP running. No Node build, database or new Composer package is needed for the website. PHP 8.0+ is required (tested on XAMPP PHP 8.2). Keep the existing vendor directory or install the locked Composer dependencies on your host. Apache must permit .htaccess and enable mod_rewrite and authorization directives. Do not deploy the site on a server that exposes app, storage, docs, vendor or .env.

## Files and architecture

- `index.php`: front controller, route dispatch, sitemap, robots and structured data.
- `app/bootstrap.php`: environment loading, URL helpers and host detection.
- `app/content.php`: services, categories, planned course records, projects, resources and page metadata.
- `app/components.php`: reusable icons, cards, CTAs, FAQs and page headings.
- `app/views/`: shared header/footer, homepage, page templates and inquiry form.
- `app/contact.php`, `app/recaptcha.php`: server validation, CSRF, rate limiting, spam verification and PHPMailer delivery.
- `css/style.css`: design tokens, components and responsive layouts.
- `js/script.js`: progressive mobile navigation and course filters.
- `js/contact.js`: conditional form fields and reCAPTCHA loaded on form interaction.
- `assets/site/`: SVG brand mark and a 1200 × 630 social sharing image. No externally hosted fonts or icon library.
- `storage/original/`: original entry point, stylesheet and script, retained for rollback/reference. Never publish these backups without the access rules.

Course records deliberately contain null duration, lessons, price and instructor values, with empty reviews. Add confirmed facts when available. Authentication, checkout, enrollment, lessons, reviews and progress are not implemented. Do not enable those calls to action until the corresponding backend exists. The project collection contains 16 original portfolio entries approved by the user on 28 September 2026, attributed to Saad Ahmad. Data lives in app/data/projects.json; add only verified records and approved images. See PORTFOLIO.md. Use WebP/AVIF, include source dimensions, and extend responsive image variants when real project images are supplied.

## Step-by-step production release checklist

1. Confirm the public origin and set `SITE_URL=https://webostics.com` in the host's environment or existing .env. Match the actual canonical host exactly (www versus non-www); redirect the alternate host using your hosting configuration. A different hostname is automatically noindex. For a subdirectory deployment, include that path in SITE_URL.
2. Confirm the retained email address and personal LinkedIn are the desired public contact details. The user approved retaining both for this local upgrade. Change their central values in app/bootstrap.php when needed.
3. Preserve existing SMTP credentials and receiver configuration. Supported keys remain SMTP_HOST, SMTP_PORT, SMTP_USERNAME, SMTP_PASSWORD, SMTP_FROM_EMAIL, SMTP_FROM_NAME, CONTACT_RECEIVER_EMAIL and CONTACT_RECEIVER_NAME. Set SMTP_FROM_NAME to Webostics if the old personal sender label is no longer wanted. Never commit or expose real values.
4. Confirm reCAPTCHA v3 domain authorization for the production hostname. Preserve RECAPTCHA_SITE_KEY, RECAPTCHA_SECRET_KEY, RECAPTCHA_ACTION and RECAPTCHA_MIN_SCORE. The default action is contact_submit. RECAPTCHA_HOSTNAME can explicitly set the expected verification hostname; otherwise the request host is used. The server requires a matching action/hostname and a qualifying numeric score.
5. The user will test mail on the live site. Test one service inquiry, one course inquiry and one general inquiry there; confirm receipt and Reply-To behavior. Local SMTP tests were blocked by Avast TLS interception before authentication. See MAIL-READINESS.md. Default trust comes from the live host; SMTP_CA_FILE is an optional explicit override, not a required setting.
6. Export the existing live URL inventory/Search Console sitemap and create explicit 301 redirects for any replaced pages. The public Webostics site was not accessible to the audit, so this migration map is still required. The supplied local project had only index.php plus section anchors; those homepage anchors are preserved. Old POST payloads should be refreshed to the new CSRF-protected form.
7. Upload application files and dependencies, including .htaccess. Keep storage and docs out of the release package if they are not needed. Leave .env outside version control. Verify that requests for .env, app, vendor and storage return 403.
8. Enable Apache mod_deflate and mod_expires on the host for static compression and expiry handling. Local XAMPP has neither active, so HTML/XML compression uses PHP zlib and static Cache-Control uses mod_headers. The local CSS/JS are already small. Do not mistake configured optional modules for verified active modules.
9. Visit /robots.txt and /sitemap.xml on the final origin. Production robots allows crawling and points at the sitemap; noncanonical/staging hosts block crawling. Planned course/category pages are excluded from the sitemap and noindex. The approved project gallery is included in the sitemap; its filtered query views remain noindex with a canonical to the main gallery. Remove those exclusions only when substantive confirmed content is available. Service pages and the four resource guides are indexable on the configured origin.
10. Check canonical URLs, social image delivery, HTTPS, redirects, mobile navigation and all inquiry types on the live host. Run Lighthouse/PageSpeed and collect Core Web Vitals from actual traffic; no production performance score has been claimed here.
11. Review the privacy description against your actual hosting/email retention and business practices before launch. Update it if analytics, payments, accounts or new providers are added.

## Validation completed locally

- All PHP files passed PHP 8.2 syntax checks; both browser JavaScript files passed Node syntax checks.
- Chrome automation crawled 55 pages and checked unique titles, canonical tags, one H1, successful responses, no PHP warnings and local noindex headers.
- Fifteen representative page/layout types were tested for horizontal overflow at 320, 375, 430, 768, 1024 and 1440 px.
- Mobile menu open/Escape/focus return, no-JavaScript content/navigation, AI course filtering, empty search state and conditional inquiry fields passed.
- Invalid CSRF and invalid input return 422; private files return 403; missing routes return 404; index.php GET returns 301.
- reCAPTCHA is absent before form interaction. Browser reported no JavaScript exceptions.
- HTML gzip and static Cache-Control were verified in local response headers. Main CSS is approximately 29 KB and global JS approximately 2.2 KB uncompressed. Contact JS loads only on pages with forms. Social image is approximately 47 KB and is not downloaded by normal page rendering.
- Results: storage/verification.json; screenshots: storage/home-desktop.png and storage/home-mobile.png. Portfolio-specific screenshots are storage/projects-375.png and storage/projects-1440.png. The browser harness is storage/check-site.mjs and uses a separate hidden Chrome profile on debugging port 9223.

Automated coverage is not a complete accessibility audit, a delivery test, production load testing, or field Core Web Vitals. Planned content and release checks above are deliberately separated from implemented local functionality.

## Rollback

Restore index.php, css/style.css and js/script.js from storage/original. Disable the new front-controller rewrite rules if restoring the old single-page site. Keep .env and vendor intact. New app/assets files can remain unused until a deliberate cleanup; do not expose backup directories.
