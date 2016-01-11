
<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">All User </h3>&nbsp;&nbsp;<a href="<?php echo base_url('manage/add_user');?>" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Baru</a>
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
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Email</th>
            <th>Groups</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (@$data && is_array($data)) {
              $no = 1;
             foreach ($data as $user) {
               if (is_object($user)) { 
                  echo "<tr>\n
                    <td>$no</td>
                    <td>".htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8')."</td>
                    <td>".htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8')."</td>
                    <td>".htmlspecialchars($user->email,ENT_QUOTES,'UTF-8')."</td>
                    <td>";
                    foreach ($user->groups as $group) {
                       echo anchor("manage/detail_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8'));
                       echo "&nbsp;|&nbsp;";
                    }
                    echo "</td>
                    <td>".(($user->active) ? anchor("manage/deactivate/".$user->id, "Aktif") : anchor("manage/activate/". $user->id, "Tidak Aktif"))."</td>
                    <td><a href=\"".base_url('manage/edit_user/'.$user->id)."\"  class='btn btn-primary btn-flat'>Detail &amp; Edit</a>&nbsp;<a href=\"".base_url('manage/hapus_user/'.$user->id)."\" class='btn btn-danger btn-flat make_sure'>Hapus</a></td>
                  </tr>\n
                  ";
                  $no++;
               }
             }
           } 
          ?>
        </tbody>
        <tfoot>
          <tr>
            <th>No</th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Email</th>
            <th>Groups</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
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

 