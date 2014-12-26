<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 10.12.2014
 * Time: 19:51
 */

$aModule = array(
    'title' => 'Dashboard',
    'needsLogin' => true,
    'main_page' => 'index'
);

$aPages = array(
    'index' => array(
        'caption' => 'Control panel',
        'site_template' => 'main.tpl',

        'action_file' => 'index.php',
        'template_file' => 'index.tpl',

        'breadcrumb' => array(
            0 => array(
                'title' => 'Dashboard',
                'hrefModuleName' => 'dashboard',
                'hrefPageName' => '',
                'hrefQueryStringArr' => array()
            )
        )
    )
);