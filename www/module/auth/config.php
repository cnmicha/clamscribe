<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 10.12.2014
 * Time: 19:51
 */

$aModule = array(
    'title' => 'Login',
    'needsLogin' => false,
    'main_page' => 'login'
);

$aPages = array(
    'login' => array(
        'caption' => 'Please enter your login credentials',
        'site_template' => 'main.tpl',

        'action_file' => 'login.php',
        'template_file' => 'login.tpl'
    ),
    'logout' => array(
        'caption' => 'Logout',
        'site_template' => 'main.tpl',

        'action_file' => 'logout.php',
        'template_file' => 'logout.tpl'
    )
);