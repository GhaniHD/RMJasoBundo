<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['email', 'password', 'level'];

    protected $validationRules = [
        'email' => 'required|valid_email|is_unique[user.email]',
        'password' => 'required|min_length[6]',
    ];

    protected $validationMessages = [
        'email' => [
            'required' => 'Email wajib diisi.',
            'valid_email' => 'Silakan masukkan alamat email yang valid.',
            'is_unique' => 'Email ini sudah terdaftar.',
        ],
        'password' => [
            'required' => 'Password wajib diisi.',
            'min_length' => 'Password harus memiliki panjang minimal 6 karakter.',
        ],
    ];

    protected $skipValidation = false;
}
