<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengikut_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('pengikut.*, pegawai.name, pegawai.nip, pangkat.pangkat, pangkat.golongan, jabatan.jabatan');
		$this->db->from('pengikut');
		$this->db->join('pegawai', 'pengikut.pegawai_id = pegawai.pegawai_id', 'left');
		$this->db->join('pangkat', 'pegawai.pangkat_id = pangkat.pangkat_id', 'left');
		$this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.jabatan_id', 'left');
		if($id !=null) {
			$this->db->where('pengikut.surat_tugas_id', $id);
		}
		$this->db->order_by('pengikut.surat_tugas_id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function get_join($surat_tugas_id=null)
	{
		$this->db->select('pengikut.*,surat_tugas.maksud, pegawai.name');
		$this->db->from('pengikut');
		$this->db->join('surat_tugas', 'pengikut.surat_tugas_id = surat_tugas.surat_tugas_id', 'left');
		$this->db->join('pegawai', 'pengikut.pegawai_id = pegawai.pegawai_id', 'left');
		if($surat_tugas_id !=null) {
			$this->db->where('surat_tugas_id', $surat_tugas_id);
		}
		$this->db->order_by('surat_tugas_id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($pengikut_id)
	{
		$this->db->select('*');
		$this->db->from('pengikut');
		$this->db->where('pengikut_id', $pengikut_id);
		$this->db->order_by('pengikut_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('pengikut', $data);
	}

	public function edit($data)
	{
		$this->db->where('pengikut_id', $data['pengikut_id']);
		$this->db->update('pengikut', $data);
	}

	public function del_pengikut($id)
    {
        $this->db->where('pengikut_id', $id);
        $this->db->delete('pengikut'); 
    }

}

/* End of file Pengikut_m.php */
/* Location: ./application/models/Pengikut_m.php */