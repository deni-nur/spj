<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Program_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->from('program');
		if($id !=null) {
			$this->db->where('program_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function detail($program_id)
	{
		$this->db->select('*');
		$this->db->from('program');
		$this->db->where('program_id', $program_id);
		$this->db->order_by('program_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('program', $data);
	}

	public function edit($data)
	{
		$this->db->where('program_id', $data['program_id']);
		$this->db->update('program', $data);
	}

	public function del_program($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('program');
    }
}