<?php

namespace Sunnysideup\EcommerceDashboard\Model;

use SilverStripe\Forms\FieldList;
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

    public function getConfigurationFields(): FieldList
    {
        $fields = parent::getConfigurationFields();
        $fields->replaceField('DaysBack', HiddenField::create('DaysBack', 'DaysBack'));

        return $fields;
    }

    public function Content()
    {
        //not the last one!
        $orderSteps = OrderStep::get()->limit(OrderStep::get()->count() - 1);
        $html = '<ul>';
        $done = false;
        foreach ($orderSteps as $orderStep) {
            $count = Order::get()
                ->filter([
                    'StatusID' => $orderStep->ID,
                    'CancelledByID' => 0,
                ])
                ->count()
            ;
            if ($count > 0) {
                $done = true;
                $html .= '<li><strong>' . $orderStep->Title . '</strong>: <span>' . $count . '</span> <em>' . $orderStep->Description . '</em></li>';
            }
        }
        if (false === $done) {
            $html .= '<li>All orders have been archived</li>';
        }
        $html .= '<ul>';

        return DBField::create_field(
            'HTMLText',
            $html
        );
    }

    protected function onBeforeWrite()
    {
        parent::onBeforeWrite();
        $this->DaysBack = 0;
    }
}
