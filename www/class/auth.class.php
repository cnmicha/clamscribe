<?php

/**
 * Created by PhpStorm.
 * User: micha
 * Date: 14.12.14
 * Time: 02:34
 */
class cAuth
{

    const LOGIN_SUCCESS = 'LOGIN_SUCCESS';
    const LOGIN_FAIL = 'LOGIN_FAIL';
    const LOGIN_FAIL_USER_BANNED = 'LOGIN_FAIL_USER_BANNED';
    const LOGIN_CHECK_OK = 'LOGIN_CHECK_OK';
    const LOGIN_CHECK_BAD = 'LOGIN_CHECK_BAD';
    const LOGIN_WRONG_REMOTE_ADDR = 'LOGN_WRONG_REMOTE_ADDR';
    const LOGIN_USER_LOGOUT = 'LOGIN_USER_LOGOUT';
    const LOGIN_FORCE_LOGOUT = 'LOGIN_FORCE_LOGOUT';

    private $randomState;
    private $rounds;

    /**
     * Singleton pattern
     *
     * @author micha
     * @date 2014-12-14
     *
     * @return cAuth
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
     * Check if provided login data is valid and if it is, log user in
     *
     * @author micha
     * @date 2014-12-14
     *
     * @param $sUsername
     * @param $sPassword
     * @return bool
     */
    function doLogin($sUsername, $sPassword)
    {
        //check for valid credentials
        $oSql = new cMySql();
        $aUser = $oSql->selectOne('login_credentials', ['user' => trim($sUsername)]);

        if (is_array($aUser)) {
            if ((self::saltPassword($sPassword, $aUser['salt']) == $aUser['salted_pw_hash'])) {
                if ($aUser['is_banned'] == 0) {

                    //login success

                    self::logAuthAction(self::LOGIN_SUCCESS, $aUser['id']);
                    $_SESSION['angemeldet'] = true;
                    $_SESSION['user_id'] = $aUser['id'];
                    $_SESSION['login_remote_addr'] = $_SERVER['REMOTE_ADDR'];


                    return true;
                } else {
                    self::logAuthAction(self::LOGIN_FAIL_USER_BANNED, $aUser['id']);

                }
            }
        }


        //login fail
        if (is_array($aUser)) {
            self::logAuthAction(self::LOGIN_FAIL, $aUser['id']);
        } else {
            self::logAuthAction(self::LOGIN_FAIL);
        }

        return false;
    }

    /***
     * Checks if user is still logged in, if not, do logout
     *
     * @author micha
     * @date 2014-12-14
     *
     * @return bool
     */
    function isLoginValid()
    {
        $oSql = new cMySql();

        $niUserId = NULL;

        if (isset($_SESSION['user_id']) && isset($_SESSION['angemeldet']) && isset($_SESSION['login_remote_addr'])) {
            $aUser = $oSql->selectOne('login_credentials', ['id' => $_SESSION['user_id']]);

            if (is_array($aUser)) {
                $niUserId = $aUser['id'];

                if ($aUser['is_banned'] == 0) {
                    if (self::checkRemoteAddr()) {
                        if ($_SESSION['angemeldet'] == true) {
                            //login ok
                            self::logAuthAction(self::LOGIN_CHECK_OK, $niUserId);


                            return true;
                        }
                    }
                } else {
                    self::logAuthAction(self::LOGIN_FAIL_USER_BANNED, $aUser['id']);

                }
            }

        }

        //logout user
        self::forceLogout();

        self::logAuthAction(self::LOGIN_CHECK_BAD, $niUserId);

        return false;
    }

    /**
     * Destroys session data to log the user out.
     *
     * @author micha
     * @date 2014-12-14
     *
     */
    function userLogout()
    {
        $inUserId = NULL;
        if (isset($_SESSION['user_id'])) $inUserId = $_SESSION['user_id'];


        session_destroy();

        self::logAuthAction(self::LOGIN_USER_LOGOUT, $inUserId);
    }

    /**
     * Destroys session data to log the user out.
     *
     * @author micha
     * @date 2014-12-14
     */
    function forceLogout()
    {
        $inUserId = NULL;
        if (isset($_SESSION['user_id'])) $inUserId = $_SESSION['user_id'];


        session_destroy();

        self::logAuthAction(self::LOGIN_FORCE_LOGOUT, $inUserId);
    }

    /**
     * do IP-check
     *
     * @author micha
     * @date 2014-12-14
     *
     * @return bool
     */
    function checkRemoteAddr()
    {
        return $_SESSION['login_remote_addr'] == $_SERVER['REMOTE_ADDR'];
    }

    /**
     * salts a string
     *
     * @author micha
     * @date 2014-12-14
     *
     * @param $sPassword
     * @param $sSalt
     * @return string
     */
    function saltPassword($sPassword, $sSalt)
    {
        return hash('sha1', $sPassword . $sSalt);
    }

    /**
     * Writes a specific log type to db
     *
     * @author micha
     * @date 2014-12-14
     *
     * @param $sType
     * @param null $iUserId
     */
    function logAuthAction($sType, $iUserId = NULL)
    {
        $oSql = new cMySql();

        if ($iUserId == NULL) {
            $oSql->insertRow('login_log', ['timestamp' => date('Y-m-d H:i:s'), 'remote_addr' => $_SERVER['REMOTE_ADDR'], 'type' => $sType]);
        } else {
            $oSql->insertRow('login_log', ['user_id' => $iUserId, 'timestamp' => date('Y-m-d H:i:s'), 'remote_addr' => $_SERVER['REMOTE_ADDR'], 'type' => $sType]);
        }
    }

    /**
     * checks if user is logged in at the moment but does not log out
     *
     * @author micha
     * @date 2014-12-14
     *
     * @return bool
     */
    function isLoggedIn()
    {
        $oSql = new cMySql();


        if (isset($_SESSION['user_id']) && isset($_SESSION['angemeldet']) && isset($_SESSION['login_remote_addr'])) {
            $aUser = $oSql->selectOne('login_credentials', ['id' => $_SESSION['user_id']]);

            if (is_array($aUser)) {

                if ($aUser['is_banned'] == 0) {
                    if (self::checkRemoteAddr()) {
                        if ($_SESSION['angemeldet'] == true) {
                            //login ok

                            return true;
                        }
                    }
                }
            }

        }

        return false;
    }

    /**
     * Returns username fitting to provided user id
     *
     * @author micha
     * @date 2014-12-14
     *
     * @param $iUserId
     * @return mixed
     */
    function getUsernameByUserID($iUserId)
    {
        $oSql = new cMySql();
        $aUser = $oSql->selectOne('login_credentials', ['id' => $iUserId]);

        return $aUser['user'];
    }

    function getUserIdByUsername($sUsername)
    {
        $oSql = new cMySql();
        $aUser = $oSql->selectOne('login_credentials', ['user' => $sUsername]);

        return $aUser['id'];
    }

    function isValidUsername($sUsername) {
        $oSql = new cMySql();
        $aUser = $oSql->selectOne('login_credentials', ['user' => $sUsername]);

        if((!$aUser['user'] == NULL) and (!$aUser['is_banned'] == 1)) return true;
        else return false;
    }

    function setNewPassword($iUserId, $sCleartextPassword) {
        $sSalt = self::generateSalt();
        $sSaltedPw = self::saltPassword($sCleartextPassword, $sSalt);

        $oSql = new cMySql();
        $aUser = $oSql->selectOne('login_credentials', ['id' => $iUserId]);

        if($aUser['user'] == NULL) return false;

        if($oSql->insertUpdate('login_credentials', ['salted_pw_hash' => $sSaltedPw, 'salt' => $sSalt], ['id' => $iUserId]) != false) return true;
        return false;
    }

    /**
     * Returns user-id if user is logged in, otherwise NULL
     *
     * @author micha
     * @date 2014-12-14
     *
     * @return mixed
     */
    function getUserId()
    {
        if (isset($_SESSION['user_id'])) return $_SESSION['user_id'];
        return NULL;
    }

    function generateSalt()
    {
        $salt = sprintf('$2a$%02d$', $this->rounds);

        $bytes = $this->getRandomBytes(16);

        $salt .= $this->encodeBytes($bytes);

        return $salt;
    }

    private function getRandomBytes($count)
    {
        $bytes = '';

        if (function_exists('openssl_random_pseudo_bytes') &&
            (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN')
        ) { // OpenSSL slow on Win
            $bytes = openssl_random_pseudo_bytes($count);
        }

        if ($bytes === '' && is_readable('/dev/urandom') &&
            ($hRand = @fopen('/dev/urandom', 'rb')) !== FALSE
        ) {
            $bytes = fread($hRand, $count);
            fclose($hRand);
        }

        if (strlen($bytes) < $count) {
            $bytes = '';

            if ($this->randomState === null) {
                $this->randomState = microtime();
                if (function_exists('getmypid')) {
                    $this->randomState .= getmypid();
                }
            }

            for ($i = 0; $i < $count; $i += 16) {
                $this->randomState = md5(microtime() . $this->randomState);

                if (PHP_VERSION >= '5') {
                    $bytes .= md5($this->randomState, true);
                } else {
                    $bytes .= pack('H*', md5($this->randomState));
                }
            }

            $bytes = substr($bytes, 0, $count);
        }

        return $bytes;
    }

    private function encodeBytes($input)
    {
        // The following is code from the PHP Password Hashing Framework
        $itoa64 = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        $output = '';
        $i = 0;
        do {
            $c1 = ord($input[$i++]);
            $output .= $itoa64[$c1 >> 2];
            $c1 = ($c1 & 0x03) << 4;
            if ($i >= 16) {
                $output .= $itoa64[$c1];
                break;
            }

            $c2 = ord($input[$i++]);
            $c1 |= $c2 >> 4;
            $output .= $itoa64[$c1];
            $c1 = ($c2 & 0x0f) << 2;

            $c2 = ord($input[$i++]);
            $c1 |= $c2 >> 6;
            $output .= $itoa64[$c1];
            $output .= $itoa64[$c2 & 0x3f];
        } while (1);

        return $output;
    }
}
