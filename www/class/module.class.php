<?php

/**
 * Created by PhpStorm.
 * User: micha
 * Date: 23.12.2014
 * Time: 01:12
 */
class cModule
{

    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }
        return $inst;
    }

    function runModule($oSmarty, $sModuleName, $sPageName = NULL)
    {
        if (file_exists('module/' . $sModuleName . '/config.php')) {

            //get page name
            $aModule = array();
            $aPages = array();

            require_once('module/' . $sModuleName . '/config.php');
            if ($sPageName == NULL) $sPageName = $aModule['main_page'];

            if (!isset($aPages[$sPageName])) { //does page exist in config?
                cError::getInstance()->throwError(cError::ERR_TYPE_TEMPLATE);
                echo('<br>Error code 3');
                exit;
            }


            if (file_exists('module/' . $sModuleName . '/action/' . $aPages[$sPageName]['action_file']) && file_exists('module/' . $sModuleName . '/template/' . $aPages[$sPageName]['template_file'])) {


                $oSmarty->assign('page_title', $aModule['title']);
                $oSmarty->assign('page_caption', $aPages[$sPageName]['caption']);
                $oSmarty->assign('user_ip', $_SERVER['REMOTE_ADDR']);

                if (cAuth::getInstance()->isLoggedIn()) {
                    $oSmarty->assign('login_success', true);
                    $oSmarty->assign('login_username', cAuth::getInstance()->getUsernameByUserID(cAuth::getInstance()->getUserId()));
                } else {
                    $oSmarty->assign('login_success', false);
                    $oSmarty->assign('login_username', NULL);

                }


                if ($aModule['needsLogin'] == true) {
                    if (!cAuth::getInstance()->isLoginValid()) {
                        cRedirect::getInstance()->goToPage('auth');
                        exit;
                    }
                }

                require_once('module/' . $sModuleName . '/action/' . $aPages[$sPageName]['action_file']);

                if (!cDisplay::getInstance()->isBLocked()) {
                    $oSmarty->assign('tpl_file', '../../module/' . $sModuleName . '/template/' . $aPages[$sPageName]['template_file']);

                    $oSmarty->assign('smarty_url', cRedirect::getInstance()->getSmartyUrl());

                    $oSmarty->display('include/site_template/' . $aPages[$sPageName]['site_template']); //if page content not locked (no err message) display template
                }

            } else {
                cError::getInstance()->throwError(cError::ERR_TYPE_TEMPLATE);
                echo('<br>Error code 2');
            }

        } else {
            cError::getInstance()->throwError(cError::ERR_TYPE_TEMPLATE);
            echo('<br>Error code 1');
        }
    }
}