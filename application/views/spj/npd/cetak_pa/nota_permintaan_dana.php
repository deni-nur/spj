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
      <?php foreach($dpa->result() as $key3 => $data ) { ?>
      <?php } ?>
        <tr>
            <td align="center">
                    NOTA PERMINTAAN DANA (NPD)
                    <br>UNTUK KEGIATAN <?=strtoupper($data->nama_kegiatan) ?>
            </td>
        </tr>
    </table>
<br>
<br>

<table width="100%" >
  <tbody>
    <tr>
      <td align="right" colspan="3">Lampiran : GU BP</td>
    </tr>
    <tr>
      <td width="20%">Kode Rekening</td>
      <td width="1%">:</td>
      <td><?=$data->kode_program ?>.<?=$data->kode_kegiatan ?>.<?=$data->kode ?></td>
    </tr>
    <tr>
      <td>Unit Organisasi</td>
      <td>:</td>
      <td>Dinas Tenaga Kerja dan Transmigrasi Kabupaten Sukabumi</td>
    </tr>
    <tr>
      <td>Rencana Pengeluaran Untuk</td>
      <td>:</td>
      <td>Sub Kegiatan <?=$data->name ?></td>
    </tr>
  </tbody>
</table>
<br>
<br>

<?php
$selectedYear = $this->input->get('tanggal_npd'); // Gantilah tahun yang sesuai dengan pilihan Anda
?>

<table border="1" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>KODE REKENING</th>
      <th>JENIS OBJEK BELANJA</th>
      <th>RINCIAN PENGGUNAAN ANGGARAN BELANJA</th>
      <th>JUMLAH (Rp)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $a = 0;
    foreach ($belanja->result() as $key1 => $data_belanja) {
      foreach ($npd as $data_rpp) {
        if ($data_belanja->belanja_id == $data_rpp->belanja_id) {
          // Tambahkan filter sesuai tahun
          if (date('Y-m-d', strtotime($data_rpp->tanggal_npd)) == $selectedYear) {
            $neto[] = $data_rpp->biaya * $data_rpp->lama_perjalanan;
            $total_neto = array_sum($neto);
            ++$a;
            if ($a == 1) { ?>
              <tr>
                <td><?=$data_belanja->kode_akun ?>.<?=$data_belanja->kode_kelompok ?>.<?=$data_belanja->kode_jenis ?>.<?=$data_belanja->kode_objek ?>.<?=$data_belanja->kode_rincian_objek ?>.<?=$data_belanja->kode_sub_rincian_objek ?></td>
                <td><?=$data_belanja->nama_sub_rincian_objek ?></td>
                <td><?=$data_rpp->uraian ?></td>
                <td align="center"><?=indo_bil($data_rpp->biaya * $data_rpp->lama_perjalanan) ?></td>
              </tr>
            <?php }} $a = 0;
        }
      }
    }
    ?>
  </tbody>
</table>

<br>
<br>
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