<?php

class EcommerceDashboardPanel_LatestOrders extends EcommerceDashboardPanel
{

    private static $icon = "ecommerce_dashboard/images/icons/EcommerceDashboardPanel_LatestOrders.png";

    private static $db = array(
        'NumberOfOrdersToShow' => 'Int'
    );

    private static $has_one = array(
        'EcommerceCurrency' => 'EcommerceCurrency'
    );

    private static $defaults = array(
        'NumberOfOrdersToShow' => 7
    );

    function getLabelPrefix()
    {
        $currencyStatement = '';
        if($currency = $this->EcommerceCurrency()) {
            if($currency->exists()) {
                $currencyStatement = ", in ".$currency->Code.".";
            }
        }
        return 'Last '.($this->NumberOfOrdersToShow ? $this->NumberOfOrdersToShow : $this->Config()->defaults['NumberOfOrdersToShow']).' Orders'.$currencyStatement;
    }

    public function getConfiguration()
    {
        $fields = parent::getConfiguration();
        $fields->push(
            NumericField::create(
                "NumberOfOrdersToShow",
                "Number of orders to show"
            )
        );
        $fields->replaceField(
            'DaysBack',
            DropdownField::create(
                "EcommerceCurrencyID",
                "Currency",
                EcommerceCurrency::get()->map()
            )
        );

        return $fields;
    }

    public function Content()
    {
        $submittedOrders = $this->submittedOrders();
        $submittedOrders = $submittedOrders
            ->filter(array('CurrencyUsedID' => $this->EcommerceCurrencyID))
            ->limit(($this->NumberOfOrdersToShow ? $this->NumberOfOrdersToShow : $this->Config()->defaults['NumberOfOrdersToShow']));
        $html = '
            <ul>';
        if($submittedOrders->count()) {
            foreach($submittedOrders as $order) {
                $html .= '
                <li>
                    <a href="'.$order->CMSEditLink().'">#'.$order->ID.', '.$order->getTotalAsMoney()->Nice().', '.$order->Member()->Email.', &raquo; '.$order->Status()->Title.'</a>
                </li>';
            }
        } else {
            $html .= '
            <li>
                There are no recent orders.
            </li>';

        }


        $html .= '
            </ul>';

        return $html;
    }

    function onBeforeWrite()
    {
        parent::onBeforeWrite();
        $this->DaysBack = 0;
    }
}
