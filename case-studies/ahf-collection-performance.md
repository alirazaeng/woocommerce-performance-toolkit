# AHF Collection — WooCommerce Performance Engineering

This case study documents the performance work completed for **AHF Collection**, a WooCommerce fashion storefront running on an Astra child theme with Cloudflare Free and a LiteSpeed host.

The latest supplied technical handoff is dated **30 September 2026** and covers the theme release sequence through **v1.7.1**.

## Latest confirmed results

| Metric | Baseline | Latest confirmed / measured | Status |
| --- | ---: | ---: | --- |
| GTmetrix Grade | **E** | **A** | Confirmed 2 Oct 2026 |
| GTmetrix Performance | **41%** | **99%** | Confirmed 2 Oct 2026 |
| GTmetrix Structure | **85%** | **98%** | Confirmed 2 Oct 2026 |
| GTmetrix LCP | **10.4s** | **0.76s** | Confirmed 2 Oct 2026 |
| GTmetrix TBT | **346–544ms** | **76ms** | Confirmed 2 Oct 2026 |
| PageSpeed desktop | — | **100** | Confirmed |
| Mobile SEO | **92** | **100** | Confirmed |
| Shop-page CLS | **0.16** | **0.012** | Confirmed |
| Homepage compressed size | **~92 KB** | **49 KB** | Confirmed |
| PageSpeed mobile | **68** | **88–90**; local Lighthouse run **98** | Measured range |
| 95+ mobile target | **68 baseline** | Pending warm-cache validation | Not yet confirmed |

The final GTmetrix retest on **2 October 2026** confirmed the A grade. The earlier post-fix measurements of **0.69s LCP** and **0ms homepage TBT** are retained below as intermediate evidence from specific optimization steps; the table above uses the final GTmetrix retest for the end-state comparison.

## Strongest measured improvements

### Largest Contentful Paint

```text
10.4s → 0.76s final GTmetrix retest
```

An earlier post-fix measurement reached **0.69s**. The report attributes the largest single gain to removing a page fade-in animation that kept the hero hidden from performance measurement.

### Total Blocking Time

```text
346–544ms → 76ms final GTmetrix retest
```

A targeted post-v1.6.8 homepage measurement reached **0ms TBT** after scripts were changed to wait for the visitor's first scroll or tap. The slider, wishlist, and category-card behavior were then retested.

### Shop layout stability

```text
0.16 → 0.012 CLS
```

The WooCommerce layout switch was moved to the top of the page instead of the bottom.

### Homepage transfer size

```text
~92 KB → 49 KB
```

The v1.7.1 work replaced duplicate embedded cookie-banner logo copies with a small cached image and removed unnecessary HTML comments.

## Engineering release sequence

| Version | Change | Measured / intended impact |
| --- | --- | --- |
| **1.6.4** | Moved large CSS blocks out of each page head into cacheable files | Smaller HTML and reusable CSS |
| **1.6.5** | Removed the page fade-in that hid the hero | **LCP 10.4s → 0.69s** |
| **1.6.6** | Preloaded two header fonts | Earlier header-text visibility |
| **1.6.7** | Moved WooCommerce layout switching earlier | **Shop CLS 0.16 → 0.012** |
| **1.6.8** | Delayed homepage scripts until first interaction | **Homepage TBT → 0ms** |
| **1.6.9** | Replaced the mobile hero with a high-priority AVIF | Faster mobile hero delivery |
| **1.7.0** | Inlined critical first-screen CSS and deferred full stylesheets | Mobile FCP **1.8s → 1.5s**, Speed Index **4.1s → 2.6s** |
| **1.7.1** | Reduced repeated cookie-banner assets and HTML overhead | Homepage **~92 KB → 49 KB** |

Earlier optimization work also included self-hosted fonts, removal of render-blocking font stylesheets, moving jQuery to the footer, removing the WordPress emoji script, preventing cookie-banner assets from blocking rendering, and moving inline JavaScript into reusable cached files.

## Edge and infrastructure work

The project also included Cloudflare delivery changes designed around WooCommerce safety:

- four-hour edge caching for public pages
- cache bypass for cart, checkout, My Account, logged-in users, and visitors with cart items
- automatic Cloudflare purge coordination
- moving the www → non-www redirect to the edge
- browser caching for static assets
- Tiered Cache
- removal of the Cloudflare Web Analytics beacon
- HTTPS/TLS/Early Hints configuration
- edge caching for robots.txt and sitemap
- DNS cleanup

The technical handoff reports that moving the www redirect to Cloudflare saved about **2.4 seconds** for visits arriving on the www hostname.

## Resilience and rollback

Performance changes were paired with fail-safe behavior rather than treated as one-way optimizations:

- stale critical CSS self-disables
- failed page trimming falls back to the original page
- logged-in editing and the Customizer keep normal behavior
- a rollback theme package was retained
- a script-delay regression affecting the slider, category cards, and wishlist was corrected and retested before the optimized build remained live

## Earlier GTmetrix screenshot evidence

The repository also retains an earlier visual before/after sequence:

| Metric | Earlier capture | Later capture |
| --- | ---: | ---: |
| GTmetrix Grade | D | B |
| Performance | 55% | 82% |
| Structure | 81% | 88% |
| LCP | 7.9s | 2.0s |
| TBT | 58ms | 35ms |
| CLS | 0.01 | 0 |

### Earlier capture

![AHF Collection earlier GTmetrix result](../assets/case-studies/ahf-collection-before.webp)

### Later capture

![AHF Collection later GTmetrix result](../assets/case-studies/ahf-collection-after.webp)

The earlier screenshot uses `www.ahfcollection.com` while the later screenshot uses `ahfcollection.com`, so those two captures are retained as documented site improvement rather than presented as a perfectly controlled laboratory benchmark.

## Current conclusion

The strongest confirmed outcome is the reduction in frontend work before first paint and interaction while preserving the storefront's visible presentation and normal logged-in editing behavior.

The **2 October 2026 GTmetrix retest confirmed Grade A, Performance 99%, Structure 98%, LCP 0.76s, TBT 76ms, and CLS 0**.

The remaining infrastructure concern documented in the handoff is the origin server under load. The report recommends PHP 8.2 OPcache as the highest-value server-side follow-up.

**Not claimed as confirmed here:** a 95+ PageSpeed mobile result. That target still requires the recommended warm-cache validation.
