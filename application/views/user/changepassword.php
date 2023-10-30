<?php
// Error Warning
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('user/changepassword/'.$user->user_id));
?>
<section class="content-header">
      <h1>Users
        <small>Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<?php 
    //$this->view('messages') 
    ?>
    <div id="flash" data-flash="<?=$this->session->flashdata('success'); ?>"></div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?=ucfirst($page) ?> Users</h3>
                <div class="pull-right">
                    <a href="<?=site_url('user') ?>" class="btn btn-warning">
                        <i class="fa fa-undo"></i> Back
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                            <!-- <div class="form-group">
                                <label>Password Lama *</label>
                                <input type="password" name="passlama" class="form-control">
                            </div> -->
                            <div class="form-group">
                                <label>Password Baru*</label>
                                <input type="password" name="passbaru" class="form-control">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-paper-plane"></i> Save</button>
                                <button type="reset" class="btn btn-default">
                                    <i class="fa fa-refresh"></i> Reset</button>
                            </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

<?php echo form_close(); ?>