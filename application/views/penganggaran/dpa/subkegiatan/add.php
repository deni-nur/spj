<?php
// notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

// form open
echo form_open(base_url('dpa/add'),' class="form-horizontal"');
?>
<section class="content-header">
  <h1>Dokumen Pelaksanaan Anggaran
    <small>Data DPA</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>Penganggaran</li>
    <li>DPA</li>
    <li class="active">Sub Kegiatan</li>
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
            <h3 class="box-title"><?=ucfirst($page) ?> DPA</h3>
            <div class="pull-right">
                <a href="<?=site_url('dpa') ?>" class="btn btn-warning">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">

                    <div class="form-group">
                    <label for="kode">Kode Sub Kegiatan *</label>
                        <input type="text" name="kode" id="kode" class="form-control" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="sub_kegiatan">Sub Kegiatan *</label>
                        <input type="hidden" name="kegiatan_id" id="kegiatan_id">
                        <textarea name="name" id="name" rows="5" class="form-control" required autofocus readonly></textarea>
                        <span class="input-group-btn btn-group-vertical">
                            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-sub_kegiatan"><i class="fa fa-search"></i>
                            </button>
                        </span>
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

<div>
<div class="modal fade" id="modal-sub_kegiatan">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Pilih Sub Kegiatan</h4>
</div>
<div class="modal-body table-responsive">
    <table class="table table-bordered table-striped" id="table1" >
        <thead>
            <tr class="bg-blue">
                <th>No</th>
                <th>Kode Sub Kegiatan</th>
                <th>Sub Kegiatan</th>
                <th>Action</th>
            </tr> 
        </thead>
        <tbody>
            <?php $no = 1; foreach($sub_kegiatan->result() as $key => $data) { ?>
            <tr>
                <td width="2%"><?=$no++; ?>.</td>
                <td width="18%"><?=$data->kode_program ?>.<?=$data->kode_kegiatan ?>.<?=$data->kode ?></td>
                <td><?=$data->name ?></td>
                <td width="5%" class="text-center">
                    <button class="btn btn-xs btn-info" id="select-sub_kegiatan"
                    data-kegiatan_id="<?=$data->kegiatan_id ?>"
                    data-kode="<?=$data->kode ?>"
                    data-name="<?=$data->name ?>">
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
</div>

<script>
$(document).ready(function() {
    $(document).on('click', '#select-sub_kegiatan', function() {
    var kegiatan_id = $(this).data('kegiatan_id');
    var kode = $(this).data('kode');
    var name = $(this).data('name');
    $('#kegiatan_id').val(kegiatan_id);
    $('#kode').val(kode);
    $('#name').val(name);
    $('#modal-sub_kegiatan').modal('hide');
  })
})

</script>