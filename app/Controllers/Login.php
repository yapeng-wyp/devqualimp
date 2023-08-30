<?php
/*
 * Project-name: devqualimp
 * File-name: Login.php
 * Author: WU
 * Start-Date: 2023/7/19 16:07
 */

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{

    public function index()
    {
        helper('form');
        return view('templates/header')
        . view('login')
        . view('templates/footer');
    }

    public function signIn()
    {
        helper('form');
        $session = session();
        $model = model(UserModel::class);
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();

        if($data){
            $pass = $data['password'];
            if($pass == $password){
                $ses_data = [
                    'user_id'       => $data['id'],
                    'client_id'     => $data['client'],
                    'username'      => $data['username'],
                    'email'         => $data['email'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('login');
            }
        }else{
            $session->setFlashdata('msg', 'username not Found');
            return redirect()->to('login');
        }
    }

    public function logout()
    {
        //todo: user logout
        $session = session();
        $session->destroy();
        return redirect()->to('login');
    }
}