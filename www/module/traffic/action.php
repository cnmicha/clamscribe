<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 11.12.2014
 * Time: 21:01
 */

if(isset($_GET['protocol'])) {
    switch($_GET['protocol']) {
        case 'tcp':
            $oSmarty->assign('page', 'tcp');
            break;

        default:
            //TODO

            $oSmarty->assign('page', 'default');
            break;
    }
} else {
    $oSmarty->assign('page', 'default');

}