

<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Hubungan Keluarga</h3>&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('keluarga');?>" class="btn btn-primary btn-flat"><i class="fa fa-mail-reply-all"></i> Kembali</a>
    </div><!-- /.box-header -->
    <div class="box-body">
      <?php 
      if ($message = $this->session->flashdata('message')) {
        echo "$message";
      }
      ?>
	  <style>
		.table th, .table td  {
			vertical-align:middle !important;
			text-align:center !important;
		}
	  </style>
	  <form method="post" action="">
	  <div class="row">
		  <div class="col-sm-12">
		  Pilih NIKK : 
		  </div>
	  </div>
	  <div class="row">
		<div class="col-sm-4">
            <div class="form-group">
              <?php 
              echo form_input(array('name' => 'nikk_id',
                'id'    => 'nikk_id',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Masukkan NIKK Keluarga",
                'value' => (@$nikk_id ? $nikk_id : $this->form_validation->set_value('nikk_id') )
              ));
              ?>
            </div>
        </div>
		<script>
		$(function() {
			$("#nikk_id").keyup(function() {
				$(".search_nikk").addClass('disabled');
			});
			$("#nikk_id").autocomplete({
				source: "<?php echo base_url('anggota_keluarga/ajax_keluarga');?>",
				minLength: 2,
				select: function(event, ui) {
					var url = ui.item.id;
					if(url != '#') {
						$(".search_nikk").removeClass('disabled');
					}
				},
			  // optional (if other layers overlap autocomplete list)
				open: function(event, ui) {
					//$(".ui-autocomplete").css("z-index", 1000);
				}
			});
		 
		});
		</script>
			  
	  <a class="btn btn-primary btn-flat search_nikk disabled"><i class="fa fa-search"></i> Cari</a>
	  <script type="text/javascript">
	  $(".search_nikk").click(function(e) {
		e.preventDefault();
		if($("#nikk_id").val() != '0') {
			window.location.href = '?nikk_id='+$("#nikk_id").val();
		}
		else {
			$("#nikk_id").focus();
		}
	  });
	  </script>
	  </div>
	  <?php 
	  if(@$nikk_id) {
	  ?>
	  <div class="row">
		  <div class="col-sm-4">
		  Pilih NIK : 
		  </div>
		  <div class="col-sm-4">
		  Tanggung Jawab di Keluarga: 
		  </div>
	  </div>
	  <div class="row">
		<div class="col-sm-4">
            <div class="form-group">
              <?php 
              echo form_input(array('name' => 'nik_id',
                'id'    => 'nik_id',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Masukkan NIK",
                'value' => (@$nik_id ? $nik_id : $this->form_validation->set_value('nik_id') )
              ));
              ?>
            </div>
        </div>
		<div class="col-sm-4">
            <div class="form-group">
              <?php 
			  $statusx = $this->db->get('status_keluarga')->result();
			  $status_a = array('0' => '--Pilih Salah Satu--');
			  foreach($statusx as $val) {
				$status_a[$val->id] = $val->nama;
			  }
              echo form_dropdown('status', $status_a,
               @$this->form_validation->set_value('status'), array('class' => 'form-control', 'id' => 'status')
              );
              ?>
            </div>
        </div>
		<script>
		$(function() {
			$("#nik_id").keyup(function() {
				$(".tambah_data").addClass('disabled');
			});
			
			$("#nik_id").autocomplete({
				source: "<?php echo base_url('anggota_keluarga/ajax_penduduk');?>",
				minLength: 2,
				select: function(event, ui) {
					var url = ui.item.id;
					if(url != '#') {
						$(".tambah_data").removeClass('disabled');
					}
				},
			  // optional (if other layers overlap autocomplete list)
				open: function(event, ui) {
					//$(".ui-autocomplete").css("z-index", 1000);
				}
			});
		 
		});
		</script>
			  
	  <a class="btn btn-primary btn-flat tambah_data disabled"><i class="fa fa-plus"></i> Tambah Anggota Keluarga</a>
	  <script type="text/javascript">
	  $(".tambah_data").click(function(e) {
		e.preventDefault();
		if($("#nik_id").val() != '' && $("#status").val() != '' ) {
			var selected = $("#status").find('option[value='+$("#status").val()+']').text();
			if(selected == 'Ayah' || selected == 'Ibu') {
				if($("#nama_ayah").val() != '' && $("#nama_ibu").val() != '' ) {
					$("form").has($(this)).submit();
				}
			}
			else {
				$("form").has($(this)).submit();
			}
		}
		else {
			alert('Error, Cek Kembali Data Anda ada yang kurang');
		}
		
	  });
	  </script>
	  </div>
	  <div class="row ayah_ibu" style="display:none">
		<div class="col-sm-4">
            <div class="form-group">
              <?php 
              echo form_input(array('name' => 'nama_ayah',
                'id'    => 'nama_ayah',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Masukkan Nama Ayah",
                'value' => $this->form_validation->set_value('nama_ayah')
              ));
              ?>
            </div>
        </div>
		<div class="col-sm-4">
            <div class="form-group">
              <?php 
              echo form_input(array('name' => 'nama_ibu',
                'id'    => 'nama_ibu',
                'type'  => 'text',
                'class' => "form-control",
                'placeholder' => "Masukkan Nama Ibu",
                'value' => $this->form_validation->set_value('nama_ibu')
              ));
              ?>
            </div>
        </div>
	  </div>
	  <?php }
	  ?>
	  </form>
	  
      <table id="example2" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Status</th>
            <th>Ayah</th>
            <th>Ibu</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($data) && is_array($data)) {
			$find_ayah = array_filter($data, function($dx) {
				if(strtolower(trim($dx->status)) == 'ayah') {
					return true;
				}
			});
			$find_ibu = array_filter($data, function($dx) {
				
				if(strtolower(trim($dx->status)) == 'ibu') {
					return true;
				}
			});
			$find_ayah = array_values($find_ayah);
			$find_ibu = array_values($find_ibu);
			$ayah = @$find_ayah[0]->nama;
			$ibu = @$find_ibu[0]->nama;
            $no = 1;
            foreach ($data as $value) {
              if (is_object($value)) {
                echo "<tr>";
                echo "<td>$no</td>";
                echo "<td>{$value->nik}</td>";
                echo "<td>{$value->nama}</td>";
                echo "<td>{$value->status}</td>";
                echo "<td>".($value->ayah != '' ? $value->ayah : (strtolower(substr(trim($value->status),0,4)) == 'anak' ? $ayah : '-'))."</td>";
                echo "<td>".($value->ibu != '' ? $value->ibu : (strtolower(substr(trim($value->status),0,4)) == 'anak' ? $ibu : '-'))."</td>";
                echo "<td>";
				
                echo anchor('anggota_keluarga/hapus/'.$value->id.'?nikk_id='.$_GET['nikk_id'], '<i class="fa fa-close"></i>', 'title="Hapus" class="btn btn-flat btn-danger make_sure"');
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
	$("#status").change(function() {
		var selected = $(this).find('option[value='+$(this).val()+']').text();
		if(selected == 'Ayah' || selected == 'Ibu') {
			var x = table.column(3).data();
			var find = false;
			for($x = 0; $x < x.length; $x++) {
				if(selected == x[$x]) {
					find = true;
					break;
				}
			}
			if(find) {
				alert('Error, '+selected+' sudah ada!');
				$(this).val('0');
				$(".ayah_ibu").hide();
			}
			else {
				$(".ayah_ibu").show();
			}
		}
		
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

