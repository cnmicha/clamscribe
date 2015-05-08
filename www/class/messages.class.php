<?php

/**
 * Created by PhpStorm.
 * User: micha
 * Date: 09.12.2014
 * Time: 16:19
 */
require_once('display.class.php');

class cMessages
{
    const ERR_TYPE_OTHER = 0;
    const ERR_TYPE_DATABASE = 1;
    const ERR_TYPE_TEMPLATE = 2;
    const ERR_TYPE_MISSING_PRIVILEGIES = 3;
    const MSG_TYPE_INFORMATION = 4;
    const MSG_TYPE_WARNING = 5;


    /**
     * Singleton pattern
     *
     * @author cnmicha
     * @date 2014-12-14
     *
     * @return cMessages
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
     * Throws an error.
     *
     * @author cnmicha
     * @date 2014-12-14
     *
     * @param $iErrType
     * @param string $sErrMsg
     */
    public function throwError($iErrType, $sErrMsg = '')
    {
        switch ($iErrType) {
            case self::ERR_TYPE_OTHER:
                echo('other error<br>' . $sErrMsg);

                if (LOG_PAGE_ERRORS_TO_DB) cLog::getInstance()->logEvent(cLog::ERR_TYPE_OTHER, cAuth::getInstance()->getUserId());
                cDisplay::getInstance()->setBLocked(true);

                break;

            case self::ERR_TYPE_DATABASE:
                echo('db error<br>' . $sErrMsg);

                if (LOG_PAGE_ERRORS_TO_DB) cLog::getInstance()->logEvent(cLog::ERR_TYPE_DATABASE, cAuth::getInstance()->getUserId());
                cDisplay::getInstance()->setBLocked(true);

                break;

            case self::ERR_TYPE_TEMPLATE:
                echo('tpl error<br>' . $sErrMsg);

                if (LOG_PAGE_ERRORS_TO_DB) cLog::getInstance()->logEvent(cLog::ERR_TYPE_TEMPLATE, cAuth::getInstance()->getUserId());
                cDisplay::getInstance()->setBLocked(true);

                break;

            case self::ERR_TYPE_MISSING_PRIVILEGIES:
                echo('permission error<br>' . $sErrMsg);

                if (LOG_PAGE_ERRORS_TO_DB) cLog::getInstance()->logEvent(cLog::ERR_TYPE_MISSING_PRIVILEGIES, cAuth::getInstance()->getUserId());
                cDisplay::getInstance()->setBLocked(true);

                break;


        }
    }

    /**
     * Shows a message.
     *
     * @author cnmicha
     * @date 2015-05-08
     *
     * @param $iMsgType
     * @param $sMsgText
     */
    function showMessage($iMsgType, $sMsgText) {
        switch ($iMsgType) {
            case self::MSG_TYPE_INFORMATION:
                echo('information: ' . $sMsgText);
                break;

            case self::MSG_TYPE_WARNING:
                echo('warning: ' . $sMsgText);
                break;

            default:
                self::throwError(self::ERR_TYPE_OTHER, 'Wrong MSG_TYPE id');
                break;
        }
    }


} 