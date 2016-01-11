<!-- Main row -->
<div class="row">
    <?php
    if ($message) { ?>
      <div class="col-md-12">
        <?php echo $message;?>
      </div>
    <?php }
    ?>
    <div class="col-md-12">
      <?php 
        echo form_open('', array('role' => 'form')); 
        echo form_input(array('name' => $csrf['csrfkey'], 'type'  => 'hidden', 'value' => $csrf['csrfvalue'], 'class' => 'token'));
      ?>
      <!-- TABLE: LATEST ORDERS -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah User Baru</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Email</label>
                <?php 
                echo form_input(array('name' => 'email',
                  'id'    => 'email',
                  'type'  => 'email',
                  'class' => "form-control",
                  'placeholder' => "Email",
                  'value' => $this->form_validation->set_value('email'),
                ));
                ?>
              </div>
            </div>
          </div>
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
                  'value' => $this->form_validation->set_value('first_name'),
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
                  'value' => $this->form_validation->set_value('last_name'),
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
                  'value' => $this->form_validation->set_value('company'),
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
                  'value' => $this->form_validation->set_value('phone'),
                ));
                ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Password</label>
                <?php 
                echo form_input(array('name' => 'password',
                  'id'    => 'password',
                  'type'  => 'password',
                  'class' => "form-control",
                  'placeholder' => "Password",
                  'value' => $this->form_validation->set_value('password'),
                ));
                ?>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Konfirmasi Password</label>
                <?php 
                echo form_input(array('name' => 'password_confirm',
                  'id'    => 'password_confirm',
                  'type'  => 'password',
                  'class' => "form-control",
                  'placeholder' => "Password",
                  'value' => $this->form_validation->set_value('password_confirm'),
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
<script type="text/javascript">
$(document).on('click', '.submit', function(e) {
  e.preventDefault();
  $("form").has(this).submit();
});
</script>