<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model('konfigurasi_m');
	}

	public function index()
	{
		$konfigurasi = $this->konfigurasi_m->get();
		
		$data = array(	'konfigurasi'		=>	$konfigurasi
					);

		$this->template->load('template', 'konfigurasi/data', $data);
	}

	public function add()
	{
		$valid = $this->form_validation;

		$valid->set_rules('namaweb', 'Nama Web', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if ($valid->run()) {
				$config['upload_path']          = './assets/upload/image/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //dalam kilobyte
                $config['max_width']            = 5000; //dalam pixel
                $config['max_height']           = 5000; //dalam pixel
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('logo')) {

		$data = array(	'page'			=> 'add',
						'error_upload'	=> $this->upload->display_errors()
					);
		$this->template->load('template', 'konfigurasi/add', $data);
		// masuk database
		} else {
			// proses manipulasi gambar
			$upload_data		= array('uploads' =>$this->upload->data());
			// gambar asli disimpan di folder assets/upload/image
			// lalu gambar asli itu dicopy untuk versi mini size ke folder assets/upload/image/thumbs
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/' .$upload_data['uploads']['file_name'];
			//gambar versi kecil dipindahkan
			$config['new_image']	= './assets/upload/image/thumbs/' .$upload_data['uploads']['file_name'];
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio']	= TRUE;
			$config['width']         	= 200;
			$config['height']       	= 200;
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			$i = $this->input;
			$data = array(	'namaweb'	=> $i->post('namaweb'),
							'tagline'	=> $i->post('tagline'),
							'email'		=> $i->post('email'),
							'website'	=> $i->post('website'),
							'telepon'	=> $i->post('telepon'),
							'alamat'	=> $i->post('alamat'),
							'facebook'	=> $i->post('facebook'),
							'instagram'	=> $i->post('instagram'),
							'twitter'	=> $i->post('twitter'),
							'youtube'	=> $i->post('youtube'),
							'logo'		=> $upload_data['uploads']['file_name'],
						);

			$this->konfigurasi_m->add($data);
			$this->session->set_flashdata('success', 'Data Konfigurasi sukses ditambah');
			redirect(base_url('konfigurasi'), 'refresh');
		// end masuk database
	}}
	$data = array(	'page'			=> 'add',
				);
		$this->template->load('template', 'konfigurasi/add', $data);
	}


	public function edit($konfigurasi_id)
	{
		$konfigurasi = $this->konfigurasi_m->detail($konfigurasi_id);

		$valid = $this->form_validation;

		$valid->set_rules('namaweb', 'Nama Web', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if ($valid->run()) {
			//kalau gambar tidak diganti
			if (!empty($_FILES['logo']['name'])) {

				$config['upload_path']          = './assets/upload/image/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //dalam kilobyte
                $config['max_width']            = 5000; //dalam pixel
                $config['max_height']           = 5000; //dalam pixel
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('logo')) {
			// end validasi

		$data = array(	'page' 			=> 'edit',
						'error_upload'	=> $this->upload->display_errors(),
						'konfigurasi'	=> $konfigurasi,
					);
		$this->template->load('template', 'konfigurasi/edit', $data);
		// Masuk Database
		} else {
			// proses manipulasi gambar
			$upload_data		= array('uploads' =>$this->upload->data());
			// gambar asli disimpan di folder assets/upload/image
			// lalu gambar asli itu dicopy untuk versi mini size ke folder assets/upload/image/thumbs
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/' .$upload_data['uploads']['file_name'];
			//gambar versi kecil dipindahkan
			$config['new_image']	= './assets/upload/image/thumbs/' .$upload_data['uploads']['file_name'];
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio']	= TRUE;
			$config['width']         	= 200;
			$config['height']       	= 200;
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			$i = $this->input;
			//hapus gambar lama jika upload gambar baru
			if($konfigurasi->logo != "")
			{
				unlink('./assets/upload/image/'.$konfigurasi->logo);
				unlink('./assets/upload/image/thumbs/'.$konfigurasi->logo);
			}
			//END HAPUS GAMBAR
			$data = array(	'konfigurasi_id'	=> $konfigurasi_id,
							'namaweb'			=> $i->post('namaweb'),
							'tagline'			=> $i->post('tagline'),
							'email'				=> $i->post('email'),
							'website'			=> $i->post('website'),
							'telepon'			=> $i->post('telepon'),
							'alamat'			=> $i->post('alamat'),
							'facebook'			=> $i->post('facebook'),
							'instagram'			=> $i->post('instagram'),
							'twitter'			=> $i->post('twitter'),
							'youtube'			=> $i->post('youtube'),
							'logo'				=> $upload_data['uploads']['file_name'],
							);
			$this->konfigurasi_m->edit($data);
			$this->session->set_flashdata('success', 'Data Telah Diupdate');
			redirect(base_url('konfigurasi'),'refresh');
		}}else{
			//update petugas tanpa gambar baru
			$i = $this->input;
			$data = array(	'konfigurasi_id'	=> $konfigurasi_id,
							'namaweb'			=> $i->post('namaweb'),
							'tagline'			=> $i->post('tagline'),
							'email'				=> $i->post('email'),
							'website'			=> $i->post('website'),
							'telepon'			=> $i->post('telepon'),
							'alamat'			=> $i->post('alamat'),
							'facebook'			=> $i->post('facebook'),
							'instagram'			=> $i->post('instagram'),
							'twitter'			=> $i->post('twitter'),
							'youtube'			=> $i->post('youtube'),
							//'logo'				=> $upload_data['uploads']['file_name'],
							);
			$this->konfigurasi_m->edit($data);
			$this->session->set_flashdata('success', 'Data Telah Diupdate');
			redirect(base_url('konfigurasi'),'refresh');
		}}
		// End Masuk Database
		$data = array(	'page' 			=> 'edit',
						'konfigurasi'	=> $konfigurasi,
					);
		$this->template->load('template', 'konfigurasi/edit', $data);
	}

	public function delete()
	{
		$konfigurasi_id = $this->input->post('konfigurasi_id');
		$konfigurasi = $this->konfigurasi_m->detail($konfigurasi_id);

		//HAPUS GAMBAR
		if($konfigurasi->logo != "")
		{
			unlink('./assets/upload/image/'.$konfigurasi->logo);
			unlink('./assets/upload/image/thumbs/'.$konfigurasi->logo);
		}
		//END HAPUS GAMBAR

		$this->konfigurasi_m->delete(['konfigurasi_id' => $konfigurasi_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data Telah dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data Gagal dihapus');
		}
		redirect(base_url('konfigurasi'), $params, 'refresh');
	}
}

/* End of file Konfigurasi.php */
/* Location: ./application/controllers/Konfigurasi.php */