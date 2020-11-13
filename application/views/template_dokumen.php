<?php 

$arr_db = array();
$arr_dokumen = array();
foreach ($all as $a) {
  echo dokumen_persyaratan()[$a->id_dokumen_persyaratan]."<br>";
  $arr_db[$a->id_dokumen_persyaratan] = dokumen_persyaratan()[$a->id_dokumen_persyaratan];
  $arr_dokumen[$a->id_dokumen_persyaratan] = $a->file_dokumen;
}

$result=array_intersect(dokumen_persyaratan(),$arr_db);
//print_r($result);


$ab=array_diff(dokumen_persyaratan(),$arr_db);
//print_r($ab);



?>

<table class="table">
  <thead>
    <th>Id</th>
    <th>Dokumen</th>
    <th>Ket.</th>
    <th>Source</th>
  </thead>
      <?php
        foreach ($result as $x=>$y) {
          echo "
            <tr class='success'>
              <td>$x</td>
              <td>$y</td>

              <td>&#10003;</td>
              <td><a href='https://bphtb.pakpakbharatkab.go.id/uploads/".$arr_dokumen[$x]."' target='blank'>".$arr_dokumen[$x]."</td>
            </tr>
          ";
        }
      ?>
       <?php
        foreach ($ab as $x=>$y) {
          echo "
            <tr class='danger'>
              <td>$x</td>
              <td>$y</td>

              <td>x</td>
              <td>x</td>
            </tr>
          ";
        }
      ?>
  
</table>