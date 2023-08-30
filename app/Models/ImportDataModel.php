<?php
/*
 * Project-name: devqualimp
 * File-name: ImportDataModel.php
 * Author: WU
 * Start-Date: 2023/8/16 10:04
 */

namespace App\Models;

use CodeIgniter\Model;

class ImportDataModel extends Model
{
    protected $tables = [];

    public function import()
    {
        $allData = get_all_data(null);
    }
}