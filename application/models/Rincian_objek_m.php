<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rincian_objek_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('rincian_objek.*, kelompok.kode_kelompok, akun.kode_akun, jenis.kode_jenis, objek.kode_objek');
		$this->db->from('rincian_objek');
		$this->db->join('objek', 'rincian_objek.objek_id = objek.objek_id', 'left');
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

	public function detail($rincian_objek_id)
	{
		$this->db->select('*');
		$this->db->from('rincian_objek');
		$this->db->where('rincian_objek_id', $rincian_objek_id);
		$this->db->order_by('rincian_objek_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('rincian_objek', $data);
	}

	public function edit($data)
	{
		$this->db->where('rincian_objek_id', $data['rincian_objek_id']);
		$this->db->update('rincian_objek', $data);
	}

	public function del_rincian_objek($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('rincian_objek');
    }
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */