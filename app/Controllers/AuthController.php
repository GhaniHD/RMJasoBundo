<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;


class AuthController extends BaseController
{
    protected $userModel;
    protected $userDataModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userDataModel = new \App\Models\UserDataModel();
    }

    public function register()
    {
        return view('auth/register');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function registerAction()
    {
        $rules = [
            'email' => 'required|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'matches[password]',
            'no_telp' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator);
        }



        $data = [
            'email' => $this->request->getPost('email'),
            'password' => password_hash((string)$this->request->getPost('password'), PASSWORD_DEFAULT),
            'level' => 'user',
        ];

        if (
            $this->userModel->insert($data) &&
            $this->userDataModel->insert([
                'id_user' => $this->userModel->getInsertID(),
                'no_telp' => $this->request->getPost('no_telp'),
            ])
        ) {
            return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
        } else {
            return redirect()->back()->with('errors', $this->userModel->errors())->withInput();
        }
    }

    public function loginAction()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify((string)$password, $user['password'])) {
            $sessionData = [
                'id_user' => $user['id_user'],
                'email' => $user['email'],
                'level' => $user['level'],
                'logged_in' => true,
            ];
            session()->set($sessionData);

            if ($user['level'] === 'admin') {
                return redirect()->to('/admin/dashboard')->with('success', 'Selamat Datang Admin.');
            } else {
                return redirect()->to('/user/dashboard')->with('success', 'Selamat Datang User.');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau password salah')->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda berhasil logout.');
    }
}
