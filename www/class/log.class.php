<?php

/**
 * Created by PhpStorm.
 * User: micha
 * Date: 29.12.2014
 * Time: 13:05
 */
class cLog
{
    const ERR_TYPE_OTHER = 'ERR_OTHER';
    const ERR_TYPE_DATABASE = 'ERR_DATABASE';
    const ERR_TYPE_TEMPLATE = 'ERR_TEMPLATE';
    const ERR_TYPE_MISSING_PRIVILEGIES = 'ERR_MISSING_PRIVILEGIES';

    const AUTH_LOGIN_SUCCESS = 'AUTH_LOGIN_SUCCESS';
    const AUTH_LOGIN_FAIL = 'AUTH_LOGIN_FAIL';
    const AUTH_LOGIN_FAIL_USER_BANNED = 'AUTH_LOGIN_FAIL_USER_BANNED';
    const AUTH_LOGIN_CHECK_OK = 'AUTH_LOGIN_CHECK_OK';
    const AUTH_LOGIN_CHECK_BAD = 'AUTH_LOGIN_CHECK_BAD';
    const AUTH_LOGIN_WRONG_REMOTE_ADDR = 'AUTH_LOGN_WRONG_REMOTE_ADDR';
    const AUTH_LOGIN_USER_LOGOUT = 'AUTH_LOGIN_USER_LOGOUT';
    const AUTH_LOGIN_FORCE_LOGOUT = 'AUTH_LOGIN_FORCE_LOGOUT';
    const AUTH_LOGIN_CHANGE_USERNAME = 'AUTH_LOGIN_CHANGE_USERNAME';
    const AUTH_LOGIN_CHANGE_PASSWORD = 'AUTH_LOGIN_CHANGE_PASSWORD';


    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }
        return $inst;
    }

    /**
     * Writes a specific log type to db
     *
     * @author micha
     * @date 2014-12-29
     *
     * @param $sType
     * @param null $iUserId
     */
    function logEvent($sType, $iUserId = NULL)
    {
        $oSql = new cMySql();

        if ($iUserId == NULL) {
            $oSql->insertRow('log', ['timestamp' => date('Y-m-d H:i:s'), 'remote_addr' => $_SERVER['REMOTE_ADDR'], 'session_id' => session_id(), 'type' => $sType]);
        } else {
            $oSql->insertRow('log', ['user_id' => $iUserId, 'timestamp' => date('Y-m-d H:i:s'), 'remote_addr' => $_SERVER['REMOTE_ADDR'], 'session_id' => session_id(), 'type' => $sType]);
        }
    }

}