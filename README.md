# Commerce B2B Portal Demo

A small Drupal module that sketches the B2B portal landing page pattern discussed by Centarro. It provides:

- A gated portal route at `/b2b/portal`.
- A settings form for portal labels and support contact.
- A simple summary builder that can be extended to pull Commerce data.

## Requirements

- Drupal 10 or 11.

## Installation

1. Copy or clone this module into `modules/custom/commerce_b2b_portal_demo`.
2. Enable it: `drush en commerce_b2b_portal_demo`.
3. Visit `/b2b/portal` as a user with the `B2B Portal User` role.
4. Configure labels at `/admin/config/commerce/b2b-portal-demo`.

## Extending

Replace the placeholder values in `B2bPortalController` with Commerce order data or customer profile fields. The `PortalSummaryBuilder` keeps the formatting logic isolated so it can be reused by blocks or JSON endpoints later.

## Tests

Run QA locally:

```bash
composer install
composer lint
composer test
```
