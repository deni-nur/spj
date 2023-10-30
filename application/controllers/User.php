<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['user_m','level_m','tahun_anggaran_m','unit_kerja_m']);
		$this->load->library('form_validation');
	}

	public function index()
	{
		check_admin();
		$data['row'] = $this->user_m->get();
		$this->template->load('template', 'user/data', $data);
	}

	public function add()
	{
		check_admin();

		$level = $this->level_m->get();
		$tahun_anggaran = $this->tahun_anggaran_m->get();
		$unit_kerja = $this->unit_kerja_m->get();
		$this->form_validation->set_rules('fullname', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|matches[password]',array('matches' => '%s tidak sesuai dengan password')
		);
		$this->form_validation->set_rules('level_id', 'Level', 'required');
		$this->form_validation->set_rules('tahun_anggaran_id', 'Tahun Anggaran', 'required');

		$this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '{field} sudah ada, silahkan ganti');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if ($this->form_validation->run()) {
				$config['upload_path']          = './assets/upload/image/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //dalam kilobyte
                $config['max_width']            = 5000; //dalam pixel
                $config['max_height']           = 5000; //dalam pixel
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('logo')) {

			$data = array(	'page'				=> 'add',
							'error_upload'		=> $this->upload->display_errors(),
							'level'				=> $level,
							'tahun_anggaran'	=> $tahun_anggaran,
							'unit_kerja'		=> $unit_kerja
						);
		$this->template->load('template', 'user/add', $data);
		// masuk database
		}else{
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
			$data = array(	'username'			=> $i->post('username'),
							'password'			=> sha1($i->post('password')),
							'name'				=> $i->post('fullname'),
							'level_id'			=> $i->post('level_id'),
							'unit_kerja_id'		=> $i->post('unit_kerja_id'),
							'tahun_anggaran_id'	=> $i->post('tahun_anggaran_id'),
							'is_active'			=> $i->post('is_active'),
							'logo'				=> $upload_data['uploads']['file_name'],
						);

			$this->user_m->add($data);
			$this->session->set_flashdata('success', 'Data User Berhasil ditambah');
			redirect(base_url('user'), 'refresh');
		// end masuk database
	}}
	$data = array(	'page'				=> 'add',
					'level'				=> $level,
					'tahun_anggaran'	=> $tahun_anggaran,
					'unit_kerja'		=> $unit_kerja
				);
		$this->template->load('template', 'user/add', $data);
	}

	public function edit($user_id)
	{
		check_admin();
		$level = $this->level_m->get();
		$user = $this->user_m->detail($user_id);
		$tahun_anggaran = $this->tahun_anggaran_m->get();
		$unit_kerja = $this->unit_kerja_m->get();

		$this->form_validation->set_rules('fullname', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]');
		if($this->input->post('password')) {
		$this->form_validation->set_rules('password', 'Password', 'min_length[5]');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'matches[password]',array('matches' => '%s tidak sesuai dengan password')
			);
		}
		if($this->input->post('passconf')) {
		$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'matches[password]',array('matches' => '%s tidak sesuai dengan password')
			);
		}
		$this->form_validation->set_rules('level_id', 'Level', 'required');
		$this->form_validation->set_rules('tahun_anggaran_id', 'Tahun Anggaran', 'required');
		$this->form_validation->set_rules('is_active', 'Aktif/Non Aktif', 'required');

		$this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '{field} sudah ada, silahkan ganti');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if ($this->form_validation->run()) {
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

		$data = array(	'page' 				=> 'edit',
						'error_upload'		=> $this->upload->display_errors(),
						'user'				=> $user,
						'level'				=> $level,
						'tahun_anggaran'	=> $tahun_anggaran,
						'unit_kerja'		=> $unit_kerja
					);
		$this->template->load('template', 'user/edit', $data);
		// Masuk Database
		}else{
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
			if($user->logo != "")
			{
				unlink('./assets/upload/image/'.$user->logo);
				unlink('./assets/upload/image/thumbs/'.$user->logo);
			}
			//END HAPUS GAMBAR
			$data = array(	'user_id'			=> $user_id,
							'username'			=> $i->post('username'),
							'password'			=> sha1($i->post('password')),
							'name'				=> $i->post('fullname'),
							'level_id'			=> $i->post('level_id'),
							'unit_kerja_id'		=> $i->post('unit_kerja_id'),
							'tahun_anggaran_id'	=> $i->post('tahun_anggaran_id'),
							'is_active'			=> $i->post('is_active'),
							'logo'				=> $upload_data['uploads']['file_name'],
							);
			$this->user_m->edit($data);
			$this->session->set_flashdata('success', 'Data Telah Diupdate');
			redirect(base_url('user'),'refresh');
		}}else{
			//update user tanpa gambar baru
			$i = $this->input;
			$data = array(	'user_id'		=> $user_id,
							'username'			=> $i->post('username'),
							'password'			=> sha1($i->post('password')),
							'name'				=> $i->post('fullname'),
							'level_id'			=> $i->post('level_id'),
							'unit_kerja_id'		=> $i->post('unit_kerja_id'),
							'tahun_anggaran_id'	=> $i->post('tahun_anggaran_id'),
							'is_active'			=> $i->post('is_active')
							//'logo'				=> $upload_data['uploads']['file_name'],
							);
			$this->user_m->edit($data);
			$this->session->set_flashdata('success', 'Data Telah Diupdate');
			redirect(base_url('user'),'refresh');
		}}
		// End Masuk Database
		$data = array(	'page' 				=> 'edit',
						'user'				=> $user,
						'level'				=> $level,
						'tahun_anggaran'	=> $tahun_anggaran,
						'unit_kerja'		=> $unit_kerja
					);
		$this->template->load('template', 'user/edit', $data);
	}
	
	// function username_check()
	// {
	// 	check_admin();
	// 	$post = $this->input->post(null, TRUE);
	// 	$query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND user_id != '$post[user_id]'");
	// 	if($query->num_rows() > 0) {
	// 		$this->form_validation->set_message('username_check', '{field} ini sudah dipakai, silahkan ganti');
	// 		return FALSE;
	// 	} else {
	// 		return TRUE;
	// 	}
	// }

	public function delete()
	{
		check_admin();
		$user_id = $this->input->post('user_id');
		$user = $this->user_m->detail($user_id);

		//HAPUS GAMBAR
		if($user->logo != "")
		{
			unlink('./assets/upload/image/'.$user->logo);
			unlink('./assets/upload/image/thumbs/'.$user->logo);
		}
		//END HAPUS GAMBAR

		$this->user_m->delete(['user_id' => $user_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data Telah dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data Gagal dihapus');
		}
		redirect(base_url('user'), $params, 'refresh');
	}

	public function changepassword($user_id)
	{
		check_admin();
		$user = $this->user_m->detail($user_id);

		$valid = $this->form_validation;

		$valid->set_rules('passbaru', 'Password Baru', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'	=> 'changepassword',
						'user'	=> $user
					);
		$this->template->load('template', 'user/changepassword', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'	=>	$user_id,
							'password'	=>	sha1($i->post('passbaru'))
						);

			$this->user_m->changepassword($data);
			$this->session->set_flashdata('success', 'Password Berhasil diupdate');
			redirect(base_url('user'), 'refresh');
		// end masuk database
		}
	}

	public function profile()
	{
		$user_id = $this->session->userdata('userid');
		$user = $this->user_m->detail($user_id);
		$unit_kerja = $this->unit_kerja_m->get();

		$this->form_validation->set_rules('fullname', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]');
		if($this->input->post('password')) {
		$this->form_validation->set_rules('password', 'Password', 'min_length[5]');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'matches[password]',array('matches' => '%s tidak sesuai dengan password')
			);
		}
		if($this->input->post('passconf')) {
		$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'matches[password]',array('matches' => '%s tidak sesuai dengan password')
			);
		}

		$this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '{field} sudah ada, silahkan ganti');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if ($this->form_validation->run()) {
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

		$data = array(	'page' 			=> 'profile',
						'error_upload'	=> $this->upload->display_errors(),
						'user'			=> $user,
						'unit_kerja'	=> $unit_kerja
					);
		$this->template->load('template', 'user/profile', $data);
		// Masuk Database
		}else{
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
			if($user->logo != "")
			{
				unlink('./assets/upload/image/'.$user->logo);
				unlink('./assets/upload/image/thumbs/'.$user->logo);
			}
			//END HAPUS GAMBAR
			$data = array(	'user_id'		=> $user_id,
							'username'		=> $i->post('username'),
							'name'			=> $i->post('fullname'),
							//'unit_kerja_id'	=> $i->post('unit_kerja_id'),
							//'level'			=> $i->post('level'),
							//'is_active'		=> $i->post('is_active'),
							'logo'			=> $upload_data['uploads']['file_name'],
							);
			$this->user_m->profile($data);
			$this->session->set_flashdata('success', 'Data Telah Diupdate');
			redirect(base_url('user/profile'),'refresh');
		}}else{
			//update user tanpa gambar baru
			$i = $this->input;
			$data = array(	'user_id'		=> $user_id,
							'username'		=> $i->post('username'),
							'name'			=> $i->post('fullname'),
							//'unit_kerja_id'	=> $i->post('unit_kerja_id'),
							//'level'			=> $i->post('level'),
							//'is_active'		=> $i->post('is_active')
							);
			$this->user_m->profile($data);
			$this->session->set_flashdata('success', 'Data Telah Diupdate');
			redirect(base_url('user/profile'),'refresh');
		}}
		// End Masuk Database
		$data = array(	'page' 			=> 'profile',
						'user'			=> $user,
						'unit_kerja'	=> $unit_kerja
					);
		$this->template->load('template', 'user/profile', $data);
	}

	public function updatepass()
	{
		$user_id = $this->session->userdata('userid');
		$user = $this->user_m->detail($user_id);

		$valid = $this->form_validation;

		$valid->set_rules('password', 'Password Baru', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'	=> 'updatepass',
						'user'	=> $user
					);
		$this->template->load('template', 'user/updatepass', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'	=>	$user_id,
							'password'	=>	sha1($i->post('password'))
						);

			$this->user_m->updatepass($data);
			$this->session->set_flashdata('success', 'Password Berhasil diupdate');
			redirect(base_url('auth/logout'), 'refresh');
		// end masuk database
		}
	}
}
