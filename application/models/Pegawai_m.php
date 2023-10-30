<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_m extends CI_Model {

	public function get($id = null)
    {
    	// $id = $this->session->userdata('userid');
		// $level = $this->session->userdata('level_id');

        $this->db->select('pegawai.*, pangkat.pangkat, pangkat.golongan, jabatan.jabatan');
		$this->db->from('pegawai');
		$this->db->join('pangkat', 'pegawai.pangkat_id = pangkat.pangkat_id');
		$this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.jabatan_id');
		// Tambahkan kondisi berdasarkan level pengguna
    	if ($id != null) {
		$this->db->where('pegawai.pegawai_id', $id);	
    	}
		$this->db->order_by('pegawai.pegawai_id', 'asc');
		$query = $this->db->get();
		return $query;
    }

    public function detail($pegawai_id)
	{
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->where('pegawai_id', $pegawai_id);
		$this->db->order_by('pegawai_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('pegawai', $data);
	}

	public function edit($data)
	{
		$this->db->where('pegawai_id', $data['pegawai_id']);
		$this->db->update('pegawai', $data);
	}

	public function del_pegawai($id)
    {
        $this->db->where('pegawai_id', $id);
        $this->db->delete('pegawai');
    }

	function check_nip($nip, $id = null)
	{
		$this->db->from('pegawai');
		$this->db->where('nip', $nip);
		if($id != null) {
			$this->db->where('pegawai_id !=', $id);
		}
		$query = $this->db->get();
		return $query;
	}
}