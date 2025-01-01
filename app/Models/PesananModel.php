<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'no_pesanan', 'id_user', 'kd_menu', 'tgl_pesan', 'tgl_ambil',
        'status_pesanan', 'status_pembayaran', 'metode_pengambilan', 'qty', 'harga_total'
    ];
    protected function mapStatusPesanan($status)
    {
        $statusPesananMap = [
            '0' => 'Unknown', // default value
            '1' => 'Pending',
            '2' => 'Proses',
            '3' => 'Dikirim',
            '4' => 'Dibatalkan',
            '5' => 'Diambil',
            '6' => 'Selesai',
        ];
        return $statusPesananMap[$status] ?? 'Unknown';
    }

    protected function mapStatusPembayaran($status)
    {
        $statusPembayaranMap = [
            '0' => 'Belum Dibayar', // default value
            '1' => 'Pending',
            '2' => 'Lunas',
            '3' => 'Gagal',
        ];
        return $statusPembayaranMap[$status] ?? 'Unknown';
    }

    protected function mapMetodePengambilan($metode)
    {
        $metodePengambilanMap = [
            '0' => 'Unknown', // default value
            '1' => 'Delivery',
            '2' => 'Take Away',
        ];
        return $metodePengambilanMap[$metode] ?? 'Unknown';
    }



    // Override method findAll untuk memodifikasi status
    public function findAll($limit = 0, $offset = 0)
    {
        $results = parent::findAll($limit, $offset);


        // Log the raw results for debugging
        // log_message('debug', 'Raw results: ' . print_r($results, true));

        foreach ($results as &$result) {
            if ($result == null) {
                continue;
            }
            $result['status_pesanan'] = $this->mapStatusPesanan($result['status_pesanan']);
            $result['status_pembayaran'] = $this->mapStatusPembayaran($result['status_pembayaran']);
            $result['metode_pengambilan'] = $this->mapMetodePengambilan($result['metode_pengambilan']);
        }

        return $results;
    }


    // Override method find untuk memodifikasi status
    public function find($id = null)
    {
        $result = parent::find($id);

        if ($result) {
            $result['status_pesanan'] = $this->mapStatusPesanan($result['status_pesanan']);
            $result['status_pembayaran'] = $this->mapStatusPembayaran($result['status_pembayaran']);
            $result['metode_pengambilan'] = $this->mapMetodePengambilan($result['metode_pengambilan']);
        }

        return $result;
    }

    // Override method where untuk memodifikasi status






    protected $skipValidation = false;
}
