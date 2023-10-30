<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rincian_objek extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['rincian_objek_m','objek_m']);
	}

	public function index()
	{
		$rincian_objek = $this->rincian_objek_m->get();

		$data = array(	'rincian_objek'	=> $rincian_objek
				);

		$this->template->load('template', 'master/neraca/rincian_objek/data', $data);
	}

	public function add()
	{
		$objek = $this->objek_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('kode_rincian_objek', 'Kode Rincian Objek', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add',
						'objek'		=> $objek
					);
		$this->template->load('template', 'master/neraca/rincian_objek/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'				=>	$this->session->userdata('userid'),
							'objek_id'				=>	$i->post('objek_id'),
							'kode_rincian_objek'	=>	$i->post('kode_rincian_objek'),
							'nama_rincian_objek'	=>	$i->post('nama_rincian_objek')
						);

			$this->rincian_objek_m->add($data);
			$this->session->set_flashdata('success', 'Data Rincian Objek Berhasil ditambah');
			redirect(base_url('rincian_objek'), 'refresh');
		// end masuk database
		}
	}

	public function edit($rincian_objek_id)
	{
		$rincian_objek = $this->rincian_objek_m->detail($rincian_objek_id);

		$objek = $this->objek_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('kode_rincian_objek', 'Kode Rincian Objek', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=> 'edit',
						'rincian_objek'	=> $rincian_objek,
						'objek'			=> $objek
					);
		$this->template->load('template', 'master/neraca/rincian_objek/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'rincian_objek_id'		=>  $rincian_objek_id,
							'user_id'				=>	$this->session->userdata('userid'),
							'objek_id'				=>	$i->post('objek_id'),
							'kode_rincian_objek'	=>	$i->post('kode_rincian_objek'),
							'nama_rincian_objek'	=>	$i->post('nama_rincian_objek')
						);

			$this->rincian_objek_m->edit($data);
			$this->session->set_flashdata('success', 'Data Rincian Objek Berhasil diupdate');
			redirect(base_url('rincian_objek'), 'refresh');
		// end masuk database
		}
	}

	public function del_rincian_objek()
	{
		$rincian_objek_id = $this->input->post('rincian_objek_id');
		$this->rincian_objek_m->del_rincian_objek(['rincian_objek_id' => $rincian_objek_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data Rincian Objek Berhasil dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data Rincian Objek Tidak Berhasil dihapus');
		}
		echo json_encode($params);
	}
}

/* End of file A_belanja.php */
/* Location: ./application/controllers/A_belanja.php */