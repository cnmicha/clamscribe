<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 23.12.2014
 * Time: 01:52
 */


$oSmarty->assign('page', 'logout');
cAuth::getInstance()->userLogout();