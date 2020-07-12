<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function kirim_email($email,$text)
  {
    $url = 'https://sibahanpe.pakpakbharatkab.go.id/PHPMailer/pemberitahuan.php';   
    $jsonData = array(
        'email' => $email,
        'text' => $text
    );
    $jsonnya = json_encode($jsonData);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_FAILONERROR, 0);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$jsonnya);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

    $returned =  curl_exec($ch);
    return(json_decode($returned));
  }



function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }
 
  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }         
    return strtoupper($hasil);
  }
 


function userstatus(){
  $data = array(
    1 => 'Aktif', 
    2 => 'Pending', 
    3 => 'Blokir', 
  );
  return $data;
}

function bphtb_syarat_pendaftaran(){
  $data = array(
    1 => 'Aktif', 
    2 => 'Pending', 
    3 => 'Blokir', 
  );
  return $data;
}

function bphtb_status_validasi(){
  $data = array(
    1 => 'Aktif', 
    2 => 'Pending', 
    3 => 'Blokir', 
  );
  return $data;
}


function usergroup(){
  $data = array(
    1 => 'PPAT', 
    2 => 'BPKPAD Staf', 
    3 => 'BPKPAD Eselon IV', 
    4 => 'BPKPAD Eselon III', 
    5 => 'BPKPAD Eselon II', 
    6 => 'BANK', 
    7 => 'BPN', 
  );
  return $data;
}

function dokumen_persyaratan(){
  $data = array(
    1 => 'Denah atau peta lokasi',
    2 => 'Foto objek pajak',
    3 => 'Scan KTP Asli',
    4 => 'Surat Kuasa dari Wajib Pajak (Dalam hal dikuasakan)',
    5 => 'Scan SPPT PBB tahun berjalan',
    6 => 'Scan Kartu Keluarga/ Surat Keterangan hubungan keluarga (dalam hal transaksi waris)',
    7 => 'Scan KTP Asli penerima kuasa',
    8 => 'Scan bukti transaksi /kwitansi',
    9 => 'Surat bukti kepemilikan Tanah/ Bangunan ',
    10 => 'Akta Jual Beli',
    11 => 'Surat permohonan penerbitan SSPD BPHTB',
    11 => 'Dokumen Pengajuan Lainnya'
  );
  return $data;
}


function pemindahan_hak_karena(){
  $data = array(
    1 => 'a.1) jual beli',
    2 => 'a.2) tukar menukar',
    3 => 'a.3) hibah',
    4 => 'a.4) hibah wasiat',
    5 => 'a.5) waris',
    6 => 'a.6) pemasukan dalam perseroan atau badan hukum lain',
    7 => 'a.7) pemisahan hak yang mengakibatkan peralihan',
    8 => 'a.8) penunjukan pembeli dalam lelang',
    9 => 'a.9) pelaksanaan putusan hakim yang mempunyai kekuatan hukum tetap',
    10 => 'a.10) penggabungan usaha',
    11 => 'a.11) peleburan usaha',
    12 => 'a.12) pemekaran usaha atau',
    13 => 'a.13) hadiah.',
    14 => 'b. pemberian hak baru karena:',
    15 => 'b.1) kelanjutan pelepasan hak atau',
    16 => 'b.2) di luar pelepasan hak',
  );
  return $data;
}

function datalog($aksi_akses,$keterangan){
  $userid = @$_SESSION['arrayLogin']['userid'];
  $useremail = @$_SESSION['arrayLogin']['useremail'];
  $ur = $_SERVER['REQUEST_URI'];
  $uri = explode('apps', $ur);
  $data = array(
    'useremail' => $userid."_".$useremail,
    'accessIP' => getenv("REMOTE_ADDR"),
    'accessTime' => time(),
            'accessUrl' => $ur,//substr($uri[1],0,50),
            'accessAction' => $aksi_akses,
            'accessDescription' => $keterangan
        );
  return $data;
}


function umur($tanggal)
{
	$today = new DateTime();
	$birthdate = new DateTime($tanggal);
	$interval = $today->diff($birthdate);
	return $interval->format('%y years');
}


function upload_file($name_field){
    $sourcePath = $_FILES[$name_field]['tmp_name'];
    $path = $_FILES[$name_field]['name'];
    $fileType = $_FILES[$name_field]["type"];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    if($ext=="jpg" || $ext=="jpeg" || $ext=="png" || $ext=="pdf" || $ext=="doc" || $ext=="docx" || $ext=="JPG" || $ext=="JPEG" || $ext=="PNG" || $ext=="PDF" || $ext=="DOC" || $ext=="DOCX"){
        $fName = time();
       // $fName = $name_field."_".time();
        $fileName = $fName.'.'.$ext;
        $targetPath = "uploads/".$fileName;
        move_uploaded_file($sourcePath,$targetPath);
        if($sourcePath!=""){
            return $fileName;
        }else{
            return "";
        }
    }else{
        return "";
    }
}

function level($int)
{
	$a = array(
			'1' => "Admin", 
			'2' => "Keuangan", 
			'3' => "Kasir", 
      '4' => "Gudang", 
			'5' => "Member" 
			);
	return $a[$int];
}

if ( ! function_exists('hanya_nomor'))
{
	function hanya_nomor($string) 
	{
		$string = str_replace(" ", "", $string);
		$string = str_replace(".", "", $string);
		return $string;
	}
}

function rupiah($nilai, $pecahan = 0) 
{
    return number_format($nilai, $pecahan, ',', '.');
}

function buang_spasi($string)
{
	$string = preg_replace('/\s+/', '', $string);
	return $string;
}


function tglindo($tanggal)
{
$taketgl = substr($tanggal, 0,10);
$tahun = substr($taketgl, 0,4);
$bulan = substr($taketgl, 5,2);
$tanggal = substr($taketgl, 8,2);

$tgl = $tanggal."-".$bulan."-".$tahun;

return $tgl;
}

function tanggalindo($tanggal)
{
$taketgl = substr($tanggal, 0,10);
$tahun = substr($taketgl, 0,4);
$bulan = substr($taketgl, 5,2);
$tanggal = substr($taketgl, 8,2);

if($bulan=="01") $bulan = "Januari";
if($bulan=="02") $bulan = "Februari";
if($bulan=="03") $bulan = "Maret";
if($bulan=="04") $bulan = "April";
if($bulan=="05") $bulan = "Mei";
if($bulan=="06") $bulan = "Juni";
if($bulan=="07") $bulan = "Juli";
if($bulan=="08") $bulan = "Agustus";
if($bulan=="09") $bulan = "September";
if($bulan=="10") $bulan = "Oktober";
if($bulan=="11") $bulan = "Novembe";
if($bulan=="12") $bulan = "Desember";

$tgl = $tanggal." ".$bulan." ".$tahun;

return $tgl;
}


function bulantahunromawi($tanggal)
{
$taketgl = substr($tanggal, 0,10);
$tahun = substr($taketgl, 0,4);
$bulan = substr($taketgl, 5,2);
$tanggal = substr($taketgl, 8,2);

if($bulan=="01") $bulan = "I";
if($bulan=="02") $bulan = "II";
if($bulan=="03") $bulan = "III";
if($bulan=="04") $bulan = "IV";
if($bulan=="05") $bulan = "V";
if($bulan=="06") $bulan = "VI";
if($bulan=="07") $bulan = "VII";
if($bulan=="08") $bulan = "VIII";
if($bulan=="09") $bulan = "IX";
if($bulan=="10") $bulan = "X";
if($bulan=="11") $bulan = "XI";
if($bulan=="12") $bulan = "XII";

$tgl = $bulan."/".$tahun;

return $tgl;
}



function bulantahunindo($bulan)
{
	
$taketgl = substr($bulan, 0,10);
$tahun = substr($taketgl, 0,4);
$bulan = substr($taketgl, 5,2);
$tanggal = substr($taketgl, 8,2);
	
if($bulan=="01") $bulan = "Jan";
if($bulan=="02") $bulan = "Feb";
if($bulan=="03") $bulan = "Mar";
if($bulan=="04") $bulan = "Apr";
if($bulan=="05") $bulan = "Mei";
if($bulan=="06") $bulan = "Jun";
if($bulan=="07") $bulan = "Jul";
if($bulan=="08") $bulan = "Agu";
if($bulan=="09") $bulan = "Sep";
if($bulan=="10") $bulan = "Okt";
if($bulan=="11") $bulan = "Nov";
if($bulan=="12") $bulan = "Des";
return $bulan." ".$tahun;
}



function tahunindo($bulan)
{
	
$taketgl = substr($bulan, 0,10);
$tahun = substr($taketgl, 0,4);
$bulan = substr($taketgl, 5,2);
$tanggal = substr($taketgl, 8,2);
	
if($bulan=="01") $bulan = "Jan";
if($bulan=="02") $bulan = "Feb";
if($bulan=="03") $bulan = "Mar";
if($bulan=="04") $bulan = "Apr";
if($bulan=="05") $bulan = "Mei";
if($bulan=="06") $bulan = "Jun";
if($bulan=="07") $bulan = "Jul";
if($bulan=="08") $bulan = "Agu";
if($bulan=="09") $bulan = "Sep";
if($bulan=="10") $bulan = "Okt";
if($bulan=="11") $bulan = "Nov";
if($bulan=="12") $bulan = "Des";
return $tahun;
}



function bulanindo($bulan)
{	
if($bulan=="01") $bulan = "Januari";
if($bulan=="02") $bulan = "Februari";
if($bulan=="03") $bulan = "Maret";
if($bulan=="04") $bulan = "April";
if($bulan=="05") $bulan = "Mei";
if($bulan=="06") $bulan = "Juni";
if($bulan=="07") $bulan = "Juli";
if($bulan=="08") $bulan = "Agustus";
if($bulan=="09") $bulan = "September";
if($bulan=="10") $bulan = "Oktober";
if($bulan=="11") $bulan = "November";
if($bulan=="12") $bulan = "Desember";
return $bulan;
}

function curl_file_exist($url){
    $ch = curl_init($url);    
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($code == 200){
       $status = true;
    }else{
      $status = false;
    }
    curl_close($ch);
   return $status;
}


function buang_single_quote($string)
{
	return (str_replace("'","`",$string));
}



function ambil_thumbs($url)
{		
	if(strpos($url, 'user_image') !== false) {
	 	$url_images = explode("user_image",$url);
		$get_images = str_replace("/images/","user_image/_thumbs/Images/",$url_images[1]);	
			
		return $url_images[0].$get_images;
	} else {
		return $url;
	}

}



function buat_link($text)
{ 
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  $text = trim($text, '-');
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = strtolower($text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  if (empty($text))
  {
    return 'n-a';
  }
  return $text;
}

function randomnya($length = 10) 
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) 
	{
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


function dapat_gambar($semua)
{				
		$frst_image = preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', $semua, $matches );
		
		if(@$matches[ 1 ][ 0 ]){					
			return @$matches[ 1 ][ 0 ];
			
		}else{
			return "https://humbanghasundutankab.go.id/user_image/images/logo/logo_hum.png";
		}
		
	
}


function buat_desc($isi,$panjang=300)
{
	$out = substr(strip_tags($isi),0,$panjang).'...';
	return preg_replace('!\s+!', ' ', $out);
}
