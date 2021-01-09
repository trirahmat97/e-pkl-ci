<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Mahasiswa;
use App\Models\M_Prodi;
use App\Models\M_Jurusan;

class Mahasiswa extends Controller
{
	public function __construct()
	{
		$this->session = session();
		$this->model = new M_Mahasiswa;
		$this->prodi = new M_Prodi;
		$this->jurusan = new M_Jurusan;
		helper('sn');
	}

	public function index()
	{
		if ($this->session->get('logged_in') && $this->session->get('level') != '11') {
			return redirect()->to(base_url('login'));
		}
		$id = $this->session->get('id');
		$data = [
			'judul' => 'Anggota PKL',
			'username' => $this->session->get('username'),
			'mahasiswa' => $this->model->showmhsById($id),
			'user' => $this->model->showUserParent($id),
			'jurusan' => $this->jurusan->getData(),
			'prodi' => $this->prodi->getData(),
		];

		return tampilan('mahasiswa/index', $data);
	}
	public function tambah()
	{
		if (!$this->session->get('logged_in')) {
			return redirect()->to(base_url('login'));
		}
		if (isset($_POST['tambah'])) {
			$val = $this->validate([
				'npm' => [
					'label' => 'Nomor Pokok Mahasiswa',
					'rules' => 'required|numeric|max_length[11]|is_unique[mahasiswa.npm]',
					'errors' => [
						'required' => '{field} tidak boleh kosong.',
						'numeric' => '{field} hanya boleng angka'
					]
				],
				'nama' => [
					'label' => 'Nama Mahasiswa',
					'rules' => 'required|alpha_space[50]',
					'errors' => [
						'required' => '{field} tidak boleh kosong.'
					]
				]
			]);

			if (!$val) {
				session()->setFlashdata('err', \config\Services::validation()->listErrors());
				$data = [
					'judul' => 'Mahasiswa',
					'mahasiswa' => $this->model->showmhs(),
					'jurusan' => $this->jurusan->getData()
				];
				tampilan('mahasiswa/index', $data);
				return redirect()->to(base_url('mahasiswa'));
			} else {
				$data = [
					'npm' => $this->request->getPost('npm'),
					'nama' => $this->request->getPost('nama'),
					'prodi_id' => $this->request->getPost('prodi'),
					'user_id' => 1
				];
				//insert data
				$success = $this->model->tambah($data);
				if ($success) {
					session()->setFlashdata('message', 'Ditambahkan');
					return redirect()->to(base_url('/mahasiswa'));
				}
			}
		} else {
			return redirect()->to('/mahasiswa');
		}
	}

	public function hapus($id)
	{
		if (!$this->session->get('logged_in')) {
			return redirect()->to(base_url('login'));
		}
		$success = $this->model->hapus($id);
		if ($success) {
			session()->setFlashdata('message', 'Dihapus');
			return redirect()->to(base_url('/mahasiswa'));
		}
	}

	public function loadData()
	{
		if (!$this->session->get('logged_in')) {
			return redirect()->to(base_url('login'));
		}
		$modul = $this->request->getPost('module');
		$id = $this->request->getPost('id');
		if ($modul == 'prodi') {
			$data = $this->prodi->getDataProdiByJurusan($id);
			echo "<option>Pilih Prodi...</option>";
			foreach ($data as $val) {
				echo "<option value=" . $val->id . ">" . $val->nama . "</option>";
			}
		}
	}
	public function update()
	{
	}
}
