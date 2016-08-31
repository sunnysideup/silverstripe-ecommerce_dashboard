<?php

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
        "DashboardWeatherPanel"

    );

    public function run($request)
    {
        foreach($this->tables as $table) {
            DB::alteration_message('deleting '.$table, "deleted");
            DB::query('DELETE FROM '.$table.';');
        }
        DB::alteration_message('------------------ END ------------------');
    }
