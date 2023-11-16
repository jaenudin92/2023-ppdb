<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alternatif extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		if ($this->session->userdata('status') !=  "logged") {
			redirect(base_url('login'));
		};
		$this->load->model('M_Alternatif','alternatif');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('alternatif/alternatif');
		$this->load->view('templates/footer');
	}

	public function list_alternatif()
	{
		$list = $this->alternatif->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $alternatif) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $alternatif->nik;
			$row[] = $alternatif->nama;
			$row[] = $alternatif->tempat_lahir;
			$row[] = $alternatif->tgl_lahir;
			$row[] = $alternatif->kelamin;
			$row[] = $alternatif->alamat;

            //add html for action
			$row[] = '<div class="dropdown">
			<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
			<i class="bx bx-dots-vertical-rounded"></i>
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item" href="javascript:void(0);" onclick="editAlternatif('."'".$alternatif->nik."'".')">
			<i class="bx bx-edit-alt me-1"></i> Edit</a>
			<a class="dropdown-item" href="javascript:void(0);" onclick="deleteAlternatif('."'".$alternatif->nik."'".')">
			<i class="bx bx-trash me-1"></i> Delete</a>
			</div>
			</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->alternatif->count_all(),
			"recordsFiltered" => $this->alternatif->count_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	public function add_alternatif()
	{
		$this->_validate();

		$data = array(
			'nik' => ucwords($this->input->post('nik')),
			'nama' => ucwords($this->input->post('nama')),
			'tempat_lahir' => $this->input->post('tempatlahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'kelamin' => $this->input->post('jk'),
			'alamat' => $this->input->post('alamat')
		);
		$insert = $this->alternatif->save($data);

		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function edit_alternatif($id)
	{
		$data = $this->alternatif->get_by_id($id);
	        // $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function update_alternatif()
	{
		$this->_validateupdate();
		$id = $this->input->post('nik');

		$data = array(
			'nama' => ucwords($this->input->post('nama')),
			'tempat_lahir' => $this->input->post('tempatlahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'kelamin' => $this->input->post('jk'),
			'alamat' => $this->input->post('alamat')
		);
		$this->alternatif->update(array('nik' => $id), $data);

		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function delete_alternatif($id)
	{
		$this->alternatif->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$this->form_validation->set_rules("nik","NIK","required|trim|min_length[10]|is_unique[tbl_alternatif.nik]");
		$this->form_validation->set_rules("nama","Nama","required|trim|min_length[3]");
		$this->form_validation->set_rules("tempatlahir","Tempat Lahir","required|trim");
		$this->form_validation->set_rules("alamat","Alamat","required|trim");
		if ($this->form_validation->run() == false ) {
			$response = [
				'error' => true,
				'nik_error' => form_error('nik'),
				'nama_error' => form_error('nama'),
				'tempatlahir_error' => form_error('tempatlahir'),
				'alamat_error' => form_error('alamat')
			];

			echo json_encode($response);
			exit();     
		}

	}

	private function _validateupdate()
	{
		$this->form_validation->set_rules("nama","Nama","required|trim|min_length[3]");
		$this->form_validation->set_rules("tempatlahir","Tempat Lahir","required|trim");
		$this->form_validation->set_rules("alamat","Alamat","required|trim");
		if ($this->form_validation->run() == false ) {
			$response = [
				'error' => true,
				'nama_error' => form_error('nama'),
				'tempatlahir_error' => form_error('tempatlahir'),
				'alamat_error' => form_error('alamat')
			];

			echo json_encode($response);
			exit();     
		}

	}
}
