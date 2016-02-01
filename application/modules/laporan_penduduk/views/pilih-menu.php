

<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title"><i class="fa fa-file-o"></i> Pilih Menu Laporan </h3>
    </div><!-- /.box-header -->
    <div class="box-body">
      <?php 
      if ($message = $this->session->flashdata('message')) {
        echo "$message";
      }
      $menu = array(
		array('caption' => 'Penduduk &amp; Keluarga', 'link' => base_url('laporan_penduduk/p_k')),
		array('caption' => 'Berdasarkan Jenis Kelamin &amp; Potensial Pemilih ', 'link' => base_url('laporan_penduduk/jk')),
		array('caption' => 'Berdasarkan Agama ', 'link' => base_url('laporan_penduduk/agama')),
		array('caption' => 'Berdasarkan Status Kawin &amp; Potensial Pemilih', 'link' => base_url('laporan_penduduk/s_k')),
		//array('caption' => 'Berdasarkan Golongan Darah', 'link' => base_url('laporan_penduduk/g_d')),
		array('caption' => 'Berdasarkan Pendidikan Terakhir', 'link' => base_url('laporan_penduduk/pk')),
		//array('caption' => 'Berdasarkan Kelompok Umur &amp; Jenis Kelamin', 'link' => base_url('laporan_penduduk/ku')),
		//array('caption' => 'Berdasarkan Usia Sekolah &amp; Jenis Kelamin', 'link' => base_url('laporan_penduduk/us'))
	  );
	  $color = array('btn-primary', 'btn-warning', 'btn-success', 'btn-danger');
	  $start = 1;
	  $index = count($color);
	  foreach($menu as $_menu) {
		echo "<a href='".$_menu['link']."' class='btn ".$color[$start%$index]." btn-flat' target='_blank'>".$_menu['caption']."</a><br/><br/>";
		$start++;
	  }
      ?>
	  
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row -->
<script type="text/javascript">
  $(function () {
    var table = $('#example2').DataTable({
      "bPaginate": true,
      "bLengthChange": false,
      "bFilter": false,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false
    });

  });
  $(".make_sure").click(function(e) {
    e.preventDefault();
    if (confirm("Apakah Anda yakin akan menghapusnya ? ")) {
      var url = $(this).attr('href');
      window.location.href = url;
    };
  });

</script>
<?php

/* 
 * ***************************************************************
 * Version : 0.1
 * Date : 4 November 2015
 * Author : Dede Gunawan
 * Description : 
 * ***************************************************************
 */

