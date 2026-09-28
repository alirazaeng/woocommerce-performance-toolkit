# Core Web Vitals for WooCommerce

Core Web Vitals should be treated as user-experience signals, not a badge score.

## Current good thresholds

Using field data at the 75th percentile:

| Metric | Good |
| --- | ---: |
| Largest Contentful Paint (LCP) | <= 2.5 seconds |
| Interaction to Next Paint (INP) | <= 200 milliseconds |
| Cumulative Layout Shift (CLS) | <= 0.1 |

Evaluate mobile and desktop separately.

## Field vs lab data

### Field data

Field data reflects real users across real devices, networks, cache states, and sessions.

Use it for:

- Core Web Vitals status
- trend analysis
- real-device performance
- before/after validation over time

### Lab data

Lab tools are controlled diagnostics.

Use them to:

- identify the LCP element
- inspect request waterfalls
- find render-blocking resources
- detect long tasks
- trace layout shifts
- compare reproducible builds

A single Lighthouse score is not equivalent to field performance.

## LCP on WooCommerce

Common LCP candidates include:

- homepage hero image
- category banner
- product gallery image
- large product heading
- promotional content block

### Diagnostic sequence

1. Identify the LCP element.
2. Check document TTFB.
3. Find when the LCP resource is discovered.
4. Check request priority.
5. Check image dimensions and source size.
6. Check CSS/JS render delay.
7. Re-test after one controlled change.

### Common mistakes

- lazy-loading the true above-the-fold LCP image
- serving a multi-megabyte source for a small viewport
- using CSS background images that are discovered late
- preloading too many assets
- adding a slider when a static hero would suffice
- optimizing the image while ignoring slow TTFB

## INP on WooCommerce

Commerce pages often have heavy interaction code:

- variation selectors
- filters
- sliders
- quantity controls
- mini-cart UI
- analytics
- consent systems
- review widgets

### What to inspect

- event-handler cost
- long tasks
- synchronous third-party scripts
- DOM size
- repeated layout measurement
- large JavaScript bundles
- expensive change/input listeners

The preferred order is:

1. remove unnecessary work
2. reduce the amount of work
3. split/defer non-critical work
4. optimize the remaining handler

## CLS on WooCommerce

Common causes:

- product galleries changing height
- missing image dimensions
- font changes
- late promo bars/notices
- review widgets
- lazy-loaded content with no reserved space
- dynamic price/variation areas changing dimensions

### Practical fixes

- reserve media space with intrinsic dimensions or aspect-ratio
- preserve gallery/container dimensions during initialization
- avoid injecting banners above already-rendered content
- reserve predictable space for delayed widgets
- test variation changes for layout stability

## Testing matrix

At minimum, test:

| Page | Mobile | Desktop | Guest | Logged in |
| --- | --- | --- | --- | --- |
| Home | Yes | Yes | Yes | Optional |
| Shop/category | Yes | Yes | Yes | Optional |
| Product | Yes | Yes | Yes | Optional |
| Cart | Yes | Yes | Yes | If accounts matter |
| Checkout | Yes | Yes | Yes | Yes |
| My Account | Yes | Yes | N/A | Yes |

## Reporting

A useful report says:

- what was slow
- how it was measured
- root cause
- exact change
- before result
- after result
- test conditions
- regressions checked
- remaining bottlenecks

Avoid reporting only a score screenshot.
