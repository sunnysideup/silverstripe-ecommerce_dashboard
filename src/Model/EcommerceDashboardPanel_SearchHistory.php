<?php

namespace Sunnysideup\EcommerceDashboard\Model;



use SilverStripe\Forms\NumericField;
use Sunnysideup\Ecommerce\Model\Search\SearchHistory;
use Sunnysideup\Ecommerce\Forms\Fields\EcommerceSearchHistoryFormField;




class EcommerceDashboardPanel_SearchHistory extends EcommerceDashboardPanel
{

    private static $table_name = 'EcommerceDashboardPanel_SearchHistory';

    private static $db = array(
        'MaxRows' => 'Int'
    );

    private static $defaults = array(
        'MaxRows' => 7
    );

    private static $icon = "sunnysideup/ecommerce_dashboard: client/images/icons/EcommerceDashboardPanel_SearchHistory.png";

    public function getLabelPrefix()
    {
        return 'Top Searches';
    }

    public function getConfiguration()
    {
        $fields = parent::getConfiguration();
        $fields->push(NumericField::create('MaxRows', 'Maximum number of entries'));
        return $fields;
    }

    public function Content()
    {
        $field = EcommerceSearchHistoryFormField::create(SearchHistory::class, 'Search Favourites')
            ->setNumberOfDays($this->DaysBack ? $this->DaysBack : $this->Config()->defaults['DaysBack'])
            ->setMaxRows(($this->MaxRows ? $this->MaxRows : $this->Config()->defaults['MaxRows']))
            ->setShowMoreLink(false)
            ->setAddTitle(false)
            ->setAddAtoZ(false);
        return $field->Field();
    }
}

