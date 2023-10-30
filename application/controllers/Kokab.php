<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kokab extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['kokab_m','provinsi_m']);
	}

	public function index()
	{
		$kokab = $this->kokab_m->get();

		$data = array(	'kokab'	=> $kokab				
					);

		$this->template->load('template', 'master/wilayah/kokab/data', $data);
	}

	public function add()
	{
		$provinsi = $this->provinsi_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama kokab', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add',
						'provinsi'	=> $provinsi
					);
		$this->template->load('template', 'master/wilayah/kokab/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'		=> $this->session->userdata('userid'),
							'provinsi_id'	=> $i->post('provinsi_id'),
							'name'			=> $i->post('name')
						);

			$this->kokab_m->add($data);
			$this->session->set_flashdata('success', 'Data Kabupaten/Kota sukses ditambah');
			redirect(base_url('kokab'), 'refresh');
		// end masuk database
		}
	}

	public function edit($kokab_id)
	{
		$kokab = $this->kokab_m->detail($kokab_id);

		$provinsi = $this->provinsi_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama kokab', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'kokab'		=> $kokab,
						'provinsi'	=> $provinsi
					);
		$this->template->load('template', 'master/wilayah/kokab/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'kokab_id'		=> $kokab_id,
							'user_id'		=> $this->session->userdata('userid'),
							'provinsi_id'	=> $i->post('provinsi_id'),
							'name'			=> $i->post('name')
						);

			$this->kokab_m->edit($data);
			$this->session->set_flashdata('success', 'Data Kabupaten/Kota Telah diupdate');
			redirect(base_url('kokab'), 'refresh');
		// end masuk database
		}
	}

	public function del_kokab()
	{
		$kokab_id = $this->input->post('kokab_id');
		$this->kokab_m->del_kokab(['kokab_id' => $kokab_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data Kabupaten/Kota Telah dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data Kabupaten/Kota Gagal diupdate');
		}
		echo json_encode($params);
	}

}

/* End of file Kabupaten.php */
/* Location: ./application/controllers/Kabupaten.php */