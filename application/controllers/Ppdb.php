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
	public function prosesreguler()
	{
		$lastpendafataran = $this->db->query("SELECT
						   cast(COALESCE(MAX(CAST(SUBSTRING(no_pendaftaran, 6) AS SIGNED)), 0) as int) AS mxno
						  FROM tbl_calon_siswa")->row_array();
		$no_pendaftaran = date('Ym') . str_pad(($lastpendafataran['mxno'] + 1), 4, '0', STR_PAD_LEFT);

		$datacalonsiswa = [
			"no_pendaftaran" => $no_pendaftaran,
			"tahun_pendaftaran" => date('Y'),
			"nisn" => $this->input->post('nisn'),
			"nama_lengkap" => $this->input->post('nama_siswa'),
			"tmp_lahir" => $this->input->post('tmpl_siswa'),
			"tgl_lahir" => $this->input->post('tgll_siswa'),
			"jk_kelamin" => $this->input->post('jk_siswa'),
			"agama" => $this->input->post('agama_siswa'),
			"alamat" => $this->input->post('alamat_siswa'),
			"sekolah_asal" => $this->input->post('sekolahasal'),
			"jalur" => "Reguler",
		];
		$this->db->insert('tbl_calon_siswa', $datacalonsiswa);

		$dataayah = [
			"no_pendaftaran" => $no_pendaftaran,
			"nama_ayah" => $this->input->post('nama_ayah'),
			"tmp_lahir_ayah" => $this->input->post('tmpl_ayah'),
			"tgl_lahir_ayah" => $this->input->post('tgll_ayah'),
			"agama_ayah" => $this->input->post('agama_ayah'),
			"warganegara_ayah" => $this->input->post('wargan_ayah'),
			"no_telp_ayah" => $this->input->post('tlp_ayah'),
			"alamat_ayah" => $this->input->post('alamat_ayah'),
		];
		$this->db->insert('tbl_ayah', $dataayah);

		$dataibu = [
			"no_pendaftaran" => $no_pendaftaran,
			"nama_ibu" => $this->input->post('nama_ibu'),
			"tmp_lahir_ibu" => $this->input->post('tmpl_ibu'),
			"tgl_lahir_ibu" => $this->input->post('tgll_ibu'),
			"agama_ibu" => $this->input->post('agama_ibu'),
			"warganegara_ibu" => $this->input->post('wargan_ibu'),
			"no_telp_ibu" => $this->input->post('tlp_ibu'),
			"alamat_ibu" => $this->input->post('alamat_ibu'),
		];
		$this->db->insert('tbl_ibu', $dataibu);


		 // Upload
		$config['upload_path']          = './assets/frontend/upload/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('fileijazah')) {

			$filedata = $this->upload->data();
			$filename = $filedata['file_name'];

			$datascan = array(
				'no_pendaftaran' => $no_pendaftaran,
				'filescan' => $filename
			);
			$this->db->insert('tbl_filescan', $datascan);
			$lastid = $this->db->insert_id();
		}

		var_dump($lastid);
		die();

		$datamapel = ['bhs_indo','bhs_ingg','matematika'];
		foreach ($datamapel as $key => $dmpl) {
			if ($dmpl == 'bhs_indo') {
				$mapel = "Bahasa Indonesia";
			}elseif($dmpl == 'bhs_ingg')
			{
				$mapel = "Bahasa Inggris";
			}else{
				$mapel = "Matematika";
			}
			$datanilaimapel = array(
				'id_file' => $lastid,
				'mapel' => $mapel,
				'nilai' => $this->input->post($dmpl)
			);
			$this->db->insert('tbl_nilai', $datanilaimapel);
		}

		$response = array("success" => TRUE);
		echo json_encode($response);
	}
}
