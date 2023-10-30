<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('level_m');
	}

	public function index()
	{
		check_admin();

		$level = $this->level_m->get();

		$data = array( 	'level'	=>	$level
					);

		$this->template->load('template', 'level/data', $data);
	}

	public function add()
	{
		$valid = $this->form_validation;

		$valid->set_rules('level', 'Level', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add',
					);
		$this->template->load('template', 'level/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'level'		=>	$i->post('level')
						);

			$this->level_m->add($data);
			$this->session->set_flashdata('success', 'Data Level Telah ditambah');
			redirect(base_url('level'), 'refresh');
		// end masuk database
		}
	}

	public function edit($level_id)
	{
		$level = $this->level_m->detail($level_id);

		$valid = $this->form_validation;

		$valid->set_rules('level', 'Nama Level', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'level'		=> $level
					);
		$this->template->load('template', 'level/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'level_id'	=> $level_id,
							'level'		=>	$i->post('level')
						);

			$this->level_m->edit($data);
			$this->session->set_flashdata('success', 'Data Level Telah diupdate');
			redirect(base_url('level'), 'refresh');
		// end masuk database
		}
	}

	public function del_level()
	{
		$level_id = $this->input->post('level_id');
		$this->level_m->del_level(['level_id' => $level_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data Dasar Hukum Telah dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data Dasar Hukum Gagal dihapus');
		}
		redirect(base_url('level'), $params, 'refresh');
	}
}
