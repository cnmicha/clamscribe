<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 08.12.2014
 * Time: 17:28
 */

//include classes?
require_once('class/display.class.php');
require_once('class/error.class.php');

require 'libs/Smarty.class.php';


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
}

$oSmarty->caching = true;
$oSmarty->cache_lifetime = 120;


//module system
if (isset($_GET['module'])) {
    if (file_exists('module/' . $_GET['module'] . '/action.php') && file_exists('module/' . $_GET['module'] . '/template.tpl')) {
        include_once('module/' . $_GET['module'] . '/action.php');
        if (!cDisplay::getInstance()->isLocked()) $oSmarty->display('module/' . $_GET['module'] . '/template.tpl'); //if page content not locked (no err message) display template
    } else {
        cError::getInstance()->throwError(cError::ERR_TYPE_TEMPLATE);
    }
} else {
    if (file_exists('module/index/action.php') && file_exists('module/index/template.tpl')) {
        include_once('module/index/action.php');
        if (!cDisplay::getInstance()->isLocked()) $oSmarty->display('module/index/template.tpl'); //if page content not locked (no err message) display template
    } else {
        cError::getInstance()->throwError(cError::ERR_TYPE_TEMPLATE);
    }
}
