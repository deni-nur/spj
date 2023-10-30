<section class="content-header">
  <h1>Rincian Objek
    <small>Rincian Objek</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>Master</li>
    <li>Neraca Belanja</li>
    <li class="active">Rincian Objek</li>
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
			<h3 class="box-title">Data Rincian Objek</h3>
			<div class="pull-right">
				<a href="<?=site_url('rincian_objek/add') ?>" class="btn btn-success">
					<i class="fa fa-plus"></i> Create
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="table1">
				<thead>
					<tr class="bg-blue">
						<th width="2%">No</th>
                        <th>Kode Akun</th>
                        <th>Kode Kelompok</th>
                        <th>Kode Jenis</th>
                        <th>Kode Objek</th>
						<th>Kode Rincian Objek</th>
                        <th>Nama Rincian Objek</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $no =1;
                        foreach($rincian_objek->result() as $key => $data) { ?>
                        <tr>
                            <td><?=$no++ ?>.</td>
                            <td><?=$data->kode_akun ?></td>
                            <td><?=$data->kode_kelompok ?></td>
                            <td><?=$data->kode_jenis ?></td>
                            <td><?=$data->kode_objek ?></td>
                            <td><?=$data->kode_rincian_objek ?></td>
                            <td><?=$data->nama_rincian_objek ?></td>
                            <td class="text-center" width="160px">
                                <a href="<?=site_url('rincian_objek/edit/'.$data->rincian_objek_id) ?>" class="btn btn-warning btn-xs">
                                    <i class="fa fa-pencil"></i> Update
                                </a>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <?php
                        } ?>
				</tbody>
			</table>
		</div>
	</div>

    <div class="modal modal-danger fade" id="modal-danger">
  <div class="modal-dialog">
    <div class="modal-content">
        
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hapus Data ?</h4>
      </div>
      
      <div class="modal-body">
        <p>Yakin, akan menghapus data ini ?</p>
      </div>
      <form class="modal-danger" method="post" action="<?=site_url('rincian_objek/del_rincian_objek') ?>">
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
        <button type="hidden" name="rincian_objek_id" value="<?=$data->rincian_objek_id ?>" class="btn btn-outline">Ya</button>
      </div>
      </form>
    </div>
  </div>

</section>