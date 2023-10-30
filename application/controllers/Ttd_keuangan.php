<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ttd_keuangan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['pegawai_m','pangkat_m','jabatan_m','ttd_keuangan_m']);
	}

	public function index()
	{	
		$ttd_keuangan = $this->ttd_keuangan_m->get();

		$data = array(	'ttd_keuangan' => $ttd_keuangan
					);
		$this->template->load('template', 'master/ttd/keuangan/data', $data);
	}

	public function add()
	{
		$pegawai = $this->pegawai_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('jabatan_ttd_keuangan', 'Pejabat Penandatangan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=> 'add',
						'pegawai'		=> $pegawai
					);
		$this->template->load('template', 'master/ttd/keuangan/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'				=> $this->session->userdata('userid'),
							'pegawai_id'			=> $i->post('pegawai_id'),
							'jabatan_ttd_keuangan'	=> $i->post('jabatan_ttd_keuangan')
						);
			$this->ttd_keuangan_m->add($data);
			$this->session->set_flashdata('success', 'Data Pejabat Penandatangan Keuangan sukses ditambah');
			redirect(base_url('ttd_keuangan'), 'refresh');
		// end masuk database
		}
	}

	public function edit($ttd_keuangan_id)
	{
		$ttd_keuangan = $this->ttd_keuangan_m->detail($ttd_keuangan_id);

		$pegawai = $this->pegawai_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('jabatan_ttd_keuangan', 'Pejabat Penandatangan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=> 'edit',
						'ttd_keuangan'	=> $ttd_keuangan,
						'pegawai'		=> $pegawai,
					);
		$this->template->load('template', 'master/ttd/keuangan/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'ttd_keuangan_id'		=> $ttd_keuangan_id,
							'user_id'				=> $this->session->userdata('userid'),
							'pegawai_id'			=> $i->post('pegawai_id'),
							'jabatan_ttd_keuangan'	=> $i->post('jabatan_ttd_keuangan')
						);
			$this->ttd_keuangan_m->edit($data);
			$this->session->set_flashdata('success', 'Data Pejabat Penandatangan Keuangan Telah diupdate');
			redirect(base_url('ttd_keuangan'), 'refresh');
		// end masuk database
		}
	}

	public function del_ttd_keuangan($id)
	{
		$this->ttd_keuangan_m->del_ttd_keuangan($id);
        $this->session->set_flashdata('success', 'Data Pejabat Penandatangan Telah dihapus');
        redirect('ttd_keuangan'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}
}
