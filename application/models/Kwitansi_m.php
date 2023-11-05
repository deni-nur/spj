<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kwitansi_m extends CI_Model {

	public function get_pagu_kwitansi($id = null)
	{
	    $this->db->select('npd.*, dpa.kode, dpa.name, program.kode as kode_program, program.name as nama_program, kegiatan.kode as kode_kegiatan, kegiatan.name as nama_kegiatan, SUM(biaya * lama_perjalanan) as total_belanja');
	    $this->db->from('npd');
	    $this->db->join('dpa', 'npd.dpa_id = dpa.dpa_id', 'left');
	    $this->db->join('kegiatan', 'dpa.kegiatan_id = kegiatan.kegiatan_id', 'left');
	    $this->db->join('program', 'kegiatan.program_id = program.program_id', 'left');
	    if ($id != null) {
	        $this->db->where('npd.dpa_id', $id);
	    }
	    $this->db->group_by('npd.dpa_id');
	    $query = $this->db->get();
	    return $query;
	}

	public function get_belanja($id=null)
	{
		$this->db->select('belanja.*, dpa.kode, dpa.name, program.kode as kode_program, program.name as nama_program, kegiatan.kode as kode_kegiatan, kegiatan.name as nama_kegiatan, akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, sub_rincian_objek.nama_sub_rincian_objek, SUM(biaya*lama_perjalanan) as total_belanja');
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
        $this->db->join('npd', 'npd.belanja_id=belanja.belanja_id');
        if($id !=null) {
            $this->db->where('belanja.dpa_id', $id);
            $this->db->group_by('npd.belanja_id');
        }
        $query = $this->db->get();
        return $query;
	}

	public function get($id=null)
	{
		$this->db->select('kwitansi.*, npd.uraian, npd.biaya, npd.belanja_id, npd.lama_perjalanan, npd.hasil_pajak, rekening.pemilik');
		$this->db->from('kwitansi');
		$this->db->join('npd', 'kwitansi.npd_id=npd.npd_id');
		$this->db->join('rekening', 'npd.rekening_id=rekening.rekening_id');
		if($id !=null) {
			$this->db->where('npd.belanja_id', $id);
		}
		$this->db->order_by('kwitansi.kwitansi_id', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	public function get_npd($id=null)
	{
		$this->db->select('npd.*, rekening.pemilik');
		$this->db->from('npd');
		$this->db->join('rekening', 'npd.rekening_id=rekening.rekening_id');
		if($id !=null) {
			$this->db->where('npd.belanja_id', $id);
		}
		$this->db->order_by('npd.tanggal_npd', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	public function detail($kwitansi_id)
	{
		$this->db->select('kwitansi.*, npd.uraian');
		$this->db->from('kwitansi');
		$this->db->join('npd', 'kwitansi.npd_id = npd.npd_id', 'left');
		$this->db->where('kwitansi_id', $kwitansi_id);
		$this->db->order_by('kwitansi_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('kwitansi', $data);
	}

	public function edit($data)
	{
		$this->db->where('kwitansi_id', $data['kwitansi_id']);
		$this->db->update('kwitansi', $data);
	}

	public function del_kwitansi($id)
	{
		$this->db->where('kwitansi_id', $id);
        $this->db->delete('kwitansi'); 
	}

	public function get_selected_data($ttd_keuangan_id) 
	{
        $this->db->select('ttd_keuangan.*, pegawai.name, pegawai.nip, pangkat.pangkat, pangkat.golongan, jabatan.jabatan');
		$this->db->from('ttd_keuangan');
		$this->db->join('pegawai', 'ttd_keuangan.pegawai_id = pegawai.pegawai_id', 'left');
		$this->db->join('pangkat', 'pegawai.pangkat_id = pangkat.pangkat_id', 'left');
		$this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.jabatan_id', 'left');
		$this->db->where('ttd_keuangan_id', $ttd_keuangan_id);
		$query = $this->db->get();
        return $query->row();
    }

	public function cetak($tanggalDipilih)
	{
	    $this->db->select('kwitansi.*, program.kode as kode_program, program.name as nama_program, kegiatan.kode as kode_kegiatan, kegiatan.name as nama_kegiatan, dpa.kode, dpa.name, akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, sub_rincian_objek.nama_sub_rincian_objek, npd.uraian, npd.biaya, npd.lama_perjalanan, npd.hasil_pajak, rekening.pemilik, SUM(npd.biaya*npd.lama_perjalanan) as total_belanja');
	    $this->db->from('kwitansi');
	    $this->db->join('npd', 'kwitansi.npd_id = npd.npd_id', 'left');
	    $this->db->join('belanja', 'npd.belanja_id = belanja.belanja_id', 'left');
	    $this->db->join('rekening', 'npd.rekening_id = rekening.rekening_id', 'left');
	    $this->db->join('sub_rincian_objek', 'belanja.sub_rincian_objek_id = sub_rincian_objek.sub_rincian_objek_id', 'left');
	    $this->db->join('rincian_objek', 'sub_rincian_objek.rincian_objek_id = rincian_objek.rincian_objek_id', 'left');
	    $this->db->join('objek', 'rincian_objek.objek_id = objek.objek_id', 'left');
	    $this->db->join('jenis', 'objek.jenis_id = jenis.jenis_id', 'left');
	    $this->db->join('kelompok', 'jenis.kelompok_id = kelompok.kelompok_id', 'left');
	    $this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
	    $this->db->join('dpa', 'npd.dpa_id = dpa.dpa_id', 'left');
	    $this->db->join('kegiatan', 'dpa.kegiatan_id = kegiatan.kegiatan_id', 'left');
	    $this->db->join('program', 'kegiatan.program_id = program.program_id', 'left');
	    $this->db->where('DATE(kwitansi.tanggal)', $tanggalDipilih); // Sesuaikan dengan nama kolom tanggal
	    $query = $this->db->get();
	    return $query;
	}


  	public function get_ttd_keuangan($id = null)
    {
        $this->db->select('kwitansi.*, pegawai.name as ttd_keuangan_name, pegawai.nip as ttd_keuangan_nip, pangkat.pangkat, golongan.gol, ttd_keuangan.jabatan_ttd_keuangan');
		$this->db->from('kwitansi');
		$this->db->join('ttd_keuangan', 'kwitansi.ttd_keuangan_id = ttd_keuangan.ttd_keuangan_id', 'left');
		$this->db->join('pegawai', 'ttd_keuangan.pegawai_id = pegawai.pegawai_id');
		$this->db->join('golongan', 'pegawai.golongan_id = golongan.golongan_id');
		$this->db->join('pangkat', 'golongan.pangkat_id = pangkat.pangkat_id', 'left');
		$this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.jabatan_id');
		if($id !=null) {
			$this->db->where('kwitansi.kwitansi_id', $id);
		}
		$this->db->order_by('kwitansi.kwitansi_id');
		$query = $this->db->get();
		return $query;
    }
}

/* End of file Kwitansi_m.php */
/* Location: ./application/models/Kwitansi_m.php */