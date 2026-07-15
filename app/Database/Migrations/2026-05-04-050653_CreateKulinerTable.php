<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKulinerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'nama'        => ['type' => 'VARCHAR', 'constraint' => 150],
            'slug'        => ['type' => 'VARCHAR', 'constraint' => 150],
            'alamat'      => ['type' => 'TEXT'],
            'deskripsi'   => ['type' => 'TEXT', 'null' => true],
            'kategori_id' => ['type' => 'INT'],
            'user_id'     => ['type' => 'INT'],
            'lat'         => ['type' => 'DECIMAL', 'constraint' => '10,7', 'null' => true],
            'lng'         => ['type' => 'DECIMAL', 'constraint' => '10,7', 'null' => true],
            'foto'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'      => ['type' => 'ENUM', 'constraint' => ['pending', 'approved', 'rejected'], 'default' => 'pending'],
            'rating_avg'  => ['type' => 'DECIMAL', 'constraint' => '3,1', 'default' => 0],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('kuliner');
    }

    public function down()
    {
        $this->forge->dropTable('kuliner');
    }
}