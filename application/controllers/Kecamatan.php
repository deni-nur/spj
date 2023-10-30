<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['kecamatan_m','kokab_m']);
	}

	public function index()
	{
		$kecamatan = $this->kecamatan_m->get();

		$data = array(	'kecamatan'	=> $kecamatan
				);

		$this->template->load('template', 'master/wilayah/kecamatan/data', $data);
	}

	public function add()
	{
		$kokab = $this->kokab_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama Kecamatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add',
						'kokab'		=> $kokab
					);
		$this->template->load('template', 'master/wilayah/kecamatan/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'	=>	$this->session->userdata('userid'),
							'kokab_id'	=>	$i->post('kokab_id'),
							'name'		=>	$i->post('name')
						);

			$this->kecamatan_m->add($data);
			$this->session->set_flashdata('success', 'Data Kecamatan sukses ditambah');
			redirect(base_url('kecamatan'), 'refresh');
		// end masuk database
		}
	}

	public function edit($kecamatan_id)
	{
		$kecamatan = $this->kecamatan_m->detail($kecamatan_id);
		$kokab = $this->kokab_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama Kecamatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'kecamatan'	=> $kecamatan,
						'kokab'		=> $kokab
					);
		$this->template->load('template', 'master/wilayah/kecamatan/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'kecamatan_id'	=>	$kecamatan_id,
							'user_id'		=>	$this->session->userdata('userid'),
							'kokab_id'		=>	$i->post('kokab_id'),
							'name'			=>	$i->post('name')
						);

			$this->kecamatan_m->edit($data);
			$this->session->set_flashdata('success', 'Data Kecamatan Telah diupdate');
			redirect(base_url('kecamatan'), 'refresh');
		// end masuk database
		}
	}

	public function del_kecamatan()
	{
		$kecamatan_id = $this->input->post('kecamatan_id');
		$this->kecamatan_m->del_kecamatan(['kecamatan_id' => $kecamatan_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data Kecamatan Telah dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data Kecamatan Gagal dihapus');
		}
		echo json_encode($params);
	}
}
