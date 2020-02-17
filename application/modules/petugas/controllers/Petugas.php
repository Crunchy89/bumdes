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
		$data['data'] = $this->db->query("SELECT simpanan.*,anggota.* FROM simpanan INNER JOIN anggota on simpanan.id_anggota = anggota.id_anggota where simpanan.id_simpanan = $id")->row();
		// $html = 
		$this->load->view('simpan_pdf', $data);
		// $filename = 'Struk_simpan';
		// $this->pdf->generate($html, $filename, true, 'A4', 'landscape');
	}
}
