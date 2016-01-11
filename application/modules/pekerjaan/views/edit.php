

<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Detail pekerjaan </h3>
    </div><!-- /.box-header -->
    <?php echo form_open('', array('role' => 'form'));?>
      <div class="box-body">
        <?php 
      if ($message = $this->session->flashdata('message')) {
        echo "$message";
      }
      if (!isset($data) || !is_object($data)) {
            $this->session->set_flashdata('message', "<p class='alert alert-danger ' >Detail Data Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
            redirect('pekerjaan', 'refresh');
      }
      echo form_input(array('name' => 'id',
        'type'  => 'hidden',
        'value' => $data->id,
      ));

      ?>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama</label>
              <?php 
              echo form_input(array('name' => 'nama',
                'id'    => 'form_nama',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Masukkan Nama pekerjaan",
                'value' => $data->nama,
              ));
              ?>
            </div>
          </div>
		</div>  
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-flat">Update</button>
        <a href="<?php echo base_url('pekerjaan');?>" class="btn btn-default btn-flat pull-right">Kembali</a>
      </div>
    </form>
  </div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row -->

<?php

/* 
 * ***************************************************************
 * Version : 0.1
 * Date : 31 Oktober 2015
 * Author : Dede Gunawan
 * Description : 
 * ***************************************************************
 */

