<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePembayaranTable extends Migration
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
            ],
            'bukti_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'checked' => [
                'type' => 'TINYINT',
                'constraint' => 1,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('no_pesanan', 'pesanan', 'no_pesanan');
        $this->forge->createTable('pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran');
    }
}
