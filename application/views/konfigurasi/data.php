<section class="content-header">
      <h1>Konfigurasi
        <small>Konfigurasi</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li>Perencanaan</li>
        <li class="active">Konfigurasi</li>
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
            <h3 class="box-title">Data Konfigurasi</h3>
            <div class="pull-right">
                <a href="<?=site_url('konfigurasi/add') ?>" class="btn btn-success">
                    <i class="fa fa-plus"></i> Create
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr class="bg-blue">
                        <th>No</th>
                        <th>Nama Web</th>
                        <th>Tag Line</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Facebook</th>
                        <th>Instagram</th>
                        <th>Twitter</th>
                        <th>Youtube</th>
                        <th>Logo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1;
                        foreach($konfigurasi->result() as $key => $data) { ?>
                    <tr>
                        <td><?=$no++ ?></td>
                        <td><?=$data->namaweb ?></td>
                        <td><?=$data->tagline ?></td>
                        <td><?=$data->email ?></td>
                        <td><?=$data->website ?></td>
                        <td><?=$data->telepon ?></td>
                        <td><?=$data->alamat ?></td>
                        <td><?=$data->facebook ?></td>
                        <td><?=$data->instagram ?></td>
                        <td><?=$data->twitter ?></td>
                        <td><?=$data->youtube ?></td>
                        <td>
                            <?php if($data->logo != null) { ?>
                            <img src="<?=base_url('assets/upload/image/'.$data->logo) ?>" width="80" class="img img-thumbnail">
                            <?php } ?>
                        </td>
                        <td>
                            <a href="<?=site_url('konfigurasi/edit/'.$data->konfigurasi_id) ?>" class="btn btn-warning btn-xs">
                                <i class="fa fa-pencil"></i> Update
                            </a>
                            <!-- <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger">
                                <i class="fa fa-trash"></i> Delete
                            </button> -->
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
      <form class="modal-danger" method="post" action="<?=site_url('konfigurasi/delete') ?>">
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
        <button type="hidden" name="konfigurasi_id" value="<?=$data->konfigurasi_id ?>" class="btn btn-outline">Ya</button>
      </div>
      </form>
    </div>
  </div>

</section>