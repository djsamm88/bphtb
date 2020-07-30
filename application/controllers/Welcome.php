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



	public function data_ppat()
	{

		$data['all'] = $this->m_data->all_ppat();		
		$this->load->view('data_ppat',$data);
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



	public function data_print()
	{

		$data['all'] = $this->m_data->data_print();

		$this->load->view('data_print',$data);
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

	public function print_sspd()
	{
		$id_bphtb = $this->input->get('id_bphtb');
		$passprahe = $this->input->get('passprahe');

		$data['all'] = $this->m_data->bphtb_by_id($id_bphtb);
		//$this->load->view('template_sspd_print',$data);
		//die();
		


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

			//$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date("YmdHis")."_".$this->session->userdata('id_admin')); // Add a footer for good measure <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
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

		/******* isen moh passprahe ttd *****/
		$passprahe = $go['passprahe'];
		unset($go['passprahe']);
		
		$this->db->set($go);
		$this->db->insert('tbl_bphtb_log');

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

			if($data->jumlah_setor=="" || $data->jumlah_setor==0)
			{
				$Nilai=0;
			}else{
				$Nilai=$data->jumlah_setor;
			}
			$arr = array(
					'id_bphtb' 	=> $go['id_bphtb'],
					'tahun' 	=> $tahun,
					'Tgl_STS' 	=> $Tgl_STS,
					'No_STS' 	=> $No_STS,
					'No_NOP' 	=> $data->b1,
					'No_Pokok_WP' 	=>  $data->a2,
					'Jn_Pajak'	=> 'BPHTB',
					'Nm_Pajak'	=> 'BPHTB',
					'Mata_Anggaran' => '411121',
					'Nama_Pemilik' 	=>  $data->a1,
					'masa_bayar' => date('Y'),
					'Alamat_Pemilik' 	=>  $data->a3." ".$data->a4." ".$data->a5." ".$this->m_data->nm_kelurahan($data->a8_propinsi,$data->a8,$data->a7,$data->a6)." ".$this->m_data->nm_kecamatan($data->a8_propinsi,$data->a8,$data->a7)." ".$this->m_data->nm_dati2($data->a8_propinsi,$data->a8),
					'Nilai' 	=>  $Nilai
					);




			
			$this->db->set($arr);
			$this->db->insert('STS_History');

			//membuat wajib 
			if($data->jumlah_setor==0 || $data->jumlah_setor=="")
			{
				$id_bphtb=$go['id_bphtb'];
				$this->db->query("UPDATE STS_History SET Status_bayar='1' WHERE id_bphtb='$id_bphtb'");
			}
			


			//kirim email
			//email ppat dan Pengguna;
			$text = "NOP:".$data->b1."<br>  Kode Biling/NO STS = ".$No_STS." <br> Jumlah Setor: Rp.".rupiah($data->jumlah_setor);
			$email_ppat = $this->m_data->data_email_ppat($id_bphtb);
			if($email_ppat!="")
			{
				var_dump(kirim_email($email_ppat,$text));	
			}
			if($data->a_email!="")
			{
				var_dump(kirim_email($data->a_email,$text));		
			}

			//var_dump($arr);
			echo $text."-".$email_ppat."-".$data->a_email;
		}

	}


	public function aktifkan_ppat()
	{
		$nama_lengkap = $this->input->post('nama_lengkap');
		$this->db->query("UPDATE tbl_users SET userstatus='1' WHERE nama_lengkap='$nama_lengkap'");
	}


	public function cek_ppat()
	{
		$NAMA = $this->input->post('NAMA');
		$EMAIL = $this->input->post('EMAIL');
		
		$jsonData = array(
		    'NAMA' => $NAMA,
		    'EMAIL' => $EMAIL,
		    'USERNAME' => 'bapendapakpakbharat',
		    'PASSWORD' => 'a'

		);
		$url = 'http://103.49.37.84:8080/BPNApiService/Api/BPHTB/GetPPAT';
		
		$ch = curl_init($url);		
		$jsonDataEncoded = json_encode($jsonData);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
		$result = curl_exec($ch);

		//echo $url."".$jsonDataEncoded;
		//echo ($result);
	}	

	private function kirim_email($email,$text)
	{
		$url = 'https://sibahanpe.pakpakbharatkab.go.id/PHPMailer/pemberitahuan.php';
		$ch = curl_init($url);
		$jsonData = array(
		    'email' => $email,
		    'text' => $text
		);
		$jsonDataEncoded = json_encode($jsonData);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
		$result = curl_exec($ch);

		return $url."".$jsonDataEncoded;
	}

	public function notif()
	{
		echo $this->m_data->notif($this->session->userdata('usergroup'));
	}	

	public function notif_bank()
	{
		echo $this->m_data->notif_bank();
	}	

	public function notif_print()
	{
		echo $this->m_data->notif_print();
	}	

}
