<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserDataModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ProfileController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $userDataModel = new UserDataModel();

        // Mendapatkan ID pengguna dari sesi
        $userId = session()->get('id_user');

        // Mendapatkan data pengguna
        $user = $userModel->find($userId);
        $userData = $userDataModel->where('id_user', $userId)->first();

        if (!$user || !$userData) {
            throw new PageNotFoundException("User with ID $userId not found");
        }
        
        
        return view('user/profile/edit', [
            'user' => $user,
            'userData' => $userData
        ]);
    }

    public function update($id)
    {
        // Validasi input
        $rules = [
            'email' => 'valid_email',
            'nama' => 'min_length[3]',
            'kd_pos' => 'numeric',
            'no_telp' => 'numeric',
        ];

        // dd($this->request->getPost(), $this->validate($rules), $id);

        if (!$this->validate($rules)) {
            return redirect()->to('/user/profile')->withInput()->with('validation', $this->validator);
        }


        $userModel = new UserModel();
        $userDataModel = new UserDataModel();

        $user = $userModel->find($id);
        $userData = $userDataModel->where('id_user', $id)->first();

        if (!$user || !$userData) {
            throw new PageNotFoundException("User with ID $id not found");
        }

        // Update user email and password
        $updatedUserData = [
            'email' => $this->request->getPost('email') ?: $user['email'],
        ];

        if ($this->request->getPost('password')) {
            $updatedUserData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $userModel->update($id, $updatedUserData);

        // Handle file upload
        $profileImage = $this->request->getFile('profile');
        $newProfileName = $userData['profile']; // Default to current profile image

        if ($profileImage->isValid() && !$profileImage->hasMoved()) {
            $newProfileName = $profileImage->getRandomName();
            $profileImage->move('uploads/profile', $newProfileName);

            // Delete old profile image if it exists
            if ($userData['profile'] && file_exists('uploads/profile/' . $userData['profile'])) {
                unlink('uploads/profile/' . $userData['profile']);
            }
        }

        // Update user data with new profile image
        $updatedUserDataModel = [
            'nama' => $this->request->getPost('nama') ?: $userData['nama'],
            'alamat' => $this->request->getPost('alamat') ?: $userData['alamat'],
            'kd_pos' => $this->request->getPost('kd_pos') ?: $userData['kd_pos'],
            'no_telp' => $this->request->getPost('no_telp') ?: $userData['no_telp'],
            'profile' => $newProfileName,
        ];

        $userDataModel->update($userData['id'], $updatedUserDataModel);

        return redirect()->to('/user/profile')->with('message', 'Profile updated successfully');
    }
}
