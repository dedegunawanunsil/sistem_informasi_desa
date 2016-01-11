        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          Halaman ini dimuat dalam {elapsed_time} detik, Penggunaan memory {memory_usage}
        </div>
        <?php
        $tahun = 2015;
        if ($tahun - date("Y") < 0) {
          $tahun .= " - ".date("Y");
        }
        ?>
        <strong>Copyright &copy; <?php echo $tahun;?>.</strong>
      </footer>
    </div><!-- ./wrapper -->
  </body>
</html>
