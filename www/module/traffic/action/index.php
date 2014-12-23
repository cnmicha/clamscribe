<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 11.12.2014
 * Time: 21:01
 */


$cMySql = new cMySql();

$aTraffic = $cMySql->selectArray('traffic');

foreach ($aTraffic as $key => $aData) {
    $aTraffic[$key]['source_port'] = ltrim($aTraffic[$key]['source_port'], '0'); //remove leading zeroes
    $aTraffic[$key]['dest_port'] = ltrim($aTraffic[$key]['dest_port'], '0');
}

$oSmarty->assign('traffic_arr', $aTraffic);
