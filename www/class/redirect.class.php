<?php

/**
 * Created by PhpStorm.
 * User: micha
 * Date: 14.12.14
 * Time: 16:34
 */
class cRedirect
{

    /**
     * Singleton pattern
     *
     * @author cnmicha
     * @date 2014-12-14
     *
     * @return cRedirect
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
     * Returns URL to index.php.
     *
     * @author cnmicha
     * @date 2014-12-14
     *
     * @return string
     */
    function getSmartyUrl()
    {
        $sUrl = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . ROOT_URL_FROM_DOCROOT . '/index.php';
        return $sUrl;
    }

    /**
     * Redirects browser to module.
     *
     * @author cnmicha
     * @date 2014-12-14
     *
     * @param string $sModuleName
     * @param null $sPageName
     * @param array $aQueryStringVars
     */
    function goToPage($sModuleName = 'dashboard', $sPageName = NULL, $aQueryStringVars = array())
    {
        $sQueryStrVars = '';
        foreach ($aQueryStringVars as $sKey => $sVal) {
            $sQueryStrVars .= '&' . urlencode($sKey) . '=' . urlencode($sVal);
        }

        if (!$sPageName == NULL) $sPageName = '&page=' . $sPageName;

        header("HTTP/1.1 303 See Other");
        header('Location: ' . self::getSmartyUrl() . '?module=' . $sModuleName . $sPageName . $sQueryStrVars);
    }

    /**
     * Returns link to module.
     *
     * @author cnmicha
     * @date 2014-12-14
     *
     * @param string $sModuleName
     * @param null $sPageName
     * @param array $aQueryStringVars
     * @return string
     */
    function getPageLink($sModuleName = 'dashboard', $sPageName = NULL, $aQueryStringVars = array())
    {
        $sQueryStrVars = '';
        foreach ($aQueryStringVars as $sKey => $sVal) {
            $sQueryStrVars .= '&' . urlencode($sKey) . '=' . urlencode($sVal);
        }

        if (!$sPageName == NULL) $sPageName = '&page=' . $sPageName;

        return self::getSmartyUrl() . '?module=' . $sModuleName . $sPageName . $sQueryStrVars;
    }
} 