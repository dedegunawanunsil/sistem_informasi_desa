

<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Tambah pendidikan </h3>
    </div><!-- /.box-header -->
    <?php echo form_open('', array('role' => 'form'));?>
      <div class="box-body">
        <?php 
      if ($message = $this->session->flashdata('message')) {
        echo "$message";
      }
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
                'placeholder' => "Masukkan Nama pendidikan",
                'value' => $this->form_validation->set_value('nama'),
              ));
              ?>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-flat">Submit</button>
        <a href="<?php echo base_url('pendidikan');?>" class="btn btn-default btn-flat pull-right">Kembali</a>

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

