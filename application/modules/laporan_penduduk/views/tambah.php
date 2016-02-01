<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Tambah Keluarga </h3>
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
              <label for="exampleInputEmail1">NIKK (Nomor Induk Kartu Keluarga)</label>
              <?php 
              echo form_input(array('name' => 'nikk',
                'id'    => 'form_nikk',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "NIKK",
				"maxlength" => 11,
                'value' => $this->form_validation->set_value('nikk'),
              ));
              ?>
            </div> 	
		  </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Kampung</label>
              <?php 
			  $master_kampung = $this->db->order_by('kampung', 'ASC')->order_by('rw', 'ASC')->order_by('rt', 'ASC')->get('master-kampung')->result_array();
			  $master_kampung_arr = array();
			  foreach($master_kampung as $val) {
				$master_kampung_arr[$val['id']] = "Rt. ".str_repeat("0", 3-strlen($val['rt'])).$val['rt']." Rw. ".str_repeat("0", 3-strlen($val['rw'])).$val['rw']." Kampung ".$val['kampung'];
			  }
              echo form_dropdown('master_kampung', $master_kampung_arr,
              $this->form_validation->set_value('master_kampung'), array('class' => 'form-control')
              );
              ?>
            </div>
          </div>
        </div>
		<div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Alamat Rumah (Nama Jalan, Blok &amp; No. Rumah)</label>
              <?php 
              echo form_input(array('name' => 'alamat_detail',
                'id'    => 'form_alamat_detail',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Alamat Rumah",
                'value' => $this->form_validation->set_value('alamat_detail')
              ));
              ?>
            </div>
          </div>
        </div>
	  </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-flat">Submit</button>
        <a href="<?php echo base_url('keluarga');?>" class="btn btn-default btn-flat pull-right">Kembali</a>

      </div>
    </form>
  </div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row -->
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.date.extensions.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.extensions.js');?>"></script>
<script>
$(".datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
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

