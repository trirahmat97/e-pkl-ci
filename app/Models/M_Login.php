<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Login extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('users');
    }

    public function login($username, $password)
    {
        return $this->builder->getWhere(['username' => $username, 'password' => $password])->getRow();
    }

    public function register($data)
    {
        return $this->db->table('users')->insert($data);
    }

    public function findMhs($id)
    {
        return $this->builder->getWhere(['id' => $id])->getRow();
    }
}
