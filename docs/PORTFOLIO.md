# Portfolio content

The user confirmed on 28 September 2026 that the 16 projects in the original portfolio may be presented as Saad Ahmad's work on Webostics.

## Published locally

- Shopify: RXNICOTINE, Tacoma Force, 4Runner Mods, August & Ivy, Birdie Boss, Good Day Chocolate, Love Bling, Helixenos, Beonge.
- Figma to Shopify: Co-Museum, Red Beard Sailing.
- WordPress: Transpire Technologies, Map It Realtour, Sadar Capital.
- Wix / Squarespace: Chibi Tek, Supernatural Kitchen.

Descriptions and technology labels come from the original index.php. No outcomes, testimonials, screenshots or project metrics have been invented. Each card states “Work by Saad Ahmad.” The collection explains that linked sites can change after completion. The Red Beard Sailing link now uses its public domain instead of the old theme-preview query.

## Editing

Edit `app/data/projects.json`. Fields are independent of templates:

- `published`: controls inclusion throughout the website.
- `featured`: includes the project in the homepage selection (first three).
- `category`: shopify, figma-shopify, wordpress or other.
- `summary`, `technology`, `attribution`, `url`: the visible project information.
- `image`, `imageWidth`, `imageHeight`: add a local approved screenshot path and its actual dimensions. Use an optimized WebP/AVIF image. Without an image, the card uses a decorative text monogram; it is not a website screenshot.
- `problem`, `solution`, `results`: optional verified case-study context. Null fields stay hidden.
- `source`, `publicationNote`, `linkNote`: editorial provenance, not rendered publicly.

The project gallery is `/projects`. Platform links use GET query parameters and work with JavaScript disabled. Filtered pages use the main gallery canonical and noindex to avoid indexing repetitive views. The main gallery is included in the sitemap and indexable only on the configured production hostname. Localhost remains noindex.

## Remaining content improvements

- [x] Confirm permission and attribution with the user.
- [x] Recover all 16 original records.
- [x] Add gallery, filters, navigation and three homepage features.
- [x] Add conditional SEO indexing and sitemap inclusion.
- [x] Check layout, filtering, no-JavaScript behavior and SEO output.
- [x] Add three labelled current-site WebP captures for the featured projects.
- [ ] Supply approved screenshots of the work as originally delivered and screenshots for remaining projects.
- [ ] Expand selected records with exact contribution, constraints and verified outcomes.
- [ ] Verify external destinations before launch; live website content is not proof of the original work.

Do not rerun `storage/import-projects.mjs` after editorial changes: it is the one-time importer from the original backup and overwrites the JSON records.

## Verification — 28 September 2026

All 468 automated checks passed across 55 pages. The added checks cover all 16 records, each platform filter, three featured projects, attribution, removal of the historical preview query, filtering with JavaScript disabled, and header/gallery overflow at 320, 375, 430, 768, 900, 901, 950, 1024 and 1440 px. Production-host behavior was simulated locally: the gallery is indexable, filtered pages are noindex, and the sitemap includes the gallery. Desktop/mobile screenshots were visually reviewed. All PHP files passed syntax checks. No emails were sent or production files deployed.

## Co-Museum scope confirmation - 30 September 2026

Saad confirmed full website development for Co-Museum only. Its dedicated page combines that confirmed role with the existing approved portfolio description: Figma-to-Liquid, reusable sections and responsive layout. No business metrics, design ownership, delivery date or testimonial is asserted. Tacoma Force and Transpire Technologies remain unchanged. The current-site screenshot retains its capture date and change-since-delivery notice.

New route: /projects/co-museum. Linked from the Co-Museum homepage/gallery card and included in the sitemap. This local addition requires a new upload.

## Published Android project - 30 September 2026

Owner confirmed School Van Tracking (com.svt.driver) as his work and identified React Native, a Laravel backend and Next.js as its stack. The public Play Store page was fetched and its title, Android platform and short feature description checked. It lists Devteampro as publisher; the portfolio credits development to Saad without asserting publisher ownership. No ratings, download counts or unverified app results are published. The app was not installed or functionally tested.

- Added a Mobile Apps gallery filter and a School Van Tracking card linking directly to Google Play.
- Added /services/mobile-app-development and its homepage card, focusing on Android work with the confirmed stack.
- Updated About and portfolio metadata to cover mobile work; other unpublished apps await details from Saad.
- Source: https://play.google.com/store/apps/details?id=com.svt.driver .
