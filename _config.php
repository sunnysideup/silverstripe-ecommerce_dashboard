<?php

use SilverStripe\Admin\CMSMenu;

if (isset($_SERVER['REQUEST_URI']) && 0 === strpos($_SERVER['REQUEST_URI'], '/admin/')) {
    CMSMenu::remove_menu_item('Dashboard');
}
