<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
	public function __construct()
	{
		if ($this->session->userdata('level')) {
			redirect('admin');
		}
		parent::__construct();
		$this->load->model('home_model');
	}
	public function index()
	{
		home_page('index');
	}
	public function login()
	{
		$this->home_model->login();
	}
	public function daftar()
	{
		$this->home_model->daftar();
	}
}
