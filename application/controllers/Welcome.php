<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
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

	public function index()
	{

		
		$data['session'] = $this->session->userdata();		
		$this->load->view('welcome_message',$data);
	}

	public function table_data()
	{

		$data['all'] = $this->m_data->data($this->session->userdata('usergroup'));		
		$this->load->view('table_data',$data);
	}



	public function history_data()
	{

		$data['all'] = $this->m_data->history($this->session->userdata('usergroup'));		
		$this->load->view('history_data',$data);
	}



	public function history_bank()
	{

		$data['all'] = $this->m_data->data_bank();

		$this->load->view('history_bank',$data);
	}



	public function data_selesai()
	{

		$data['all'] = $this->m_data->data_selesai();

		$this->load->view('data_selesai',$data);
	}


	public function template_sspd($id_bphtb_log)
	{

		$data['all'] = $this->m_data->data_by_id($id_bphtb_log);

		$this->load->view('template_sspd',$data);
	}


	public function konfirm_print_sspd($id_bphtb)
	{

		$data['all'] = $this->m_data->data_by_id($id_bphtb);
		$data['id_bphtb'] = $id_bphtb;
		$this->load->view('konfirm_print_sspd',$data);
	}

	public function print_sspd($id_bphtb)
	{
		$data['all'] = $this->m_data->bphtb_by_id($id_bphtb);
		//$this->load->view('template_sspd_print',$data);


		//var_dump($staff_arr);
		$filename = "sspd_".$this->router->fetch_class()."_".date('d_m_y_h_i_s')."_".$id_bphtb;				
		$pdfFilePath = FCPATH."/downloads/$filename.pdf";
		
		if (file_exists($pdfFilePath) == FALSE)
		{
			//ini_set('memory_limit','512M'); // boost the memory limit if it's low <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
        	ini_set('memory_limit', '2048M');
			//$html = $this->load->view('laporan_mpdf/pdf_report', $data, true); // render the view into HTML
			$html = $this->load->view('template_sspd_print.php',$data,true);
			
			$this->load->library('pdf_potrait'); 
			$pdf = $this->pdf_potrait->load();
			//$this->load->library('pdf');
			//$pdf = $this->pdf->load();

			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date("YmdHis")."_".$this->session->userdata('id_admin')); // Add a footer for good measure <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can

			//update tbl_bphtb print_sspd
			$this->db->query("UPDATE tbl_bphtb SET print_sspd='$filename.pdf' WHERE id_bphtb='$id_bphtb'");
		}
		 
		redirect(base_url()."downloads/$filename.pdf","refresh");
		
	}

	public function template_dokumen($id_bphtb)
	{

		$data['all'] = $this->m_data->dokumen_by_id($id_bphtb);

		$this->load->view('template_dokumen',$data);
	}


	public function template_timeline($id_bphtb)
	{

		$data['all'] = $this->m_data->timeline($id_bphtb);

		$this->load->view('template_timeline',$data);
	}

	
	public function template_verifikasi($id_bphtb)
	{

		$data['all'] = $this->m_data->dokumen_by_id($id_bphtb);
		$data['id_bphtb'] = $id_bphtb;

		$this->load->view('template_verifikasi',$data);
	}



	public function go_verifikasi()
	{

		$go = $this->input->post();
		$go['updated_on'] 	= date("Y-m-d H:i:s");
		$go['userid'] 		= $this->session->userdata('userid');
		$this->db->insert('tbl_bphtb_log',$go);

		if($go['usergrup_tujuan']==6)
		{
			//disini insert ke BANK
			$id_bphtb = $go['id_bphtb'];
			$kode_urut = sprintf('%06d', $go['id_bphtb']);
			$tahun = date('Y');
			$Tgl_STS = date('Y-m-d H:i:s');
			$No_STS = "121240402411121".$kode_urut;


			$tbl_bphtb = $this->m_data->bphtb_by_id($go['id_bphtb']);
			$data = $tbl_bphtb[0];

			$arr = array(
					'id_bphtb' 	=> $go['id_bphtb'],
					'tahun' 	=> $tahun,
					'Tgl_STS' 	=> $Tgl_STS,
					'No_STS' 	=> $No_STS,
					'No_NOP' 	=> $data->nop_pbb,
					'No_Pokok_WP' 	=>  $data->a2,
					'Nama_Pemilik' 	=>  $data->a1,
					'Alamat_Pemilik' 	=>  $data->a3." ".$data->a4." ".$data->a5." ".$this->m_data->nm_kelurahan($data->a6)." ".$this->m_data->nm_kecamatan($data->a7)." ".$this->m_data->nm_dati2($data->a8),
					'Nilai' 	=>  $data->jumlah_setor
					);


			$this->db->insert('STS_History',$arr);			
			var_dump($arr);
		}

	}


	public function notif()
	{
		echo $this->m_data->notif($this->session->userdata('usergroup'));
	}	

	public function notif_bank()
	{
		echo $this->m_data->notif_bank();
	}	

}
