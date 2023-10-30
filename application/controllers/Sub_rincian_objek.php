<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_rincian_objek extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['sub_rincian_objek_m','rincian_objek_m']);
	}

	public function index()
	{
		$sub_rincian_objek = $this->sub_rincian_objek_m->get();

		$data = array(	'sub_rincian_objek'	=> $sub_rincian_objek
				);

		$this->template->load('template', 'master/neraca/sub_rincian_objek/data', $data);
	}

	public function add()
	{
		$rincian_objek = $this->rincian_objek_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('kode_sub_rincian_objek', 'Kode Sub Rincian Objek', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'				=> 'add',
						'rincian_objek'		=> $rincian_objek
					);
		$this->template->load('template', 'master/neraca/sub_rincian_objek/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'					=>	$this->session->userdata('userid'),
							'rincian_objek_id'			=>	$i->post('rincian_objek_id'),
							'kode_sub_rincian_objek'	=>	$i->post('kode_sub_rincian_objek'),
							'nama_sub_rincian_objek'	=>	$i->post('nama_sub_rincian_objek')
						);

			$this->sub_rincian_objek_m->add($data);
			$this->session->set_flashdata('success', 'Data Sub Rincian Objek Berhasil ditambah');
			redirect(base_url('sub_rincian_objek'), 'refresh');
		// end masuk database
		}
	}

	public function edit($sub_rincian_objek_id)
	{
		$sub_rincian_objek = $this->sub_rincian_objek_m->detail($sub_rincian_objek_id);
		$rincian_objek = $this->rincian_objek_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('kode_sub_rincian_objek', 'Kode Sub Rincian Objek', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'				=> 'edit',
						'sub_rincian_objek'	=> $sub_rincian_objek,
						'rincian_objek'		=> $rincian_objek

					);
		$this->template->load('template', 'master/neraca/sub_rincian_objek/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'sub_rincian_objek_id'		=>	$sub_rincian_objek_id,
							'user_id'					=>	$this->session->userdata('userid'),
							'rincian_objek_id'			=>	$i->post('rincian_objek_id'),
							'kode_sub_rincian_objek'	=>	$i->post('kode_sub_rincian_objek'),
							'nama_sub_rincian_objek'	=>	$i->post('nama_sub_rincian_objek')
						);

			$this->sub_rincian_objek_m->edit($data);
			$this->session->set_flashdata('success', 'Data Sub Rincian Objek Berhasil diupdate');
			redirect(base_url('sub_rincian_objek'), 'refresh');
		// end masuk database
		}
	}

	public function del_sub_rincian_objek()
	{
		$sub_rincian_objek_id = $this->input->post('sub_rincian_objek_id');
		$this->sub_rincian_objek_m->del_sub_rincian_objek(['sub_rincian_objek_id' => $sub_rincian_objek_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data Sub Rincian Objek Berhasil dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data Sub Rincian Objek Tidak Berhasil dihapus');
		}
		echo json_encode($params);
	}
}

/* End of file A_belanja.php */
/* Location: ./application/controllers/A_belanja.php */