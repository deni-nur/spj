<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kokab_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('kokab.*, provinsi.name as nama_provinsi');
		$this->db->from('kokab');
		$this->db->join('provinsi', 'kokab.provinsi_id = provinsi.provinsi_id','LEFT');
		if($id !=null) {
			$this->db->where('kokab_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function detail($kokab_id)
	{
		$this->db->select('*');
		$this->db->from('kokab');
		$this->db->where('kokab_id', $kokab_id);
		$this->db->order_by('kokab_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('kokab', $data);
	}

	public function edit($data)
	{
		$this->db->where('kokab_id', $data['kokab_id']);
		$this->db->update('kokab', $data);
	}

	public function del_kokab($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('kokab');
    }
}