<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Npd extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['kegiatan_m','program_m','surat_tugas_m','rekening_m','npd_m','pengikut_m','ttd_keuangan_m','sppd_m','dpa_m','dalam_daerah_m','luar_daerah_m']);
	}

	public function index()
	{
		$npd = $this->dpa_m->get();

		$data = array(	'npd'		=>	$npd
					);

		$this->template->load('template', 'spj/npd/data', $data);
	}

	public function rincian()
	{
		$dpa_id = $this->uri->segment(2);

		$belanja = $this->dpa_m->getbelanja();
		$npd = $this->npd_m->get($dpa_id);
		$ttd_keuangan = $this->ttd_keuangan_m->get();

		$data = array(	'belanja'		=>	$belanja,
						'npd'			=>	$npd,
						'ttd_keuangan'	=>	$ttd_keuangan
					);

		$this->template->load('template', 'spj/npd/rincian', $data);
	}

	public function add()
	{
		$dpa_id = $this->uri->segment(2);

		$dpa = $this->dpa_m->get();
		$surat_tugas = $this->surat_tugas_m->get();
		$ttd_keuangan = $this->ttd_keuangan_m->get();
		$belanja = $this->dpa_m->getbelanja($dpa_id);
		$sppd = $this->sppd_m->get();
		$pengikut = $this->npd_m->get_pengikut();
		$rekening = $this->rekening_m->get();
		$dalam_daerah = $this->dalam_daerah_m->get();
		$luar_daerah = $this->luar_daerah_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('belanja_id', 'Rincian Belanja', 'required',
				array(	'required'	=>	'%s harus diisi'));

		$valid->set_rules('uraian', 'Uraian', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=> 'add',
						'dpa'			=> $dpa,
						'surat_tugas'	=> $surat_tugas,
						'ttd_keuangan'	=> $ttd_keuangan,
						'belanja'		=> $belanja,
						'sppd'			=> $sppd,
						'pengikut'		=> $pengikut,
						'rekening'		=> $rekening,
						'dalam_daerah'	=> $dalam_daerah,
						'luar_daerah'	=> $luar_daerah
					);
		$this->template->load('template', 'spj/npd/add', $data);
		// masuk database
		}else{
		$i = $this->input;
		$data = array(	'user_id'			=> $this->session->userdata('userid'),
						'dpa_id'			=> $dpa_id,
						'belanja_id'		=> $i->post('belanja_id'),
						'surat_tugas_id'	=> $i->post('surat_tugas_id'),
						'pengikut_id'		=> $i->post('pengikut_id'),
						'sppd_id'			=> $i->post('sppd_id'),
						'rekening_id'		=> $i->post('rekening_id'),
						'uraian'			=> $i->post('uraian'),
						'biaya'				=> $i->post('biaya'),
						'lama_perjalanan'	=> $i->post('lama_perjalanan'),
						'pajak'				=> $i->post('pajak'),
						'hasil_pajak'		=> $i->post('biaya') * $i->post('lama_perjalanan') / 100 * $i->post('pajak'),
						'tanggal_npd'		=> $i->post('tanggal_npd')
					);

			$this->npd_m->add($data);
			$this->session->set_flashdata('success', 'Data NPD Telah ditambah');
			redirect(base_url('npd/'.$this->uri->segment(2).'/rincian'), 'refresh');
			//var_dump($data);
		// end masuk database
		}
	}

	public function edit($npd_id)
	{
		$dpa_id = $this->uri->segment(2);
		$npd_id = $this->uri->segment(4);

		$npd = $this->npd_m->detail($npd_id);
		$dpa = $this->dpa_m->get();
		$surat_tugas = $this->surat_tugas_m->get();
		$ttd_keuangan = $this->ttd_keuangan_m->get();
		$belanja = $this->dpa_m->getbelanja();
		$sppd = $this->sppd_m->get();
		$pengikut = $this->npd_m->get_pengikut();
		$rekening = $this->rekening_m->get();
		$dalam_daerah = $this->dalam_daerah_m->get();
		$luar_daerah = $this->luar_daerah_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('belanja_id', 'Rincian Belanja', 'required',
				array(	'required'	=>	'%s harus diisi'));

		$valid->set_rules('uraian', 'Uraian', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=> 'edit',
						'npd'			=> $npd,
						'dpa'			=> $dpa,
						'surat_tugas'	=> $surat_tugas,
						'ttd_keuangan'	=> $ttd_keuangan,
						'belanja'		=> $belanja,
						'sppd'			=> $sppd,
						'pengikut'		=> $pengikut,
						'rekening'		=> $rekening,
						'dalam_daerah'	=> $dalam_daerah,
						'luar_daerah'	=> $luar_daerah
					);
		$this->template->load('template', 'spj/npd/edit', $data);
		// masuk database
		}else{
		$i = $this->input;
		$data = array(	'npd_id'			=> $npd_id,
						'user_id'			=> $this->session->userdata('userid'),
						'dpa_id'			=> $dpa_id,
						'belanja_id'		=> $i->post('belanja_id'),
						'surat_tugas_id'	=> $i->post('surat_tugas_id'),
						'pengikut_id'		=> $i->post('pengikut_id'),
						'sppd_id'			=> $i->post('sppd_id'),
						'rekening_id'		=> $i->post('rekening_id'),
						'uraian'			=> $i->post('uraian'),
						'biaya'				=> $i->post('biaya'),
						'lama_perjalanan'	=> $i->post('lama_perjalanan'),
						'pajak'				=> $i->post('pajak'),
						'hasil_pajak'		=> $i->post('biaya') * $i->post('lama_perjalanan') / 100 * $i->post('pajak'),
						'tanggal_npd'		=> $i->post('tanggal_npd')
					);
			$this->npd_m->edit($data);
			$this->session->set_flashdata('success', 'Data NPD Telah diupdate');
			redirect(base_url('npd/'.$this->uri->segment(2).'/rincian'), 'refresh');
		// end masuk database
		}
	}

	public function del_npd($id)
	{
		// Panggil model untuk menghapus data berdasarkan ID
        $this->npd_m->del_npd($id);
        $this->session->set_flashdata('success', 'Data NPD Telah dihapus');
        redirect(base_url('npd'), 'refresh'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}

	public function cetak()
	{
		$dpa_id = $this->uri->segment(2);

		$tanggalDipilih = $this->input->get('tanggal_npd');
		$format_cetak = $this->input->get('format_cetak');
		$pa_kpa = $this->input->get('pa_kpa');
		$pptk = $this->input->get('pptk');
		
		$selected_pa_kpa = $this->npd_m->get_selected_data($pa_kpa);
		$selected_pptk = $this->npd_m->get_selected_data($pptk);
		$npd = $this->npd_m->getNpdData($tanggalDipilih);
		$dpa = $this->npd_m->get_dpa($dpa_id);
		$belanja = $this->npd_m->get_belanja($dpa_id);

		$data = array(	'title'				=> 'NPD',
						'npd'				=> $npd,
						'dpa'				=> $dpa,
						'belanja'			=> $belanja,
						'selected_pa_kpa'	=> $selected_pa_kpa,
						'selected_pptk'		=> $selected_pptk
					);

		if ($format_cetak == 'nota_dinas') {
		$this->load->view('spj/npd/cetak_pa/nota_dinas', $data, FALSE);

		} elseif ($format_cetak == 'nota_pencairan_dana') {
		$this->load->view('spj/npd/cetak_pa/nota_pencairan_dana', $data, FALSE);

		} elseif ($format_cetak == 'nota_permintaan_dana') {
		$this->load->view('spj/npd/cetak_pa/nota_permintaan_dana', $data, FALSE);

		} elseif ($format_cetak == 'lampiran_permintaan_pembayaran') {
		$this->load->view('spj/npd/cetak_pa/lampiran_permintaan_pembayaran', $data, FALSE);
		} else {
            // Tindakan jika pilihan tidak valid
        }
	}
}


/* End of file Pp.php */
/* Location: ./application/controllers/Pp.php */