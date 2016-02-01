<!-- Main row -->
<div class="row">
    <div class="col-md-12">
      <!-- TABLE: LATEST ORDERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Selamat Datang di Halaman Admin</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <p>Ini adalah halaman admin untuk Sistem Informasi Desa. Anda bisa menambahkan data penduduk, data keluarga, dan dapat melihat statistik penduduk anda dalm sebuah laporan penduduk.</p>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="<?php echo base_url('penduduk');?>" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-file-o"></i> &nbsp;Data Penduduk</a>&nbsp;
          <a href="<?php echo base_url('keluarga');?>" class="btn btn-sm btn-warning btn-flat"><i class="fa fa-file-o"></i> &nbsp;Data Keluarga</a>&nbsp;
          <a href="<?php echo base_url('laporan_penduduk');?>" class="btn btn-sm btn-success btn-flat"><i class="fa fa-file-o"></i> &nbsp;Laporan</a>&nbsp;
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->