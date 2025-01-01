<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenjualanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'no_pesanan' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
            ],
            'tgl_masukan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'modal' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'keuntungan' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('no', true);
        $this->forge->addForeignKey('no_pesanan', 'pesanan', 'no_pesanan');
        $this->forge->createTable('penjualan');
    }

    public function down()
    {
        $this->forge->dropTable('penjualan');
    }
}
