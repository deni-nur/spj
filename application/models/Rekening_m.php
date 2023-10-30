<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from('rekening');
		if($id !=null) {
			$this->db->where('rekening_id', $id);
		}
		$this->db->order_by('rekening_id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($rekening_id)
	{
		$this->db->select('*');
		$this->db->from('rekening');
		$this->db->where('rekening_id', $rekening_id);
		$this->db->order_by('rekening_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('rekening', $data);
	}

	public function edit($data)
	{
		$this->db->where('rekening_id', $data['rekening_id']);
		$this->db->update('rekening', $data);
	}

	public function del_rekening($id)
    {
       $this->db->where('rekening_id', $id);
       $this->db->delete('rekening');
    }
}