
<b>Konfirmasi Print SSPD</b>

<div class="alert alert-warning"><b>Perhatian!!!</b> Anda yakin print SSPD? Masukkan PassPrahe</div>

<form action="<?php echo base_url()?>index.php/welcome/print_sspd/" target="blank" method="get">
<input type="hidden" name="id_bphtb" id="id_bphtb" value="<?php echo $id_bphtb?>">
<input type="text" name="passprahe" class="form-control" id="passprahe" placeholder="passprahe" required><br>
<input type="submit" class="btn btn-primary" value="Print SSPD">

<!--
<a class="btn btn-primary" target="blank" href="<?php echo base_url()?>index.php/welcome/print_sspd/<?php echo $id_bphtb?>">Print SSPD</a>
-->