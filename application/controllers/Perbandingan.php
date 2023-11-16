<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perbandingan extends CI_Controller {

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
			redirect(base_url('login'));
		};
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->model('AHP');
		$this->load->model('AHP2');
	}

	public function kriteria()
	{
		$data = array(
			//bawaan
			'nilai_preferensi' => $this->bobot,
			//tambahan
			'data' => $this->db->get("tbl_alternatif")->result(),
			'bobot' => $this->bobot,
			'kriteria' => $this->db->get("tbl_kriteria")->result(),
			'hasil_kriteria' => $this->db->get('tbl_hasil_kriteria')->result()
		);

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('perbandingan/kriteria',$data);
		$this->load->view('templates/footer');
	}

	function ins_nilai_kriteria(){
		$input = $this->input->post();
		$inputan = array(
			
			'kriteria1' => $this->input->post('kriteria1'),
			'bobot' => $this->input->post('bobot'),
			'kriteria2' => $this->input->post('kriteria2'),
		);
		$cc = count($inputan['kriteria1']);

		/*$this->pre($inputan);
		die;*/

		for ($i=0; $i <= $cc ; $i++) { 
			
			for ($j=$i+1; $j <= $cc ; $j++) { 

				$cek = $this->db->query('select * from tbl_hasil_kriteria where kriteria1 = ? and kriteria2 = ?',array($inputan['kriteria1'][$i][$j], $inputan['kriteria2'][$i][$j]))->row();
				if($cek == true){
					$query = $this->db->query('update tbl_hasil_kriteria set bobot = ?  where kriteria1 =? and kriteria2 = ?',array($inputan['bobot'][$i][$j], $inputan['kriteria1'][$i][$j], $inputan['kriteria2'][$i][$j]));
				}else{
					$query = $this->db->query('insert into tbl_hasil_kriteria values("'.$inputan['kriteria1'][$i][$j].'","'.$inputan['bobot'][$i][$j].'","'.$inputan['kriteria2'][$i][$j].'")');	
				}
				
				

			}

		}
		#$query = $this->db->query

		if($query == true){
			echo '<script>alert("Berhasil");</script>';
			redirect('Perbandingan/perbandingan_kriteria','refresh');
		}else{
			echo '<script>alert("Gagal");</script>';
		}

		$this->pre($input);

		
	}

	public function perbandingan_kriteria(){

		$data = array(
			'nilai_preferensi' => $this->bobot,
			//tambahan
			'data' => $this->db->get('tbl_hasil_kriteria')->result(),
			'alke' => $this->db->get('tbl_alternatif')->result(),
			'kriteria' => $this->db->get('tbl_kriteria')->result()
		);

		$ahp = $this->AHP2->perbandingan_kriteria($data['data'], $data['kriteria']);
		$data['ahp1'] = $ahp;

		$ahp = $this->AHP2->normalisasi_kriteria($ahp, $data['data'], $data['kriteria']);
		$data['ahp2'] = $ahp;
		
		$ahp = $this->AHP2->konsisten($data['data'], $ahp);
		$data['ahp3'] = $ahp;

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('perbandingan/nilaiprio',$data);
		$this->load->view('templates/footer');
	}


	function save_prioritas(){
		$input = $this->input->post();

		foreach ($input['kriteria'] as $key => $value) {
			
			$cek = $this->db->query('select * from tbl_prioritas_kriteria where kriteria = ? and periode = ?',array($input['kriteria'][$key], $input['periode']))->row();

			if($cek != null){

				$query = $this->db->query('update tbl_prioritas_kriteria set prioritas = ? where kriteria = ? and periode = ?',array($input['prioritas'][$key] ,$input['kriteria'][$key], $input['periode']));

			}else{
				$query = $this->db->query('insert into tbl_prioritas_kriteria(kriteria, prioritas, periode) values("'.$input['kriteria'][$key].'","'.$input['prioritas'][$key].'", "'.$input['periode'].'")');
			}
		}

		if($query == true){
			echo '<script>alert("Prioritas Tersimpan");</script>';
			redirect('Perbandingan/analisa','refresh');
		}else{
			echo '<script>alert("Gagal");</script>';
		}

		//$this->pre($input);

	}


	public function analisa(){
		$data = array(
			'nilai_preferensi' => $this->bobot,
			'data' => $this->db->get('tbl_alternatif')->result(),
			'bobot' => $this->bobot,
			'kriteria' => $this->db->get('tbl_kriteria')->result(),
			'hasil_kriteria' => $this->db->get('tbl_hasil_kriteria')->result()
		);

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('perbandingan/analisa',$data);
		$this->load->view('templates/footer');

	}

	// ===============================================================================================

	public function alternatif()
	{
		$data = array(
			'bobot' => $this->bobot,
			'nilai' => $this->db->query('select a.nik as id,a.nama as nater,b.nilai,b.keterangan from tbl_alternatif a inner join tbl_nilai_awal b on b.id_alternatif = a.nik')->result(),
			'kriteria' => $this->db->get('tbl_kriteria')->result(),
			'alternatif' => $this->db->get('tbl_alternatif')->result()
		);

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('perbandingan/alternatif',$data);
		$this->load->view('templates/footer');
	}

	function get_kriteria(){
		$id =$this->input->post('kriteria');
		$alternatif = $this->db->get('tbl_alternatif')->result();
		$bobot = $this->bobot;

		foreach ($alternatif as $key => $value) {
			foreach ($alternatif as $keys => $values) {
				
				if($key < $keys){

					echo '<div class="row">';

					echo '<div class="col-xs-12 col-md-3 mt-3">
							<div class="form-group">
								<input type="text" class="form-control" readonly value="'.$value->nama.'"">
								<input type="hidden" class="form-control" readonly value="'.$value->nik.'" name="alternatif1['.$key.']['.$keys.']">
							</div>
						  </div>';
					echo '<div class="col-xs-12 col-md-6 mt-3">
							<div class="form-group">';
							echo "<select name='bobot[$key][$keys]' class='form-control'>";
							$cek = $this->db->query('select * from tbl_hasil_alternatif where kriteria = ? and alternatif1 = ? and alternatif2 = ?',array($id, $value->nik, $values->nik))->row();
							if($cek != null){
								if($cek->bobot == 1){
				
									echo "<option value='$cek->bobot'>$cek->bobot-Sama Penting</option>";

								}elseif ($cek->bobot == 2) {
									echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Sedikit Lebih Penting</option>";
								}elseif($cek->bobot == 3){
									echo "<option value='$cek->bobot'>$cek->bobot-Sedikit Lebih Penting</option>";
								}elseif($cek->bobot == 4){
									echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Lebih Penting</option>";
								}elseif($cek->bobot == 5){
									echo "<option value='$cek->bobot'>$cek->bobot-Lebih Penting</option>";
								}elseif ($cek->bobot == 6) {
									echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Lebih Penting</option>";
								}elseif($cek->bobot == 7){
									echo "<option value='$cek->bobot'>$cek->bobot-Sangat Penting</option>";
								}elseif($cek->bobot == 8){
									echo "<option value='$cek->bobot'>$cek->bobot-Mendekati Mutlak</option>";
								}else{
										echo "<option value='$cek->bobot'>$cek->bobot-Mutlak Sangat Penting</option>";
									}
								
								foreach ($bobot as $keyb => $valueb) {
									if($cek->bobot == $keyb){
											
									}else{
											echo "<option value='$keyb'>$keyb-$valueb</option>";
									}
								}
							}else{

								foreach ($bobot as $keyb => $valueb) {
										if($cek->bobot == $keyb){
											
										}else{
											echo "<option value='$keyb'>$keyb-$valueb</option>";
										}
									}
							
							}
							echo '</select></div>
							</div>';

					echo '<div class="col-xs-12 col-md-3 mt-3">
							<div class="form-group">
								<input type="text" class="form-control" readonly value="'.$values->nama.'"">
								<input type="hidden" class="form-control" readonly value="'.$values->nik.'" name="alternatif2['.$key.']['.$keys.']">
							</div>
						 </div>';

						echo '</div>'; //end row
								} // end if
			
			} // end keys
		} // end key
		//$query = $this->db->query('select * from hasil alternatif whre')
		//$this->pre($cek->bobot);
		echo '<button type="submit" class="btn btn-primary mt-4"> Selanjutnya <span class="fa fa-arrow-right"></span></button>';
	}


	public function perbandingan_alternatif_single(){
		$input = $this->input->post();
		$id = $this->input->post('kriteria');

		/*$this->pre($id);
		die;*/

		$data = array(
			'data' => $this->db->get('tbl_hasil_alternatif')->result(),
			'data_id' => $this->db->group_by('kriteria')->get('tbl_hasil_alternatif')->result(),
			'alke' => $this->db->get('tbl_alternatif')->result(),
			'kriteria' => $this->db->get_where('tbl_kriteria', 'id="'.$id.'"')->row(),
			'input' => $this->input->post('kriteria'),
		);

		$ahp = $this->AHP->perbandingan_alternatif($data['alke'], $input);
		$data['ahp1'] = $ahp;
		// var_dump($ahp);
		// die;
		$ahp = $this->AHP->normalisasi_prioritas($data['alke'], $ahp);
		$data['ahp2'] = $ahp;

		// var_dump($ahp);
		// die;

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('perbandingan/alternatif_single',$data);
		$this->load->view('templates/footer');

		#$this->pre($data);

	}

	function ins_nilai_alternatif(){
		$input = $this->input->post();
		$inputan = array(
			'kriteria' => $this->input->post('kriteria'),
			'alternatif1' => $this->input->post('alternatif1'),
			'bobot' => $this->input->post('bobot'),
			'alternatif2' => $this->input->post('alternatif2'),
		);
		$cc = count($inputan['alternatif1']);

		//input bobot
		for ($i=0; $i <= $cc ; $i++) { 
			
			for ($j=$i+1; $j <= $cc ; $j++) { 

				$cek = $this->db->query('select * from tbl_hasil_alternatif where kriteria = ? and alternatif1 = ? and alternatif2 = ?',array($inputan['kriteria'], $inputan['alternatif1'][$i][$j], $inputan['alternatif2'][$i][$j]))->row();
				if($cek == true){
					$query = $this->db->query('update tbl_hasil_alternatif set bobot = ?  where kriteria = ? and alternatif1 =? and alternatif2 = ?',array($inputan['bobot'][$i][$j], $inputan['kriteria'], $inputan['alternatif1'][$i][$j], $inputan['alternatif2'][$i][$j]));
				}else{
					$query = $this->db->query('insert into tbl_hasil_alternatif values("'.$inputan['kriteria'].'","'.$inputan['alternatif1'][$i][$j].'","'.$inputan['bobot'][$i][$j].'","'.$inputan['alternatif2'][$i][$j].'")');	
				}
				
				

			}

		}
		#$query = $this->db->query
		//input prioritas

		if($query == true){
			echo '<script>alert("Berhasil");</script>';
			#redirect('Alternatif/perbandingan_alternatif','refresh');
			redirect('Perbandingan/alternatif','refresh');
		}else{
			echo '<script>alert("Gagal");</script>';
		}
		//$this->pre($input);
	}


	// ======================================================================================================


	public function perbandingan_alternatif(){

		$data = array(
			'data' => $this->db->get('tbl_hasil_alternatif')->result(),
			'data_id' => $this->db->group_by('kriteria')->get('tbl_hasil_alternatif')->result(),
			'alke' => $this->db->get('tbl_alternatif')->result(),
			'kriteria' => $this->db->get('tbl_kriteria')->result()
		);

		$ahp = $this->AHP2->perbandingan_alternatif($data['alke'], $data['data']);
		$data['ahp1'] = $ahp;
		// var_dump($data['ahp1']);
		// die();

		$ahp = $this->AHP2->normalisasi_prioritas($data['alke'], $data['data'], $ahp);
		$data['ahp2'] = $ahp;
		// var_dump($data['ahp2']);
		// die();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('perbandingan/alternatif_prio',$data);
		$this->load->view('templates/footer');
	}

	function ins_prioritas(){
		$input = $this->input->post();

		$inputan = array(
			'kriteria' => $this->input->post('kriteria'),
			'alternatif' => $this->input->post('alternatif'),
			'prioritas' => $this->input->post('prioritas'),
		);

		$jumlah = count($input['kriteria']);

		for ($i=0; $i < $jumlah ; $i++) { 
			
			$cek = $this->db->query('select * from tbl_prioritas_alternatif where kriteria = ? and alternatif = ? and periode = ?',array($inputan['kriteria'][$i], $input['alternatif'][$i], $input['periode']))->row();

			if($cek == true){
				$query = $this->db->query('update tbl_prioritas_alternatif set prioritas = ? where kriteria = ? and alternatif = ? and periode = ?',array($input['prioritas'][$i], $input['kriteria'][$i], $input['alternatif'][$i], $input['periode']));
			}else{
				$query = $this->db->query('insert into tbl_prioritas_alternatif values ("", "'.$input['kriteria'][$i].'", "'.$input['alternatif'][$i].'", "'.$input['prioritas'][$i].'", "'.$input['periode'].'")');
			}

		}
		

		if($query == true){
			echo '<script>alert("Prioritas Tersimpan");</script>';
			redirect('Perbandingan/perbandingan_alternatif','refresh');
			#redirect('Alternatif/analisa','refresh');
		}else{
			echo '<script>alert("Gagal");</script>';
		}

		#$this->pre($input);
	}
	
}
