<section class="content-header">
  <h1>Kwitansi Belanja
    <small>Data Kwitansi Belanja</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>SPJ</li>
    <li class="active">Kwitansi Belanja</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php 
    //$this->view('messages') 
    ?>
    <div id="flash" data-flash="<?=$this->session->flashdata('success'); ?>">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Kwitansi Belanja</h3>
            <div class="pull-right">
            <a href="<?=site_url('kwitansi') ?>" class="btn btn-warning">
                <i class="fa fa-undo"></i> Back
            </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr class="bg-blue">
                        <th width="1%">No</th>
                        <th>Belanja</center></th>
                        <th width="10%">Realisasi</th>
                        <th width="5%">Actions</th>
                    </tr> 
                </thead>
                <tbody>
                    <?php $no=1; foreach($belanja->result() as $key => $data_belanja) { ?>
                    <tr>
                        <td><?=$no++; ?></td>
                        <td><?=$data_belanja->kode_akun ?>.<?=$data_belanja->kode_kelompok ?>.<?=$data_belanja->kode_jenis ?>.<?=$data_belanja->kode_objek ?>.<?=$data_belanja->kode_rincian_objek ?>.<?=$data_belanja->kode_sub_rincian_objek ?> <?=$data_belanja->nama_sub_rincian_objek ?></td>
                        <td><?=indo_currency($data_belanja->total_belanja) ?></td>
                        <td align="center">
                            <a href="<?=site_url('kwitansi/'.$data_belanja->dpa_id.'/belanja/'.$data_belanja->belanja_id.'/data') ?>" class="btn btn-info btn-sm">
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