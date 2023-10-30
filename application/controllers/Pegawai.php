<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['pegawai_m', 'pangkat_m', 'jabatan_m']);
	}

	public function index()
	{
		$pegawai = $this->pegawai_m->get();

		$data = array(	'pegawai'	=> $pegawai
						
					);
		$this->template->load('template', 'master/daftar_pegawai/pegawai/data', $data);
	}

	public function add()
	{
		$pangkat = $this->pangkat_m->get();
		$jabatan = $this->jabatan_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama Pegawai', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add',
						'pangkat'	=> $pangkat,
						'jabatan'	=> $jabatan
					);
		$this->template->load('template', 'master/daftar_pegawai/pegawai/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'		=> $this->session->userdata('userid'),
							'pangkat_id'	=> $i->post('pangkat_id'),
							'jabatan_id'	=> $i->post('jabatan_id'),
							'nip'			=> $i->post('nip'),
							'name'			=> $i->post('name')
						);
			$this->pegawai_m->add($data);
			$this->session->set_flashdata('success', 'Data Pegawai sukses ditambah');
			redirect(base_url('pegawai'), 'refresh');
		// end masuk database
		}
	}

	public function edit($pegawai_id)
	{
		$pegawai = $this->pegawai_m->detail($pegawai_id);

		$pangkat = $this->pangkat_m->get();
		$jabatan = $this->jabatan_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('name', 'Nama Pegawai', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'pegawai'	=> $pegawai,
						'pangkat'	=> $pangkat,
						'jabatan'	=> $jabatan
					);
		$this->template->load('template', 'master/daftar_pegawai/pegawai/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'pegawai_id'	=> $pegawai_id,
							'user_id'		=> $this->session->userdata('userid'),
							'pangkat_id'	=> $i->post('pangkat_id'),
							'jabatan_id'	=> $i->post('jabatan_id'),
							'nip'			=> $i->post('nip'),
							'name'			=> $i->post('name')
						);
			$this->pegawai_m->edit($data);
			$this->session->set_flashdata('success', 'Data Pegawai Telah diupdate');
			redirect(base_url('pegawai'), 'refresh');
		// end masuk database
		}
	}

	public function del_pegawai($id)
	{
		// Panggil model untuk menghapus data berdasarkan ID
        $this->pegawai_m->del_pegawai($id);
        $this->session->set_flashdata('success', 'Data pegawai Telah dihapus');
        redirect('pegawai'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}

	function nip_barcode_qrcode($id)
	{
		$data['row'] = $this->pegawai_m->get($id)->row();
		$this->template->load('template', 'master/daftar_pegawai/pegawai/nip_barcode_qrcode', $data);
	}

	function nip_barcode_print($id)
	{
		$data['row'] = $this->pegawai_m->get($id)->row();
		$html = $this->load->view('master/daftar_pegawai/pegawai/nip_barcode_print', $data, TRUE);
		$this->fungsi->PdfGenerator($html, 'nip-'.$data['row']->nip, 'A4', 'landscape');
	}

	function nip_qrcode_print($id)
	{
		$data['row'] = $this->pegawai_m->get($id)->row();
		$html = $this->load->view('master/daftar_pegawai/pegawai/nip_qrcode_print', $data, TRUE);
		$this->fungsi->PdfGenerator($html, 'qrcode-'.$data['row']->nip, 'A4', 'potrait');
	}
}
