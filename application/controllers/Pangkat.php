<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pangkat extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('pangkat_m');
	}

	public function index()
	{
		$pangkat = $this->pangkat_m->get();

		$data = array(	'pangkat'	=> $pangkat
				);

		$this->template->load('template', 'master/daftar_pegawai/pangkat/data', $data);
	}

	public function add()
	{
		$valid = $this->form_validation;

		$valid->set_rules('pangkat', 'Pangkat', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add'
					);
		$this->template->load('template', 'master/daftar_pegawai/pangkat/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'	=>	$this->session->userdata('userid'),
							'pangkat'	=>	$i->post('pangkat'),
							'golongan'	=>	$i->post('golongan')
						);
			$this->pangkat_m->add($data);
			$this->session->set_flashdata('success', 'Data Pangkat sukses ditambah');
			redirect(base_url('pangkat'), 'refresh');
		// end masuk database
		}
	}

	public function edit($pangkat_id)
	{
		$pangkat = $this->pangkat_m->detail($pangkat_id);

		$valid = $this->form_validation;

		$valid->set_rules('pangkat', 'Pangkat', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'pangkat'	=> $pangkat
					);
		$this->template->load('template', 'master/daftar_pegawai/pangkat/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'pangkat_id'	=>	$pangkat_id,
							'user_id'		=>	$this->session->userdata('userid'),
							'pangkat'		=>	$i->post('pangkat'),
							'golongan'		=>	$i->post('golongan')
						);
			$this->pangkat_m->edit($data);
			$this->session->set_flashdata('success', 'Data Pangkat Telah diupdate');
			redirect(base_url('pangkat'), 'refresh');
		// end masuk database
		}
	}

	public function del_pangkat($id)
	{      
        // Panggil model untuk menghapus data berdasarkan ID
        $this->pangkat_m->del_pangkat($id);
        $this->session->set_flashdata('success', 'Data Pangkat Telah dihapus');
        redirect('pangkat'); // Ganti 'data_controller' dengan nama controller yang sesuai
 		
	}
}
