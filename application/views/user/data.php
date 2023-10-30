<section class="content-header">
      <h1>Users
        <small>Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Users</li>
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
    			<h3 class="box-title">Data Users</h3>
    			<div class="pull-right">
    				<a href="<?=site_url('user/add') ?>" class="btn btn-success">
    					<i class="fa fa-user-plus"></i> Create
    				</a>
    			</div>
    		</div>
    		<div class="box-body table-responsive">
    			<table class="table table-bordered table-striped" id="table1">
    				<thead>
    					<tr class="bg-blue">
    						<th>No</th>
    						<th>Username</th>
    						<th>Name</th>
    						<th>Unit Kerja</th>
    						<th>Level</th>
                <th>Is Active</th>
                <th>Tahun Anggaran</th>
                <th>Foto Profile</th>
    						<th>Actions</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php $no =1;
    					foreach($row->result() as $key => $data) { ?>
    					<tr>
    						<td style="width: 5%"><?=$no++ ?>.</td>
    						<td><?=$data->username ?></td>
    						<td><?=$data->name ?></td>
    						<td><?=$data->unit_kerja ?></td>
    						<td><?=$data->level ?></td>
                <td><?=$data->is_active == 1 ? "Aktif" : "Non Aktif" ?></td>
                <td><?=$data->tahun ?></td>
                <td>
                    <?php if($data->logo != null) { ?>
                    <img src="<?=base_url('assets/upload/image/'.$data->logo) ?>" width="80" class="img img-thumbnail">
                    <?php } ?>
                </td>
    						<td class="text-center" width="160px">
	    						<a href="<?=site_url('user/edit/'.$data->user_id) ?>" class="btn btn-warning btn-xs">
	    							<i class="fa fa-pencil"></i> Update
	    						</a>
                  <a href="<?=site_url('user/changepassword/'.$data->user_id) ?>" class="btn btn-info btn-xs" title="Change Password">
                      <i class="fa fa-key"></i> 
                  </a>

                  <?php if($data->level_id != 1) { ?>
	    						<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger">
                      <i class="fa fa-trash"></i> Delete
                  </button>
                  <?php } ?>
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
      <form class="modal-danger" method="post" action="<?=site_url('user/delete') ?>">
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
        <button type="hidden" name="user_id" value="<?=$data->user_id ?>" class="btn btn-outline">Ya</button>
      </div>
      </form>
    </div>
  </div>

    </section>