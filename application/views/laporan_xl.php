<?php 
 function array_pengalihan($b16)
  {
    $arrayName = array(
        'a.1' => 'jual beli', 
        'a.2' => 'tukar menukar', 
        'a.3' => 'hibah', 
        'a.4' => 'hibah wasiat', 
        'a.5' => 'waris', 
        'a.6' => 'pemasukan dalam perseroan atau badan hukum lain', 
        'a.7' => 'pemisahan hak yang mengakibatkan peralihan', 
        'a.8' => 'penunjukan pembeli dalam lelang', 
        'a.9' => 'pelaksanaan putusan hakim yang mempunyai kekuatan hukum tetap', 
        'a.10' => 'penggabungan usaha', 
        'a.11' => 'peleburan usaha', 
        'a.12' => 'pemekaran usaha', 
        'a.13' => 'hadiah', 
        'b.1' => 'kelanjutan pelepasan hak', 
        'b.2' => 'di luar pelepasan hak', 

      );

    return strtoupper($arrayName[$b16]);
  }

?>

<table border="1" cellpadding="0" cellspacing="0" class="table table-bordered">
  <tr>
    <td colspan="20"><center><h1>LAPORAN BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN (BPHTB)</h1></center></td>
  </tr>
  <tr>
    <td colspan="20"><center><h3>Periode <?php echo tglindo($tgl_awal)?> s/d <?php echo tglindo($tgl_akhir)?></h3></center></td>
  </tr>
</table>



<table border="1" cellpadding="0" cellspacing="0" class="table table-bordered">
  <thead>
    <tr>
      <td rowspan="3" style="height:84pt; text-align:center; vertical-align:middle; width:33pt">NO</td>
      <td rowspan="3" style="text-align:center; vertical-align:middle; width:84pt">TANGGAL REGISTER</td>
      <td colspan="3" rowspan="2" style="text-align:center; vertical-align:middle; width:194pt">SERTIFIKAT/AKTA</td>
      <td rowspan="3" style="text-align:center; vertical-align:middle; width:124pt">JENIS PENGALIHAN</td>
      <td colspan="2" rowspan="2" style="text-align:center; vertical-align:middle; width:253pt">PENERIMA PENGALIHAN</td>
      <td colspan="2" rowspan="2" style="text-align:center; vertical-align:middle; width:279pt">MENGALIHKAN</td>
      <td rowspan="3" style="text-align:center; vertical-align:middle; white-space:nowrap; width:124pt">NOP</td>
      <td colspan="6" style="text-align:center; vertical-align:bottom; width:478pt">OBJEK PAJAK BUMI DAN BANGUNAN</td>
      <td rowspan="3" style="text-align:center; vertical-align:middle; width:102pt">NILAI PASAR</td>
      <td colspan="5" rowspan="2" ><center>PEMBAYARAN</center></td>
      <td rowspan="3" style="text-align:center; vertical-align:middle; width:114pt">NAMA PPAT</td>
      <td rowspan="3" style="text-align:center; vertical-align:middle; width:102pt">KETERANGAN</td>
    </tr>
    <tr>
      <td rowspan="2" style="height:66pt; text-align:center; vertical-align:middle; width:108pt">Lokasi Tanah/Bangunan</td>
      <td colspan="2" style="text-align:center; vertical-align:middle; width:126pt">Luas M2</td>
      <td colspan="2" style="text-align:center; vertical-align:middle; width:152pt">NJOP PER M2 (Rp)</td>
      <td rowspan="2" style="text-align:center; vertical-align:middle; width:92pt">TOTAL NJOP</td>
    </tr>
    <tr>
      <td style="height:32.25pt; text-align:center; vertical-align:middle; white-space:nowrap">No</td>
      <td style="text-align:center; vertical-align:middle; white-space:nowrap">Tanggal</td>
      <td style="text-align:center; vertical-align:middle; width:81pt">Jenis Dokumen</td>
      <td style="text-align:center; vertical-align:middle; width:158pt">Nama</td>
      <td style="text-align:center; vertical-align:middle; width:95pt">Alamat</td>
      <td style="text-align:center; vertical-align:middle; width:192pt">Nama</td>
      <td style="text-align:center; vertical-align:middle; width:87pt">Alamat</td>
      <td style="text-align:center; vertical-align:middle; white-space:nowrap">Tanah</td>
      <td style="text-align:center; vertical-align:middle; white-space:nowrap">Bangunan</td>
      <td style="text-align:center; vertical-align:middle; white-space:nowrap">Tanah</td>
      <td style="text-align:center; vertical-align:middle; white-space:nowrap">Bangunan</td>
      <td style="text-align:center; vertical-align:middle; width:84pt">Penetapan BPHTB</td>
      <td style="text-align:center; vertical-align:middle; width:84pt">Bank</td>
      <td style="text-align:center; vertical-align:middle; width:91pt">Tanggal</td>
      <td style="text-align:center; vertical-align:middle; width:81pt">Jumlah</td>
      <td style="text-align:center; vertical-align:middle; width:56pt">Ket</td>
    </tr>
    
  </thead>
    <tbody>
    <?php 
    $no=0;
    foreach ($all as $key) {
      $no++;    
    ?>
    <tr>
      <td style="height:48pt; text-align:center; vertical-align:middle; white-space:nowrap"><?php echo $no?></td>
      <td style="text-align:center; vertical-align:middle; white-space:nowrap"><?php echo tglindo($key->created_on)?></td>
      <td style="text-align:center; vertical-align:middle; white-space:nowrap"><?php echo $key->b17?></td>
      <td style="text-align:center; vertical-align:middle; white-space:nowrap"><?php echo tglindo($key->updated_on)?></td>
      <td style="vertical-align:middle; white-space:nowrap">Sertifikat</td>
      <td style="vertical-align:middle; white-space:nowrap"><?php echo $key->b16." - ".array_pengalihan($key->b16)?></td>
      <td style="vertical-align:middle; width:158pt"><?php echo $key->a1?></td>
      <td style="vertical-align:middle; white-space:nowrap">
        <?php echo $key->a3?> 
        <?php echo @$this->m_data->nm_kelurahan($key->a8_propinsi,$key->a8,$key->a7,$key->a6)?> 
        <?php echo @$this->m_data->nm_kecamatan($key->a8_propinsi,$key->a8,$key->a7)?> 
        <?php echo @$this->m_data->nm_dati2($key->a8_propinsi,$key->a8)?>          
      </td>
      <td style="vertical-align:middle; width:192pt"><?php echo $key->p3?></td>
      <td style="vertical-align:middle; width:87pt">
        <?php echo $key->p4?> 
        <?php echo $key->p5?> 
        <?php echo $key->p6?> 
        <?php echo @$this->m_data->nm_kelurahan($key->p9_propinsi,$key->p9,$key->p8,$key->p7)?> 
        <?php echo @$this->m_data->nm_kecamatan($key->p9_propinsi,$key->p9,$key->p8)?> 
        <?php echo @$this->m_data->nm_dati2($key->p9_propinsi,$key->p9)?>       
      </td>
      <td style="vertical-align:middle; width:124pt"><?php echo $key->No_NOP?> &nbsp;</td>
      <td style="vertical-align:middle; width:108pt"><?php echo $key->b2?></td>
      <td style="text-align:center; vertical-align:middle; white-space:nowrap"><?php echo $key->b8?></td>
      <td style="text-align:center; vertical-align:middle; white-space:nowrap"><?php echo $key->b9?></td>
      <td style="text-align:right; vertical-align:middle; white-space:nowrap"><?php echo rupiah($key->b10)?></td>
      <td style="text-align:right; vertical-align:middle; white-space:nowrap"><?php echo rupiah($key->b11)?></td>
      <td style="text-align:right; vertical-align:middle; white-space:nowrap"><?php echo rupiah($key->b14)?></td>
      <td style="text-align:right; vertical-align:middle; white-space:nowrap"><?php echo rupiah($key->b15)?></td>
      <td style="text-align:right; vertical-align:middle; white-space:nowrap"><?php echo tglindo($key->Tgl_STS)?></td>
      <td style="text-align:right; vertical-align:middle; white-space:nowrap">SUMUT</td>
      <td style="text-align:center; vertical-align:middle; white-space:nowrap"><?php echo tglindo($key->Tgl_Bayar)?></td>
      <td style="text-align:right; vertical-align:middle; white-space:nowrap"><?php echo rupiah($key->Nilai)?></td>
      <td style="text-align:center; vertical-align:middle; white-space:nowrap"><?php echo ($key->Kode_Pengesahan)?></td>
      <td style="vertical-align:middle; width:114pt"> <?php echo @$this->m_data->penanda_tangan($key->id_bphtb,1)[0]->nama_lengkap?></td>
      <td style="vertical-align:middle; width:102pt"> Update <?php echo ($key->updated_on)?></td>
    </tr>

    <?php 
    }
    ?>
  </tbody>
</table>
