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
  <?php 
    //$this->view('messages') 
    ?>
    <div id="flash" data-flash="<?=$this->session->flashdata('success'); ?>"></div>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Data Surat Perintah Perjalanan Dinas</h3>
    <div class="pull-right">
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-cetak"><i class="fa fa-print"></i> Cetak</button>
      <a href="<?=base_url('sppd/add') ?>" class="btn btn-success">
        <i class="fa fa-plus"></i> Create
      </a>
</div>
</div>

  <div class="box-body table-responsive">
    <table class="table table-bordered table-striped" id="table1">
      <thead>
        <tr class="bg-blue">
          <th>No</th>
          <th>Maksud Perjalanan Dinas</th>
          <th>Tempat Tujuan</th>
          <th>Lama Perjalanan</th>
          <th>Tanggal Berangkat</th>
          <th>Tanggal Kembali</th>
          <th width="5%">Actions</th>
        </tr>
      </thead>
      <tbody>
       <?php $no=1; foreach ($sppd->result() as $key => $data) { ?>
      <tr>
          <td width="10px"><?=$no++ ?>.</td>
          <td><?=$data->maksud ?></td>
          <td><?=$data->tempat_tujuan ?></td>
          <td><?=$data->lama_perjalanan ?> ( hari )</td>
          <td><?=format_indo($data->tanggal_berangkat) ?></td>
          <td><?=format_indo($data->tanggal_pulang) ?></td>
          <td>
          <a href="<?=site_url('sppd/edit/'.$data->sppd_id) ?>" class="btn btn-warning btn-sm">
          <i class="fa fa-pencil" title="Update"></i>
          </a>
          <a href="#" class="btn btn-danger btn-sm delete-button" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $data->sppd_id; ?>">
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
        $('#confirmDelete').attr('href', '<?php echo site_url('sppd/del_sppd/') ?>' + id);
    });
</script>


<div class="modal modal-info fade" id="modal-cetak">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cetak </h4>
    </div>
    <div class="modal-body table-responsive">
      <div class="col-md-12">

<form action="<?=base_url('sppd/cetak/') ?>" method="get" accept-charset="utf-8">
        
        <div class="form-group">
          <label>Surat Tugas *</label>
              <select name="sppd_id" class="form-control" required>
                  <option value="">- Pilih -</option>
                  <?php foreach ($sppd->result() as $data) { ?>
                  <option value="<?=$data->sppd_id ?>"><?=$data->maksud ?></option>
                  <?php } ?>
              </select>
        </div>

        <div class="form-group">
          <label>Pejabat Penandatangan *</label>
              <select name="ttd_keuangan_id" class="form-control" required>
                  <option value="">- Pilih -</option>
                  <?php foreach ($ttd_keuangan->result() as $data) { ?>
                  <option value="<?=$data->ttd_keuangan_id ?>"><?=$data->name ?></option>
                  <?php } ?>
              </select>
        </div>
               
        <div class="form-group">
            <button type="submit" name="" class="btn btn-success">
            <i class="fa fa-print"></i> Cetak</button>
        </div>
  </form>
</div>
</div>
</div>
</div>
</div>