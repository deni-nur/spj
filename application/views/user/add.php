<?php
// Error Warning
echo validation_errors('<div class="alert alert-warning">','</div>');

//error upload
if(isset($error_upload)) {
    echo '<div class="alert alert-warning">'.$errors_upload.'</div>';
}

// form open
echo form_open_multipart(base_url('user/add'));
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
    					<?php //echo validation_errors() ?>
    					<form action="" method="post">
    						<div class="form-group <?=form_error('fullname') ? 'has-error' : null ?>">
    							<label>Name *</label>
    							<input type="text" name="fullname" class="form-control">
    							<?=form_error('fullname') ?>
    						</div>
    						<div class="form-group <?=form_error('username') ? 'has-error' : null ?>">
    							<label>Username *</label>
    							<input type="text" name="username" class="form-control">
    							<?=form_error('username') ?>
    						</div>
    						<div class="form-group <?=form_error('password') ? 'has-error' : null ?>">
    							<label>Password *</label>
    							<input type="password" name="password" class="form-control">
    							<?=form_error('password') ?>
    						</div>
    						<div class="form-group <?=form_error('passconf') ? 'has-error' : null ?>">
    							<label>Password Confirmation *</label>
    							<input type="password" name="passconf" class="form-control">
    							<?=form_error('passconf') ?>
    						</div>
    						<div class="form-group <?=form_error('unit_kerja_id') ? 'has-error' : null ?>">
                                <label>Unit Kerja *</label>
                                <select name="unit_kerja_id" class="form-control" >
                                    <option value="">- Pilih -</option>
                                    <?php foreach($unit_kerja->result() as $key => $data) { ?>
                                        <option value="<?=$data->unit_kerja_id ?>"><?=$data->unit_kerja ?></option>
                                    <?php } ?>
                                </select>
                                <?=form_error('unit_kerja_id') ?>
                            </div>
    						<div class="form-group <?=form_error('level_id') ? 'has-error' : null ?>">
    							<label>Level *</label>
                                <select name="level_id" class="form-control" >
                                    <option value="">- Pilih -</option>
                                    <?php foreach($level->result() as $key => $data) { ?>
                                        <option value="<?=$data->level_id ?>"><?=$data->level?></option>
                                    <?php } ?>
                                </select>
    							<?=form_error('level_id') ?>
    						</div>
                            <div class="form-group <?=form_error('is_active') ? 'has-error' : null ?>">
                                <label>Active *</label>
                                <select name="is_active" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Non Aktif</option>
                                </select>
                                <?=form_error('is_active') ?>
                            </div>
                            <div class="form-group <?=form_error('tahun_anggaran_id') ? 'has-error' : null ?>">
                                <label>Tahun Anggaran *</label>
                                <select name="tahun_anggaran_id" class="form-control" >
                                    <option value="">- Pilih -</option>
                                    <?php foreach($tahun_anggaran->result() as $key => $data) { ?>
                                        <option value="<?=$data->tahun_anggaran_id ?>"><?=$data->tahun ?></option>
                                    <?php } ?>
                                </select>
                                <?=form_error('tahun_anggaran_id') ?>
                            </div>
                            <div class="form-group">
                                <label>Foto Profil</label>
                                <input type="file" name="logo" class="form-control" required>
                                <?=form_error('logo') ?>
                            </div>

    						<div class="form-group">
    							<button type="submit" class="btn btn-success">
    								<i class="fa fa-paper-plane"></i> Save</button>
    							<button type="reset" class="btn btn-default">
                                    <i class="fa fa-refresh"></i> Reset</button>
    						</div>
    					</form>
    				</div>
    			</div>
    			
    		</div>
    	</div>
    </section>

<?php echo form_close(); ?>