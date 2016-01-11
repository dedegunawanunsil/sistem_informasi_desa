

<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Daftar Seluruh Keluarga </h3>&nbsp;&nbsp;<a href="<?php echo base_url('keluarga/tambah');?>" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Baru</a>
    </div><!-- /.box-header -->
    <div class="box-body">
      <?php 
      if ($message = $this->session->flashdata('message')) {
        echo "$message";
      }
      ?>
	  <style>
		.table th, .table td  {
			vertical-align:middle !important;
			text-align:center !important;
		}
	  </style>
      <table id="example2" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">NIKK</th>
            <th colspan="4">Alamat</th>
            <th rowspan="2">Anggota</th>
            <th rowspan="2">Opsi</th>
          </tr>
          <tr>
            <th>Detail</th>
            <th>RT</th>
            <th>RW</th>
            <th>Kampung</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($data) && is_array($data)) {
            $no = 1;
            foreach ($data as $value) {
              if (is_object($value)) {
                echo "<tr>";
                echo "<td>$no</td>";
                echo "<td>{$value->nikk}</td>";
                echo "<td>{$value->alamat_detail}</td>";
                echo "<td>".str_repeat("0", 3-strlen($value->rt)).$value->rt."</td>";
                echo "<td>".str_repeat("0", 3-strlen($value->rw)).$value->rw."</td>";
                echo "<td>{$value->kampung}</td>";
                echo "<td>{$value->jumlah_anggota}</td>";
                echo "<td>";
				
                echo anchor('keluarga/detail/'.$value->id, '<i class="fa fa-gear"></i>', 'title="Edit" class="btn btn-flat btn-primary"');
                echo "&nbsp;";
                echo anchor('anggota_keluarga?nikk_id='.$value->nikk, '<i class="fa fa-eye"></i>', 'title="Detail" class="btn btn-flat btn-warning"');
                echo "&nbsp;";
                echo anchor('keluarga/hapus/'.$value->id, '<i class="fa fa-close"></i>', 'title="Hapus" class="btn btn-flat btn-danger make_sure"');
                echo "</td>";
                echo "</tr>";
              }
              $no++;
            }
          }
          ?>
        </tbody>
      </table>
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

