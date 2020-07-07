<?php

namespace Sunnysideup\EcommerceDashboard\Model;










use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\ReadonlyField;
use Sunnysideup\Ecommerce\Model\Process\OrderStep;
use SilverStripe\ORM\DataObject;
use Sunnysideup\Ecommerce\Model\Order;
use Sunnysideup\Ecommerce\Model\Process\OrderStatusLog;
use Sunnysideup\Ecommerce\Config\EcommerceConfig;
use SilverStripe\Core\Injector\Injector;
use Sunnysideup\EcommerceDashboard\EcommerceDashboard;
use Sunnysideup\Ecommerce\Model\Extensions\EcommerceRole;
use SilverStripe\Core\Config\Config;



class EcommerceDashboardPanel extends DataObject
{


    /**
     * @var bool Show the configure form after creating. Used for panels that require
     * configuration in order to show data
     */
    private static $configure_on_create = true;



/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * OLD: private static $db (case sensitive)
  * NEW:
    private static $table_name = '[SEARCH_REPLACE_CLASS_NAME_GOES_HERE]';

    private static $db (COMPLEX)
  * EXP: Check that is class indeed extends DataObject and that it is not a data-extension!
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */

    private static $table_name = 'EcommerceDashboardPanel';

    private static $db = array(
        'DaysBack' => 'Int'
    );

    private static $defaults = array(
        'DaysBack' => 7
    );


    private static $icon = "ecommerce_dashboard/images/icons";

    public function getLabel()
    {
        return $this->getLabelPrefix();
    }

    public function getTitle()
    {
        $str = $this->getLabelPrefix();
        if ($this->DaysBack) {
            $str .= ' '.sprintf(_t('EcommerceDashboardPanel.IN_THE_LAST_XXX_DAYS', 'in the last %s days.'), $this->DaysBack);
        }
        return $str;
    }

    public function getLabelPrefix()
    {

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: $this->ClassName (case sensitive)
  * NEW: $this->ClassName (COMPLEX)
  * EXP: Check if the class name can still be used as such
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
        return 'please set in '.$this->ClassName;
    }

    public function getConfiguration()
    {
        $fields = parent::getConfiguration();

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: NumericField::create (case sensitive)
  * NEW: NumericField::create (COMPLEX)
  * EXP: check the number of decimals required and add as ->setScale(2)
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
        $fields->push(NumericField::create("DaysBack", "Number of days back"));
        $fields->replaceField('Title', ReadonlyField::create('Title', ''));

        return $fields;
    }

    /**
     *
     *
     * @return DataList
     */
    protected function openOrders($numberOfDaysBack = 7)
    {
        $firstStep = DataObject::get_one(OrderStep::class);
        $orders = Order::get()
            ->LeftJoin(OrderStatusLog::class, '"Order"."ID" = "OrderStatusLog"."OrderID"')
            ->LeftJoin($submittedOrderStatusLogClassName, '"OrderStatusLog"."ID" = "'.$submittedOrderStatusLogClassName.'"."ID"')
            ->filter(array('StatusID' => $firstStep->ID))
            ->exclude(array('MemberID' => $this->excludedMembers()));

        return $orders;
    }

    /**
     *
     *
     * @return DataList
     */
    protected function submittedOrders($numberOfDaysBack = 0)
    {
        $orders = Order::get_datalist_of_orders_with_submit_record();
        $orders = $orders
            ->exclude(array('MemberID' => $this->excludedMembersArray()))
            ->where($this->daysBackWhereStatement($numberOfDaysBack));

        return $orders;
    }

    /**
     *
     *
     * @return DataList
     */
    protected function archivedOrders($numberOfDaysBack = 0)
    {
        $submittedOrderStatusLogClassName = EcommerceConfig::get(OrderStatusLog::class, 'order_status_log_class_used_for_submitting_order');
        $lastStep = OrderStep::last_order_step();
        return Order::get()
            ->LeftJoin(OrderStatusLog::class, '"Order"."ID" = "OrderStatusLog"."OrderID"')
            ->LeftJoin($submittedOrderStatusLogClassName, '"OrderStatusLog"."ID" = "'.$submittedOrderStatusLogClassName.'"."ID"')
            ->filter(array('StatusID' => $lastStep->ID))
            ->exclude(array('MemberID' => $this->excludedMembersArray()))
            ->where($this->daysBackWhereStatement($numberOfDaysBack));
        return $orders;
    }



    /**
     * An accessor to the Dashboard controller
     *
     * @return Dashboard
     */
    public function getDashboard()
    {
        return Injector::inst()->get(EcommerceDashboard::class);
    }

    /**
     *
     *
     * @var array
     */
    private static $_excluded_members_array = [];

    /**
     *
     *
     * @return array array of member IDs
     */
    protected function excludedMembersArray()
    {
        if (! count(self::$_excluded_members_array)) {
            self::$_excluded_members_array = array(-1 => -1);
            $adminGroup = EcommerceRole::get_admin_group();
            $assitantGroup = EcommerceRole::get_assistant_group();
            if ($adminGroup) {
                foreach ($adminGroup->Members() as $member) {
                    self::$_excluded_members_array[$member->ID] = $member->ID;
                }
            }
            if ($assitantGroup) {
                foreach ($assitantGroup->Members() as $member) {
                    self::$_excluded_members_array[$member->ID] = $member->ID;
                }
            }
        }

        return self::$_excluded_members_array;
    }

    /**
     *
     *
     * @return string where statement for orders that have been submitted.
     */
    protected function daysBackWhereStatement($daysBack = 0)
    {
        if (! $daysBack) {
            $daysBack = $this->DaysBack ? $this->DaysBack : $this->Config()->defaults['DaysBack'];
        }
        return '"OrderStatusLog"."Created" > ( NOW() - INTERVAL '.($daysBack).' DAY )';
    }

    /**
     * @var int The "weight" of the dashboard panel when listed in the available panels.
     *			Higher is lower in the list.
     */
    //private static $priority = 100;



    /**
     * @var string The name of the template used for the contents of this panel.
     */
    //protected $template;

    public function maxOrdersForLoop()
    {
        return 500;
    }


    /**
     * Allows the panel to be added
     *
     * @return string
     */
    public function registered()
    {

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: $this->ClassName (case sensitive)
  * NEW: $this->ClassName (COMPLEX)
  * EXP: Check if the class name can still be used as such
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
        $enabled = Config::inst()->get($this->ClassName, 'enabled');
        if (is_bool($enabled)) {
            return self::config()->enabled;
        }
        if (strtolower(self::config()->enabled) == 'no') {
            return false;
        }
        return true;
    }

    protected function CalculatedDaysBack()
    {
        return $this->DaysBack ? : 7;
    }
}
