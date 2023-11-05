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
			<h3 class="box-title">Dokumen Pelaksanaan Anggaran</h3>
			<div class="pull-right">
				<a href="<?=site_url('dpa/add') ?>" class="btn btn-success">
					<i class="fa fa-plus"></i> Create
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="table1">
				<thead>
					<tr class="bg-blue">
                        <th>No</th>
						<th>Program</th>
                        <th>Kegiatan</th>
                        <th>Sub Kegiatan</th>
                        <th>Pagu Anggaran</th>
						<th width="8%">Actions</th>
					</tr>
				</thead>
				<tbody>	
                    <?php $no=1; $a=0;
                        foreach($dpa->result() as $key => $data) { ?>
                    <tr>
                        <td><?=$no++; ?>.</td>
                        <td><?=$data->kode_program ?> <?=$data->nama_program ?></td>
                        <td><?=$data->kode_kegiatan ?> <?=$data->nama_kegiatan ?></td>
                        <td><?=$data->kode ?> <?=$data->name ?></td>
                        <td><?=indo_bil($data->total_pagu_belanja_murni) ?></td>
                        <td class="text-center" width="160px">
                            <a href="<?=site_url('dpa/'.$data->dpa_id.'/belanja') ?>" class="btn btn-info btn-sm">
                                <i class="fa fa-plus" title="Rincian Belanja"></i> 
                            </a>
                            <a href="<?=site_url('dpa/edit/'.$data->dpa_id) ?>" class="btn btn-warning btn-sm">
                                <i class="fa fa-pencil" title="Update"></i> 
                            </a>
                            <a href="#" class="btn btn-danger btn-sm delete-button" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $data->dpa_id; ?>">
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
        $('#confirmDelete').attr('href', '<?php echo site_url('dpa/del_dpa/') ?>' + id);
    });
</script>