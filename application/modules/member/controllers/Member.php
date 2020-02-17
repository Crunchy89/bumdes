<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends MY_Controller
{
	public function __construct()
	{
		if (!$this->session->userdata('level') == 3) {
			redirect('home');
		}
		parent::__construct();
	}

	public function index()
	{
		$id = $this->session->userdata('id');
		$data = [
			'title' => 'Halaman Anggota',
			'page' => 'Profil',
			'member' => $this->db->get_where('anggota', ['id_anggota' => $id])->row()
		];
		admin_page('index', $data);
	}
	public function pinjaman()
	{
		$id = $this->session->userdata('id');
		$data = [
			'title' => 'Halaman Anggota',
			'page' => 'Pinjaman',
			'member' => $this->db->get_where('pinjaman', ['id_anggota' => $id])->result()
		];
		admin_page('pinjaman', $data);
	}
	public function simpanan()
	{
		$id = $this->session->userdata('id');
		$data = [
			'title' => 'Halaman Anggota',
			'page' => 'Simpanan',
			'member' => $this->db->query("SELECT simpanan.*,user.* FROM simpanan INNER JOIN user on simpanan.id_petugas=user.id_user")->result()
		];
		admin_page('simpanan', $data);
	}
	public function angsuran()
	{
		$id = $this->session->userdata('id');
		$data = [
			'title' => 'Halaman Anggota',
			'page' => 'Angsuran',
			'member' => $this->db->query("SELECT angsuran.*,user.* FROM angsuran INNER JOIN user on angsuran.id_petugas=user.id_user")->result()
		];
		admin_page('angsuran', $data);
	}
	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		redirect('home');
	}
}
