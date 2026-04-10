<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeletedAtToAlat extends Migration
{
    public function up()
    {
        // Tambah kolom deleted_at untuk soft delete
        $this->forge->addColumn('alat', [
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'after'      => 'updated_at'
            ]
        ]);
    }

    public function down()
    {
        // Hapus kolom deleted_at
        $this->forge->dropColumn('alat', 'deleted_at');
    }
}
