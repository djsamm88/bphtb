
      


        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/welcome/table_data','Verifikasi');return false;">
            <i class="fa fa-check"></i> <span>Verifikasi <span class="label label-danger pull-right badge_notif"></span></span> 
          </a>
        </li>




        <?php 
        if($this->session->userdata('usergroup')=='5'){
        ?>
        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/welcome/history_bank','History Bank');return false;">
            <i class="fa fa-check"></i> <span>History Bank <span class="label label-danger pull-right badge_notif_bank"></span></span>
          </a>
        </li>

        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/welcome/data_print','Print SSPD');return false;">
            <i class="fa fa-check"></i> <span>Print SSPD<span class="label label-danger pull-right badge_notif_print"></span></span>
          </a>
        </li>
        <?php 
          }
        ?>




        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/welcome/history_data','History');return false;">
            <i class="fa fa-check"></i> <span>History</span>
          </a>
        </li>



        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/welcome/data_selesai','Selesai');return false;">
            <i class="fa fa-check"></i> <span>Selesai</span>
          </a>
        </li>

        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/welcome/data_ppat','PPAT');return false;">
            <i class="fa fa-check"></i> <span>User PPAT</span>
          </a>
        </li>

        


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan/laporan_all/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Laporan Jurnal');return false;">
                <i class="fa fa-link"></i> <span>Laporan</span>
              </a>
            </li>

           
        <li>
          <a href="#">
             &nbsp;
          </a>
        </li>

            
           