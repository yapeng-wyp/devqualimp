<?php
/*
 * Project-name: devqualimp
 * File-name: LedgerModel.php
 * Author: WU
 * Start-Date: 2023/8/25 10:06
 */

namespace App\Models;

use CodeIgniter\Model;

class LedgerModel extends Model
{
    protected $table = 'ledger';
    protected $allowedFields = ['id','client','factory','name','assetnum','datebought','quantite','daterepair','datereception','datedispatch','questions','schedule','final'];

    public function getAll($client)
    {
        if ($client == null) return false;
        else return $this->select('ledger.*, clientadresse.adresse as factory_name')->join('clientadresse', 'clientadresse.id = ledger.factory','LEFT')->where(['ledger.client' => $client])->orderBy('datecreation' , 'DESC')->findAll();
    }

}