<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['kelompok_m','akun_m']);
	}

	public function index()
	{
		$kelompok = $this->kelompok_m->get();

		$data = array(	'kelompok'	=> $kelompok
				);

		$this->template->load('template', 'master/neraca/kelompok/data', $data);
	}

	public function add()
	{
		$akun = $this->akun_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('kode_kelompok', 'Kode Kelompok', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add',
						'akun'		=> $akun
					);
		$this->template->load('template', 'master/neraca/kelompok/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'			=>	$this->session->userdata('userid'),
							'akun_id'			=>	$i->post('akun_id'),
							'kode_kelompok'		=>	$i->post('kode_kelompok'),
							'nama_kelompok'		=>	$i->post('nama_kelompok')
						);

			$this->kelompok_m->add($data);
			$this->session->set_flashdata('success', 'Data Kelompok Berhasil ditambah');
			redirect(base_url('kelompok'), 'refresh');
		// end masuk database
		}
	}

	public function edit($kelompok_id)
	{
		$kelompok = $this->kelompok_m->detail($kelompok_id);

		$akun = $this->akun_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('kode_kelompok', 'Kode Kelompok', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'kelompok'	=> $kelompok,
						'akun'		=> $akun
					);
		$this->template->load('template', 'master/neraca/kelompok/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'kelompok_id'		=>  $kelompok_id,
							'user_id'			=>	$this->session->userdata('userid'),
							'akun_id'			=>	$i->post('akun_id'),
							'kode_kelompok'		=>	$i->post('kode_kelompok'),
							'nama_kelompok'		=>	$i->post('nama_kelompok')
						);

			$this->kelompok_m->edit($data);
			$this->session->set_flashdata('success', 'Data Kelompok Berhasil diupdate');
			redirect(base_url('kelompok'), 'refresh');
		// end masuk database
		}
	}

	public function del_kelompok()
	{
		$kelompok_id = $this->input->post('kelompok_id');
		$this->kelompok_m->del_kelompok(['kelompok_id' => $kelompok_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data Kelompok Berhasil dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data Kelompok Tidak Berhasil dihapus');
		}
		echo json_encode($params);
	}
}

/* End of file A_belanja.php */
/* Location: ./application/controllers/A_belanja.php */