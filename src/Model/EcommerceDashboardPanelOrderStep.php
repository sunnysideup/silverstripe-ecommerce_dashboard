<?php

namespace Sunnysideup\EcommerceDashboard\Model;

use SilverStripe\Forms\HiddenField;
use SilverStripe\ORM\FieldType\DBField;
use Sunnysideup\Ecommerce\Model\Order;
use Sunnysideup\Ecommerce\Model\Process\OrderStep;

class EcommerceDashboardPanelOrderStep extends EcommerceDashboardPanel
{
    private static $icon = 'sunnysideup/ecommerce_dashboard: client/images/icons/EcommerceDashboardPanel_OrderStep.png';

    private static $table_name = 'EcommerceDashboardPanelOrderStep';

    public function getLabelPrefix()
    {
        return 'Order Journey';
    }

    public function getConfiguration()
    {
        $fields = parent::getConfiguration();
        $fields->replaceField('DaysBack', HiddenField::create('DaysBack', 'DaysBack'));
        return $fields;
    }

    public function Content()
    {
        $html = '';
        $orderSteps = OrderStep::get()->limit(OrderStep::get()->count() - 1);
        $html = '<ul>';
        $done = false;
        foreach ($orderSteps as $orderStep) {
            $count = Order::get()
                ->filter(['StatusID' => $orderStep->ID, 'CancelledByID' => 0])
                ->count();
            if ($count > 0) {
                $done = true;
                $html .= '<li><strong>' . $orderStep->Title . '</strong>: <span>' . $count . '</span><em>' . $orderStep->Description . '</em></li>';
            }
        }
        if ($done === false) {
            $html .= '<li>All orders have been archived</li>';
        }
        $html .= '<ul>';

        return DBField::create_field(
            'HTMLText',
            $html
        );
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        $this->DaysBack = 0;
    }
}
