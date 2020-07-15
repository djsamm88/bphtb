<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');				
		$this->load->helper('custom_func');
		
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");
		//$this->load->library('datatables');
		$this->load->model('m_data');
		
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');
		
	}


	public function getBPHTBService()
	{
		$json = json_decode(file_get_contents('php://input'));
		//$json = json_decode($this->input->post());
		$res = new stdClass();


		if($json)
		{
			

			if($json->NOP=="")
			{
				$res->respon_code = "NOP tidak ditemukan";				
			}else if($json->NTPD=="")
			{
				$res->respon_code = "NTPD tidak ditemukan";				
			}else{

				$res->respon_code = "OK";

				$q = $this->cekDb($json->NOP,$json->NTPD);
				//var_dump($q);
				if(count($q)>0)
				{
					$res->respon_code = "OK";
					
					$y = $q[0];
					$res->result=$y;

				}else{
					$res->respon_code = "Data tidak ditemukan".count($q);
				}

			}


			


		}else{	
			$res->respon_code = "Data tidak ditemukan";	
		}

		
		echo json_encode($res);
	}


	private function cekDb($NOP,$NTPD)
	{
		$x = "SELECT 
									b1 AS NOP,
								    a_nik AS NIK,
								    a1 AS NAMA,
								    a3 AS ALAMAT,
								    a6 AS KELURAHAN_OP,
								    a7 AS KECAMATAN_OP,
								    a8 AS KOTA_OP,
								    b8 AS LUASTANAH,
								    b9 AS LUASBANGUNAN,
								    jumlah_setor AS PEMBAYARAN,
								    'Y' AS STATUS,
								    DATE_FORMAT(tgl_bayar, '%d/%m/%Y') AS TANGGAL_PEMBAYARAN,
								    no_sts AS NTPD,
								    CASE
								    WHEN status_bayar = 1 THEN 'L'
								        ELSE 'T'
								    END AS JENISBAYAR
								    
								FROM (
								SELECT a.max_id,b.id_bphtb_log, b.catatan,b.status,b.usergrup_sumber,b.usergrup_tujuan,
												c.*,
								    			d.tgl_bayar, d.status_bayar, d.kode_pengesahan, d.kode_cab, d.nama_channel, d.kode_terminal,d.no_sts 
												FROM (
													SELECT MAX(id_bphtb_log) AS max_id
													FROM tbl_bphtb_log 
													GROUP BY id_bphtb
													ORDER BY id_bphtb_log DESC
												) a
												LEFT JOIN tbl_bphtb_log b ON a.max_id=b.id_bphtb_log
												LEFT JOIN tbl_bphtb c ON b.id_bphtb=c.id_bphtb
												LEFT JOIN STS_History d ON c.id_bphtb=d.id_bphtb
												WHERE b.usergrup_tujuan='6' AND c.print_sspd<>''
												ORDER BY d.Tgl_Bayar DESC
								)a
				WHERE b1='$NOP' AND No_STS='$NTPD'";
		$q = $this->db->query($x);

		return $q->result();
	}
}
