<?php

/**
 * Created by PhpStorm.
 * User: micha
 * Date: 09.12.2014
 * Time: 16:19
 */
require_once('display.class.php');

class cError
{
    const ERR_TYPE_OTHER = 0;
    const ERR_TYPE_DATABASE = 1;
    const ERR_TYPE_TEMPLATE = 2;
    const ERR_TYPE_MISSING_PRIVILEGIES = 3;


    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }
        return $inst;
    }

    public function throwError($iErrType, $sErrMsg = '')
    {
        //TODO
        switch($iErrType) {
            case self::ERR_TYPE_OTHER:
                echo('other error');

                cDisplay::getInstance()->setLocked(true);

                break;

            case self::ERR_TYPE_DATABASE:
                echo('db error');

                cDisplay::getInstance()->setLocked(true);

                break;

            case self::ERR_TYPE_TEMPLATE:
                echo('tpl error');

                cDisplay::getInstance()->setLocked(true);

                break;

            case self::ERR_TYPE_MISSING_PRIVILEGIES:
                echo('rights error');

                cDisplay::getInstance()->setLocked(true);

                break;


        }
    }


} 