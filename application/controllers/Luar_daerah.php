<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Luar_daerah extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['luar_daerah_m','pangkat_m','provinsi_m']);
	}

	public function index()
	{
		$luar_daerah = $this->luar_daerah_m->get();

		$data = array(	'luar_daerah'	=> $luar_daerah
						
					);
		$this->template->load('template', 'master/perjadin/luar_daerah/data', $data);
	}

	public function add()
	{
		$pangkat = $this->pangkat_m->get();
		$provinsi = $this->provinsi_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('biaya', 'Biaya', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=> 'add',
						'pangkat'		=> $pangkat,
						'provinsi'		=> $provinsi
					);
		$this->template->load('template', 'master/perjadin/luar_daerah/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'		=> $this->session->userdata('userid'),
							'pangkat_id'	=> $i->post('pangkat_id'),
							'provinsi_id'	=> $i->post('provinsi_id'),
							'biaya'			=> $i->post('biaya')
						);
			$this->luar_daerah_m->add($data);
			$this->session->set_flashdata('success', 'Data Perjadin luar Daerah sukses ditambah');
			redirect(base_url('luar_daerah'), 'refresh');
		// end masuk database
		}
	}

	public function edit($luar_daerah_id)
	{
		$luar_daerah = $this->luar_daerah_m->detail($luar_daerah_id);

		$pangkat = $this->pangkat_m->get();
		$provinsi = $this->provinsi_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('biaya', 'Biaya', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=> 'edit',
						'luar_daerah'	=> $luar_daerah,
						'pangkat'		=> $pangkat,
						'provinsi'		=> $provinsi,
					);
		$this->template->load('template', 'master/perjadin/luar_daerah/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'luar_daerah_id'	=> $luar_daerah_id,
							'user_id'			=> $this->session->userdata('userid'),
							'pangkat_id'		=> $i->post('pangkat_id'),
							'provinsi_id'		=> $i->post('provinsi_id'),
							'biaya'				=> $i->post('biaya')
						);

			$this->luar_daerah_m->edit($data);
			$this->session->set_flashdata('success', 'Data Perjadin luar Daerah Telah diupdate');
			redirect(base_url('luar_daerah'), 'refresh');
		// end masuk database
		}
	}

	public function del_luar_daerah($id)
	{
		// Panggil model untuk menghapus data berdasarkan ID
        $this->luar_daerah_m->del_luar_daerah($id);
        $this->session->set_flashdata('success', 'Data Perjadin luar Daerah Telah dihapus');
        redirect('luar_daerah'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}
}
