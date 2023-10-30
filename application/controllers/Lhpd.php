<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lhpd extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['lhpd_m','surat_tugas_m','ttd_administrasi_m','pengikut_m']);
	}

	public function index()
	{
		$lhpd = $this->lhpd_m->get();

		$data = array(	'lhpd'		=>	$lhpd
					);
		$this->template->load('template', 'spj/lhpd/data', $data);
	}

	public function add()
	{
		$surat_tugas = $this->surat_tugas_m->get();
		$ttd_administrasi = $this->ttd_administrasi_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('hasil_kegiatan', 'Hasil Kegiatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'				=> 'add',
						'surat_tugas'		=> $surat_tugas,
						'ttd_administrasi'	=> $ttd_administrasi
					);
		$this->template->load('template', 'spj/lhpd/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'       		=> $this->session->userdata('userid'),
							'surat_tugas_id'		=> $i->post('surat_tugas_id'),
							'hasil_kegiatan'		=> $i->post('hasil_kegiatan'),
							'tanggal_lhpd'			=> $i->post('tanggal_lhpd'),
							'hari'					=> $i->post('hari'),
							'tanggal_kegiatan'		=> $i->post('tanggal_kegiatan'),
							'waktu'					=> $i->post('waktu'),
							'tempat'				=> $i->post('tempat')
						);
			$this->lhpd_m->add($data);
			$this->session->set_flashdata('success', 'Data Laporan Hasil Perjalanan Dinas sukses ditambah');
			redirect(base_url('lhpd'), 'refresh');
		}
	}

	public function edit($lhpd_id)
	{
		$lhpd = $this->lhpd_m->detail($lhpd_id);

		$surat_tugas = $this->surat_tugas_m->get();
		$ttd_administrasi = $this->ttd_administrasi_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('hasil_kegiatan', 'Hasil Kegiatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'				=> 'edit',
						'lhpd'				=> $lhpd,
						'surat_tugas'		=> $surat_tugas,
						'ttd_administrasi'	=> $ttd_administrasi
					);
		$this->template->load('template', 'spj/lhpd/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'lhpd_id'				=> $lhpd_id,
							'user_id'       		=> $this->session->userdata('userid'),
							'surat_tugas_id'		=> $i->post('surat_tugas_id'),
							'hasil_kegiatan'		=> $i->post('hasil_kegiatan'),
							'tanggal_lhpd'			=> $i->post('tanggal_lhpd'),
							'hari'					=> $i->post('hari'),
							'tanggal_kegiatan'		=> $i->post('tanggal_kegiatan'),
							'waktu'					=> $i->post('waktu'),
							'tempat'				=> $i->post('tempat')
						);
			$this->lhpd_m->edit($data);
			$this->session->set_flashdata('success', 'Data Laporan Hasil Perjalanan Dinas Telah diupdate');
			redirect(base_url('lhpd'), 'refresh');
		// end masuk database
		}
	}

	public function del_lhpd($id)
	{
		$gambar_lhpd = $this->lhpd_m->detail_gambar($id);
		//HAPUS GAMBAR
		if($gambar_lhpd->dokumentasi != "")
		{
			unlink('./assets/upload/lhpd/'.$gambar_lhpd->dokumentasi);
			unlink('./assets/upload/lhpd/thumbs/'.$gambar_lhpd->dokumentasi);
		}
		//END HAPUS GAMBAR

		// Panggil model untuk menghapus data berdasarkan ID
        $this->lhpd_m->del_gambar_lhpd($id);
		// Panggil model untuk menghapus data berdasarkan ID
        $this->lhpd_m->del_lhpd($id);
        $this->session->set_flashdata('success', 'Data LHPD Telah dihapus');
        redirect('lhpd'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}

	public function cetak($lhpd_id)
	{
		$data_lhpd 		= $this->lhpd_m->cetak($lhpd_id);
		$pengikut 	= $this->pengikut_m->get($this->uri->segment(4))->result();
		$gambar_lhpd 	= $this->lhpd_m->get_gambar($lhpd_id);
		
		$data = array(	'pengikut'		=> $pengikut,
						'data_lhpd'		=> $data_lhpd,
						'gambar_lhpd'	=> $gambar_lhpd
					);
		$this->load->view('spj/lhpd/cetak', $data, FALSE);
	}

	public function gambar_data()
	{
		$lhpd_id = $this->uri->segment(2);

		$lhpd = $this->lhpd_m->get();
		$gambar_lhpd = $this->lhpd_m->get_gambar($lhpd_id);

		$data = array(	'lhpd'			=>	$lhpd,
						'gambar_lhpd'	=>	$gambar_lhpd
					);
		$this->template->load('template', 'spj/lhpd/gambar/data', $data);
	}

	public function gambar_add()
	{
		$lhpd_id = $this->uri->segment(2);

		$lhpd = $this->lhpd_m->detail($lhpd_id);	

		$valid = $this->form_validation;

		$valid->set_rules('lhpd_id', 'Dokumentasi Kegiatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if ($valid->run()) {
				$config['upload_path']          = './assets/upload/lhpd/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //dalam kilobyte
                $config['max_width']            = 5000; //dalam pixel
                $config['max_height']           = 5000; //dalam pixel
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('dokumentasi')) {

		$data = array(	'page'			=>	'add',
						'error_upload'	=>	$this->upload->display_errors(),
						'lhpd'			=>	$lhpd
					);
		$this->template->load('template', 'spj/lhpd/gambar/add', $data);
		// masuk database
		} else {
			// proses manipulasi gambar
			$upload_data				= array('uploads' =>$this->upload->data());
			// gambar asli disimpan di folder assets/upload/image
			// lalu gambar asli itu dicopy untuk versi mini size ke folder assets/upload/image/thumbs
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/lhpd/' .$upload_data['uploads']['file_name'];
			//gambar versi kecil dipindahkan
			$config['new_image']		= './assets/upload/lhpd/thumbs/' .$upload_data['uploads']['file_name'];
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio']	= TRUE;
			$config['width']         	= 200;
			$config['height']       	= 200;
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			$i = $this->input;
			$data = array(	'user_id'		=>	$this->session->userdata('userid'),	
							'lhpd_id'		=>	$i->post('lhpd_id'),
							'dokumentasi'	=>	$upload_data['uploads']['file_name'],
						);
			$this->lhpd_m->gambar_add($data);
			$this->session->set_flashdata('success', 'Data Dokumentasi Laporan Hasil Perjalanan Dinas sukses ditambah');
			redirect(base_url('lhpd/'.$this->uri->segment(2).'/gambar_data'), 'refresh');
		// end masuk database
		}}
		$data = array(	'page'			=>	'add',
						'lhpd'			=>	$lhpd
				);
		$this->template->load('template', 'spj/lhpd/gambar/add', $data);
	}

	public function gambar_edit()
	{
		$gambar_lhpd_id = $this->uri->segment(4);
		$lhpd_id = $this->uri->segment(2);

		$lhpd = $this->lhpd_m->detail($lhpd_id);
		$gambar_lhpd = $this->lhpd_m->detail_gambar($gambar_lhpd_id);

		$valid = $this->form_validation;

		$valid->set_rules('lhpd_id', 'Dokumentasi Kegiatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if ($valid->run()) {
			//kalau gambar tidak diganti
			if (!empty($_FILES['dokumentasi']['name'])) {

				$config['upload_path']          = './assets/upload/lhpd/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //dalam kilobyte
                $config['max_width']            = 5000; //dalam pixel
                $config['max_height']           = 5000; //dalam pixel
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('dokumentasi')) {
			// end validasi

		$data = array(	'page' 			=> 'edit',
						'error_upload'	=> $this->upload->display_errors(),
						'lhpd'			=> $lhpd,
						'gambar_lhpd'	=> $gambar_lhpd,
					);
		$this->template->load('template', 'spj/lhpd/gambar/edit', $data);
		// Masuk Database
		} else {
			// proses manipulasi gambar
			$upload_data		= array('uploads' =>$this->upload->data());
			// gambar asli disimpan di folder assets/upload/image
			// lalu gambar asli itu dicopy untuk versi mini size ke folder assets/upload/image/thumbs
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/lhpd/' .$upload_data['uploads']['file_name'];
			//gambar versi kecil dipindahkan
			$config['new_image']	= './assets/upload/lhpd/thumbs/' .$upload_data['uploads']['file_name'];
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio']	= TRUE;
			$config['width']         	= 200;
			$config['height']       	= 200;
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			$i = $this->input;
			//hapus gambar lama jika upload gambar baru
			if($gambar_lhpd->dokumentasi != "")
			{
				unlink('./assets/upload/lhpd/'.$gambar_lhpd->dokumentasi);
				unlink('./assets/upload/lhpd/thumbs/'.$gambar_lhpd->dokumentasi);
			}
			//END HAPUS GAMBAR
			$data = array(	'gambar_lhpd_id'	=>	$gambar_lhpd_id,
							'user_id'			=>	$this->session->userdata('userid'),	
							'lhpd_id'			=>	$i->post('lhpd_id'),
							'dokumentasi'		=>	$upload_data['uploads']['file_name'],
							);
			$this->lhpd_m->gambar_edit($data);
			$this->session->set_flashdata('success', 'Data Dokumentasi Laporan Hasil Perjalanan Dinas Telah Diupdate');
			redirect(base_url('lhpd/'.$this->uri->segment(2).'/gambar_data'), 'refresh');
		}}else{
			//update petugas tanpa gambar baru
			$i = $this->input;
			$data = array(	'gambar_lhpd_id'	=>	$gambar_lhpd_id,
							'user_id'			=>	$this->session->userdata('userid'),	
							'lhpd_id'			=>	$i->post('lhpd_id')
							//'dokumentasi'		=>	$upload_data['uploads']['file_name'],
							);
			$this->lhpd_m->gambar_edit($data);
			$this->session->set_flashdata('success', 'Data Dokumentasi Laporan Hasil Perjalanan Dinas Telah Diupdate');
			redirect(base_url('lhpd/'.$this->uri->segment(2).'/gambar_data'), 'refresh');
		}}
		// End Masuk Database
		$data = array(	'page' 			=> 'edit',
						'lhpd'			=>	$lhpd,
						'gambar_lhpd'	=>	$gambar_lhpd,
					);
		$this->template->load('template', 'spj/lhpd/gambar/edit', $data);
	}

	public function del_gambar_lhpd($id)
	{
		$gambar_lhpd = $this->lhpd_m->detail_gambar($id);
		//HAPUS GAMBAR
		if($gambar_lhpd->dokumentasi != "")
		{
			unlink('./assets/upload/lhpd/'.$gambar_lhpd->dokumentasi);
			unlink('./assets/upload/lhpd/thumbs/'.$gambar_lhpd->dokumentasi);
		}
		//END HAPUS GAMBAR

		// Panggil model untuk menghapus data berdasarkan ID
        $this->lhpd_m->del_gambar_lhpd($id);
        $this->session->set_flashdata('success', 'Data Dokumentasi LHPD Telah dihapus');
        redirect('lhpd'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}
}

/* End of file lhpd.php */
/* Location: ./application/controllers/lhpd.php */