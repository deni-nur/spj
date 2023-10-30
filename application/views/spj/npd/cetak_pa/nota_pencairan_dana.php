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
<body onload="print()">

  <img src="<?php echo base_url('assets/images/kuya.png') ?>" style="position: absolute ; width: 45px; height: auto;">
    <table style="width: 100%;">
        <tr>
            <td align="center">
                    PEMERINTAH KABUPATEN SUKABUMI
                    <br>NOTA PENCAIRAN DANA (NPD)
                    <br style="text-align: justify;">Nomor :
            </td>
        </tr>
    </table>
<br>

<table cellspacing="0" border="1" width="100%">
  <tbody>
    <tr>
      <td colspan="3"><b>Bendahara Pengeluaran
      <br>SKPD</b>
      <br>Supaya mencairkan Dana Kepada:
      </td>
    </tr>
      
  </tbody>
</table>

<?php
$groupedData = array();
$a=0;

foreach ($npd as $data_rpp) {
foreach($dpa->result() as $key3 => $data_pp ) {
  if($data_rpp->dpa_id==$data_pp->dpa_id) {
  ++$a;
  if($a==1) {
    $uraian = $data_rpp->kode_akun . '.' . $data_rpp->kode_kelompok . '.' . $data_rpp->kode_jenis . '.' . $data_rpp->kode_objek . '.' . $data_rpp->kode_rincian_objek . '.' .$data_rpp->kode_sub_rincian_objek . ' - ' . $data_rpp->nama_sub_rincian_objek;

    if (!array_key_exists($uraian, $groupedData)) {
        $groupedData[$uraian] = array(
            'total_pagu' => 0,
            'total_akumulasi_sebelumnya' => 0,
            'total_pencairan_saat_ini' => 0,
        );
    }

    $groupedData[$uraian]['total_pagu'] = $data_rpp->pagu_belanja_murni;
    $groupedData[$uraian]['total_akumulasi_sebelumnya'] += $data_rpp->akumulasi_pencairan_sebelumnya;
    $groupedData[$uraian]['total_pencairan_saat_ini'] += $data_rpp->pencairan_saat_ini;

}}} $a=0; } ?>

        <?php
        $no = 1;
        foreach ($groupedData as $uraian => $totals) {

          $pagu[]   = $totals['total_pagu']; $total_pagu = array_sum($pagu);
          $akumulasi[] = $totals['total_akumulasi_sebelumnya']; $total_akumulasi = array_sum($akumulasi);
          $pencairan[] = $totals['total_pencairan_saat_ini']; $total_pencairan = array_sum($pencairan);
          $jumlah[] = $totals['total_akumulasi_sebelumnya'] + $totals['total_pencairan_saat_ini']; $total_jumlah = array_sum($jumlah);
          $sisa[] = $totals['total_pagu'] - $totals['total_akumulasi_sebelumnya'] - $totals['total_pencairan_saat_ini']; $total_sisa = array_sum($sisa);

        $uraian_parts = explode(' - ', $uraian);
        $kode_rekening = $uraian_parts[0];
        $uraian_text = $uraian_parts[1];
        ?>
            
        <?php
        }
        ?>

<table rules="none" border="1" width="100%" >
  <tbody>
    <tr>
      <td width="2%">1.</td>
      <td width="20%">Pejabat Pelaksana Kegiatan</td>
      <td width="1%">:</td>
      <td><?=$selected_pptk->name ?></td>
    </tr>
    <?php
          foreach($dpa->result() as $key3 => $data_pp ) { 
    } ?>
    <tr>
      <td>2.</td>
      <td>Program</td>
      <td>:</td>
      <td><?=$data_pp->nama_program ?></td>
    </tr>
    <tr>
      <td>3.</td>
      <td>Kegiatan</td>
      <td>:</td>
      <td><?=$data_pp->nama_kegiatan ?></td>
    </tr>
    <tr>
      <td>4.</td>
      <td>Sub Kegiatan</td>
      <td>:</td>
      <td><?=$data_pp->name ?></td>
    </tr>
    <tr>
      <td>5.</td>
      <td>Nomor DPA/DPPA-SKPD</td>
      <td>:</td>
      <td></td>
    </tr>
    <?php
        foreach($npd as $data_rpp) { ?>
    <?php } ?>
    <tr>
      <td>6.</td>
      <td>Tahun Anggaran</td>
      <td>:</td>
      <td> <?=year_date($data_rpp->tanggal_npd) ?></td>
    </tr>
    <tr>
      <td>7.</td>
      <td>Jumlah Dana yang diminta</td>
      <td>:</td>
      <td><b><?=indo_bil($total_pencairan) ?> - ( AKUMULASI PENCAIRAN )</b></td>
    </tr>
    </tbody>
</table>

<table rules="none" border="1" width="100%">
    <th align="center">PEMBEBANAN PADA KODE REKENING</th>
</table>

<?php
$groupedData = array();
$a=0;

foreach ($npd as $data_rpp) {
foreach($dpa->result() as $key3 => $data_pp ) {
  if($data_rpp->dpa_id==$data_pp->dpa_id) {
  ++$a;
  if($a==1) {
    $uraian = $data_rpp->kode_akun . '.' . $data_rpp->kode_kelompok . '.' . $data_rpp->kode_jenis . '.' . $data_rpp->kode_objek . '.' . $data_rpp->kode_rincian_objek . '.' .$data_rpp->kode_sub_rincian_objek . ' - ' . $data_rpp->nama_sub_rincian_objek;

    if (!array_key_exists($uraian, $groupedData)) {
        $groupedData[$uraian] = array(
            'total_pagu' => 0,
            'total_akumulasi_sebelumnya' => 0,
            'total_pencairan_saat_ini' => 0,
        );
    }

    $groupedData[$uraian]['total_pagu'] = $data_rpp->pagu_belanja_murni;
    $groupedData[$uraian]['total_akumulasi_sebelumnya'] += $data_rpp->akumulasi_pencairan_sebelumnya;
    $groupedData[$uraian]['total_pencairan_saat_ini'] += $data_rpp->pencairan_saat_ini;

}}} $a=0; } ?>
<table border="1" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th width="2%">NO. URUT</th>
            <th>KODE REKENING</th>
            <th>URAIAN</th>
            <th>ANGGARAN (Rp)</th>
            <th>AKUMULASI PENCAIRAN SEBELUMNYA (Rp)</th>
            <th>PENCAIRAN SAAT INI (Rp)</th>
            <th>JUMLAH</th>
            <th>SISA (Rp)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($groupedData as $uraian => $totals) {

        $uraian_parts = explode(' - ', $uraian);
        $kode_rekening = $uraian_parts[0];
        $uraian_text = $uraian_parts[1];
        ?>
            <tr>
                <td align="center"><?= $no++; ?>.</td>
                <td><?= $kode_rekening ?></td>
                <td><?= $uraian_text ?></td>
                <td align="right"><?= indo_bil($totals['total_pagu']) ?></td>
                <td align="right"><?= indo_bil($totals['total_akumulasi_sebelumnya']) ?></td>
                <td align="right"><?= indo_bil($totals['total_pencairan_saat_ini']) ?></td>
                <td align="right"><?= indo_bil($totals['total_akumulasi_sebelumnya'] + $totals['total_pencairan_saat_ini']) ?></td>
                <td align="right"><?= indo_bil($totals['total_pagu'] - $totals['total_akumulasi_sebelumnya'] - $totals['total_pencairan_saat_ini']) ?></td>
            </tr>
        <?php
        }
        ?>
        <tr>
            <td></td>
            <td colspan="2" align="center"><b>JUMLAH</b></td>
            <td align="right"><b><?=indo_bil($total_pagu) ?></b></td>
            <td align="right"><b><?=indo_bil($total_akumulasi) ?></b></td>
            <td align="right"><b><?=indo_bil($total_pencairan) ?></b></td>
            <td align="right"><b><?=indo_bil($total_jumlah) ?></b></td>
            <td align="right"><b><?=indo_bil($total_sisa) ?></b></td>
        </tr>
    </tbody>
</table>

<br>
<br>
<br>

<table cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td></td>
      <td align="center">Sukabumi, <?=format_indo($this->input->get('tanggal_npd')) ?></td>
    </tr>
    <tr>
      <td width="50%"><center>
        <?=$selected_pa_kpa->jabatan_ttd_keuangan ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br><b><?=$selected_pa_kpa->name ?></b>
        <br>NIP. <?=$selected_pa_kpa->nip ?>
      </center>
      </td>
      <td><center>
        <?=$selected_pptk->jabatan_ttd_keuangan ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br><b><?=$selected_pptk->name ?></b>
        <br>NIP. <?=$selected_pptk->nip ?>
      </center>
      </td>
    </tr> 
  </tbody>
</table>
</body>
</html>