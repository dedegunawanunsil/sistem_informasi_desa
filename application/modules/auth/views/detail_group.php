<!-- Main row -->
<div class="row">
    <?php
    if (@$message) { ?>
      <div class="col-md-12">
        <?php echo $message;?>
      </div>
    <?php }
    ?>
    <div class="col-md-12">
      <!-- TABLE: LATEST ORDERS -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Group</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Name</label>
                <?php 
                echo form_input(array('name' => 'name',
                  'id'    => 'name',
                  'type'  => 'email',
                  'readonly' => 'readonly' , 
                  'class' => "form-control",
                  'placeholder' => "Name",
                  'value' => $group->name,
                ));
                ?>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Deskripsi</label>
                <?php 
                echo form_input(array('name' => 'description',
                  'id'    => 'description',
                  'type'  => 'text',
                  'class' => "form-control",
                  'readonly' => "readonly",
                  'value' => $group->description,
                ));
                ?>
              </div>
            </div>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="<?php echo base_url('manage/list_all_user');?>" class="btn btn-sm btn-primary btn-flat submit"><i class="fa fa-reply"></i> &nbsp;Kembali</a>&nbsp;
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
     </div><!-- /.col -->