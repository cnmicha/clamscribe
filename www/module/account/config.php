<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 10.12.2014
 * Time: 19:51
 */

$aModule = array(
    'title' => 'Account',
    'needsLogin' => true,
    'main_page' => 'index'
);

$aPages = array(
    'index' => array(
        'caption' => 'Change account settings',
        'site_template' => 'main.tpl',

        'action_file' => 'index.php',
        'template_file' => 'index.tpl',

        'breadcrumb' => array(
            0 => array(
                'title' => 'Settings',
                'hrefModuleName' => 'account',
                'hrefPageName' => '',
                'hrefQueryStringArr' => array()
            ),
            1 => array(
                'title' => 'Account',
                'hrefModuleName' => 'account',
                'hrefPageName' => 'index',
                'hrefQueryStringArr' => array()
            )
        )
    )
);