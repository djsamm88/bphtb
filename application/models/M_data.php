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
				WHERE b.usergrup_tujuan='6' AND (d.Status_Bayar='' OR d.Status_Bayar='0') AND (c.jumlah_setor<>'' OR c.jumlah_setor<>0)
				ORDER BY d.Tgl_Bayar DESC
		");

		return $q->result();

	}

	public function data_print() {
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
				WHERE b.usergrup_tujuan='6' AND (d.Status_Bayar='1' OR (c.jumlah_setor='' OR c.jumlah_setor=0)) AND c.print_sspd=''
				ORDER BY d.Tgl_Bayar DESC
		");

		return $q->result();

	}



	public function notif_print()
	{
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
				WHERE b.usergrup_tujuan='6' AND d.Status_Bayar='1' AND c.print_sspd=''
				ORDER BY d.Tgl_Bayar DESC
				");
		$data = $q->num_rows();
		return $data;
	}

	public function data_email_ppat($id_bphtb)
	{
		$q = $this->db->query("
					SELECT a.useremail FROM tbl_users a 
					INNER JOIN 
					(
						SELECT MIN(id_bphtb_log) AS min_id,created_by,id_bphtb 
						FROM tbl_bphtb_log 
						WHERE id_bphtb='$id_bphtb'
						GROUP BY id_bphtb 
					)b 
					ON a.userid=b.created_by
			");
		$data = $q->result();
		return $data[0]->useremail;
	}

	public function data_selesai() {
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
				WHERE b.usergrup_tujuan='6' AND d.Status_Bayar='1' AND c.print_sspd<>''
				ORDER BY c.id_bphtb DESC
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
				WHERE b.usergrup_tujuan='6' AND (d.Status_Bayar='' OR d.Status_Bayar='0')
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

	public function penanda_tangan($id_bphtb,$usergroup)
	{
		$q = $this->db->query("
				SELECT 
					a.id_bphtb_log,
				    a.usergrup_sumber,
				    a.userid,
				    a.id_bphtb,
				    b.nama_lengkap,
				    b.file_ttd,
				    CASE
				        WHEN usergrup_sumber = 1 THEN 'PPAT'
				        WHEN usergrup_sumber = 2 THEN 'BPKPAD_STAF'
				        WHEN usergrup_sumber = 3 THEN 'BPKPAD_ES_IV'
				        WHEN usergrup_sumber = 4 THEN 'BPKPAD_ES_III'
				        WHEN usergrup_sumber = 5 THEN 'BPKPAD_ES_II'
				    END AS ket
									FROM tbl_bphtb_log a
									LEFT JOIN tbl_users b ON a.userid=b.userid
				                    WHERE id_bphtb='$id_bphtb' AND usergrup_sumber='$usergroup'
									GROUP BY usergrup_sumber
				                    ORDER BY id_bphtb_log DESC
				          
				          
			");
		return $q->result();
	}


	public function bphtb_by_id($id_bphtb)
	{
		$q = $this->db->query("
				SELECT a.*,b.Tgl_STS,b.No_STS FROM tbl_bphtb a 
				LEFT JOIN STS_History b ON a.id_bphtb=b.id_bphtb
				WHERE a.id_bphtb='$id_bphtb';
		");

		return $q->result();
	}




	public function nm_kelurahan_lama($KD_DATI2,$KD_KECAMATAN,$KD_KELURAHAN)
	{
		$q = $this->db->query("
					SELECT * FROM ref_kelurahan WHERE 
					KD_KELURAHAN='$KD_KELURAHAN' AND 
					KD_KECAMATAN='$KD_KECAMATAN' AND 
					KD_DATI2='$KD_DATI2' 

			");
		$x = @$q->result()[0];
		return $x->NM_KELURAHAN;
	}


	public function nm_kecamatan_lama($KD_DATI2,$KD_KECAMATAN)
	{
		$q = $this->db->query("SELECT * FROM ref_kecamatan WHERE 
					KD_KECAMATAN='$KD_KECAMATAN' AND 
					KD_DATI2='$KD_DATI2' 
			");
		$x = @$q->result()[0];
		return $x->NM_KECAMATAN;
	}

	public function nm_dati2_lama($KD_DATI2)
	{
		
			$q = $this->db->query("SELECT * FROM ref_dati2 WHERE 
									KD_DATI2='$KD_DATI2' 
								");
			$x = @$q->result()[0];
			return $x->NM_DATI2;	
		
		
	}





	public function nm_kelurahan($KD_PROPINSI,$KD_DATI2,$KD_KECAMATAN,$KD_KELURAHAN)
	{
		$q = $this->db->query("
					SELECT * FROM new_ref_kelurahan WHERE 
					KD_KELURAHAN='$KD_KELURAHAN' AND 
					KD_KECAMATAN='$KD_KECAMATAN' AND 
					KD_DATI2='$KD_DATI2' AND 
					KD_PROPINSI='$KD_PROPINSI'

			");
		$x = @$q->result()[0];
		return $x->NM_KELURAHAN;
	}

	public function nm_kecamatan($KD_PROPINSI,$KD_DATI2,$KD_KECAMATAN)
	{
		$q = $this->db->query("SELECT * FROM new_ref_kecamatan WHERE 
					KD_KECAMATAN='$KD_KECAMATAN' AND 
					KD_DATI2='$KD_DATI2' AND 
					KD_PROPINSI='$KD_PROPINSI'
			");
		$x = @$q->result()[0];
		return $x->NM_KECAMATAN;
	}

	public function nm_dati2($KD_PROPINSI,$KD_DATI2)
	{
		
			$q = $this->db->query("SELECT * FROM new_ref_dati2 WHERE 
									KD_DATI2='$KD_DATI2' AND 
									KD_PROPINSI='$KD_PROPINSI'
								");
			$x = @$q->result()[0];
			return $x->NM_DATI2;	
		
		
	}

	public function dokumen_by_id($id_bphtb)
	{
		$q = $this->db->query("SELECT * FROM `tbl_bphtb_dokumen` WHERE id_bphtb='$id_bphtb'");
		return $q->result();
	}

}

?>
