<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Aplikasi Petugas Rekrut">
    <meta name="author" content="Krucel">
    <meta name="_token" content="xYIZr4aCFBAvIPkEEzDcTpDad9eRWl2XPRaG6PKX">
    <link rel="shortcut icon" href="<?php echo base_url('assets/upload/image/'.$site->logo) ?>">
    <title>Login <?=$site->namaweb ?> | <?=$site->tagline ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    .title{
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    /*-webkit-transition: .1s all linear;*/
    text-decoration: none;
    display: inline-block;
    position: relative;
    -webkit-mask-image: linear-gradient(-75deg, rgba(0,0,0,.7) 30%, #000 50%, rgba(0,0,0,.7) 70%);
    -webkit-mask-size: 200%;
    animation: shine 2s linear infinite;
    }
    @keyframes    shine {
    from { -webkit-mask-position: 150%; }
    to { -webkit-mask-position: -50%; }
    }
    </style>
  </head>
  <body>
    
    <div class="preloader">
      <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register bg-portal bg-body">
      <div class="hidden-sm hidden-xs" style="position:absolute;top: 10%;left:4%;">
        <img src="<?php echo base_url('assets/upload/image/'.$site->logo) ?>" alt="home" class="dark-logo img-shadow" width="100">
      </div>
      <div class="hidden-sm hidden-xs" style="position:absolute;padding: 10px 0px;left: 12%;top:10%;text-align: right">
        <h2 class="text-white font-bold title"><?=$site->namaweb ?> | <?=$site->tagline ?></h2>
        <h4 class="text-white text-right m-t-0 p-r-0">- Pemerintah Kabupaten Sukabumi -</h4>
        
      </div>
      <div class="row">
        <div class="hidden-sm hidden-xs car-wrapper">
          <div class="animated fadeInDown car"><img src="<?php echo base_url() ?>assets/images/notepad.svg" ></div>
          <div class="animated fadeInDown car"><img src="<?php echo base_url() ?>assets/images/notepad-edit.svg" ></div>
          <div class="animated fadeInDown car"><img src="<?php echo base_url() ?>assets/images/notepad-check.svg" ></div>
        </div>
      </div>
     <div class="login-box login-sidebar bg-loginbox">
        <div class="signin-box">
          
          <form class="form-horizontal form-material no-bg-addon form-validate" id="loginform" role="form" method="post" action="<?=site_url('auth/process') ?>">
            <input type="hidden" name="_token">
            <a href="javascript:void(0)" class="text-center db"><img src="<?php echo base_url('assets/upload/image/'.$site->logo) ?>" alt="Home" width="100px" /><br/><br/><h2 class="text-white font-bold title" alt="Home" /><?=$site->tagline ?></h2></a>
            
            <div class="form-group m-t-40">
              <div class="col-xs-12">
                <input class="form-control" type="text" required="" autocomplete="off" placeholder="Username" name="username" autocapitalize="off" style="color:#ffffff;">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <input class="form-control" type="password" autocomplete="off" placeholder="Password" name="password" style="color:#ffffff;">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <select name="tahun_anggaran_id" class="form-control" style="color:#ffffff;" required>
                    <option value="">- Pilih -</option>
                    <?php foreach($tahun_anggaran->result() as $key => $data) { ?>
                        <option value="<?=$data->tahun_anggaran_id ?>" style="color:black;"><?=$data->tahun ?></option>
                    <?php } ?>
                </select>
              </div>
            </div>
            <!-- <div class="form-group">
              <div class="col-xs-12">
                <select name="unit_kerja_id" class="form-control" style="color:#ffffff;" required>
                    <option value="">- Pilih -</option>
                    <?php //foreach($unit_kerja->result() as $key => $data) { ?>
                        <option value="<?=$data->unit_kerja_id ?>" style="color:black;"><?=$data->unit_kerja ?></option>
                    <?php // } ?>
                </select>
              </div>
            </div> -->
                                    
            <div class="form-group text-center m-t-20 form-action">
              <div class="col-xs-12">
                <button class="btn btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="login" style="background-color: #247BA0 ;color: #FFF;">Log In</button>
                
              </div>
            </div>
            <div class="form-group m-b-50">
              <p>
                <br>
                <br>
              </p>
            </div>
          </form>
        </div>
        <h3>
        <div class="form-group m-b-50" >
          <h5 class="text-right text-white" style="background-color: none; padding-right: 10px;"><?=$site->namaweb ?> | <?=$site->tagline ?> &copy; 2023</h5>
        </div>
        </h3>
      </div>
    </section>
    <style type="text/css">
      .signin-box{
        margin-bottom: 60px;
      }
      .car-wrapper{
        position:absolute;top: 70%;left:10%;display: flex;
      }
      .car{
        opacity: 1;        
        animation-duration: 2s;
        animation-timing-function: ease-in-out;
        background-color: #FFF;
        padding: 20px;
        border: 3px solid #247BA0;
        border-radius: 100px;
        margin-left: 30px;
      }

      .car img, .car2 img, .car3 img{
        width: 50px;
      }

/*      @keyframes  fade{
        0% { opacity: 0; }
        20% { opacity: 1; }
        40% { opacity: 1; }
        60% { opacity: 1; }
        80% { opacity: 1; }
        100% { opacity: 0; }
      }*/

      .cloud{
        position: relative;
        animation: myfirst 5s infinite;
        animation-direction: alternate;
        animation-timing-function: ease-in-out;
      }
      .cloud2{
        position: relative;
        animation: mysecond 5s infinite;
        animation-direction: alternate;
        animation-timing-function: ease-in-out;
      }
      @keyframes  mysecond {
        0%   {left: -350px; top: 20px;}
        50%   {left: -330px; top: 20px;}
        100%  {left: -350px; top: 20px;}
      }
      @keyframes  myfirst {
        0%   {left: 220px; top: 20px;}
        50%   {left: 200px; top: 20px;}
        100%  {left: 220px; top: 20px;}
      }

      .bg-body{
        background-color: #247BA0;
        background-image: url("<?php echo base_url() ?>assets/images/kantor.jpg");
        background-size: 100%;
        background-position: bottom;
        background-repeat: no-repeat;
      }
      .HYPE_scene{
        background-image: url("<?php echo base_url() ?>assets/images/kantor.jpg");
      }
    </style>
  </body>
  <!-- jQuery -->
  <script src="<?php echo base_url() ?>assets/js/jquery-2.1.0.min.js"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
  <!-- Menu Plugin JavaScript -->
  <script src="<?php echo base_url() ?>assets/js/sidebar-nav.min.js"></script>
  <!--slimscroll JavaScript -->
  <script src="<?php echo base_url() ?>assets/js/jquery.slimscroll.js"></script>
  <!--Wave Effects -->
  <script src="<?php echo base_url() ?>assets/js/waves.js"></script>
  <!-- Sweet-Alert  -->
  <script src="<?php echo base_url() ?>assets/js/sweetalert.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/jquery.blockUI.js"></script>
  <!-- Custom Theme JavaScript -->
  <script src="<?php echo base_url() ?>assets/js/custom.min.js"></script>
</html>