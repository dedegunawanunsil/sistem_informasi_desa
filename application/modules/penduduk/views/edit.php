
<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Edit Data Penduduk </h3>
    </div><!-- /.box-header -->
    <?php echo form_open('', array('role' => 'form'));?>
      <div class="box-body">
        <?php 
      if ($message = $this->session->flashdata('message')) {
        echo "$message";
      }
	  if (!isset($data) || !is_object($data)) {
            $this->session->set_flashdata('message', "<p class='alert alert-danger ' >Detail Data Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
            redirect('penduduk', 'refresh');
      }
      echo form_input(array('name' => 'id',
        'type'  => 'hidden',
        'value' => $data->id,
      ));
      ?>
		<?php 
		/*
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
                'value' => $this->form_validation->set_value('nikk'),
              ));
              ?>
            </div> 	
			<script>
			$(function() {
 
				$("#form_nikk").autocomplete({
					source: "<?php echo base_url('penduduk/ajax_keluarga');?>",
					minLength: 2,
					select: function(event, ui) {
						var url = ui.item.id;
						if(url != '#') {
							$("#form_alamat_rumah").val(ui.item.alamat_rumah);
						}
					},
				  // optional (if other layers overlap autocomplete list)
					open: function(event, ui) {
						//$(".ui-autocomplete").css("z-index", 1000);
					}
				});
			 
			});
			</script>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Status Keluarga</label>
              <?php 
			  $status_keluarga = $this->db->get('status_keluarga')->result_array();
			  $status_keluarga_arr = array();
			  foreach($status_keluarga as $val) {
				$status_keluarga_arr[$val['id']] = $val['nama'];
			  }
              echo form_dropdown('status_keluarga', $status_keluarga_arr,
              $this->form_validation->set_value('status_keluarga'), array('class' => 'form-control')
              );
              ?>
            </div>
          </div>
        </div>
		<div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Alamat Rumah</label>
              <?php 
              echo form_input(array('name' => 'alamat_rumah',
                'id'    => 'form_alamat_rumah',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Alamat Rumah",
                'value' => $this->form_validation->set_value('alamat_rumah'),
				'readonly' => 'readonly'  
              ));
              ?>
            </div>
          </div>
        </div>
		*/
		?>
		<div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">NIK</label>
              <?php 
              echo form_input(array('name' => 'nik',
                'id'    => 'form_nik',
                'type'  => 'text',
				'maxlength' => '15',
                'class' => "form-control",
                'placeholder' => "NIK",
                'value' => (@$this->form_validation->set_value('nik') ? $this->form_validation->set_value('nik')  : $data->nik),
              ));
              ?>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama</label>
              <?php 
              echo form_input(array('name' => 'nama',
                'id'    => 'form_nama',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Nama Penduduk",
                'value' => (@$this->form_validation->set_value('nama') ? $this->form_validation->set_value('nama') : $data->nama),
              ));
              ?>
            </div>
          </div>
        </div>
		<div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Tempat Lahir</label>
              <?php 
              echo form_input(array('name' => 'tempat_lahir',
                'id'    => 'tempat_lahir',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Tempat Lahir",
                'value' => (@$this->form_validation->set_value('tempat_lahir') ? $this->form_validation->set_value('tempat_lahir') : $data->tempat_lahir),
              ));
              ?>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Tanggal Lahir</label>
              <?php 
              echo form_input(array('name' => 'tanggal_lahir',
                'id'    => 'tanggal_lahir',
                'type'  => 'text',
                'class' => "form-control datemask",
                'placeholder' => "Tanggal Lahir",
                'value' => (@$this->form_validation->set_value('tanggal_lahir') ? $this->form_validation->set_value('tanggal_lahir') : $data->tgl_lahir),
              ));
              ?>
            </div>
          </div>
		  
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Kelamin</label>
              <?php 
              echo form_dropdown('jenis_kelamin', array(
                'l' => 'Laki-laki',
                'p' => 'Perempuan'
              ),
              (@$this->form_validation->set_value('jenis_kelamin') ? $this->form_validation->set_value('jenis_kelamin') : $data->jenis_kelamin) , array('class' => 'form-control')
              );
              ?>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Status Kawin</label>
              
			  <?php 
			  $status_nikah = $this->db->get('status_nikah')->result_array();
			  $status_nikah_arr = array();
			  foreach($status_nikah as $val) {
				$status_nikah_arr[$val['id']] = $val['nama'];
			  }
              echo form_dropdown('status_kawin', $status_nikah_arr,
              (@$this->form_validation->set_value('status_kawin') ? $this->form_validation->set_value('status_kawin') : $data->status_nikah), array('class' => 'form-control')
              );
              ?>
            </div>
          </div>
		</div>
        
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Pekerjaan</label>
              <?php 
			  $penghasilan = $this->db->get('pekerjaan')->result_array();
			  $penghasilan_arr = array();
			  foreach($penghasilan as $val) {
				$penghasilan_arr[$val['id']] = $val['nama'];
			  }
              echo form_dropdown('pekerjaan', $penghasilan_arr,
              (@$this->form_validation->set_value('pekerjaan') ? $this->form_validation->set_value('pekerjaan') : $data->pekerjaan) , array('class' => 'form-control')
              );
              ?>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Penghasilan</label>
              <?php 
              echo form_input(array('name' => 'penghasilan',
                'id'    => 'penghasilan',
                'type'  => 'text',
                'class' => "form-control priceFormat",
                'placeholder' => "Penghasilan",
                'value' => (@$this->form_validation->set_value('penghasilan') ? $this->form_validation->set_value('penghasilan') : $data->penghasilan),
              ));
              ?>
			  <script src="<?php echo base_url('assets/plugins/price_format.2.0/jquery.price_format.2.0.min.js');?>">
			  </script>
			  <script>
			  $('.priceFormat').each(function(i) {
				$(this).priceFormat({prefix:'Rp.', thousandsSeparator : '.'});
			  });
			  </script>
            </div>
          </div>
		</div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Pendidikan</label>
              <?php 
			  $pendidikan = $this->db->get('pendidikan')->result_array();
			  $pendidikan_arr = array();
			  foreach($pendidikan as $val) {
				$pendidikan_arr[$val['id']] = $val['nama'];
			  }
              echo form_dropdown('pendidikan', $pendidikan_arr,
              (@$this->form_validation->set_value('pendidikan') ? $this->form_validation->set_value('pendidikan') : $data->pendidikan), array('class' => 'form-control')
              );
              ?>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Agama</label>
              <?php 
			  $agama = $this->db->get('agama')->result_array();
			  $agama_arr = array();
			  foreach($agama as $val) {
				$agama_arr[$val['id']] = $val['nama'];
			  }
              echo form_dropdown('agama', $agama_arr,
              (@$this->form_validation->set_value('agama') ? $this->form_validation->set_value('agama') : $data->agama), array('class' => 'form-control')
              );
              ?>
            </div>
          </div>
          <?php 
		  /*
		  <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Ayah</label>
              <?php 
              echo form_input(array('name' => 'nama_ayah',
                'id'    => 'nama_ayah',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Nama Ayah",
                'value' => $this->form_validation->set_value('nama_ayah'),
              ));
              ?>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Ibu</label>
              <?php 
              echo form_input(array('name' => 'nama_ibu',
                'id'    => 'nama_ibu',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Nama Ibu",
                'value' => $this->form_validation->set_value('nama_ibu'),
              ));
              ?>
            </div>
          </div>
          */
		  ?>
		  <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Kewarganegaraan</label>
              <?php 
              echo form_dropdown('kewarganegaraan', array(
				'WNI' => 'WNI',
				'WNA' => 'WNA'
			  ),
              (@$this->form_validation->set_value('kewarganegaraan') ? $this->form_validation->set_value('kewarganegaraan') : $data->kewarganegaraan), array('class' => 'form-control')
              );
              ?>
            </div>
          </div>
		</div>
	  </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-flat">Submit</button>
        <a href="<?php echo base_url('penduduk');?>" class="btn btn-default btn-flat pull-right">Kembali</a>

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

