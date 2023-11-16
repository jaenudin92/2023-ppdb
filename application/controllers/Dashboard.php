<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	var $bobot = array(
		'1' => 'Sama Penting Dengan',
		'2' => 'Mendekati Sedikit Lebih Penting',
		'3' => 'Sedikit Lebih Penting',
		'4' => 'Mendekati Lebih Penting',
		'5' => 'Lebih Penting',
		'6' => 'Mendekati Lebih Penting',
		'7' => 'Sangat Penting',
		'8' => 'Mendekati Mutlak',
		'9' => 'Mutlak Sangat Penting',
	);

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		if ($this->session->userdata('status') !=  "logged") {
			redirect(base_url('Login'));
		}
	}

	public function index()
	{
		$data = [
			'datapreferensi' => $this->bobot,
			'datakriteria' => $this->db->get('tbl_kriteria')->result(),
			'dataalternatif' => $this->db->get('tbl_alternatif')->num_rows()
		];
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dashboard/dashboard',$data);
		$this->load->view('templates/footer');
	}


	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('status');
		redirect('Login');
	}
}
