<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 21.12.2014
 * Time: 14:35
 */

if (isset($_GET['page'])) {
    if ($_GET['page'] == 'save') {
        if (isset($_POST['username']) and isset($_POST['newpass']) and isset($_POST['newpass_again']) and isset($_POST['pass'])) {
            //form was submitted

            //check user password
            if (cAuth::getInstance()->isCorrectPassword(cAuth::getInstance()->getUsernameByUserID(cAuth::getInstance()->getUserId()), $_POST['pass'])) {
                //password is correct

                $bUsernameChanged = false;
                $bPasswordChanged = false;

                if ($_POST['newpass'] == $_POST['newpass_again']) {
                    if ($_POST['newpass'] != '') {
                        //user wants to change his password
                        $bPasswordChanged = cAuth::getInstance()->setNewPassword(cAuth::getInstance()->getUserId(), $_POST['newpass']);
                    }
                }

                if ($_POST['username'] != cAuth::getInstance()->getUsernameByUserID(cAuth::getInstance()->getUserId())) {
                    //user wants to change his username
                    $bUsernameChanged = cAuth::getInstance()->setNewUsername(cAuth::getInstance()->getUserId(), $_POST['username']);
                }

                $aVars = array();
                if ($bUsernameChanged) $aVars['username_changed'] = 'true';
                if ($bPasswordChanged) $aVars['password_changed'] = 'true';

                if($aVars == '') $aVars['nothing_changed'] = 'true';

                cRedirect::getInstance()->goToPage('account' . $aVars);

            } else cRedirect::getInstance()->goToPage('account', ['wrong_pw' => 'true']);
        } else cRedirect::getInstance()->goToPage('account');

    }
}



if (isset($_GET['username_changed'])) {
    if ($_GET['username_changed'] == 'true') {
        $oSmarty->assign('username_changed', true);
    } else $oSmarty->assign('username_changed', false);
} else $oSmarty->assign('username_changed', false);


if (isset($_GET['password_changed'])) {
    if ($_GET['password_changed'] == 'true') {
        $oSmarty->assign('password_changed', true);
    } else $oSmarty->assign('password_changed', false);
} else $oSmarty->assign('password_changed', false);


if (isset($_GET['nothing_changed'])) {
    if ($_GET['nothing_changed'] == 'true') {
        $oSmarty->assign('nothing_changed', true);
    } else $oSmarty->assign('nothing_changed', false);
} else $oSmarty->assign('nothing_changed', false);