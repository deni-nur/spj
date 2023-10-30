<section class="content-header">
  <h1>Pejabat
    <small>Penandatangan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>Master</li>
    <li>Pejabat Penandatangan</li>
    <li class="active">Administrasi</li>
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
			<h3 class="box-title">Data Pejabat Penandatangan</h3>
			<div class="pull-right">
				<a href="<?=site_url('ttd_administrasi/add') ?>" class="btn btn-success">
					<i class="fa fa-plus"></i> Create
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="table1">
				<thead>
					<tr class="bg-blue">
						<th>No</th>
						<th width="20%">Nama Pegawai</th>
						<th>Pangkat / Gol</th>
						<th>Jabatan TTD Administrasi</th>
						<th>Image TTE</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				 <?php $no =1;
					foreach($ttd_administrasi->result() as $key => $data) { ?>
					<tr>
						<td style="width: 5%"><?=$no++ ?>.</td>
						<td><?=$data->name ?></td>
						<td><?=$data->pangkat ?> <?=$data->golongan ?></td>
						<td><?=$data->jabatan_ttd_administrasi ?></td>
						<td><img src="<?php echo base_url('assets/upload/image/thumbs/'.$data->foto)?>" width="100" class="img img-thumbnail"></td>
						<td class="text-center" width="60px">
	    					<a href="<?=site_url('ttd_administrasi/edit/'.$data->ttd_administrasi_id) ?>" class="btn btn-warning btn-sm">
	    						<i class="fa fa-pencil" title="Update"></i>
	    					</a>
	    					<a href="#" class="btn btn-danger btn-sm delete-button" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $data->ttd_administrasi_id; ?>">
                  <i class="fa fa-trash" title="Delete"></i>
						</td>
					</tr>
					<?php
					} ?>
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
        $('#confirmDelete').attr('href', '<?php echo site_url('ttd_administrasi/del_ttd_administrasi/') ?>' + id);
    });
</script>