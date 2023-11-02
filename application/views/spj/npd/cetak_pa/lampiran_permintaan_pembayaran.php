<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DATE PICKER -->
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/bootstrap-select/dist/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/bootstrap-select/dist/css/bootstrap-select.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/bootstrap-select/dist/css/bootstrap-select.min.css">
  <title><?=$title ?></title>
  <style type="text/css" media="print">
    span{
      font-weight: bold;
      margin-left: 170px;
    }
    body {        
      width: 100%;         
      height: 100%;        
      margin: 0;        
      padding: 0;         
      background-color: #FAFAFA;         
      font: 10pt "Tahoma";     
    }
    * {
      box-sizing: border-box;         
      -moz-box-sizing: border-box;15.     
    }
    .line-title{
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
    }
  </style>
</head>

    <table width="100%">
        <tbody>
            <tr>
                <td width="5%">No</td>
                <td width="2%">:</td>
                <td width="60%"></td>
                <td width="20%">Kepada :</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td></td>
                <td colspan="2">Yth. Bendahara Pengeluaran</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td>Permintaan Pembayaran</td>
                <td colspan="2">Di</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2">Tempat</td>
            </tr>
        </tbody>
    </table>

<?php
$selectedYear = $this->input->get('tanggal_npd'); // Gantilah tahun yang sesuai dengan pilihan Anda
?>
<table class="table table-bordered table-striped" id="nilai" border="1" cellspacing="0" width="100%">
    <br>
    <br>
<thead>
    <tr>
        <th rowspan="2"><center>No</center></th>
        <th rowspan="2" width="30%"><center>Program, Kegiatan, Sub Kegiatan dan Kode Rekening</center></th>
        <th colspan="3"><center>Rekening Tujuan</center></th>
        <th colspan="3"><center>Nilai</center></th>
        <th rowspan="2"><center>Keterangan</center></th>
    </tr>
    <tr>
        <th>Nama</th>
        <th>No. Rekening</th>
        <th>Bank</th>
        <th>Neto</th>
        <th>Pajak</th>
        <th>Jumlah</th>
    </tr>
</thead>
<tbody>

    <?php
    $no = 1;
    $a = 0;
    $total_neto = 0;
    $total_pajak = 0;
    foreach ($belanja->result() as $key1 => $data_belanja) {
      foreach ($npd as $data_rpp) {
        if ($data_belanja->belanja_id == $data_rpp->belanja_id) {
          // Tambahkan filter sesuai tahun
          if (date('Y-m-d', strtotime($data_rpp->tanggal_npd)) == $selectedYear) {
            
            $total_neto += $data_rpp->biaya * $data_rpp->lama_perjalanan;
            $total_pajak += $data_rpp->hasil_pajak;
            ++$a;
            if ($a == 1) { ?>
        
        <?php } ?>
        
        <?php }}} $a=0; } ?>

        <?php 
            foreach($dpa->result() as $key => $data) {
            } ?>
            <tr>
                <th align="left" colspan="5"><?=$data->kode_program ?> <?=$data->nama_program ?></th>
                <th align="right"><?=indo_bil($total_neto) ?></th>
                <th align="right"><?=indo_bil($total_pajak) ?></th>
                <th align="right"><?=indo_bil($total_neto-$total_pajak) ?></th>
                <th></th>
            </tr>
            <tr>
                <th align="left" colspan="5"><?=$data->kode_program ?>.<?=$data->kode_kegiatan ?> <?=$data->nama_kegiatan ?></th>
                <th align="right"><?=indo_bil($total_neto) ?></th>
                <th align="right"><?=indo_bil($total_pajak) ?></th>
                <th align="right"><?=indo_bil($total_neto-$total_pajak) ?></th>
                <th></th>
            </tr>
            <tr>
                <th align="left" colspan="5"><?=$data->kode_program ?>.<?=$data->kode_kegiatan ?>.<?=$data->kode ?> <?=$data->name ?></th>
                <th align="right"><?=indo_bil($total_neto) ?></th>
                <th align="right"><?=indo_bil($total_pajak) ?></th>
                <th align="right"><?=indo_bil($total_neto-$total_pajak) ?></th>
                <th></th>
            </tr>
        
    <?php
    $no = 1;
    $a = 0;
    $b = 0;
    $total_neto = 0;
    $total_pajak = 0;
    foreach ($belanja->result() as $key1 => $data_belanja) {
      foreach ($npd as $data_rpp) {
        if ($data_belanja->belanja_id == $data_rpp->belanja_id) {
          // Tambahkan filter sesuai tahun
          if (date('Y-m-d', strtotime($data_rpp->tanggal_npd)) == $selectedYear) {
            
            $total_neto += $data_rpp->biaya * $data_rpp->lama_perjalanan;
            $total_pajak += $data_rpp->hasil_pajak;
            ++$a;
            if ($a == 1) {

        foreach ($total_belanja->result() as $key => $data_total_belanja) {
        if ($data_belanja->belanja_id == $data_total_belanja->belanja_id) {
            ++$b;
            if ($b == 1) { ?>
        <tr>
            <th align="left" colspan="5"><?=$data->kode_program ?>.<?=$data->kode_kegiatan ?>.<?=$data->kode ?>.<?=$data_belanja->kode_akun ?>.<?=$data_belanja->kode_kelompok ?>.<?=$data_belanja->kode_jenis ?>.<?=$data_belanja->kode_objek ?>.<?=$data_belanja->kode_rincian_objek ?>.<?=$data_belanja->kode_sub_rincian_objek ?> <?=$data_belanja->nama_sub_rincian_objek ?></th>
            <th align="right"><?=indo_bil($data_total_belanja->total_per_belanja) ?></th>
            <th align="right"><?=indo_bil($data_total_belanja->total_per_pajak) ?></th>
            <th align="right"><?=indo_bil($data_total_belanja->total_per_belanja-$data_total_belanja->total_per_pajak) ?></th>
            <th></th>
        </tr>
        <?php }}} $b= 0; } ?>
        <tr>
            <td align="center" valign="top"><?=$no++ ?>.</td>
            <td><?=$data_rpp->uraian ?></td>
            <td><?=$data_rpp->pemilik ?></td>
            <td><?=$data_rpp->no_rekening ?></td>
            <td align="center"><?=$data_rpp->bank ?></td>
            <td align="right"><?=indo_bil($data_rpp->biaya*$data_rpp->lama_perjalanan) ?></td>
            <td align="right"><?=indo_bil($data_rpp->hasil_pajak) ?></td>
            <td align="right"><?=indo_bil($data_rpp->biaya*$data_rpp->lama_perjalanan-$data_rpp->hasil_pajak) ?></td>
            <td></td>
        </tr>
        <?php }}} $a = 0; } ?>
       <tr>
           <td colspan="5" align="center"><b>TOTAL</td>
           <td align="right"><b><?=indo_bil($total_neto) ?></td>
           <td align="right"><b><?=indo_bil($total_pajak) ?></td>
           <td align="right"><b><?=indo_bil($total_neto-$total_pajak) ?></td>
           <td></td>
        </tr>
</tbody>
</table>


<table>
  <tbody>
    <tr>
      <td><br>Demikian atas bantuan dan kerjasama kami ucapkan terimakasih.</td>
    </tr>
  </tbody>
</table>
<br>
<table width="100%">
  <thead>
    <tr>
      <td width="50%"></td>
      <td width="50%" align="center">Sukabumi, <?=format_indo($this->input->get('tanggal_npd')) ?></td>
    </tr>
    <tr>
      <th>Mengetahui,
        <br><center><?=$selected_pa_kpa->jabatan_ttd_keuangan ?></center></th>
        <th><br><center><?=$selected_pptk->jabatan_ttd_keuangan ?></center></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <br>
        <br>
        <br>
        <br>
        <b><center><?=$selected_pa_kpa->name ?></b>
        <br>NIP. <?=$selected_pa_kpa->nip ?></center>
      </td>
      <td>
        <br>
        <br>
        <br>
        <br>
        <b><center><?=$selected_pptk->name ?></b>
        <br>NIP. <?=$selected_pptk->nip ?></center>
      </td>
    </tr>
  </tbody>
</table>
</body>
</html>