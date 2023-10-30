<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('akun_m');
	}

	public function index()
	{
		$akun = $this->akun_m->get();

		$data = array(	'akun'	=> $akun
				);

		$this->template->load('template', 'master/neraca/akun/data', $data);
	}

	public function add()
	{
		$valid = $this->form_validation;

		$valid->set_rules('kode_akun', 'Kode Akun', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'	=> 'add'
					);
		$this->template->load('template', 'master/neraca/akun/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'		=>	$this->session->userdata('userid'),
							'kode_akun'		=>	$i->post('kode_akun'),
							'nama_akun'		=>	$i->post('nama_akun')
						);

			$this->akun_m->add($data);
			$this->session->set_flashdata('success', 'Data Akun Berhasil ditambah');
			redirect(base_url('akun'), 'refresh');
		// end masuk database
		}
	}

	public function edit($akun_id)
	{
		$akun = $this->akun_m->detail($akun_id);

		$valid = $this->form_validation;

		$valid->set_rules('kode_akun', 'Kode Akun', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'akun'		=> $akun
					);
		$this->template->load('template', 'master/neraca/akun/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'akun_id'		=>  $akun_id,
							'user_id'		=>	$this->session->userdata('userid'),
							'kode_akun'		=>	$i->post('kode_akun'),
							'nama_akun'		=>	$i->post('nama_akun')
						);

			$this->akun_m->edit($data);
			$this->session->set_flashdata('success', 'Data Akun Berhasil diupdate');
			redirect(base_url('akun'), 'refresh');
		// end masuk database
		}
	}

	public function del_akun()
	{
		$akun_id = $this->input->post('akun_id');
		$this->akun_m->del_akun(['akun_id' => $akun_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data Akun Berhasil dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data Akun Tidak Berhasil dihapus');
		}
		echo json_encode($params);
	}
}

/* End of file A_belanja.php */
/* Location: ./application/controllers/A_belanja.php */