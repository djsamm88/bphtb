<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');				
		$this->load->helper('custom_func');
		if ($this->session->userdata('userid')=="") {
			redirect(base_url().'index.php/login');
		}
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");
		//$this->load->library('datatables');
		$this->load->model('m_data');
		

		
	}

	

	public function laporan_all()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');		
		$data['all'] = $this->m_laporan($tgl_awal,$tgl_akhir);
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		$this->load->view('laporan_all',$data);
	}

	public function laporan_xl()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');		
		$data['all'] = $this->m_laporan($tgl_awal,$tgl_akhir);
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		$this->load->view('laporan_xl',$data);

		$file = "Laporan-$tgl_awal-$tgl_akhir.xls";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$file");
		header("Pragma: no-cache");
		header("Expires: 0");	

	}


	

	private function m_laporan($tgl_awal,$tgl_akhir) {
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
					AND  (c.updated_on BETWEEN '$tgl_awal' AND '$tgl_akhir')
				ORDER BY c.id_bphtb DESC
		");

		return $q->result();

	}


	
}
