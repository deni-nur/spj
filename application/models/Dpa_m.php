<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dpa_m extends CI_Model {

    public function get()
    {
        $id = $this->session->userdata('userid');
        $level = $this->session->userdata('level_id');

        $this->db->select('dpa.*, program.kode as kode_program, program.name as nama_program, kegiatan.kode as kode_kegiatan, kegiatan.name as nama_kegiatan');
        $this->db->from('dpa');
        $this->db->join('kegiatan', 'dpa.kegiatan_id = kegiatan.kegiatan_id', 'left');
        $this->db->join('program', 'kegiatan.program_id = program.program_id', 'left');
        //$this->db->join('belanja', 'belanja.dpa_id=dpa.dpa_id');
        // Tambahkan kondisi berdasarkan level pengguna
        if ($level != 1) {
            $this->db->where('dpa.user_id', $id);   
        }
        //$this->db->group_by('dpa_id');
        $this->db->order_by('dpa.dpa_id', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function pagu_murni()
    {
        //$dpa_id = $this->input->post('dpa_id');

        $this->db->select('belanja.*, IFNULL(SUM(belanja.pagu_belanja_murni),0) as pagu_murni');
        $this->db->from('belanja');
        //$this->db->join('belanja', 'belanja.dpa_id=dpa.dpa_id');
        //$this->db->where('belanja.dpa_id'); 
        //$this->db->where('belanja.dpa_id', $dpa_id);
        $this->db->group_by('belanja.dpa_id');
        $query = $this->db->get();
        return $query;
    }

    public function detail($dpa_id)
    {
        $this->db->select('dpa.*, program.kode as kode_program, program.name as nama_program, kegiatan.kode as kode_kegiatan, kegiatan.name as nama_kegiatan');
        $this->db->from('dpa');
        $this->db->join('kegiatan', 'dpa.kegiatan_id = kegiatan.kegiatan_id', 'left');
        $this->db->join('program', 'kegiatan.program_id = program.program_id', 'left');
        $this->db->where('dpa_id', $dpa_id);
        $this->db->order_by('dpa_id', 'asc');
        $query = $this->db->get();
        return $query->row();
    }

    public function add($data)
    {
        $this->db->insert('dpa', $data);
    }

    public function edit($data)
    {
        $this->db->where('dpa_id', $data['dpa_id']);
        $this->db->update('dpa', $data);
    }

    public function del_dpa($id)
    {
        $this->db->where('dpa_id', $id);
        $this->db->delete('dpa');
    }

    public function getbelanja($id = null)
    {
        $this->db->select('belanja.*, dpa.kode, dpa.name, program.kode as kode_program, program.name as nama_program, kegiatan.kode as kode_kegiatan, kegiatan.name as nama_kegiatan, akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, sub_rincian_objek.nama_sub_rincian_objek');
        $this->db->from('belanja');
        $this->db->join('dpa', 'belanja.dpa_id = dpa.dpa_id', 'left');
        $this->db->join('kegiatan', 'dpa.kegiatan_id = kegiatan.kegiatan_id', 'left');
        $this->db->join('program', 'kegiatan.program_id = program.program_id', 'left');
        $this->db->join('sub_rincian_objek', 'belanja.sub_rincian_objek_id = sub_rincian_objek.sub_rincian_objek_id', 'left');
        $this->db->join('rincian_objek', 'sub_rincian_objek.rincian_objek_id = rincian_objek.rincian_objek_id', 'left');
        $this->db->join('objek', 'rincian_objek.objek_id = objek.objek_id', 'left');
        $this->db->join('jenis', 'objek.jenis_id = jenis.jenis_id', 'left');
        $this->db->join('kelompok', 'jenis.kelompok_id = kelompok.kelompok_id', 'left');
        $this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
        if($id !=null) {
            $this->db->where('belanja.dpa_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function jumlah_pagu_belanja_murni($dpa_id)
    {
        $this->db->select('SUM(pagu_belanja_murni) as jumlah_pagu_belanja_murni');
        $this->db->from('belanja');
        $this->db->where('dpa_id', $dpa_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function detail_belanja($belanja_id)
    {
        $this->db->select('belanja.*, sub_rincian_objek.nama_sub_rincian_objek');
        $this->db->from('belanja');
        $this->db->join('sub_rincian_objek', 'belanja.sub_rincian_objek_id = sub_rincian_objek.sub_rincian_objek_id', 'left');
        $this->db->join('rincian_objek', 'sub_rincian_objek.rincian_objek_id = rincian_objek.rincian_objek_id', 'left');
        $this->db->join('objek', 'rincian_objek.objek_id = objek.objek_id', 'left');
        $this->db->join('jenis', 'objek.jenis_id = jenis.jenis_id', 'left');
        $this->db->join('kelompok', 'jenis.kelompok_id = kelompok.kelompok_id', 'left');
        $this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
        $this->db->where('belanja_id', $belanja_id);
        $this->db->order_by('belanja_id', 'asc');
        $query = $this->db->get();
        return $query->row();
    }

    public function belanja_add($data)
    {
        $this->db->insert('belanja', $data);
    }

    public function belanja_edit($data)
    {
        $this->db->where('belanja_id', $data['belanja_id']);
        $this->db->update('belanja', $data);
    }

    public function del_belanja($id)
    {
        $this->db->where('belanja_id', $id);
        $this->db->delete('belanja');
    }

    public function anggaran_kas($data)
    {
        $this->db->where('belanja_id', $data['belanja_id']);
        $this->db->update('belanja', $data);
    }
}

/* End of file Renja_m.php */
/* Location: ./application/models/Renja_m.php */