<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PesertaModel;

class Peserta extends BaseController
{
    protected $pesertaModel;

    public function __construct()
    {
        $this->pesertaModel = new PesertaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Peserta',
            'peserta' => $this->pesertaModel->orderBy('created_at', 'DESC')->findAll()
        ];
        
        return view('peserta/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Pendaftaran Peserta'
        ];
        
        return view('peserta/create', $data);
    }

    public function store()
    {
        $rules = $this->pesertaModel->validationRules;
        
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return $this->response->setJSON([
                'success' => false,
                'errors' => $errors,
                'message' => 'Validasi gagal'
            ])->setStatusCode(400);
        }

        try {
            $data = $this->request->getPost();
            if (!isset($data['status_peserta']) || empty($data['status_peserta'])) {
                $data['status_peserta'] = 'Proses Verifikasi';
            }
            
            $this->pesertaModel->save($data);
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ]);
            
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    public function getData()
    {
        $peserta = $this->pesertaModel->orderBy('created_at', 'DESC')->findAll();
        
        return $this->response->setJSON([
            'success' => true,
            'data' => $peserta
        ]);
    }
}
