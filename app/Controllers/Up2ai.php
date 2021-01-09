<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Up2ai extends Controller
{
    public function __construct()
    {
        helper('sn');
    }
    public function index()
    {
        $data = [
            'judul' => 'Data up2ai'
        ];

        return tampilan('up2ai/index', $data);
    }
}
