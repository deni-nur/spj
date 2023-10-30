<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_kegiatan_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('sub_kegiatan.*, kegiatan.kode as kode_kegiatan, program.kode as kode_program');
		$this->db->from('sub_kegiatan');
		$this->db->join('kegiatan', 'sub_kegiatan.kegiatan_id=kegiatan.kegiatan_id');
		$this->db->join('program', 'kegiatan.program_id=program.program_id');
		if($id !=null) {
			$this->db->where('sub_kegiatan_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function detail($sub_kegiatan_id)
	{
		$this->db->select('*');
		$this->db->from('sub_kegiatan');
		$this->db->where('sub_kegiatan_id', $sub_kegiatan_id);
		$this->db->order_by('sub_kegiatan_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('sub_kegiatan', $data);
	}

	public function edit($data)
	{
		$this->db->where('sub_kegiatan_id', $data['sub_kegiatan_id']);
		$this->db->update('sub_kegiatan', $data);
	}

	public function del_sub_kegiatan($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('sub_kegiatan');
    }
}