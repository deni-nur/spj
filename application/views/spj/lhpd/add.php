<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

//error upload
if(isset($error_upload)) {
    echo '<div class="alert alert-warning">'.$errors_upload.'</div>';
}

// form open
echo form_open_multipart(base_url('lhpd/add'),' class="form-horizontal"');
?>
<section class="content-header">
  <h1>Laporan Hasil Perjalanan Dinas
    <small>Laporan Hasil Perjalanan Dinas</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>SPJ</li>
    <li class="active">Laporan Hasil Perjalanan Dinas</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <?php $this->view('messages') ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?=ucfirst($page) ?> Laporan Hasil Perjalanan Dinas</h3>
        <div class="pull-right">
            <a href="<?=base_url('lhpd') ?>" class="btn btn-warning">
                <i class="fa fa-undo"></i> Back
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                    <div class="form-group">
                        <label>Tanggal Laporan Hasil Perjalanan Dinas *</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="tanggal_lhpd" value="<?=date('Y-m-d') ?>" class="form-control" required>
                            </div>
                        </div>
                    <div>
                    <div class="form-group">
                        <label>Maksud Perjalanan Dinas *</label>
                        <input type="hidden" name="surat_tugas_id" id="surat_tugas_id">
                        <textarea name="maksud" id="maksud" rows="5" class="form-control" required readonly></textarea>
                        <span class="input-group-btn btn-group-vertical">
                            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-surat_tugas"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <div class="form-group">
                    <label>Hari *</label>
                        <select name="hari" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis </option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kegiatan *</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="tanggal_kegiatan" value="<?=date('Y-m-d') ?>" class="form-control" required>
                            </div>
                        </div>
                    <div>
                    <div class="form-group">
                        <label>Waktu *</label>
                        <input type="text" name="waktu" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tempat *</label>
                        <input type="text" name="tempat" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Laporan Hasil Perjalanan Dinas *</label>
                        <textarea name="hasil_kegiatan" rows="7" class="form-control" required></textarea>   
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

<div class="modal fade" id="modal-surat_tugas">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Pilih Surat Tugas</h4>
</div>
<div class="modal-body table-responsive">
    <table class="table table-bordered table-striped" id="example1" >
        <thead>
            <tr class="bg-blue">
                <th>No</th>
                <th>Dasar Surat</th>
                <th>Maksud</th>
                <th>Pegawai yang Melaksanakan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach ($surat_tugas->result() as $key => $data) { ?>
            <tr>
                <td width="5%"><?=$no++ ?>.</td>
                <td><?=$data->dasar_surat ?></td>
                <td width="50%"><?=$data->maksud ?></td>
                <td width="25%"><?=$data->name ?></td>
                <td class="text-center">
                    <button class="btn btn-xs btn-info" id="select-surat_tugas"
                    data-surat_tugas_id="<?=$data->surat_tugas_id ?>"
                    data-pegawai_id="<?=$data->pegawai_id ?>"
                    data-dasar_surat="<?=$data->dasar_surat ?>"
                    data-maksud="<?=$data->maksud ?>">
                        <i class="fa fa-check"></i> Select
                    </button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>

<script>
    $(document).ready(function() {
    $(document).on('click', '#select-surat_tugas', function() {
    var surat_tugas_id = $(this).data('surat_tugas_id');
    var pegawai_id = $(this).data('pegawai_id');
    var dasar_surat = $(this).data('dasar_surat');
    var maksud = $(this).data('maksud');
    $('#surat_tugas_id').val(surat_tugas_id);
    $('#pegawai_id').val(pegawai_id);
    $('#dasar_surat').val(dasar_surat);
    $('#maksud').val(maksud);
    $('#modal-surat_tugas').modal('hide');
})
})
</script>