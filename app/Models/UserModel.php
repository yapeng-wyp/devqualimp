<?php
/*
 * Project-name: devqualimp
 * File-name: UserModel.php
 * Author: WU
 * Start-Date: 2023/7/19 10:01
 */

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'utilisateur';
    protected $allowedFields = ['client', 'password', 'nom', 'prenom', 'email', 'tel','is_client','id_enable'];

    public function getUser($id)
    {
        if ($id == null){
//            throw new Cannot
            return json_encode(array('404'=>'user id cannot empty'));
        }

        return $this->where(['id' => $id])->first();
    }

    public function getUserByClient($client){
        // code ...
        return $this->select('id')->where(['client' => $client])->first();
    }

    /*
     * @param Array return a username
     */
    public function getName($id)
    {
        return $this->select('CONCAT(`nom`,\' \' , `prenom`) as name')->where(['id' => $id])->first();
    }

    public function login($username,$password){
        //...
        return $this->select('COUNT(`id`) as num')->where(['username' => $username, 'password' => $password])->findAll();
    }

    public function getIdByUser($username,$password)
    {
        return $this->select(['client','api_key'])->where(['username' => $username, 'password' => $password])->first();
    }

}