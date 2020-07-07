<?php

namespace Sunnysideup\EcommerceDashboard\Model;





use Sunnysideup\Ecommerce\Model\Money\EcommerceCurrency;
use SilverStripe\Forms\NumericField;
use SilverStripe\ORM\Map;
use SilverStripe\Forms\DropdownField;



class EcommerceDashboardPanel_LatestOrders extends EcommerceDashboardPanel
{
    private static $icon = "ecommerce_dashboard/images/icons/EcommerceDashboardPanel_LatestOrders.png";


/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * OLD: private static $db (case sensitive)
  * NEW:
    private static $table_name = '[SEARCH_REPLACE_CLASS_NAME_GOES_HERE]';

    private static $db (COMPLEX)
  * EXP: Check that is class indeed extends DataObject and that it is not a data-extension!
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */

    private static $table_name = 'EcommerceDashboardPanel_LatestOrders';

    private static $db = array(
        'NumberOfOrdersToShow' => 'Int'
    );

    private static $has_one = array(
        'EcommerceCurrency' => EcommerceCurrency::class
    );

    private static $defaults = array(
        'NumberOfOrdersToShow' => 7
    );

    public function getLabelPrefix()
    {
        $currencyStatement = '';
        if ($currency = $this->EcommerceCurrency()) {
            if ($currency->exists()) {
                $currencyStatement = ", in ".$currency->Code.".";
            }
        }
        return 'Last '.($this->NumberOfOrdersToShow ? $this->NumberOfOrdersToShow : $this->Config()->defaults['NumberOfOrdersToShow']).' Orders'.$currencyStatement;
    }

    public function getConfiguration()
    {
        $fields = parent::getConfiguration();
        $fields->push(

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: NumericField::create (case sensitive)
  * NEW: NumericField::create (COMPLEX)
  * EXP: check the number of decimals required and add as ->setScale(2)
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
            NumericField::create(
                "NumberOfOrdersToShow",
                "Number of orders to show"
            )
        );
        $map = EcommerceCurrency::get()->map();
        if ($map instanceof Map) {
            $fields->replaceField(
                'DaysBack',
                DropdownField::create(
                    "EcommerceCurrencyID",
                    "Currency",
                    [0 => '-- any --'] + EcommerceCurrency::get()->map()->toArray()
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
                ->filter(array('CurrencyUsedID' => $this->EcommerceCurrencyID));
        }
        $submittedOrders = $submittedOrders->sort(['LastEdited' => 'DESC']);
        $submittedOrders = $submittedOrders
            ->limit(($this->NumberOfOrdersToShow ? $this->NumberOfOrdersToShow : $this->Config()->defaults['NumberOfOrdersToShow']));
        $html = '
            <ul>';
        if ($submittedOrders->count()) {
            foreach ($submittedOrders as $order) {
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

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        $this->DaysBack = 0;
    }
}

