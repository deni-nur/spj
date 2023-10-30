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
<?php 
    //$this->view('messages') 
    ?>
    <div id="flash" data-flash="<?=$this->session->flashdata('success'); ?>"></div>
<div class="box">
<div class="box-header">
  <h3 class="box-title">Data Laporan Hasil Perjalanan Dinas</h3>
  <div class="pull-right">
    <a href="<?=base_url('lhpd/add') ?>" class="btn btn-success">
        <i class="fa fa-plus"></i> Create
      </a>
</div>
</div>

<div class="box-body table-responsive">
  <table class="table table-bordered table-striped" id="table1">
    <thead>
      <tr class="bg-blue">
        <th width="5%">No</th>
        <th>Maksud Perjalanan Dinas</th>
        <th>Hasil Kegiatan</th>
        <th width="10%">Actions</th>
      </tr>
    </thead>
    <tbody>
     <?php $no=1; foreach ($lhpd->result() as $key => $data) { ?>
    <tr>
        <td><?=$no++ ?>.</td>
        <td><?=$data->maksud ?></td>
        <td><?=$data->hasil_kegiatan ?>
          <a href="<?=site_url('lhpd/'.$data->lhpd_id.'/gambar_data') ?>" class="btn btn-info btn-sm">
            <i class="fa fa-plus" title="Dokumentasi"> Dokumentasi</i> 
          </a>
        </td>
        <td>
          <a href="<?=site_url('lhpd/cetak/'.$data->lhpd_id.'/'.$data->surat_tugas_id) ?>" class="btn btn-primary btn-sm">
          <i class="fa fa-print" title="Cetak"></i>
          </a>
          <a href="<?=site_url('lhpd/edit/'.$data->lhpd_id) ?>" class="btn btn-warning btn-sm">
          <i class="fa fa-pencil" title="Update"></i>
          </a>
          <a href="#" class="btn btn-danger btn-sm delete-button" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $data->lhpd_id; ?>">
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
        $('#confirmDelete').attr('href', '<?php echo site_url('lhpd/del_lhpd/') ?>' + id);
    });
</script>