<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 14.12.2014
 * Time: 02:28
 */

//include classes
require_once('class/display.class.php');
require_once('class/error.class.php');
require_once('class/mysql.class.php');
require_once('class/auth.class.php');
require_once('class/redirect.class.php');

//include config
require_once('config/config.inc.php');


require 'libs/Smarty.class.php';

session_start();

$cSmarty = new Smarty;

//$smarty->force_compile = true;
if (isset($_GET['debug'])) {
    switch ($_GET['debug']) {
        case 'true':
            $cSmarty->debugging = true;
            break;

        default:
            $cSmarty->debugging = false;
    }
} else {
    $cSmarty->debugging = false;
}

$cSmarty->caching = false;
$cSmarty->cache_lifetime = 120;


//module system
if (isset($_GET['module'])) {
    runModule($cSmarty, $_GET['module']);
} else {
    runModule($cSmarty, 'index');
}




//functions:

function runModule($cSmarty, $sModuleName) {
    if (file_exists('module/' . $sModuleName . '/action.php') && file_exists('module/' . $sModuleName . '/template.tpl') && file_exists('module/' . $sModuleName . '/config.php')) {
        require_once('module/' . $sModuleName . '/config.php');


        $cSmarty->assign('page_title', $aConfig['title']);
        $cSmarty->assign('page_caption', $aConfig['caption']);
        $cSmarty->assign('user_ip', $_SERVER['REMOTE_ADDR']);


        require_once('module/' . $sModuleName . '/action.php');

        if (!cDisplay::getInstance()->isBLocked()) {
            $cSmarty->assign('tpl_file', '../module/' . $sModuleName . '/template.tpl');

            $sUrl = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . ROOT_URL_FROM_DOCROOT . '/index.php';
            $cSmarty->assign('smarty_url', $sUrl);

            $cSmarty->display('include/page.tpl'); //if page content not locked (no err message) display template
        }

    } else {
        cError::getInstance()->throwError(cError::ERR_TYPE_TEMPLATE);
    }
}