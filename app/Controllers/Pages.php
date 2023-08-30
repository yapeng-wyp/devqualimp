<?php
/*
 * Project-name: devqualimp
 * File-name: Pages.php
 * Author: WU
 * Start-Date: 2023/7/18 10:09
 */

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Pages extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function view($page="home")
    {
        // ...
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')){
            throw new PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page);

        return view('templates/header',$data)
            . view('pages/' . $page)
            . view('templates/footer');
    }
}