<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('jenis.*, kelompok.kode_kelompok, akun.kode_akun');
		$this->db->from('jenis');
		$this->db->join('kelompok', 'jenis.kelompok_id = kelompok.kelompok_id', 'left');
		$this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
		if($id !=null) {
			$this->db->where('jenis_id', $id);
		}
		$this->db->order_by('jenis_id', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($jenis_id)
	{
		$this->db->select('*');
		$this->db->from('jenis');
		$this->db->where('jenis_id', $jenis_id);
		$this->db->order_by('jenis_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('jenis', $data);
	}

	public function edit($data)
	{
		$this->db->where('jenis_id', $data['jenis_id']);
		$this->db->update('jenis', $data);
	}

	public function del_jenis($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('jenis');
    }
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */