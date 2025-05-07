<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePesertaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal_lahir' => [
                'type'       => 'DATE',
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['Laki-laki', 'Perempuan'],
            ],
            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kab_kota' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_bank' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama_rekening' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'no_rekening' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'id_cabang' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
            ],
            'id_golongan' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
            ],
            'status_peserta' => [
                'type'       => 'ENUM',
                'constraint' => ['Proses Verifikasi', 'Diterima', 'Ditolak', 'Perbaiki', 'Mundur'],
                'default'    => 'Proses Verifikasi',
            ],
            'catatan_verifikasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('peserta');
    }

    public function down()
    {
        $this->forge->dropTable('peserta');
    }
} 