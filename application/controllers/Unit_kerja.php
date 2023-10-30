<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_kerja extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('unit_kerja_m');
	}

	public function index()
	{
		check_admin();

		$unit_kerja = $this->unit_kerja_m->get();

		$data = array( 	'unit_kerja'	=>	$unit_kerja
					);

		$this->template->load('template', 'unit_kerja/data', $data);
	}

	public function add()
	{
		$valid = $this->form_validation;

		$valid->set_rules('unit_kerja', 'Unit Kerja', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add',
					);
		$this->template->load('template', 'unit_kerja/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'unit_kerja'		=>	$i->post('unit_kerja')
						);

			$this->unit_kerja_m->add($data);
			$this->session->set_flashdata('success', 'Data Unit Kerja Telah ditambah');
			redirect(base_url('unit_kerja'), 'refresh');
		// end masuk database
		}
	}

	public function edit($unit_kerja_id)
	{
		$unit_kerja = $this->unit_kerja_m->detail($unit_kerja_id);

		$valid = $this->form_validation;

		$valid->set_rules('unit_kerja', 'Unit Kerja', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=> 'edit',
						'unit_kerja'	=> $unit_kerja
					);
		$this->template->load('template', 'unit_kerja/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'unit_kerja_id'	=> $unit_kerja_id,
							'unit_kerja'	=> $i->post('unit_kerja')
						);

			$this->unit_kerja_m->edit($data);
			$this->session->set_flashdata('success', 'Data Unit Kerja Telah diupdate');
			redirect(base_url('unit_kerja'), 'refresh');
		// end masuk database
		}
	}

	public function del_unit_kerja()
	{
		$unit_kerja_id = $this->input->post('unit_kerja_id');
		$this->unit_kerja_m->del_unit_kerja(['unit_kerja_id' => $unit_kerja_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data Tahun Anggaran Telah dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data Tahun Anggaran Gagal dihapus');
		}
		redirect(base_url('unit_kerja'), $params, 'refresh');
	}
}
