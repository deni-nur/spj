<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_tugas_m extends CI_Model {

	public function get($id = null)
    {
        $this->db->select('surat_tugas.*, pegawai.name');
		$this->db->from('surat_tugas');
		$this->db->join('pegawai', 'surat_tugas.pegawai_id = pegawai.pegawai_id', 'left');
		if($id !=null) {
			$this->db->where('surat_tugas.surat_tugas_id', $id);
		}
		$this->db->order_by('surat_tugas.surat_tugas_id', 'desc');
		$query = $this->db->get();
		return $query;
    }

    // Detail st
	public function detail($surat_tugas_id)
	{
		$this->db->select('*');
		$this->db->from('surat_tugas');
		$this->db->where('surat_tugas_id', $surat_tugas_id);
		$this->db->order_by('surat_tugas_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('surat_tugas', $data);
	}

	public function edit($data)
	{
		$this->db->where('surat_tugas_id', $data['surat_tugas_id']);
		$this->db->update('surat_tugas', $data);
	}

	public function del_surat_tugas($id)
    {
        $this->db->where('surat_tugas_id', $id);
        $this->db->delete('surat_tugas'); 
    }

	public function cetak($cetak)
	{
		$this->db->select('surat_tugas.*, pegawai.name, pegawai.nip, pangkat.pangkat, pangkat.golongan, jabatan.jabatan');
		$this->db->from('surat_tugas');
		$this->db->join('pegawai', 'surat_tugas.pegawai_id = pegawai.pegawai_id', 'left');
		$this->db->join('pangkat', 'pegawai.pangkat_id = pangkat.pangkat_id', 'left');
		$this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.jabatan_id', 'left');
		$this->db->where('surat_tugas_id', $cetak);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_selected_data($ttd_administrasi_id) 
	{
        $this->db->select('ttd_administrasi.*, pegawai.name, pegawai.nip, pangkat.pangkat, pangkat.golongan, jabatan.jabatan');
		$this->db->from('ttd_administrasi');
		$this->db->join('pegawai', 'ttd_administrasi.pegawai_id = pegawai.pegawai_id', 'left');
		$this->db->join('pangkat', 'pegawai.pangkat_id = pangkat.pangkat_id', 'left');
		$this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.jabatan_id', 'left');
		$this->db->where('ttd_administrasi_id', $ttd_administrasi_id);
		$query = $this->db->get();
        return $query->row();
    }
}

/* End of file surat_tugas_m.php */
/* Location: ./application/models/surat_tugas_m.php */