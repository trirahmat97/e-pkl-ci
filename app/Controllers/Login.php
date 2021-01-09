<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Login;

class Login extends Controller
{
    public function __construct()
    {
        $this->model = new M_Login;
        $this->session = session();
    }

    public function index()
    {
        echo view('login/v_login');
    }

    public function signup()
    {
        echo view('login/v_signup');
    }

    public function signin()
    {
        if (isset($_POST['login'])) {
            $val = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ]
            ]);
            if (!$val) {
                session()->setFlashdata('err', \config\Services::validation()->listErrors());
                echo view('login/v_login');
                return redirect()->to(base_url('login'));
            } else {
                $username = $this->request->getPost('username');
                $password = md5($this->request->getPost('password'));
                $data = $this->model->login($username, $password);
                if (!$data) {
                    session()->setFlashdata('err', 'Username or Password Wrong!');
                    echo view('login/v_login');
                    return redirect()->to(base_url('login'));
                } else {
                    $this->session->set("username", $data->username);
                    $this->session->set("level", $data->level);
                    $this->session->set("logged_in", true);
                    $this->session->set("id", $data->id);
                    if ($data->level == '00') {
                        return redirect()->to(base_url('dosen'));
                    } else if ($data->level == '01') {
                        return redirect()->to(base_url('up2ai'));
                    } else if ($data->level == '11') {
                        return redirect()->to(base_url('mahasiswa'));
                    } else if ($data->level == '22') {
                        return redirect()->to(base_url('admin'));
                    } else {
                        session()->setFlashdata('err', 'Level Wrong!');
                        echo view('login/v_login');
                        return redirect()->to(base_url('login'));
                    }
                }
            }
        }
    }

    public function register()
    {
        if (isset($_POST['register'])) {
            $val = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],
                'confirm' => [
                    'label' => 'Confirm Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ]
            ]);
            if (!$val) {
                session()->setFlashdata('err', \config\Services::validation()->listErrors());
                echo view('login/v_signup');
                return redirect()->to(base_url('register'));
            } else {
                $data = [
                    'username' => $this->request->getPost('username'),
                    'password' => md5($this->request->getPost('password')),
                    'email' => $this->request->getPost('email'),
                    'level' => '11'
                ];
                $success = $this->model->register($data);
                if ($success) {
                    session()->setFlashdata('message', 'Silahkan Login');
                    return redirect()->to(base_url('login'));
                }
            }
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'));
    }
}
