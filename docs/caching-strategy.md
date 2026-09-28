# WooCommerce Caching Strategy

Caching can produce major gains, but WooCommerce contains personalized and transactional state. Treat cache configuration as architecture, not as a checkbox.

## Layers

A store may use several layers:

1. browser cache
2. CDN/edge cache
3. full-page cache
4. PHP opcode cache
5. persistent object cache
6. database/query cache behavior
7. application-level transients

Each layer solves a different problem.

## Public page caching

Good candidates commonly include:

- homepage
- blog/content
- public landing pages
- many shop/category pages
- many product pages

Whether a page is safe to cache depends on the site's extensions and personalization.

## Dynamic areas

Use extra caution around:

- cart
- checkout
- My Account
- logged-in sessions
- customer-specific pricing
- geolocation/currency
- membership/subscription content
- recently viewed/personalized blocks
- payment callbacks
- AJAX and REST requests

Configure exclusions in the actual cache/CDN/host layer whenever possible.

## Object caching

Persistent object caching can reduce repeated database work when implemented correctly.

Before enabling or blaming it, inspect:

- cache hit rate
- network latency to the cache service
- object sizes
- key churn
- plugin compatibility
- eviction behavior

An object cache is not automatically beneficial on every small store.

## Cache invalidation

WooCommerce content changes frequently.

Test invalidation after:

- product update
- stock update
- price change
- sale start/end
- category change
- order affecting stock
- content/template update

Stale product price or stock is worse than a small performance gain.

## CDN

A CDN helps most with static assets and may also support HTML edge caching.

Check:

- correct cache headers
- image optimization behavior
- Brotli/compression
- HTTP protocol
- origin shielding if available
- purge behavior
- cookie bypass rules

Do not cache authenticated/customer-specific HTML at the edge unless the setup explicitly supports it.

## Validation checklist

After cache changes:

- open incognito session
- add a product to cart
- change quantity
- remove product
- apply coupon
- calculate shipping
- run guest checkout
- run account checkout where relevant
- verify order totals
- verify login/account
- verify stock and price updates
- verify cache purge

## Rule of thumb

Cache the stable public shell aggressively; preserve correctness wherever the experience becomes customer-specific or transactional.
