<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_tugas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['surat_tugas_m','darhum_m','pegawai_m','ttd_administrasi_m','pengikut_m']);
	}

	public function index()
	{
		$ttd_administrasi = $this->ttd_administrasi_m->get();
		$surat_tugas = $this->surat_tugas_m->get();

		$data = array(	'surat_tugas'	=> $surat_tugas,
						'ttd_administrasi'	=> $ttd_administrasi
					);
		$this->template->load('template', 'spj/spt/pelaksanaan/data', $data);
	}

	public function add()
	{
		$pegawai = $this->pegawai_m->get();
		$ttd_administrasi = $this->ttd_administrasi_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('maksud', 'Maksud Perjadin', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'				=> 'add',
						'pegawai'			=> $pegawai,
						'ttd_administrasi'	=> $ttd_administrasi
					);
		$this->template->load('template', 'spj/spt/pelaksanaan/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'				=> $this->session->userdata('userid'),
							'pegawai_id'			=> $i->post('pegawai_id'),
							//'ttd_administrasi_id'	=> $i->post('ttd_administrasi_id'),
							'no_surat_tugas'		=> $i->post('no_surat_tugas'),
							'dasar_surat'			=> $i->post('dasar_surat'),
							'maksud'				=> $i->post('maksud'),
							'alamat'				=> $i->post('alamat'),
							'tanggal_surat'			=> $i->post('tanggal_surat')
						);
			$this->surat_tugas_m->add($data);
			$this->session->set_flashdata('success', 'Data Surat Tugas sukses ditambah');
			redirect(base_url('surat_tugas'), 'refresh');
		// end masuk database
		}
	}

	public function edit($surat_tugas_id)
	{
		$surat_tugas = $this->surat_tugas_m->detail($surat_tugas_id);

		$pegawai = $this->pegawai_m->get();
		$ttd_administrasi = $this->ttd_administrasi_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('maksud', 'Maksud Perjadin', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'				=> 'edit',
						'surat_tugas'		=> $surat_tugas,
						'pegawai'			=> $pegawai,
						'ttd_administrasi'	=> $ttd_administrasi
					);
		$this->template->load('template', 'spj/spt/pelaksanaan/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'surat_tugas_id'		=> $surat_tugas_id,
							'user_id'				=> $this->session->userdata('userid'),
							'pegawai_id'			=> $i->post('pegawai_id'),
							//'ttd_administrasi_id'	=> $i->post('ttd_administrasi_id'),
							'no_surat_tugas'		=> $i->post('no_surat_tugas'),
							'dasar_surat'			=> $i->post('dasar_surat'),
							'maksud'				=> $i->post('maksud'),
							'alamat'				=> $i->post('alamat'),
							'tanggal_surat'			=> $i->post('tanggal_surat')
						);
			$this->surat_tugas_m->edit($data);
			$this->session->set_flashdata('success', 'Data Surat Tugas Telah diupdate');
			redirect(base_url('surat_tugas'), 'refresh');
		// end masuk database
		}
	}

	public function del_surat_tugas($id)
	{      
        // Panggil model untuk menghapus data berdasarkan ID
        $this->surat_tugas_m->del_surat_tugas($id);
        $this->session->set_flashdata('success', 'Data Surat Tugas Telah dihapus');
        redirect('surat_tugas'); // Ganti 'data_controller' dengan nama controller yang sesuai
 		
	}

	public function cetak()
	{
		$format_cetak = $this->input->get('format_cetak');

        $surat_tugas_id = $this->input->get('surat_tugas_id');
		$ttd_administrasi_id = $this->input->get('ttd_administrasi_id');
		$selected_data = $this->surat_tugas_m->get_selected_data($ttd_administrasi_id);

		$data_surat_tugas = $this->surat_tugas_m->cetak($surat_tugas_id);
		$darhum = $this->darhum_m->get();
		$pengikut = $this->pengikut_m->get($surat_tugas_id);
		
		$data = array(	'data_surat_tugas'	=> $data_surat_tugas,
						'darhum'			=> $darhum,
						'pengikut'			=> $pengikut,
						'selected_data'		=> $selected_data
					);

		if ($format_cetak == 'tte') {
		$this->load->view('spj/spt/pelaksanaan/cetak_tte', $data, FALSE);
		
        } elseif ($format_cetak == 'spj') {
		$this->load->view('spj/spt/pelaksanaan/cetak_basah', $data, FALSE);
        } else {
            // Tindakan jika pilihan tidak valid
        }
	}
}

/* End of file surat_tugas.php */
/* Location: ./application/controllers/St.php */