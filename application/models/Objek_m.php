<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Objek_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('objek.*, kelompok.kode_kelompok, akun.kode_akun, jenis.kode_jenis');
		$this->db->from('objek');
		$this->db->join('jenis', 'objek.jenis_id = jenis.jenis_id', 'left');
		$this->db->join('kelompok', 'jenis.kelompok_id = kelompok.kelompok_id', 'left');
		$this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
		if($id !=null) {
			$this->db->where('objek_id', $id);
		}
		$this->db->order_by('objek_id', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($objek_id)
	{
		$this->db->select('*');
		$this->db->from('objek');
		$this->db->where('objek_id', $objek_id);
		$this->db->order_by('objek_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('objek', $data);
	}

	public function edit($data)
	{
		$this->db->where('objek_id', $data['objek_id']);
		$this->db->update('objek', $data);
	}

	public function del_objek($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('objek');
    }
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */