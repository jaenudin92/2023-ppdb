<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		if ($this->session->userdata('status') !=  "logged") {
			redirect(base_url('login'));
		};
		$this->load->model('M_Alternatif');
		$this->load->model('M_Kriteria');
		$this->load->model('AHP');
		$this->load->model('AHP2');
	}

	public function index(){
		$nilai_awal = array();
			$data = array(
				'alternatif' => $this->db->get('tbl_alternatif')->result(),
				'hasil_alternatif' => $this->M_Alternatif->get_group(),
				'kriteria' => $this->db->get('tbl_kriteria')->result(),
				'nilai' => $this->db->get('tbl_prioritas_alternatif')->result(),
				'prioritas_kriteria' => $this->db->get('tbl_prioritas_kriteria')->result(),

				//get table
				'nama_alternatif' => $this->M_Alternatif->get_group(),
				'nilai_awal' => $this->M_Alternatif->get_nilai_alternatif()
			);

			$ahp = $this->AHP2->ranking($data['alternatif'], $data['nilai'], $data['prioritas_kriteria']);
			$data['ahp'] = $ahp;

			// var_dump($ahp);
			// die();

			foreach ($data['nilai_awal'] as $key => $value) {
				$nilai_awal[$key] = $value->nilai;
			}

			#$this->pre($data['nilai_awal']);
			#die;

			arsort($nilai_awal);
			$nett = array();
			$rank = 1;

		foreach ($nilai_awal as $key => $value) {
			$nett[$key] = $rank;
			$rank++;
		}

		$data['rank_awal'] = $nett;

		

		arsort($ahp);
		$nett = array();
		$rank = 1;

		foreach ($ahp as $key => $value) {
			$nett[$key] = $rank;
			$rank++;
		}

		$data['rank'] = $nett;

		

		if(!empty($data['prioritas_kriteria']) and !empty($data['nilai']) and !empty($nilai_awal))	{

			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('laporan/perangkingan',$data);
			$this->load->view('templates/footer');

		}else{
			
			$this->session->set_flashdata('msg', '<script>alert("Data Perhitungan Belum Tersedia")</script>');
			// redirect('laporan/','refresh');	
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('laporan/perangkingan',$data);
			$this->load->view('templates/footer');	
		}

	}

	// public function cetakhasil()
	// {
	// 	$data['hasilrangking'] = $this->db->query("select alternatif,nama,RANK() OVER (ORDER BY nilaiv desc) as ranking from tbl_hasil a inner join tbl_karyawan b on b.nik = a.alternatif")->result();
	// 	$pdf = $this->load->view("laporan/cetakhasil",$data,true);

    //    	$dompdf = new Dompdf();
    //    	$dompdf->set_option('isRemoteEnabled', TRUE);
    //    	$dompdf->loadHtml($pdf);
    //    	// (Optional) Setup the paper size and orientation
    //    	$dompdf->setPaper('A4', 'portrait');
    //    	// Render the HTML as PDF
    //    	$dompdf->render();
    //    	// Output the generated PDF to Browser
    //    	//$dompdf->stream();
    //    	$data = $dompdf->stream('hasilperankingan.pdf',array('Attachment'=>0));
	// }

	function print_doc(){
		$iduser = $this->session->userdata('id');
		$datauser = $this->db->query("select nama_lengkap,level,foto from tbl_user where id = '$iduser' ")->row_array();

		$data = array(
			'nama' => $datauser['nama_lengkap'],
			'alternatif' => $this->db->get('tbl_alternatif')->result(),
			'hasil_alternatif' => $this->M_Alternatif->get_group(),
			'kriteria' => $this->db->get('tbl_kriteria')->result(),
			'nilai' => $this->db->get('tbl_prioritas_alternatif')->result(),
			'prioritas_kriteria' => $this->db->get('tbl_prioritas_kriteria')->result(),

			//get table
			'nama_alternatif' => $this->M_Alternatif->get_group(),
			'nilai_awal' => $this->M_Alternatif->get_nilai_alternatif()
		);

		$ahp = $this->AHP2->ranking($data['alternatif'], $data['nilai'], $data['prioritas_kriteria']);
		$data['ahp'] = $ahp;

		#$this->pre($ahp);
		#die;

		foreach ($data['nilai_awal'] as $key => $value) {
			$nilai_awal[$key] = $value->nilai;
		}

		#$this->pre($data['nilai_awal']);
		#die;

		arsort($nilai_awal);
		$nett = array();
		$rank = 1;

		foreach ($nilai_awal as $key => $value) {
			$nett[$key] = $rank;
			$rank++;
		}

		$data['rank_awal'] = $nett;

		

		arsort($ahp);
		$nett = array();
		$rank = 1;

		foreach ($ahp as $key => $value) {
			$nett[$key] = $rank;
			$rank++;
		}

		$data['rank'] = $nett;

		$this->load->view('Laporan/cetakhasil',$data);

	}
}
