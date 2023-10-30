<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('npd/'.$this->uri->segment(2).'/edit/'.$npd->npd_id),' class="form-horizontal"');
?>
<section class="content-header">
  <h1>Rincian NPD
    <small>Data Rincian NPD</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>SPJ</li>
    <li>NPD</li>
    <li class="active">Rincian NPD</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<?php $this->view('messages') ?>
<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?=ucfirst($page) ?> Rincian NPD</h3>
		<div class="pull-right">
			<a href="<?=site_url('npd/'.$this->uri->segment(2).'/rincian') ?>" class="btn btn-warning">
				<i class="fa fa-undo"></i> Back
			</a>
		</div>
	</div>
	<div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="form-group">
                        <label>Tanggal NPD *</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="tanggal_npd" value="<?=$npd->tanggal_npd ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="belanja_id">Nama Belanja *</label>
                        <input type="hidden" name="belanja_id" id="belanja_id" value="<?=$npd->belanja_id ?>">
                        <input type="text" name="nama_sub_rincian_objek" id="nama_sub_rincian_objek" value="<?=$npd->nama_sub_rincian_objek ?>" class="form-control" required readonly>
                        <span class="input-group-btn btn-group-vertical">
                            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-belanja"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="uraian">Uraian *</label>
                        <input type="text" name="uraian" id="maksud" value="<?=$npd->uraian ?>" class="form-control" required>
                        <input type="hidden" name="surat_tugas_id" id="surat_tugas_id" value="<?=$npd->surat_tugas_id ?>">
                        <input type="hidden" name="pengikut_id" id="pengikut_id" value="<?=$npd->pengikut_id ?>">
                        <span class="input-group-btn btn-group-vertical">
                            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-surat_tugas"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="tempat_tujuan">Tempat Tujuan</label>
                        <input type="hidden" name="sppd_id" id="sppd_id" value="<?=$npd->sppd_id ?>">
                        <input type="text" name="tempat_tujuan" id="tempat_tujuan" value="<?=$npd->tempat_tujuan ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="lama_perjalanan">Kuantitas *</label>
                        <input type="text" name="lama_perjalanan" value="<?=$npd->lama_perjalanan ?>" id="lama_perjalanan" class="form-control" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="no_rekening">Nomor Rekening *</label>
                        <input type="hidden" name="rekening_id" id="rekening_id" value="<?=$npd->rekening_id ?>">
                        <input type="text" name="no_rekening" id="no_rekening" value="<?=$npd->no_rekening ?>" class="form-control" required autofocus readonly>
                        <span class="input-group-btn btn-group-vertical">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-rekening"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="pemilik">Nama Pemilik Rekening *</label>
                        <input type="text" name="pemilik" id="pemilik" value="<?=$npd->pemilik ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="biaya">Biaya</label>
                        <input type="text" name="biaya" id="biaya" value="<?=$npd->biaya ?>" class="form-control">
                        <span class="input-group-btn btn-group-vertical">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-nilai"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="pajak">Pajak (%)</label>
                        <input type="text" name="pajak" value="<?=$npd->pajak ?>" id="pajak" class="form-control">
                    </div>

            <div>
                <button type="submit" name="submit" class="btn btn-success">
                    <i class="fa fa-paper-plane"></i> Save</button>
                <button type="reset" class="btn btn-default">
                    <i class="fa fa-refresh"></i> Reset</button>
            </div>
</div>
</section>
<?php echo form_close(); ?>

<div class="modal fade" id="modal-belanja">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Pilih Rincian Belanja</h4>
</div>
<div class="modal-body table-responsive">
    <table class="table table-bordered table-striped" id="table1" >
        <thead>
            <tr class="bg-blue">
                <th>No</th>
                <th>Kode Rekening</th>
                <th>Nama Belanja</th>
                <th>Pagu Belanja</th>
                <th>Action</th>
            </tr>
            <?php $i = 0; $no = 0; 
                foreach($dpa->result() as $key => $data_sub) {
                foreach($belanja->result() as $key2 => $data_belanja) {
                if($data_sub->name == $data_belanja->name) {
                  ++$i;
                if($i==1) { ?>
            <tr>
              <th colspan="4"><?=$data_sub->kode_program ?>.<?=$data_sub->kode_kegiatan ?>.<?=$data_sub->kode ?> <?=$data_sub->name ?></th>
            </tr>
          <?php } ?>
        </thead>
        <tbody>
            <tr>
                <td width="5%"><?=++$no; ?>.</td>
                <td><?=$data_belanja->kode_akun ?>.<?=$data_belanja->kode_kelompok ?>.<?=$data_belanja->kode_jenis ?>.<?=$data_belanja->kode_objek ?>.<?=$data_belanja->kode_rincian_objek ?>.<?=$data_belanja->kode_sub_rincian_objek ?></td>
                <td width="50%"><?=$data_belanja->nama_sub_rincian_objek ?></td>
                <td><?=indo_currency($data_belanja->pagu_belanja_murni) ?></td>
                <td class="text-center">
                    <button class="btn btn-xs btn-info" id="select-belanja"
                    data-belanja_id="<?=$data_belanja->belanja_id ?>"
                    data-kode_sub_rincian_objek="<?=$data_belanja->kode_akun ?>.<?=$data_belanja->kode_kelompok ?>.<?=$data_belanja->kode_jenis ?>.<?=$data_belanja->kode_objek ?>.<?=$data_belanja->kode_rincian_objek ?>.<?=$data_belanja->kode_sub_rincian_objek ?>"
                    data-nama_sub_rincian_objek="<?=$data_belanja->nama_sub_rincian_objek ?>">
                        <i class="fa fa-check"></i> Select
                    </button>
                </td>
            </tr>
            <?php }} $i=0; } ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modal-surat_tugas">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Select Surat Tugas</h4>
</div>
<div class="modal-body table-responsive">
    <table class="table table-bordered table-striped" id="table2" >      
        <!-- <caption><b>Pelaksana Surat Tugas</b></caption> -->
        <thead>
            <tr class="bg-blue">
                <th>No</th>
                <th>Maksud</th>
                <th>Pelaksana</th>
                <th>Tempat Tujuan</th>
                <th>Lama Perjalanan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach ($sppd->result() as $key => $data) { ?>
            <tr>
                <td width="5%"><?=$no++ ?>.</td>
                <td><?=$data->maksud ?></td>
                <td><?=$data->name ?></td>
                <td><?=$data->tempat_tujuan ?></td>
                <td><?=$data->lama_perjalanan ?></td>
                <td class="text-center">
                    <button class="btn btn-xs btn-info" id="select-sppd"
                    data-surat_tugas_id="<?=$data->surat_tugas_id ?>"
                    data-sppd_id="<?=$data->sppd_id ?>"
                    data-maksud="<?=$data->maksud ?>"
                    data-name="<?=$data->name ?>"
                    data-tempat_tujuan="<?=$data->tempat_tujuan ?>"
                    data-lama_perjalanan="<?=$data->lama_perjalanan ?>"
                    data-nip="<?=$data->nip ?>"
                    data-pangkat="<?=$data->pangkat ?>"
                    data-golongan="<?=$data->golongan ?>"
                    data-jabatan="<?=$data->jabatan ?>">
                        <i class="fa fa-check"></i> Select
                    </button>    
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <table class="table table-bordered table-striped" id="table3">
        <caption>Pengikut Surat Tugas</caption>
        <thead>
            <tr class="bg-blue">
                <th>No</th>
                <th>Maksud</th>
                <th>Pengikut</th>
                <th>Tempat Tujuan</th>
                <th>Lama Perjalanan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach ($pengikut->result() as $key => $data) { ?>
            <tr>
                <td width="5%"><?=$no++ ?>.</td>
                <td><?=$data->maksud ?></td>
                <td><?=$data->pengikut_name ?></td>
                <td><?=$data->tempat_tujuan ?></td>
                <td><?=$data->lama_perjalanan ?></td>
                <td class="text-center">
                    <button class="btn btn-xs btn-info" id="select-pengikut"
                    data-surat_tugas_id="<?=$data->surat_tugas_id ?>"
                    data-sppd_id="<?=$data->sppd_id ?>"
                    data-pengikut_id="<?=$data->pengikut_id ?>"
                    data-maksud="<?=$data->maksud ?>"
                    data-name="<?=$data->pengikut_name ?>"
                    data-tempat_tujuan="<?=$data->tempat_tujuan ?>"
                    data-lama_perjalanan="<?=$data->lama_perjalanan ?>"
                    data-nip="<?=$data->pengikut_nip ?>"
                    data-pangkat="<?=$data->pengikut_pangkat ?>"
                    data-golongan="<?=$data->pengikut_golongan ?>"
                    data-jabatan="<?=$data->pengikut_jabatan ?>">
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

<div class="modal fade" id="modal-rekening">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Select Rekening</h4>
</div>
<div class="modal-body table-responsive">
    <table class="table table-bordered table-striped" id="table4">
        <thead>
            <tr class="bg-blue">
                <th>No</th>
                <th>Nomor Rekening</th>
                <th>Nama Bank</th>
                <th>Nama Pemilik</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($rekening->result() as $i => $data) { ?>
            <tr>
                <td><?=$no++ ?></td>
                <td><?=$data->no_rekening ?></td>
                <td><?=$data->bank ?></td>
                <td><?=$data->pemilik ?></td>
                <td class="text-center">
                    <button class="btn btn-xs btn-info" id="select-rekening"
                    data-rekening_id="<?=$data->rekening_id ?>"
                    data-no_rekening="<?=$data->no_rekening ?>"
                    data-pemilik="<?=$data->pemilik ?>">
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

<div class="modal fade" id="modal-nilai">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Select Standar Biaya Perjalanan Dinas</h4>
</div>
<div class="modal-body table-responsive">
    <table class="table table-bordered table-striped" id="table5" >      
        <caption>Standar Biaya Perjalanan Dinas Dalam Daerah</caption>
        <thead>
            <tr class="bg-blue">
                <th>No</th>
                <th>Golongan</th>
                <th>Kecamatan</th>
                <th>Standar Biaya</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach ($dalam_daerah->result() as $key => $data) { ?>
            <tr>
                <td width="5%"><?=$no++ ?>.</td>
                <td><?=$data->golongan ?></td>
                <td><?=$data->name ?></td>
                <td><?=indo_currency($data->biaya) ?></td>
                <td class="text-center">
                    <button class="btn btn-xs btn-info" id="select-nilai"
                    data-dalam_daerah_id="<?=$data->dalam_daerah_id ?>"
                    data-biaya="<?=$data->biaya ?>">
                        <i class="fa fa-check"></i> Select
                    </button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <table class="table table-bordered table-striped" id="table6">
        <caption>Standar Biaya Perjalanan Dinas Luar Daerah</caption>
        <thead>
            <tr class="bg-blue">
                <th>No</th>
                <th>Golongan</th>
                <th>Provinsi</th>
                <th>Standar Biaya</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach ($luar_daerah->result() as $key => $data) { ?>
            <tr>
                <td width="5%"><?=$no++ ?>.</td>
                <td><?=$data->golongan ?></td>
                <td><?=$data->name ?></td>
                <td><?=indo_currency($data->biaya) ?></td>
                <td class="text-center">
                    <button class="btn btn-xs btn-info" id="select-nilai"
                    data-luar_daerah_id="<?=$data->luar_daerah_id ?>"
                    data-biaya="<?=$data->biaya ?>">
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
    $(document).on('click', '#select-belanja', function() {
    var belanja_id = $(this).data('belanja_id');
    var kode_sub_rincian_objek = $(this).data('kode_sub_rincian_objek');
    var nama_sub_rincian_objek = $(this).data('nama_sub_rincian_objek');
    $('#belanja_id').val(belanja_id);
    $('#kode_sub_rincian_objek').val(kode_sub_rincian_objek);
    $('#nama_sub_rincian_objek').val(nama_sub_rincian_objek);
    $('#modal-belanja').modal('hide');
  })
})

$(document).ready(function() {
$(document).on('click', '#select-sppd', function() {
    var surat_tugas_id = $(this).data('surat_tugas_id');
    var sppd_id = $(this).data('sppd_id');
    var pengikut_id = $(this).data('pengikut_id');
    var maksud = $(this).data('maksud');
    var name = $(this).data('name');
    var tempat_tujuan = $(this).data('tempat_tujuan');
    var lama_perjalanan = $(this).data('lama_perjalanan');
    var nip = $(this).data('nip');
    var pangkat = $(this).data('pangkat');
    var golongan = $(this).data('golongan');
    var jabatan = $(this).data('jabatan');
    $('#surat_tugas_id').val(surat_tugas_id);
    $('#sppd_id').val(sppd_id);
    $('#pengikut_id').val(pengikut_id);
    $('#maksud').val(maksud);
    $('#name').val(name);
    $('#tempat_tujuan').val(tempat_tujuan);
    $('#lama_perjalanan').val(lama_perjalanan);
    $('#nip').val(nip);
    $('#pangkat').val(pangkat);
    $('#golongan').val(golongan);
    $('#jabatan').val(jabatan);
    $('#modal-surat_tugas').modal('hide');
})
})

$(document).ready(function() {
$(document).on('click', '#select-pengikut', function() {
    var surat_tugas_id = $(this).data('surat_tugas_id');
    var sppd_id = $(this).data('sppd_id');
    var pengikut_id = $(this).data('pengikut_id');
    var maksud = $(this).data('maksud');
    var pengikut_name = $(this).data('name');
    var tempat_tujuan = $(this).data('tempat_tujuan');
    var lama_perjalanan = $(this).data('lama_perjalanan');
    var nip = $(this).data('nip');
    var pangkat = $(this).data('pangkat');
    var golongan = $(this).data('golongan');
    var jabatan = $(this).data('jabatan');
    $('#surat_tugas_id').val(surat_tugas_id);
    $('#sppd_id').val(sppd_id);
    $('#pengikut_id').val(pengikut_id);
    $('#maksud').val(maksud);
    $('#name').val(pengikut_name);
    $('#tempat_tujuan').val(tempat_tujuan);
    $('#lama_perjalanan').val(lama_perjalanan);
    $('#nip').val(nip);
    $('#pangkat').val(pangkat);
    $('#golongan').val(golongan);
    $('#jabatan').val(jabatan);
    $('#modal-surat_tugas').modal('hide');
})
})

$(document).ready(function() {
$(document).on('click', '#select-rekening', function() {
    var rekening_id = $(this).data('rekening_id');
    var no_rekening = $(this).data('no_rekening');
    var pemilik = $(this).data('pemilik');
    $('#rekening_id').val(rekening_id);
    $('#no_rekening').val(no_rekening);
    $('#pemilik').val(pemilik);
    $('#modal-rekening').modal('hide');
})
})

$(document).ready(function() {
$(document).on('click', '#select-nilai', function() {
    var dalam_daerah_id = $(this).data('dalam_daerah_id');
    var luar_daerah_id = $(this).data('luar_daerah_id');
    var biaya = $(this).data('biaya');
    $('#dalam_daerah_id').val(dalam_daerah_id);
    $('#luar_daerah_id').val(luar_daerah_id);
    $('#biaya').val(biaya);
    $('#modal-nilai').modal('hide');
})
})
</script>
