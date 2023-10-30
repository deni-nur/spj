<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('kegiatan.*, program.kode as kode_program');
		$this->db->from('kegiatan');
		$this->db->join('program', 'kegiatan.program_id=program.program_id');
		if($id !=null) {
			$this->db->where('kegiatan_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function detail($kegiatan_id)
	{
		$this->db->select('*');
		$this->db->from('kegiatan');
		$this->db->where('kegiatan_id', $kegiatan_id);
		$this->db->order_by('kegiatan_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('kegiatan', $data);
	}

	public function edit($data)
	{
		$this->db->where('kegiatan_id', $data['kegiatan_id']);
		$this->db->update('kegiatan', $data);
	}

	public function del_kegiatan($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('kegiatan');
    }
}