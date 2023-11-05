<section class="content-header">
      <h1>Kwitansi
        <small>Kwitansi</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li>SPJ</li>
        <li class="active">Kwitansi</li>
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
      <h3 class="box-title">Data Kwitansi</h3>
      <div class="pull-right">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-cetak"><i class="fa fa-print"></i> Cetak</button>
        <a href="<?=site_url('kwitansi/'.$this->uri->segment(2).'/belanja') ?>" class="btn btn-warning">
          <i class="fa fa-undo"></i> Back
        </a>
        <a href="<?=base_url('kwitansi/'.$this->uri->segment(2).'/belanja/'.$this->uri->segment(4).'/add') ?>" class="btn btn-success">
          <i class="fa fa-plus"></i> Create
        </a>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="table1">
        <thead>
          <tr class="bg-blue">
            <th width="5%">No</th>
            <th>Uraian</th>
            <th width="18%">Name</th>
            <th width="10%">Nominal</th>
            <th width="13%">Tanggal</th>
            <th width="5%">Actions</th>
          </tr>
        </thead>
        <tbody>
         <?php $no =1;
          foreach($kwitansi->result() as $key => $data) { ?>
          <tr>
            <td><?=$no++; ?>.</td>
            <td><?=$data->uraian ?></td>
            <td><?=$data->pemilik ?></td>
            <td align="right"><?=indo_currency($data->biaya*$data->lama_perjalanan-$data->hasil_pajak) ?></td>
            <td><?=format_indo($data->tanggal) ?></td>
            <td>
              <a href="<?=site_url('kwitansi/'.$this->uri->segment(2).'/belanja/'.$this->uri->segment(4).'/edit/'.$data->kwitansi_id) ?>" class="btn btn-warning btn-sm">
                <i class="fa fa-pencil" title="Update"></i> 
              </a>
              <a href="#" class="btn btn-danger btn-sm delete-button" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $data->kwitansi_id; ?>">
                <i class="fa fa-trash" title="Delete"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
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
        <h4 class="modal-title">Cetak Kwitansi</h4>
    </div>

    <form action="<?=base_url('kwitansi/'.$data->kwitansi_id.'/belanja/'.$data->belanja_id.'/cetak') ?>" method="get" accept-charset="utf-8">
    <div class="modal-body table-responsive">
        <div class="col-md-12">
        <div class="form-group">
            <label>Pilih Tanggal *</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                <input type="date" name="tanggal" value="" class="form-control">
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

        <div class="form-group">
          <label>BP/BPP </label>
              <select name="bp_bpp" class="form-control">
                  <option value="">- Pilih -</option>
                  <?php foreach ($ttd_keuangan->result() as $data) { ?>
                  <option value="<?=$data->ttd_keuangan_id ?>"><?=$data->name ?></option>
                  <?php } ?>
              </select>
        </div>

        <div class="form-group">
          <label>Pilih Cetak *</label>
            <select name="format_cetak" class="form-control" required>
              <option value="">- Pilih -</option>
              <option value="kwitansi">Kwitansi</option>
              <option value="kwitansi_mamin_fc">Kwitansi Mamin dan FC</option>
              <option value="kwitansi_dinas_biasa">Kwitansi Dinas Biasa</option>
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
        $('#confirmDelete').attr('href', '<?php echo site_url('kwitansi/del_kwitansi/') ?>' + id);
    });
</script>