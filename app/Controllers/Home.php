<?php

namespace App\Controllers;

use app\Models\CustomerModel;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
//        /*
//        helper('form');
        $data['title'] = 'Index';
        $user_id = session()->get('user_id');
        $user = model(UserModel::class);
        $cli = $user->getUser($user_id);
        $client_id = $cli['client'];
        $client = model(CustomerModel::class);
        $api_keys = $client->select('api_key')->where(['id' => $client_id])->first();


        $file_url = 'http://beta.qualiinfo.cn:65495/api/reparationmoule.php?1';
        $file_url .= '&api_key='.$api_keys['api_key'];
        $result = file_get_contents($file_url);
//        list($max_fac,$total_moule,$max_operation,$moule_max)= $this->dealwithData(json_decode($result));
//        $data['max_fac'] = $max_fac ? $max_fac : '';
//        $data['total_moule'] = $total_moule ? $total_moule : '';
//        $data['max_operation'] = $max_operation ? $max_operation : '';
//        $data['moule_max'] = $moule_max ? $moule_max : '';

        $data['max_fac'] = 0;
        $data['total_moule'] = 0;
        $data['max_operation'] = 0;
        $data['moule_max'] = 0;

        return view('templates/header',$data)
            . view('index')
            . view('templates/footer');
//        */

//        return view('welcome_message');
    }

    public function dealwithData($data = null)
    {
        $operation_arr = array();
        $new_op_arr = [];
        $fac_arr = array();
        $i = 0;
        foreach ($data as $key => $jsonObj){
            $i++;
            $moule_arr[] = $jsonObj->tracabiliteclient;
            $fac_arr[$key] = $jsonObj->usine;
            foreach ($jsonObj->operation as $operation){
                $operation_arr[]  = $operation;
            }
        }

        foreach ($operation_arr as $key =>$value){
            $new_op_arr[$key] = count($value);
        }

        if (count($new_op_arr) <= 0) return false;
        $max_op = max($new_op_arr);
        $max_key = array_keys($new_op_arr,$max_op);

        $fac_arr_val = max($fac_arr);
        $moule_arr_val = max($moule_arr);

        return [$fac_arr_val,count($moule_arr) ,$max_key[0],$moule_arr_val];
    }
}
