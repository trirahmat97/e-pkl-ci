<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{
    public function __construct()
    {
        helper('sn');
    }
    public function index()
    {
        $data = [
            'judul' => 'Data Admin'
        ];

        return tampilan('admin/index', $data);
    }
}
