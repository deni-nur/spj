<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_kerja_m extends CI_Model {


	public function get($id = null)
	{
		$this->db->from('unit_kerja');
		if($id !=null) {
			$this->db->where('unit_kerja_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function detail($unit_kerja_id)
	{
		$this->db->select('*');
		$this->db->from('unit_kerja');
		$this->db->where('unit_kerja_id', $unit_kerja_id);
		$this->db->order_by('unit_kerja_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('unit_kerja', $data);
	}

	public function edit($data)
	{
		$this->db->where('unit_kerja_id', $data['unit_kerja_id']);
		$this->db->update('unit_kerja', $data);
	}

	public function delete($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('unit_kerja');
    }
}