<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dalam_daerah_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('dalam_daerah.*, pangkat.golongan, kecamatan.name');
		$this->db->from('dalam_daerah');
		$this->db->join('pangkat', 'dalam_daerah.pangkat_id = pangkat.pangkat_id','LEFT');
		$this->db->join('kecamatan', 'dalam_daerah.kecamatan_id = kecamatan.kecamatan_id', 'left');
		if($id !=null) {
			$this->db->where('dalam_daerah_id', $id);
		}
		$this->db->order_by('dalam_daerah_id', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($dalam_daerah_id)
	{
		$this->db->select('*');
		$this->db->from('dalam_daerah');
		$this->db->where('dalam_daerah_id', $dalam_daerah_id);
		$this->db->order_by('dalam_daerah_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('dalam_daerah', $data);
	}

	public function edit($data)
	{
		$this->db->where('dalam_daerah_id', $data['dalam_daerah_id']);
		$this->db->update('dalam_daerah', $data);
	}

	public function del_dalam_daerah($id)
    {
        $this->db->where('dalam_daerah_id', $id);
        $this->db->delete('dalam_daerah');
    }
}