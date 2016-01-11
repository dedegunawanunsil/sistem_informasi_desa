<?php 
$user = $_SESSION['user'];
?>
<!-- Main row -->
<div class="row">
    <?php
    $message = $this->session->flashdata('message');
    if ($message) { ?>
      <div class="col-md-12">
        <?php echo $message;?>
      </div>
    <?php }
    ?>
    <div class="col-md-12">
      <?php 
        echo form_open('manage/update_profil', array('role' => 'form')); 
        echo form_input(array('name' => $csrf['csrfkey'], 'type'  => 'hidden', 'value' => $csrf['csrfvalue'], 'class' => 'token'));
        echo form_input(array('name' => 'id', 'type'  => 'hidden', 'value' => $user->id));
      ?>
      <!-- TABLE: LATEST ORDERS -->
      <div class="box box-warning collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Your Profil</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama Depan</label>
                <?php 
                echo form_input(array('name' => 'first_name',
                  'id'    => 'first_name',
                  'type'  => 'text',
                  'class' => "form-control",
                  'placeholder' => "Nama Depan",
                  'value' => $user->first_name,
                ));
                ?>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama Belakang</label>
                <?php 
                echo form_input(array('name' => 'last_name',
                  'id'    => 'last_name',
                  'type'  => 'text',
                  'class' => "form-control",
                  'placeholder' => "Nama Belakang",
                  'value' => $user->last_name,
                ));
                ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Perusahaan / Sekolah / Institusi </label>
                <?php 
                echo form_input(array('name' => 'company',
                  'id'    => 'company',
                  'type'  => 'text',
                  'class' => "form-control",
                  'placeholder' => "Perusahaan / Sekolah / Institusi",
                  'value' => $user->company,
                ));
                ?>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>No. Telepon</label>
                <?php 
                echo form_input(array('name' => 'phone',
                  'id'    => 'phone',
                  'type'  => 'text',
                  'class' => "form-control",
                  'placeholder' => "No. Telepon",
                  'value' => $user->phone,
                ));
                ?>
              </div>
            </div>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="#" class="btn btn-sm btn-primary btn-flat submit"><i class="fa fa-floppy-o"></i> &nbsp;Simpan</a>&nbsp;
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
      </form>
    </div><!-- /.col -->
    <div class="col-md-12">
      <!-- TABLE: LATEST ORDERS -->
      <?php 
        echo form_open('manage/update_password', array('role' => 'form')); 
        echo form_input(array('name' => $csrf['csrfkey'], 'type'  => 'hidden', 'value' => $csrf['csrfvalue'], 'class' => 'token'));
        echo form_input(array('name' => 'id', 'type'  => 'hidden', 'value' => $user->id));
      ?>
      <div class="box box-warning collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Your Password</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <?php 
                echo form_input(array('name' => 'password',
                  'id'    => 'password',
                  'type'  => 'password',
                  'class' => "form-control",
                  'placeholder' => "Password",
                  'value' => '',
                ));
                ?>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <?php 
                echo form_input(array('name' => 'password_confirm',
                  'id'    => 'password_confirm',
                  'type'  => 'password',
                  'class' => "form-control",
                  'placeholder' => "Password",
                  'value' => '',
                ));
                ?>
              </div>
            </div>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="#" class="btn btn-sm btn-primary btn-flat submit"><i class="fa fa-floppy-o"></i> &nbsp;Simpan</a>&nbsp;
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
      </form>
    </div><!-- /.col -->
    <div class="col-md-12">
      <!-- TABLE: LATEST ORDERS -->
      <?php 
        echo form_open_multipart('manage/change_foto_profil', array('role' => 'form', )); 
        echo form_input(array('name' => $csrf['csrfkey'], 'type'  => 'hidden', 'value' => $csrf['csrfvalue'], 'class' => 'token'));
        echo form_input(array('name' => 'id', 'type'  => 'hidden', 'value' => $user->id));
      ?>
      <div class="box box-warning collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Your Photo Profil</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <img src="<?php echo $this->session->foto;?>" style="height:200px;width:200px" class="img-preview"/>
              </div>
              <div class="form-group">
                <?php 
                echo form_input(array('name' => 'userfile',
                  'id'    => 'userfile',
                  'type'  => 'file',
                  'value' => '',
                ));
                ?>
              </div>
            </div>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="#" class="btn btn-sm btn-primary btn-flat submit"><i class="fa fa-floppy-o"></i> &nbsp;Simpan</a>&nbsp;
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
      </form>
    </div><!-- /.col -->
</div><!-- /.row -->
<script type="text/javascript">
$(document).on('click', '.submit', function(e) {
  e.preventDefault();
  var x = confirm('Apakah anda yakin ?');
  if (x) {
    $("form").has(this).submit();
  }
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.img-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).on('change', '#userfile', function(){
    readURL(this);
});
    
</script>