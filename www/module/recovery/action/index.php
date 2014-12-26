<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 15.12.2014
 * Time: 22:28
 */


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'submit') {

        if (isset($_POST['mysql_host']) and isset($_POST['mysql_db']) and isset($_POST['mysql_user']) and isset($_POST['mysql_pass']) and isset($_POST['user']) and
            isset($_POST['pass']) and isset($_POST['pass_again'])
        ) {
            //wizard was submitted

            if (($_POST['mysql_host'] == DB_SERVER_IP) and ($_POST['mysql_db'] == DB_DATABASE_NAME) and ($_POST['mysql_user'] == DB_DATABASE_USER) and ($_POST['mysql_pass'] == DB_DATABASE_PASS) and ($_POST['pass'] == $_POST['pass_again'])) {

                if (cAuth::getInstance()->isValidUsername($_POST['user'])) {

                    if (cAuth::getInstance()->setNewPassword(cAuth::getInstance()->getUserIdByUsername($_POST['user']), $_POST['pass']))

                        cRedirect::getInstance()->goToPage('recovery', null, ['success' => 'true']);


                } else cRedirect::getInstance()->goToPage('recovery', null, ['success' => 'false', 'step' => '2']);


            } else cRedirect::getInstance()->goToPage('recovery', null, ['success' => 'false', 'step' => '1']);

        }
    }
}


if (isset($_GET['success'])) {
    switch ($_GET['success']) {
        case 'true':
            $oSmarty->assign('success', true);
            break;

        case 'false':
            $oSmarty->assign('success', false);
            break;

        default:
            $oSmarty->assign('success', 'none');
            break;
    }
} else $oSmarty->assign('success', 'none');
