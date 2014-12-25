<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 14.12.14
 * Time: 02:45
 */


$oSmarty->assign('page', 'login');

if (isset($_GET['fail'])) {
    if ($_GET['fail'] == 'true') {
        $oSmarty->assign('fail', true);
    } else $oSmarty->assign('fail', false);
} else $oSmarty->assign('fail', false);


if (!cAuth::getInstance()->isLoggedIn()) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['user']) && isset($_POST['pass'])) {
            if (cAuth::getInstance()->doLogin($_POST['user'], $_POST['pass'])) {
                //login successful
                cRedirect::getInstance()->goToPage('dashboard');
            } else {
                cRedirect::getInstance()->goToPage('auth', 'login', ['fail' => 'true']);
            }
        }
    }

} else {
    cRedirect::getInstance()->goToPage();
    echo('user already lin');
}


