<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('program_m');
	}

	public function index()
	{
		$program = $this->program_m->get();

		$data = array(	'program'	=> $program
				);

		$this->template->load('template', 'master/renstra/program/data', $data);
	}

	public function add()
	{
		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama program', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add'
					);
		$this->template->load('template', 'master/renstra/program/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'	=>	$this->session->userdata('userid'),
							'kode'		=>	$i->post('kode'),
							'name'		=>	$i->post('name')
						);

			$this->program_m->add($data);
			$this->session->set_flashdata('success', 'Data Program sukses ditambah');
			redirect(base_url('program'), 'refresh');
		// end masuk database
		}
	}

	public function edit($program_id)
	{
		$program = $this->program_m->detail($program_id);

		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama program', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'program'	=>	$program
					);
		$this->template->load('template', 'master/renstra/program/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'program_id'	=>	$program_id,
							'user_id'		=>	$this->session->userdata('userid'),
							'kode'			=>	$i->post('kode'),
							'name'			=>	$i->post('name')
						);

			$this->program_m->edit($data);
			$this->session->set_flashdata('success', 'Data program Telah diupdate');
			redirect(base_url('program'), 'refresh');
		// end masuk database
		}
	}

	public function del_program()
	{
		$program_id = $this->input->post('program_id');
		$this->program_m->del_program(['program_id' => $program_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data program Telah dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data program Gagal dihapus');
		}
		echo json_encode($params);
	}
}
