<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        //user Seeder
        $data = [
            'email' => 'jasobundo@admin.id',
            'password' => password_hash('JasoBundo', PASSWORD_DEFAULT),
            'level' => 'admin',
        ];


        $userData = [
            'id_user' => 1,
            'nama' => 'Jaso Bundo',
            'alamat' => 'Jl. Jaso Bundo No. 1',
            'kd_pos' => '12345',
            'profile' => 'default.jpg',
            'no_telp' => '081234567890',
        ];

        $this->db->table('user')->insert($data);
        $this->db->table('user_data')->insert($userData);

        //user Seeder
        $data = [
            'email' => 'jasobundo@user.id',
            'password' => password_hash('JasoBundo', PASSWORD_DEFAULT),
            'level' => 'user'
        ];

        $userData = [
            'id_user' => 2,
            'nama' => 'Jaso Bundo',
            'alamat' => 'Jl. Jaso Bundo No. 1',
            'kd_pos' => '12345',
            'profile' => 'default.jpg',
            'no_telp' => '081234567890',
        ];
        $this->db->table('user')->insert($data);
        $this->db->table('user_data')->insert($userData);
    }
}
