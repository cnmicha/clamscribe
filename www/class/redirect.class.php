<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 14.12.14
 * Time: 16:34
 */

class cRedirect {

    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }
        return $inst;
    }

    function goToPage($sQueryStr = '') {
        $sUrl = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . ROOT_URL_FROM_DOCROOT . '/index.php';

        header('Location: ' . $sUrl . '?' . $sQueryStr);
    }
} 