<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sppd extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['sppd_m','pengikut_m','surat_tugas_m','ttd_keuangan_m','kecamatan_m','provinsi_m','dpa_m']);
    }

    public function index()
    {
        $sppd = $this->sppd_m->get();
        $ttd_keuangan = $this->ttd_keuangan_m->get();

        $data = array(  'sppd'          =>  $sppd,
                        'ttd_keuangan'  =>  $ttd_keuangan
                    );

        $this->template->load('template', 'spj/sppd/data', $data); 
    }

    public function add()
    {
        $surat_tugas = $this->surat_tugas_m->get();
        $ttd_keuangan = $this->ttd_keuangan_m->get();
        $kecamatan = $this->kecamatan_m->get();
        $provinsi = $this->provinsi_m->get();
        $dpa = $this->dpa_m->get();
        $belanja = $this->dpa_m->getbelanja();

        $valid = $this->form_validation;

        $valid->set_rules('tingkat_biaya', 'Tingkat Biaya', 'required',
                array(  'required'  =>  '%s harus diisi'));

        if($valid->run()===FALSE) {

        $data = array(  'page'          => 'add',
                        'surat_tugas'   => $surat_tugas,
                        'ttd_keuangan'  => $ttd_keuangan,
                        'kecamatan'     => $kecamatan,
                        'provinsi'      => $provinsi,
                        'dpa'           => $dpa,
                        'belanja'       => $belanja
                    );
        $this->template->load('template', 'spj/sppd/add', $data);
        // masuk database
        }else{
        $i = $this->input;
        $data = array(  'user_id'           => $this->session->userdata('userid'),
                        'surat_tugas_id'    => $i->post('surat_tugas_id'),
                        //'ttd_keuangan_id'   => $i->post('ttd_keuangan_id'),
                        'belanja_id'        => $i->post('belanja_id'),
                        'provinsi_id'       => $i->post('provinsi_id'),
                        'kecamatan_id'      => $i->post('kecamatan_id'),
                        'tingkat_biaya'     => $i->post('tingkat_biaya'),
                        'alat_angkutan'     => $i->post('alat_angkutan'),
                        'tempat_tujuan'     => $i->post('tempat_tujuan'),
                        'lama_perjalanan'   => $i->post('lama_perjalanan'),
                        'tanggal_berangkat' => $i->post('tanggal_berangkat'),
                        'tanggal_pulang'    => $i->post('tanggal_pulang')
                    );
            $this->sppd_m->add($data);
            $this->session->set_flashdata('success', 'Data SPPD Telah ditambah');
            redirect(base_url('sppd'), 'refresh');
        // end masuk database
        }
    }

    public function edit($sppd_id)
    {
        $sppd = $this->sppd_m->detail($sppd_id);

        $surat_tugas = $this->surat_tugas_m->get();
        $ttd_keuangan = $this->ttd_keuangan_m->get();
        $kecamatan = $this->kecamatan_m->get();
        $provinsi = $this->provinsi_m->get();
        $dpa = $this->dpa_m->get();
        $belanja = $this->dpa_m->getbelanja();

        $valid = $this->form_validation;

        $valid->set_rules('tingkat_biaya', 'Tingkat Biaya', 'required',
                array(  'required'  =>  '%s harus diisi'));

        if($valid->run()===FALSE) {

        $data = array(  'page'          => 'edit',
                        'sppd'          => $sppd,
                        'surat_tugas'   => $surat_tugas,
                        'ttd_keuangan'  => $ttd_keuangan,
                        'kecamatan'     => $kecamatan,
                        'provinsi'      => $provinsi,
                        'dpa'           => $dpa,
                        'belanja'       => $belanja
                    );
        $this->template->load('template', 'spj/sppd/edit', $data);
        // masuk database
        }else{
            $i = $this->input;
            $data = array(  'sppd_id'           => $sppd_id,
                            'user_id'           => $this->session->userdata('userid'),
                            'surat_tugas_id'    => $i->post('surat_tugas_id'),
                            //'ttd_keuangan_id'   => $i->post('ttd_keuangan_id'),
                            'belanja_id'        => $i->post('belanja_id'),
                            'provinsi_id'       => $i->post('provinsi_id'),
                            'kecamatan_id'      => $i->post('kecamatan_id'),
                            'tingkat_biaya'     => $i->post('tingkat_biaya'),
                            'alat_angkutan'     => $i->post('alat_angkutan'),
                            'tempat_tujuan'     => $i->post('tempat_tujuan'),
                            'lama_perjalanan'   => $i->post('lama_perjalanan'),
                            'tanggal_berangkat' => $i->post('tanggal_berangkat'),
                            'tanggal_pulang'    => $i->post('tanggal_pulang')
                        );
            $this->sppd_m->edit($data);
            $this->session->set_flashdata('success', 'Data SPPD Telah diupdate');
            redirect(base_url('sppd'), 'refresh');
        // end masuk database
        }
    }

    public function del_sppd($id)
    {
        // Panggil model untuk menghapus data berdasarkan ID
        $this->sppd_m->del_sppd($id);
        $this->session->set_flashdata('success', 'Data SPPD Telah dihapus');
        redirect('sppd'); // Ganti 'data_controller' dengan nama controller yang sesuai
    }

    public function cetak()
    {
        $sppd_id = $this->input->get('sppd_id');
        $ttd_keuangan_id = $this->input->get('ttd_keuangan_id');

        $data_sppd      = $this->sppd_m->cetak($sppd_id);
        $pengikut       = $this->pengikut_m->get();
        $selected_data = $this->sppd_m->get_selected_data($ttd_keuangan_id);
        
        $data = array(  'pengikut'      => $pengikut,
                        'data_sppd'     => $data_sppd,
                        'selected_data'  => $selected_data
                    );
        $this->load->view('spj/sppd/cetak', $data, FALSE);
    }

}

/* End of file Sppd.php */
/* Location: ./application/controllers/Sppd.php */