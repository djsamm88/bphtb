<?php 
//var_dump($all);
$data = $all[0];

  ?>
<style type="text/css">
  .semua{
    padding: 10px;
    
  }
  .row>div{
    font-size: 12px;
  }
  table,thead,td{
   font-size: 12px; 
  }
  .clear{
    border-bottom:1px dotted #aaa;
  }
  .glyphicon{
  border: 1px solid;
  color: #777;
}
</style>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="<?php echo base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">

<div class="semua">


<div>A.</div>
<div class="row">
  
  <div class="col-xs-2">
    1. Nama Wajib Pajak
  </div>
  <div class="col-xs-10">
    : <?php echo $data->a1?>
  </div>
  <div style="clear: both;" class="clear"></div>

  <div class="col-xs-2">
    2. NPWP
  </div>
  <div class="col-xs-10">
    : <?php echo $data->a2?>
  </div>
  <div style="clear: both;" class="clear"></div>

  <div class="col-xs-2">
    3. Alamat Wajib Pajak
  </div>
  <div class="col-xs-2">
    : <?php echo $data->a3?>
  </div>
  <div class="col-xs-2">
    4. RT/RW
  </div>
  <div class="col-xs-2">
    : <?php echo $data->a4?>
  </div>
  <div class="col-xs-2">
    5. Dusun
  </div>
  <div class="col-xs-2">
    : <?php echo $data->a5?>
  </div>
  <div style="clear: both;" class="clear"></div>


  <div class="col-xs-2">
    6. Desa/Kelurahan
  </div>
  <div class="col-xs-10">
    : <?php echo @$this->m_data->nm_kelurahan($data->a8_propinsi,$data->a8,$data->a7,$data->a6)?>
  </div>
<div style="clear: both;" class="clear"></div>

  <div class="col-xs-2">
    7. Kecamatan
  </div>
  <div class="col-xs-2">
    : <?php echo @$this->m_data->nm_kecamatan($data->a8_propinsi,$data->a8,$data->a7)?>
  </div>

  <div class="col-xs-2">
    8. Kabupaten/Kota
  </div>
  <div class="col-xs-2">
    : <?php echo @$this->m_data->nm_dati2($data->a8_propinsi,$data->a8)?>
  </div>

  <div class="col-xs-2">
    9. Kode Pos
  </div>
  <div class="col-xs-2">
    : <?php echo ($data->a9)?>
  </div>

  <div style="clear: both;" class="clear"></div>

</div>



<br>
<div>B.</div>
<div class="row">
  
  <div class="col-xs-3">
    1. Nomor Objek Pajak (NOP) PBB
  </div>
  <div class="col-xs-9">
    : <?php echo $data->b1?>
  </div>
  <div style="clear: both;" class="clear"></div>

  <div class="col-xs-3">
    2. Letak tanah dan atau bangunan:
  </div>
  <div class="col-xs-9">
    : <?php echo $data->b2?>
  </div>
  <div style="clear: both;" class="clear"></div>

  <div class="col-xs-2">
    3. Desa/Kelurahan
  </div>
  <div class="col-xs-2">
    : <?php echo @$this->m_data->nm_kelurahan_lama($data->b3)?>
  </div>
  <div class="col-xs-2">
    4. RT/RW
  </div>
  <div class="col-xs-2">
    : <?php echo $data->b4?>
  </div>
  <div class="col-xs-2">
    5. Dusun
  </div>
  <div class="col-xs-2">
    : <?php echo $data->b5?>
  </div>
  <div style="clear: both;" class="clear"></div>


  <div class="col-xs-2">
    6. Kecamatan
  </div>
  <div class="col-xs-2">
    : <?php echo @$this->m_data->nm_kecamatan_lama($data->b6)?>
  </div>

  <div class="col-xs-2">
    7. Kabupaten/Kota
  </div>
  <div class="col-xs-2">
    : <?php echo @$this->m_data->nm_dati2_lama($data->b7)?>
  </div>

  <div style="clear: both;" class="clear"></div>

  <br>
  <div class="col-sm-12">
    Penghitungan NJOP PBB:
  </div>
  <table class="table table-bordered">
    <thead>
      <th>Uraian</th>
      <th>Luas </th>
      <th>NJOP PBB / m2</th>
      <th>Luas x NJOP PBB / m2</th>
    </thead>
    <tbody>
      <tr>
        <td>Tanah ( bumi )</td>
        <td><?php echo $data->b8?> m<sup>2</sup></td>
        <td style="text-align:right">Rp.<?php echo rupiah($data->b10)?></td>
        <td style="text-align:right">Rp.<?php echo rupiah($data->b12)?></td>        
      </tr>

      <tr>
        <td>Bangunan</td>
        <td><?php echo $data->b9?> m<sup>2</sup></td>
        <td style="text-align:right">Rp.<?php echo rupiah($data->b11)?></td>
        <td style="text-align:right">Rp.<?php echo rupiah($data->b13)?></td>        
      </tr>
      <tr>        
        <td colspan="3"></td>
        <td style="text-align:right">Rp.<?php echo rupiah($data->b14)?></td>        
      </tr>
      <tr>
        <td>16.Jenis perolehan hak atas tanah dan atau bangunan</td>
        <td><?php echo $data->b16?></td>
        <td>15.Harga transaksi / Nilai pasar:</td>
        <td style="text-align:right">Rp.<?php echo rupiah($data->b15)?></td>        
      </tr>
    </tbody>
  </table>


 <div class="col-xs-3">
    17. Nomor Sertifikat :
  </div>
  <div class="col-xs-9">
    : <?php echo $data->b17?>
  </div>
  <div style="clear: both;" class="clear"></div>

</div>



<br>
<div>C.PENGHITUNGAN BPHTB ( Hanya diisi berdasarkan penghitungan Wajib Pajak )</div>

<table class="table table-bordered">
    
    <tbody>
      <tr>
        <td>1</td>
        <td>Nilai Perolehan Objek Pajak ( NPOP )   memperhatikan nilai pada kolom 14 dan 15</td>
        <td style="text-align:right">Rp.<?php echo rupiah($data->c1)?></td>
        
      </tr>

      <tr>
        <td>2</td>
        <td>Nilai Perolehan Objek Pajak Tidak Kena Pajak ( NPOPTKP )</td>
        <td style="text-align:right">Rp.<?php echo rupiah($data->c2)?></td>
        
      </tr>
      
      <tr>
        <td>4</td>
        <td>Nilai Perolehan Objek Pajak Kena Pajak ( NPOPKP )</td>        
        <td style="text-align:right">Rp.<?php echo rupiah($data->c3)?></td>        
      </tr>
      <tr>
        <td>4</td>
        <td>Bea Perolehan Hak atas Tanah dan Bangunan yang terutang</td>        
        <td style="text-align:right">Rp.<?php echo rupiah($data->c4)?></td>        
      </tr>
    </tbody>
  </table>





<br>
<div>D. Jumlah Setoran berdasarkan</div>


  <table class="table table-bordered">
    <tbody>
      <?php
      $da_str="a. Penghitungan Wajib Pajak";
      $db_str="b. STPD BPHTB/SKPDKB KURANG BAYAR/SKPDB<br>KURANG BAYAR TAMBAHA";
      $dc_str="c. Pengurangan dihitung sendiri Menjadi:";
      $dd_str="d. ";
      ccc('a',$da_str,$data->d_radio,$data->d_radio_persen,$data->d_radio_hukum,$data->jumlah_setor);
      ccc('b',$db_str,$data->d_radio,$data->d_radio_persen,$data->d_radio_hukum,$data->jumlah_setor);
      ccc('c',$dc_str,$data->d_radio,$data->d_radio_persen,$data->d_radio_hukum,$data->jumlah_setor);
      ccc('d',$dd_str,$data->d_radio,$data->d_radio_persen,$data->d_radio_hukum,$data->jumlah_setor);
      ?>
    </tbody>
  </table>
  <?php
  function ccc($cek,$str,$d_radio,$d_radio_persen,$d_radio_hukum,$jumlah_setor){
    if($cek==$d_radio){
      ?>
      <tr>
        <td>
          <b>&#10003;</b>
        </td>
        <td>
          <?php echo $str?>
        </td>
        <td width="150" style="text-align:right">
          <?php 
          if($d_radio=="c"){
            echo rupiah($d_radio_persen)."%";
            echo " Rp.".rupiah($jumlah_setor);
          }else{
            echo "Rp.".rupiah($jumlah_setor);
          }
          ?>
        </td>
        <td width="50%">
          <u>Dasar Hukum : <?php echo $d_radio_hukum?></u>
        </td>
      </tr>
      <?php
    }else{
      ?>
      <tr>
        <td>
          <i class="glyphicon">&nbsp;</i>
        </td>
        <td>
          <?php echo $str?>
        </td>
        <td></td>
        <td width="50%">
        </td>
      </tr>
      <?php
    }
  }
  ?>



<table class="table table-bordered">
    
    <tbody>
      
      <tr>
        <td width="30%">
         JUMLAH YANG DISETOR (Dengan angka)<br>
         Rp.<?php 
                  if($data->jumlah_setor=='NIHIL')
                  {
                    echo "NIHIL";
                  }else{
                    echo rupiah($data->jumlah_setor);  
                  }
                  
          ?>

        </td>
        <td width="70%">
         Dengan Huruf:<br>
         <b><i>
          <?php          
                if($data->jumlah_setor=='NIHIL')
                  {
                    echo "NIHIL";
                  }else{
                    echo terbilang($data->jumlah_setor);
                  }
         ?>
           
         </i></b>

        </td>
      </tr>
    </tbody>
  </table>





<style type="text/css">
    small{
      font-size: 10px;
    }
    small.border-top{
      border-top: 1px solid #888;
    }
  </style>
  <table class="table" style="text-align: center;">
    <tbody>
      <tr>
        <td width="25%" height="100">
          <small style="float: left;">Tanggal</small><br>
          WAJIB PAJAK /PENYETOR
        </td>
        <td width="25%">
          MENGETAHUI:<br>
          PPAT / NOTARIS /
        </td>
        <td width="25%">
          DITERIMA OLEH:<br>
          TEMPAT PEMBAYARAN BPHTB<br>
          <small>Tanggal</small>
        </td>
        <td width="25%">
          TELAH DIVERIFIKASI<br> 
          BADAN PENGELOLA KEUANGAN PENDAPATAN DAN ASET DAERAH
        </td>
      </tr>
      <tr>
        <td>
          <small class="border-top">Nama lengkap, stempel, dan tanda tangan</small>
        </td>
        <td>
          <small class="border-top">Nama lengkap, stempel, dan tanda tangan</small>
        </td>
        <td>
          <small class="border-top">Nama lengkap, stempel, dan tanda tangan</small>
        </td>
        <td>
          <small class="border-top">Nama lengkap dan tanda tangan</small>
        </td>
      </tr>
    </tbody>
  </table>

</div>