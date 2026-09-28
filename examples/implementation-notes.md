# Implementation Notes Template

Use this file as a repeatable format for documenting real optimization work.

## Change

Short name:

Affected URLs/templates:

Date:

Environment:

## Problem

What user-visible or measurable problem exists?

## Evidence

Include:

- field data if available
- lab trace/screenshot references
- TTFB
- LCP element/resource
- long tasks
- layout-shift source
- relevant query/server evidence

## Root cause

State the technical cause without jumping directly to the solution.

## Proposed change

Describe the smallest change that addresses the root cause.

## Risk

What could break?

- cart
- checkout
- product gallery
- variation selection
- filters
- account
- analytics
- cache
- payment

## Validation

Before deployment:

- [ ] staging tested
- [ ] PHP logs checked
- [ ] browser console checked
- [ ] mobile checked
- [ ] desktop checked
- [ ] guest checked
- [ ] logged-in flow checked where relevant
- [ ] cart checked
- [ ] checkout checked
- [ ] payment path checked where possible

## Result

Before:

After:

Testing conditions:

## Decision

- [ ] keep
- [ ] adjust
- [ ] revert

## Follow-up

Document remaining bottlenecks rather than hiding them behind a headline score.
