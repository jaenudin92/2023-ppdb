<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ppdb extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data["title"] = "PPDB";
		$this->load->view('layouts/v_header', $data);
		$this->load->view('layouts/v_navbar');
		$this->load->view('ppdb/ppdb');
		$this->load->view('layouts/v_footer');
	}
	public function jalurreguler()
	{
		$data["title"] = "PPDB";
		$this->load->view('layouts/v_header', $data);
		$this->load->view('layouts/v_navbar');
		$this->load->view('ppdb/jalurreguler');
		$this->load->view('layouts/v_footer');
	}
	public function jalurprestasi()
	{
		$data["title"] = "PPDB";
		$this->load->view('layouts/v_header', $data);
		$this->load->view('layouts/v_navbar');
		$this->load->view('ppdb/jalurprestasi');
		$this->load->view('layouts/v_footer');
	}
}
