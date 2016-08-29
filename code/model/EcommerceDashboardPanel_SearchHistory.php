<?php


class EcommerceDashboardPanel_SearchHistory extends EcommerceDashboardPanel
{

    private static $db = array(
        'MaxRows' => 'Int'
    );

    private static $icon = "ecommerce_dashboard/images/icons/EcommerceDashboardPanel_SearchHistory.png";

    function getLabelPrefix()
    {
        return 'Search Favourites';
    }

    public function Content()
    {
        $field = EcommerceSearchHistoryFormField::create('SearchHistory', 'Search Favourites')
            ->setNumberOfDays($this->DaysBack ? $this->DaysBack : 7 )
            ->setMaxRows($this->MaxRows ? $this->MaxRows : 3)
            ->setShowMoreLink(false)
            ->setAddTitle(false)
            ->setAddAtoZ(false);
        return $field->Field();
    }


}
