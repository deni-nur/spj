<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lhpd_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('lhpd.*, surat_tugas.maksud');
		$this->db->from('lhpd');
		$this->db->join('surat_tugas', 'lhpd.surat_tugas_id = surat_tugas.surat_tugas_id', 'left');
		if($id !=null) {
			$this->db->where('lhpd.lhpd_id', $id);
		}
		$this->db->order_by('lhpd.lhpd_id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($lhpd_id)
	{
		$this->db->select('lhpd.*, surat_tugas.maksud');
		$this->db->from('lhpd');
		$this->db->join('surat_tugas', 'lhpd.surat_tugas_id = surat_tugas.surat_tugas_id', 'left');
		$this->db->where('lhpd_id', $lhpd_id);
		$this->db->order_by('lhpd_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function add($data)
	{
		$this->db->insert('lhpd', $data);
	}

	public function edit($data)
	{
		$this->db->where('lhpd_id', $data['lhpd_id']);
		$this->db->update('lhpd', $data);
	}

	public function del_lhpd($id)
    {
        $this->db->where('lhpd_id', $id);
        $this->db->delete('lhpd');
    }

	public function cetak($cetak)
	{
		$this->db->select('lhpd.*, surat_tugas.no_surat_tugas, surat_tugas.tanggal_surat, surat_tugas.maksud, surat_tugas.alamat, pegawai.name, pegawai.nip, pangkat.pangkat, pangkat.golongan, jabatan.jabatan');
		$this->db->from('lhpd');
		$this->db->join('surat_tugas', 'lhpd.surat_tugas_id = surat_tugas.surat_tugas_id', 'left');
		$this->db->join('pegawai', 'surat_tugas.pegawai_id = pegawai.pegawai_id', 'left');
		$this->db->join('pangkat', 'pegawai.pangkat_id = pangkat.pangkat_id', 'left');
		$this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.jabatan_id', 'left');
		$this->db->where('lhpd.lhpd_id', $cetak);
		$query = $this->db->get();
		return $query->row();
	}

    public function get_gambar($lhpd_id)
	{
		$this->db->select('*');
		$this->db->from('gambar_lhpd');
		$this->db->where('lhpd_id', $lhpd_id);
		$this->db->order_by('gambar_lhpd_id', 'desc');
		$query = $this->db->get();
		return $query;
	}

    public function detail_gambar($gambar_lhpd_id)
    {
        $this->db->select('*');
        $this->db->from('gambar_lhpd');
        $this->db->where('gambar_lhpd_id', $gambar_lhpd_id);
        $this->db->order_by('gambar_lhpd_id', 'asc');
        $query = $this->db->get();
        return $query->row();
    }

    public function gambar_add($data)
    {
        $this->db->insert('gambar_lhpd', $data);
    }

    public function gambar_edit($data)
    {
        $this->db->where('gambar_lhpd_id', $data['gambar_lhpd_id']);
        $this->db->update('gambar_lhpd', $data);
    }

    public function del_gambar_lhpd($id)
    {
        $this->db->where('gambar_lhpd_id', $id);
        $this->db->delete('gambar_lhpd');
    }
}

/* End of file Lhpd_m.php */
/* Location: ./application/models/Lhpd_m.php */