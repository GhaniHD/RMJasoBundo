<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KeranjangModel;

class KeranjangController extends BaseController
{
    protected $keranjangModel;

    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
    }

    public function index()
    {
        $this->cleanEmptyItems();
        $id_user = session()->get('id_user');

        $data['keranjangItems'] = $this->keranjangModel->getMenu($id_user);
        return view('user/pemesanan/keranjang', $data);
    }

    private function cleanEmptyItems()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('keranjang'); // Ganti dengan nama tabel Anda
        $builder->where('qty', 0);
        $builder->delete();
    }

    public function add()
    {
        if ($this->request->getMethod() === 'post') {
            $data = [
                'user_id' => $this->request->getPost('user_id'),
                'kode_menu' => $this->request->getPost('kode_menu'),
                'qty' => $this->request->getPost('qty')
            ];

            $this->keranjangModel->insert($data);
            return redirect()->to('/keranjang');
        }
        return view('user/pemesanan/add_keranjang');
    }

    public function edit($id)
    {

        $data['keranjang'] = $this->keranjangModel->find($id);
        return view('user/pemesanan/edit_keranjang', $data);
    }

    public function update($id)
    {
        $data = [
            'qty' => $this->request->getPost('qty')
        ];


        $this->keranjangModel->update($id, $data);
        return redirect()->to('/user/keranjang')->with('success', 'Order updated successfully');
    }


    public function delete($id)
    {
        $this->keranjangModel->delete($id);
        return redirect()->to('/user/keranjang');
    }
}
