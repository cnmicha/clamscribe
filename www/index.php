<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 14.12.2014
 * Time: 02:28
 */

//include classes
require_once('class/module.class.php');
require_once('class/display.class.php');
require_once('class/error.class.php');
require_once('class/mysql.class.php');
require_once('class/auth.class.php');
require_once('class/redirect.class.php');

//include config
require_once('config/config.inc.php');


require 'libs/Smarty.class.php';

session_start();

$oSmarty = new Smarty;

//$smarty->force_compile = true;
if (isset($_GET['debug'])) {
    switch ($_GET['debug']) {
        case 'true':
            $oSmarty->debugging = true;
            break;

        default:
            $oSmarty->debugging = false;
    }
} else {
    $oSmarty->debugging = false;
}

$oSmarty->caching = false;
$oSmarty->cache_lifetime = 120;


//module system
if (isset($_GET['module'])) {
    if (isset($_GET['page'])) {
        cModule::getInstance()->runModule($oSmarty, urldecode($_GET['module']), urldecode($_GET['page']));
    } else {
        cModule::getInstance()->runModule($oSmarty, urldecode($_GET['module']));
    }
} else {
    cModule::getInstance()->runModule($oSmarty, 'dashboard');
}
