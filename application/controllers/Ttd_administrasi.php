<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ttd_administrasi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['pegawai_m', 'jabatan_m', 'ttd_administrasi_m']);
	}

	public function index()
	{	
		$ttd_administrasi = $this->ttd_administrasi_m->get();

		$data = array(	'ttd_administrasi' => $ttd_administrasi
					);
		$this->template->load('template', 'master/ttd/administrasi/data', $data);
	}

	public function add()
	{
		$pegawai = $this->pegawai_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('jabatan_ttd_administrasi', 'Pejabat Penandatangan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if ($valid->run()) {
				$config['upload_path']          = './assets/upload/image/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //dalam kilobyte
                $config['max_width']            = 5000; //dalam pixel
                $config['max_height']           = 5000; //dalam pixel
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('foto')) {
			// end validasi

		$data = array(	'error_upload'	=>	$this->upload->display_errors()
					);
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
			$data = array(	'user_id'					=> $this->session->userdata('userid'),
							'pegawai_id'				=> $i->post('pegawai_id'),
							'jabatan_ttd_administrasi'	=> $i->post('jabatan_ttd_administrasi'),
							'foto'						=> $upload_data['uploads']['file_name'],
						);
			$this->ttd_administrasi_m->add($data);
			$this->session->set_flashdata('success', 'Data Pejabat Penandatangan Berhasil ditambah');
			redirect(base_url('ttd_administrasi'), 'refresh');
		// end masuk database
		}}
		$data = array(	'page'			=>	'add',
						'pegawai'		=>	$pegawai
					);
		$this->template->load('template', 'master/ttd/administrasi/add', $data);
		// masuk database
	}

	public function edit($ttd_administrasi_id)
	{
		$ttd_administrasi = $this->ttd_administrasi_m->detail($ttd_administrasi_id);

		$pegawai = $this->pegawai_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('jabatan_ttd_administrasi', 'Pejabat Penandatangan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if ($valid->run()) {
			//kalau gambar tidak diganti
			if (!empty($_FILES['foto']['name'])) {

				$config['upload_path']          = './assets/upload/image/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //dalam kilobyte
                $config['max_width']            = 5000; //dalam pixel
                $config['max_height']           = 5000; //dalam pixel
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('foto')) {
			// end validasi

		$data = array(	'error_upload'	=>	$this->upload->display_errors()
					);
		} else {
			// proses manipulasi gambar
			$upload_data		= array('uploads' =>$this->upload->data());
			// gambar asli disimpan di folder assets/upload/image
			// lalu gambar asli itu dicopy untuk versi mini size ke folder assets/upload/image/thumbs
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/' .$upload_data['uploads']['file_name'];
			//gambar versi kecil dipindahkan
			$config['new_image']		= './assets/upload/image/thumbs/' .$upload_data['uploads']['file_name'];
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio']	= TRUE;
			$config['width']         	= 200;
			$config['height']       	= 200;
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			$i = $this->input;
			//hapus gambar lama jika upload gambar baru
			if($ttd_administrasi->foto != "")
			{
				unlink('./assets/upload/image/'.$ttd_administrasi->foto);
				unlink('./assets/upload/image/thumbs/'.$ttd_administrasi->foto);
			}
			//END HAPUS GAMBAR
			$data = array(	'ttd_administrasi_id'		=> $ttd_administrasi_id,
							'user_id'					=> $this->session->userdata('userid'),
							'pegawai_id'				=> $i->post('pegawai_id'),
							'jabatan_ttd_administrasi'	=> $i->post('jabatan_ttd_administrasi'),
							'foto'						=> $upload_data['uploads']['file_name'],
							);
			$this->ttd_administrasi_m->edit($data);
			$this->session->set_flashdata('success', 'Data Pejabat Penandatangan Telah diupdate');
			redirect(base_url('ttd_administrasi'), 'refresh');
		}}else{
			//update petugas tanpa gambar baru
			$i = $this->input;
			$data = array(	'ttd_administrasi_id'		=> $ttd_administrasi_id,
							'user_id'					=> $this->session->userdata('userid'),
							'pegawai_id'				=> $i->post('pegawai_id'),
							'jabatan_ttd_administrasi'	=> $i->post('jabatan_ttd_administrasi'),
							//'foto'						=> $upload_data['uploads']['file_name'],
						);
			$this->ttd_administrasi_m->edit($data);
			$this->session->set_flashdata('success', 'Data Pejabat Penandatangan Telah diupdate');
			redirect(base_url('ttd_administrasi'), 'refresh');
		}}
		// end masuk database
		$data = array(	'page'				=> 'edit',
						'ttd_administrasi'	=> $ttd_administrasi,
						'pegawai'			=> $pegawai
					);
		$this->template->load('template', 'master/ttd/administrasi/edit', $data);
	}

	public function del_ttd_administrasi($id)
	{
		$ttd_administrasi = $this->ttd_administrasi_m->detail($id);
		//HAPUS GAMBAR
		if($ttd_administrasi->foto != "")
		{
			unlink('./assets/upload/image/'.$ttd_administrasi->foto);
			unlink('./assets/upload/image/thumbs/'.$ttd_administrasi->foto);
		}
		//END HAPUS GAMBAR

		// Panggil model untuk menghapus data berdasarkan ID
        $this->ttd_administrasi_m->del_ttd_administrasi($id);
        $this->session->set_flashdata('success', 'Data Pejabat Penandatangan Telah dihapus');
        redirect('ttd_administrasi'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}
}
