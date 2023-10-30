<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['rekening_m']);
	}

	public function index()
	{
		$rekening = $this->rekening_m->get();

		$data = array(	'rekening'	=> $rekening
				);

		$this->template->load('template', 'master/rekening/data', $data);
	}

	public function add()
	{
		$valid = $this->form_validation;

		$valid->set_rules('bank', 'Nama Bank', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add'
					);
		$this->template->load('template', 'master/rekening/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'		=>	$this->session->userdata('userid'),
							'no_rekening'	=>	$i->post('no_rekening'),
							'bank'			=>	$i->post('bank'),
							'pemilik'		=>	$i->post('pemilik')
						);

			$this->rekening_m->add($data);
			$this->session->set_flashdata('success', 'Data Rekening sukses ditambah');
			redirect(base_url('rekening'), 'refresh');
		// end masuk database
		}
	}

	public function edit($rekening_id)
	{
		$rekening = $this->rekening_m->detail($rekening_id);

		$valid = $this->form_validation;

		$valid->set_rules('bank', 'Nama Bank', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'rekening'	=> $rekening
					);
		$this->template->load('template', 'master/rekening/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'rekening_id'	=>	$rekening_id,
							'user_id'		=>	$this->session->userdata('userid'),
							'no_rekening'	=>	$i->post('no_rekening'),
							'bank'			=>	$i->post('bank'),
							'pemilik'		=>	$i->post('pemilik')
						);

			$this->rekening_m->edit($data);
			$this->session->set_flashdata('success', 'Data Rekening Telah diupdate');
			redirect(base_url('rekening'), 'refresh');
		// end masuk database
		}
	}

	public function del_rekening($id)
	{
		$this->rekening_m->del_rekening($id);
        $this->session->set_flashdata('success', 'Data Rekening Telah dihapus');
        redirect('rekening'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}
}
