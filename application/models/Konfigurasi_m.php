<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi_m extends CI_Model {

	public function listing()
	{
		$query = $this->db->get('konfigurasi');
		return $query->row();
	}

	public function get($id = null)
	{
		$this->db->from('konfigurasi');
		if($id !=null) {
			$this->db->where('konfigurasi_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function detail($konfigurasi_id)
	{
		$this->db->select('*');
		$this->db->from('konfigurasi');
		$this->db->where('konfigurasi_id', $konfigurasi_id);
		$this->db->order_by('konfigurasi_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('konfigurasi', $data);
	}

	public function edit($data)
	{
		$this->db->where('konfigurasi_id', $data['konfigurasi_id']);
		$this->db->update('konfigurasi', $data);
	}

	public function delete($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('konfigurasi');
    }

}

/* End of file konfigurasi_m.php */
/* Location: ./application/models/konfigurasi_m.php */