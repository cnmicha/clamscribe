<?php

/**
 * Created by PhpStorm.
 * User: micha
 * Date: 09.12.2014
 * Time: 16:19
 */
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

    public static function throwError($iErrType, $sErrMsg = '')
    {
        //TODO
    }


} 