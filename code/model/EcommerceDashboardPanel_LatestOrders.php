<?php

class EcommerceDashboardPanel_LatestOrders extends EcommerceDashboardPanel
{

    private static $icon = "ecommerce_dashboard/images/icons/EcommerceDashboardPanel_LatestOrders.png";

    private static $has_one = array(
        'NumberOfOrdersToShow' => 'Int',
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
                $currencyStatement = ", in ".$currency->Code.', ';
            }
        }
        return 'Most Recent Orders'.$currencyStatement;
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
        $fields->push(
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
            ->limit($this->NumberOfOrdersToShow);
        $html = '
            <ul>';
        foreach($submittedOrders as $order) {
            $html .= '<li>
                <a href="'.$order->CMSEditLink().'">'.$order->getFullTitle().'</a>
            </li>';
        }


        $html .= '
            </ul>';

        return $html;
    }
}
