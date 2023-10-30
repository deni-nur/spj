<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('sppd/add'),' class="form-horizontal"');
?>
<section class="content-header">
  <h1>Surat Perintah Perjalanan Dinas
    <small>Surat Perintah Perjalanan Dinas</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>SPJ</li>
    <li class="active">Surat Perintah Perjalanan Dinas</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <?php $this->view('messages') ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?=ucfirst($page) ?> Surat Perintah Perjalanan Dinas</h3>
        <div class="pull-right">
            <a href="<?=base_url('sppd') ?>" class="btn btn-warning">
                <i class="fa fa-undo"></i> Back
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
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
              <label>Tingkat Biaya</label>
                <select name="tingkat_biaya" class="form-control" required>
                  <option value="">- Pilih -</option>
                  <option value="APBD"> APBD</option>
                  <option value="APBN"> APBN</option>
                </select>
              </div>

              <div class="form-group">
              <label>Alat Angkutan</label>
                  <select name="alat_angkutan" class="form-control" required>
                    <option value="">- Pilih -</option>
                    <option value="Motor"> Motor</option>
                    <option value="Mobil"> Mobil</option>
                    <option value="Bus"> Bus</option>
                  </select>
                </div>
              <div>
              <label for="tempat_tujuan">Tempat Tujuan *</label>
              </div>
              <div class="form-group input-group">
                  <input type="hidden" name="kecamatan_id" id="kecamatan_id">
                  <input type="hidden" name="provinsi_id" id="provinsi_id">
                  <input type="text" name="tempat_tujuan" id="tempat_tujuan" class="form-control" required readonly>
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-tujuan"><i class="fa fa-search"></i>
                      </button>
                  </span>
              </div>
              <div class="form-group">
              <label>Lama Perjalanan Dinas</label>
                  <select name="lama_perjalanan" class="form-control" required>
                      <option value="">- Pilih -</option>
                      <option value="1"> 1</option>
                      <option value="2"> 2</option>
                      <option value="3"> 3</option>
                      <option value="4"> 4</option>
                      <option value="5"> 5</option>
                      <option value="6"> 6</option>
                      <option value="7"> 7</option>
                  </select>
                </div>
                <div class="form-group">
                    <label>Tanggal Berangkat *</label>
                       <input type="date" name="tanggal_berangkat" value="<?=date('Y-m-d') ?>" class="form-control" >
                </div>
                <div class="form-group">
                    <label>Tanggal Pulang *</label>
                       <input type="date" name="tanggal_pulang" value="<?=date('Y-m-d') ?>" class="form-control" >
                </div>
              <div>
              <label for="nama_rek">Rincian Belanja *</label>
              </div>
              <div class="form-group input-group">
                  <input type="hidden" name="belanja_id" id="belanja_id">
                  <input type="text" name="nama_rek" id="nama_rek" class="form-control" required readonly>
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-belanja"><i class="fa fa-search"></i>
                      </button>
                  </span>
              </div>
              <div class="form-group">
                  <label>Pejabat Penandatangan *</label>
                  <select name="ttd_keuangan_id" class="form-control" required>
                      <option value="">- Pilih -</option>
                      <?php foreach ($ttd_keuangan->result() as $key => $data) { ?>
                        <option value="<?=$data->ttd_keuangan_id ?>"><?=$data->name ?></option>
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

<div class="modal fade" id="modal-tujuan">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Pilih Tempat Tujuan</h4>
        </div>
        <div class="modal-body table-responsive">
            <table class="table table-bordered table-striped" id="table1" >      
                <caption>Perjalanan Dinas Dalam Daerah</caption>
                <thead>
                    <tr class="bg-blue">
                        <th>No</th>
                        <th>Kecamatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($kecamatan->result() as $key => $data) { ?>
                    <tr>
                        <td width="5%"><?=$no++ ?></td>
                        <td><?=$data->name ?></td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-info" id="select-tujuan"
                            data-kecamatan_id="<?=$data->kecamatan_id ?>"
                            data-tempat_tujuan="<?=$data->name ?>">
                                <i class="fa fa-check"></i> Select
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <table class="table table-bordered table-striped" id="table2">
                <caption>Perjalanan Dinas Luar Daerah</caption>
                <thead>
                    <tr class="bg-blue">
                        <th>No</th>
                        <th>Provinsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($provinsi->result() as $key => $data) { ?>
                    <tr>
                        <td width="5%"><?=$no++ ?></td>
                        <td><?=$data->name ?></td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-info" id="select-tujuan"
                            data-provinsi_id="<?=$data->provinsi_id ?>"
                            data-tempat_tujuan="<?=$data->name ?>">
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

<div class="modal fade" id="modal-belanja">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Pilih Belanja</h4>
</div>
<div class="modal-body table-responsive">
    <table class="table table-bordered table-striped" id="example2" >
        <thead>
            <tr>
                <th>Kode Rekening</th>
                <th>Nama Belanja</th>
                <th>Action</th>
            </tr>
            <?php 
              $i = 0; $no = 0; $a=0;
              foreach($dpa->result() as $key => $data_dpa) {
              foreach($belanja->result() as $key1 => $data_belanja) {
                  if(!empty($data_dpa->dpa_id == $data_belanja->dpa_id)) { 
                      ++$a;
                      if($a==1) { ?>
            <tr>
              <th colspan="6">[SUB KEGIATAN] <?=$data_belanja->name ?></th>
            </tr>
            <?php } ?>
        </thead>
        <tbody>
            <tr>
                <td><?=$data_belanja->kode_akun ?>.<?=$data_belanja->kode_kelompok ?>.<?=$data_belanja->kode_jenis ?>.<?=$data_belanja->kode_objek ?>.<?=$data_belanja->kode_rincian_objek ?>.<?=$data_belanja->kode_sub_rincian_objek ?></td>
                <td><?=$data_belanja->nama_sub_rincian_objek ?></td>
                <td class="text-center">
                    <button class="btn btn-xs btn-info" id="select-belanja"
                    data-belanja_id="<?=$data_belanja->belanja_id ?>"
                    data-kode_rek="<?=$data_belanja->kode_akun ?>.<?=$data_belanja->kode_kelompok ?>.<?=$data_belanja->kode_jenis ?>.<?=$data_belanja->kode_objek ?>.<?=$data_belanja->kode_rincian_objek ?>.<?=$data_belanja->kode_sub_rincian_objek ?>"
                    data-nama_rek="<?=$data_belanja->nama_sub_rincian_objek ?>">
                        <i class="fa fa-check"></i> Select
                    </button>
                </td>
            </tr>
            <?php } $i=0; } $a=0; } ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>

<script type="text/javascript">
 $(document).ready(function() {
  $("#datepicker1").datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true,
  });

   $("#datepicker2").datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true,
  });

 });

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

$(document).ready(function() {
  $(document).on('click', '#select-tujuan', function() {
      var kecamatan_id = $(this).data('kecamatan_id');
      var provinsi_id = $(this).data('provinsi_id');
      var name = $(this).data('tempat_tujuan');
      $('#kecamatan_id').val(kecamatan_id);
      $('#provinsi_id').val(provinsi_id);
      $('#tempat_tujuan').val(name);
      $('#modal-tujuan').modal('hide');
  })
})

$(document).ready(function() {
    $(document).on('click', '#select-belanja', function() {
    var belanja_id = $(this).data('belanja_id');
    var kode_rek = $(this).data('kode_rek');
    var nama_rek = $(this).data('nama_rek');
    $('#belanja_id').val(belanja_id);
    $('#kode_rek').val(kode_rek);
    $('#nama_rek').val(nama_rek);
    $('#modal-belanja').modal('hide');
  })
})
</script>