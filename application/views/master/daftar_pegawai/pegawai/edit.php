<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('pegawai/edit/'.$pegawai->pegawai_id),' class="form-horizontal"');
?>
<section class="content-header">
  <h1>Pegawai
    <small>Data Pegawai</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>Master</li>
    <li>Daftar Pegawai</li>
    <li class="active">Pegawai</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php $this->view('messages') ?>
	<div class="box">
		<div class="box-header">
			<h3 class="box-title"><?=ucfirst($page) ?> Pegawai</h3>
			<div class="pull-right">
				<a href="<?=site_url('pegawai') ?>" class="btn btn-warning">
					<i class="fa fa-undo"></i> Back
				</a>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
						
						<div class="form-group">
							<label>NIP </label>
                <br>
                <small style="color: red">(jika tidak ada, isi dengan - )</small>
							<input type="text" name="nip" value="<?=$pegawai->nip ?>" class="form-control">
						</div>
						<div class="form-group">
							<label>Nama Pegawai *</label>
							<input type="text" name="name" value="<?=$pegawai->name ?>" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Pangkat / Golongan </label>
							<select name="pangkat_id" class="form-control" >
								<option value="">- Pilih -</option>
								<?php foreach($pangkat->result() as $key => $data) { ?>
									<option value="<?=$data->pangkat_id ?>" <?=$data->pangkat_id == $pegawai->pangkat_id ? "selected" : null ?>><?=$data->pangkat?>, <?=$data->golongan ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label>Jabatan *</label>
							<select name="jabatan_id" class="form-control" required>
								<option value="">- Pilih -</option>
								<?php foreach($jabatan->result() as $key => $data) { ?>
									<option value="<?=$data->jabatan_id?>" <?=$data->jabatan_id == $pegawai->jabatan_id ? "selected" : null ?>><?=$data->jabatan ?></option>
								<?php } ?>
							</select>
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