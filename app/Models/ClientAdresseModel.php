<?php
/*
 * Project-name: devqualimp
 * File-name: ClientAdresseModel.php
 * Author: WU
 * Start-Date: 2023/8/16 16:56
 */

namespace App\Models;

use CodeIgniter\Model;

class ClientAdresseModel extends Model
{
    protected $table = 'clientadresse';
    protected $allowedFields = ['api_id', 'client', 'adresse', 'default'];

    public function getAdrInfo($client)
    {
        if ($client != null) return $this->select(['id','adresse','default'])->where(['client' => $client])->findAll();
        else return $this->errors();
    }

    public function get_api_id($client)
    {
        if ($client != null) return $this->select('api_id')->where(['client' => $client])->first();
        else return $this->errors();
    }
}