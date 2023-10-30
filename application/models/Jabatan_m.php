<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from('jabatan');
		if($id !=null) {
			$this->db->where('jabatan_id', $id);
		}
		$this->db->order_by('jabatan_id', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($jabatan_id)
	{
		$this->db->select('*');
		$this->db->from('jabatan');
		$this->db->where('jabatan_id', $jabatan_id);
		$this->db->order_by('jabatan_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('jabatan', $data);
	}

	public function edit($data)
	{
		$this->db->where('jabatan_id', $data['jabatan_id']);
		$this->db->update('jabatan', $data);
	}

	public function del_jabatan($id)
    {
       $this->db->where('jabatan_id', $id);
        $this->db->delete('jabatan');
    }
}