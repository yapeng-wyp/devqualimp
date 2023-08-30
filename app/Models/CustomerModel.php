<?php
/*
 * Project-name: devqualimp
 * File-name: CustomerModel.php
 * Author: WU
 * Start-Date: 2023/7/18 12:48
 */

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $allowedFields = ['client_Nom', 'api_key', 'client_Tel', 'client_Email', 'client_Adr', 'client_status'];

    public function getInfoById($id= null){
        if ($id == null) {
            return $this->findAll();
        }
        return $this->where(['id' => $id ])->first();
    }
}