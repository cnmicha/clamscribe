<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 08.12.2014
 * Time: 17:28
 */

//include classes?




if (isset($_GET['module'])) {
    cDisplay::getInstance()->displayModule($_GET['module']);
} else {
    cDisplay::getInstance()->displayModule('index');
}