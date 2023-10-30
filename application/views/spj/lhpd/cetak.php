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
  <title>Laporan Hasil Perjalanan Dinas</title>
  <style type="text/css" media="print"></style>
</head>
<body onload="print()" class="padding">
  <img src="<?php echo base_url('assets/images/kuya.png') ?>" style="position: absolute ; width: 90px; height: auto;">
    <table style="width: 100%;">
        <tr>
            <td align="center">
                    <font size="3" face="Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P E M E R I N T A H &nbsp;&nbsp;K A B U P A T E N &nbsp;&nbsp;S U K A B U M I</font>
                    <br><font size="5" face="Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DINAS TENAGA KERJA DAN TRANSMIGRASI
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(DISNAKERTRANS)</font>
                    <br><font size="3" face="Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jl. Pelabuhan II Km. 6 No. 703 Telp/Fax. (0266) 226088</font>
                    <br><font size="3" face="Times New Roman" color="blue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;email : disnakertrans@sukabumikab.go.id</font>
                    <br><font size="3" face="Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUKABUMI - 43169</font>
                    <hr class="line-title">  
            </td>
        </tr>
    </table>
<table style="width: 100%; font-family: Times New Roman; font-size: 11;">
    <tr>
        <td align="center" colspan="4"><font style="font-weight: bold;">LAPORAN HASIL PERJALAN DINAS</td>
    </tr>
</table>
<br>
<b>PENDAHULUAN</b>
<table border="1" cellspacing="0">
    <thead>
        <tr>
            <th style="text-align: left;" valign="top" width="30%">Dasar</th>
            <th style="text-align: center;" width="1%" valign="top">:</th>
            <td valign="top"> Surat Perintah Tugas Nomor : <?=$data_lhpd->no_surat_tugas ?></td>
        </tr>
        <tr>
            <th style="text-align: left;" valign="top">Kepada</th>
            <th valign="top">:</th>
            <td valign="top">Dinas Tenaga Kerja dan Transmigrasi</td>
        </tr>
        <tr>
            <th style="text-align: left;" valign="top">Nama yang Melaksanakan Perjalanan Dinas</th>
            <th valign="top">:</th>
            <td valign="top"><?=$data_lhpd->name ?></td>
        </tr>
        <tr>
            <th style="text-align: left;" valign="top">NIP</th>
            <th valign="top">:</th>
            <?php if(!empty($data_lhpd->nip)) { ?>
            <td valign="top"><?=$data_lhpd->nip ?></td>
        </tr>
        <?php } ?>
        <tr>
            <th style="text-align: left;" valign="top">Jabatan</th>
            <th valign="top">:</th>
            <td valign="top"><?=$data_lhpd->jabatan ?></td>
        </tr>
        <tr>
            <th style="text-align: left;" valign="top">Pengikut</th>
            <th valign="top">:</th>
            <td valign="top"><?php $n=1; 
            foreach ($pengikut as $pengikut) : ?>
            <?=$n++ ?>. <?=$pengikut->name ?><br><?php endforeach; ?></td>
        </tr>
        <tr>
            <th style="text-align: left;" valign="top">Maksud Perjalanan Dinas</th>
            <th valign="top">:</th>
            <td valign="top" style="text-align: justify;"><?=$data_lhpd->maksud ?></td>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<br>
<b>KEGIATAN YANG DILAKSANAKAN</b>
<table border="1" cellspacing="0">
    <thead>
        <tr>
            <th style="text-align: left;" width="30%" valign="top">Hari</th>
            <th style="text-align: center;" width="1%" valign="top">:</th>
            <td valign="top"><?=$data_lhpd->hari ?></td>
        </tr>
        <tr>
            <th style="text-align: left;" valign="top">Tanggal</th>
            <th valign="top">:</th>
            <td valign="top"><?=format_indo($data_lhpd->tanggal_kegiatan) ?></td>
        </tr>
        <tr>
            <th style="text-align: left;" valign="top">Waktu</th>
            <th valign="top">:</th>
            <td valign="top"><?=$data_lhpd->waktu ?></td>
        </tr>
        <tr>
            <th style="text-align: left;" valign="top">Tempat</th>
            <th valign="top">:</th>
            <td valign="top"><?=$data_lhpd->tempat ?></td>
        </tr>
        <tr>
            <th style="text-align: left;" valign="top">Isi</th>
            <th valign="top">:</th>
            <td valign="top" style="text-align: justify;"><?=$data_lhpd->hasil_kegiatan ?></td>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<br>
<b>DOKUMENTASI</b>
<table border="1" cellspacing="0" width="100%">
  <thead>
    <?php foreach($gambar_lhpd->result() as $key => $data) { ?>
    <tr>
      <td width="50%" rowspan="7">
          <img src="<?php echo base_url('assets/upload/lhpd/'.$data->dokumentasi) ?>" style="width: 500px; height: 250px;">
      </td>
    </tr>
  <?php } ?>
  </thead>
  <tbody>

  </tbody>
</table>

<br>
Demikian Laporan ini dibuat sebagai pertanggungjawaban pelaksanaan kegiatan.
<table>
  <thead>
    <br>
    <br>
    <br>
    <tr>
      <td width="20%" colspan="3"></td>
      <td width="15%" style="text-align: center;"><?=$data_lhpd->alamat ?>, <?=format_indo($data_lhpd->tanggal_lhpd) ?></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width="20%" colspan="3"></td>
      <td width="15%" align="center">Pejabat yang Melaksanakan Tugas</td>
    </tr>
    <tr>
      <td width="20%" height="60px" colspan="3"></td>
      <td width="15%"></td>
    </tr>
    <tr>
      <td colspan="3"></td>
      <td align="center"><b><?=$data_lhpd->name ?></b></td>
    </tr>
    <?php if(!empty($data_lhpd->pangkat and $data_lhpd->golongan and $data_lhpd->nip)) { ?>
    <tr>
      <td colspan="3"></td>
      <td align="center"><?=$data_lhpd->pangkat ?> <?=$data_lhpd->golongan ?></td>
    </tr>
    <tr>
      <td colspan="3"></td>
      <td align="center">NIP. <?=$data_lhpd->nip ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>

</body>
</html>