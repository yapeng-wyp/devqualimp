<?php
/*
 * Project-name: devqualimp
 * File-name: ReparationMouleValeurModel.php
 * Author: WU
 * Start-Date: 2023/8/17 14:04
 */

namespace App\Models;

use CodeIgniter\Model;

class ReparationMouleValeurModel extends Model
{
    protected $table = 'reparationmoulevaleur';
    protected $allowedFields = ['api_id', 'code', 'description_fr', 'description_cn', 'description_en'];

    public function getAllByLang($lang='cn')
    {
        $description = 'description_'.$lang;
        return $this->select(['id','api_id','code',$description])->findAll();
    }

    public function getSelectedByLang($api_ids,$lang='cn')
    {
        $description = 'description_'.$lang;
        if (count($api_ids) == 0) return false;
        else return $this->select(['code',$description.' as description'])->whereIn('code' ,$api_ids)->findAll();
    }
}