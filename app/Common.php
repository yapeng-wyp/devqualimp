<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

use Symfony\UX\Chartjs\Model\Chart;

define('QUALI_URL', 'http://beta.qualiinfo.cn:65495');

if (!function_exists('OrganizeData')){
    function OrganizeData($data)
    {

        return $data;
    }
}

if (!function_exists('get_data')){
    function get_data($cli_api_key,$factory=null,$moule=null,$cli_moule=null,$recep_min=null,$recep_max=null,$dispatch_min=null,$dispatch_max=null){

//        die(''.QUALI_URL.'/api/reparationmoule.php?1&key='.$cli_api_key.'&clientadresse='.$factory.'&tracabiliteinterne='.$moule.'&tracabiliteclient='.$cli_moule.'&date_rec_min='.$recep_min.'&date_rec_max='.$recep_max.'&date_liv_min='.$dispatch_min.'&date_liv_max='.$dispatch_max.'');
        $result = file_get_contents(''.QUALI_URL.'/api/reparationmoule.php?1&key='.$cli_api_key.'&clientadresse='.$factory.'&tracabiliteinterne='.$moule.'&tracabiliteclient='.$cli_moule.'&date_rec_min='.$recep_min.'&date_rec_max='.$recep_max.'&date_liv_min='.$dispatch_min.'&date_liv_max='.$dispatch_max.'');
        return $result;
    }
}

