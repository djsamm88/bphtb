<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_data extends CI_Model {

	public function data($usergroup) {
		$q = $this->db->query("
				SELECT a.max_id,b.id_bphtb_log, b.catatan,b.status,b.usergrup_sumber,b.usergrup_tujuan,
				c.*,
				b.updated_on  
				FROM (
					SELECT MAX(id_bphtb_log) AS max_id
					FROM tbl_bphtb_log 
					GROUP BY id_bphtb
					ORDER BY id_bphtb_log DESC
				) a
				LEFT JOIN tbl_bphtb_log b ON a.max_id=b.id_bphtb_log
				LEFT JOIN tbl_bphtb c ON b.id_bphtb=c.id_bphtb
				WHERE b.usergrup_tujuan='$usergroup'
				ORDER BY b.updated_on DESC
		");

		return $q->result();

	}

	public function notif($usergroup)
	{
		$q = $this->db->query("SELECT a.max_id,b.id_bphtb_log, b.catatan,b.status,b.usergrup_sumber,b.usergrup_tujuan,
				c.*,
				b.updated_on  
				FROM (
					SELECT MAX(id_bphtb_log) AS max_id
					FROM tbl_bphtb_log 
					GROUP BY id_bphtb
					ORDER BY id_bphtb_log DESC
				) a
				LEFT JOIN tbl_bphtb_log b ON a.max_id=b.id_bphtb_log
				LEFT JOIN tbl_bphtb c ON b.id_bphtb=c.id_bphtb
				WHERE b.usergrup_tujuan='$usergroup'
				ORDER BY b.updated_on DESC");
		$data = $q->num_rows();
		return $data;
	}


	public function data_bank() {
		$q = $this->db->query("
				SELECT a.max_id,b.id_bphtb_log, b.catatan,b.status,b.usergrup_sumber,b.usergrup_tujuan,
				c.*,d.*,
				b.updated_on  
				FROM (
					SELECT MAX(id_bphtb_log) AS max_id
					FROM tbl_bphtb_log 
					GROUP BY id_bphtb
					ORDER BY id_bphtb_log DESC
				) a
				LEFT JOIN tbl_bphtb_log b ON a.max_id=b.id_bphtb_log
				LEFT JOIN tbl_bphtb c ON b.id_bphtb=c.id_bphtb
				LEFT JOIN STS_History d ON c.id_bphtb=d.id_bphtb
				WHERE b.usergrup_tujuan='6'
				ORDER BY d.Tgl_Bayar DESC
		");

		return $q->result();

	}


	public function notif_bank()
	{
		$q = $this->db->query("SELECT a.max_id,b.id_bphtb_log, b.catatan,b.status,b.usergrup_sumber,b.usergrup_tujuan,
				c.*,d.*,
				b.updated_on  
				FROM (
					SELECT MAX(id_bphtb_log) AS max_id
					FROM tbl_bphtb_log 
					GROUP BY id_bphtb
					ORDER BY id_bphtb_log DESC
				) a
				LEFT JOIN tbl_bphtb_log b ON a.max_id=b.id_bphtb_log
				LEFT JOIN tbl_bphtb c ON b.id_bphtb=c.id_bphtb
				LEFT JOIN STS_History d ON c.id_bphtb=d.id_bphtb
				WHERE b.usergrup_tujuan='6' AND Status_Bayar='1'
				");
		$data = $q->num_rows();
		return $data;
	}



	public function history($usergroup) {
		$q = $this->db->query("
				SELECT a.*,b.* FROM tbl_bphtb a 
				RIGHT JOIN (
					SELECT b.id_bphtb,a.max_id,b.id_bphtb_log, b.catatan,b.status,b.usergrup_sumber,b.usergrup_tujuan,		
					b.updated_on  
					FROM (
						SELECT MAX(id_bphtb_log) AS max_id
						FROM tbl_bphtb_log 
						GROUP BY id_bphtb
						ORDER BY id_bphtb_log DESC
					) a
					LEFT JOIN tbl_bphtb_log b ON a.max_id=b.id_bphtb_log
				)b 
				ON a.id_bphtb=b.id_bphtb
				ORDER BY b.updated_on DESC
		");

		return $q->result();

	}


	public function timeline($id_bphtb)
	{
		$q = $this->db->query("
				SELECT * FROM tbl_bphtb_log WHERE id_bphtb='$id_bphtb' ORDER BY id_bphtb_log DESC
			");
		return $q->result();
	}


	public function data_by_id($id_bphtb_log) {
		$q = $this->db->query("
				SELECT b.id_bphtb_log, b.catatan,b.status,b.usergrup_sumber,b.usergrup_tujuan,
				c.*  
				FROM tbl_bphtb_log b 
				LEFT JOIN tbl_bphtb c ON b.id_bphtb=c.id_bphtb
				WHERE b.id_bphtb_log='$id_bphtb_log'
		");

		return $q->result();
	}

	public function bphtb_by_id($id_bphtb)
	{
		$q = $this->db->query("
				SELECT * FROM tbl_bphtb WHERE id_bphtb='$id_bphtb';
		");

		return $q->result();
	}

	public function nm_kelurahan($id)
	{
		$q = $this->db->query("SELECT * FROM ref_kelurahan WHERE KD_KELURAHAN='$id'");
		$x = $q->result()[0];
		return $x->NM_KELURAHAN;
	}

	public function nm_kecamatan($id)
	{
		$q = $this->db->query("SELECT * FROM ref_kecamatan WHERE KD_KECAMATAN='$id'");
		$x = $q->result()[0];
		return $x->NM_KECAMATAN;
	}

	public function nm_dati2($id)
	{
		if($id=="")
		{
			return "PAKPAK BHARAT";
		}else{
			$q = $this->db->query("SELECT * FROM ref_dati2 WHERE KD_DATI2='$id'");
			$x = $q->result()[0];
			return $x->NM_DATI2;	
		}
		
	}

	public function dokumen_by_id($id_bphtb)
	{
		$q = $this->db->query("SELECT * FROM `tbl_bphtb_dokumen` WHERE id_bphtb='$id_bphtb'");
		return $q->result();
	}

}

?>
