<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

	public function login($post)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $post['username']);
		$this->db->where('password', sha1($post['password']));
		//$this->db->where('unit_kerja_id', $post['unit_kerja_id']);
		$this->db->where('tahun_anggaran_id', $post['tahun_anggaran_id']);
		$query = $this->db->get();
		return $query;
	}

	public function get($id = null)
	{
		$this->db->select('user.*, level.level, tahun_anggaran.tahun, unit_kerja.unit_kerja');
		$this->db->from('user');
		$this->db->join('level', 'user.level_id=level.level_id');
		$this->db->join('tahun_anggaran', 'user.tahun_anggaran_id=tahun_anggaran.tahun_anggaran_id');
		$this->db->join('unit_kerja', 'user.unit_kerja_id=unit_kerja.unit_kerja_id');
		if($id !=null) {
			$this->db->where('user_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function detail($user_id)
	{
		$this->db->select('user.*, level.level, tahun_anggaran.tahun, unit_kerja.unit_kerja');
		$this->db->from('user');
		$this->db->join('level', 'user.level_id=level.level_id');
		$this->db->join('tahun_anggaran', 'user.tahun_anggaran_id=tahun_anggaran.tahun_anggaran_id');
		$this->db->join('unit_kerja', 'user.unit_kerja_id=unit_kerja.unit_kerja_id');
		$this->db->where('user_id', $user_id);
		$this->db->order_by('user_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('user', $data);
	}

	public function edit($data)
	{
		$this->db->where('user_id', $data['user_id']);
		$this->db->update('user', $data);
	}

	public function delete($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('user');
    }

    public function changepassword($data)
	{
		$this->db->where('user_id', $data['user_id']);
		$this->db->update('user', $data);
	}

	public function profile($data)
	{
		$this->db->where('user_id', $data['user_id']);
		$this->db->update('user', $data);
	}

	public function updatepass($data)
	{
		$this->db->where('user_id', $data['user_id']);
		$this->db->update('user', $data);
	}
}