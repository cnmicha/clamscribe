<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 10.12.2014
 * Time: 19:51
 */

$aModule = array(
    'title' => 'traffic data',
    'needsLogin' => true,
    'main_page' => 'index'
);

$aPages = array(
    'index' => array(
        'caption' => 'All protocols',
        'site_template' => 'main.tpl',

        'action_file' => 'index.php',
        'template_file' => 'index.tpl',

        'breadcrumb' => array(
            0 => array(
                'title' => 'Traffic',
                'hrefModuleName' => 'traffic',
                'hrefPageName' => '',
                'hrefQueryStringArr' => array()),
            1 => array(
                'title' => 'All protocols',
                'hrefModuleName' => 'traffic',
                'hrefPageName' => 'index',
                'hrefQueryStringArr' => array()
            )
        )
    ),
    'tcp' => array(
        'caption' => 'All protocols',
        'site_template' => 'main.tpl',

        'action_file' => 'tcp.php',
        'template_file' => 'tcp.tpl',

        'breadcrumb' => array(
            0 => array(
                'title' => 'Traffic',
                'hrefModuleName' => 'traffic',
                'hrefPageName' => '',
                'hrefQueryStringArr' => array()
            ),
            1 => array(
                'title' => 'TCP',
                'hrefModuleName' => 'traffic',
                'hrefPageName' => 'tcp',
                'hrefQueryStringArr' => array()
            )
        )
    )
);