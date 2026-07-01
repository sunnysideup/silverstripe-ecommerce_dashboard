<?php

namespace Sunnysideup\EcommerceDashboard;

use SilverStripe\Model\List\ArrayList;
use Sunnysideup\Dashboard\Dashboard;
use Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel;

/**
 * Class \Sunnysideup\EcommerceDashboard\EcommerceDashboard
 */
class EcommerceDashboard extends Dashboard
{
    private static $menu_title = 'Dashboard';

    private static $url_segment = 'ecom-dashboard';

    private static $menu_priority = 100;

    private static $url_priority = 30;

    private static $menu_icon = 'sunnysideup/dashboardmods: client/images/dashboard.png';

    private static $model_class = EcommerceDashboardPanel::class;

    /**
     * Gets all the available panels that can be installed on the dashboard. All subclasses of
     * {@link DashboardPanel} are included.
     */
    public function getAvailablePanels(): ArrayList
    {
        $panels = parent::getAvailablePanels();
        $al = ArrayList::create();
        foreach ($panels as $panel) {
            if ($panel instanceof EcommerceDashboardPanel && $panel->registered() && EcommerceDashboardPanel::class !== $panel->ClassName) {
                $al->push($panel);
            }
        }

        return $al;
    }
}
