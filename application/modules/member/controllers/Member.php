<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends MY_Controller
{
	public function __construct()
	{
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
			'member' => $this->db->query("SELECT * FROM simpanan Where id_anggota = $id")->result()
		];
		admin_page('simpanan', $data);
	}
	public function penarikan()
	{
		$id = $this->session->userdata('id');
		$data = [
			'title' => 'Halaman Anggota',
			'page' => 'Penarikan',
			'member' => $this->db->query("SELECT anggota.*,penarikan.* FROM anggota INNER JOIN penarikan on anggota.id_anggota = penarikan.id_anggota  Where penarikan.id_anggota = $id")->result()
		];
		admin_page('penarikan', $data);
	}
	public function angsuran()
	{
		$id = $this->session->userdata('id');
		$data = [
			'title' => 'Halaman Anggota',
			'page' => 'Angsuran',
			'member' => $this->db->query("SELECT angsuran.*,pinjaman.*,anggota.* FROM angsuran INNER JOIN pinjaman on angsuran.id_pinjaman = pinjaman.id_pinjaman INNER JOIN anggota on pinjaman.id_anggota=anggota.id_anggota WHERE pinjaman.id_anggota = $id")->result()
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
