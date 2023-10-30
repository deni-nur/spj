<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('luar_daerah/add'),' class="form-horizontal"');
?>
<section class="content-header">
  <h1>Dalam Daerah
    <small>Data Dalam Daerah</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>Master</li>
    <li class="active">Dalam Daerah</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php $this->view('messages') ?>
	<div class="box">
		<div class="box-header">
			<h3 class="box-title"><?=ucfirst($page) ?> Dalam Daerah</h3>
			<div class="pull-right">
				<a href="<?=site_url('luar_daerah') ?>" class="btn btn-warning">
					<i class="fa fa-undo"></i> Back
				</a>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
                        <div class="form-group">
                            <label>Golongan *</label>
                            <select name="pangkat_id" class="form-control" >
                                <option value="">- Pilih -</option>
                                <?php foreach($pangkat->result() as $key => $data) { ?>
                                    <option value="<?=$data->pangkat_id ?>"><?=$data->golongan ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Provinsi *</label>
                            <select name="provinsi_id" class="form-control" >
                                <option value="">- Pilih -</option>
                                <?php foreach($provinsi->result() as $key => $data) { ?>
                                    <option value="<?=$data->provinsi_id ?>"><?=$data->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Standar Biaya *</label>
                            <input type="number" name="biaya" class="form-control" required>
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