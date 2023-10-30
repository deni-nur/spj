<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Luar_daerah_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('luar_daerah.*, pangkat.golongan, provinsi.name');
		$this->db->from('luar_daerah');
		$this->db->join('pangkat', 'luar_daerah.pangkat_id = pangkat.pangkat_id','LEFT');
		$this->db->join('provinsi', 'luar_daerah.provinsi_id = provinsi.provinsi_id', 'left');
		if($id !=null) {
			$this->db->where('luar_daerah_id', $id);
		}
		$this->db->order_by('luar_daerah_id', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($luar_daerah_id)
	{
		$this->db->select('*');
		$this->db->from('luar_daerah');
		$this->db->where('luar_daerah_id', $luar_daerah_id);
		$this->db->order_by('luar_daerah_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('luar_daerah', $data);
	}

	public function edit($data)
	{
		$this->db->where('luar_daerah_id', $data['luar_daerah_id']);
		$this->db->update('luar_daerah', $data);
	}

	public function del_luar_daerah($id)
    {
        $this->db->where('luar_daerah_id', $id);
        $this->db->delete('luar_daerah');
    }
}