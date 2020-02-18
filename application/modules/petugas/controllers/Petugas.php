<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('petugas_model', 'model');
	}
	public function index()
	{
		$data = [
			'title' => 'Halaman Petugas',
			'page' => 'Simpanan',
			'data' => $this->db->get('simpanan')->result(),
			'simpan' => $this->model->join()
		];
		admin_page('index', $data);
	}
	public function userList()
	{
		// POST data
		$postData = $this->input->post();

		// Get data
		$data = $this->model->getUsers($postData);

		echo json_encode($data);
	}
	public function simpan()
	{
		$this->model->simpan();
	}
	public function simpan_pdf($id)
	{
		$data['data'] = $this->db->query("SELECT simpanan.*,anggota.*,penarikan.* FROM simpanan INNER JOIN anggota on simpanan.id_anggota = anggota.id_anggota LEFT JOIN penarikan on simpanan.id_simpanan = penarikan.id_simpanan WHERE simpanan.id_anggota = $id")->result();
		// $html = 
		$this->load->view('simpan_pdf', $data);
		// $filename = 'Struk_simpan';
		// $this->pdf->generate($html, $filename, true, 'A4', 'landscape');
	}
	public function pinjaman()
	{
		$data = [
			'title' => 'Halaman Petugas',
			'page' => 'Pinjaman',
			'data' => $this->db->get('pinjaman')->result(),
			'pinjam' => $this->model->join_pinjaman()
		];
		admin_page('pinjaman', $data);
	}
	public function pinjam_simpan()
	{
		$this->model->pinjam_simpan();
	}
	public function angsuran()
	{
		$data = [
			'title' => 'Halaman Petugas',
			'page' => 'Angsuran',
			'pinjam' => $this->model->join_angsuran()
		];
		admin_page('angsuran', $data);
	}
	public function userAngsur()
	{
		// POST data
		$postData = $this->input->post();

		// Get data
		$data = $this->model->getAngsur($postData);

		echo json_encode($data);
	}
	public function angsuran_simpan()
	{
		$this->model->angsuran_simpan();
	}
	public function pinjaman_pdf($id)
	{
		$data['data'] = $this->db->query("SELECT pinjaman.*,anggota.* FROM pinjaman INNER JOIN anggota on pinjaman.id_anggota = anggota.id_anggota where pinjaman.id_anggota = $id order by pinjaman.id_pinjaman asc")->result();
		$this->load->view('pinjaman_pdf', $data);
	}
	public function angsuran_pdf($id)
	{
		$data['data'] = $this->db->query("SELECT pinjaman.*,pinjaman.id_pinjaman as pinjam,anggota.*,angsuran.* FROM pinjaman INNER JOIN anggota on pinjaman.id_anggota = anggota.id_anggota INNER JOIN angsuran on pinjaman.id_pinjaman = angsuran.id_pinjaman where angsuran.id_pinjaman =$id ORDER BY angsuran.id_angsuran asc")->result();
		$this->load->view('angsuran_pdf', $data);
	}
}
