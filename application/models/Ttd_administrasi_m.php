<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ttd_administrasi_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('ttd_administrasi.*, pegawai.name, pegawai.nip, pangkat.pangkat, pangkat.golongan, jabatan.jabatan');
		$this->db->from('ttd_administrasi');
		$this->db->join('pegawai', 'ttd_administrasi.pegawai_id = pegawai.pegawai_id');
		$this->db->join('pangkat', 'pegawai.pangkat_id = pangkat.pangkat_id');
		$this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.jabatan_id');
		if($id !=null) {
			$this->db->where('ttd_administrasi.ttd_administrasi_id', $id);
		}
		$this->db->order_by('ttd_administrasi.ttd_administrasi_id', 'asc');
		$query = $this->db->get();
		return $query;
	}

    public function detail($ttd_administrasi_id)
	{
		$this->db->select('*');
		$this->db->from('ttd_administrasi');
		$this->db->where('ttd_administrasi_id', $ttd_administrasi_id);
		$this->db->order_by('ttd_administrasi_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('ttd_administrasi', $data);
	}

	public function edit($data)
	{
		$this->db->where('ttd_administrasi_id', $data['ttd_administrasi_id']);
		$this->db->update('ttd_administrasi', $data);
	}

	public function del_ttd_administrasi($id)
    {
        $this->db->where('ttd_administrasi_id', $id);
        $this->db->delete('ttd_administrasi');
    }
}