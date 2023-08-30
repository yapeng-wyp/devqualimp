<?php
/*
 * Project-name: devqualimp
 * File-name: Detail.php
 * Author: WU
 * Start-Date: 2023/7/24 12:40
 */

namespace App\Controllers;

use App\Models\ClientAdresseModel;
use App\Models\CustomerModel;
use App\Models\ReparationMouleValeurModel;

class Detail extends BaseController
{
    public function index()
    {
        //todo: detail
        $session = session();
        $client_id = $session->get('client_id');

        $client = model(CustomerModel::class);
        $api_keys = $client->select('api_key')->where(['id' => $client_id])->first();
        helper('form');
        $cliadr = model(ClientAdresseModel::class);
        $adrs = $cliadr->getAdrInfo($client_id);
//        echo '<pre>';print_r($adrs);echo '</pre>';die;
        $all_data = get_data($api_keys['api_key']);

        $rmvalue = model(ReparationMouleValeurModel::class);

        $json_arr = json_decode($all_data);
        $rmval = $rmvalue->getSelectedByLang($json_arr[0]->operation);


        $data['all_data'] = json_decode($all_data);
        $data['rmval'] = $rmval;
        $data['adrs'] = $adrs;
        return view('templates/header',$data)
            . view('details/detail')
            . view('templates/footer');
    }

    public function filters()
    {
        helper('form');
        $post = $this->request->getPost(['sel_factory','moule_code','cli_moule_code','reacp_date_min','reacp_date_max','bonlivraison_date_min','bonlivraison_date_max']);

        $data['search'] = $post;

        $session = session();
        $client_id = $session->get('client_id');
        $client = model(CustomerModel::class);
        $api_key = $client->select('api_key')->where(['id' => $client_id])->first();

        $cliadr = model(ClientAdresseModel::class);
        $adrs = $cliadr->getAdrInfo($client_id);
        $adr_api = $cliadr->get_api_id($post['sel_factory']);
        $data['adrs'] = $adrs;
        
        $mouledata = get_data($api_key['api_key'],$adr_api['api_id']?? '',$post['moule_code']?? '',$post['cli_moule_code']?? '',$post['reacp_date_min']?? '',$post['reacp_date_max']?? '',$post['bonlivraison_date_min']?? '',$post['bonlivraison_date_max']?? '');
        $rmvalue = model(ReparationMouleValeurModel::class);
        $rmval = $rmvalue->getAllByLang();
        $json_arr = json_decode($mouledata);
        $rmval = $rmvalue->getSelectedByLang($json_arr[0]->operation);
        $data['rmval'] = $rmval;
        
        $data['all_data'] = json_decode($mouledata);
        return view('templates/header',$data)
            . view('details/detail')
            . view('templates/footer');
    }
}