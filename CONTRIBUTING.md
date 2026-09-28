# Contributing

Contributions should improve the repository's usefulness without encouraging unsafe copy-paste optimization.

## Development workflow

1. Create a focused branch from `main`.
2. Make one logical change.
3. Run the PHP coding standards check when PHP files change.
4. Update documentation when behavior or guidance changes.
5. Open a pull request with the problem, reasoning, risk, and validation steps.
6. Merge only after review and automated checks pass.

## Local PHP quality check

~~~bash
composer install
composer lint
~~~

The PHP examples are checked against WordPress Coding Standards.

## What belongs here

Useful contributions include:

- measurable WooCommerce performance diagnostics
- conservative frontend optimization patterns
- cache-safe guidance
- Core Web Vitals troubleshooting
- database diagnostics that do not destroy data
- regression-testing guidance
- sanitized case studies with real measurements

## What does not belong here

Avoid:

- invented benchmark claims
- client credentials or private data
- paid/proprietary plugin source
- destructive database cleanup snippets without safeguards
- global script/style removal without compatibility notes
- generic performance advice presented as universally safe

## Pull request expectations

A useful PR should explain:

- the bottleneck or problem
- why the change addresses it
- what could regress
- how the change was tested
- whether WooCommerce cart/checkout/account flows are affected

For code that changes runtime behavior, include enough context for another developer to understand when **not** to use it.

## Security

Do not open a public issue containing credentials, private client URLs, customer data, or exploit details. See [SECURITY.md](SECURITY.md).
