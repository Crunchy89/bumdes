<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
	public function __construct()
	{
		if ($this->session->userdata('level') != 2 && $this->session->userdata('level') != 1) {
			redirect('home');
		}
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->library('pdf');
	}

	public function index()
	{
		$data = [
			'title' => 'Halaman Ketua',
			'page' => 'Laporan',
			'data' => $this->db->get_where('user', ['status' => 0])->result()
		];
		admin_page('index', $data);
	}
	public function confirm($id)
	{
		$this->db->set('status', 1);
		$this->db->where('id_login', $id);
		$this->db->update('user');
		redirect('admin/anggota');
	}
	public function anggota()
	{
		$data = [
			'title' => 'Halaman Ketua',
			'page' => 'Konfirmasi Anggota Baru',
			'data' => $this->db->query('SELECT user.*,user.status as confirm,anggota.* FROM user INNER JOIN anggota on user.id_login=anggota.id_anggota ORDER BY user.status ASC')->result()
		];
		admin_page('anggota', $data);
	}
	public function anggota_pdf()
	{
		$data['users'] = $this->db->get('anggota')->result();
		$html = $this->load->view('anggota_pdf', $data, true);
		$filename = 'Anggota';
		$this->pdf->generate($html, $filename, true, 'A4', 'landscape');
	}
	public function pegawai()
	{
		$data = [
			'title' => 'Halaman Ketua',
			'page' => 'Pegawai',
			'data' => $this->db->query('SELECT user.*,level.* FROM user INNER JOIN level on user.id_level =level.id_level WHERE user.id_level != 3 AND user.id_level != 1')->result(),
			'level' => $this->db->query("SELECT * FROM level WHERE id_level !=1 AND id_level !=3")->result()
		];
		admin_page('pegawai', $data);
	}
	public function pegawai_tambah()
	{
		$data = [
			'username' => htmlspecialchars($this->input->post('user')),
			'password' => htmlspecialchars($this->input->post('pass')),
			'id_level' => htmlspecialchars($this->input->post('status')),
			'status' => 1
		];
		$this->db->insert('user', $data);
		redirect('admin/pegawai');
	}
	public function pegawai_edit()
	{
		$data = [
			'username' => htmlspecialchars($this->input->post('user')),
			'password' => htmlspecialchars($this->input->post('pass')),
			'id_level' => htmlspecialchars($this->input->post('status'))
		];
		$this->db->where('id_user', $this->input->post('id'));
		$this->db->update('user', $data);
		redirect('admin/pegawai');
	}
	public function pegawai_hapus()
	{
		$this->db->where('id_user', $this->input->post('id'));
		$this->db->delete('user');
		redirect('admin/pegawai');
	}
	public function simpanan()
	{
		$data = [
			'title' => 'Halaman Ketua',
			'page' => 'Laporan Simpanan',
			'data' => $this->db->query("SELECT simpanan.*,anggota.* FROM simpanan INNER JOIN anggota on simpanan.id_anggota=anggota.id_anggota")->result()
		];
		admin_page('simpanan', $data);
	}
	public function simpanan_pdf()
	{
		$data['users'] = $this->db->query("SELECT simpanan.*,anggota.* FROM simpanan INNER JOIN anggota on simpanan.id_anggota=anggota.id_anggota")->result();
		$html = $this->load->view('simpanan_pdf', $data, true);
		$filename = 'Simpanan';
		$this->pdf->generate($html, $filename, true, 'A4', 'landscape');
	}
	public function pinjaman()
	{
		$data = [
			'title' => 'Halaman Ketua',
			'page' => 'Laporan Pinjaman',
			'data' => $this->db->query("SELECT pinjaman.*,anggota.*,user.* FROM pinjaman INNER JOIN anggota on pinjaman.id_anggota=anggota.id_anggota INNER JOIN user on pinjaman.id_petugas=user.id_user")->result()
		];
		admin_page('pinjaman', $data);
	}
	public function pinjaman_pdf()
	{
		$data['data'] = $this->db->query("SELECT pinjaman.*,anggota.*,user.* FROM pinjaman INNER JOIN anggota on pinjaman.id_anggota=anggota.id_anggota INNER JOIN user on pinjaman.id_petugas=user.id_user")->result();
		$html = $this->load->view('pinjaman_pdf', $data, true);
		$filename = 'Pinjaman';
		$this->pdf->generate($html, $filename, true, 'A4', 'landscape');
	}
	public function angsuran()
	{
		$data = [
			'title' => 'Halaman Ketua',
			'page' => 'Laporan Angsuran',
			'data' => $this->db->query("SELECT angsuran.*,pinjaman.*,anggota.*,user.* FROM angsuran INNER JOIN pinjaman on angsuran.id_pinjaman=pinjaman.id_pinjaman INNER JOIN anggota on pinjaman.id_anggota=anggota.id_anggota INNER JOIN user on pinjaman.id_petugas=user.id_user")->result()
		];
		admin_page('angsuran', $data);
	}
	public function angsuran_pdf()
	{
		$data['data'] = $this->db->query("SELECT angsuran.*,pinjaman.*,anggota.*,user.* FROM angsuran INNER JOIN pinjaman on angsuran.id_pinjaman=pinjaman.id_pinjaman INNER JOIN anggota on pinjaman.id_anggota=anggota.id_anggota INNER JOIN user on pinjaman.id_petugas=user.id_user")->result();
		$html = $this->load->view('angsuran_pdf', $data, true);
		$filename = 'Angsuran';
		$this->pdf->generate($html, $filename, true, 'A4', 'landscape');
	}
}
