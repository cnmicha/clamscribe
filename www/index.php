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
    runModule($cSmarty, 'dashboard');
}




//functions:

function runModule($cSmarty, $sModuleName) {
    if (file_exists('module/' . $sModuleName . '/action.php') && file_exists('module/' . $sModuleName . '/template.tpl') && file_exists('module/' . $sModuleName . '/config.php')) {
        require_once('module/' . $sModuleName . '/config.php');


        $cSmarty->assign('page_title', $aConfig['title']);
        $cSmarty->assign('page_caption', $aConfig['caption']);
        $cSmarty->assign('user_ip', $_SERVER['REMOTE_ADDR']);

        if(cAuth::getInstance()->isLoggedIn()) {
            $cSmarty->assign('login_success', true);
            $cSmarty->assign('login_username', cAuth::getInstance()->getUsernameByUserID(cAuth::getInstance()->getUserId()));
        } else {
            $cSmarty->assign('login_success', false);
            $cSmarty->assign('login_username', NULL);

        }


        if($aConfig['needsLogin'] == true) {
            if(!cAuth::getInstance()->isLoginValid()) {
                cRedirect::getInstance()->goToPage('module=auth');
                exit;
            }
        }

        require_once('module/' . $sModuleName . '/action.php');

        if (!cDisplay::getInstance()->isBLocked()) {
            $cSmarty->assign('tpl_file', '../module/' . $sModuleName . '/template.tpl');

            $cSmarty->assign('smarty_url', cRedirect::getInstance()->getSmartyUrl());

            $cSmarty->display('include/' . $aConfig['template']); //if page content not locked (no err message) display template
        }

    } else {
        cError::getInstance()->throwError(cError::ERR_TYPE_TEMPLATE);
    }
}