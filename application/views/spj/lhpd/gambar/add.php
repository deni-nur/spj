<?php
// Error Warning
echo validation_errors('<div class="alert alert-warning">','</div>');

//error upload
if(isset($error_upload)) {
    echo '<div class="alert alert-warning">'.$errors_upload.'</div>';
}

// form open
echo form_open_multipart(base_url('lhpd/'.$lhpd->lhpd_id.'/gambar_add'));
?>
<section class="content-header">
    <h1>Dokumentasi LHPD
    <small>Dokumentasi LHPD</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>SPJ</li>
    <li>LHPD</li>
    <li class="active">Dokumentasi LHPD</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

	<div class="box">
		<div class="box-header">
			<h3 class="box-title"><?=ucfirst($page) ?> Dokumentasi LHPD</h3>
			<div class="pull-right">
				<a href="<?=site_url('lhpd/'.$lhpd->lhpd_id.'/gambar_data') ?>" class="btn btn-warning">
					<i class="fa fa-undo"></i> Back
				</a>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
                     
                        <input type="hidden" name="lhpd_id" value="<?=$lhpd->lhpd_id ?>" class="form-control" required>
                        
                        <div class="form-group col-md-4">
                            <label>Dokumentasi Kegiatan *</label>
                            <input type="file" name="dokumentasi" class="form-control" required>
                        </div>
                        
                        <div class="form-group col-md-12">
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