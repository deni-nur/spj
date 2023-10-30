<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['konfigurasi_m','tahun_anggaran_m']);
	}

	public function login()
	{
		check_already_login();
		$site = $this->konfigurasi_m->listing();
		$tahun_anggaran = $this->tahun_anggaran_m->get();
		//$unit_kerja = $this->unit_kerja_m->get();
	
		$data = array(	'title'				=>	$site->namaweb.' | '.$site->tagline,
						'site'				=>	$site,
						'tahun_anggaran'	=>	$tahun_anggaran,
						//'unit_kerja'		=>	$unit_kerja
					);
		$this->load->view('login', $data);
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($post['login'])) {
			$this->load->model('user_m');
			$query = $this->user_m->login($post);
			?>
			<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.css">
			<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/sweetalert2/animate.min.css">
			<script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
			<style>
				body {
					font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
					font-size: 1em;
					font-weight: normal;
				}
			</style>
			<body></body>
			<?php
			if($query->num_rows() > 0) {
				$row = $query->row();
		            //jika user aktif
		            if ($row->is_active == 1) {
				$params = [
					'userid' 			=> $row->user_id,
					'level_id'			=> $row->level_id,
					'tahun_anggaran_id'	=> $row->tahun_anggaran_id,
					//'unit_kerja_id'		=> $row->unit_kerja_id
				];
				
				$this->session->set_userdata($params);
				?>
				<script>
					Swal.fire({
						icon : 'success',
						title : 'Success',
						text : 'Selamat, Login Berhasil',
						showClass : {
					        popup : 'animate__animated animate__heartBeat'
					    },
					    hideClass : {
					        popup : 'animate__animated animate__fadeOutUp'
					    }
					}).then((result) => {
						window.location='<?=site_url('dashboard') ?>';
					})
				</script>
				<?php
			}else {
				?>
				<script>
					Swal.fire({
						icon : 'error',
						title : 'Error',
						text : 'Login Gagal, Username / Password Tidak Aktif!',
						showClass : {
					        popup : 'animate__animated animate__swing'
					    },
					    hideClass : {
					        popup : 'animate__animated animate__fadeOutUp'
					    }
					}).then((result) => {
						window.location='<?=site_url('auth/login') ?>';
					})
				</script>
				<?php
			}
			}else {
				?>
				<script>
					Swal.fire({
						icon : 'error',
						title : 'Error',
						text : 'Login Gagal, Username / Password Salah!',
						showClass : {
					        popup : 'animate__animated animate__swing'
					    },
					    hideClass : {
					        popup : 'animate__animated animate__fadeOutUp'
					    }
					}).then((result) => {
						window.location='<?=site_url('auth/login') ?>';
					})
				</script>
				<?php
			}
		}
	}

	public function logout()
	{
		$params = array('userid', 'level_id', 'tahun_anggaran_id');
		?>
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.css">
			<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/sweetalert2/animate.min.css">
			<script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
			<style>
				body {
					font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
					font-size: 1em;
					font-weight: normal;
				}
			</style>
			<body></body>
			<?php
			$this->session->unset_userdata($params);
			?>
			<script>
				Swal.fire({
					icon : 'success',
					title : 'Success',
					text : 'Selamat, Logout Berhasil',
					showClass : {
				        popup : 'animate__animated animate__heartBeat'
				    },
				    hideClass : {
				        popup : 'animate__animated animate__fadeOutUp'
				    }
				}).then((result) => {
					window.location='<?=site_url('auth/login') ?>';
				})
			</script>
			<?php
	}
}
