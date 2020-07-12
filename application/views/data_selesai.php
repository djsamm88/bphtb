
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
<div class="table-responsive">              
<table id="tbl_datanya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
              <th>Id Bphtb</th>           
              <th>Nama</th>           
              <th>NPWP</th>                                   
              <th>NOP</th>                     
              <th>NO STS</th>  
              <th>Status Bayar</th>                                 
              <th>Kode Pengesahan</th>                                 
              <th>Kode Cab</th>                                 
              <th>Nama Channel</th>                     
              <th>Kode Terminal</th>                     
              <th>Action</th>                     
              <th>Print</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
         
          $no++;
            
           $btn = "<button class='btn btn-warning btn-xs btn-block' onclick='view($x->id_bphtb_log);return false;'>Detail</button>
                  <button class='btn btn-danger btn-xs btn-block' onclick='berkas($x->id_bphtb);return false;'>Berkas</button>    ";
          $btn .= "<button class='btn btn-primary btn-xs btn-block' onclick='timeline($x->id_bphtb);return false;'>TimeLine</button>"; 

          

          if($x->Status_Bayar==1)
          {
            $url_print = base_url()."downloads/".$x->print_sspd;
            $print_sspd = "<a class='btn btn-success btn-xs btn-block' href='$url_print' target='blank'>PRINT ULANG SSPD</button>";
            $Status_Bayar = "<b><font color=green>Lunas</font></b>";
          }else{
            $print_sspd = "-";
            $Status_Bayar = "<b><font color=red>Belum Lunas</font></b>";
          }

            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->id_bphtb</td>
                <td>$x->a1</td>                
                <td>$x->a2</td>                                   
                <td>$x->b1</td>                                
                <td>$x->No_STS</td>                                
                <td>$Status_Bayar</td>                                
                <td>$x->Kode_Pengesahan</td>                                                
                <td>$x->Kode_Cab</td>                                                
                <td>$x->Nama_Channel</td>                                                
                <td>$x->kode_terminal</td>                                                
                
                <td>$print_sspd</td>
                <td>$btn</td>

              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>
</div>


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
<div id="myModal" class="modal fade" role="dialog">
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
      $("#myModal").modal('show');
  })
}

function berkas(id_bphtb)
{
  $.get("<?php echo base_url()?>index.php/welcome/template_dokumen/"+id_bphtb,function(e){
      $("#t4_detail").html(e);
      $("#myModal").modal('show');
  })
}


function timeline(id_bphtb)
{
  $.get("<?php echo base_url()?>index.php/welcome/template_timeline/"+id_bphtb,function(e){
      $("#t4_detail").html(e);
      $("#myModal").modal('show');
  })
}




$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/welcome/data_selesai','Selesai');
});

$(document).ready(function(){

  $('#tbl_datanya').dataTable();

});
$("#judul2").html("DataTable "+document.title);
</script>
