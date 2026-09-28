# Webostics upgrade: audit and step-by-step checklist

## Audit — 27 September 2026

The working URL is http://localhost/portfolio/. The project is plain PHP, Composer/PHPMailer 7, one 1,186-line index.php, one stylesheet and one JavaScript file. Apache/XAMPP serves it successfully. No Git repository or existing routing configuration was found. SMTP and reCAPTCHA settings live in .env; preserve that file and never expose it. The only supplied image is a 436 KB personal portrait. No Webostics logo is supplied. Existing public contacts are dev.saadahmad@gmail.com and linkedin.com/in/saadidk. The production Webostics site could not be fetched during the audit, so its indexed URLs and contact information cannot be verified here.

The current identity is Saad Ahmad, not Webostics. Portfolio entries and testimonials exist but their attribution to Webostics and permission to publish cannot be established from code. Preserve them privately pending confirmation. No course content, instructors, pricing, reviews, or learning backend exists. Do not imply enrollment is open.

Problems: one page serves every intent; no canonical, sitemap, or robots file; social image points to a missing file; third-party Google Fonts and Font Awesome block styling; reCAPTCHA loads on every visit; continuous typing/counter effects; scroll handlers; mixed UI and mail logic; no CSRF protection or request bounds. Existing skip link, form labels, SMTP integration, honeypot and reCAPTCHA verification can be retained/improved.

## Architecture and design

Keep PHP for shared-host compatibility, with an Apache front controller and subdirectory-aware links. Separate configuration, content data, mail handling, components and templates. No framework, database, build step or frontend library is required.

Design: warm off-white canvas, deep forest-green panels, lime accents, dark ink, generous spacing, system sans typography and monospace code details. Consistent tokens, accessible focus rings, editorial headings, restrained borders, and CSS-built developer visuals. Native HTML works without animation or JavaScript.

Homepage order: hero → technologies → business/learner paths → services → planned courses → learning roadmap → AI → deployment → project availability → practical approach → split CTA. Preserve old section anchors where practical.

Sitemap: /, /services and service details, /courses and category/course details, /ai, /devops, /projects, /resources and practical guides, /about, /contact, /privacy. Planned course outlines remain noindex until lessons and enrollment are available. Projects has an honest empty state until work is verified.

## Implementation checklist

- [x] 1. Audit code, running local URL, assets, identity and existing mail integration.
- [x] 2. Back up original entry point, CSS and JS in server-protected storage/original.
- [x] 3. Define design system, routing, sitemap and reusable components.
- [x] 4. Establish the homepage and responsive visual system.
- [x] 5. Build services and focused service detail pages.
- [x] 6. Build course catalog, filters, categories and honest planned outlines.
- [x] 7. Build AI and DevOps hubs, resources, about and project structure.
- [x] 8. Implement separate service/course/general inquiries using existing mail configuration.
- [x] 9. Add metadata, canonicals, breadcrumbs, structured data, sitemap and robots.
- [x] 10. Optimize CSS/JS, caching, compression, fonts, mobile layouts and accessibility.
- [x] 11. Check PHP syntax, routes, internal links, metadata, forms and responsive layouts.
- [x] 12. Document deployment and remaining content/production checks.

## Migration and SEO preservation

Work locally; no production publishing. Keep .env and Composer dependency intact. Original files are backed up outside public access through Apache rules. Preserve home anchors for services, work, process, results and contact. Redirect index.php to the homepage only for GET requests, leaving POST compatibility. Before production replacement, export the old site's indexed URLs/Search Console data and map each meaningful URL to its closest replacement with 301 redirects. Do not redirect every unknown URL to home. Unknown routes return 404. Canonicals use the configured production origin; local pages are noindex. Confirm business contact data, portfolio permissions and course availability before launch.

## Performance and release checks

Use system fonts and small local CSS/JS, SVG/CSS visuals, no hero raster download, and load reCAPTCHA only on form interaction. Conditional form script; explicit image dimensions and lazy loading when photos are added. Apache compression and asset cache headers. Test at 320, 375, 430, 768, 1024 and 1440 px. Core Web Vitals require a production measurement; do not claim a score from code inspection. Run a real delivery test with approval/configured domain before launch; automated checks must not send email.

## Still required before production launch

- [x] Confirm attribution and publication permission; restore 16 projects attributed to Saad Ahmad (28 September 2026).
- [ ] Add approved project screenshots and verified case-study outcomes.
- [ ] Finalize course materials, instructors, availability and any pricing before opening enrollment.
- [ ] Inventory existing production URLs and approve explicit migration redirects.
- [ ] Verify real SMTP delivery and reCAPTCHA authorization on the final hostname. Local tests found Avast TLS interception and reCAPTCHA rejection of the automated browser; see LEARNING-AND-MAIL.md.
- [ ] Run production speed/accessibility checks and review real Core Web Vitals.

See DEPLOYMENT.md for the release sequence and validation evidence. The local implementation is complete; no production deployment has been performed.

## Portfolio continuation - 28 September 2026

Completed: approved original project records, platform filtering without JavaScript, homepage features, Projects navigation, and portfolio SEO. See PORTFOLIO.md for editorial details.

## Learning and launch continuation — 28 September 2026

- [x] Add a real free HTML lesson with a sandboxed editor, download, practice tasks and self-check questions.
- [x] Add three current-site WebP screenshots with capture dates and attribution.
- [x] Test local mail transport and the real browser inquiry flow; record the unresolved Avast TLS/reCAPTCHA blockers.
- [x] Validate 56 pages with 489 passing checks.
- [ ] Resolve local mail trust or test SMTP on the production host, then confirm inbox receipt.

See LEARNING-AND-MAIL.md for exact findings and the remaining release checks.
