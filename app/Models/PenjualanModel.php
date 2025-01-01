<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table            = 'penjualan';
    protected $primaryKey       = 'no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'no_pesanan', 'tgl_masukan', 'modal', 'keuntungan'
    ];

    public function getPenjualan()
    {
        return $this->select('penjualan.*, pesanan.*')
            ->join('pesanan', 'pesanan.no_pesanan = penjualan.no_pesanan', 'left')
            ->findAll();
    }
}
