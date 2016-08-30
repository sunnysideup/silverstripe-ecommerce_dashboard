<?php


class EcommerceDashboardPanel_SearchHistory extends EcommerceDashboardPanel
{

    private static $db = array(
        'MaxRows' => 'Int'
    );

    private static $defaults = array(
        'MaxRows' => 7
    );

    private static $icon = "ecommerce_dashboard/images/icons/EcommerceDashboardPanel_SearchHistory.png";

    function getLabelPrefix()
    {
        return 'Search Favourites';
    }

    public function getConfiguration()
    {
        $fields = parent::getConfiguration();
        $fields->push(NumericField::create('DaysBack','DaysBack'));
        return $fields;
    }

    public function Content()
    {
        $field = EcommerceSearchHistoryFormField::create('SearchHistory', 'Search Favourites')
            ->setNumberOfDays($this->DaysBack ? $this->DaysBack : 7 )
            ->setMaxRows(($this->MaxRows ? $this->MaxRows : $this->Config()->defaults['MaxRows']))
            ->setShowMoreLink(false)
            ->setAddTitle(false)
            ->setAddAtoZ(false);
        return $field->Field();
    }


}
