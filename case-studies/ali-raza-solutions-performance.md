# Ali Raza Solutions — Measured WordPress Performance Improvement

This case study documents a before-and-after GTmetrix improvement for **https://alirazasolutions.com/** using screenshots captured under closely matched test conditions.

## Result summary

| Metric | Before | After | Change |
| --- | ---: | ---: | ---: |
| GTmetrix Grade | E | A | E → A |
| Performance | 33% | 92% | +59 points |
| Structure | 87% | 98% | +11 points |
| Largest Contentful Paint | 7.6s | 1.3s | -6.3s |
| Total Blocking Time | 543ms | 25ms | -518ms |
| Cumulative Layout Shift | 0.04 | 0 | -0.04 |

## Test conditions

Both screenshots show:

- GTmetrix
- Seattle, WA, USA test server
- Chrome 154
- Lighthouse 12.6.1
- same production domain: `https://alirazasolutions.com/`

The before screenshot is dated **Sep 24, 2026** and the after screenshot is dated **Sep 25, 2026**.

Because the screenshots use closely matched test conditions, this is the strongest directly comparable benchmark currently documented in this repository.

## Before

![Ali Raza Solutions before GTmetrix result](../assets/case-studies/ali-raza-solutions-before.webp)

**Observed result:** Grade E · Performance 33% · Structure 87% · LCP 7.6s · TBT 543ms · CLS 0.04

## After

![Ali Raza Solutions after GTmetrix result](../assets/case-studies/ali-raza-solutions-after.webp)

**Observed result:** Grade A · Performance 92% · Structure 98% · LCP 1.3s · TBT 25ms · CLS 0

## What this evidence does and does not prove

The screenshots document the measured site-level improvement.

They do **not** independently attribute each metric change to a specific code snippet in this repository. Performance work can include several interacting changes across page design, asset delivery, caching, image handling, JavaScript/CSS loading, hosting behavior, and WordPress configuration.

This case study therefore reports the observed results without claiming a single isolated cause.

## Why this matters

The largest improvement is LCP:

```text
7.6s → 1.3s
```

That represents a substantially faster largest-content render under the shown GTmetrix conditions.

TBT also fell from:

```text
543ms → 25ms
```

while CLS improved from `0.04` to `0`.

The combination shows why WordPress optimization should be evaluated across rendering, main-thread behavior, and layout stability rather than by one score alone.
