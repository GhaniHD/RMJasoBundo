<?php

namespace App\Models;

use CodeIgniter\Model;

class UserDataModel extends Model
{
    protected $table            = 'user_data';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user', 'nama', 'alamat', 'kd_pos', 'profile', 'no_telp'
    ];

    public function getUserData()
    {
        return $this->select('user.id_user, user.email, user.level, user_data.nama, user_data.alamat, user_data.kd_pos, user_data.no_telp , user_data.profile ')
            ->join('user', 'user.id_user = user_data.id_user')
            ->findAll();
    }

    public function getUserDataById($id)
    {
        return $this->select('user.id_user, user.email, user.level, user_data.nama, user_data.alamat, user_data.kd_pos, user_data.no_telp')
            ->join('user', 'user.id_user = user_data.id_user')
            ->where('user.id_user', $id)
            ->first();
    }
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
