<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 10.12.2014
 * Time: 19:51
 */

$aModule = array(
    'title' => 'Password recovery',
    'needsLogin' => false,
    'main_page' => 'index'
);

$aPages = array(
    'index' => array(
        'caption' => '',
        'site_template' => 'empty.tpl',

        'action_file' => 'index.php',
        'template_file' => 'index.tpl',

        'breadcrumb' => array(
            0 => array(
                'title' => 'Recovery',
                'hrefModuleName' => 'recovery',
                'hrefPageName' => '',
                'hrefQueryStringArr' => array()
            )
        )
    )
);