<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data["title"] = "Home";
		$this->load->view('layouts/v_header', $data);
		$this->load->view('layouts/v_navbar');
		$this->load->view('home/home');
		$this->load->view('layouts/v_footer');
	}
}
