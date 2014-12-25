<?php

/**
 * Created by PhpStorm.
 * User: micha
 * Date: 14.12.14
 * Time: 16:34
 */
class cRedirect
{

    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }
        return $inst;
    }

    function getSmartyUrl()
    {
        $sUrl = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . ROOT_URL_FROM_DOCROOT . '/index.php';
        return $sUrl;
    }

    function goToPage($sModuleName = 'dashboard', $sPageName = NULL, $aQueryStringVars = NULL)
    {
        $sQueryStrVars = '';
        foreach ($aQueryStringVars as $sKey => $sVal) {
            $sQueryStrVars .= '&' . urlencode($sKey) . '=' . urlencode($sVal);
        }

        if (!$sPageName == NULL) $sPageName = '&page=' . $sPageName;

        header("HTTP/1.1 303 See Other");
        header('Location: ' . self::getSmartyUrl() . '?module=' . $sModuleName . $sPageName . $sQueryStrVars);
    }

    function getPageLink($sModuleName = 'dashboard', $sPageName = NULL, $aQueryStringVars = NULL)
    {
        $sQueryStrVars = '';
        foreach ($aQueryStringVars as $sKey => $sVal) {
            $sQueryStrVars .= '&' . urlencode($sKey) . '=' . urlencode($sVal);
        }

        if (!$sPageName == NULL) $sPageName = '&page=' . $sPageName;

        return self::getSmartyUrl() . '?module=' . $sModuleName . $sPageName . $sQueryStrVars;
    }
} 