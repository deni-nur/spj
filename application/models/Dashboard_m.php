<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_m extends CI_Model {

	public function stget($id = null)
    {
        $this->db->select('*');
		$this->db->from('st');
		if($id !=null) {
			$this->db->where('portal_id', $id);
		}
		$this->db->order_by('portal_id', 'desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function kwitansiget($id = null)
    {
        $this->db->select('*');
		$this->db->from('kwitansi');
		if($id !=null) {
			$this->db->where('portal_id', $id);
		}
		$this->db->order_by('portal_id', 'desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function ppget($id = null)
    {
        $this->db->select('*');
		$this->db->from('pp');
		if($id !=null) {
			$this->db->where('portal_id', $id);
		}
		$this->db->order_by('portal_id', 'desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function lhpdget($id = null)
    {
        $this->db->select('*');
		$this->db->from('lhpd');
		if($id !=null) {
			$this->db->where('portal_id', $id);
		}
		$this->db->order_by('portal_id', 'desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function sppdget($id = null)
    {
        $this->db->select('*');
		$this->db->from('sppd');
		if($id !=null) {
			$this->db->where('portal_id', $id);
		}
		$this->db->order_by('portal_id', 'desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function dpaget($id = null)
    {
        $this->db->select('*');
		$this->db->from('dpa');
		if($id !=null) {
			$this->db->where('portal_id', $id);
		}
		$this->db->order_by('portal_id', 'desc');
		$query = $this->db->get();
		return $query->result();
    }
}

/* End of file Dashboard_m.php */
/* Location: ./application/models/Dashboard_m.php */