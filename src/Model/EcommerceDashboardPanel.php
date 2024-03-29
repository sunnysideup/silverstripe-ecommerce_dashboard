<?php

namespace Sunnysideup\EcommerceDashboard\Model;

use Sunnysideup\Dashboard\Panels\DashboardPanel;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\DataObject;
use Sunnysideup\Ecommerce\Config\EcommerceConfig;
use Sunnysideup\Ecommerce\Model\Extensions\EcommerceRole;
use Sunnysideup\Ecommerce\Model\Order;
use Sunnysideup\Ecommerce\Model\Process\OrderStatusLog;
use Sunnysideup\Ecommerce\Model\Process\OrderStep;
use Sunnysideup\EcommerceDashboard\EcommerceDashboard;

/**
 * Class \Sunnysideup\EcommerceDashboard\Model\EcommerceDashboardPanel
 *
 * @property int $DaysBack
 */
class EcommerceDashboardPanel extends DashboardPanel
{
    protected $template = 'Dashboard_Content';

    /**
     * @var bool Show the configure form after creating. Used for panels that require
     *           configuration in order to show data
     */
    private static $configure_on_create = true;

    private static $table_name = 'EcommerceDashboardPanel';

    private static $db = [
        'DaysBack' => 'Int',
    ];

    private static $defaults = [
        'DaysBack' => 7,
    ];

    private static $icon = 'sunnysideup/ecommerce_dashboard: client/images/icons';

    /**
     * @var array
     */
    private static $_excluded_members_array = [];

    public function getLabel(): string
    {
        return $this->getLabelPrefix();
    }

    public function getTitle()
    {
        $str = $this->getLabelPrefix();
        if ($this->DaysBack) {
            $str .= ' ' . sprintf(_t('EcommerceDashboardPanel.IN_THE_LAST_XXX_DAYS', 'in the last %s days.'), $this->DaysBack);
        }

        return $str;
    }

    public function getLabelPrefix()
    {
        return 'please set in ' . ClassInfo::shortName($this->ClassName);
    }

    public function getConfigurationFields(): FieldList
    {
        $fields = parent::getConfigurationFields();
        $fields->push(NumericField::create('DaysBack', 'Number of days back'));
        $fields->replaceField('Title', ReadonlyField::create('Title', ''));

        return $fields;
    }

    /**
     * An accessor to the Dashboard controller.
     *
     * @return EcommerceDashboard
     */
    public function getDashboard()
    {
        return Injector::inst()->get(EcommerceDashboard::class);
    }

    public function maxOrdersForLoop(): int
    {
        return 500;
    }

    /**
     * Allows the panel to be added.
     *
     * @return string
     */
    public function registered()
    {
        $enabled = Config::inst()->get($this->ClassName, 'enabled');
        if (is_bool($enabled)) {
            return $this->config()->enabled;
        }

        return 'no' !== strtolower((string) self::config()->enabled);
    }

    /**
     * @param mixed $numberOfDaysBack
     *
     * @return DataList
     */
    protected function openOrders($numberOfDaysBack = 7)
    {
        $firstStep = DataObject::get_one(OrderStep::class);
        $submittedOrderStatusLogClassName = EcommerceConfig::get(OrderStatusLog::class, 'order_status_log_class_used_for_submitting_order');

        return Order::get()
            ->LeftJoin(OrderStatusLog::class, '"Order"."ID" = "OrderStatusLog"."OrderID"')
            ->LeftJoin($submittedOrderStatusLogClassName, '"OrderStatusLog"."ID" = "' . $submittedOrderStatusLogClassName . '"."ID"')
            ->filter(['StatusID' => $firstStep->ID])
            ->exclude(['MemberID' => $this->excludedMembers()])
        ;
    }

    /**
     * @param mixed $numberOfDaysBack
     *
     * @return DataList
     */
    protected function submittedOrders($numberOfDaysBack = 0)
    {
        $orders = Order::get_datalist_of_orders_with_submit_record();

        return $orders
            ->exclude(['MemberID' => $this->excludedMembersArray()])
            ->where($this->daysBackWhereStatement($numberOfDaysBack))
        ;
    }

    /**
     * @param mixed $numberOfDaysBack
     *
     * @return DataList
     */
    protected function archivedOrders($numberOfDaysBack = 0)
    {
        $submittedOrderStatusLogClassName = EcommerceConfig::get(OrderStatusLog::class, 'order_status_log_class_used_for_submitting_order');
        $lastStep = OrderStep::last_order_step();

        return Order::get()
            ->LeftJoin(OrderStatusLog::class, '"Order"."ID" = "OrderStatusLog"."OrderID"')
            ->LeftJoin($submittedOrderStatusLogClassName, '"OrderStatusLog"."ID" = "' . $submittedOrderStatusLogClassName . '"."ID"')
            ->filter(['StatusID' => $lastStep->ID])
            ->exclude(['MemberID' => $this->excludedMembersArray()])
            ->where($this->daysBackWhereStatement($numberOfDaysBack))
        ;
    }

    /**
     * @return array array of member IDs
     */
    protected function excludedMembersArray()
    {
        if (! count(self::$_excluded_members_array)) {
            self::$_excluded_members_array = [-1 => -1];
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
     * @param mixed $daysBack
     *
     * @return string where statement for orders that have been submitted
     */
    protected function daysBackWhereStatement($daysBack = 0)
    {
        if (! $daysBack) {
            $daysBack = $this->DaysBack ?: $this->Config()->defaults['DaysBack'];
        }

        return '"OrderStatusLog"."Created" > ( NOW() - INTERVAL ' . $daysBack . ' DAY )';
    }

    protected function CalculatedDaysBack()
    {
        return $this->DaysBack ?: 7;
    }
}
