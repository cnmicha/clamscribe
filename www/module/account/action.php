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

                $sVars = '';
                if ($bUsernameChanged) $sVars .= '&username_changed=true';
                if ($bPasswordChanged) $sVars .= '&password_changed=true';

                if($sVars == '') $sVars = '&nothing_changed=true';

                cRedirect::getInstance()->goToPage('module=account' . $sVars);

            } else cRedirect::getInstance()->goToPage('module=account&wrong_pw=true');
        } else cRedirect::getInstance()->goToPage('module=account');

    }
}



if (isset($_GET['username_changed'])) {
    if ($_GET['username_changed'] == 'true') {
        $cSmarty->assign('username_changed', true);
    } else $cSmarty->assign('username_changed', false);
} else $cSmarty->assign('username_changed', false);


if (isset($_GET['password_changed'])) {
    if ($_GET['password_changed'] == 'true') {
        $cSmarty->assign('password_changed', true);
    } else $cSmarty->assign('password_changed', false);
} else $cSmarty->assign('password_changed', false);


if (isset($_GET['nothing_changed'])) {
    if ($_GET['nothing_changed'] == 'true') {
        $cSmarty->assign('nothing_changed', true);
    } else $cSmarty->assign('nothing_changed', false);
} else $cSmarty->assign('nothing_changed', false);