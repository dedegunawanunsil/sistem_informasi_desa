

<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Daftar Seluruh Penduduk </h3>&nbsp;&nbsp;<a href="<?php echo base_url('penduduk/tambah');?>" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Baru</a>
    </div><!-- /.box-header -->
    <div class="box-body">
      <?php 
      if ($message = $this->session->flashdata('message')) {
        echo "$message";
      }
      ?>
      <table id="example2" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>NIKK</th>
            <th>JK</th>
            <th>Pilihan</th>
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
                echo "<td>{$value->nik}</td>";
                echo "<td>{$value->nama}</td>";
                echo "<td>{$value->nikk}</td>";
                echo "<td>";
                switch (strtolower($value->jenis_kelamin)) {
                  case 'l':
                    echo "Laki-laki";
                    break;
                  case 'p':
                    echo "Perempuan";
                    break;
                  
                  default:
                    # code...
                    break;
                }
                echo "</td>";
                echo "<td>";
				
                echo anchor('penduduk/detail/'.$value->id, '<i class="fa fa-gear"></i>', 'title="Edit" class="btn btn-flat btn-primary"');
                echo "&nbsp;";
                echo anchor('penduduk/hapus/'.$value->id, '<i class="fa fa-close"></i>', 'title="Hapus" class="btn btn-flat btn-danger make_sure"');
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

