<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Darhum_m extends CI_Model {

	public function get()
	{
		$id = $this->session->userdata('userid');
		$level = $this->session->userdata('level_id');

		$this->db->select('*');
		$this->db->from('darhum');
		// Tambahkan kondisi berdasarkan level pengguna
    	if ($level != 1) {
			$this->db->where('user_id', $id);	
    	}
		$this->db->order_by('darhum.darhum_id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($darhum_id)
	{
		$this->db->select('*');
		$this->db->from('darhum');
		$this->db->where('darhum_id', $darhum_id);
		$this->db->order_by('darhum_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('darhum', $data);
	}

	public function edit($data)
	{
		$this->db->where('darhum_id', $data['darhum_id']);
		$this->db->update('darhum', $data);
	}

	public function del_darhum($id)
    {
        $this->db->where('darhum_id', $id);
        $this->db->delete('darhum'); 
    }
}