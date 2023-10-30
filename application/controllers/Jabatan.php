<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('jabatan_m');
	}

	public function index()
	{
		$jabatan = $this->jabatan_m->get();

		$data = array(	'jabatan'	=> $jabatan
				);

		$this->template->load('template', 'master/daftar_pegawai/jabatan/data', $data);
	}

	public function add()
	{
		$valid = $this->form_validation;

		$valid->set_rules('jabatan', 'Nama Jabatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add'
					);
		$this->template->load('template', 'master/daftar_pegawai/jabatan/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'	=> $this->session->userdata('userid'),
							'jabatan'	=> $i->post('jabatan')
						);
			$this->jabatan_m->add($data);
			$this->session->set_flashdata('success', 'Data Jabatan sukses ditambah');
			redirect(base_url('jabatan'), 'refresh');
		// end masuk database
		}
	}

	public function edit($jabatan_id)
	{
		$jabatan = $this->jabatan_m->detail($jabatan_id);

		$valid = $this->form_validation;

		$valid->set_rules('jabatan', 'Nama Jabatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'jabatan'	=> $jabatan
					);
		$this->template->load('template', 'master/daftar_pegawai/jabatan/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'jabatan_id'	=> $jabatan_id,
							'user_id'		=> $this->session->userdata('userid'),
							'jabatan'		=> $i->post('jabatan')
						);
			$this->jabatan_m->edit($data);
			$this->session->set_flashdata('success', 'Data Jabatan Telah diupdate');
			redirect(base_url('jabatan'), 'refresh');
		// end masuk database
		}
	}

	public function del_jabatan($id)
	{
		// Panggil model untuk menghapus data berdasarkan ID
        $this->jabatan_m->del_jabatan($id);
        $this->session->set_flashdata('success', 'Data Jabatan Telah dihapus');
        redirect('jabatan'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}
}
