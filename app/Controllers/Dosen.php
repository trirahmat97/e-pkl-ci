<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Dosen;
use App\Models\M_Prodi;
use App\Models\M_Jurusan;

class Dosen extends Controller
{
    public function __construct()
    {
        $this->session = session();
        helper('sn');
    }

    public function index()
    {
        $data = [
            'judul' => 'Data Dosen',
            'username' => $this->session->get('username')
        ];

        return tampilan('dosen/index', $data);
    }
}
