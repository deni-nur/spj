<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dalam_daerah extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['dalam_daerah_m','pangkat_m','kecamatan_m']);
	}

	public function index()
	{
		$dalam_daerah = $this->dalam_daerah_m->get();

		$data = array(	'dalam_daerah'	=> $dalam_daerah
						
					);
		$this->template->load('template', 'master/perjadin/dalam_daerah/data', $data);
	}

	public function add()
	{
		$pangkat = $this->pangkat_m->get();
		$kecamatan = $this->kecamatan_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('biaya', 'Biaya', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=> 'add',
						'pangkat'		=> $pangkat,
						'kecamatan'		=> $kecamatan
					);
		$this->template->load('template', 'master/perjadin/dalam_daerah/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'		=> $this->session->userdata('userid'),
							'pangkat_id'	=> $i->post('pangkat_id'),
							'kecamatan_id'	=> $i->post('kecamatan_id'),
							'biaya'			=> $i->post('biaya')
						);
			$this->dalam_daerah_m->add($data);
			$this->session->set_flashdata('success', 'Data Perjadin Dalam Daerah sukses ditambah');
			redirect(base_url('dalam_daerah'), 'refresh');
		// end masuk database
		}
	}

	public function edit($dalam_daerah_id)
	{
		$dalam_daerah = $this->dalam_daerah_m->detail($dalam_daerah_id);

		$pangkat = $this->pangkat_m->get();
		$kecamatan = $this->kecamatan_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('biaya', 'Biaya', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=> 'edit',
						'dalam_daerah'	=> $dalam_daerah,
						'pangkat'		=> $pangkat,
						'kecamatan'		=> $kecamatan,
					);
		$this->template->load('template', 'master/perjadin/dalam_daerah/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'dalam_daerah_id'	=> $dalam_daerah_id,
							'user_id'			=> $this->session->userdata('userid'),
							'pangkat_id'		=> $i->post('pangkat_id'),
							'kecamatan_id'		=> $i->post('kecamatan_id'),
							'biaya'				=> $i->post('biaya')
						);

			$this->dalam_daerah_m->edit($data);
			$this->session->set_flashdata('success', 'Data Perjadin Dalam Daerah Telah diupdate');
			redirect(base_url('dalam_daerah'), 'refresh');
		// end masuk database
		}
	}

	public function del_dalam_daerah($id)
	{
		// Panggil model untuk menghapus data berdasarkan ID
        $this->dalam_daerah_m->del_dalam_daerah($id);
        $this->session->set_flashdata('success', 'Data Perjadin Dalam Daerah Telah dihapus');
        redirect('dalam_daerah'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}
}
