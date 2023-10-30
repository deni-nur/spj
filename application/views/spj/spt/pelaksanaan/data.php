<section class="content-header">
      <h1>Surat Tugas
        <small>Surat Tugas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li>SPJ</li>
        <li>SPT</li>
        <li class="active">Surat Tugas</li>
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
			<h3 class="box-title">Data Surat Tugas</h3>
			<div class="pull-right">
				<a href="<?=site_url('surat_tugas/add') ?>" class="btn btn-success">
					<i class="fa fa-plus"></i> Create
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="table1">
				<thead>
					<tr class="bg-blue">
						<th width="5%">No</th>
            <th>Dasar Surat</th>
            <th>Maksud Perjalanan Dinas</th>
            <th width="20%">Pegawai yang Melaksanakan</th>
            <th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $no =1;
          foreach($surat_tugas->result() as $key => $data) { ?>
              <tr>
                  <td style="width: 5%"><?=$no++ ?>.</td>
                  <td><?=$data->dasar_surat ?></td>
                  <td><?=$data->maksud ?></td>
                  <td><?=$data->name ?>
                    <a href="<?=site_url('surat_tugas/'.$data->surat_tugas_id.'/pengikut') ?>" class="btn btn-primary btn-sm">
                        <i class="fa fa-user-plus" title="Pengikut"></i>
                    </a>
                  </td>
                  <td class="text-center" width="60px">
                    <a href="<?=site_url('surat_tugas/edit/'.$data->surat_tugas_id) ?>" class="btn btn-warning btn-sm">
                        <i class="fa fa-pencil" title="Update"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm delete-button" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $data->surat_tugas_id; ?>">
                      <i class="fa fa-trash" title="Delete"></i>
                    </a>
                  </td>
              </tr>
              <?php } ?>
				</tbody>
			</table>
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-cetak"><i class="fa fa-print"></i> Cetak</button>
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
        $('#confirmDelete').attr('href', '<?php echo site_url('surat_tugas/del_surat_tugas/') ?>' + id);
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

<form action="<?=base_url('surat_tugas/cetak/') ?>" method="get" accept-charset="utf-8">
        
        <div class="form-group">
          <label>Surat Tugas *</label>
              <select name="surat_tugas_id" class="form-control" required>
                  <option value="">- Pilih -</option>
                  <?php foreach ($surat_tugas->result() as $data) { ?>
                  <option value="<?=$data->surat_tugas_id ?>"><?=$data->maksud ?></option>
                  <?php } ?>
              </select>
        </div>

        <div class="form-group">
          <label>Pejabat Penandatangan *</label>
              <select name="ttd_administrasi_id" class="form-control" required>
                  <option value="">- Pilih -</option>
                  <?php foreach ($ttd_administrasi->result() as $data) { ?>
                  <option value="<?=$data->ttd_administrasi_id ?>"><?=$data->name ?></option>
                  <?php } ?>
              </select>
        </div>
        
        <div class="form-group">
          <label>Pilih Cetak *</label>
            <select name="format_cetak" class="form-control" required>
              <option value="">- Pilih -</option>
              <option value="tte">TTE</option>
              <option value="spj">SPJ</option>
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










<!-- <a href="#" class="btn btn-info btn-sm cetak-button" data-toggle="modal" data-target="#cetakModal" data-id="<?php //echo $data->surat_tugas_id; ?>">
                      <i class="fa fa-print" title="Cetak"></i>
                    </a>
<div class="modal modal-info fade" id="cetakModal" tabindex="-1" role="dialog" aria-labelledby="cetakModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakModalLabel">Konfirmasi Pencetakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mencetak data ini?
            </div>

            <div class="modal-body table-responsive">
            <div class="col-md-4">

            <div class="form-group">
            <label>Pejabat Penandatangan *</label>
                <select name="ttd_administrasi_id" id="ttd_administrasi_id" class="form-control" required>
                    <option value="">- Pilih -</option>
                    <?php foreach ($ttd_administrasi->result() as $data) { ?>
                    <option value="<?=$data->ttd_administrasi_id ?>"><?=$data->name ?></option>
                    <?php } ?>
                </select>
          </div>

            <div class="form-group">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-undo"></i> Batal</button>
                <a href="#" id="confirmCetak" class="btn btn-success"><i class="fa fa-print"></i> Cetak</a>
            </div>
          </div>
        </div>


        </div>
    </div>
</div>

<script>
    $(document).on("click", ".cetak-button", function () 
    {
        var id = $(this).data('id');
        $('#confirmCetak').attr('href', '<?php //echo site_url('surat_tugas/cetak_basah/') ?>' + id);
    });
</script> -->