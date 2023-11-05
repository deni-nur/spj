<section class="content-header">
      <h1>Belanja Sub Kegiatan
        <small>Data Belanja Sub Kegiatan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li>Penganggaran</li>
        <li>DPA</li>
        <li>Sub Kegiatan</li>
        <li class="active">Belanja Sub Kegiatan</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <?php $a=0;
                foreach($dpa->result() as $key => $data_dpa) {
                foreach($pagu_belanja_murni->result() as $key1 => $data_pagu) {
                if($data_dpa->dpa_id==$data_pagu->dpa_id) {
                ++$a;
                if($a==1) { ?>
            <?php }} $a=0; } ?>
            <h3 class="box-title">[SUB KEGIATAN] <?=$data_dpa->kode_program ?>.<?=$data_dpa->kode_kegiatan ?>.<?=$data_dpa->kode ?> <?=$data_dpa->name ?>
                Pagu Anggaran Sebesar <?=indo_currency($data_pagu->total_pagu_belanja_murni) ?></h3>
            <?php } ?>
        </div>
    </div>
    <?php 
    //$this->view('messages') 
    ?>
    <div id="flash" data-flash="<?=$this->session->flashdata('success'); ?>"></div>
	<div class="box">
		<div class="box-header">
            <h3 class="box-title">Data Belanja Sub Kegiatan</h3>
			<div class="pull-right">
                <a href="<?=site_url('dpa') ?>" class="btn btn-warning">
                    <i class="fa fa-undo"></i> Back
                </a>
                <a href="<?=site_url('dpa/'.$this->uri->segment(2).'/belanja/add') ?>" class="btn btn-success ">
                    <i class="fa fa-plus"></i> Create
                </a>
            </div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr class="bg-blue">
                        <th>Belanja</th>
                        <th>Pagu</th>
                        <th>RAK</th>
                        <th>Selisih</th>
                        <th>Januari</th>
                        <th>Februari</th>
                        <th>Maret</th>
                        <th>April</th>
                        <th>Mei</th>
                        <th>Juni</th>
                        <th>Juli</th>
                        <th>Agustus</th>
                        <th>September</th>
                        <th>Oktober</th>
                        <th>November</th>
                        <th>Desember</th>
                    </tr>       
                </thead>
                <tbody>
                    <?php
                        foreach ($belanja->result() as $key1 => $data_belanja) { 
                        $rak = $data_belanja->bulan1+$data_belanja->bulan2+$data_belanja->bulan3+$data_belanja->bulan4+$data_belanja->bulan5+$data_belanja->bulan6+$data_belanja->bulan7+$data_belanja->bulan8+$data_belanja->bulan9+$data_belanja->bulan10+$data_belanja->bulan11+$data_belanja->bulan12;    ?>
                    <tr>
                        <td colspan="17"><?=$data_belanja->kode_akun ?>.<?=$data_belanja->kode_kelompok ?>.<?=$data_belanja->kode_jenis ?>.<?=$data_belanja->kode_objek ?>.<?=$data_belanja->kode_rincian_objek ?>.<?=$data_belanja->kode_sub_rincian_objek ?> <?=$data_belanja->nama_sub_rincian_objek ?>
                        </td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>
                            <a href="<?=site_url('dpa/'.$data_belanja->dpa_id.'/belanja/anggaran_kas/'.$data_belanja->belanja_id) ?>" class="btn btn-info btn-sm" title="anggaran_kas">
                                <i class="fa fa-money" title="Anggaran Kas"></i>
                            </a>
                            <a href="<?=site_url('dpa/'.$data_belanja->dpa_id.'/belanja/edit/'.$data_belanja->belanja_id) ?>" class="btn btn-warning btn-sm" title="Update">
                                <i class="fa fa-pencil" title="Update"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm delete-button" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $data_belanja->belanja_id; ?>">
                              <i class="fa fa-trash" title="Delete"></i>
                            </a>
                        </td>
                        <td><?=indo_bil($data_belanja->pagu_belanja_murni) ?></td>
                        <td><?=indo_bil($rak) ?></td>
                        <td><?=indo_bil($rak-$data_belanja->pagu_belanja_murni) ?></td>
                        <td><?=indo_bil($data_belanja->bulan1) ?></td>
                        <td><?=indo_bil($data_belanja->bulan2) ?></td>
                        <td><?=indo_bil($data_belanja->bulan3) ?></td>
                        <td><?=indo_bil($data_belanja->bulan4) ?></td>
                        <td><?=indo_bil($data_belanja->bulan5) ?></td>
                        <td><?=indo_bil($data_belanja->bulan6) ?></td>
                        <td><?=indo_bil($data_belanja->bulan7) ?></td>
                        <td><?=indo_bil($data_belanja->bulan8) ?></td>
                        <td><?=indo_bil($data_belanja->bulan9) ?></td>
                        <td><?=indo_bil($data_belanja->bulan10) ?></td>
                        <td><?=indo_bil($data_belanja->bulan11) ?></td>
                        <td><?=indo_bil($data_belanja->bulan12) ?></td>
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
        $('#confirmDelete').attr('href', '<?php echo site_url('dpa/del_belanja/') ?>' + id);
    });
</script>