<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('kelompok.*, akun.kode_akun');
		$this->db->from('kelompok');
		$this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
		if($id !=null) {
			$this->db->where('kelompok_id', $id);
		}
		$this->db->order_by('kelompok_id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($kelompok_id)
	{
		$this->db->select('*');
		$this->db->from('kelompok');
		$this->db->where('kelompok_id', $kelompok_id);
		$this->db->order_by('kelompok_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('kelompok', $data);
	}

	public function edit($data)
	{
		$this->db->where('kelompok_id', $data['kelompok_id']);
		$this->db->update('kelompok', $data);
	}

	public function del_kelompok($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('kelompok');
    }
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */