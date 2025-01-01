<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserDataModel;


class AdminController extends BaseController
{
    public function index()
    {
        //
        return view('admin/dashboard');
    }

    // Mengelola User 
    public function user()
    {
        $UserDaUserDataModel = new UserDataModel();
        $data['users'] = $UserDaUserDataModel->getUserData();
        // dd($data);

        return view('admin/user/index', $data);
    }
}
