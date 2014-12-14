<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 14.12.14
 * Time: 02:45
 */

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'edit':
            $cSmarty->assign('page', 'edit');
            //TODO password change

            break;

        case 'login':
            $cSmarty->assign('page', 'login');

            if (!cAuth::getInstance()->isLoggedIn()) {

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['user']) && isset($_POST['pass'])) {
                        if (cAuth::getInstance()->doLogin($_POST['user'], $_POST['pass'])) {
                            //login successful
                            echo('login success');
                            cRedirect::getInstance()->goToPage();
                        } else {
                        }
                    }
                }

            } else {
                cRedirect::getInstance()->goToPage();
                echo('user already lin');
            }

            break;

        case 'logout':
            $cSmarty->assign('page', 'logout');
            cAuth::getInstance()->userLogout();

            break;

        default:
            $cSmarty->assign('page', 'login');


            break;
    }
} else {
    cRedirect::getInstance()->goToPage('module=auth&action=login');

}
