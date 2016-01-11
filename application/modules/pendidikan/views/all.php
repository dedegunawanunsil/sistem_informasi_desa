
<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">pendidikan </h3>&nbsp;&nbsp;<a href="<?php echo base_url('pendidikan/tambah');?>" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Baru</a>
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
            <th>Nama</th>
            <th>Pilihan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($data && is_array($data)) {
              $no = 1;
             foreach ($data as $value) {
               if (is_object($value)) {
                  echo "<tr>\n
                    <td>$no</td>
                    <td>{$value->nama}</td>
                    <td><a href=\"".base_url('pendidikan/detail/'.$value->id)."\"  class='btn btn-primary btn-flat'>Detail &amp; Edit</a>&nbsp;<a href=\"".base_url('pendidikan/hapus/'.$value->id)."\" class='btn btn-danger btn-flat make_sure'>Hapus</a></td>
                  </tr>\n
                  ";
                  $no++;
               }
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
    $('#example2').dataTable({
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
 * Date : 31 Oktober 2015
 * Author : Dede Gunawan
 * Description : 
 * ***************************************************************
 */

