<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MenuModel;

class MenuController extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }

    // Menampilkan semua menu
    public function index()
    {
        $data['menu'] = $this->menuModel->findAll();
        $data['title'] = 'Menu';
        return view('user/menu/index', $data);
    }




    // Admin
    public function adminIndex()
    {
        $data['menu'] = $this->menuModel->findAll();
        $data['title'] = 'Menu';
        return view('admin/menu/index', $data);
    }

 
    // Menyimpan menu baru
    public function store()
    {
        // Validasi input
        $validation = $this->validate([
            'nama' => 'required|max_length[50]',
            'keterangan' => 'required',
            'harga' => 'required|numeric',
            'pic' => [
                'uploaded[pic]',
                'mime_in[pic,image/jpg,image/jpeg,image/png]',
                'max_size[pic,2048]',
            ],
        ]);

        if (!$validation) {
            return view('admin/menu/create', ['validation' => $this->validator]);
        }

        // Meng-handle upload gambar
        $file = $this->request->getFile('pic');
        $fileName = $file->getRandomName();
        $file->move('uploads/menu', $fileName);

        $this->menuModel->save([
            'nama' => $this->request->getPost('nama'),
            'keterangan' => $this->request->getPost('keterangan'),
            'harga' => $this->request->getPost('harga'),
            'pic' => 'uploads/menu/' . $fileName,
        ]);

        return redirect()->to('admin/menu');
    }


    // Memperbarui menu
    public function update($id)
    {
        // Validasi input
        $validation = $this->validate([
            'nama' => 'required|max_length[50]',
            'keterangan' => 'required',
            'harga' => 'required|numeric',
            'pic' => [
                'mime_in[pic,image/jpg,image/jpeg,image/png]',
                'max_size[pic,2048]',
            ],
        ]);

        if (!$validation) {
            return view('admin/menu/edit', ['menu' => $this->menuModel->find($id), 'validation' => $this->validator]);
        }

        // Meng-handle upload gambar jika ada
        $file = $this->request->getFile('pic');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/menu', $fileName);
            $picPath = 'uploads/menu/' . $fileName;
        } else {
            $picPath = $this->request->getPost('old_pic');
        }

        $this->menuModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'keterangan' => $this->request->getPost('keterangan'),
            'harga' => $this->request->getPost('harga'),
            'pic' => $picPath,
        ]);

        return redirect()->to('admin/menu');
    }

    // Menghapus menu
    public function delete($id)
    {
        $menu = $this->menuModel->find($id);
        if ($menu) {
            if (file_exists($menu['pic'])) {
                unlink($menu['pic']);
            }
            $this->menuModel->delete($id);
        }
        return redirect()->to('admin/menu');
    }
}
