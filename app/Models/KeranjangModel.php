<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'kd_menu', 'qty'];


    public function getMenu($id)
    {
        return $this->select('menu.* , keranjang.*')
            ->join('menu', 'menu.kd_menu = keranjang.kd_menu')
            ->where('keranjang.id_user', $id)
            ->findAll();
    }

}
