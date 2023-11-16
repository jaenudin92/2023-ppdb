<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		if ($this->session->userdata('status') !=  "logged") {
			redirect(base_url('login'));
		};
		$this->load->helper('url');
		$this->load->model('m_kriteria','kriteria');
		$this->load->model('m_subkriteria','subkriteria');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('kriteria/kriteria');
		$this->load->view('templates/footer');
	}
	public function subkriteria($id)
	{
		$data['idkriteria'] = $id;
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('kriteria/subkriteria',$data);
		$this->load->view('templates/footer');
	}

	public function list_kriteria()
	{
		$list = $this->kriteria->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kriteria) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kriteria->kriteria;

            //add html for action
			$row[] = '<div class="dropdown">
			<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
			<i class="bx bx-dots-vertical-rounded"></i>
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item" href="'.base_url('Kriteria/subkriteria/'.$kriteria->id).'">
			<i class="bx bx-detail me-1"></i> Sub Kriteria</a>
			<a class="dropdown-item" href="javascript:void(0);" onclick="editKriteria('."'".$kriteria->id."'".')">
			<i class="bx bx-edit-alt me-1"></i> Edit</a>
			<a class="dropdown-item" href="javascript:void(0);" onclick="deleteKriteria('."'".$kriteria->id."'".')">
			<i class="bx bx-trash me-1"></i> Delete</a>
			</div>
			</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kriteria->count_all(),
			"recordsFiltered" => $this->kriteria->count_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	public function list_subkriteria()
	{
		$idkriteria = $this->input->post('idkriteria');
		$list = $this->subkriteria->get_datatables($idkriteria);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $subkriteria) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $subkriteria->kriteria;
			$row[] = $subkriteria->subkriteria;

            //add html for action
			$row[] = '<div class="dropdown">
			<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
			<i class="bx bx-dots-vertical-rounded"></i>
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item" href="javascript:void(0);" onclick="editSubKriteria('."'".$subkriteria->id."'".')">
			<i class="bx bx-edit-alt me-1"></i> Edit</a>
			<a class="dropdown-item" href="javascript:void(0);" onclick="deleteSubKriteria('."'".$subkriteria->id."'".')">
			<i class="bx bx-trash me-1"></i> Delete</a>
			</div>
			</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->subkriteria->count_all($idkriteria),
			"recordsFiltered" => $this->subkriteria->count_filtered($idkriteria),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	public function add_kriteria()
	{
		$this->_validate();

		$data = array(
			'kriteria' => ucwords($this->input->post('kriteria'))
		);
		$insert = $this->kriteria->save($data);

		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function add_subkriteria()
	{
		$this->_validatesub();

		$data = array(
			'idkriteria' => $this->input->post('idkriteria'),
			'subkriteria' => ucwords($this->input->post('subkriteria'))
		);
		$insert = $this->subkriteria->save($data);

		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function edit_kriteria($id)
	{
		$data = $this->kriteria->get_by_id($id);
		echo json_encode($data);
	}
	public function edit_subkriteria($id)
	{
		$data = $this->subkriteria->get_by_id($id);
		echo json_encode($data);
	}

	public function update_kriteria()
	{
		$id = $this->input->post('id');
		$datakriteria = $this->kriteria->get_by_id($id);

		$data = array(
			'kriteria' => ucwords($this->input->post('kriteria'))
		);
		$this->kriteria->update(array('id' => $id), $data);

		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function update_subkriteria()
	{
		$id = $this->input->post('id');

		$data = array(
			'subkriteria' => ucwords($this->input->post('subkriteria'))
		);
		$this->subkriteria->update(array('id' => $id), $data);

		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function delete_kriteria($id)
	{
		$this->kriteria->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_subkriteria($id)
	{
		$this->subkriteria->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$this->form_validation->set_rules("kriteria","Kriteria","required|trim|min_length[3]|is_unique[tbl_kriteria.kriteria]");
		if ($this->form_validation->run() == false ) {
			$response = [
				'error' => true,
				'kriteria_error' => form_error('kriteria')
			];

			echo json_encode($response);
			exit();     
		}

	}
	private function _validatesub()
	{
		$this->form_validation->set_rules("subkriteria","Sub Kriteria","required|trim|min_length[3]|is_unique[tbl_sub_kriteria.subkriteria]");
		if ($this->form_validation->run() == false ) {
			$response = [
				'error' => true,
				'subkriteria_error' => form_error('subkriteria')
			];

			echo json_encode($response);
			exit();     
		}

	}
}
