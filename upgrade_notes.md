2020-07-07 12:53

# running php upgrade upgrade see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/upgrades/ecommerce_dashboard
php /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/bin/upgrade-code upgrade /var/www/upgrades/ecommerce_dashboard/ecommerce_dashboard  --root-dir=/var/www/upgrades/ecommerce_dashboard --write -vvv
Array
(
    [0] => PHP Fatal error:  Uncaught TypeError: Argument 2 passed to SilverStripe\Upgrader\Util\ConfigFile::mergeConfig() must be of the type array, null given, called in /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/src/Util/ConfigFile.php on line 47 and defined in /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/src/Util/ConfigFile.php:65
    [1] => Stack trace:
    [2] => #0 /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/src/Util/ConfigFile.php(47): SilverStripe\Upgrader\Util\ConfigFile::mergeConfig(Array, NULL)
    [3] => #1 /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/src/Console/ConfigurableCommandTrait.php(21): SilverStripe\Upgrader\Util\ConfigFile::loadCombinedConfig('/var/www/upgrad...')
    [4] => #2 /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/src/Console/UpgradeCommand.php(76): SilverStripe\Upgrader\Console\UpgradeCommand->getConfig('/var/www/upgrad...')
    [5] => #3 /var/www/upgrades/upgrader_tool/vendor/symfony/console/Command/Command.php(255): SilverStripe\Upgrader\Console\UpgradeCommand->execute(Object in /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/src/Util/ConfigFile.php on line 65
)


------------------------------------------------------------------------
To continue, please use the following parameter: startFrom=Upgrade
e.g. php runme.php startFrom=Upgrade
------------------------------------------------------------------------
            
# running php upgrade upgrade see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/upgrades/ecommerce_dashboard
php /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/bin/upgrade-code upgrade /var/www/upgrades/ecommerce_dashboard/ecommerce_dashboard  --root-dir=/var/www/upgrades/ecommerce_dashboard --write -vvv
Array
(
    [0] => PHP Fatal error:  Uncaught TypeError: Argument 2 passed to SilverStripe\Upgrader\Util\ConfigFile::mergeConfig() must be of the type array, null given, called in /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/src/Util/ConfigFile.php on line 47 and defined in /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/src/Util/ConfigFile.php:65
    [1] => Stack trace:
    [2] => #0 /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/src/Util/ConfigFile.php(47): SilverStripe\Upgrader\Util\ConfigFile::mergeConfig(Array, NULL)
    [3] => #1 /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/src/Console/ConfigurableCommandTrait.php(21): SilverStripe\Upgrader\Util\ConfigFile::loadCombinedConfig('/var/www/upgrad...')
    [4] => #2 /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/src/Console/UpgradeCommand.php(76): SilverStripe\Upgrader\Console\UpgradeCommand->getConfig('/var/www/upgrad...')
    [5] => #3 /var/www/upgrades/upgrader_tool/vendor/symfony/console/Command/Command.php(255): SilverStripe\Upgrader\Console\UpgradeCommand->execute(Object in /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/src/Util/ConfigFile.php on line 65
)


------------------------------------------------------------------------
To continue, please use the following parameter: startFrom=Upgrade
e.g. php runme.php startFrom=Upgrade
------------------------------------------------------------------------
            
# running php upgrade upgrade see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/upgrades/ecommerce_dashboard
php /var/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/bin/upgrade-code upgrade /var/www/upgrades/ecommerce_dashboard/ecommerce_dashboard  --root-dir=/var/www/upgrades/ecommerce_dashboard --write -vvv
Writing changes for 13 files
Running upgrades on "/var/www/upgrades/ecommerce_dashboard/ecommerce_dashboard"
[2020-07-07 12:59:05] Applying RenameClasses to _config.php...
[2020-07-07 12:59:05] Applying ClassToTraitRule to _config.php...
[2020-07-07 12:59:05] Applying UpdateConfigClasses to config.yml...
[2020-07-07 12:59:05] Applying RenameClasses to EcommerceDashboardTest.php...
[2020-07-07 12:59:05] Applying ClassToTraitRule to EcommerceDashboardTest.php...
[2020-07-07 12:59:05] Applying RenameClasses to EcommerceTaskDashboardReset.php...
[2020-07-07 12:59:05] Applying ClassToTraitRule to EcommerceTaskDashboardReset.php...
[2020-07-07 12:59:05] Applying RenameClasses to EcommerceDashboardPanel_FavouriteProducts.php...
[2020-07-07 12:59:05] Applying ClassToTraitRule to EcommerceDashboardPanel_FavouriteProducts.php...
[2020-07-07 12:59:05] Applying RenameClasses to EcommerceDashboardPanel_LatestOrders.php...
[2020-07-07 12:59:05] Applying ClassToTraitRule to EcommerceDashboardPanel_LatestOrders.php...
[2020-07-07 12:59:05] Applying RenameClasses to EcommerceDashboardPanel_OrderStep.php...
[2020-07-07 12:59:05] Applying ClassToTraitRule to EcommerceDashboardPanel_OrderStep.php...
[2020-07-07 12:59:05] Applying RenameClasses to EcommerceDashboardPanel_OrderCount.php...
[2020-07-07 12:59:05] Applying ClassToTraitRule to EcommerceDashboardPanel_OrderCount.php...
[2020-07-07 12:59:05] Applying RenameClasses to EcommerceDashboardPanel_OrderSteps.php...
[2020-07-07 12:59:05] Applying ClassToTraitRule to EcommerceDashboardPanel_OrderSteps.php...
[2020-07-07 12:59:05] Applying RenameClasses to EcommerceDashboardPanel_SearchHistory.php...
[2020-07-07 12:59:05] Applying ClassToTraitRule to EcommerceDashboardPanel_SearchHistory.php...
[2020-07-07 12:59:05] Applying RenameClasses to EcommerceDashboardPanel_IncompletePayments.php...
[2020-07-07 12:59:05] Applying ClassToTraitRule to EcommerceDashboardPanel_IncompletePayments.php...
[2020-07-07 12:59:05] Applying RenameClasses to EcommerceDashboardPanel.php...
[2020-07-07 12:59:05] Applying ClassToTraitRule to EcommerceDashboardPanel.php...
[2020-07-07 12:59:05] Applying RenameClasses to EcommerceDashboard.php...
[2020-07-07 12:59:05] Applying ClassToTraitRule to EcommerceDashboard.php...
modified:	_config.php
@@ -1,4 +1,6 @@
 <?php
+
+use SilverStripe\Admin\CMSMenu;


 CMSMenu::remove_menu_item('Dashboard');

modified:	_config/config.yml
@@ -6,22 +6,17 @@
    - 'dashboard/*'
    - 'ecommerce/*'
 ---
-
 SilverStripe\Admin\LeftAndMain:
   extra_requirements_css:
-   - 'ecommerce_dashboard/css/ecommercedashboard.css'
-
-AdminRootController:
-  default_panel: 'CMSMain'
-
-
-EcommerceRole:
+    - ecommerce_dashboard/css/ecommercedashboard.css
+SilverStripe\Admin\AdminRootController:
+  default_panel: SilverStripe\CMS\Controllers\CMSMain
+Sunnysideup\Ecommerce\Model\Extensions\EcommerceRole:
   admin_role_permission_codes:
     - CMS_ACCESS_Dashboard
     - CMS_ACCESS_DashboardAddPanels
     - CMS_ACCESS_DashboardConfigurePanels
     - CMS_ACCESS_DashboardDeletePanels
-
 ---
 Only:
   moduleexists: 'grouped-cms-menu'
@@ -29,5 +24,5 @@
 SilverStripe\Admin\LeftAndMain:
   menu_groups:
     Shop:
-      - EcommerceDashboard
+      - Sunnysideup\EcommerceDashboard\EcommerceDashboard


modified:	tests/EcommerceDashboardTest.php
@@ -1,4 +1,6 @@
 <?php
+
+use SilverStripe\Dev\SapphireTest;

 class EcommerceDashboardTest extends SapphireTest
 {

modified:	src/Tasks/EcommerceTaskDashboardReset.php
@@ -2,8 +2,16 @@

 namespace Sunnysideup\EcommerceDashboard\Tasks;

-use BuildTask;
-use DB;
+
+
+use Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel;
+use Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel_FavouriteProducts;
+use Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel_LatestOrders;
+use Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel_OrderCount;
+use Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel_SearchHistory;
+use SilverStripe\ORM\DB;
+use SilverStripe\Dev\BuildTask;
+


 /**
@@ -33,11 +41,11 @@
         "DashboardRSSFeedPanel",
         "DashboardSectionEditorPanel",
         "DashboardWeatherPanel",
-        "EcommerceDashboardPanel",
-        "EcommerceDashboardPanel_FavouriteProducts",
-        "EcommerceDashboardPanel_LatestOrders",
-        "EcommerceDashboardPanel_OrderCount",
-        "EcommerceDashboardPanel_SearchHistory"
+        EcommerceDashboardPanel::class,
+        EcommerceDashboardPanel_FavouriteProducts::class,
+        EcommerceDashboardPanel_LatestOrders::class,
+        EcommerceDashboardPanel_OrderCount::class,
+        EcommerceDashboardPanel_SearchHistory::class
     );

     public function run($request)

modified:	src/Model/EcommerceDashboardPanel_FavouriteProducts.php
@@ -2,7 +2,9 @@

 namespace Sunnysideup\EcommerceDashboard\Model;

-use NumericField;
+
+use SilverStripe\Forms\NumericField;
+


 class EcommerceDashboardPanel_FavouriteProducts extends EcommerceDashboardPanel

Warnings for src/Model/EcommerceDashboardPanel_FavouriteProducts.php:
 - src/Model/EcommerceDashboardPanel_FavouriteProducts.php:100 PhpParser\Node\Expr\Variable
 - WARNING: New class instantiated by a dynamic value on line 100

modified:	src/Model/EcommerceDashboardPanel_LatestOrders.php
@@ -2,10 +2,15 @@

 namespace Sunnysideup\EcommerceDashboard\Model;

-use NumericField;
-use EcommerceCurrency;
-use SS_Map;
-use DropdownField;
+
+
+
+
+use Sunnysideup\Ecommerce\Model\Money\EcommerceCurrency;
+use SilverStripe\Forms\NumericField;
+use SilverStripe\ORM\Map;
+use SilverStripe\Forms\DropdownField;
+


 class EcommerceDashboardPanel_LatestOrders extends EcommerceDashboardPanel
@@ -31,7 +36,7 @@
     );

     private static $has_one = array(
-        'EcommerceCurrency' => 'EcommerceCurrency'
+        'EcommerceCurrency' => EcommerceCurrency::class
     );

     private static $defaults = array(
@@ -68,7 +73,7 @@
             )
         );
         $map = EcommerceCurrency::get()->map();
-        if ($map instanceof SS_Map) {
+        if ($map instanceof Map) {
             $fields->replaceField(
                 'DaysBack',
                 DropdownField::create(

modified:	src/Model/EcommerceDashboardPanel_OrderStep.php
@@ -2,9 +2,13 @@

 namespace Sunnysideup\EcommerceDashboard\Model;

-use HiddenField;
-use OrderStep;
-use Order;
+
+
+
+use SilverStripe\Forms\HiddenField;
+use Sunnysideup\Ecommerce\Model\Process\OrderStep;
+use Sunnysideup\Ecommerce\Model\Order;
+


 class EcommerceDashboardPanel_OrderStep extends EcommerceDashboardPanel

modified:	src/Model/EcommerceDashboardPanel_OrderCount.php
@@ -2,9 +2,13 @@

 namespace Sunnysideup\EcommerceDashboard\Model;

-use DropdownField;
-use EcommerceCurrency;
-use DBField;
+
+
+
+use Sunnysideup\Ecommerce\Model\Money\EcommerceCurrency;
+use SilverStripe\Forms\DropdownField;
+use SilverStripe\ORM\FieldType\DBField;
+


 class EcommerceDashboardPanel_OrderCount extends EcommerceDashboardPanel
@@ -12,7 +16,7 @@
     private static $icon = "ecommerce_dashboard/images/icons/EcommerceDashboardPanel_OrderCount.png";

     private static $has_one = array(
-        'EcommerceCurrency' => 'EcommerceCurrency'
+        'EcommerceCurrency' => EcommerceCurrency::class
     );

     public function getLabelPrefix()

modified:	src/Model/EcommerceDashboardPanel_OrderSteps.php
@@ -2,9 +2,13 @@

 namespace Sunnysideup\EcommerceDashboard\Model;

-use HiddenField;
-use OrderStep;
-use Order;
+
+
+
+use SilverStripe\Forms\HiddenField;
+use Sunnysideup\Ecommerce\Model\Process\OrderStep;
+use Sunnysideup\Ecommerce\Model\Order;
+


 class EcommerceDashboardPanel_OrderStep extends EcommerceDashboardPanel

modified:	src/Model/EcommerceDashboardPanel_SearchHistory.php
@@ -2,8 +2,12 @@

 namespace Sunnysideup\EcommerceDashboard\Model;

-use NumericField;
-use EcommerceSearchHistoryFormField;
+
+
+use SilverStripe\Forms\NumericField;
+use Sunnysideup\Ecommerce\Model\Search\SearchHistory;
+use Sunnysideup\Ecommerce\Forms\Fields\EcommerceSearchHistoryFormField;
+



@@ -56,7 +60,7 @@

     public function Content()
     {
-        $field = EcommerceSearchHistoryFormField::create('SearchHistory', 'Search Favourites')
+        $field = EcommerceSearchHistoryFormField::create(SearchHistory::class, 'Search Favourites')
             ->setNumberOfDays($this->DaysBack ? $this->DaysBack : $this->Config()->defaults['DaysBack'])
             ->setMaxRows(($this->MaxRows ? $this->MaxRows : $this->Config()->defaults['MaxRows']))
             ->setShowMoreLink(false)

modified:	src/Model/EcommerceDashboardPanel_IncompletePayments.php
@@ -2,7 +2,9 @@

 namespace Sunnysideup\EcommerceDashboard\Model;

-use EcommercePayment;
+
+use Sunnysideup\Ecommerce\Model\Money\EcommercePayment;
+




modified:	src/Model/EcommerceDashboardPanel.php
@@ -3,15 +3,27 @@
 namespace Sunnysideup\EcommerceDashboard\Model;

 use DashboardPanel;
-use NumericField;
-use ReadonlyField;
-use DataObject;
-use Order;
-use EcommerceConfig;
-use OrderStep;
-use Injector;
-use EcommerceRole;
-use Config;
+
+
+
+
+
+
+
+
+
+use SilverStripe\Forms\NumericField;
+use SilverStripe\Forms\ReadonlyField;
+use Sunnysideup\Ecommerce\Model\Process\OrderStep;
+use SilverStripe\ORM\DataObject;
+use Sunnysideup\Ecommerce\Model\Order;
+use Sunnysideup\Ecommerce\Model\Process\OrderStatusLog;
+use Sunnysideup\Ecommerce\Config\EcommerceConfig;
+use SilverStripe\Core\Injector\Injector;
+use Sunnysideup\EcommerceDashboard\EcommerceDashboard;
+use Sunnysideup\Ecommerce\Model\Extensions\EcommerceRole;
+use SilverStripe\Core\Config\Config;
+


 class EcommerceDashboardPanel extends DashboardPanel
@@ -103,9 +115,9 @@
      */
     protected function openOrders($numberOfDaysBack = 7)
     {
-        $firstStep = DataObject::get_one('OrderStep');
+        $firstStep = DataObject::get_one(OrderStep::class);
         $orders = Order::get()
-            ->LeftJoin('OrderStatusLog', '"Order"."ID" = "OrderStatusLog"."OrderID"')
+            ->LeftJoin(OrderStatusLog::class, '"Order"."ID" = "OrderStatusLog"."OrderID"')
             ->LeftJoin($submittedOrderStatusLogClassName, '"OrderStatusLog"."ID" = "'.$submittedOrderStatusLogClassName.'"."ID"')
             ->filter(array('StatusID' => $firstStep->ID))
             ->exclude(array('MemberID' => $this->excludedMembers()));
@@ -135,10 +147,10 @@
      */
     protected function archivedOrders($numberOfDaysBack = 0)
     {
-        $submittedOrderStatusLogClassName = EcommerceConfig::get('OrderStatusLog', 'order_status_log_class_used_for_submitting_order');
+        $submittedOrderStatusLogClassName = EcommerceConfig::get(OrderStatusLog::class, 'order_status_log_class_used_for_submitting_order');
         $lastStep = OrderStep::last_order_step();
         return Order::get()
-            ->LeftJoin('OrderStatusLog', '"Order"."ID" = "OrderStatusLog"."OrderID"')
+            ->LeftJoin(OrderStatusLog::class, '"Order"."ID" = "OrderStatusLog"."OrderID"')
             ->LeftJoin($submittedOrderStatusLogClassName, '"OrderStatusLog"."ID" = "'.$submittedOrderStatusLogClassName.'"."ID"')
             ->filter(array('StatusID' => $lastStep->ID))
             ->exclude(array('MemberID' => $this->excludedMembersArray()))
@@ -155,7 +167,7 @@
      */
     public function getDashboard()
     {
-        return Injector::inst()->get("EcommerceDashboard");
+        return Injector::inst()->get(EcommerceDashboard::class);
     }

     /**

modified:	src/EcommerceDashboard.php
@@ -3,8 +3,11 @@
 namespace Sunnysideup\EcommerceDashboard;

 use Dashboard;
-use ArrayList;
-use EcommerceDashboardPanel;
+
+
+use Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel;
+use SilverStripe\ORM\ArrayList;
+



@@ -20,7 +23,7 @@

     private static $menu_icon = "dashboard/images/dashboard.png";

-    private static $tree_class = 'EcommerceDashboardPanel';
+    private static $tree_class = EcommerceDashboardPanel::class;

     /**
      * Gets all the available panels that can be installed on the dashboard. All subclasses of
@@ -35,7 +38,7 @@
         foreach ($panels as $panel) {
             if ($panel instanceof EcommerceDashboardPanel) {
                 if ($panel->registered()) {
-                    if ($panel->ClassName !== 'EcommerceDashboardPanel') {
+                    if ($panel->ClassName !== EcommerceDashboardPanel::class) {
                         $al->push($panel);
                     }
                 }

Writing changes for 13 files
✔✔✔