<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->select('kecamatan.*, kokab.name as nama_kokab, provinsi.name as nama_provinsi ');
		$this->db->from('kecamatan');
		$this->db->join('kokab', 'kecamatan.kokab_id=kokab.kokab_id','LEFT');
		$this->db->join('provinsi', 'kokab.provinsi_id=provinsi.provinsi_id');
		if($id !=null) {
			$this->db->where('kecamatan_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function detail($kecamatan_id)
	{
		$this->db->select('*');
		$this->db->from('kecamatan');
		$this->db->where('kecamatan_id', $kecamatan_id);
		$this->db->order_by('kecamatan_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('kecamatan', $data);
	}

	public function edit($data)
	{
		$this->db->where('kecamatan_id', $data['kecamatan_id']);
		$this->db->update('kecamatan', $data);
	}

	public function del_kecamatan($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('kecamatan');
    }
}