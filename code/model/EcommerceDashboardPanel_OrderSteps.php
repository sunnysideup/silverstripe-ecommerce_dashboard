<?php

class EcommerceDashboardPanel_OrderStep extends EcommerceDashboardPanel
{

    private static $icon = "ecommerce_dashboard/images/icons/EcommerceDashboardPanel_OrderCount.png";

    function getLabelPrefix()
    {
        return 'Orders Steps (orders that may need attention)';
    }

    public function getConfiguration()
    {
        $fields = parent::getConfiguration();
        $fields->replaceField('DaysBack', HiddenField::create('DaysBack','DaysBack'));
        return $fields;
    }

    public function Content()
    {
        $html = '';
        $orderSteps = OrderStep::get()->limit(OrderStep::get()->count()-1);
        $html = '<ul>';
        foreach($orderSteps as $orderStep){
            $count = Order::get()
                ->filter(array('StatusID' => $orderStep->ID, 'CancelledByID' => 0))
                ->count();
            if($count > 0) {
                $html .= '<li><strong>'.$orderStep->Title.'</strong>: <span>'.$count.'</span><em>'.$orderStep->Description.'</em></li>';
            }
        }
        $html .= '<ul>';
        return $html;
    }

    function onBeforeWrite()
    {
        parent::onBeforeWrite();
        $this->DaysBack = 0;
    }
}
