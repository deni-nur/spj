<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dpa extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['dpa_m','program_m','kegiatan_m','sub_kegiatan_m','sub_rincian_objek_m']);
	}

	public function index()
	{
		$dpa = $this->dpa_m->get();

		$pagu_murni = $this->dpa_m->pagu_murni();

		$data = array(	'dpa'			=> $dpa,
						'pagu_murni'	=> $pagu_murni
					);

		$this->template->load('template', 'penganggaran/dpa/subkegiatan/data', $data);
	}

	public function add()
	{
		$sub_kegiatan = $this->sub_kegiatan_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('kegiatan_id', 'Nama Kegiatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=> 'add',
						'sub_kegiatan'	=> $sub_kegiatan
					);
		$this->template->load('template', 'penganggaran/dpa/subkegiatan/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'		=> $this->session->userdata('userid'),
							'kegiatan_id'	=> $i->post('kegiatan_id'),
							'kode'			=> $i->post('kode'),
							'name'			=> $i->post('name')
						);
			$this->dpa_m->add($data);
			$this->session->set_flashdata('success', 'Data Sub Kegiatan Berhasil ditambah');
			redirect(base_url('dpa'), 'refresh');
		// end masuk database
		}
	}

	public function edit($dpa_id)
	{
		$dpa = $this->dpa_m->detail($dpa_id);

		$sub_kegiatan = $this->sub_kegiatan_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('kegiatan_id', 'Nama Kegiatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'			=>	'edit',
						'dpa'			=>	$dpa,
						'sub_kegiatan'	=>	$sub_kegiatan
					);
		$this->template->load('template', 'penganggaran/dpa/subkegiatan/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'dpa_id'		=> $dpa_id,
							'user_id'		=> $this->session->userdata('userid'),
							'kegiatan_id'	=> $i->post('kegiatan_id'),
							'kode'			=> $i->post('kode'),
							'name'			=> $i->post('name')
						);
			$this->dpa_m->edit($data);
			$this->session->set_flashdata('success', 'Data Sub Kegiatan Telah diupdate');
			redirect(base_url('dpa'), 'refresh');
		// end masuk database
		}
	}

	public function del_dpa($id)
	{
		// Panggil model untuk menghapus data berdasarkan ID
        $this->dpa_m->del_dpa($id);
        $this->session->set_flashdata('success', 'Data Sub Kegiatan Telah dihapus');
        redirect('dpa'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}

	public function belanja()
	{
		$dpa_id = $this->uri->segment(2);

		$dpa = $this->dpa_m->getbelanja($dpa_id);
		$belanja = $this->dpa_m->getbelanja($dpa_id);
		$jumlah_pagu_belanja_murni = $this->dpa_m->jumlah_pagu_belanja_murni($dpa_id);

		$data = array(	'belanja'					=>	$belanja,
						'jumlah_pagu_belanja_murni'	=>	$jumlah_pagu_belanja_murni,
						'dpa'						=>	$dpa
					);

		$this->template->load('template', 'penganggaran/dpa/subkegiatan/belanja/data', $data);
	}

	public function belanja_add()
	{
		$dpa_id = $this->uri->segment(2);
		$dpa = $this->dpa_m->detail($dpa_id);

		$sub_rincian_objek = $this->sub_rincian_objek_m->get();		

		$valid = $this->form_validation;

		$valid->set_rules('sub_rincian_objek_id', 'Belanja Sub Rincian Kegiatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'				=>	'add',
						'dpa'				=>	$dpa,
						'sub_rincian_objek'	=>	$sub_rincian_objek
					);
		$this->template->load('template', 'penganggaran/dpa/subkegiatan/belanja/add', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'user_id'					=>	$this->session->userdata('userid'),	
							'dpa_id'					=>	$dpa_id,
							'sub_rincian_objek_id'		=>	$i->post('sub_rincian_objek_id'),
							'pagu_belanja_murni'		=>	$i->post('pagu_belanja_murni')
						);
			$this->dpa_m->belanja_add($data);
			$this->session->set_flashdata('success', 'Data Belanja Sub Kegiatan PD sukses ditambah');
			redirect(base_url('dpa/'.$this->uri->segment(2).'/belanja'), 'refresh');
		// end masuk database
		}
	}

	public function belanja_edit($belanja_id)
	{
		$dpa_id = $this->uri->segment(2);
		$dpa = $this->dpa_m->detail($dpa_id);

		$belanja_id = $this->uri->segment(5);
		$belanja = $this->dpa_m->detail_belanja($belanja_id);

		$sub_rincian_objek = $this->sub_rincian_objek_m->get();		

		$valid = $this->form_validation;

		$valid->set_rules('sub_rincian_objek_id', 'Belanja Sub Kegiatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'				=>	'edit',
						'dpa'				=>	$dpa,
						'sub_rincian_objek'	=>	$sub_rincian_objek,
						'belanja'			=>	$belanja
					);
		$this->template->load('template', 'penganggaran/dpa/subkegiatan/belanja/edit', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'belanja_id'				=>	$belanja_id,
							'user_id'					=>	$this->session->userdata('userid'),	
							'dpa_id'					=>	$dpa_id,
							'sub_rincian_objek_id'		=>	$i->post('sub_rincian_objek_id'),
							'pagu_belanja_murni'		=>	$i->post('pagu_belanja_murni')
						);
			$this->dpa_m->belanja_edit($data);
			$this->session->set_flashdata('success', 'Data Belanja Sub Kegiatan PD sukses diupdate');
			redirect(base_url('dpa/'.$this->uri->segment(2).'/belanja'), 'refresh');
		// end masuk database
		}
	}

	public function del_belanja($id)
	{
		// Panggil model untuk menghapus data berdasarkan ID
        $this->dpa_m->del_belanja($id);
        $this->session->set_flashdata('success', 'Data Belanja Telah dihapus');
        redirect('dpa'); // Ganti 'data_controller' dengan nama controller yang sesuai
	}

	public function anggaran_kas($belanja_id)
	{
		$dpa_id = $this->uri->segment(2);
		$dpa = $this->dpa_m->detail($dpa_id);

		$belanja_id = $this->uri->segment(5);
		$belanja = $this->dpa_m->detail_belanja($belanja_id);

		$sub_rincian_objek = $this->sub_rincian_objek_m->get();

		$valid = $this->form_validation;

		$valid->set_rules('sub_rincian_objek_id', 'Belanja Sub Rincian Kegiatan', 'required',
				array(	'required'	=>	'%s harus diisi'));

		if($valid->run()===FALSE) {

		$data = array(	'page'				=>	'add',
						'belanja'			=>	$belanja,
					);
		$this->template->load('template', 'penganggaran/dpa/subkegiatan/belanja/anggaran_kas', $data);
		// masuk database
		}else{
			$i = $this->input;
			$data = array(	'belanja_id'			=>	$belanja_id,
							'user_id'				=>	$this->session->userdata('userid'),	
							'dpa_id'				=>	$dpa_id,
							'sub_rincian_objek_id'	=>	$i->post('sub_rincian_objek_id'),
							'bulan1'				=>	$i->post('bulan1'),
							'bulan2'				=>	$i->post('bulan2'),
							'bulan3'				=>	$i->post('bulan3'),
							'bulan4'				=>	$i->post('bulan4'),
							'bulan5'				=>	$i->post('bulan5'),
							'bulan6'				=>	$i->post('bulan6'),
							'bulan7'				=>	$i->post('bulan7'),
							'bulan8'				=>	$i->post('bulan8'),
							'bulan9'				=>	$i->post('bulan9'),
							'bulan10'				=>	$i->post('bulan10'),
							'bulan11'				=>	$i->post('bulan11'),
							'bulan12'				=>	$i->post('bulan12')
						);
			$this->dpa_m->anggaran_kas($data);
			$this->session->set_flashdata('success', 'Data Anggaran Kas Belanja Sub Kegiatan PD sukses ditambah');
			redirect(base_url('dpa/'.$this->uri->segment(2).'/belanja'), 'refresh');
		// end masuk database
		}
	}
}

/* End of file Renja.php */
/* Location: ./application/controllers/Renja.php */