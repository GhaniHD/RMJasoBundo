<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        //

        $menuModel = new \App\Models\MenuModel();
        $data = [
            'title' => 'Dashboard',
            'menu' => $menuModel->findAll()
        ];

        return view('user/dashboard', $data);
    }
}
