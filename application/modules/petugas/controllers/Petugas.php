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
}
