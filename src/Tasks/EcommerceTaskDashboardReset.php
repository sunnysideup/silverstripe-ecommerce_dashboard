<?php

namespace Sunnysideup\EcommerceDashboard\Tasks;

use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\DB;

/**
 * Adds all members, who have bought something, to the customer group.
 *
 * @authors: Nicolaas [at] Sunny Side Up .co.nz
 * @package: ecommerce
 * @sub-package: tasks
 * @inspiration: Silverstripe Ltd, Jeremy
 */
class EcommerceTaskDashboardReset extends BuildTask
{
    protected $title = 'Reset all dashboard settings';

    protected $description = 'Resets all data set for the dashboard customisation.  There is NO undo!';

    protected $tables = [
        'DashboardBlogEntryPanel',
        'DashboardGoogleAnalyticsPanel',
        'DashboardGridFieldPanel',
        'DashboardModelAdminPanel',
        'DashboardPanel',
        'DashboardPanelDataObject',
        'DashboardQuickLink',
        'DashboardRecentEditsPanel',
        'DashboardRecentFilesPanel',
        'DashboardRSSFeedPanel',
        'DashboardSectionEditorPanel',
        'DashboardWeatherPanel',
        'EcommerceDashboardPanel',
        'EcommerceDashboardPanelFavouriteProducts',
        'EcommerceDashboardPanelLatestOrders',
        'EcommerceDashboardPanelOrderCount',
        'EcommerceDashboardPanelSearchHistory',
    ];

    public function run($request)
    {
        foreach ($this->tables as $table) {
            DB::alteration_message('deleting ' . $table, 'deleted');
            DB::query('DELETE FROM ' . $table . ';');
        }
        DB::alteration_message('------------------ END ------------------');
    }
}
