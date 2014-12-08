<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 08.12.2014
 * Time: 17:28
 */

//include classes



if (isset($_GET['module'])) {
    if (file_exists('module' . '/' . $_GET['module'] . '/index.php')) {

        require_once('include/header.php');
        require_once('include/menu.php');
        require_once('module/' . $_GET['module'] . '/index.php');
        require_once('include/footer.php');

    } else {
        //TODO: error
    }
} else {
    //TODO: error
}