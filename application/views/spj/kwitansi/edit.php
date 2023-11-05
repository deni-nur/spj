<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('kwitansi/'.$this->uri->segment(2).'/belanja/'.$this->uri->segment(4).'/edit/'.$kwitansi->kwitansi_id),' class="form-horizontal"');
?>
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
<?php $this->view('messages') ?>
<div class="box">
  <div class="box-header">
    <h3 class="box-title"><?=ucfirst($page) ?> Permintaan Pembayaran</h3>
    <div class="pull-right">
      <a href="<?=site_url('kwitansi/'.$this->uri->segment(2).'/belanja/'.$this->uri->segment(4).'/data') ?>" class="btn btn-warning">
        <i class="fa fa-undo"></i> Back
      </a>
    </div>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
                
          <div class="form-group">
              <label>Tanggal Kwitansi *</label>
              <div class="input-group date">
                  <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" name="tanggal" value="<?=$kwitansi->tanggal ?>" class="form-control" required>
                  </div>
              </div>

            <div class="form-group">
              <label>Nomor Bukti *</label>
                  <input type="text" name="nomor_bukti" value="<?=$kwitansi->nomor_bukti ?>" class="form-control" required>
            <div>

          <div>
            <br>
          <label for="uraian" >Uraian *</label>
          </div>
          <div class=" input-group">
              <input type="text" name="uraian" value="<?=$kwitansi->uraian ?>" id="uraian" class="form-control" required>
              <input type="hidden" name="npd_id" value="<?=$kwitansi->npd_id ?>" id="npd_id" class="form-control" required>
              <span class="input-group-btn">
                  <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-npd"><i class="fa fa-search"></i>
                  </button>
              </span>
          </div>
        </div>
      </div>
          
          <div>
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

<div class="modal fade" id="modal-npd">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Select Uraian</h4>
</div>
<div class="modal-body table-responsive">
    <table class="table table-bordered table-striped" id="table3" > 
        <thead>
            <tr class="bg-blue">
                <th>No</th>
                <th>Uraian</th>
                <th>Name</th>
                <th>Biaya</th>
                <th>Kuantitas</th>
                <th>Pajak</th>
                <th>Tanggal NPD</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($npd->result() as $key => $data) { ?>
            <tr>
                <td width="5%"><?=$no++; ?>.</td>
                <td><?=$data->uraian ?></td>
                <td><?=$data->pemilik ?></td>
                <td><?=indo_bil($data->biaya) ?></td>
                <td><?=$data->lama_perjalanan ?></td>
                <td><?=indo_bil($data->hasil_pajak) ?></td>
                <td><?=indo_date($data->tanggal_npd) ?></td>
                <td class="text-center">
                    <button class="btn btn-xs btn-info" id="select-npd"
                    data-npd_id="<?=$data->npd_id ?>"
                    data-uraian="<?=$data->uraian ?>">
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
    $(document).on('click', '#select-npd', function() {
    var npd_id = $(this).data('npd_id');
    var uraian = $(this).data('uraian');
    $('#npd_id').val(npd_id);
    $('#uraian').val(uraian);
    $('#modal-npd').modal('hide');
})
})
</script>