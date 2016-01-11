

<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Tambah kampung </h3>
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
              <label for="exampleInputEmail1">Kampung</label>
              <?php 
              echo form_input(array('name' => 'kampung',
                'id'    => 'form_kampung',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Masukkan Nama kampung",
                'value' => $this->form_validation->set_value('kampung'),
              ));
              ?>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="exampleInputEmail1">RT</label>
              <?php 
              echo form_input(array('name' => 'rt',
                'id'    => 'form_rt',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Masukkan Nama rt",
                'value' => $this->form_validation->set_value('rt'),
              ));
              ?>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="exampleInputEmail1">RW</label>
              <?php 
              echo form_input(array('name' => 'rw',
                'id'    => 'form_rw',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Masukkan Nama rw",
                'value' => $this->form_validation->set_value('rw'),
              ));
              ?>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-flat">Submit</button>
        <a href="<?php echo base_url('kampung');?>" class="btn btn-default btn-flat pull-right">Kembali</a>

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

