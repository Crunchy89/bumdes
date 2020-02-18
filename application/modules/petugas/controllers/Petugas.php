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
		$postData = $this->input->post();
		$data = $this->model->getUsers($postData);
		echo json_encode($data);
	}
	public function userTarik()
	{
		$postData = $this->input->post();
		$data = $this->model->getTarik($postData);
		echo json_encode($data);
	}
	public function simpan()
	{
		$this->model->simpan();
	}
	public function simpan_pdf($id)
	{
		$data['data'] = $this->db->query("SELECT simpanan.*,anggota.*,penarikan.* FROM simpanan INNER JOIN anggota on simpanan.id_anggota = anggota.id_anggota LEFT JOIN penarikan on simpanan.id_anggota = penarikan.id_anggota WHERE simpanan.id_anggota = $id GROUP BY simpanan.id_simpanan")->result();
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
	public function penarikan()
	{
		$data = [
			'title' => 'Halaman Petugas',
			'page' => 'Penarikan',
			'simpan' => $this->model->join_tarik()
		];
		admin_page('penarikan', $data);
	}
	public function tarik()
	{
		$this->model->tarik();
	}
	public function tarik_pdf($id)
	{
		$data['data'] = $this->db->query("SELECT anggota.*,penarikan.* FROM anggota INNER JOIN penarikan on anggota.id_anggota = penarikan.id_anggota where penarikan.id_anggota =$id ORDER BY penarikan.id_anggota asc")->result();
		$this->load->view('tarik_pdf', $data);
	}
	public function simpan_bulan()
	{
		$data['data'] = $this->db->query("SELECT anggota.*,simpanan.* FROM anggota INNER JOIN simpanan on anggota.id_anggota = simpanan.id_anggota WHERE YEAR(simpanan.tanggal_simpanan) = YEAR(NOW()) AND MONTH(simpanan.tanggal_simpanan)=MONTH(NOW())  ORDER BY simpanan.id_simpanan asc")->result();
		$this->load->view('simpan_bulan', $data);
	}
	public function tarik_bulan()
	{
		$data['data'] = $this->db->query("SELECT anggota.*,penarikan.* FROM anggota INNER JOIN penarikan on anggota.id_anggota = penarikan.id_anggota WHERE YEAR(penarikan.tanggal_penarikan) = YEAR(NOW()) AND MONTH(penarikan.tanggal_penarikan)=MONTH(NOW())  ORDER BY penarikan.id_penarikan asc")->result();
		$this->load->view('tarik_bulan', $data);
	}
	public function pinjam_bulan()
	{
		$data['data'] = $this->db->query("SELECT anggota.*,pinjaman.* FROM anggota INNER JOIN pinjaman on anggota.id_anggota = pinjaman.id_anggota WHERE YEAR(pinjaman.tgl_pinjaman) = YEAR(NOW()) AND MONTH(pinjaman.tgl_pinjaman)=MONTH(NOW())  ORDER BY pinjaman.id_pinjaman asc")->result();
		$this->load->view('pinjam_bulan', $data);
	}
	public function angsur_bulan()
	{
		$data['data'] = $this->db->query("SELECT anggota.*,pinjaman.*,angsuran.* FROM anggota INNER JOIN pinjaman on anggota.id_anggota = pinjaman.id_anggota INNER JOIN angsuran on pinjaman.id_pinjaman = angsuran.id_pinjaman WHERE YEAR(angsuran.tgl_setor) = YEAR(NOW()) AND MONTH(angsuran.tgl_setor)=MONTH(NOW())  ORDER BY angsuran.id_angsuran asc")->result();
		$this->load->view('angsur_bulan', $data);
	}
}
