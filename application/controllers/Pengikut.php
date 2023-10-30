<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengikut extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['pegawai_m','surat_tugas_m','pengikut_m']);
		$this->load->helper('fungsi_helper');
	}

	public function index()
	{
		$surat_tugas_id = $this->uri->segment(2);

		$pengikut = $this->pengikut_m->get($surat_tugas_id);

		$data = array(	'pengikut'	=>	$pengikut

					);
		$this->template->load('template', 'spj/spt/pengikut/data', $data);
	}

	public function add()
	{
		$surat_tugas_id = $this->uri->segment(2);
		$surat_tugas = $this->surat_tugas_m->detail($surat_tugas_id);

		$pegawai = $this->pegawai_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('pegawai_id', 'Nama Pegawai', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=>	'add',
						'surat_tugas'	=>	$surat_tugas,
						'pegawai'		=>	$pegawai
					);
		$this->template->load('template', 'spj/spt/pengikut/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'			=> $this->session->userdata('userid'),
							'surat_tugas_id'	=> $surat_tugas_id,
							'pegawai_id'		=> $i->post('pegawai_id')
						);

			$this->pengikut_m->add($data);
			$this->session->set_flashdata('success', 'Data Pengikut Telah ditambah');
			redirect(base_url('surat_tugas/'.$this->uri->segment(2).'/pengikut'), 'refresh');
		// end masuk database
		}
	}

	public function edit($pengikut_id)
	{
		$surat_tugas_id = $this->uri->segment(2);

		$pengikut_id = $this->uri->segment(5);
		$pengikut = $this->pengikut_m->detail($pengikut_id);

		$pegawai = $this->pegawai_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('pegawai_id', 'Nama Pegawai', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'pengikut'	=> $pengikut,
						'pegawai'	=> $pegawai
					);
		$this->template->load('template', 'spj/spt/pengikut/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'pengikut_id'		=> $pengikut_id,
							'user_id'			=> $this->session->userdata('userid'),
							'surat_tugas_id'	=> $surat_tugas_id,
							'pegawai_id'		=> $i->post('pegawai_id')
						);

			$this->pengikut_m->edit($data);
			$this->session->set_flashdata('success', 'Data Pengikut Telah diupdate');
			redirect(base_url('surat_tugas/'.$this->uri->segment(2).'/pengikut'), 'refresh');
		// end masuk database
		}
	}

	public function del_pengikut($id)
	{
		// Panggil model untuk menghapus data berdasarkan ID
        $this->pengikut_m->del_pengikut($id);
        $this->session->set_flashdata('success', 'Data Pengikut Telah dihapus');
        redirect('pengikut'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}

}

/* End of file Pengikut.php */
/* Location: ./application/controllers/Pengikut.php */