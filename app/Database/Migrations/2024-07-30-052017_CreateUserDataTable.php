<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserDataTable extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'kd_pos' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'profil' => [
                'type' => 'TEXT',
                'default' => 'uploads/profile/default.jpg',
            ],
            'no_telp' => [
                'type'       => 'VARCHAR',
                'constraint' => '13',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_data');
    }

    public function down()
    {
        //
        $this->forge->dropTable('user_data');
    }
}
