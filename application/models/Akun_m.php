<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from('akun');
		if($id !=null) {
			$this->db->where('akun_id', $id);
		}
		$this->db->order_by('akun_id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($akun_id)
	{
		$this->db->select('*');
		$this->db->from('akun');
		$this->db->where('akun_id', $akun_id);
		$this->db->order_by('akun_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('akun', $data);
	}

	public function edit($data)
	{
		$this->db->where('akun_id', $data['akun_id']);
		$this->db->update('akun', $data);
	}

	public function del_akun($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('akun');
    }
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */