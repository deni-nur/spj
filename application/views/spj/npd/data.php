<section class="content-header">
  <h1>Nota Permintaan Dana
    <small>Data Nota Permintaan Dana</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li>SPJ</li>
    <li>NPD</li>
    <li class="active">Nota Permintaan Dana</li>
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
            <h3 class="box-title">Data Nota Permintaan Dana</h3>
            <div class="pull-right">
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr class="bg-blue">
                        <th width="2%">No</th>
                        <th>Kode Rekening</center></th>
                        <th>Program</th>
                        <th>Kegiatan</th>
                        <th>Sub Kegiatan</th>
                        <th>Actions</th>
                    </tr>      
                </thead>
                <tbody>
                    <?php $no=1; 
                        foreach($npd->result() as $key => $data) { ?>
                    <tr>
                        <td><?=$no++ ?>.</td>
                        <td><?=$data->kode_program ?>.<?=$data->kode_kegiatan ?>.<?=$data->kode ?></td>
                        <td><?=$data->nama_program ?></td>
                        <td><?=$data->nama_kegiatan ?></td>
                        <td><?=$data->name ?></td>
                        <td>
                            <a href="<?=base_url('npd/'.$data->dpa_id.'/rincian') ?>" class="btn btn-success">
                                <i class="fa fa-plus" title="Create"></i>
                            </a>
                        </td>
                    </tr> 
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>