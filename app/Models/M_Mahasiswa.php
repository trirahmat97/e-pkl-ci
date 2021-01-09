<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Mahasiswa extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getAllData()
    {
        return $this->db->table('mahasiswa')->get()->getResultArray();
    }

    public function showMhs()
    {
        return $this->db->table('showmhs')->get()->getResultArray();
    }

    public function showUserParent($id)
    {
        $sql = "SELECT * FROM users WHERE id=? OR parent=?";
        return $this->db->query($sql, [$id, $id])->getResultArray();
    }

    public function showMhsById($id)
    {
        return $this->db->table('showmhs')->getWhere(['user_id' => $id])->getResultArray();
    }

    public function tambah($data)
    {
        return $this->db->table('mahasiswa')->insert($data);
    }

    public function hapus($id)
    {
        return $this->db->table('mahasiswa')->delete(['id' => $id]);
    }
}
