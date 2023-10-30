<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_anggaran_m extends CI_Model {


	public function get($id = null)
	{
		$this->db->from('tahun_anggaran');
		if($id !=null) {
			$this->db->where('tahun_anggaran_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function detail($tahun_anggaran_id)
	{
		$this->db->select('*');
		$this->db->from('tahun_anggaran');
		$this->db->where('tahun_anggaran_id', $tahun_anggaran_id);
		$this->db->order_by('tahun_anggaran_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('tahun_anggaran', $data);
	}

	public function edit($data)
	{
		$this->db->where('tahun_anggaran_id', $data['tahun_anggaran_id']);
		$this->db->update('tahun_anggaran', $data);
	}

	public function delete($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('tahun_anggaran');
    }
}