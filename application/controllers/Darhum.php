<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Darhum extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['darhum_m','user_m']);
	}

	public function index()
	{
		
		$darhum = $this->darhum_m->get();

		$data = array(	'darhum'	=> $darhum
				);

		$this->template->load('template', 'spj/spt/darhum/data', $data);
	}

	public function add()
	{
		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama Dasar Hukum', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add',
					);
		$this->template->load('template', 'spj/spt/darhum/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'				=>	$this->session->userdata('userid'),
							'name'					=>	$i->post('name')
						);

			$this->darhum_m->add($data);
			$this->session->set_flashdata('success', 'Data Dasar Hukum Telah ditambah');
			redirect(base_url('darhum'), 'refresh');
		// end masuk database
		}
	}

	public function edit($darhum_id)
	{
		$darhum = $this->darhum_m->detail($darhum_id);

		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama Dasar Hukum', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'darhum'	=> $darhum
					);
		$this->template->load('template', 'spj/spt/darhum/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'darhum_id'				=> 	$darhum_id,
							'user_id'				=>	$this->session->userdata('userid'),
							'name'					=>	$i->post('name')
						);

			$this->darhum_m->edit($data);
			$this->session->set_flashdata('success', 'Data Dasar Hukum Telah diupdate');
			redirect(base_url('darhum'), 'refresh');
		// end masuk database
		}
	}

	public function del_darhum($id)
	{
		 // Panggil model untuk menghapus data berdasarkan ID
        $this->darhum_m->del_darhum($id);
        $this->session->set_flashdata('success', 'Data Dasar Hukum Telah dihapus');
        redirect('darhum'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}
}
