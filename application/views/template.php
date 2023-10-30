<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Disnakertrans | Penatausahaan Keuangan</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DATE PICKER -->
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/dist/css/skins/_all-skins.min.css">
  <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logopemda.png">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/bootstrap-select/dist/css/bootstrap.css"> -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/bootstrap-select/dist/css/bootstrap-select.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/bootstrap-select/dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/select2/dist/css/select2.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/select2/dist/css/select2.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/sweetalert2/animate.min.css">
  <style>
     .swal2-popup {
        font-size: 1.3rem !important;
     }
   </style>

</head>
<body class="hold-transition skin-red sidebar-mini">

<div class="wrapper">
  <header class="main-header">
    <a href="<?=base_url('dashboard')?>" class="logo">
      <span class="logo-mini"><b>P</b>E</span>
      <span class="logo-lg"><b>Penat</b>Keu</span>
    </a>
    <nav class="navbar navbar-default navbar-static-top  m-b-0">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"></a>
      
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown tasks-menu">
            
            
</li>
<!-- User Account -->
<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="<?=base_url('assets/upload/image/'.$this->fungsi->user_login()->logo) ?>" class="user-image" >
    <span class="hidden-xs"><?= $this->fungsi->user_login()->name ?></span>
  </a>
  <ul class="dropdown-menu">
    <li class="user-header">
      <img src="<?=base_url('assets/upload/image/'.$this->fungsi->user_login()->logo) ?>" class="img-circle" >
      <p><?= $this->fungsi->user_login()->name ?>
        <small><?= $this->fungsi->user_login()->unit_kerja ?></small>
      </p>
    </li>
    <li class="user-footer">
      <div class="pull-left">
        <a href="<?=site_url('user/profile') ?>" class="btn btn-default btn-flat">Profile</a>
      </div>
      <div class="pull-right">
        <a href="<?=site_url('auth/logout') ?>" class="btn btn-danger btn-flat">Sign out</a>
      </div>
    </li>
  </ul>
</li>
</ul>
</div>
</nav>
</header>

<!-- Left side column -->
<aside class="main-sidebar">
<section class="sidebar">
<div class="user-panel">
<div class="pull-left image">
  <img src="<?=base_url('assets/upload/image/'.$this->fungsi->user_login()->logo) ?>" class="img-circle" >
</div>
<div class="pull-left info">
  <p><?=ucfirst($this->fungsi->user_login()->name) ?></p>
  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
</div>
</div>
<br>

<!-- <form action="#" method="get" class="sidebar-form">
<div class="input-group">
  <input type="text" name="q" class="form-control" placeholder="Search...">
  <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
      </span>
</div>

</form> -->
<!-- sidebar menu -->
<ul class="sidebar-menu" data-widget="tree">
<li class="header">MAIN NAVIGATION</li>

<li <?=$this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
  <a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
</li>

<?php if($this->fungsi->user_login()->level_id == 1) { ?>
<li class="treeview <?=$this->uri->segment(1) == 'pangkat' || $this->uri->segment(1) == 'golongan' || $this->uri->segment(1) == 'jabatan' || $this->uri->segment(1) == 'pegawai' || $this->uri->segment(1) == 'ttd_administrasi' || $this->uri->segment(1) == 'ttd_keuangan' || $this->uri->segment(1) == 'rekening' || $this->uri->segment(1) == 'provinsi' || $this->uri->segment(1) == 'kokab' || $this->uri->segment(1) == 'kecamatan' || $this->uri->segment(1) == 'desa' || $this->uri->segment(1) == 'dalam_daerah' || $this->uri->segment(1) == 'luar_daerah' || $this->uri->segment(1) == 'program' || $this->uri->segment(1) == 'kegiatan' || $this->uri->segment(1) == 'sub_kegiatan' || $this->uri->segment(1) == 'akun' || $this->uri->segment(1) == 'kelompok' || $this->uri->segment(1) == 'jenis' || $this->uri->segment(1) == 'objek' || $this->uri->segment(1) == 'rincian_objek' || $this->uri->segment(1) == 'sub_rincian_objek' ? 'active' : '' ?>">
    <a href="#">
    <i class="fa fa-database"></i> <span>Master</span>
    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">

        <li class="treeview <?=$this->uri->segment(1) == 'pangkat' || $this->uri->segment(1) == 'jabatan' || $this->uri->segment(1) == 'pegawai' ? 'active' : '' ?>">
          <a href="#"><i class="fa fa-group"></i> Daftar Pegawai
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
         <li <?=$this->uri->segment(1) == 'pangkat' ? 'class="active"' : '' ?>><a href="<?= site_url('pangkat') ?>"><i class="fa fa-circle-o"></i> Pangkat</a></li>
        <li <?=$this->uri->segment(1) == 'jabatan' ? 'class="active"' : '' ?>><a href="<?= site_url('jabatan') ?>"><i class="fa fa-circle-o"></i> Jabatan</a></li>
        <li <?=$this->uri->segment(1) == 'pegawai' ? 'class="active"' : '' ?>><a href="<?= site_url('pegawai') ?>"><i class="fa fa-circle-o"></i> Pegawai</a></li>   
          </ul>
        </li>

        <li class="treeview <?=$this->uri->segment(1) == 'ttd_administrasi' || $this->uri->segment(1) == 'ttd_keuangan' ? 'active' : '' ?>">
          <a href="#"><i class="fa fa-male"></i> Pejabat Penandatangan
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li <?=$this->uri->segment(1) == 'ttd_administrasi' ? 'class="active"' : '' ?>><a href="<?= site_url('ttd_administrasi') ?>"><i class="fa fa-circle-o"></i> Administrasi</a></li>
        <li <?=$this->uri->segment(1) == 'ttd_keuangan' ? 'class="active"' : '' ?>><a href="<?= site_url('ttd_keuangan') ?>"><i class="fa fa-circle-o"></i> Keuangan</a></li> 
          </ul>
        </li>

        <li <?=$this->uri->segment(1) == 'rekening' ? 'class="active"' : '' ?>><a href="<?= site_url('rekening') ?>"><i class="fa fa-bank"></i> Rekening Bank</a></li>

        <li class="treeview <?=$this->uri->segment(1) == 'provinsi' || $this->uri->segment(1) == 'kokab' || $this->uri->segment(1) == 'kecamatan' ? 'active' : '' ?>">
          <a href="#"><i class="fa fa-list"></i> Wilayah
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?=$this->uri->segment(1) == 'provinsi' ? 'class="active"' : '' ?>><a href="<?= site_url('provinsi') ?>"><i class="fa fa-circle-o"></i> Provinsi</a></li>
            <li <?=$this->uri->segment(1) == 'kokab' ? 'class="active"' : '' ?>><a href="<?= site_url('kokab') ?>"><i class="fa fa-circle-o"></i> Kabupaten/Kota</a></li>
            <li <?=$this->uri->segment(1) == 'kecamatan' ? 'class="active"' : '' ?>><a href="<?= site_url('kecamatan') ?>"><i class="fa fa-circle-o"></i> Kecamatan</a></li> 
          </ul>
        </li>

        <li class="treeview <?=$this->uri->segment(1) == 'dalam_daerah' || $this->uri->segment(1) == 'luar_daerah' ? 'active' : '' ?>">
          <a href="#"><i class="fa fa-taxi"></i> Standar Biaya Perjadin
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?=$this->uri->segment(1) == 'dalam_daerah' ? 'class="active"' : '' ?>><a href="<?=site_url('dalam_daerah') ?>"><i class="fa fa-circle-o"></i> Dalam Daerah</a></li>
            <li <?=$this->uri->segment(1) == 'luar_daerah' ? 'class="active"' : '' ?>><a href="<?=site_url('luar_daerah') ?>"><i class="fa fa-circle-o"></i> Luar Daerah</a></li>   
          </ul>
        </li>

        <li class="treeview <?=$this->uri->segment(1) == 'program' || $this->uri->segment(1) == 'kegiatan' || $this->uri->segment(1) == 'sub_kegiatan' ? 'active' : '' ?>">
          <a href="#"><i class="fa fa-angle-double-down"></i> Cascading RENSTRA
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?=$this->uri->segment(1) == 'program' ? 'class="active"' : '' ?>><a href="<?= site_url('program') ?>"><i class="fa fa-circle-o"></i> Program</a></li>
            <li <?=$this->uri->segment(1) == 'kegiatan' ? 'class="active"' : '' ?>><a href="<?= site_url('kegiatan') ?>"><i class="fa fa-circle-o"></i> Kegiatan</a></li>
            <li <?=$this->uri->segment(1) == 'sub_kegiatan' ? 'class="active"' : '' ?>><a href="<?= site_url('sub_kegiatan') ?>"><i class="fa fa-circle-o"></i> Sub Kegiatan</a></li>  
          </ul>
        </li>

        <li class="treeview <?=$this->uri->segment(1) == 'akun' || $this->uri->segment(1) == 'kelompok' || $this->uri->segment(1) == 'jenis' || $this->uri->segment(1) == 'objek' || $this->uri->segment(1) == 'rincian_objek' || $this->uri->segment(1) == 'sub_rincian_objek' ? 'active' : '' ?>">
          <a href="#"><i class="fa fa-balance-scale"></i> Neraca Belanja
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?=$this->uri->segment(1) == 'akun' ? 'class="active"' : '' ?>><a href="<?=site_url('akun') ?>"><i class="fa fa-circle-o"></i> Akun</a></li>
            <li <?=$this->uri->segment(1) == 'kelompok' ? 'class="active"' : '' ?>><a href="<?=site_url('kelompok') ?>"><i class="fa fa-circle-o"></i> Kelompok</a></li>
            <li <?=$this->uri->segment(1) == 'jenis' ? 'class="active"' : '' ?>><a href="<?=site_url('jenis') ?>"><i class="fa fa-circle-o"></i> Jenis</a></li>
            <li <?=$this->uri->segment(1) == 'objek' ? 'class="active"' : '' ?>><a href="<?=site_url('objek') ?>"><i class="fa fa-circle-o"></i> Objek</a></li>
            <li <?=$this->uri->segment(1) == 'rincian_objek' ? 'class="active"' : '' ?>><a href="<?=site_url('rincian_objek') ?>"><i class="fa fa-circle-o"></i> Rincian</a></li>
            <li <?=$this->uri->segment(1) == 'sub_rincian_objek' ? 'class="active"' : '' ?>><a href="<?=site_url('sub_rincian_objek') ?>"><i class="fa fa-circle-o"></i> Sub Rincian Objek</a></li>   
          </ul>
        </li>

    </ul>
</li>
<?php } ?>

<li class="treeview <?=$this->uri->segment(1) == 'dpa' ? 'active' : '' ?>">
    <a href="#">
    <i class="fa fa-hourglass-half"></i> <span>Penganggaran</span>
    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">

<li class="treeview <?=$this->uri->segment(1) == 'dpa' ? 'active' : '' ?>">
  <a href="#"><i class="fa fa-copy"></i> DPA
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li <?=$this->uri->segment(1) == 'dpa' ? 'class="active"' : '' ?>><a href="<?= site_url('dpa') ?>"><i class="fa fa-circle-o"></i> Sub Kegiatan</a></li>

  </ul>
</li>
</ul>

<li class="treeview <?=$this->uri->segment(1) == 'darhum' || $this->uri->segment(1) == 'surat_tugas' || $this->uri->segment(1) == 'lhpd' || $this->uri->segment(1) == 'sppd' || $this->uri->segment(1) == 'npd' || $this->uri->segment(1) == 'kwitansi' || $this->uri->segment(1) == 'rekap' ? 'active' : '' ?>">
    <a href="#">
    <i class="fa fa-balance-scale"></i> <span>SPJ</span>
    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>

   <ul class="treeview-menu">
      <li class="treeview <?=$this->uri->segment(1) == 'darhum' || $this->uri->segment(1) == 'surat_tugas' ? 'active' : '' ?>">
          <a href="#"><i class="fa fa-clone"></i> Surat Perintah Tugas
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
         <li <?=$this->uri->segment(1) == 'darhum' ? 'class="active"' : '' ?>><a href="<?= site_url('darhum') ?>"><i class="fa fa-circle-o"></i> Dasar Hukum</a></li>
        <li <?=$this->uri->segment(1) == 'surat_tugas' ? 'class="active"' : '' ?>><a href="<?= site_url('surat_tugas') ?>"><i class="fa fa-circle-o"></i> Pelaksanaan</a></li>  
          </ul>
        </li>

      <li <?=$this->uri->segment(1) == 'sppd' ? 'class="active"' : '' ?>><a href="<?= site_url('sppd') ?>"><i class="fa fa-sticky-note-o"></i> Surat Perintah Perjalan Dinas</a></li>
      <li <?=$this->uri->segment(1) == 'lhpd' ? 'class="active"' : '' ?>><a href="<?= site_url('lhpd') ?>"><i class="fa fa-file-o"></i> Laporan Hasil Perjalan Dinas</a></li>
      <li <?=$this->uri->segment(1) == 'npd' ? 'class="active"' : '' ?>><a href="<?= site_url('npd') ?>"><i class="fa fa-dollar"></i> Nota Permintaan Dana</a></li>
    <!-- <li class="treeview <?=$this->uri->segment(1) == 'pp' ? 'active' : '' ?>">
      <a href="#"><i class="fa fa-circle-o"></i> Nota Permintaan Dana
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li <?=$this->uri->segment(3) == 'pp' ? 'class="active"' : '' ?>><a href="<?=site_url('portal/'.$this->uri->segment(2).'/pp') ?>"><i class="fa fa-circle-o"></i> Permintaan Pembayaran</a></li>   
      </ul>
    </li> -->
    <li <?=$this->uri->segment(3) == 'kwitansi' ? 'class="active"' : '' ?>><a href="<?= site_url('portal/'.$this->uri->segment(2).'/kwitansi') ?>"><i class="fa fa-list-alt"></i> Kwitansi</a></li>
    <li <?=$this->uri->segment(3) == 'rekap' ? 'class="active"' : '' ?>><a href="<?= site_url('portal/'.$this->uri->segment(2).'/rekap') ?>"><i class="fa fa-paste"></i> Rekap Biaya</a></li>
    </ul>
</li>


<?php if($this->fungsi->user_login()->level_id == 1) { ?>
<li class="header">SETTINGS</li>
<li <?=$this->uri->segment(1) == 'konfigurasi' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
  <a href="<?= site_url('konfigurasi') ?>"><i class="fa fa-wrench"></i> <span> Konfigurasi</span></a></li>
<li <?=$this->uri->segment(1) == 'user' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
  <a href="<?= site_url('user') ?>"><i class="fa fa-user-plus"></i> <span>Users</span></a></li>
<li <?=$this->uri->segment(1) == 'level' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
  <a href="<?= site_url('level') ?>"><i class="fa fa-ban"></i> <span>Level</span></a></li>
<li <?=$this->uri->segment(1) == 'unit_kerja' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
  <a href="<?= site_url('unit_kerja') ?>"><i class="fa fa-user"></i> <span>Unit Kerja</span></a></li>
<li <?=$this->uri->segment(1) == 'tahun_anggaran' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
  <a href="<?= site_url('tahun_anggaran') ?>"><i class="fa fa-database"></i> <span>Tahun Anggaran</span></a></li>
<?php } ?>
</ul>
</section>
</aside>

  <script src="<?php echo base_url() ?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Content -->
  <div class="content-wrapper">
  	<?php echo $contents ?>
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2023 <a href="https://disnakertrans.sukabumikab.go.id">Disnakertrans</a>.</strong> Penatausahaan Keuangan.
  </footer>

</div>

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>assets/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/admin/dist/js/demo.js"></script>
<!-- date picker -->
<script src="<?php echo base_url() ?>assets/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- page script -->
<!-- <script src="<?php echo base_url() ?>assets/bootstrap-select/dist/js/jquery-3.4.1.min.js"></script> -->
<!-- <script src="<?php echo base_url() ?>assets/bootstrap-select/dist/js/bootstrap.bundle.js"></script> -->
<script src="<?php echo base_url() ?>assets/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url() ?>assets/bootstrap-select/dist/js/bootstrap-select.js"></script>

<script src="<?php echo base_url() ?>assets/select2/dist/js/select2.js"></script>
<script src="<?php echo base_url() ?>assets/select2/dist/js/select2.min.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/js/jquery-3.2.1.min.js"></script> -->

<script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url() ?>assets/titikotomatis/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
  var flash = $('#flash').data('flash');
  if(flash) {
    Swal.fire({
      icon : 'success',
      title : 'Success',
      text : flash,
      showClass : {
          popup : 'animate__animated animate__fadeInDown'
      },
      hideClass : {
          popup : 'animate__animated animate__fadeOutUp'
      }
    })
  }

  $(document).on('click', '#btn-hapus', function(e) {
    e.preventDefault();
    var link = $(this).attr('href');

    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Data akan dihapus!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!',
      showClass : {
          popup : 'animate__animated animate__jackInTheBox'
      },
      hideClass : {
          popup : 'animate__animated animate__zoomOut'
      }
    }).then((result) => {
      if (result.isConfirmed) {
          window.location = link;
      }
    })
  })
</script>

<script>
  $(function () {
    $('#table1').DataTable()
    $('#table2').DataTable()
    $('#table3').DataTable()
    $('#table4').DataTable()
    $('#table5').DataTable()
    $('#table6').DataTable()
    $('#table7').DataTable()
    $('#table8').DataTable()
    $('#table9').DataTable()
    $('#table10').DataTable()
    $('#table11').DataTable()
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })

  
</script>

</body>
</html>
