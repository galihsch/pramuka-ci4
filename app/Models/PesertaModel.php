<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaModel extends Model
{
    protected $table            = 'peserta';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'telepon', 'pendidikan', 'alamat', 'kab_kota', 'nama_bank',
        'nama_rekening', 'no_rekening', 'id_cabang', 'id_golongan',
        'status_peserta', 'catatan_verifikasi'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nik' => 'required',
        'nama' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required|valid_date',
        'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]',
        'telepon' => 'required',
        'pendidikan' => 'required',
        'alamat' => 'required',
        'kab_kota' => 'required',
        'nama_bank' => 'required',
        'nama_rekening' => 'required',
        'no_rekening' => 'required',
        'id_cabang' => 'required|numeric',
        'id_golongan' => 'required|numeric'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
