<section class="content-header">
  <h1>Kwitansi
    <small>Kwitansi</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>SPJ</li>
    <li class="active">Kwitansi</li>
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
    <h3 class="box-title">Data Kwitansi</h3>
    <div class="pull-right">
</div>
</div>

  <div class="box-body table-responsive">
    <table class="table table-bordered table-striped" id="table1">
        <thead>
          <tr class="bg-blue">
              <th width="5%">No</th>
              <th>Sub Kegiatan</th>
              <th>Realisasi</th>
              <th width="5%">Actions</th>
          </tr>
        </thead>
        <tbody> 
        <?php $no=1; $a=0;
            foreach($kwitansi->result() as $key1 => $data) { ?>
            
              <tr>
                  <td><?=$no++; ?>.</td>
                  <td><?=$data->kode_program ?>.<?=$data->kode_kegiatan ?>.<?=$data->kode ?> <?=$data->name ?></td>
                  <td><?=indo_currency($data->total_belanja) ?></td>
                  <td align="center">
                    <a href="<?=site_url('kwitansi/'.$data->dpa_id.'/belanja') ?>" class="btn btn-info btn-sm">
                      <i class="fa fa-eye" title="Kwitansi"></i>
                    </a>
                  </td>
              </tr>
          <?php } ?>
        </tbody>
      </table>
  </div>
</div>
</section>