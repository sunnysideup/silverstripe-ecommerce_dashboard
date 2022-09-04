<?php

namespace Sunnysideup\EcommerceDashboard\Model;

use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\NumericField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\Map;
use Sunnysideup\Ecommerce\Forms\Fields\YesNoDropDownField;
use Sunnysideup\Ecommerce\Model\Money\EcommerceCurrency;

class EcommerceDashboardPanelLatestOrders extends EcommerceDashboardPanel
{
    private static $icon = 'sunnysideup/ecommerce_dashboard: client/images/icons/EcommerceDashboardPanel_LatestOrders.png';

    private static $table_name = 'EcommerceDashboardPanelLatestOrders';

    private static $db = [
        'NumberOfOrdersToShow' => 'Int',
    ];

    private static $has_one = [
        'EcommerceCurrency' => EcommerceCurrency::class,
    ];

    private static $defaults = [
        'NumberOfOrdersToShow' => 7,
    ];

    public function getLabelPrefix()
    {
        $currencyStatement = '';
        $currency = $this->EcommerceCurrency();
        if ($currency) {
            if ($currency->exists()) {
                $currencyStatement = ', in ' . $currency->Code . '.';
            }
        }

        return 'Last ' . ($this->NumberOfOrdersToShow ?: $this->Config()->defaults['NumberOfOrdersToShow']) . ' Orders' . $currencyStatement;
    }

    public function getConfigurationFields(): FieldList
    {
        $fields = parent::getConfigurationFields();
        $fields->push(
            NumericField::create(
                'NumberOfOrdersToShow',
                'Number of orders to show'
            )
        );
        $map = EcommerceCurrency::get()->map();
        if ($map instanceof Map) {
            $fields->replaceField(
                'DaysBack',
                DropdownField::create(
                    'EcommerceCurrencyID',
                    'Currency',
                    [0 => YesNoDropDownField::ANY_IE_NO_SELECTION] + EcommerceCurrency::get()->map()->toArray()
                )
            );
        }

        return $fields;
    }

    public function Content()
    {
        $submittedOrders = $this->submittedOrders(365);
        if ($this->EcommerceCurrencyID) {
            $submittedOrders = $submittedOrders
                ->filter(['CurrencyUsedID' => $this->EcommerceCurrencyID])
            ;
        }
        $submittedOrders = $submittedOrders->sort(['LastEdited' => 'DESC']);
        $submittedOrders = $submittedOrders
            ->limit(($this->NumberOfOrdersToShow ?: $this->Config()->defaults['NumberOfOrdersToShow']))
        ;
        $html = '
            <ul>';
        if ($submittedOrders->exists()) {
            foreach ($submittedOrders as $order) {
                $html .= '
                <li>
                    <a href="' . $order->CMSEditLink() . '">#' . $order->ID . ', ' . $order->getTotalAsMoney()->Nice() . ', ' . $order->Member()->Email . ', &raquo; ' . $order->Status()->Title . '</a>
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
