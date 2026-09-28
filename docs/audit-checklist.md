# WooCommerce Performance Audit Checklist

Use this checklist before changing production code. The goal is to identify the actual bottleneck first and to preserve buying flows while optimizing.

## 1. Establish the baseline

Record:

- exact URL and page type
- mobile and desktop results
- cold-cache and warm-cache state
- logged-out and logged-in state
- device/browser profile
- network and CPU throttling
- test location
- timestamp
- hosting/cache/CDN state
- active theme and performance-sensitive extensions

Capture at least:

- TTFB
- LCP
- INP field data when available
- CLS
- total transferred bytes
- request count
- main-thread time
- long tasks
- LCP resource and element
- render-blocking resources

Do not compare two tests if the environment changed materially between them.

## 2. Classify pages

Audit multiple templates because WooCommerce behavior differs by context:

- homepage
- shop/archive
- product category
- product page
- search/filter results
- cart
- checkout
- My Account
- order confirmation
- content/blog page

## 3. Server and TTFB

Check:

- origin response time
- full-page cache HIT/MISS behavior
- CDN/edge cache status
- PHP worker saturation
- slow external API calls
- object cache availability
- slow WordPress hooks
- uncached logged-in behavior
- cron/scheduled-action backlog
- error logs

A frontend plugin cannot compensate for consistently slow origin response.

## 4. LCP

Identify the actual LCP element before optimizing.

For image-based LCP:

- verify correct intrinsic dimensions
- avoid lazy-loading the true LCP image
- use an appropriate responsive image
- avoid oversized source assets
- confirm the browser discovers it early
- check whether CSS/JS delays rendering

For text-based LCP:

- inspect font loading
- remove unnecessary render-blocking CSS
- reduce layout work before first render
- verify the text is present in the server-rendered HTML when appropriate

## 5. INP and JavaScript

Inspect:

- long tasks
- third-party tags
- sliders
- product filters
- variation scripts
- consent tools
- analytics duplication
- large DOMs
- synchronous layout reads/writes
- repeated event handlers
- expensive input/change handlers

Prefer removing unnecessary work over merely delaying it.

## 6. CLS

Look for:

- images without dimensions/aspect ratio
- product galleries that resize after load
- cookie banners inserted above content
- late-loaded promo bars
- font swaps that materially change layout
- review widgets
- recommendation blocks
- dynamic notices

Reserve space for UI that is expected to appear.

## 7. WooCommerce-specific payload

Check which scripts/styles load on:

- non-commerce pages
- archives
- product pages
- cart
- checkout
- account

Do not globally dequeue WooCommerce assets without proving they are unnecessary in every affected context.

Third-party extensions may depend on WooCommerce handles or localized data.

## 8. Images and media

Review:

- responsive image sizes
- WebP/AVIF delivery
- compression
- image dimensions
- hero/LCP loading strategy
- below-the-fold lazy loading
- product gallery behavior
- thumbnails
- video embeds
- background images declared in CSS

Do not replace quality control with aggressive compression.

## 9. CSS

Inspect:

- unused framework/theme CSS
- page-builder bundles
- duplicate icon libraries
- render-blocking stylesheets
- critical above-the-fold rules
- animation-heavy selectors
- selector complexity

Avoid maintaining a hand-written "critical CSS" file if the site changes frequently and no process keeps it synchronized.

## 10. Database and WordPress options

Inspect:

- autoloaded option size
- abandoned plugin options
- expired transients
- scheduled actions
- postmeta growth
- session data
- Action Scheduler tables
- slow queries
- object-cache hit rate

Never bulk-delete options/transients without verifying ownership and impact.

## 11. Caching

Validate exclusions for dynamic customer flows.

Typical areas requiring special treatment:

- cart
- checkout
- My Account
- customer sessions
- logged-in users
- payment return/callback URLs
- AJAX/REST endpoints
- personalized currency or location logic

Use cache rules from the actual caching layer/host and WooCommerce-compatible integration rather than relying on generic snippets.

## 12. Regression testing

After each meaningful change test:

- product variations
- stock status
- add to cart
- mini cart/header cart
- cart quantity updates
- coupon application
- shipping calculations
- tax display
- login/logout
- password reset
- account navigation
- checkout validation
- payment gateway handoff
- order placement
- order confirmation
- emails where practical
- downloadable products where relevant
- analytics/consent events

## 13. Decide whether the change stays

Keep an optimization only when:

- a measured bottleneck improved
- no critical buying flow regressed
- the change is understandable and maintainable
- future updates are unlikely to break it silently
- the gain is meaningful enough to justify complexity
