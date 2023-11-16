<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		if ($this->session->userdata('status') !=  "logged") {
			redirect(base_url('login'));
		};
		$this->load->model('m_penilaian','penilaian');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('penilaian/penilaian');
		$this->load->view('templates/footer');
	}
	public function list_penilaian()
	{
		$list = $this->penilaian->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $penilaian) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $penilaian->id_alternatif;
			$row[] = $penilaian->nilai;
			$row[] = $penilaian->keterangan;
			$row[] = $penilaian->periode;

            //add html for action
			$row[] = '<div class="dropdown">
			<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
			<i class="bx bx-dots-vertical-rounded"></i>
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item" href="javascript:void(0);" onclick="editPenilaian('."'".$penilaian->id_alternatif."','".$penilaian->periode."'".')">
			<i class="bx bx-edit-alt me-1"></i> Edit</a>
			<a class="dropdown-item" href="javascript:void(0);" onclick="deletePenilaian('."'".$penilaian->id."'".')">
			<i class="bx bx-trash me-1"></i> Delete</a>
			</div>
			</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->penilaian->count_all(),
			"recordsFiltered" => $this->penilaian->count_filtered(),
			"data" => $data,
		);
        //output to json format
		echo json_encode($output);
	}

	public function getform()
	{
		$html = '';

		$datakriteria = $this->db->query("SELECT * FROM tbl_kriteria")->result();
		foreach ($datakriteria as $key => $dtkriteria) {
			$html .= '<li class="mt-3"><h6>'.$dtkriteria->kriteria.'</h6></li>';
			$datasubkriteria = $this->db->query("SELECT * FROM tbl_sub_kriteria WHERE idkriteria = '$dtkriteria->id' ")->result();
			$no = 1;
			foreach ($datasubkriteria as $key => $dtsk) {
				$html .= '<li>
							<ol style="list-style-type: none;">
								<li>'.$no++.'. '.$dtsk->subkriteria.'</li>
								<div class="form-check form-check-inline">
	                            	<input class="form-check-input" type="radio" name="p'.$dtsk->id.'" id="p'.$dtsk->id.'n1" value="1" required checked/>
	                            	<label class="form-check-label" for="p'.$dtsk->id.'n1">1</label>
	                          	</div>
	                          	<div class="form-check form-check-inline">
	                            	<input class="form-check-input" type="radio" name="p'.$dtsk->id.'" id="p'.$dtsk->id.'n2" value="2"/>
	                            	<label class="form-check-label" for="p'.$dtsk->id.'n2">2</label>
	                          	</div>
	                          	<div class="form-check form-check-inline">
	                            	<input class="form-check-input" type="radio" name="p'.$dtsk->id.'" id="p'.$dtsk->id.'n3" value="3"/>
	                            	<label class="form-check-label" for="p'.$dtsk->id.'n3">3</label>
	                          	</div>
	                          	<div class="form-check form-check-inline">
	                            	<input class="form-check-input" type="radio" name="p'.$dtsk->id.'" id="p'.$dtsk->id.'n4" value="4"/>
	                            	<label class="form-check-label" for="p'.$dtsk->id.'n4">4</label>
	                          	</div>
							</ol>
						</li>';
			}
		}
		
		$dataalternatif = $this->db->query("SELECT * FROM tbl_alternatif")->result();

		$result['result'] = [
			'html' => $html,
			'alternatif' => $dataalternatif
		];

		echo json_encode($result);
	}

	public function add_penilaian()
	{
		$this->_validate();

		$nik = $this->input->post("nik");
		$periode = $this->input->post("tahun");
		// perulangan
		$datakriteria = $this->db->query("SELECT * FROM tbl_kriteria")->result();
		foreach ($datakriteria as $key => $dtkriteria) {
			$datasubkriteria = $this->db->query("SELECT * FROM tbl_sub_kriteria WHERE idkriteria = '$dtkriteria->id' ")->result();
			foreach ($datasubkriteria as $key => $dtsk) {
				// cek tbl_temp_nilai
				$idkriteria = $dtkriteria->id;
				$idsubkriteria = $dtsk->id;
				$nilai = $this->input->post('p'.$dtsk->id.'');
				$data = [
					'nilai' => $nilai
				];
				$wheredata = [
					'nik' => $nik,
					'idkriteria' => $idkriteria,
					'idsubkriteria' => $idsubkriteria,
					'periode' => $periode
				];
				
				$this->db->from('tbl_temp_nilai');
		        $this->db->where($wheredata);
		        $cektempnilai = $this->db->get()->num_rows();

				if ($cektempnilai > 0) {
					// update..
					$this->db->update('tbl_temp_nilai', $data,$wheredata);
				}else{
					// saving..
					$idkriteria = $dtkriteria->id;
					$idsubkriteria = $dtsk->id;
					$nilai = $this->input->post('p'.$dtsk->id.'');
					$data = [
						'nik' => $nik,
						'idkriteria' => $idkriteria,
						'idsubkriteria' => $idsubkriteria,
						'periode' => $periode,
						'nilai' => $nilai
					];

					$this->db->insert('tbl_temp_nilai', $data);
				}	
			}
		}

		$this->db->query("truncate tbl_temp_nilai_awal");
		$this->db->query("insert into tbl_temp_nilai_awal (id_alternatif,nilai,keterangan,periode)
							select
							nik,round(nilai) as nilai,
							case when nilai > 90 then 'Sangat Baik'
							when nilai < 90 and nilai >= 80 then 'Baik'
							when nilai < 80 and nilai >= 70 then 'Cukup Baik'
							when nilai < 70 and nilai >= 60 then 'Kurang'
							when nilai < 60 and nilai > 0 then 'Sangat Kurang' end as keterangan,
							periode from(
							select
							nik,sum(nilai) /4 * (100/(select count(1) from tbl_kriteria)) as nilai,
							periode
							from(
							select
							nik,periode,idkriteria,sum(nilai) / (select count(1) from tbl_sub_kriteria b where b.idkriteria  = a.idkriteria) as nilai
							from tbl_temp_nilai a where a.nik = '$nik' and a.periode = '$periode'
							group by nik,periode,idkriteria
							) aa group by nik,periode
							) cc");

		$ceknilaiawal = $this->db->query("select * from tbl_nilai_awal where id_alternatif = '$nik' and periode ='$periode' ")->num_rows();
		if ($ceknilaiawal > 0) {
			$this->db->query("update tbl_nilai_awal as a join tbl_temp_nilai_awal as b on b.id_alternatif = a.id_alternatif and b.periode = a.periode set a.nilai = b.nilai, a.keterangan = b.keterangan");
		}else{
			$this->db->query("insert into tbl_nilai_awal (id_alternatif,nilai,keterangan,periode)
							select id_alternatif,nilai,keterangan,periode from tbl_temp_nilai_awal");
		}

		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	// public function edit_penilaian($nik,$periode)
	// {
	// 	// var_dump($nik,$tahun);
	// 	// die();
	//     $html = '';

	// 	$datakriteria = $this->db->query("SELECT * FROM tbl_kriteria")->result();
	// 	foreach ($datakriteria as $key => $dtkriteria) {
	// 		$html .= '<li class="mt-3"><h6>'.$dtkriteria->kriteria.'</h6></li>';
	// 		$datasubkriteria = $this->db->query("SELECT * FROM tbl_sub_kriteria WHERE idkriteria = '$dtkriteria->id' ")->result();
	// 		$no = 1;
	// 		foreach ($datasubkriteria as $key => $dtsk) {
	// 			$datatempnilai = $this->db->query("SELECT * FROM tbl_temp_nilai WHERE nik = '$nik' and periode = '$periode' and idkriteria= '$dtkriteria->id' and idsubkriteria = '$dtsk->id' ")->row_array();
	// 			$html .= '<li>
	// 						<ol style="list-style-type: none;">
	// 							<li>'.$no++.'. '.$dtsk->subkriteria.'</li>
	// 							<div class="form-check form-check-inline">
	//                             	<input class="form-check-input" type="radio" name="p'.$dtsk->id.'" id="p'.$dtsk->id.'n1" value="1" '.($datatempnilai['nilai'] == 1)? 'checked' : '' .'/>
	//                             	<label class="form-check-label" for="p'.$dtsk->id.'n1">1</label>
	//                           	</div>
	//                           	<div class="form-check form-check-inline">
	//                             	<input class="form-check-input" type="radio" name="p'.$dtsk->id.'" id="p'.$dtsk->id.'n2" value="2" '.($datatempnilai['nilai'] == 2)? 'checked' : '' .'/>
	//                             	<label class="form-check-label" for="p'.$dtsk->id.'n2">2</label>
	//                           	</div>
	//                           	<div class="form-check form-check-inline">
	//                             	<input class="form-check-input" type="radio" name="p'.$dtsk->id.'" id="p'.$dtsk->id.'n3" value="3" '.($datatempnilai['nilai'] == 3)? 'checked' : '' .'/>
	//                             	<label class="form-check-label" for="p'.$dtsk->id.'n3">3</label>
	//                           	</div>
	//                           	<div class="form-check form-check-inline">
	//                             	<input class="form-check-input" type="radio" name="p'.$dtsk->id.'" id="p'.$dtsk->id.'n4" value="4" '.($datatempnilai['nilai'] == 4)? 'checked' : '' .'/>
	//                             	<label class="form-check-label" for="p'.$dtsk->id.'n4">4</label>
	//                           	</div>
	// 						</ol>
	// 					</li>';
	// 		}
	// 	}
		
	// 	$dataalternatif = $this->db->query("SELECT * FROM tbl_alternatif where nik = '$nik' ")->result();

	// 	$result['result'] = [
	// 		'html' => $html,
	// 		'alternatif' => $dataalternatif
	// 	];
	// 	echo json_encode($result);
	// }

	public function edit_penilaian($nik, $periode)
{
    $html = '';

    $datakriteria = $this->db->query("SELECT * FROM tbl_kriteria")->result();
    foreach ($datakriteria as $key => $dtkriteria) {
        $html .= '<li class="mt-3"><h6>' . $dtkriteria->kriteria . '</h6></li>';
        $datasubkriteria = $this->db->query("SELECT * FROM tbl_sub_kriteria WHERE idkriteria = '$dtkriteria->id' ")->result();
        $no = 1;
        foreach ($datasubkriteria as $key => $dtsk) {
            $datatempnilai = $this->db->query("SELECT * FROM tbl_temp_nilai WHERE nik = '$nik' AND periode = '$periode' AND idkriteria = '$dtkriteria->id' AND idsubkriteria = '$dtsk->id' ")->row_array();

            if (!empty($datatempnilai)) {
            	// Use ternary operators to add the "checked" attribute to the appropriate radio button
	            $checked1 = ($datatempnilai['nilai'] == 1) ? 'checked' : '';
	            $checked2 = ($datatempnilai['nilai'] == 2) ? 'checked' : '';
	            $checked3 = ($datatempnilai['nilai'] == 3) ? 'checked' : '';
	            $checked4 = ($datatempnilai['nilai'] == 4) ? 'checked' : '';

	            $html .= '<li>
	                        <ol style="list-style-type: none;">
	                            <li>' . $no++ . '. ' . $dtsk->subkriteria . '</li>
	                            <div class="form-check form-check-inline">
	                                <input class="form-check-input" type="radio" name="p' . $dtsk->id . '" id="p' . $dtsk->id . 'n1" value="1" ' . $checked1 . '/>
	                                <label class="form-check-label" for="p' . $dtsk->id . 'n1">1</label>
	                            </div>
	                            <div class="form-check form-check-inline">
	                                <input class="form-check-input" type="radio" name="p' . $dtsk->id . '" id="p' . $dtsk->id . 'n2" value="2" ' . $checked2 . '/>
	                                <label class="form-check-label" for="p' . $dtsk->id . 'n2">2</label>
	                            </div>
	                            <div class="form-check form-check-inline">
	                                <input class="form-check-input" type="radio" name="p' . $dtsk->id . '" id="p' . $dtsk->id . 'n3" value="3" ' . $checked3 . '/>
	                                <label class="form-check-label" for="p' . $dtsk->id . 'n3">3</label>
	                            </div>
	                            <div class="form-check form-check-inline">
	                                <input class="form-check-input" type="radio" name="p' . $dtsk->id . '" id="p' . $dtsk->id . 'n4" value="4" ' . $checked4 . '/>
	                                <label class="form-check-label" for="p' . $dtsk->id . 'n4">4</label>
	                            </div>
	                        </ol>
	                    </li>';
            }
        }
    }

    $dataalternatif = $this->db->query("SELECT * FROM tbl_alternatif where nik = '$nik' ")->result();

    $result['result'] = [
        'html' => $html,
        'alternatif' => $dataalternatif
    ];
    echo json_encode($result);
}


	public function update_penilaian()
	{
		$id = $this->input->post('id');
		$nilai = $this->input->post('nilai');
		$this->penilaian->update(array('id' => $id), ['nilai' => $nilai]);

		$response = array("success" => TRUE);
		echo json_encode($response);
	}

	public function delete_penilaian($id)
	{
		$nilaiawal = $this->db->query("select * from tbl_nilai_awal where id = '$id' ")->row_array();
		$nik = $nilaiawal['id_alternatif'];
		$periode = $nilaiawal['periode'];

		$this->db->query("delete from tbl_temp_nilai where nik = '$nik' and periode= '$periode' ");

		$this->penilaian->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$this->form_validation->set_rules("nik","Alternatif","required");
		$datakriteria = $this->db->query("SELECT * FROM tbl_kriteria")->result();
		foreach ($datakriteria as $key => $dtkriteria) {
			$datasubkriteria = $this->db->query("SELECT * FROM tbl_sub_kriteria WHERE idkriteria = '$dtkriteria->id' ")->result();
			foreach ($datasubkriteria as $key => $dtsk) {
				// cek
				$this->form_validation->set_rules('p'.$dtsk->id.'','Jawaban','required');

				if ($this->form_validation->run() == false ) {
					$response['errors']= [
						'error' => true,
						'nik_error' => form_error('nik'),
						'p'.$dtsk->id.'_error' => form_error('p'.$dtsk->id.'')
					];
					echo json_encode($response);
					exit();  
				}
			}
		}
	}
}
