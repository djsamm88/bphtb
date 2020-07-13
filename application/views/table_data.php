
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        Selamat datang di Sistem Informasi 
        
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content container-fluid" >

      <!--------------------------
        | Your Page Content Here |
        -------------------------->    
<!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title" id="judul2"></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
              
<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
              <th>Id Bphtb</th>           
              <th>Nama</th>           
              <th>NPWP</th>                     
              <th>ALAMAT</th>                     
              <th>NOP</th>                     
              <th>Dari</th>  
              <th>Catatan</th>                                 
              <th>Status</th>                                 
              <th>Update</th>                                 
              <th>Action</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
          $btn = "<button class='btn btn-warning btn-xs btn-block' onclick='view($x->id_bphtb_log);return false;'>Detail</button>
                  <button class='btn btn-danger btn-xs btn-block' onclick='berkas($x->id_bphtb);return false;'>Berkas</button>    ";
          $btn .= "<button class='btn btn-primary btn-xs btn-block' onclick='verifikasi($x->id_bphtb);return false;'>Verifikasi</button>";
          $no++;

          $dari = usergroup()[$x->usergrup_sumber];
            
            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->id_bphtb</td>
                <td>$x->a1</td>                
                <td>$x->a2</td>                
                <td>$x->a3 - $x->a4 - $x->a5 - ".$this->m_data->nm_kelurahan($x->a6)." - ".$this->m_data->nm_kecamatan($x->a7)." </td>                
                <td>$x->b1</td>                
                <td>$dari</td>                                
                <td><font color=blue><b>$x->catatan</b></font></td>                                                     
                <td>$x->status</td>                                
                <td>$x->updated_on</td>                                
                <td>
                  $btn
                </td>
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>


        </div>
        
      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->



<style type="text/css">
 @media (min-width: 768px) {
  .modal-xl {
    width: 90% !important;
   max-width:1200px !important;
  }
}
</style>
<!-- Modal -->
<div id="myModal_data" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xl">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Data</h4>
      </div>
      <div class="modal-body">
          <div id="t4_detail"
          <div style="clear: both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>
console.log("<?php echo $this->router->fetch_class();?>");
var classnya = "<?php echo $this->router->fetch_class();?>";


hanya_nomor(".nomor");
function view(id_bphtb_log)
{
  $.get("<?php echo base_url()?>index.php/welcome/template_sspd/"+id_bphtb_log,function(e){
      $("#t4_detail").html(e);
      $("#myModal_data").modal('show');
  })
}

function berkas(id_bphtb)
{
  $.get("<?php echo base_url()?>index.php/welcome/template_dokumen/"+id_bphtb,function(e){
      $("#t4_detail").html(e);
      $("#myModal_data").modal('show');
  })
}


function verifikasi(id_bphtb)
{
  $.get("<?php echo base_url()?>index.php/welcome/template_verifikasi/"+id_bphtb,function(e){
      $("#t4_detail").html(e);
      $("#myModal_data").modal('show');
  });
  close_reload();
}


function close_reload()
{

  $("#myModal_data").on("hidden.bs.modal", function () {
    eksekusi_controller('<?php echo base_url()?>index.php/welcome/table_data','Verifikasi');
  });
}

$(document).ready(function(){

  $('#tbl_datanya').dataTable();

});
$("#judul2").html("DataTable "+document.title);
</script>
