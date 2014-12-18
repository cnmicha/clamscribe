<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 15.12.2014
 * Time: 22:28
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //TODO

    if (isset($_GET['mysql_host']) and isset($_GET['mysql_db']) and isset($_GET['mysql_user']) and isset($_GET['mysql_pass']) and isset($_GET['user']) and
        isset($_GET['pass']) and isset($_GET['pass_again'])
    ) {
        //wizard was submitted

        if (($_GET['mysql_host'] == DB_SERVER_IP) and ($_GET['mysql_db'] == DB_DATABASE_NAME) and ($_GET['mysql_user'] == DB_DATABASE_USER) and ($_GET['mysql_pass'] == DB_DATABASE_PASS) and ($_GET['pass'] == $_GET['pass_again'])) {
            if (cAuth::getInstance()->isValidUsername($_GET['user'])) {
                if (cAuth::getInstance()->setNewPassword(cAuth::getInstance()->getUserIdByUsername($_GET['user']), $_GET['pass']) == true)
                    cRedirect::getInstance()->goToPage('module=recovery&success=true');


            } else cRedirect::getInstance()->goToPage('module=recovery&success=false');

        } else cRedirect::getInstance()->goToPage('module=recovery&success=false');
    }
}

if(isset($_GET['success'])) {
    if($_GET['success'] == 'true') $cSmarty->assign('success', true);
    elseif($_GET['success'] == 'false') $cSmarty->assign('success', false);
    else $cSmarty->assign('success', 'none');
} else $cSmarty->assign('success', 'none');
