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
        <td align="center" ><font style="font-weight: bold;"><u>NOTA DINAS</u></td>
    </tr>
</table>
<br>
<br>

<table cellspacing="0" width="100%">
  <tbody>
    <?php $no=1; $a=0;
        foreach($belanja->result() as $key => $data_belanja) {
        foreach($npd as $data_rpp) {
        if($data_belanja->belanja_id == $data_rpp->belanja_id) {
            ++$a;
            if($a==1) { ?>

    <?php }} $a=0; }} ?>
    <tr>
      <td width="15%">Kepada Yth</td>
      <td width="1%">:</td>
      <td><?=$selected_pa_kpa->jabatan_ttd_keuangan ?></td>
    </tr>
    <tr>
      <td width="15%">Melalui</td>
      <td width="1%">:</td>
      <td>Pejabat Penatausahaan Keuangan</td>
    </tr>
    <tr>
      <td>Dari</td>
      <td>:</td>
      <td><?=$selected_pptk->jabatan_ttd_keuangan ?></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td>:</td>
      <td><?=format_indo($this->input->get('tanggal_npd')) ?></td>
    </tr>
    <tr>
      <td>Perihal</td>
      <td>:</td>
      <td>Nota Permintaan Dana</td>
    </tr>
  </tbody>
</table>
<br>
<br>

<?php
$groupedData = array();
$a=0;

foreach ($npd as $data_rpp) {
foreach($dpa->result() as $key3 => $data_pp ) {
  if($data_rpp->dpa_id==$data_pp->dpa_id) {
  ++$a;
  if($a==1) {
    $uraian = $data_rpp->nama_sub_rincian_objek;

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
        ?>
          
        <?php
        }
        ?>

<table rules="all" width="100%" >
  <tbody>
    <tr>
      <td></td>
    </tr>
    <?php foreach($dpa->result() as $key => $data) { ?>
    <?php } ?>
    <tr>
      <td width="50%" style=" text-align: justify; text-indent: 50px;">Disampaikan dengan hormat. Sehubungan dengan pelaksanaan kegiatan pada Sub Koordinator Perencanaan dan Evaluasi Tahun Anggaran <?=year_date($data_rpp->tanggal_npd) ?>, untuk itu kami ajukan Nota Permintaan Dana untuk Sub Kegiatan <?=$data->name ?>, sebesar <?=indo_currency($total_pencairan) ?> (  <?=ucwords(number_to_words($total_pencairan)) ?> Rupiah ).
      <p style="text-indent: 50px;">Adapun rincian anggaran kegiatan dimaksud sebagaimana terlampir.</p>
      <p style="text-indent: 50px;">Demikian kami sampaikan. Atas perhatian Bapak kami ucapkan terima kasih.</p>
      </td>
      <td valign="top"><b><u>INSTRUKSI / INFORMASI</u></b></td>
    </tr>
  
    <tr>
      <td></td>
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
      <td width="50%"><center>
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