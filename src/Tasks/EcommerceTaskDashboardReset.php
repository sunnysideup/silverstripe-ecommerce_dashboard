<?php

declare(strict_types=1);

namespace Sunnysideup\EcommerceDashboard\Tasks;

use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\DB;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Adds all members, who have bought something, to the customer group.
 *
 * @author: Nicolaas [at] Sunny Side Up .co.nz
 * @package: ecommerce
 * @sub-package: tasks
 * @inspiration: Silverstripe Ltd, Jeremy
 */
class EcommerceTaskDashboardReset extends BuildTask
{
    protected string $title = 'Reset all dashboard settings';

    private static $segment = 'ecommerce-dashboard-reset';

    protected static string $description = 'Resets all data set for the dashboard customisation.  There is NO undo!';

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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($this->tables as $table) {
            $output->writeln('deleting ' . $table);
            DB::query('DELETE FROM ' . $table . ';');
        }

        $output->writeln('------------------ END ------------------');
        return Command::SUCCESS;
    }
}
