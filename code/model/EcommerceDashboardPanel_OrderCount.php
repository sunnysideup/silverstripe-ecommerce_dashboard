<?php

class EcommerceDashboardPanel_OrderCount extends EcommerceDashboardPanel
{

    private static $icon = "ecommerce_dashboard/images/icons/EcommerceDashboardPanel_OrderCount.png";

    private static $has_one = array(
        'EcommerceCurrency' => 'EcommerceCurrency'
    );

    function getLabelPrefix()
    {
        $currencyStatement = '';
        if($currency = $this->EcommerceCurrency()) {
            if($currency->exists()) {
                $currencyStatement = ", in ".$currency->Code.', ';
            }
        }
        return 'Orders Placed'.$currencyStatement;
    }


    public function getConfiguration()
    {
        $fields = parent::getConfiguration();
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
        $submittedOrders = $submittedOrders->filter(array('CurrencyUsedID' => $this->EcommerceCurrencyID));
        $count = $submittedOrders->count();
        $sum = 0;
        $itemCount = 0;
        $html = '
            <dl>';
        $html .= '
                <dt>Count of orders:</dt>
                <dd>'.$count.'</dd>';
        if($count < $this->maxOrdersForLoop() && $count > 0) {
            foreach($submittedOrders as $order) {
                $sum += $order->getSubTotal();
                $itemCount += $order->getTotalItemsTimesQuantity();
            }
            $sumDBField = DBField::create_field('Currency', $sum);
            $html .= '
                    <dt>Sum of sub-totals:</dt>
                    <dd>'.$sumDBField->Nice().'</dd>';
            $averagePerOrder =  ($sum / $count);
            $averagePerOrderDBField = DBField::create_field('Currency', $averagePerOrder);
            $html .= '
                    <dt>Average sub-total per order:</dt>
                    <dd>'.$averagePerOrderDBField->Nice().'</dd>';
            $html .= '
                    <dt>Total count of items sold:</dt>
                    <dd>'.$itemCount.'</dd>';
            $itemCountPerOrder = round($itemCount / $count, 3);
            $html .= '
                    <dt>Average items sold per order:</dt>
                    <dd>'.$itemCountPerOrder.'</dd>';
            $costPerItem = $sum / $itemCount;
            $costPerItemDBField = DBField::create_field('Currency', $costPerItem);
            $html .= '
                    <dt>Average cost per item</dt>
                    <dd>'.$costPerItemDBField->Nice().'</dd>';
        } elseif($count >= $this->maxOrdersForLoop()) {
            $html .= '
                    <dt>Sum of sub-totals</dt>
                    <dd>Please reduce the number of orders to calculate the total.</dd>';
        } else {
            //..
        }


        $html .= '
            </dl>';

        return $html;
    }
}
