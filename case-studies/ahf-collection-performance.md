# AHF Collection — WooCommerce Performance Improvement

This case study documents a measured GTmetrix improvement for **AHF Collection**, a WooCommerce fashion storefront.

## Result summary

| Metric | Earlier capture | Later capture | Change |
| --- | ---: | ---: | ---: |
| GTmetrix Grade | D | B | D → B |
| Performance | 55% | 82% | +27 points |
| Structure | 81% | 88% | +7 points |
| Largest Contentful Paint | 7.9s | 2.0s | -5.9s |
| Total Blocking Time | 58ms | 35ms | -23ms |
| Cumulative Layout Shift | 0.01 | 0 | -0.01 |

## Important comparison note

The earlier screenshot shows:

```text
https://www.ahfcollection.com/
```

while the later screenshot shows:

```text
https://ahfcollection.com/
```

Both captures show GTmetrix testing from **Seattle, WA, USA** using **Chrome 142 / Lighthouse 12.6.1**.

Because the hostname differs between the two screenshots, this should be treated as a documented site improvement rather than a perfectly controlled laboratory comparison.

## Earlier capture

![AHF Collection earlier GTmetrix result](../assets/case-studies/ahf-collection-before.webp)

**Observed result:** Grade D · Performance 55% · Structure 81% · LCP 7.9s · TBT 58ms · CLS 0.01

## Later capture

![AHF Collection later GTmetrix result](../assets/case-studies/ahf-collection-after.webp)

**Observed result:** Grade B · Performance 82% · Structure 88% · LCP 2.0s · TBT 35ms · CLS 0

## WooCommerce context

WooCommerce performance work has to preserve commerce behavior while improving rendering.

Regression-sensitive areas include:

- product pages
- cart state
- checkout
- customer account
- AJAX interactions
- session-dependent content
- payment/shipping flows

This is why the repository's optimization patterns are paired with regression-testing guidance instead of treating speed as a purely visual front-end task.

## Interpretation

The strongest change visible in these captures is LCP:

```text
7.9s → 2.0s
```

Performance increased by **27 points**, while TBT and CLS also improved.

The result is presented with the hostname caveat above so the evidence remains transparent.
