<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Surat Perintah Tugas</title>
  <style type="text/css" media="print">
        .line-title{
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
        .margin {
            margin: 5px 5px 5px 5px;
        }
        .padding {
            padding: 5px 15px 5px 15px;
        }
        .footer {
           position:fixed;
           bottom:0;
           width:100%;
           height:50px;   /* tinggi dari footer */
           background:#6cf;
        }
    
    </style>
</head>

<body onload="print()" class="padding" >
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
        <td align="center" ><font style="font-weight: bold;"><u>SURAT PERINTAH TUGAS</u></td>
    </tr>
    <tr>
        <td align="center" >Nomor : <?=$data_surat_tugas->no_surat_tugas ?></td>
    </tr>
</table>

<table style="width: 100%; font-family: Times New Roman; font-size: 11;">
     <tbody>
        <tr>
            <th align="left" valign="top" rowspan="5" width="10%">Dasar :</th>
        </tr>
        <?php $no=1; foreach ($darhum->result() as $darhum) { ?>
        <tr>
            <!-- <th rowspan="2">Dasar :</th> -->
            <td valign="top"><?=$no++ ?>.</td>
            <td colspan="3" style="text-align: justify;" ><?=$darhum->name?></td>
            <?php } ?>
        </tr>
        <?php if(!empty($data_surat_tugas->dasar_surat)) { ?>
        <tr>
            <td valign="top"><?=$no++ ?>.</td>
            <td colspan="3" style="text-align: justify;" ><?=$data_surat_tugas->dasar_surat ?></td>
        </tr>
    <?php } ?>
        <tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="5" align="center"><font style="font-weight: bold;"><u>M E M E R I N T A H K A N :</u></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Kepada</td>
            <td>1.</td>
            <td>Nama</td>
            <td>:</td>
            <td><b><?=$data_surat_tugas->name?></td>
        </tr>
        <?php if(!empty($data_surat_tugas->nip and $data_surat_tugas->pangkat and $data_surat_tugas->golongan)) { ?>
        <tr>
            <td></td>
            <td></td>
            <td>NIP</td>
            <td>:</td>
            <td><?=$data_surat_tugas->nip?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Pangkat/Gol</td>
            <td>:</td>
            <td><?=$data_surat_tugas->pangkat?> <?=$data_surat_tugas->golongan ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td></td>
            <td></td>
            <td>Jabatan</td>
            <td>:</td>
            <td><?=$data_surat_tugas->jabatan ?></td>
        </tr>
        <?php $no=2; foreach($pengikut->result() as $pengikut) : ?>
        <tr>
            <td></td>
            <td><?=$no++?>.</td>
            <td>Nama</td>
            <td>:</td>
            <td><b><?=$pengikut->name?></td>
        </tr>
        <?php if(!empty($pengikut->nip and $pengikut->pangkat and $pengikut->golongan)) { ?>
        <tr>
            <td></td>
            <td></td>
            <td>NIP</td>
            <td>:</td>
            <td><?=$pengikut->nip?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Pangkat/Gol</td>
            <td>:</td>
            <td><?=$pengikut->pangkat?>,<?=$pengikut->golongan ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td></td>
            <td></td>
            <td>Jabatan</td>
            <td>:</td>
            <td><?=$pengikut->jabatan ?></td>
        </tr>
        <?php endforeach; ?> 
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td valign="top"><font style="font-weight: bold">Untuk</td>
            <td valign="top">:</td>
            <td colspan="3" style="text-align: justify;" ><?=$data_surat_tugas->maksud?></td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: justify;" ><p style="text-indent: 70px;">Demikian Surat Perintah Tugas ini di buat  dan disampaikan kepada yang bersangkutan untuk dilaksanakan dengan penuh tanggungjawab.</p></td>
        </tr>
    </tbody>
</table>
    <table width="100%">
        <tbody>
            <tr>
                <td width="50%"></td>
                <td align="center"><?=$data_surat_tugas->alamat ?>, <?=format_indo($data_surat_tugas->tanggal_surat) ?></td>
            </tr>
            <tr>
                <td width="50%"></td>
                <td align="center"><?=$selected_data->jabatan_ttd_administrasi ?>
               	<br><?=$selected_data->jabatan ?></td>
            </tr>
            <tr>
                <td></td>
                <td align="center"><img src="<?php echo base_url('assets/upload/image/'.$selected_data->foto)?>" width="200"></td>
            </tr>
            
        </tbody>
    </table>
<br>
<footer class="footer">
    <table width="100%">
        <td align="center"><img src="<?php echo base_url('assets/images/logobsre.png') ?>" style="position: absolute ; width: 45px; height: auto;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dokumen ini ditandatangani secara elektronik menggunakan Sertifikat Elektronik yang di terbitkan oleh
        <br>Balai Sertifikat Elektronik (BSrE) Badan Siber dan Sandi Negara (BSSN)
        </td>
    </table>
  </footer>

</body>
</html>