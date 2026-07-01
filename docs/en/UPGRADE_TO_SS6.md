# Upgrade to Silverstripe 6: Changelog

This document outlines the necessary changes to upgrade your project to be compatible with `sunnysideup/ecommerce_dashboard` for Silverstripe 6.

## 🚨 CRITICAL REVIEW REQUIRED / RISKY

**This upgrade appears to be incomplete. Several dependencies have not been updated to a compatible stable release. You must manually review and resolve these before your project will work.**

-   **`sunnysideup/dashboard`**: Not updated. Current version is `^5.0-dev`. **Reason: No compatible stable release.**
-   **`sunnysideup/dashboardmods`**: Not updated. Current version is `^5.0-dev`. **Reason: No compatible stable release.**

You will need to find compatible versions for these packages or alternative solutions.

---

## ⚠️ BREAKING CHANGES

### New Requirements

-   **Silverstripe CMS:** Now requires `^6.0`.
-   **`sunnysideup/ecommerce`:** Now requires `^33.0`.

### Configuration

-   In your YAML configuration (`database.legacy.yml`), the deprecated `SilverStripe\ORM\DatabaseAdmin` has been replaced with `SilverStripe\Dev\DbBuild`. Update any classname remappings accordingly.

### API & Class Changes

-   **`EcommerceDashboard`:**
    -   The static property `$tree_class` has been renamed to `$model_class`.

-   **`EcommerceTaskDashboardReset`:**
    -   The `run()` method has been replaced with the `execute(InputInterface $input, OutputInterface $output)` method to align with the new `BuildTask` API in Silverstripe 6.
    -   `$title` and `$description` properties are now strongly typed (`string`).
    -   Output messages now use `$output->writeln()` instead of `DB::alteration_message()`.

-   **Removed `parent::onBeforeWrite()` calls:**
    -   Calls to `parent::onBeforeWrite()` have been removed from `EcommerceDashboardPanelLatestOrders` and `EcommerceDashboardPanelOrderStep`. Review these models if you have extended them to ensure no required logic was removed.

### Namespace & Class Updates

-   The following classes have been updated to their new namespaces:
    -   `SilverStripe\ORM\ArrayList` -> `SilverStripe\Model\List\ArrayList`
    -   `SilverStripe\ORM\Map` -> `SilverStripe\Model\List\Map`

-   The `DataObject` import has been removed from `EcommerceDashboardPanel.php`.

-   **`EcommerceDashboardPanel::openOrders()`**:
    -   The method now retrieves the first `OrderStep` using `OrderStep::get()->setUseCache(true)->first()` instead of `DataObject::get_one(OrderStep::class)`.

---

## New Features & Minor Changes

-   **PHP 8 Attributes:** The `#[Override]` attribute has been added to several methods in `EcommerceDashboardPanel` subclasses. This improves code clarity but does not change functionality.
