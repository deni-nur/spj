<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('surat_tugas/add'),' class="form-horizontal"');
?>
<section class="content-header">
  <h1>Surat Perintah Tugas
    <small>Surat Perintah Tugas</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>SPJ</li>
    <li>Surat Perintah Tugas</li>
    <li class="active">Pelaksanaan</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
     <?php $this->view('messages') ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page) ?> Surat Perintah Tugas</h3>
            <div class="pull-right">
                <a href="<?=site_url('surat_tugas') ?>" class="btn btn-warning">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                        
                        <div class="form-group">
                            <label>No Surat Tugas</label>
                            <input type="text" name="no_surat_tugas" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="darsur">Dasar Surat </label>
                            <textarea name="dasar_surat" class="form-control" rows="4" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>Maksud *</label>
                            <textarea name="maksud" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <!-- <label> Alamat </label> -->
                            <input type="hidden" name="alamat" class="form-control" value="Sukabumi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Pelaksana *</label>
                            <select name="pegawai_id" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <?php foreach ($pegawai->result() as $pegawai) { ?>
                                <option value="<?=$pegawai->pegawai_id ?>"><?=$pegawai->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Surat *</label>
                           <input type="date" name="tanggal_surat" value="<?=date('Y-m-d') ?>" class="form-control" >
                        </div>
                        <!-- <div class="form-group">
                            <label>Pejabat Penandatangan *</label>
                            <select name="ttd_administrasi_id" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <?php foreach ($ttd_administrasi->result() as $data) { ?>
                                <option value="<?=$data->ttd_administrasi_id ?>"><?=$data->name ?></option>
                                <?php } ?>
                            </select>
                        </div> -->
                                                                             
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