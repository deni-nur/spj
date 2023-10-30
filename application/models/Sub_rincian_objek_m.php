<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_rincian_objek_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('sub_rincian_objek.*, akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek');
		$this->db->from('sub_rincian_objek');
		$this->db->join('rincian_objek', 'sub_rincian_objek.rincian_objek_id = rincian_objek.rincian_objek_id', 'left');
		$this->db->join('objek', 'rincian_objek.objek_id = objek.objek_id', 'left');
		$this->db->join('jenis', 'objek.jenis_id = jenis.jenis_id', 'left');
		$this->db->join('kelompok', 'jenis.kelompok_id = kelompok.kelompok_id', 'left');
		$this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
		if($id !=null) {
			$this->db->where('sub_rincian_objek_id', $id);
		}
		$this->db->order_by('objek.kode_objek', 'asc');
		$this->db->order_by('kode_sub_rincian_objek', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($sub_rincian_objek_id)
	{
		$this->db->select('*');
		$this->db->from('sub_rincian_objek');
		$this->db->where('sub_rincian_objek_id', $sub_rincian_objek_id);
		$this->db->order_by('sub_rincian_objek_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('sub_rincian_objek', $data);
	}

	public function edit($data)
	{
		$this->db->where('sub_rincian_objek_id', $data['sub_rincian_objek_id']);
		$this->db->update('sub_rincian_objek', $data);
	}

	public function del_sub_rincian_objek($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('sub_rincian_objek');
    }
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */