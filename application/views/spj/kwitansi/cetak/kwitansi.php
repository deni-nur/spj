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
    .line-title{
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
          }
    .upper {
          text-transform: uppercase;
          }
    span{
      font-weight: bold;
      margin-left: 170px;
    }
    body {        
      width: 100%;         
      height: 50%;        
      margin: 0;        
      padding: 0;         
      background-color: #FAFAFA;         
      font: 8pt "Tahoma";     
    }
    * {
      box-sizing: border-box;         
      -moz-box-sizing: border-box;15.     
    }
  </style>
</head>
<body onload="print()">
  <img src="<?php echo base_url('assets/images/kuya.png') ?>" style="position: absolute ; width: 35px; height: auto;">
<table>
  <?php foreach($kwitansi->result() as $key => $data) { ?>
    <tr>
        <td rowspan="3" align="center" width="50%">
            <b>PEMERINTAH KABUPATEN SUKABUMI
                <br>DINAS TENAGA KERJA DAN TRANSMIGRASI
                <br>(DISNAKERTRANS)
                <hr class="line-title"></b>
            
        </td>
        <td rowspan="3" width="20%"></td>
        <td width="8%">Tanggal</td>
        <td width="2%">:</td>
        <td><?=format_indo($data->tanggal) ?></td>
    </tr>
    <tr>
      <td>Nomor</td>
      <td>:</td>
      <td><?=$data->nomor_bukti ?></td>
    </tr>
    <tr>
      <td>Kode Rek.</td>
      <td>:</td>
      <td><?=$data->kode_program ?>.<?=$data->kode_kegiatan ?>.<?=$data->kode ?>.<?=$data->kode_akun ?>.<?=$data->kode_kelompok ?>.<?=$data->kode_jenis ?>.<?=$data->kode_objek ?>.<?=$data->kode_rincian_objek ?>.<?=$data->kode_sub_rincian_objek ?></td>
    </tr>
</table>
<br>

<table width="100%">
  <tr>
    <td colspan="3" align="center"><b>KWITANSI (TANDA BUKTI PEMBAYARAN)</b></td>
  </tr>
  <tr>
    <td valign="top" width="15%">SUDAH TERIMA DARI</td>
    <td valign="top" width="2%">:</td>
    <td valign="top" class="upper"><b>Sub Kegiatan <?=$data->name ?> 
      <br>Pada Disnakertrans Kabupaten Sukabumi</td>
  </tr>
  <tr>
    <td>BANYAKNYA</td>
    <td>:</td>
    <td><i><b>==== <?=ucwords(number_to_words($data->biaya*$data->lama_perjalanan-$data->hasil_pajak)) ?> Rupiah ====<i><b></td>
  </tr>
  <tr>
    <td colspan="3"><b><u><?=indo_currency($data->biaya*$data->lama_perjalanan-$data->hasil_pajak) ?></u><b></td>
  </tr>
  <tr>
    <td valign="top">Yaitu untuk</td>
    <td valign="top">:</td>
    <td style="text-align: justify;">Biaya <?=$data->uraian ?></td>
  </tr>
  <?php } ?>
</table>
<br>  
<!-- <hr class="line-title">  --> 
<table width="100%" rules="all">
  <tr>
    <td colspan="3"></td>
  </tr>
  <tr>
    <td align="center" width="25%">Mengetahui / Menyetujui
      <br><b><?=$selected_pa_kpa->jabatan_ttd_keuangan ?></b>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br><b><?=$selected_pa_kpa->name ?></b>
      <br>NIP. <?=$selected_pa_kpa->nip ?>
    </td>
    <td valign="top" align="center" width="25%">
      <br><b><?=$selected_pptk->jabatan_ttd_keuangan ?>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br><?=$selected_pptk->name ?></b>
      <br>NIP. <?=$selected_pptk->nip ?>
    </td>
    <td align="center" width="20%">Lunas dibayar
      <br><b><?=$selected_bp_bpp->jabatan_ttd_keuangan ?></b>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br><b><?=$selected_bp_bpp->name ?></b>
      <br>NIP. <?=$selected_bp_bpp->nip ?>
    </td>
      <td valign="top">Sukabumi, <?=format_indo($data->tanggal) ?>
        <br>
        <br>Yang menerima
        <br>Nama <b><?=$kwitansi->name ?></b>
        <?php if(!empty($kwitansi->pangkat and $kwitansi->golongan)) { ?>
        <br>Pangkat / Golongan <b><?=$kwitansi->pangkat ?> <?=$kwitansi->golongan ?></b> 
        <?php } ?>
        <?php if(!empty($kwitansi->jabatan)) { ?>
        <br>Jabatan <b><?=$kwitansi->jabatan ?></b>
        <?php } ?>
      </td>
  </tr>
</table>    

</body>
</html>