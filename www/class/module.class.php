<?php

/**
 * Created by PhpStorm.
 * User: micha
 * Date: 23.12.2014
 * Time: 01:12
 */
class cModule
{

    /**
     * Singleton pattern
     *
     * @author cnmicha
     * @date 2014-12-14
     *
     * @return cModule
     */
    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }
        return $inst;
    }

    /**
     * Displays a module.
     *
     * @author cnmicha
     * @date 2014-12-14
     *
     * @param $oSmarty
     * @param $sModuleName
     * @param null $sPageName
     */
    function runModule($oSmarty, $sModuleName, $sPageName = NULL)
    {
        if (file_exists('module/' . $sModuleName . '/config.php')) {

            //get page name
            $aModule = array();
            $aPages = array();

            require_once('module/' . $sModuleName . '/config.php');
            if ($sPageName == NULL) $sPageName = $aModule['main_page'];

            if (!isset($aPages[$sPageName])) { //does page exist in config?
                cMessages::getInstance()->throwError(cMessages::ERR_TYPE_TEMPLATE, 'Error code 3');
                die();
            }


            if (file_exists('module/' . $sModuleName . '/action/' . $aPages[$sPageName]['action_file']) && file_exists('module/' . $sModuleName . '/template/' . $aPages[$sPageName]['template_file'])) {


                $oSmarty->assign('page_title', $aModule['title']);
                $oSmarty->assign('page_caption', $aPages[$sPageName]['caption']);
                $oSmarty->assign('user_ip', $_SERVER['REMOTE_ADDR']);
                $oSmarty->assign('template_breadcrumb', self::getBreadcrumbHtmlStr($aPages[$sPageName]['breadcrumb']));

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
                        die();
                    }
                }

                require_once('module/' . $sModuleName . '/action/' . $aPages[$sPageName]['action_file']);

                if (!cDisplay::getInstance()->isBLocked()) {
                    $oSmarty->assign('tpl_file', '../../module/' . $sModuleName . '/template/' . $aPages[$sPageName]['template_file']);

                    $oSmarty->assign('smarty_url', cRedirect::getInstance()->getSmartyUrl());

                    $oSmarty->display('include/site_template/' . $aPages[$sPageName]['site_template']); //if page content not locked (no err message) display template
                }

            } else {
                cMessages::getInstance()->throwError(cMessages::ERR_TYPE_TEMPLATE);
                echo('<br>Error code 2');
            }

        } else {
            cMessages::getInstance()->throwError(cMessages::ERR_TYPE_TEMPLATE);
            echo('<br>Error code 1');
        }
    }

    /**
     * Returns formatted breadcrumb html/css string
     *
     * @author cnmicha
     * @date 2014-12-14
     *
     * @param $aBreadcrumb
     * @return string
     */
    function getBreadcrumbHtmlStr($aBreadcrumb)
    {
        $aBreadcrumbHtml = array();
        $aBreadcrumbHtml[] = '<li><a href="' . cRedirect::getInstance()->getPageLink() . '"><i class="fa fa-dashboard"></i> Home</a></li>';

        $i = 0;
        foreach ($aBreadcrumb as $aKey) {
            $i++;

            $sHref = cRedirect::getInstance()->getPageLink($aKey['hrefModuleName'], $aKey['hrefPageName'], $aKey['hrefQueryStringArr']);

            if ($i == count($aBreadcrumb)) $aBreadcrumbHtml[] = '<li class="active"><a href="' . $sHref . '">' . $aBreadcrumb[$i - 1]['title'] . '</a></li>';
            else $aBreadcrumbHtml[] = '<li><a href="' . $sHref . '">' . $aBreadcrumb[$i - 1]['title'] . '</a></li>';
        }

        return implode($aBreadcrumbHtml);
    }
}