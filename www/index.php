<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 08.12.2014
 * Time: 17:28
 */

//include classes
require_once('class/display.class.php');
require_once('class/error.class.php');

//include config
require_once('config/config.inc.php');


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
    if (file_exists('module/' . $_GET['module'] . '/action.php') && file_exists('module/' . $_GET['module'] . '/template.tpl') && file_exists('module/' . $_GET['module'] . '/config.php')) {
        require_once('module/' . $_GET['module'] . '/config.php');
        $oSmarty->assign('page_title', $aConfig['title']);
        $oSmarty->assign('page_caption', $aConfig['caption']);
        $oSmarty->assign('user_ip', $_SERVER['REMOTE_ADDR']);

        require_once('module/' . $_GET['module'] . '/action.php');

        if (!cDisplay::getInstance()->isBLocked()) {
            $oSmarty->assign('tpl_file', '../module/' . $_GET['module'] . '/template.tpl');

            $sUrl = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . ROOT_URL_FROM_DOCROOT . '/index.php';
            $oSmarty->assign('smarty_url', $sUrl);

            $oSmarty->display('include/page.tpl');
        } //if page content not locked (no err message) display template

    } else {
        cError::getInstance()->throwError(cError::ERR_TYPE_TEMPLATE);
    }
} else {
    if (file_exists('module/index/action.php') && file_exists('module/index/template.tpl') && file_exists('module/index/config.php')) {
        require_once('module/index/config.php');
        $oSmarty->assign('page_title', $aConfig['title']);
        $oSmarty->assign('page_caption', $aConfig['caption']);
        $oSmarty->assign('user_ip', $_SERVER['REMOTE_ADDR']);

        require_once('module/index/action.php');

        if (!cDisplay::getInstance()->isBLocked()) {
            $oSmarty->assign('tpl_file', '../module/index/template.tpl');

            $sUrl = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . ROOT_URL_FROM_DOCROOT . '/index.php';
            $oSmarty->assign('smarty_url', $sUrl);

            $oSmarty->display('include/page.tpl');
        } //if page content not locked (no err message) display template

        if (!cDisplay::getInstance()->isBLocked()) $oSmarty->display('module/index/template.tpl'); //if page content not locked (no err message) display template
    } else {
        cError::getInstance()->throwError(cError::ERR_TYPE_TEMPLATE);
    }
}
