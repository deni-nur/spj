<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Level_m extends CI_Model {


	public function get($id = null)
	{
		$this->db->from('level');
		if($id !=null) {
			$this->db->where('level_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function detail($level_id)
	{
		$this->db->select('*');
		$this->db->from('level');
		$this->db->where('level_id', $level_id);
		$this->db->order_by('level_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('level', $data);
	}

	public function edit($data)
	{
		$this->db->where('level_id', $data['level_id']);
		$this->db->update('level', $data);
	}

	public function delete($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('level');
    }
}