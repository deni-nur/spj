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
    <?php 
    //$this->view('messages') 
    ?>
    <div id="flash" data-flash="<?=$this->session->flashdata('success'); ?>"></div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Rincian NPD</h3>
            <div class="pull-right">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-cetak"><i class="fa fa-print"></i> Cetak</button>
                <a href="<?=site_url('npd') ?>" class="btn btn-warning">
                <i class="fa fa-undo"></i> Back
            </a>
                <a href="<?=base_url('npd/'.$this->uri->segment(2).'/add') ?>" class="btn btn-success">
                    <i class="fa fa-plus"></i> Create
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr class="bg-blue">
                        <th width="2%">No</th>
                        <th width="40%">Uraian</center></th>
                        <th>Nama</th>
                        <th width="13%">Biaya</th>
                        <th>Pajak</th>
                        <th width="10%">Tanggal NPD</th>
                        <th width="7%">Actions</th>
                    </tr>
                    <?php $no=1; $a=0;
                            foreach($belanja->result() as $key => $data_belanja) {
                            foreach($npd->result() as $key => $data_rpp) {
                            if($data_belanja->belanja_id == $data_rpp->belanja_id) { 
                                ++$a;
                                if($a==1) { ?>
                        <tr>
                            <th colspan="3">[BELANJA] <?=$data_belanja->kode_akun ?>.<?=$data_belanja->kode_kelompok ?>.<?=$data_belanja->kode_jenis ?>.<?=$data_belanja->kode_objek ?>.<?=$data_belanja->kode_rincian_objek ?>.<?=$data_belanja->kode_sub_rincian_objek ?> <?=$data_belanja->nama_sub_rincian_objek ?></th>
                            <th colspan="3" width="10%"><?=indo_currency($data_belanja->total_belanja) ?></th>

                        </tr>
                    <?php } ?>        
                </thead>
                <tbody>
                    <tr>
                        <td><?=$no++ ?>.</td>
                        <td><?=$data_rpp->uraian ?></td>
                        <td><?=$data_rpp->pemilik ?></td>
                        <td><?=indo_currency($data_rpp->biaya) ?></td>
                        <td><?=$data_rpp->pajak ?> %</td>
                        <td><?=format_indo($data_rpp->tanggal_npd) ?></td>
                        <td>
                            <a href="<?=site_url('npd/'.$this->uri->segment(2).'/edit/'.$data_rpp->npd_id) ?>" class="btn btn-warning btn-sm">
                                <i class="fa fa-pencil" title="Update"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm delete-button" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $data_rpp->npd_id; ?>">
                                <i class="fa fa-trash" title="Delete"></i>
                            </a>
                        </td>
                    </tr> 
                    <?php }} $a=0; } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="modal modal-info fade" id="modal-cetak">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Cetak NPD</h4>
    </div>

    <form action="<?=base_url('npd/'.$data_rpp->dpa_id.'/cetak') ?>" method="get" accept-charset="utf-8">
    <div class="modal-body table-responsive">
        <div class="col-md-12">
        <div class="form-group">
            <label>Pilih Tanggal *</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                <input type="date" name="tanggal_npd" value="" class="form-control">
                </div>
        </div>
        <div>

        <div class="form-group">
          <label>PA/KPA </label>
              <select name="pa_kpa" class="form-control">
                  <option value="">- Pilih -</option>
                  <?php foreach ($ttd_keuangan->result() as $data) { ?>
                  <option value="<?=$data->ttd_keuangan_id ?>"><?=$data->name ?></option>
                  <?php } ?>
              </select>
        </div>

        <div class="form-group">
          <label>PPTK </label>
              <select name="pptk" class="form-control">
                  <option value="">- Pilih -</option>
                  <?php foreach ($ttd_keuangan->result() as $data) { ?>
                  <option value="<?=$data->ttd_keuangan_id ?>"><?=$data->name ?></option>
                  <?php } ?>
              </select>
        </div>

        <!-- <div class="form-group">
          <label>BP/BPP </label>
              <select name="bp_bpp" class="form-control">
                  <option value="">- Pilih -</option>
                  <?php foreach ($ttd_keuangan->result() as $data) { ?>
                  <option value="<?=$data->ttd_keuangan_id ?>"><?=$data->name ?></option>
                  <?php } ?>
              </select>
        </div> -->

        <div class="form-group">
          <label>Pilih Cetak *</label>
            <select name="format_cetak" class="form-control" required>
              <option value="">- Pilih -</option>
              <option value="nota_dinas">Nota Dinas</option>
              <option value="nota_pencairan_dana">Nota Pencairan Dana</option>
              <option value="nota_permintaan_dana">Nota Permintaan Dana</option>
              <option value="lampiran_permintaan_pembayaran">Lampiran Permintaan Pembayaran</option>
            </select>
        </div>
               
        <div class="form-group">
            <button type="submit" name="" class="btn btn-success">
            <i class="fa fa-print"></i> Cetak</button>
        </div>
    </div>
</div>
</div>
</form>


</div>
</div>
</div>

<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                <a href="#" id="confirmDelete" class="btn btn-outline">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".delete-button", function () {
        var id = $(this).data('id');
        $('#confirmDelete').attr('href', '<?php echo site_url('npd/del_npd/') ?>' + id);
    });
</script>