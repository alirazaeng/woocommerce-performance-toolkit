# WooCommerce Performance Toolkit

Production-focused techniques, diagnostics, and implementation patterns for improving WooCommerce storefront performance without sacrificing checkout reliability, compatibility, or maintainability.

[![Code Quality](https://github.com/alirazaeng/woocommerce-performance-toolkit/actions/workflows/quality.yml/badge.svg)](https://github.com/alirazaeng/woocommerce-performance-toolkit/actions/workflows/quality.yml) [![Release](https://img.shields.io/github/v/release/alirazaeng/woocommerce-performance-toolkit?label=release)](https://github.com/alirazaeng/woocommerce-performance-toolkit/releases/latest) [![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

This repository is intentionally **not** a "paste every snippet into production" collection. Each optimization should be measured, tested in staging, and enabled only when it matches the store's theme, extensions, traffic profile, and critical customer flows.

## What this project demonstrates

- WooCommerce performance auditing
- Core Web Vitals diagnosis and remediation
- Conditional asset loading
- Frontend payload reduction
- Database and query hygiene
- Cache-safe WooCommerce configuration
- Layout stability patterns
- Performance troubleshooting methodology
- Production validation before/after deployment

## Core Web Vitals targets

For field data, use the 75th percentile and evaluate mobile and desktop separately.

| Metric | Good target | Focus |
| --- | ---: | --- |
| LCP | <= 2.5 s | Loading performance |
| INP | <= 200 ms | Interaction responsiveness |
| CLS | <= 0.1 | Visual stability |

Lab tools are useful for diagnosis, but they do not replace real-user/field data. In particular, lab tests cannot directly reproduce real-user INP.

## Repository structure

~~~text
woocommerce-performance-toolkit/
├── README.md
├── LICENSE
├── SECURITY.md
├── .gitignore
├── assets/
│   └── case-studies/
├── case-studies/
│   ├── ali-raza-solutions-performance.md
│   ├── ahf-collection-performance.md
│   └── measured-wordpress-performance.md
├── docs/
│   ├── audit-checklist.md
│   ├── core-web-vitals.md
│   ├── caching-strategy.md
│   └── troubleshooting.md
├── php/
│   ├── asset-optimization.php
│   ├── woocommerce-cleanup.php
│   ├── frontend-optimization.php
│   └── database-optimization.php
├── js/
│   └── frontend-performance.js
├── css/
│   └── critical-patterns.css
└── examples/
    ├── implementation-notes.md
    └── before-after-case-study.md
~~~

## Operating principles

### 1. Measure before changing code

Capture a reproducible baseline first:

- page type and exact URL
- test device/profile
- cache state
- logged-in vs logged-out
- network and CPU throttling
- LCP element
- long tasks / main-thread blocking
- layout-shift sources
- request count and transferred bytes
- TTFB
- database/query symptoms
- plugin/theme state

### 2. Protect critical WooCommerce flows

An optimization is not successful if the store becomes faster but customers cannot reliably:

- add products to cart
- update cart quantities
- apply coupons
- select shipping
- calculate tax
- log in
- reset passwords
- complete checkout
- pay
- view orders
- download eligible files

Always test both guest and authenticated customer flows when relevant.

### 3. Load assets only where needed

One of the safest recurring wins is preventing a feature's JavaScript and CSS from loading on pages that do not use that feature.

This toolkit favors conditional loading over aggressive global dequeuing.

### 4. Cache public pages, not personalized commerce state

WooCommerce pages can contain session- or customer-specific data. Page caching rules should exclude truly dynamic flows such as cart, checkout, and account pages unless the caching layer has explicit WooCommerce-aware handling.

### 5. Avoid fake performance claims

Do not publish "90+ Lighthouse", "2x faster", or conversion improvements unless they are tied to a documented test method and real measurements.

The case-study template in this repository deliberately leaves metric values blank until measured.

## Using the PHP examples

The PHP files are examples of targeted patterns, not a single plugin that should be activated wholesale.

Recommended workflow:

1. Read the file comments.
2. Confirm the optimization matches the site's bottleneck.
3. Test it on staging.
4. Add automated/manual regression checks for affected flows.
5. Deploy one meaningful change at a time.
6. Compare against the baseline.
7. Keep or revert based on evidence.

If you turn a pattern into a production plugin, namespace it, add lifecycle handling, follow WordPress/WooCommerce coding standards, and declare/test compatibility appropriately.

## Suggested audit order

1. **Server response / TTFB** — hosting, full-page cache, object cache, slow PHP, external API calls.
2. **LCP path** — document response, render-blocking assets, hero image/font, preload priority.
3. **JavaScript / INP** — long tasks, third-party scripts, event handlers, excessive DOM work.
4. **CLS** — missing dimensions, late banners, fonts, galleries, injected UI.
5. **WooCommerce payload** — unnecessary assets, fragments, extension scripts, product gallery behavior.
6. **Database** — slow queries, autoloaded options, transients, scheduled actions, oversized metadata.
7. **Regression testing** — cart, checkout, account, payment, search, filters, analytics.

## Measured performance results

The repository includes real screenshot-backed performance evidence rather than headline scores without context.

### Ali Raza Solutions — matched before/after

| Metric | Before | After |
| --- | ---: | ---: |
| GTmetrix Grade | E | A |
| Performance | 33% | 92% |
| Structure | 87% | 98% |
| LCP | 7.6 s | 1.3 s |
| TBT | 543 ms | 25 ms |
| CLS | 0.04 | 0 |

Both captures show the same production domain, Seattle test location, Chrome 154, and Lighthouse 12.6.1.

**Engineering focus:** improve the critical rendering path and main-thread behavior while preserving the site's visual identity and animation-led experience.

<p>
  <img src="assets/case-studies/ali-raza-solutions-before.webp" alt="Ali Raza Solutions GTmetrix before result: Grade E, 33 percent performance, 7.6 second LCP" width="49%">
  <img src="assets/case-studies/ali-raza-solutions-after.webp" alt="Ali Raza Solutions GTmetrix after result: Grade A, 92 percent performance, 1.3 second LCP" width="49%">
</p>

[Read the full Ali Raza Solutions engineering case study →](case-studies/ali-raza-solutions-performance.md)

### AHF Collection — WooCommerce performance engineering

Latest confirmed technical-handoff results through theme **v1.7.1**:

| Metric | Baseline | Latest confirmed / measured |
| --- | ---: | ---: |
| PageSpeed desktop | — | **100** |
| GTmetrix LCP | **10.4 s** | **0.69 s** |
| Homepage TBT | **346–544 ms** | **0 ms** |
| Mobile SEO | **92** | **100** |
| Shop CLS | **0.16** | **0.012** |
| Homepage compressed size | **~92 KB** | **49 KB** |

The final GTmetrix A-grade confirmation and a 95+ mobile target remain explicitly marked as pending in the technical handoff. Earlier screenshot-backed D → B evidence is retained inside the case study as historical visual proof.

[Read the AHF Collection engineering case study →](case-studies/ahf-collection-performance.md)

### Additional historical benchmark

An earlier WordPress benchmark remains available for historical context:

- **GTmetrix Grade:** C → A
- **Performance:** 59% → 87%
- **LCP:** 5.7 s → 1.5 s
- **Structure:** 96% → 98%

That report also records TBT and CLS regressions rather than hiding them and does not claim undocumented implementation details.

[Read the additional measured benchmark →](case-studies/measured-wordpress-performance.md)

## Files worth starting with

- [Audit checklist](docs/audit-checklist.md)
- [Core Web Vitals guide](docs/core-web-vitals.md)
- [Caching strategy](docs/caching-strategy.md)
- [Troubleshooting playbook](docs/troubleshooting.md)
- [Ali Raza Solutions measured case study](case-studies/ali-raza-solutions-performance.md)
- [AHF Collection WooCommerce case study](case-studies/ahf-collection-performance.md)
- [Implementation notes](examples/implementation-notes.md)
- [Case-study template](examples/before-after-case-study.md)

## Compatibility mindset

WooCommerce is an extensible production system. Avoid depending on internal WooCommerce implementation details when a public API, hook, template override, or documented extension point exists.

Performance code should also be conservative around:

- cart and checkout state
- nonces
- REST/AJAX requests
- payment gateways
- multilingual/currency plugins
- product filters
- analytics/consent tooling
- subscriptions and memberships
- logged-in personalization

## References

- [Web Vitals — web.dev](https://web.dev/articles/vitals)
- [WooCommerce performance best practices](https://developer.woocommerce.com/docs/best-practices/performance/performance-best-practices)
- [WooCommerce performance optimization](https://developer.woocommerce.com/docs/best-practices/performance/performance-optimization)
- [WooCommerce extension core concepts](https://developer.woocommerce.com/docs/extensions/core-concepts/)

## Author

**Engineer Ali Raza**  
WordPress & WooCommerce Developer · Web Performance Specialist

- Portfolio: https://engineeraliraza.site
- Upwork: https://www.upwork.com/freelancers/engineeraliraza

## License

MIT. See [LICENSE](LICENSE).

---

Use these techniques responsibly. Back up production sites, test on staging, and verify real customer flows after every performance change.
