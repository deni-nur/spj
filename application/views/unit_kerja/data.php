<section class="content-header">
      <h1>Unit Kerja
        <small>Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Unit Kerja</li>
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
    			<h3 class="box-title">Data Unit Kerja</h3>
    			<div class="pull-right">
    				<a href="<?=site_url('unit_kerja/add') ?>" class="btn btn-success">
    					<i class="fa fa-plus"></i> Create
    				</a>
    			</div>
    		</div>
    		<div class="box-body table-responsive">
    			<table class="table table-bordered table-striped" id="table1">
    				<thead>
    					<tr class="bg-blue">
    						<th>No</th>
    						<th>Unit Kerja</th>
    						<th width="20%">Actions</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php $no =1;
    					foreach($unit_kerja->result() as $key => $data) { ?>
    					<tr>
    						<td style="width: 5%"><?=$no++ ?>.</td>
    						<td><?=$data->unit_kerja ?></td>
                <td>
                  <a href="<?=site_url('unit_kerja/edit/'.$data->unit_kerja_id) ?>" class="btn btn-warning btn-xs">
                      <i class="fa fa-pencil"></i> Update
                  </a>
                  <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger">
                      <i class="fa fa-trash"></i> Delete
                  </button>
                </td>
    					</tr>
    					<?php } ?>
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
      <form class="modal-danger" method="post" action="<?=site_url('unit_kerja/delete') ?>">
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
        <button type="hidden" name="unit_kerja_id" value="<?=$data->level_id ?>" class="btn btn-outline">Ya</button>
      </div>
      </form>
    </div>
  </div>

    </section>