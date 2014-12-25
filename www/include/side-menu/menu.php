<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 25.12.2014
 * Time: 20:40
 */


$aMenuElements = array();


$aMenuElements[] = array(
    'title' => 'Dashboard',
    'icon' => 'fa-dashboard',
    'href' => cRedirect::getInstance()->getPageLink('dashboard'),
    'badge' => array(),

    'treeElements' => array()
);

$aMenuElements[] = array(
    'title' => 'coming soon',
    'icon' => 'fa-th',
    'href' => '#',
    'badge' => array(
        0 => array(
            'properties' => array(
                0 => 'pull-right',
                1 => 'bg-green'
            ),
            'text' => 'new'
        )
    ),

    'treeElements' => array()
);

$aMenuElements[] = array(
    'title' => 'Traffic Overview',
    'icon' => 'fa-bar-chart-o',
    'href' => '#',
    'badge' => array(),

    'treeElements' => array()
);

$aMenuElements[] = array(
    'title' => 'Registered NICs',
    'icon' => 'fa-laptop',
    'href' => '#',
    'badge' => array(),

    'treeElements' => array()
);

$aMenuElements[] = array(
    'title' => 'Registered NICs',
    'icon' => 'fa-edit',
    'href' => '#',
    'badge' => array(),

    'treeElements' => array(
        0 => array(
            'title' => 'Account',
            'href' => cRedirect::getInstance()->getPageLink('account'),

            'treeElements' => array()
        ),
        1 => array(
            'title' => 'comig soonn',
            'href' => '#',

            'treeElements' => array()
        )
    )
);

$aMenuElements[] = array(
    'title' => 'Traffic Data',
    'icon' => 'fa-table',
    'href' => cRedirect::getInstance()->getPageLink('traffic'),
    'badge' => array(),

    'treeElements' => array(
        0 => array(
            'title' => 'All Protocols',
            'href' => cRedirect::getInstance()->getPageLink('taffic'),

            'treeElements' => array()
        ),
        1 => array(
            'title' => 'TCP',
            'href' => cRedirect::getInstance()->getPageLink('traffic', 'tcp'),

            'treeElements' => array()
        )
    )
);