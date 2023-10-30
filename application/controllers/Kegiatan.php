<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['kegiatan_m','program_m']);
	}

	public function index()
	{
		$kegiatan = $this->kegiatan_m->get();

		$data = array(	'kegiatan'	=> $kegiatan
				);

		$this->template->load('template', 'master/renstra/kegiatan/data', $data);
	}

	public function add()
	{
		$program = $this->program_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama kegiatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=>	'add',
						'program'	=>	$program
					);
		$this->template->load('template', 'master/renstra/kegiatan/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'		=>	$this->session->userdata('userid'),
							'program_id'	=>	$i->post('program_id'),
							'kode'			=>	$i->post('kode'),
							'name'			=>	$i->post('name')
						);

			$this->kegiatan_m->add($data);
			$this->session->set_flashdata('success', 'Data kegiatan sukses ditambah');
			redirect(base_url('kegiatan'), 'refresh');
		// end masuk database
		}
	}

	public function edit($kegiatan_id)
	{
		$program = $this->program_m->get();
		$kegiatan = $this->kegiatan_m->detail($kegiatan_id);

		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama kegiatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=>	'edit',
						'program'	=>	$program,
						'kegiatan'	=>	$kegiatan
					);
		$this->template->load('template', 'master/renstra/kegiatan/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'kegiatan_id'	=>	$kegiatan_id,
							'user_id'		=>	$this->session->userdata('userid'),
							'program_id'	=>	$i->post('program_id'),
							'kode'			=>	$i->post('kode'),
							'name'			=>	$i->post('name')
						);

			$this->kegiatan_m->edit($data);
			$this->session->set_flashdata('success', 'Data kegiatan Telah diupdate');
			redirect(base_url('kegiatan'), 'refresh');
		// end masuk database
		}
	}

	public function del_kegiatan()
	{
		$kegiatan_id = $this->input->post('kegiatan_id');
		$this->kegiatan_m->del_kegiatan(['kegiatan_id' => $kegiatan_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data kegiatan Telah dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data kegiatan Gagal dihapus');
		}
		echo json_encode($params);
	}
}
