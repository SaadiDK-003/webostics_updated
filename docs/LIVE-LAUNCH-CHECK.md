# Live verification - 29 September 2026

The owner confirmed deployment, the updated .htaccess, and successful delivery to webostics@gmail.com. No live contact submissions or emails were sent during these audits. Search Console is deferred at the owner's request.

## Completed live checks

- Chrome: 299 checks passed across 56 pages; representative layouts at 320, 375, 430, 768, 1024 and 1440 pixels; navigation, filters, form preselection and HTML playground; no JavaScript exceptions.
- HTTPS www redirects to https://webostics.com/ with HTTP 301.
- Key routes return 200; unknown routes return 404; private paths return 403.
- Production indexing metadata, canonicals, robots.txt and the 28-URL sitemap passed.

## Lighthouse homepage results

| Live homepage | Performance | Accessibility | Best practices | SEO |
| --- | ---: | ---: | ---: | ---: |
| Mobile | 100 | 96 | 100 | 100 |
| Desktop | 100 | 95 | 100 | 100 |

Mobile: FCP 1.3s, LCP 1.4s, TBT 20ms, CLS 0. Desktop: FCP/LCP 0.4s, TBT 0ms, CLS 0.

These are individual Lighthouse 13.5.0 lab runs, not field Core Web Vitals or accessibility certification. Scores apply to the homepage at the time tested. JSON/HTML reports and screenshots are in ignored storage.

## Local update awaiting upload

- Improved small-text contrast in homepage illustrations.
- Project links' accessible names now include their visible Visit website text.
- Added /courses/html/links-and-navigation with two downloadable connected HTML files, exercises and keyboard-navigation guidance.
- Linked the lessons and corrected individual LearningResource names.
- Local regression: 501 checks passed across 57 pages, with no browser exceptions.
- Local homepage Lighthouse accessibility after fixes: 100.

These changes are not live until uploaded. The release ZIP excludes the real .env; preserve the production .env when uploading.

## Remaining steps

1. Upload the new release, then recheck live accessibility, the new lesson and downloads.
2. Verify HTTP-to-HTTPS on the host, including an inner URL with a query string. Public port 80 was unreachable from this checking environment; only HTTPS www was verified.
3. Expand case studies when Saad provides verified scope, contributions and outcomes. Keep projects attributed to Saad's work; do not invent client results.
4. Confirm historical redirects using the old URL inventory or Search Console data.
5. When the owner is ready, verify Google Search Console and submit https://webostics.com/sitemap.xml. Keep incomplete course outlines noindex.

## Latest deployment verified - 30 September 2026

- The second lesson returns HTTP 200. Both downloadable HTML files and the global stylesheet match the local files byte for byte.
- The live sitemap contains 29 URLs, including the second lesson.
- HTTP and HTTPS www requests for /services/shopify?ref=launch-check return HTTP 301 to https://webostics.com/services/shopify?ref=launch-check, preserving the path and query string.
- Fresh live mobile homepage Lighthouse: performance 100, accessibility 100, best practices 100, SEO 100. Report: storage/lighthouse-live-mobile-followup.report.html (ignored). Single lab run, not field data.
- Previous pending-upload and public-HTTP limitations above are resolved. Historical URL migration still needs the old URL inventory. Search Console remains deferred. No live emails were sent.

Live follow-up browser regression: all 303 checks passed across 57 pages, with no emails sent. Co-Museum project details were subsequently added locally following the owner's confirmation of full website development; that new page is not part of these live results.
