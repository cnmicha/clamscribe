<?php

/**
 * Created by PhpStorm.
 * User: micha
 * Date: 09.12.2014
 * Time: 19:40
 */
class cDisplay
{

    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }
        return $inst;
    }

    public function displayModule($sModuleName)
    {
        if (file_exists('../module/' . $sModuleName . '/index.php')) {

            require_once('../include/header.php');
            require_once('../include/menu.php');
            require_once('../module/' . $sModuleName . '/index.php');
            require_once('../include/footer.php');

        } else {
            cError::getInstance()->throwError(cError::ERR_TYPE_TEMPLATE);
        }
    }

    public function displayHtml($sHtml)
    {
        require_once('../include/header.php');
        require_once('../include/menu.php');
        echo($sHtml);
        require_once('../include/footer.php');
    }

    public function displayHtmlArray($aHtml)
    {
        require_once('../include/header.php');
        require_once('../include/menu.php');
        foreach ($aHtml as $sHtml) {
            echo($sHtml);
        }
        require_once('../include/footer.php');
    }
} 