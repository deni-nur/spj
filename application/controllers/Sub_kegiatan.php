<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_kegiatan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['sub_kegiatan_m','kegiatan_m','program_m']);
	}

	public function index()
	{
		$sub_kegiatan = $this->sub_kegiatan_m->get();

		$data = array(	'sub_kegiatan'	=> $sub_kegiatan
				);

		$this->template->load('template', 'master/renstra/sub_kegiatan/data', $data);
	}

	public function add()
	{
		$kegiatan = $this->kegiatan_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama kegiatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=>	'add',
						'kegiatan'	=>	$kegiatan
					);
		$this->template->load('template', 'master/renstra/sub_kegiatan/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'		=>	$this->session->userdata('userid'),
							'kegiatan_id'	=>	$i->post('kegiatan_id'),
							'kode'			=>	$i->post('kode'),
							'name'			=>	$i->post('name')
						);

			$this->sub_kegiatan_m->add($data);
			$this->session->set_flashdata('success', 'Data kegiatan sukses ditambah');
			redirect(base_url('sub_kegiatan'), 'refresh');
		// end masuk database
		}
	}

	public function edit($sub_kegiatan_id)
	{
		$kegiatan = $this->kegiatan_m->get();
		$sub_kegiatan = $this->sub_kegiatan_m->detail($sub_kegiatan_id);

		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama Sub Kegiatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=>	'edit',
						'kegiatan'		=>	$kegiatan,
						'sub_kegiatan'	=>	$sub_kegiatan
					);
		$this->template->load('template', 'master/renstra/sub_kegiatan/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'sub_kegiatan_id'	=>	$sub_kegiatan_id,
							'user_id'			=>	$this->session->userdata('userid'),
							'kegiatan_id'		=>	$i->post('kegiatan_id'),
							'kode'				=>	$i->post('kode'),
							'name'				=>	$i->post('name')
						);

			$this->sub_kegiatan_m->edit($data);
			$this->session->set_flashdata('success', 'Data Sub Kegiatan Telah diupdate');
			redirect(base_url('sub_kegiatan'), 'refresh');
		// end masuk database
		}
	}

	public function del_sub_kegiatan()
	{
		$sub_kegiatan_id = $this->input->post('sub_kegiatan_id');
		$this->sub_kegiatan_m->del_sub_kegiatan(['sub_kegiatan_id' => $sub_kegiatan_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data Sub Kegiatan Telah dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data Sub Kegiatan Gagal dihapus');
		}
		echo json_encode($params);
	}
}
