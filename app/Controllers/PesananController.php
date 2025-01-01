<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\KeranjangModel;


class PesananController extends BaseController
{
    use ResponseTrait;

    protected $pesananModel;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
    }

    public function index()
    {
        $pesanan = $this->pesananModel->findAll();
        return view('admin/pemesanan/index', ['pesanan' => $pesanan]);
    }

    public function edit($id)
    {
        $pesanan = $this->pesananModel->find($id);
        if (!$pesanan) {
            return redirect()->to('/pesanan')->with('error', 'Pesanan tidak ditemukan');
        }

        $data = [
            'pesanan' => $pesanan,
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/pemesanan/edit', $data);
    }

    public function update($id)
    {
        $validation = $this->validate([
            'status_pesanan' => 'required|numeric',
            'status_pembayaran' => 'required|numeric',
        ]);
        if (!$validation) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $this->pesananModel->update($id, [
            'status_pesanan' => $this->request->getVar('status_pesanan'),
            'status_pembayaran' => $this->request->getVar('status_pembayaran'),
        ]);

        return redirect()->to('/pesanan')->with('success', 'Pesanan berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->pesananModel->delete($id);
        return redirect()->to('/pesanan')->with('success', 'Pesanan berhasil dihapus');
    }

    public function show($id)
    {
        $pesanan = $this->pesananModel->find($id);
        if (!$pesanan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pesanan dengan ID ' . $id . ' tidak ditemukan.');
        }

        return view('pemesanan/show', ['pesanan' => $pesanan]);
    }

    public function lihatPesanan()
    {
        $session = session();
        $userId = $session->get('id_user');

        // Ambil data pesanan berdasarkan ID pengguna
        $pesanan = $this->pesananModel->where('id_user', $userId)->findAll();

        // Kirim data pesanan ke tampilan
        return view('user/pemesanan/lihatPesanan', ['pesanan' => $pesanan]);
    }

    public function detail()
    {
        $model = new PesananModel();
        $data = [];

        // Menggunakan ResponseTrait
        $this->response->setHeader('Content-Type', 'application/json');

        // Mendapatkan input JSON dari request body
        $input = $this->request->getJSON();

        // Mendapatkan semua nomor pesanan yang diterima
        $nomorPesanan = $input->nomorPesanan;

        // Jika ada beberapa nomor pesanan
        if (is_array($nomorPesanan)) {
            foreach ($nomorPesanan as $nomor) {
                // Mendapatkan data pesanan berdasarkan nomor pesanan
                $pesanan = $model->where('no_pesanan', $nomor)
                    ->where('id_user', session()->get('id_user'))
                    ->where('status_pesanan', 1)
                    ->findAll();

                // Memeriksa apakah data pesanan tidak kosong
                if (!empty($pesanan)) {
                    foreach ($pesanan as $item) {
                        $data[] = $item;
                    }
                }
            }
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Detail pesanan',
            'data' => $data
        ]);
    }

    public function tambah()
    {
        // dd($this->request->getpost());
        $data = [
            'title' => 'Tambah Pesanan',
        ];

        // validate kd menu 
        $rules = [
            'kd_menu' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/user/keranjang')->withInput()->with('validation', $this->validator);
        }

        $keranjangModel = new KeranjangModel();

        $dataInsert = [
            'id_user' => (int) session()->get('id_user'),
            'kd_menu' => $this->request->getVar('kd_menu'),
            'qty' => 1,
        ];

        // dd($dataInsert);
        $keranjangModel->insert($dataInsert);





        return redirect()->to('/user/keranjang');
    }


    public function simpanPesanan()
    {
        $postData = $this->request->getPost();


        $csrfToken = $postData['csrf_test_name'];

        // Mengambil item dan qty dari data POST
        $items = $postData['items'] ?? [];
        $qty = $postData['qty'] ?? [];
        $kd_menu = $postData['kd_menu'] ?? [];
        $harga_total = $postData['harga_total'] ?? 0;
        $metodePengambilan = $postData['metode_pengambilan'] ?? 1;
        $tanggalAmbil = $postData['tanggal_ambil'] ?? date('Y-m-d', strtotime('+1 day'));


        // Menyiapkan array untuk data yang digabungkan
        $data = [];

        foreach ($items as $itemId) {
            // Gabungkan qty dengan item berdasarkan ID
            if (isset($qty[$itemId])) {
                // Tambahkan data ke dalam array

                // generate random nomor pesanan  STRING + angka random 6 digit
                $noPesanan = 'PSN' . rand(100000, 999999);
                // tanggal pesansaat ini
                $tglPesan = date('Y-m-d H:i:s');
                // tanggal ambil 1 hari dari sekarang

                $data = [
                    'no_pesanan' => $noPesanan,
                    'kd_menu' => (int) $kd_menu[$itemId],
                    'qty' => $qty[$itemId],
                    'id_user' => (int) session()->get('id_user'),
                    'tgl_pesan' => $tglPesan,
                    'tgl_ambil' => $tanggalAmbil,
                    'status_pesanan' => 1,
                    'status_pembayaran' => 0,
                    'metode_pengambilan' => $metodePengambilan,
                    'harga_total' => $harga_total[$itemId],

                ];
            }
            $pesananModel = new PesananModel();
            $pesananModel->insert($data);
        }


        // Redirect ke halaman pesanan
        return redirect()->to('/user/pesanan');
    }
}
