<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Prodi extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('prodi');
    }

    public function getData($id = null)
    {
        if ($id == null) {
            return $this->builder->get()->getResult();
        } else {
            $this->builder->where('id', $id);
            return $this->builder->get()->getResult();
        }
    }

    public function getDataProdiByJurusan($id)
    {
        $this->builder->where('jurusan_id', $id);
        return $this->builder->get()->getResult();
    }
}
