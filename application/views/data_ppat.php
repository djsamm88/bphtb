
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
              <th>userid</th>           
              <th>Nama</th>           
              <th>Email</th>                     
              <th>Status</th>                     
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
          $btn = "";
          
          if($x->userstatus=='1')
          {
           $btn.="Aktif"; 
          }else{
            $btn .= "<button class='btn btn-primary btn-xs btn-block' onclick='aktifkan(\"$x->nama_lengkap\");return false;'>Cek BPN</button>";
          }
          


          $no++;

            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->userid</td>
                <td>$x->nama_lengkap</td>                
                <td>$x->useremail</td>                                                            
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
        <h4 class="modal-title">Cek PPAT</h4>
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
function aktifkan(nama_lengkap)
{  
    $.post("<?php echo base_url()?>index.php/welcome/cek_ppat",{NAMA:nama_lengkap},function(e){
        var obj = JSON.parse(e);        
        console.log(obj.result);
        //console.log(e);
        console.log(obj.result.length);
        var content="";
        if(obj.result.length>0)
        {
          content+="<div class='alert alert-success'><b>"+obj.result[0].NAMA+" Terdaftar di BPN dengan NOID:"+obj.result[0].NOID+"</div><button class='btn btn-primary' onclick='aktifkan_btn(\""+nama_lengkap+"\")'>Aktifkan</button>";
        }else{
          content+="<div class='alert alert-danger'><b>"+nama_lengkap+" Tidak Terdaftar di Server BPN </div>";
        }

        $("#t4_detail").html(content);
        
        $("#myModal_data").modal('show');
    });
}

function aktifkan_btn(nama_lengkap)
{
  console.log(nama_lengkap);
  $.post("<?php echo base_url()?>index.php/welcome/aktifkan_ppat",{nama_lengkap:nama_lengkap},function(e){
      var content ="<div class='alert alert-success'><b>"+nama_lengkap+" Berhasil di aktifkan. </div>";
      $("#t4_detail").html(content);
  });
}


$("#myModal_data").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/welcome/data_ppat','PPAT');
});

$(document).ready(function(){

  $('#tbl_datanya').dataTable();

});
$("#judul2").html("DataTable "+document.title);
</script>
