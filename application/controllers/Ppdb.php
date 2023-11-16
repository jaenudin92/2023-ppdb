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
		$data["sekolah_asal"] = $this->db->query("select * from tbl_sekolah_asal")->result();
		$this->load->view('layouts/v_header', $data);
		$this->load->view('layouts/v_navbar');
		$this->load->view('ppdb/jalurreguler');
		$this->load->view('layouts/v_footer');
	}
	public function jalurprestasi()
	{
		$data["title"] = "PPDB";
		$data["sekolah_asal"] = $this->db->query("select * from tbl_sekolah_asal")->result();
		$this->load->view('layouts/v_header', $data);
		$this->load->view('layouts/v_navbar');
		$this->load->view('ppdb/jalurprestasi');
		$this->load->view('layouts/v_footer');
	}
	public function getsekolahasal()
	{
		$id = $this->input->post("id");
		$record = $this->db->query("select * from tbl_sekolah_asal where id= '$id' ")->result_array();

		echo json_encode($record);
	}
}
