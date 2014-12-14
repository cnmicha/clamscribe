<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 11.12.2014
 * Time: 21:01
 */

if (isset($_GET['protocol'])) {
    switch ($_GET['protocol']) {
        case 'tcp':
            $oSmarty->assign('page', 'tcp');

            $cMySql = new cMySql();

            $aTraffic = $cMySql->selectArray('traffic');

            foreach ($aTraffic as $key => $aData) {
                if (!($aData['request_protocol'] == 'TCP' or $aData['response_protool'])) {
                    unset($aTraffic[$key]); //remove non-tcp
                    $aTraffic = array_values($aTraffic); //reindex
                } else {
                    $aTraffic[$key]['source_port'] = ltrim($aTraffic[$key]['source_port'], '0'); //remove leading zeroes
                    $aTraffic[$key]['dest_port'] = ltrim($aTraffic[$key]['dest_port'], '0');
                }
            }

            $oSmarty->assign('traffic_arr', $aTraffic);

            break;

        default:
            $oSmarty->assign('page', 'all');

            $cMySql = new cMySql();

            $aTraffic = $cMySql->selectArray('traffic');

            foreach ($aTraffic as $key => $aData) {
                    $aTraffic[$key]['source_port'] = ltrim($aTraffic[$key]['source_port'], '0'); //remove leading zeroes
                    $aTraffic[$key]['dest_port'] = ltrim($aTraffic[$key]['dest_port'], '0');
            }

            $oSmarty->assign('traffic_arr', $aTraffic);

            break;
    }
} else {

}