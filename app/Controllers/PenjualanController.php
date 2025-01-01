<?php

namespace App\Controllers;

use App\Models\PenjualanModel;
use App\Models\PesananModel;

class PenjualanController extends BaseController
{
    public function index()
    {
        $penjualanModel = new PenjualanModel();
        $data['penjualan'] = $penjualanModel->getPenjualan();

        // Ambil data no_pesanan untuk Select2
        $pesananModel = new PesananModel();
        $data['pesanan'] = $pesananModel->findAll();

        return view('admin/penjualan/index', $data);
    }

    public function store()
    {
        $penjualanModel = new PenjualanModel();
        $data = [
            'no_pesanan' => $this->request->getPost('no_pesanan'),
            'tgl_masukan' => $this->request->getPost('tgl_masukan'),
            'modal' => $this->request->getPost('modal'),
            'keuntungan' => $this->request->getPost('keuntungan'),
        ];
        $penjualanModel->save($data);

        return redirect()->to('admin/penjualan/');
    }

    public function update($id)
    {
        $penjualanModel = new PenjualanModel();
        $data = [
            'no' => $id,
            'no_pesanan' => $this->request->getPost('no_pesanan'),
            'tgl_masukan' => $this->request->getPost('tgl_masukan'),
            'modal' => $this->request->getPost('modal'),
            'keuntungan' => $this->request->getPost('keuntungan'),
        ];
        $penjualanModel->update($id, $data);

        return redirect()->to('admin/penjualan/');
    }

    public function delete($id)
    {
        $penjualanModel = new PenjualanModel();
        $penjualanModel->delete($id);

        return redirect()->to('admin/penjualan/');
    }

    // Menambahkan metode untuk melihat laporan
    public function laporanPenjualan()
    {
        $penjualanModel = new PenjualanModel();
        $data['penjualan'] = $penjualanModel->getPenjualan(); // Mengambil semua data penjualan

        return view('admin/LaporanPenjualan', $data);
    }

}
