<?php

class EcommerceDashboardPanel_FavouriteProducts extends EcommerceDashboardPanel
{
    private static $icon = "ecommerce_dashboard/images/icons/EcommerceDashboardPanel_FavouriteProducts.png";


/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * OLD: private static $db (case sensitive)
  * NEW: 
    private static $table_name = '[SEARCH_REPLACE_CLASS_NAME_GOES_HERE]';

    private static $db (COMPLEX)
  * EXP: Check that is class indeed extends DataObject and that it is not a data-extension!
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
    
    private static $table_name = 'EcommerceDashboardPanel_FavouriteProducts';

    private static $db = array(
        'NumberOfProducts' => 'Int'
    );

    private static $defaults = array(
        'NumberOfProducts' => 7
    );

    public function getLabelPrefix()
    {
        return 'Favourite sellers';
    }

    public function getTitle()
    {
        return parent::getTitle();
    }

    public function getConfiguration()
    {
        $fields = parent::getConfiguration();
        $fields->push(NumericField::create('NumberOfProducts', 'Number of products to show'));
        return $fields;
    }

    public function Content()
    {
        $submittedOrders = $this->submittedOrders();
        $html = '
            <ul>';
        $buyableArray = array();
        $count = $submittedOrders->count();
        if ($count < $this->maxOrdersForLoop() && $count > 0) {
            foreach ($submittedOrders as $order) {
                foreach ($order->Items() as $item) {
                    $key = $item->BuyableClassName.".".$item->BuyableID;
                    if (! isset($buyableArray[$key])) {
                        $buyableArray[$key] = 0;
                    }
                    $buyableArray[$key]++;
                }
            }
            arsort($buyableArray, SORT_NUMERIC);
            for ($i = 0; $i < $this->NumberOfProducts; $i++) {
                $oneRow = array_slice($buyableArray, $i, 1);
                foreach ($oneRow as $key => $count) {
                    list($className, $id) = explode('.', $key);
                    $buyable = $className::get()->byID($id);
                    if ($buyable) {
                        $html .= '<li class="pos'.$i.'"><span><strong>'.$count.'</strong> × </span><a href="'.$buyable->Link().'">'.$buyable->FullName.'</a></li>';
                    } else {
                        $html .= '<li class="pos'.$i.'">Error with '.$key.'</li>';
                    }
                }
            }
        } elseif ($count >= $this->maxOrdersForLoop()) {
            $html .= '
                    <li>There are too many orders to work out the favourite products, please reduce the time period.</li>';
        } else {
            $html .= '
                    <li>There are no favourite sellers.</li>';
        }


        $html .= '
            </ul>';

        return $html;
    }
}

