<?php

namespace Sunnysideup\EcommerceDashboard\Tasks;



use Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel;
use Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel_FavouriteProducts;
use Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel_LatestOrders;
use Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel_OrderCount;
use Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel_SearchHistory;
use SilverStripe\ORM\DB;
use SilverStripe\Dev\BuildTask;



/**
 * Adds all members, who have bought something, to the customer group.
 *
 * @authors: Nicolaas [at] Sunny Side Up .co.nz
 * @package: ecommerce
 * @sub-package: tasks
 * @inspiration: Silverstripe Ltd, Jeremy
 **/
class EcommerceTaskDashboardReset extends BuildTask
{
    protected $title = 'Reset all dashboard settings';

    protected $description = 'Resets all data set for the dashboard customisation.  There is NO undo!';

    protected $tables = array(
        "DashboardBlogEntryPanel",
        "DashboardGoogleAnalyticsPanel",
        "DashboardGridFieldPanel",
        "DashboardModelAdminPanel",
        "DashboardPanel",
        "DashboardPanelDataObject",
        "DashboardQuickLink",
        "DashboardRecentEditsPanel",
        "DashboardRecentFilesPanel",
        "DashboardRSSFeedPanel",
        "DashboardSectionEditorPanel",
        "DashboardWeatherPanel",
        EcommerceDashboardPanel::class,
        EcommerceDashboardPanel_FavouriteProducts::class,
        EcommerceDashboardPanel_LatestOrders::class,
        EcommerceDashboardPanel_OrderCount::class,
        EcommerceDashboardPanel_SearchHistory::class
    );

    public function run($request)
    {
        foreach ($this->tables as $table) {
            DB::alteration_message('deleting '.$table, "deleted");
            DB::query('DELETE FROM '.$table.';');
        }
        DB::alteration_message('------------------ END ------------------');
    }
}

