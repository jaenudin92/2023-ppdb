<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{

	var $table = '';
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->database();
	}

	// public function getDataNonAktif()
	// {
	// 	$records = $this->db->query("
	// 		select * from (
	// 		select *,
	// 		case when datediff(tgl_berlaku_sampai,current_date()) <= (select masa from tbl_set_expired limit 1) and datediff(tgl_berlaku_sampai,current_date()) > 0 and status <> 'Non Aktif' then 'Warning'
	// 		when datediff(tgl_berlaku_sampai,current_date()) <= 0 and status <> 'Non Aktif' then 'Expired'
	// 		when status = 'Non Aktif' then status
	// 		else status end as statusproduct
	// 		from tbl_product
	// 		) a where statusproduct = 'Non Aktif'
	// 		")->result();

	// 	return $records;
	// }
}
