<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('kegiatan/add'),' class="form-horizontal"');
?>
<section class="content-header">
  <h1>Kegiatan
    <small>Data Kegiatan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>Master</li>
    <li>Renstra</li>
    <li class="active">Kegiatan</li>
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
			<h3 class="box-title"><?=ucfirst($page) ?> Kegiatan</h3>
			<div class="pull-right">
				<a href="<?=site_url('kegiatan') ?>" class="btn btn-warning">
					<i class="fa fa-undo"></i> Back
				</a>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
            
            <div class="form-group">
                <label>Nama Program *</label>
                <select name="program_id" class="form-control" >
                    <option value="">- Pilih -</option>
                    <?php foreach($program->result() as $key => $data) { ?>
                        <option value="<?=$data->program_id?>" ><?=$data->kode ?> <?=$data->name ?></option>
                    <?php } ?>
                </select>
            </div>            
	          <div class="form-group">
	              <label>Kode Kegiatan *</label>
	              <input type="text" name="kode" class="form-control" required>
	          </div>
						<div class="form-group">
	              <label>Nama Kegiatan *</label>
	               <textarea name="name" class="form-control" required=""></textarea>
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