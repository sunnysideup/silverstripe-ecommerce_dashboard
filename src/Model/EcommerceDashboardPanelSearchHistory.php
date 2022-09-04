<?php

namespace Sunnysideup\EcommerceDashboard\Model;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\NumericField;
use Sunnysideup\Ecommerce\Forms\Fields\EcommerceSearchHistoryFormField;
use Sunnysideup\Ecommerce\Model\Search\SearchHistory;

class EcommerceDashboardPanelSearchHistory extends EcommerceDashboardPanel
{
    private static $table_name = 'EcommerceDashboardPanelSearchHistory';

    private static $db = [
        'MaxRows' => 'Int',
    ];

    private static $defaults = [
        'MaxRows' => 7,
    ];

    private static $icon = 'sunnysideup/ecommerce_dashboard: client/images/icons/EcommerceDashboardPanel_SearchHistory.png';

    public function getLabelPrefix()
    {
        return 'Top Searches';
    }

    public function getConfigurationFields(): FieldList
    {
        $fields = parent::getConfigurationFields();
        $fields->push(NumericField::create('MaxRows', 'Maximum number of entries'));

        return $fields;
    }

    public function Content()
    {
        $field = EcommerceSearchHistoryFormField::create('SearchFavourites', 'Search Favourites')
            ->setNumberOfDays($this->DaysBack ?: $this->Config()->defaults['DaysBack'])
            ->setMaxRows(($this->MaxRows ?: $this->Config()->defaults['MaxRows']))
            ->setShowMoreLink(false)
            ->setAddTitle(false)
            ->setAddAtoZ(false)
        ;

        return $field->Field();
    }
}
