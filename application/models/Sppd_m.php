<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sppd_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('sppd.*, surat_tugas.maksud, pegawai.name, pegawai.nip, pangkat.golongan, pangkat.pangkat, jabatan.jabatan');
		$this->db->from('sppd');
		$this->db->join('surat_tugas', 'sppd.surat_tugas_id = surat_tugas.surat_tugas_id', 'left');
		$this->db->join('pegawai', 'surat_tugas.pegawai_id = pegawai.pegawai_id', 'left');
		$this->db->join('pangkat', 'pegawai.pangkat_id = pangkat.pangkat_id', 'left');
		$this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.jabatan_id', 'left');
		if($id !=null) {
			$this->db->where('sppd.sppd_id', $id);
		}
		$this->db->order_by('sppd.sppd_id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($sppd_id)
	{
		$this->db->select('sppd.*, surat_tugas.maksud, akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, sub_rincian_objek.nama_sub_rincian_objek');
		$this->db->from('sppd');
		$this->db->join('surat_tugas', 'sppd.surat_tugas_id = surat_tugas.surat_tugas_id', 'left');
		$this->db->join('belanja', 'sppd.belanja_id = belanja.belanja_id', 'left');
		$this->db->join('sub_rincian_objek', 'belanja.sub_rincian_objek_id = sub_rincian_objek.sub_rincian_objek_id', 'left');
        $this->db->join('rincian_objek', 'sub_rincian_objek.rincian_objek_id = rincian_objek.rincian_objek_id', 'left');
        $this->db->join('objek', 'rincian_objek.objek_id = objek.objek_id', 'left');
        $this->db->join('jenis', 'objek.jenis_id = jenis.jenis_id', 'left');
        $this->db->join('kelompok', 'jenis.kelompok_id = kelompok.kelompok_id', 'left');
        $this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
		$this->db->join('kecamatan', 'sppd.kecamatan_id = kecamatan.kecamatan_id', 'left');
		$this->db->join('provinsi', 'sppd.provinsi_id = provinsi.provinsi_id', 'left');
		$this->db->where('sppd_id', $sppd_id);
		$this->db->order_by('sppd_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function getbelanja($id = null)
	{
		$this->db->select('belanja.*, subkeg.nama_subkeg, subkeg.pagu_subkeg, akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, sub_rincian_objek.nama_sub_rincian_objek');
		$this->db->from('belanja');
		$this->db->join('dpa', 'belanja.dpa_id = dpa.dpa_id', 'left');
		$this->db->join('subkeg', 'dpa.subkeg_id = subkeg.subkeg_id', 'left');
		$this->db->join('sub_rincian_objek', 'belanja.sub_rincian_objek_id = sub_rincian_objek.sub_rincian_objek_id', 'left');
        $this->db->join('rincian_objek', 'sub_rincian_objek.rincian_objek_id = rincian_objek.rincian_objek_id', 'left');
        $this->db->join('objek', 'rincian_objek.objek_id = objek.objek_id', 'left');
        $this->db->join('jenis', 'objek.jenis_id = jenis.jenis_id', 'left');
        $this->db->join('kelompok', 'jenis.kelompok_id = kelompok.kelompok_id', 'left');
        $this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
		if($id !=null) {
			$this->db->where('belanja.portal_id', $id);
		}
		$this->db->order_by('sub_rincian_objek.kode_sub_rincian_objek', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function getdpa($id=null)
	{
		$this->db->select('belanja.*, subkeg.nama_subkeg, subkeg.kode_subkeg, kegiatan.kode_kegiatan, program.kode_program');
		$this->db->from('belanja');
		$this->db->join('subkeg', 'belanja.subkeg_id = subkeg.subkeg_id', 'left');
		$this->db->join('kegiatan', 'subkeg.kegiatan_id = kegiatan.kegiatan_id', 'left');
		$this->db->join('program', 'kegiatan.program_id = program.program_id', 'left');
		$this->db->join('sub_rincian_objek', 'belanja.sub_rincian_objek_id = sub_rincian_objek.sub_rincian_objek_id', 'left');
        $this->db->join('rincian_objek', 'sub_rincian_objek.rincian_objek_id = rincian_objek.rincian_objek_id', 'left');
        $this->db->join('objek', 'rincian_objek.objek_id = objek.objek_id', 'left');
        $this->db->join('jenis', 'objek.jenis_id = jenis.jenis_id', 'left');
        $this->db->join('kelompok', 'jenis.kelompok_id = kelompok.kelompok_id', 'left');
        $this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
		if($id !=null) {
			$this->db->where('subkeg.portal_id', $id);
		}
		$this->db->group_by('subkeg.subkeg_id');
		$this->db->order_by('subkeg.subkeg_id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function add($data)
	{
		$this->db->insert('sppd', $data);
	}

	public function edit($data)
	{
		$this->db->where('sppd_id', $data['sppd_id']);
		$this->db->update('sppd', $data);
	}

	public function del_sppd($id)
    {
        $this->db->where('sppd_id', $id);
        $this->db->delete('sppd'); 
    }

	public function cetak($cetak)
	{
		$this->db->select('sppd.*, surat_tugas.no_surat_tugas, surat_tugas.tanggal_surat, surat_tugas.maksud, surat_tugas.alamat, pegawai.name, pegawai.nip, pangkat.pangkat, pangkat.golongan, jabatan.jabatan, akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, sub_rincian_objek.nama_sub_rincian_objek, dpa.kode as kode_subkeg, dpa.name as nama_subkeg, kegiatan.kode as kode_kegiatan, program.kode as kode_program');
		$this->db->from('sppd');
		$this->db->join('surat_tugas', 'sppd.surat_tugas_id = surat_tugas.surat_tugas_id', 'left');
		$this->db->join('pegawai', 'surat_tugas.pegawai_id = pegawai.pegawai_id', 'left');
		$this->db->join('pangkat', 'pegawai.pangkat_id = pangkat.pangkat_id', 'left');
		$this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.jabatan_id', 'left');
		$this->db->join('belanja', 'sppd.belanja_id = belanja.belanja_id', 'left');
		$this->db->join('dpa', 'belanja.dpa_id = dpa.dpa_id', 'left');
		$this->db->join('kegiatan', 'dpa.kegiatan_id = kegiatan.kegiatan_id','LEFT');
		$this->db->join('program', 'kegiatan.program_id = program.program_id', 'left');
		$this->db->join('sub_rincian_objek', 'belanja.sub_rincian_objek_id = sub_rincian_objek.sub_rincian_objek_id', 'left');
        $this->db->join('rincian_objek', 'sub_rincian_objek.rincian_objek_id = rincian_objek.rincian_objek_id', 'left');
        $this->db->join('objek', 'rincian_objek.objek_id = objek.objek_id', 'left');
        $this->db->join('jenis', 'objek.jenis_id = jenis.jenis_id', 'left');
        $this->db->join('kelompok', 'jenis.kelompok_id = kelompok.kelompok_id', 'left');
        $this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
		$this->db->where('sppd.sppd_id', $cetak);
		$query = $this->db->get();
		return $query->row();
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
}

/* End of file Sppd_m.php */
/* Location: ./application/models/Sppd_m.php */