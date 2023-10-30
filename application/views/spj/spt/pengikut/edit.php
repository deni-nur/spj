<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('surat_tugas/'.$this->uri->segment(2).'/pengikut/edit/'.$pengikut->pengikut_id),' class="form-horizontal"');
?>
<section class="content-header">
      <h1>Pengikut
        <small>Pengikut</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li>SPJ</li>
        <li>SPT</li>
        <li>Pelaksanaan</li>
        <li class="active">Pengikut</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
 <?php $this->view('messages') ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?=ucfirst($page) ?> Pengikut</h3>
        <div class="pull-right">
            <a onclick="javascript:history.back()" class="btn btn-warning">
                <i class="fa fa-undo"></i> Back
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                
                    <div>
                    <label for="pegawai_id">Nama Pengikut *</label>
                    </div>
                    <div class="form-group">
                        <select name="pegawai_id" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <?php foreach($pegawai->result() as $key => $data) { ?>
                                <option value="<?=$data->pegawai_id?>" <?=$data->pegawai_id==$pengikut->pegawai_id ? "selected" : null ?>><?=$data->name ?></option>
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