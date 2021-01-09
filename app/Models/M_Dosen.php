<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Dosen extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getAllData()
    {
        return $this->db->table('dosen')->get()->getResultArray();
    }

    public function tambah($data)
    {
        return $this->db->table('dosen')->insert($data);
    }

    public function hapus($id)
    {
        return $this->db->table('dosen')->delete(['id' => $id]);
    }
}
