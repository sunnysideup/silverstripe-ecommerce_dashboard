<?php


class EcommerceDashboardPanel_SearchHistory extends EcommerceDashboardPanel
{

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * OLD: private static $db (case sensitive)
  * NEW: 
    private static $table_name = '[SEARCH_REPLACE_CLASS_NAME_GOES_HERE]';

    private static $db (COMPLEX)
  * EXP: Check that is class indeed extends DataObject and that it is not a data-extension!
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
    
    private static $table_name = 'EcommerceDashboardPanel_SearchHistory';

    private static $db = array(
        'MaxRows' => 'Int'
    );

    private static $defaults = array(
        'MaxRows' => 7
    );

    private static $icon = "ecommerce_dashboard/images/icons/EcommerceDashboardPanel_SearchHistory.png";

    public function getLabelPrefix()
    {
        return 'Top Searches';
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
        $fields->push(NumericField::create('MaxRows', 'Maximum number of entries'));
        return $fields;
    }

    public function Content()
    {
        $field = EcommerceSearchHistoryFormField::create('SearchHistory', 'Search Favourites')
            ->setNumberOfDays($this->DaysBack ? $this->DaysBack : $this->Config()->defaults['DaysBack'])
            ->setMaxRows(($this->MaxRows ? $this->MaxRows : $this->Config()->defaults['MaxRows']))
            ->setShowMoreLink(false)
            ->setAddTitle(false)
            ->setAddAtoZ(false);
        return $field->Field();
    }
}

