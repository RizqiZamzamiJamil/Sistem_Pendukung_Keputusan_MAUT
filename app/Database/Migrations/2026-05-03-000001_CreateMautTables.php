<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMautTables extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id_alternatif' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'indeks_alternatif' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_alternatif', true);
        $this->forge->addUniqueKey('indeks_alternatif');
        $this->forge->createTable('alternatif');

        $this->forge->addField([
            'id_kriteria' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'kode_kriteria' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'bobot' => [
                'type' => 'DOUBLE',
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_kriteria', true);
        $this->forge->addUniqueKey('kode_kriteria');
        $this->forge->createTable('kriteria');

        $this->forge->addField([
            'id_penilaian' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_alternatif' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_kriteria' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nilai' => [
                'type' => 'DOUBLE',
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_penilaian', true);
        $this->forge->addKey('id_alternatif');
        $this->forge->addKey('id_kriteria');
        $this->forge->addUniqueKey(['id_alternatif', 'id_kriteria']);
        $this->forge->addForeignKey('id_alternatif', 'alternatif', 'id_alternatif', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kriteria', 'kriteria', 'id_kriteria', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penilaian');
    }

    public function down(): void
    {
        $this->forge->dropTable('penilaian', true);
        $this->forge->dropTable('kriteria', true);
        $this->forge->dropTable('alternatif', true);
    }
}
