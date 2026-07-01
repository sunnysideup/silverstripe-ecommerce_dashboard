<?php

namespace Sunnysideup\EcommerceDashboard\Model;

use SilverStripe\Core\ClassInfo;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\ORM\DataList;
use Sunnysideup\Dashboard\Panels\DashboardPanel;
use Sunnysideup\Ecommerce\Model\Extensions\EcommerceRole;
use Sunnysideup\Ecommerce\Model\Order;
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
    private static bool $configure_on_create = true;

    private static int $max_orders_for_looping = 500;


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
        return Config::inst()->get($this->ClassName, 'max_orders_for_looping');
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
        $firstStep = OrderStep::get()->setUseCache(true)->first();

        return Order::get()
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
        $orders = Order::get_datalist_of_orders_with_submit_record(true, false, true);
        return $orders
            ->exclude(['MemberID' => $this->excludedMembersArray()])
            ->orderBy('"OrderStatusLog"."Created" DESC')
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
        $lastStep = OrderStep::last_order_step();
        $orders = Order::get_datalist_of_orders_with_submit_record(true, false, true);

        return $orders
            ->filter(['StatusID' => $lastStep->ID])
            ->exclude(['MemberID' => $this->excludedMembersArray()])
            ->orderBy('"OrderStatusLog"."Created" DESC')
            ->where($this->daysBackWhereStatement($numberOfDaysBack))
        ;
    }

    /**
     * returns an array of member IDs that should be excluded from the dashboard.
     */
    protected function excludedMembersArray(): array
    {
        return EcommerceRole::get_excluded_members_array();
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
