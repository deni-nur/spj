<?php
// Error Warning
echo validation_errors('<div class="alert alert-warning">','</div>');

//error upload
if(isset($error_upload)) {
    echo '<div class="alert alert-warning">'.$errors_upload.'</div>';
}

// form open
echo form_open_multipart(base_url('user/updatepass/'.$user->user_id));
?>
<section class="content-header">
  <h1>
    User Profile
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">User profile</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<?php 
    //$this->view('messages') 
    ?>
    <div id="flash" data-flash="<?=$this->session->flashdata('success'); ?>"></div>
  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?=base_url('assets/upload/image/'.$user->logo) ?>" alt="User profile picture">

          <h3 class="profile-username text-center"><?=$user->name ?></h3>

          <p class="text-muted text-center"><?=$user->unit_kerja ?></p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Level</b> <a class="pull-right"><?=$user->level == 1 ? "Admin" : "Operator" ?></a>
            </li>
            <li class="list-group-item">
              <b>Status</b> <a class="pull-right"><?=$user->is_active == 1 ? "Aktif" : "Non Aktif" ?></a>
            </li>
          </ul>

          <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li><a href="<?=site_url('user/profile'); ?>" >Update Profile</a></li>
          <li class="active"><a href="<?=site_url('user/updatepass'); ?>" >Update Password</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            
            <div class="tab-pane" id="settings">
              
              <div class="form-group">
                    <label>Update Password *</label>
                    <input type="password" name="password" class="form-control">
                </div>

              <div class="form-group">
                  <button type="submit" class="btn btn-success">
                      <i class="fa fa-paper-plane"></i> Save</button>
                  <button type="reset" class="btn btn-default">
                      <i class="fa fa-refresh"></i> Reset</button>
              </div>

          </div>
          <!-- /.tab-pane -->

          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">
              
              

            </ul>
          </div>
          <!-- /.tab-pane -->

          
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

</section>
<!-- /.content -->

<?php echo form_close(); ?>