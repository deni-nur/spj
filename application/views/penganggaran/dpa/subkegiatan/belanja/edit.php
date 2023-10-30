<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('dpa/'.$this->uri->segment(2).'/belanja/edit/'.$belanja->belanja_id),' class="form-horizontal"');
?>
<section class="content-header">
  <h1>Belanja Sub Kegiatan PD
    <small>Belanja Sub Kegiatan PD</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>Penganggaran</li>
    <li>DPA</li>
    <li>Sub Kegiatan</li>
    <li class="active">Belanja Sub Kegiatan PD</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?=ucfirst($page) ?> Belanja Sub Kegiatan PD</h3>
        <div class="pull-right">
            <a href="<?=site_url('dpa/'.$this->uri->segment(2).'/belanja') ?>" class="btn btn-warning">
                <i class="fa fa-undo"></i> Back
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                    
                    <div class="form-group">
                        <label>Sub Kegiatan *</label>
                        <input type="text" name="" value="<?=$dpa->kode_program ?>.<?=$dpa->kode_kegiatan ?>.<?=$dpa->kode ?> <?=$dpa->name ?>" class="form-control" required readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Belanja *</label>
                        <select name="sub_rincian_objek_id" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <?php foreach ($sub_rincian_objek->result() as $key => $data) { ?>
                                <option value="<?=$data->sub_rincian_objek_id ?>" <?=$data->sub_rincian_objek_id==$belanja->sub_rincian_objek_id ? "selected" : null ?>><?=$data->kode_akun ?>.<?=$data->kode_kelompok ?>.<?=$data->kode_jenis ?>.<?=$data->kode_objek ?>.<?=$data->kode_rincian_objek ?>.<?=$data->kode_sub_rincian_objek ?> <?=$data->nama_sub_rincian_objek ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pagu Belanja *</label>
                        <input type="number" name="pagu_belanja_murni" value="<?=$belanja->pagu_belanja_murni ?>" class="form-control" required>
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