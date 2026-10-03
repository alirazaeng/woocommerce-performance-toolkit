# Ali Raza Solutions — WordPress Performance Optimization Case Study

> **Result:** GTmetrix **E → A**, Performance **33% → 92%**, LCP **7.6s → 1.3s**, TBT **543ms → 25ms**, and CLS **0.04 → 0** — while preserving the site's visual identity and animation-led experience.

This case study documents a measured performance optimization of **https://alirazasolutions.com/**, a production WordPress agency website built around a visually rich homepage, custom branding, service content, conversion-focused sections, and motion effects.

The goal was not to make the site fast by stripping away the experience. The goal was to improve the critical rendering path and execution cost while keeping the design intact.

---

## 1. Project objective

The site needed to become substantially faster without compromising:

- the hero composition
- the existing visual hierarchy
- brand styling
- responsive behavior
- scroll-based interactions
- the overall desktop and mobile experience

The optimization target was therefore broader than a single score:

1. improve the initial render
2. reduce Largest Contentful Paint
3. reduce main-thread blocking
4. eliminate unnecessary layout movement
5. preserve the existing design system
6. verify the result under comparable test conditions

---

## 2. Verified before-and-after result

| Metric | Before | After | Change |
| --- | ---: | ---: | ---: |
| **GTmetrix Grade** | E | A | E → A |
| **Performance** | 33% | 92% | **+59 points** |
| **Structure** | 87% | 98% | **+11 points** |
| **Largest Contentful Paint** | 7.6s | 1.3s | **6.3s faster** |
| **Total Blocking Time** | 543ms | 25ms | **518ms lower** |
| **Cumulative Layout Shift** | 0.04 | 0 | **0.04 lower** |

### Before optimization

![Ali Raza Solutions before GTmetrix result](../assets/case-studies/ali-raza-solutions-before.webp)

**Observed result:** Grade E · Performance 33% · Structure 87% · LCP 7.6s · TBT 543ms · CLS 0.04

### After optimization

![Ali Raza Solutions after GTmetrix result](../assets/case-studies/ali-raza-solutions-after.webp)

**Observed result:** Grade A · Performance 92% · Structure 98% · LCP 1.3s · TBT 25ms · CLS 0

---

## 3. Test conditions

The documented screenshots use closely matched GTmetrix conditions:

- **Production domain:** `https://alirazasolutions.com/`
- **Test server:** Seattle, WA, USA
- **Browser:** Chrome 154
- **Lighthouse:** 12.6.1
- **Before capture:** September 24, 2026
- **After capture:** September 25, 2026

Using the same production URL, location, browser generation, and Lighthouse version makes the comparison significantly more useful than unrelated screenshots captured under different environments.

This is still a lab benchmark, not field Core Web Vitals data. The numbers should therefore be interpreted as controlled performance evidence rather than a replacement for real-user monitoring.

---

## 4. Performance problem

The site was visually polished, but important above-the-fold content was reaching the user too late.

The project review identified two high-impact areas:

### Hero visibility on first paint

The hero experience used a fade-in presentation that could leave the primary visual content hidden during the initial render.

That is a critical performance problem when the hidden element is also the likely LCP candidate: even if the browser downloads the image early, the user does not receive the visual result until the presentation logic allows it to appear.

### Early render and execution cost

Header, font, tracking, and front-end resources were competing for work during the initial rendering phase.

On an animation-rich WordPress site, the correct response is not to remove every script or visual effect. It is to decide which work is genuinely required before the first useful paint and which work can happen afterward.

---

## 5. Optimization strategy

The project followed a conservative performance approach:

### A. Make critical content visible immediately

The hero was treated as critical content rather than delayed decorative content.

The important principle is:

> **The page should not depend on an animation completing before the user can see the primary content.**

Animation can enhance visible content. It should not gate the first meaningful render.

### B. Reduce render-blocking work

Resources involved in the early page lifecycle were reviewed so that non-critical work did not unnecessarily compete with the first render.

Typical decisions in this phase include:

- loading only what is required above the fold
- avoiding unnecessary blocking dependencies
- deferring non-critical execution
- reducing duplicate or redundant front-end work
- ensuring fonts and visual assets do not hold the page hostage

### C. Preserve animations instead of deleting them

The performance target was not achieved by converting the site into a static page.

Motion and interaction remained part of the experience, but they were treated as enhancement layers that should run **after or alongside usable content**, rather than delaying usability.

### D. Validate the whole page, not only the score

The project was judged against multiple metrics because optimizing only one number can create regressions elsewhere.

The result improved:

- LCP
- TBT
- CLS
- GTmetrix Performance
- GTmetrix Structure
- overall Grade

That combination is more meaningful than a single headline score.

---

## 6. Technical reasoning

### Largest Contentful Paint

The most significant improvement was:

```text
7.6s → 1.3s
```

That is a **6.3-second reduction** in the measured LCP.

For a visually led homepage, LCP is heavily influenced by the path between:

1. receiving the HTML
2. discovering the primary visual resource
3. loading its dependencies
4. rendering it visibly
5. avoiding CSS/JavaScript behavior that delays its presentation

A resource can be downloaded and still produce poor LCP if CSS, opacity, animation state, or execution delays keep it from being painted.

### Total Blocking Time

TBT improved from:

```text
543ms → 25ms
```

This indicates substantially less main-thread blocking in the measured test.

For WordPress sites with animation, analytics, plugin assets, and custom front-end behavior, reducing early JavaScript work can be just as important as reducing image weight.

### Cumulative Layout Shift

CLS improved from:

```text
0.04 → 0
```

The initial value was already modest, but reaching zero in the measured run indicates that the optimized page rendered without visible layout movement recorded by that test.

### Structure score

GTmetrix Structure moved from:

```text
87% → 98%
```

This supports the broader conclusion that the improvement was not only a faster visual appearance; the underlying delivery pattern also became cleaner according to the test.

---

## 7. What was intentionally preserved

A performance project is unsuccessful if it solves speed by damaging the product.

The optimization retained the site's:

- branding
- homepage composition
- agency-style visual presentation
- responsive design
- conversion sections
- motion-led experience

This matters because the engineering objective was **performance without design regression**.

---

## 8. What the evidence proves

The screenshots directly support these claims:

- the same production domain was tested
- GTmetrix Grade improved from E to A
- Performance improved from 33% to 92%
- Structure improved from 87% to 98%
- LCP improved from 7.6s to 1.3s
- TBT improved from 543ms to 25ms
- CLS improved from 0.04 to 0
- the captures used closely matched GTmetrix conditions

---

## 9. What the evidence does not prove by itself

The screenshots do **not** isolate the contribution of every individual implementation change.

Web performance is multi-variable. A final result can reflect interacting changes across:

- CSS delivery
- JavaScript execution
- image loading
- font loading
- caching
- WordPress configuration
- third-party scripts
- server behavior
- browser timing

For that reason, this case study does not claim that one code snippet alone produced the entire improvement.

The implementation narrative explains the optimization strategy, while the before/after screenshots provide the measured outcome.

---

## 10. Why this project matters

This case study demonstrates a performance approach that is useful beyond one website:

### Do not confuse visual richness with poor performance

Animation-heavy sites can still load quickly when critical content is available immediately and non-critical work is scheduled intelligently.

### Do not optimize by deletion alone

Removing features until a benchmark turns green is not the same as engineering.

A stronger solution preserves the business and design requirements while improving the delivery path.

### Measure more than one metric

A healthy optimization should consider:

- visual loading
- main-thread responsiveness
- layout stability
- regressions
- functional behavior

### Keep proof tied to test conditions

Performance screenshots without dates, URLs, tools, locations, or comparable environments are weak evidence.

Reproducible conditions make the result more credible.

---

## 11. Reusable workflow

For similar WordPress or WooCommerce projects:

1. establish a baseline before changing production behavior
2. identify the actual LCP element
3. inspect whether CSS or animation hides the LCP candidate
4. profile render-blocking resources
5. inspect long tasks and early JavaScript execution
6. prioritize above-the-fold assets
7. reserve layout space for images and dynamic elements
8. defer non-critical scripts where safe
9. preserve required interactions and animations
10. re-test under comparable conditions
11. report both improvements and regressions
12. validate real customer flows before calling the work complete

For WooCommerce, extend that validation to:

- product pages
- add to cart
- mini-cart/cart
- checkout
- payment gateways
- customer account
- search and filters
- analytics and consent tooling

---

## 12. Result summary

The optimized production site moved from:

- **GTmetrix E → A**
- **Performance 33% → 92%**
- **Structure 87% → 98%**
- **LCP 7.6s → 1.3s**
- **TBT 543ms → 25ms**
- **CLS 0.04 → 0**

The strongest result is not the letter grade by itself.

It is that the project substantially improved rendering and blocking behavior **without treating the site's design and motion as disposable**.

---

## Related toolkit resources

- [Performance audit checklist](../docs/audit-checklist.md)
- [Core Web Vitals guide](../docs/core-web-vitals.md)
- [Caching strategy](../docs/caching-strategy.md)
- [Troubleshooting playbook](../docs/troubleshooting.md)
- [AHF Collection WooCommerce case study](ahf-collection-performance.md)
- [Case-study template](../examples/before-after-case-study.md)

---

## Author

**Engineer Ali Raza**  
WordPress & WooCommerce Developer · Web Performance Specialist

- Portfolio: https://engineeraliraza.site
- Agency: https://alirazasolutions.com
- Upwork: https://www.upwork.com/freelancers/engineeraliraza
