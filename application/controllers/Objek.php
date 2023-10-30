<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Objek extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['objek_m','jenis_m']);
	}

	public function index()
	{
		$objek = $this->objek_m->get();

		$data = array(	'objek'	=> $objek
				);

		$this->template->load('template', 'master/neraca/objek/data', $data);
	}

	public function add()
	{
		$jenis = $this->jenis_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('kode_objek', 'Kode Objek', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add',
						'jenis'		=> $jenis
					);
		$this->template->load('template', 'master/neraca/objek/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'			=>	$this->session->userdata('userid'),
							'jenis_id'			=>	$i->post('jenis_id'),
							'kode_objek'		=>	$i->post('kode_objek'),
							'nama_objek'		=>	$i->post('nama_objek')
						);

			$this->objek_m->add($data);
			$this->session->set_flashdata('success', 'Data Objek Berhasil ditambah');
			redirect(base_url('objek'), 'refresh');
		// end masuk database
		}
	}

	public function edit($objek_id)
	{
		$objek = $this->objek_m->detail($objek_id);

		$jenis = $this->jenis_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('kode_objek', 'Kode Objek', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'objek'		=> $objek,
						'jenis'		=> $jenis
					);
		$this->template->load('template', 'master/neraca/objek/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'objek_id'		=>  $objek_id,
							'user_id'		=>	$this->session->userdata('userid'),
							'jenis_id'		=>	$i->post('jenis_id'),
							'kode_objek'	=>	$i->post('kode_objek'),
							'nama_objek'	=>	$i->post('nama_objek')
						);

			$this->objek_m->edit($data);
			$this->session->set_flashdata('success', 'Data Objek Berhasil diupdate');
			redirect(base_url('objek'), 'refresh');
		// end masuk database
		}
	}

	public function del_objek()
	{
		$objek_id = $this->input->post('objek_id');
		$this->objek_m->del_objek(['objek_id' => $objek_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data Objek Berhasil dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data Objek Tidak Berhasil dihapus');
		}
		echo json_encode($params);
	}
}

/* End of file A_belanja.php */
/* Location: ./application/controllers/A_belanja.php */