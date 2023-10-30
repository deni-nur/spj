<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('objek/add'),' class="form-horizontal"');
?>
<section class="content-header">
  <h1>Objek
    <small>Objek</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>Master</li>
    <li>Neraca Belanja</li>
    <li class="active">Objek</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h3 class="box-title"><?=ucfirst($page) ?> Objek</h3>
			<div class="pull-right">
				<a href="<?=site_url('objek') ?>" class="btn btn-warning">
					<i class="fa fa-undo"></i> Back
				</a>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">

						<div class="form-group">
							<label>Jenis *</label>
							<select name="jenis_id" class="form-control">
								<option value="">Pilih</option>
								<?php foreach($jenis->result() as $key => $data) { ?>
									<option value="<?=$data->jenis_id ?>"><?=$data->kode_jenis ?>. <?=$data->nama_jenis ?></option>
								<?php } ?>
							</select>
						</div>
            <div class="form-group">
							<label>Kode Objek *</label>
							<input type="text" name="kode_objek" class="form-control" required>
						</div>
            <div class="form-group">
                <label>Nama Objek *</label>
                <textarea name="nama_objek" class="form-control" rows="3" required></textarea>
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