<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ttd_keuangan_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('ttd_keuangan.*, pegawai.name, pegawai.nip, pangkat.pangkat, pangkat.golongan');
		$this->db->from('ttd_keuangan');
		$this->db->join('pegawai', 'ttd_keuangan.pegawai_id = pegawai.pegawai_id');
		$this->db->join('pangkat', 'pegawai.pangkat_id = pangkat.pangkat_id');
		//$this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.jabatan_id');
		if($id !=null) {
			$this->db->where('ttd_keuangan_id', $id);
		}
		$this->db->order_by('ttd_keuangan_id', 'asc');
		$query = $this->db->get();
		return $query;
	}

    public function detail($ttd_keuangan_id)
	{
		$this->db->select('*');
		$this->db->from('ttd_keuangan');
		$this->db->where('ttd_keuangan_id', $ttd_keuangan_id);
		$this->db->order_by('ttd_keuangan_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('ttd_keuangan', $data);
	}

	public function edit($data)
	{
		$this->db->where('ttd_keuangan_id', $data['ttd_keuangan_id']);
		$this->db->update('ttd_keuangan', $data);
	}

	public function del_ttd_keuangan($id)
    {
        $this->db->where('ttd_keuangan_id', $id);
        $this->db->delete('ttd_keuangan');
    }
}