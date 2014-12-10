<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 08.12.2014
 * Time: 17:28
 */

//include classes?
require_once('class/display.class.php');
require_once('class/error.class.php');




if (isset($_GET['module'])) {
    cDisplay::getInstance()->displayModule($_GET['module']);
} else {
    cDisplay::getInstance()->displayModule('index');
}