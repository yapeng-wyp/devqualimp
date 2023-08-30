<?php
/*
 * Project-name: devqualimp
 * File-name: Customer.php
 * Author: WU
 * Start-Date: 2023/7/18 12:54
 */

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customer extends BaseController
{
//    /*
    public function index()
    {

        $client_model = model(CustomerModel::class);
        $data['infos'] = $client_model->getInfoById();
        $data['title'] = 'All Cusrtomer Info';
        return view('templates/header',$data)
            . view('customer/index')
            . view('templates/footer');
    }
//    */

    public function view($id = null)
    {
        $client_model = model(CustomerModel::class);
        $data['infos'][] = $client_model->getInfoById($id);
        if (empty($data['infos'])){
            throw new PageNotFoundException('Not have this client : ' . $id);
        }

        $user_model = model(UserModel::class);
        $user_info = $user_model->getUserByClient($id);
        $name = $user_model->getName($user_info['id']);
        $data['user_info'] = $name;

        $data['title'] = 'View Your Own Information';
        $data['sub_title'] = $data['infos'][0]['client_Nom'];
        $data['id'] = $id;
        return view('templates/header',$data)
            . view('customers/view')
            . view('templates/footer');
    }

    public function edit_info($id)
    {
        helper('form');

        if (! $this->request->is('post')){
            return view('templates/header',['title'=>'what','id'=>$id])
                . view('customers/edit_info')
                . view('templates/footer');
        }

        $post = $this->request->getPost(['client_id','cli_name','cli_tel','email','address','password']);

        if (! $this->validateData($post, [
            'client_id'  => 'required|max_length[25]|min_length[1]',
            'cli_name'  => 'required|max_length[25]|min_length[5]',
            'cli_tel'   => 'required|max_length[30]|min_length[9]',
            'email'     => 'required|max_length[50]|min_length[10]',
            'address'   => 'required|max_length[255]min_lenght[5]',
            'password'  => 'required|max_length[32]|min_length[8]',
        ])){
            return view('templates/header',['title'=>'what','id'=>$id])
                . view('customers/edit_info')
                . view('templates/footer');
        }

        $client_model = model(CustomerModel::class);
        $user_model = model(UserModel::class);
        $userId = $user_model->getUserByClient($post['client_id']);

        $client_model->update($post['client_id'],[
            'client_Nom' => $post['client_name'],
            'client_Tel' => $post['client_tel'],
            'client_Email' => $post['email'],
            'client_Adr' => $post['address'],
            'client_status' => 1,
        ]);

        $user_model->update($userId['id'],[
            'client'    => $post['client_id'],
            'password'  => $post['password']
        ]);

        $name = $user_model->getName($userId['id']);

        return view('templates/header',['name' => $name['name']])
            . view('customers/success')
            . view('templates/footer');
    }
}