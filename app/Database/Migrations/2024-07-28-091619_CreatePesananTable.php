<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePesananTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'no_pesanan' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
                'unique' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'kd_menu' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'tgl_pesan' => [
                'type' => 'DATETIME',
            ],
            'tgl_ambil' => [
                'type' => 'DATE',
            ],
            'status_pesanan' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'status_pembayaran' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'metode_pengambilan' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'harga_total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);
        $this->forge->addKey('id', true);

        // Foreign Key Constraints
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kd_menu', 'menu', 'kd_menu', 'CASCADE', 'CASCADE');

        $this->forge->createTable('pesanan');
    }

    public function down()
    {
        $this->forge->dropTable('pesanan');
    }
}
