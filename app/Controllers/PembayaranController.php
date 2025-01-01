<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\PesananModel;

class PembayaranController extends BaseController
{

    public function upload()
    {
        $model = new PembayaranModel();
        $data = $model->where('no_pesanan', session()->get('no_pesanan'))->first();

        return view('user/pembayaran/uploadBuktiPembayaran', [
            'title' => 'Upload Bukti Pembayaran',
            'data' => $data,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function uploadAction()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'bukti_pembayaran' => 'uploaded[bukti_pembayaran]|max_size[bukti_pembayaran,2080]|is_image[bukti_pembayaran]',
            'no_pesanan' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $model = new PesananModel();
        $no_pesanan = $this->request->getPost('no_pesanan');
        $file = $this->request->getFile('bukti_pembayaran');

        // Generate a random name for the file
        $fileName = $file->getRandomName();

        // Move the file to the 'uploads/pembayaran' directory
        if (!$file->move('uploads/pembayaran', $fileName)) {

            return redirect()->back()->withInput()->with('validation', $validation)->with('error', $file->getErrorString());
        }

        $errors = [];
        $success = false;

        foreach ($no_pesanan as $value) {
            $data = $model->where('no_pesanan', $value)->first();

            // Cek status pembayaran apakah sudah dibayar atau belum dibayar   (0 = belum dibayar, 1 = pending, 2 = lunas, 3 = gagal)
            if ($data['status_pembayaran'] !== '0' || $data['status_pembayaran'] == '3') {
                $errors[] = "No pesanan $value sudah dibayar.";
                return redirect()->back()->withInput()->with('validation', $validation)->with('error', implode('<br>', $errors));
            }


            $pembayaranModel = new PembayaranModel();

            // cek apakah no pesanan ada di tabel pembayaran jika ada maka update jika tidak maka insert data
            $dataPembayaran = $pembayaranModel->where('no_pesanan', $value)->first();
            if ($dataPembayaran) {
                $result = $pembayaranModel->update($dataPembayaran['id'], [
                    'bukti_pembayaran' => $fileName,
                    'checked' => 1
                ]);
            } else {
                $result = $pembayaranModel->save([
                    'no_pesanan' => $value,
                    'bukti_pembayaran' => $fileName,
                    'checked' => 1
                ]);
            }



            if ($result === false) {
                $errors[] = "Gagal menyimpan data pembayaran untuk no pesanan $value.";
            }

            if ($result) {
                // Update status_pembayaran di tabel pesanan
                $model->update($data['id'], [
                    'status_pembayaran' => 1
                ]);
            }


            $success = true;
        }

        if ($success) {
            session()->setFlashdata('success', 'Bukti pembayaran berhasil diupload.');
        }
        if (!empty($errors)) {
            session()->setFlashdata('error', implode('<br>', $errors));
        }

        return redirect()->back()->withInput()->with('validation', $validation)->with('success', 'Bukti pembayaran berhasil diupload.');
    }





    //--------------------------------------------------------------------
    // CRUD ADMIN
    //--------------------------------------------------------------------

    public function index()
    {
        $model = new PembayaranModel();
        $pembayaran = $model->findAll();
        foreach ($pembayaran as $key => $value) {
            // Update status_pembayaran
            switch ($value['checked']) {
                case 1:
                    $pembayaran[$key]['checked'] = 'Pending';
                    break;
                case 2:
                    $pembayaran[$key]['checked'] = 'Lunas';
                    break;
                case 3:
                    $pembayaran[$key]['checked'] = 'Gagal';
                    break;
            }
        }


        $data = [
            'title' => 'Data Pembayaran',
            'pembayaran' => $pembayaran
        ];
        return view('admin/pembayaran/index', $data);
    }

    public function show($id)
    {
        $model = new PembayaranModel();
        $pembayaran = $model->find($id);
        switch ($pembayaran['checked']) {
            case 1:
                $pembayaran['checked'] = 'Pending';
                break;
            case 2:
                $pembayaran['checked'] = 'Lunas';
                break;
            case 3:
                $pembayaran['checked'] = 'Gagal';
                break;
        }
        $data = [
            'title' => 'Detail Pembayaran',
            'pembayaran' => $pembayaran
        ];
        return view('admin/pembayaran/show', $data);
    }

    public function delete($id)
    {
        $model = new PembayaranModel();
        $model->delete($id);
        return redirect()->to('/admin/pembayaran');
    }

    //   update
    public function update($id)
    {
        $modelPesanan = new PesananModel();
        $model = new PembayaranModel();

        $validation = $this->validate([
            'checked' => 'required',
            'no_pesanan' => 'required'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $no_pesanan = $this->request->getPost('no_pesanan');
        $checked = $this->request->getPost('checked');

        // Update status_pembayaran di tabel pesanan berdasarkan no_pesanan 
        $pesanan = $modelPesanan->where('no_pesanan', $no_pesanan)->first();
        //   if null
        if ($pesanan == null) {
            return redirect()->to('/admin/pembayaran');
        }

        $model->update($id, [
            'checked' => $checked
        ]);
        $modelPesanan->update($pesanan['id'], [
            'status_pembayaran' => $checked
        ]);


        return redirect()->to('/admin/pembayaran');
    }

    // Riwayat Pembayaran succes and failed
    public function riwayat()
    {
        $model = new PembayaranModel();
        $pembayaran = $model->where('checked', 2)->orWhere('checked', 3)->findAll();

        foreach ($pembayaran as $key => $value) {
            // Update status_pembayaran
            switch ($value['checked']) {
                case 2:
                    $pembayaran[$key]['checked'] = 'Lunas';
                    break;
                case 3:
                    $pembayaran[$key]['checked'] = 'Gagal';
                    break;
            }
        }

        $data = [
            'title' => 'Riwayat Pembayaran',
            'pembayaran' => $pembayaran
        ];
        return view('admin/pembayaran/riwayat', $data);
    }
}
