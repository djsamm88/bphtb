<?php 
$usergroup = $this->session->userdata("usergroup");

if($usergroup!=5)
{
  $lanjut_ke = "Lanjut ke ".usergroup()[$usergroup+1];  
}

if($usergroup==5)
{
 $lanjut_ke = "Konfirmasi Create Biling"; 
}

$kembalikan_ke = "Kembalikan ke ".usergroup()[$usergroup-1];


?>
<b>Form Verifikasi</b>
<form id="go_verifikasi">
  <input type="text" name="id_bphtb" id="id_bphtb" class="form-control" readonly value="<?php echo $id_bphtb?>">
  <textarea class="form-control" name="catatan" id="catatan" placeholder="Catatan" required></textarea><br>

  
  <div class="row">
  <div class="col-xs-6">
    <button class="btn btn-danger" id="btn_tolak">&larr; <?php echo $kembalikan_ke?> </button>
</div>
<div class="col-xs-6 text-right">
  <button class="btn btn-success" id="btn_lanjut" ><?php echo $lanjut_ke?> &rarr;</button>
  </div>
</div>
<div style="clear: both;"></div>
</form>


<script type="text/javascript">
  $("#btn_tolak").on("click",function(){
    var txt = $(this).text();
    var catatan = $("#catatan").val();
    var id_bphtb = $("#id_bphtb").val();
    var usergrup_sumber = "<?php echo $usergroup?>";
    var usergrup_tujuan = "<?php echo $usergroup-1?>";
    
    if(confirm("Anda yakin "+txt+" ?"))
    {
      if($("#catatan").val()=="")
      {
        $("#catatan").focus();
        alert("Catatan wajib isi!");
      }else{
        $("#go_verifikasi").html("<div class='alert alert-warning'>Loading...</div>");
        var ser = {catatan:catatan,id_bphtb:id_bphtb,usergrup_sumber:usergrup_sumber,usergrup_tujuan:usergrup_tujuan};
        $.post("<?php echo base_url()?>index.php/welcome/go_verifikasi",ser,function(e){
            console.log(e);
            $("#go_verifikasi").html("<div class='alert alert-success'>Berhasil.</div>");
        })  
      }
      
    }
    return false;
  })


  $("#btn_lanjut").on("click",function(){
    var txt = $(this).text();
    var catatan = $("#catatan").val();
    var id_bphtb = $("#id_bphtb").val();
    var usergrup_sumber = "<?php echo $usergroup?>";
    var usergrup_tujuan = "<?php echo $usergroup+1?>";
    
    
    if(confirm("Anda yakin "+txt+" ?"))
    {
      if($("#catatan").val()=="")
      {
        $("#catatan").focus();
        alert("Catatan wajib isi!");
      }else{
        $("#go_verifikasi").html("<div class='alert alert-warning'>Loading...</div>");
        var ser = {catatan:catatan,id_bphtb:id_bphtb,usergrup_sumber:usergrup_sumber,usergrup_tujuan:usergrup_tujuan};
        $.post("<?php echo base_url()?>index.php/welcome/go_verifikasi",ser,function(e){
            console.log(e);
            $("#go_verifikasi").html("<div class='alert alert-success'>Berhasil.</div>");
            
        })  
      }
      
    }
    return false;
  })



$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/welcome/history_data','History');
});

</script>