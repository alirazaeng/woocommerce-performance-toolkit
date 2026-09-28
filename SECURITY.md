# Security Policy

## Scope

This repository contains performance-oriented examples for WordPress and WooCommerce. Performance work can affect authentication, checkout, caching, customer sessions, and payment-related flows, so changes should be treated as production code.

## Do not commit secrets

Never commit:

- WordPress database credentials
- salts or authentication keys
- payment gateway credentials
- API tokens
- private keys
- customer exports
- production database dumps
- server access credentials

Use environment variables, deployment secrets, or host-provided secret storage.

## Safe testing

Before deploying an optimization:

1. Create a current backup.
2. Test on staging when possible.
3. Validate cart, checkout, account, and payment flows.
4. Test logged-in and logged-out behavior where relevant.
5. Confirm REST/AJAX requests still work.
6. Review PHP and browser logs.
7. Verify cache purging and cache exclusions.
8. Monitor after deployment.

## Reporting a security issue

Do not publish real credentials, vulnerable client URLs, customer data, or exploitation details in a public issue.

For sensitive reports, contact the maintainer privately through the professional contact details listed on the author's portfolio.

## Supported code

Examples in this repository are educational and implementation-oriented references. A snippet may require adaptation for a specific theme, extension stack, hosting environment, or WooCommerce version.
