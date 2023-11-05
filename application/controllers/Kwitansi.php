<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kwitansi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['kwitansi_m', 'pegawai_m', 'surat_tugas_m', 'ttd_keuangan_m', 'sppd_m','npd_m']);
	}

	public function index()
	{
		$kwitansi = $this->kwitansi_m->get_pagu_kwitansi();

		$data = array(	'kwitansi'		=> $kwitansi
					);

		$this->template->load('template', 'spj/kwitansi/list', $data);
	}

	public function belanja()
	{
		$dpa_id = $this->uri->segment(2);

		$belanja = $this->kwitansi_m->get_belanja($dpa_id);

		$data = array(	'belanja'	=> $belanja
					);

		$this->template->load('template', 'spj/kwitansi/belanja', $data);
	}

	public function data()
	{
		$belanja_id = $this->uri->segment(4);

		$kwitansi = $this->kwitansi_m->get($belanja_id);
		$ttd_keuangan = $this->ttd_keuangan_m->get();

		$data = array(	'kwitansi'		=> $kwitansi,
						'ttd_keuangan'	=> $ttd_keuangan
					);

		$this->template->load('template', 'spj/kwitansi/data', $data);
	}

	public function add()
	{
		$belanja_id = $this->uri->segment(4);

		$npd = $this->kwitansi_m->get_npd($belanja_id);

		$valid = $this->form_validation;

		$valid->set_rules('npd_id', 'Uraian', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'add',
						'npd'		=> $npd
					);
		$this->template->load('template', 'spj/kwitansi/add', $data);
		// masuk database
		}else{
		$i = $this->input;
		$data = array(	'user_id'		=> $this->session->userdata('userid'),
						'npd_id'		=> $i->post('npd_id'),
						'nomor_bukti'	=> $i->post('nomor_bukti'),
						'tanggal'		=> $i->post('tanggal')
					);

			$this->kwitansi_m->add($data);
			$this->session->set_flashdata('success', 'Data Kwitansi Telah ditambah');
			redirect(base_url('kwitansi/'.$this->uri->segment(2).'/belanja/'.$this->uri->segment(4).'/data'), 'refresh');
		// end masuk database
		}
	}

	public function edit($kwitansi_id)
	{
		$belanja_id = $this->uri->segment(4);
		$kwitansi_id = $this->uri->segment(6);

		$kwitansi = $this->kwitansi_m->detail($kwitansi_id);
		$npd = $this->kwitansi_m->get_npd($belanja_id);

		$valid = $this->form_validation;

		$valid->set_rules('npd_id', 'Uraian', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'		=> 'edit',
						'kwitansi'	=> $kwitansi,
						'npd'		=> $npd
					);
		$this->template->load('template', 'spj/kwitansi/edit', $data);
		// masuk database
		}else{
		$i = $this->input;
		$data = array(	'kwitansi_id'	=> $kwitansi_id,
						'user_id'		=> $this->session->userdata('userid'),
						'npd_id'		=> $i->post('npd_id'),
						'nomor_bukti'	=> $i->post('nomor_bukti'),
						'tanggal'		=> $i->post('tanggal')
					);

			$this->kwitansi_m->edit($data);
			$this->session->set_flashdata('success', 'Data Kwitansi Telah diUpdate');
			redirect(base_url('kwitansi/'.$this->uri->segment(2).'/belanja/'.$this->uri->segment(4).'/data'), 'refresh');
		// end masuk database
		}
	}

	public function del_kwitansi($id)
	{
		// Panggil model untuk menghapus data berdasarkan ID
        $this->kwitansi_m->del_kwitansi($id);
        $this->session->set_flashdata('success', 'Data Kwitansi Telah dihapus');
        redirect(base_url('kwitansi'), 'refresh'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}

	public function cetak()
	{
		$tanggalDipilih = $this->input->get('tanggal');
		$format_cetak = $this->input->get('format_cetak');
		$pa_kpa = $this->input->get('pa_kpa');
		$pptk = $this->input->get('pptk');
		$bp_bpp = $this->input->get('bp_bpp');
		
		$selected_pa_kpa = $this->kwitansi_m->get_selected_data($pa_kpa);
		$selected_pptk = $this->kwitansi_m->get_selected_data($pptk);
		$selected_bp_bpp = $this->kwitansi_m->get_selected_data($bp_bpp);
		$kwitansi = $this->kwitansi_m->cetak($tanggalDipilih);

		$data = array(	'title'				=> 'Kwitansi',
						'kwitansi'			=> $kwitansi,
						'selected_pa_kpa'	=> $selected_pa_kpa,
						'selected_pptk'		=> $selected_pptk,
						'selected_bp_bpp'	=> $selected_bp_bpp
					);

		if ($format_cetak == 'kwitansi') {
		$this->load->view('spj/kwitansi/cetak/kwitansi', $data, FALSE);

		} elseif ($format_cetak == 'kwitansi_mamin_fc') {
		$this->load->view('spj/kwitansi/cetak/kwitansi_mamin_fc', $data, FALSE);

		} elseif ($format_cetak == 'kwitansi_dinas_biasa') {
		$this->load->view('spj/kwitansi/cetak/kwitansi_dinas_biasa', $data, FALSE);

		} else {
            // Tindakan jika pilihan tidak valid
        }
	}
}

/* End of file Kwitansi.php */
/* Location: ./application/controllers/Kwitansi.php */