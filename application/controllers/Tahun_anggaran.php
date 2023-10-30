<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_anggaran extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('tahun_anggaran_m');
	}

	public function index()
	{
		check_admin();

		$tahun_anggaran = $this->tahun_anggaran_m->get();

		$data = array( 	'tahun_anggaran'	=>	$tahun_anggaran
					);

		$this->template->load('template', 'tahun_anggaran/data', $data);
	}

	public function add()
	{
		$valid = $this->form_validation;

		$valid->set_rules('tahun', 'Tahun Anggaran', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add',
					);
		$this->template->load('template', 'tahun_anggaran/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'tahun'		=>	$i->post('tahun')
						);

			$this->tahun_anggaran_m->add($data);
			$this->session->set_flashdata('success', 'Data Tahun Anggaran Telah ditambah');
			redirect(base_url('tahun_anggaran'), 'refresh');
		// end masuk database
		}
	}

	public function edit($tahun_anggaran_id)
	{
		$tahun_anggaran = $this->tahun_anggaran_m->detail($tahun_anggaran_id);

		$valid = $this->form_validation;

		$valid->set_rules('tahun', 'Tahun Anggaran', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'				=> 'edit',
						'tahun_anggaran'	=> $tahun_anggaran
					);
		$this->template->load('template', 'tahun_anggaran/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'tahun_anggaran_id'	=> $tahun_anggaran_id,
							'tahun'				=> $i->post('tahun')
						);

			$this->tahun_anggaran_m->edit($data);
			$this->session->set_flashdata('success', 'Data Tahun Anggaran Telah diupdate');
			redirect(base_url('tahun_anggaran'), 'refresh');
		// end masuk database
		}
	}

	public function del_tahun_anggaran()
	{
		$tahun_anggaran_id = $this->input->post('tahun_anggaran_id');
		$this->tahun_anggaran_m->del_tahun_anggaran(['tahun_anggaran_id' => $tahun_anggaran_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
			$this->session->set_flashdata('success', 'Data Tahun Anggaran Telah dihapus');
		} else {
			$params = array("success" => false);
			$this->session->set_flashdata('success', 'Data Tahun Anggaran Gagal dihapus');
		}
		redirect(base_url('tahun_anggaran'), $params, 'refresh');
	}
}
