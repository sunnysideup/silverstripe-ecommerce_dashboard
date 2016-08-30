<?php


class EcommerceDashboard extends Dashboard
{


    private static $menu_title = "Dashboard";



    private static $url_segment = "ecom-dashboard";



    private static $menu_priority = 99999999;



    private static $url_priority = 30;



    private static $menu_icon = "dashboard/images/dashboard.png";


    private static $tree_class = 'EcommerceDashboardPanel';

    /**
     * Gets all the available panels that can be installed on the dashboard. All subclasses of
     * {@link DashboardPanel} are included
     *
     * @return ArrayList
     */
    public function AllPanels() {
        $panels = parent::AllPanels();
        $al = ArrayList::create();
        foreach($panels as $panel) {
            if($panel instanceof EcommerceDashboardPanel) {
                if($panel->registered()) {
                    if($panel->ClassName !== 'EcommerceDashboardPanel') {
                        $al->push($panel);
                    }
                }
            }
        }
        return $al;
    }



}
