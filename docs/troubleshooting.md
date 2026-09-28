# Troubleshooting Playbook

This playbook is for cases where a WooCommerce store is slow, unstable, or becomes broken after optimization.

## Symptom: slow first response

Investigate:

- hosting/origin latency
- PHP workers
- uncached dynamic processing
- slow external HTTP calls
- database queries
- object cache
- cron/scheduled actions
- plugins executing on every request

Do not start with image compression if the HTML document itself is slow.

## Symptom: good TTFB, slow LCP

Investigate:

- LCP resource discovery
- image size
- render-blocking CSS
- font loading
- slider initialization
- JavaScript-delayed rendering
- incorrect lazy-loading

## Symptom: poor INP / delayed clicks

Investigate:

- long tasks
- third-party JavaScript
- filter plugins
- variation scripts
- oversized DOM
- event listeners
- layout thrashing

Test interactions that customers actually use.

## Symptom: layout jumps

Inspect:

- missing width/height
- product gallery initialization
- fonts
- banners/notices
- dynamic reviews
- recommendation widgets
- variation/price containers

Use the browser's layout shift tooling to identify the moving nodes.

## Symptom: cart stops updating

Immediately review recent changes involving:

- script dequeuing
- AJAX
- fragments
- cache exclusions
- nonce handling
- optimization/minification
- deferred scripts

Revert the smallest recent change first.

## Symptom: checkout breaks only for some users

Compare:

- guest vs logged in
- payment gateway
- shipping method
- currency/location
- device/browser
- consent state
- cache state

WooCommerce checkout is an integration surface, so reproduce the exact affected combination.

## Symptom: performance plugin causes visual bugs

Disable optimization categories one at a time:

1. JS delay/defer
2. JS combine/minify
3. CSS async/unused CSS
4. HTML minify
5. lazy loading
6. CDN rewrites

Avoid changing six toggles simultaneously because you lose causal information.

## Symptom: admin is slow

Inspect:

- scheduled actions
- plugin dashboards
- external API calls
- autoloaded options
- database indexes
- order storage mode and compatibility
- product counts
- log table growth

Public page caching will not fix wp-admin bottlenecks.

## Recovery discipline

When production breaks:

1. restore buying functionality first
2. revert the smallest suspected change
3. clear only relevant caches
4. reproduce
5. inspect logs
6. document the cause
7. reintroduce a safer fix on staging
