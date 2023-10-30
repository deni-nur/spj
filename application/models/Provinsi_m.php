<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->from('provinsi');
		if($id !=null) {
			$this->db->where('provinsi_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function detail($provinsi_id)
	{
		$this->db->select('*');
		$this->db->from('provinsi');
		$this->db->where('provinsi_id', $provinsi_id);
		$this->db->order_by('provinsi_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('provinsi', $data);
	}

	public function edit($data)
	{
		$this->db->where('provinsi_id', $data['provinsi_id']);
		$this->db->update('provinsi', $data);
	}

	public function del_provinsi($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('provinsi');
    }
}