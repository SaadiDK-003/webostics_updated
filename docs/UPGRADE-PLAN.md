# Webostics upgrade: audit and step-by-step checklist

## Current remaining work - 30 September 2026

This section supersedes historical pending items below. Core website implementation, live mail delivery, mobile layout checks, HTTPS/www redirects and live homepage Lighthouse checks are complete.

- [ ] Upload the latest local changes when the owner is ready: Co-Museum project page and RXNICOTINE homepage link correction. Verify both after upload.
- [ ] Review old production URLs and add any necessary specific redirects; requires the old URL inventory.
- [ ] Set up Search Console and submit the sitemap when the owner is ready; monitor indexing and field Core Web Vitals as data becomes available.
- [ ] Optional portfolio expansion: obtain confirmed contributions, original-delivery screenshots and verifiable results for other projects.
- [ ] Before opening course enrollment: finish course materials and confirm instructors, availability and pricing. Current planned outlines remain noindex; two free lessons are usable now.

RXNICOTINE destination updated at the owner's request to https://rxnicotine.com/. The site is already live; the portfolio and course expansion items are ongoing content work, not blockers to keeping the current site online.

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

## Repository and release preparation — 29 September 2026

- [x] Add a credential-free .env.example without modifying the existing .env.
- [x] Replace the placeholder README with local setup, content editing and shared-host deployment instructions.
- [x] Add a repeatable ZIP builder with PHP syntax checks, locked PHPMailer version checks, private-file exclusions and a SHA-256 checksum.
- [x] Build and inspect the first deployment package; preserve hidden Apache access-control files.
- [x] Block the build-script directory from public HTTP access.
- [x] Owner confirmed the package is deployed at https://webostics.com/ and the live .env is updated (29 September 2026).
- [ ] Perform normal-browser mail tests, URL migration checks and live performance measurements.

The verified ZIP is under storage/releases (excluded from Git). It includes Composer dependencies; it excludes the real .env, project documentation, local diagnostics, Git metadata and backup files. No deployment or email sending was performed in this phase.

## Live verification — 29 September 2026

Read-only live checks passed for key pages, indexing metadata, the 28-URL sitemap, 404 handling and protected paths. A www-to-canonical redirect is prepared in the local .htaccess and must still be uploaded. The previously generated release ZIP does not contain this redirect change. See LIVE-LAUNCH-CHECK.md for results and the post-launch sequence. No email was sent during these checks.

## Browser audit and second lesson - 29 September 2026

- [x] Owner confirmed live inbox delivery and uploaded .htaccess; HTTPS www redirect verified.
- [x] Complete live Chrome tests: 299 checks across 56 pages.
- [x] Measure live homepage mobile/desktop Lighthouse; performance 100 on both.
- [x] Fix measured contrast and accessible-name issues locally; homepage accessibility now 100 locally.
- [x] Add the second usable HTML lesson with two linked downloadable files.
- [x] Validate the updated local site: 501 checks across 57 pages passed.
- [ ] Upload the latest release and recheck live accessibility and new lesson downloads.
- [ ] Verify historical URL migration and public HTTP redirects.
- [ ] Expand case studies using verified project details.
- [ ] Set up Search Console when the owner is ready.

This supersedes the earlier pending mail, www redirect and performance items above. See LIVE-LAUNCH-CHECK.md for measurements and limitations.

## Deployment follow-up - 30 September 2026

- [x] Verify updated lesson, downloadable files, stylesheet and 29-URL sitemap live.
- [x] Verify public HTTP and HTTPS www redirects preserve inner paths and query strings.
- [x] Recheck live mobile homepage: Lighthouse 100 in all four categories.
- [ ] Confirm which featured projects Saad developed in full, then add accurate project detail pages.
- [ ] Obtain old URL inventory for migration review; Search Console deferred by owner.

Co-Museum continuation completed locally: /projects/co-museum credits Saad with full website development. Verification: 507 full-site checks across 58 pages, 10 focused project checks (including six viewport widths), PHP release lint, and project Lighthouse accessibility 100. Release: storage/releases/webostics-20260930-013705-d50c9c.zip. Upload remains pending; preserve production .env. The live homepage and previous lesson update were separately verified this session.

## Mobile drawer and typography - 30 September 2026

- [x] Replace the expanding mobile menu with a fixed right-side drawer and backdrop; opening does not change header height or scroll position.
- [x] Support Escape, close button, backdrop dismissal, focus containment/restoration, background inertness, reduced motion and desktop resize cleanup.
- [x] Fix Hire Webostics hover/focus contrast with white text on a green background.
- [x] Self-host Space Grotesk (22,288-byte Latin variable WOFF2), preload it and retain its redistribution license.
- [x] Increase small content labels/help text and paragraph sizes; strengthen typography while retaining responsive layouts.
- [x] Verify 507 full-site checks across 58 pages and 12 focused font/drawer/hover checks.
- [ ] Upload this latest UI update when ready; preserve the production .env and include assets/fonts.

These are local changes. Previous live Lighthouse scores describe the earlier deployed version.

Final local mobile Lighthouse for the drawer/typography update: performance 96, accessibility 100, best practices 100; LCP 1.3 seconds, CLS 0. These are local lab measurements, not a new production score. Deployment ZIP: storage/releases/webostics-20260930-015236-c1d413.zip (246 files, excludes real .env). Desktop/mobile screenshots reviewed; font loaded from local assets.

## E-commerce platforms and confirmed skills - 30 September 2026

- Replaced JavaScript and .NET in the homepage tools strip with linked Magento 2 and BigCommerce names.
- Added /services/magento-2 and /services/bigcommerce with distinct platform explanations, service scope, inquiry forms and automatic metadata/schema/sitemap integration.
- Added Saad's self-reported strengths to About: HTML, CSS, JavaScript (particularly jQuery), PHP and Shopify Liquid. Added these technologies to the homepage topic list and jQuery to web-development tools.
- No new certifications, project results or Magento/BigCommerce project history is asserted.
- Platform references: https://business.adobe.com/products/magento/open-source.html and https://docs.bigcommerce.com/developer/docs/storefront/getting-started and https://docs.bigcommerce.com/developer/docs/storefront/stencil/content/page-builder .
- Local update; upload when ready along with the drawer, typography and previous portfolio changes.

Verification for the platform/skills update: all 531 checks passed across 60 local pages, including both new services at 320-1440px. Both inquiry forms preselect their service correctly, both canonical URLs are correct, and both pages appear in the sitemap. Release PHP syntax checks passed. Latest package: storage/releases/webostics-20260930-145816-fd8bf4.zip. No emails sent and no production deployment performed.

## Mobile application offering - 30 September 2026

- [x] Add Mobile App Development to the homepage and a dedicated service page, retaining E-Commerce Development and the separate Web Applications route.
- [x] Add the owner-confirmed School Van Tracking app with React Native, Laravel backend and Next.js to the portfolio.
- [x] Add a Mobile Apps portfolio filter and update About with the published Android work.
- [ ] Publish these local changes through the owner's Git deployment when ready. No Composer dependencies changed.
- Other locally developed apps await details from the owner; no iOS release or unknown framework claims are made.

## Pricing page - 1 October 2026

Implemented /pricing from Website_Development_Proposal_Pricing.md: six Shopify/WordPress plans, all feature rows, ten add-ons, two revision rounds, 50/50 payment terms and conditional working-day estimates. All prices are starting estimates in PKR. Quantities, precise custom work and post-handover support are confirmed in the quote; no unsupported limits or guarantees were invented. Optional Standard WooCommerce features are separately quoted.

Plan links use an allowlisted plan ID and matching service topic to prefill an editable inquiry message. The package name and starting price are sent through the existing message field; no SMTP changes or payments were introduced. Added main navigation, footer and relevant service-page links. Pricing CSS only loads on /pricing; comparisons work without JavaScript. Existing route handling supplies canonical metadata, breadcrumbs and sitemap inclusion.

Pricing verification: 557 full-site checks across 62 pages and 23 focused pricing checks passed. All six package links select the correct topic and fill the editable message; malformed/mismatched plan IDs are ignored. Expanded tables fit within their scroll regions at 320-1440px, desktop header fits from 1101px, and plans work without JavaScript. Local mobile Lighthouse: performance 100, accessibility 100, best practices 100. Screenshot reviewed; PHP syntax and whitespace checks passed. No emails sent, dependencies changed or live deployment performed.

## Instant project filters - 3 October 2026

Project category links now filter the existing card list in the browser. All cards are rendered once; the requested server-side filter hides unmatched cards before JavaScript runs. Filter changes use pushState, update the active link/count and robots metadata, and restore on popstate. Ordinary links remain usable without JavaScript and with modified/new-tab clicks. The projects-only script introduces no dependency or API request.

Verification: 20 focused browser checks passed, including all categories, zero document requests during filter clicks, a retained document sentinel, direct filtered loads, Back/Forward, unknown categories, modified clicks, screen-reader status and no-JavaScript behavior. Changed PHP/JS files passed syntax checks. This enhancement covers project filters; navigation between separate content pages remains server-rendered. No live deployment performed.

## Persistent pricing navigation - 3 October 2026

Replaced the pricing page's static jump-link row with a compact sticky native details control below the site header. Its overlay menu links to Shopify, WordPress, add-ons, scope/payment and questions without document navigation. The current section is highlighted during scrolling; section offsets keep headings below the header/control. The menu closes after selecting a section, on outside click or Escape (restoring summary focus). Header height is measured for responsive offsets. No dependencies; navigation remains usable without JavaScript.

Verification: 52 focused browser checks passed at 320, 375 and 1440px, covering every destination, retained document identity, visible sticky position, correct active section, no horizontal overflow, Escape and no-JavaScript operation. Mobile screenshot reviewed. This is a local change awaiting the owner's Git deployment.

## Corrected pricing shortcut - 3 October 2026

Following the owner's visual clarification, restored the original in-flow pricing tabs. Replaced the sticky navigator with a compact fixed bottom-right Sections button, shown only when the original tabs have scrolled above the visible area beneath the header. The button opens a vertical set of rounded section links in the site's green/lime style. It hides and closes again when the original tabs return to view. Anchor links retain no-reload navigation and current-section indication; original tabs remain usable without JavaScript.

Verification: 37 focused checks passed at 320, 375 and 1440px, including initial hidden state, appearance after scrolling, all five destinations, panel bounds, Escape, returning to top, no overflow and no-JavaScript fallback. Mobile screenshot reviewed. This supersedes the previous sticky navigation design.

## Pricing shortcut visual refinement - 3 October 2026

Replaced font-dependent menu/arrow symbols with fixed 18px inline SVG icons. Number badges now use explicit 32px circles and centered SVG text; labels and badges share a consistent grid. Standardized button height, line heights and panel spacing, leaving room for shadows to avoid clipping. Labels retain accessible names while decorative numbers/icons are hidden from assistive technology. Navigation behavior is unchanged and 37 focused checks passed. No additional network assets or dependencies introduced.
Final local pricing audit after shortcut refinement: Lighthouse performance 100 and accessibility 100. Settled mobile/desktop screenshots captured after the chevron transition; navigation checks rerun successfully. These measurements apply to the local pricing page, not a new live deployment.

## Site-wide back-to-top - 3 October 2026

Added an accessible 48px floating up-arrow button on every page. It appears after 400px of scrolling, returns smoothly to the top without navigation, respects reduced motion, and restores keyboard focus to the header brand. On Pricing it sits beside the Sections control with a separate touch target. Hidden during the mobile drawer and when printing. The existing footer anchor remains the no-JavaScript fallback.

Verification: 22 focused Chrome checks passed across 320, 375 and 1440px on home/pricing, covering visibility, no shortcut overlap, preserved document identity, focus restoration and reduced-motion instant scrolling. Mobile screenshot reviewed; PHP and JavaScript syntax checks passed. Local changes only.

## Distinct service icons - 3 October 2026

Removed duplicate service icon assignments. Mobile applications use a phone, Magento a catalog/package, BigCommerce a growth chart, WooCommerce a cart, Shopify a shopping bag, e-commerce a payment card, and web applications a dashboard. All 16 services now have distinct symbolic SVG artwork with the same stroke, icon-box styling and rendered dimensions. These are service illustrations, not claimed official platform logos. Inline SVG adds no external asset requests. PHP lint passed; all 16 rendered icons are unique; desktop/mobile layout and 23px sizing checks passed. Desktop grid screenshot reviewed. Shared cards update the homepage too.

## Mobile navigation movement fix - 3 October 2026

Prevented the mobile navigation's unenhanced layout flashing before the deferred script initializes: an early HTML class lets CSS hide and position the drawer before first paint, while actual no-JavaScript navigation remains available. Cross-document drawer links now leave the current layout stable instead of closing, unlocking scroll and refocusing the toggle before navigation. Same-document links still close the drawer. BFCache restoration resets menu state without a closing animation. Touch devices no longer get the button hover translate effect.

Drawer visibility is immediate on opening while its transform still animates; focus is placed synchronously after layout so the Close control and Tab wrap are reliable. Verified 9 mobile loading/navigation checks (including blocked main JavaScript and equal before/after header position) and 12 drawer checks. All 21 passed in Chrome at mobile/tablet emulated widths. PHP/JS syntax and whitespace checks passed. Physical-device/live testing remains for after deployment; local changes only.

## Service checklist marker fix - 3 October 2026

The later .prose li padding rule overrode .check-list li spacing, causing checkmarks to overlap the first character. Added explicit checklist specificity, removed inherited list padding, and replaced the font glyph with a CSS-embedded SVG check. Checklist text is 15px with 28px marker space and consistent line height. Six browser checks passed at 320, 375 and 1440px for marker clearance and no overflow; mobile screenshot reviewed. Shared checklist styling fixes service pages and other checklists without additional network requests.

## About profile enrichment - 3 October 2026

Owner supplied https://portfolio.webostics.com/ as a source for his background. Read its public page and added concrete Shopify (Liquid, JSON templates, sections/blocks, metafields, AJAX cart), WordPress/WooCommerce and Figma implementation details to About, plus a source link and a concise working process. Retained the independently owner-confirmed mobile project/stack. Did not import counters, testimonials or conversion-result claims. PHP lint and local About response checks passed. Local changes only.

## In-site developer profile - 3 October 2026

Replaced the old-portfolio referral with a dedicated About profile using the owner's supplied portrait (copied unchanged into assets/team/saad-ahmad.png). Added a first-person introduction, three capability cards, a working-process section and current internal links to Co-Museum and the School Van Tracking mobile portfolio record. Retained LinkedIn and project inquiry actions, and linked learners to the real free HTML lesson. About styling loads only on that page; portrait dimensions are explicit. The old portfolio domain is no longer linked from the About page.

Validation: PHP lint passed; 16 browser checks across 320, 375, 768 and 1440px passed for overflow, loaded portrait, current project links and removal of the old domain link. Desktop profile screenshot reviewed. Local change awaiting deployment.
# Developer Library — October 3, 2026

- Reviewed the public Developers Library repository and representative front-end, PHP/Laravel, Magento, Git and WP-CLI notes.
- Added `/resources/developers-library`: six topic groups, original practice tasks, repository links and current official documentation references. Preserved the README contributor credit; described the repository as reference notes, not a finished course.
- Linked the new page from Resources, Courses and About. Included page metadata and automatic sitemap entry. Page-specific CSS only; no additional JavaScript, fonts or dependencies.
- Verified PHP syntax, mobile/desktop widths (320, 375, 768, 1440), topic anchors, discovery links, canonical URL, sitemap inclusion and no-JavaScript content. All 17 focused browser checks passed; inspected desktop and mobile screenshots.
- Ready locally for the owner's next deployment. No live files or repository source content changed.
