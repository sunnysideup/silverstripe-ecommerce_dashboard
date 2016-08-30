<?php

class EcommerceDashboardPanel_OrderStep extends EcommerceDashboardPanel
{

    private static $icon = "ecommerce_dashboard/images/icons/EcommerceDashboardPanel_OrderStep.png";

    function getLabelPrefix()
    {
        return 'Order Journey';
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
        $done = false;
        foreach($orderSteps as $orderStep){
            $count = Order::get()
                ->filter(array('StatusID' => $orderStep->ID, 'CancelledByID' => 0))
                ->count();
            if($count > 0) {
                $done = true;
                $html .= '<li><strong>'.$orderStep->Title.'</strong>: <span>'.$count.'</span><em>'.$orderStep->Description.'</em></li>';
            }
        }
        if($done === false) {
            $html .= '<li>All orders have been archived</li>'
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
