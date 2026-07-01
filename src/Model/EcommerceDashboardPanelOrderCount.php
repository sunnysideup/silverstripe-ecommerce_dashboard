<?php

namespace Sunnysideup\EcommerceDashboard\Model;

use Override;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\FieldType\DBField;
use Sunnysideup\Ecommerce\Model\Money\EcommerceCurrency;

/**
 * Class \Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanelOrderCount
 *
 * @property int $EcommerceCurrencyID
 * @method EcommerceCurrency EcommerceCurrency()
 */
class EcommerceDashboardPanelOrderCount extends EcommerceDashboardPanel
{
    private static $icon = 'sunnysideup/ecommerce_dashboard: client/images/icons/EcommerceDashboardPanel_OrderCount.png';

    private static $table_name = 'EcommerceDashboardPanelOrderCount';

    private static $has_one = [
        'EcommerceCurrency' => EcommerceCurrency::class,
    ];

    #[Override]
    public function getLabelPrefix()
    {
        $currencyStatement = '';
        $currency = $this->EcommerceCurrency();
        if ($currency && $currency->exists()) {
            $currencyStatement = ', in ' . $currency->Code . ', ';
        }

        return 'Orders Placed' . $currencyStatement;
    }

    #[Override]
    public function getConfigurationFields(): FieldList
    {
        $fields = parent::getConfigurationFields();
        $fields->push(
            DropdownField::create(
                'EcommerceCurrencyID',
                'Currency',
                EcommerceCurrency::get()->map()
            )
        );

        return $fields;
    }

    public function Content()
    {
        $submittedOrders = $this->submittedOrders();
        $submittedOrders = $submittedOrders->filter(['CurrencyUsedID' => $this->EcommerceCurrencyID]);

        $count = $submittedOrders->count();
        $sum = 0;
        $itemCount = 0;
        $html = '
            <table><tbody>';
        $html .= '
                <tr><td>Count of orders</td>
                <td class="number">' . $count . '</td></tr>';
        if ($count < $this->maxOrdersForLoop() && $count > 0) {
            foreach ($submittedOrders as $order) {
                $sum += $order->getSubTotal();
                $itemCount += $order->getTotalItemsTimesQuantity();
            }

            $sumDBField = DBField::create_field('Currency', $sum);
            $html .= '
                    <tr><td>Sum of sub-totals</td>
                    <td class="number">' . $sumDBField->Nice() . '</td></tr>';
            $averagePerOrder = $sum / $count;
            $averagePerOrderDBField = DBField::create_field('Currency', $averagePerOrder);
            $html .= '
                    <tr><td>Average sub-total per order</td>
                    <td class="number">' . $averagePerOrderDBField->Nice() . '</td></tr>';
            $html .= '
                    <tr><td>Total count of items sold</td>
                    <td class="number">' . $itemCount . '</td></tr>';
            $itemCountPerOrder = round($itemCount / $count, 3);
            $html .= '
                    <tr><td>Average items sold per order</td>
                    <td class="number">' . $itemCountPerOrder . '</td></tr>';
            $costPerItem = $sum / $itemCount;
            $costPerItemDBField = DBField::create_field('Currency', $costPerItem);
            $html .= '
                    <tr><td>Average cost per item</td>
                    <td class="number">' . $costPerItemDBField->Nice() . '</td></tr>';
        } elseif ($count >= $this->maxOrdersForLoop()) {
            $html .= '
                    <tr><td>Sum of sub-totals</td>
                    <td>Please reduce the number of orders to calculate the total.</td></tr>';
        }

        //..

        $html .= '
            </tbody></table>';
        return DBField::create_field(
            'HTMLText',
            $html
        );
    }
}
