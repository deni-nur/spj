<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('akun/edit/'.$akun->akun_id),' class="form-horizontal"');
?>
<section class="content-header">
  <h1>Akun
    <small>Akun</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>Master</li>
    <li>Neraca Belanja</li>
    <li class="active">Akun</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h3 class="box-title"><?=ucfirst($page) ?> Akun</h3>
			<div class="pull-right">
				<a href="<?=site_url('akun') ?>" class="btn btn-warning">
					<i class="fa fa-undo"></i> Back
				</a>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
            <div class="form-group">
							<label>Kode Akun *</label>
							<input type="text" name="kode_akun" value="<?=$akun->kode_akun ?>" class="form-control" required>
						</div>
            <div class="form-group">
                <label>Nama Akun *</label>
                <textarea name="nama_akun" class="form-control" rows="3" required><?=$akun->nama_akun ?></textarea>
            </div>

						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-success">
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