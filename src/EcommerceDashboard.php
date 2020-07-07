<?php

namespace Sunnysideup\EcommerceDashboard;

use SilverStripe\ORM\ArrayList;
use Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel;
use UncleCheese\Dashboard\Dashboard;

class EcommerceDashboard extends Dashboard
{
    private static $menu_title = 'Dashboard';

    private static $url_segment = 'ecom-dashboard';

    private static $menu_priority = 100;

    private static $url_priority = 30;

    private static $menu_icon = 'sunnysideup/dashboardmods: client/images/dashboard.png';

    private static $tree_class = EcommerceDashboardPanel::class;

    /**
     * Gets all the available panels that can be installed on the dashboard. All subclasses of
     * {@link DashboardPanel} are included
     *
     * @return ArrayList
     */
    public function AllPanels()
    {
        $panels = parent::AllPanels();
        $al = ArrayList::create();
        foreach ($panels as $panel) {
            if ($panel instanceof EcommerceDashboardPanel) {
                if ($panel->registered()) {
                    if ($panel->ClassName !== EcommerceDashboardPanel::class) {
                        $al->push($panel);
                    }
                }
            }
        }
        return $al;
    }
}
