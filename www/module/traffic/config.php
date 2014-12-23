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
        'template_file' => 'index.tpl'
    ),
    'tcp' => array(
        'caption' => 'All protocols',
        'site_template' => 'main.tpl',

        'action_file' => 'tcp.php',
        'template_file' => 'tcp.tpl'
    )
);