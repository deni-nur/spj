<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Npd_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->select('npd.*, sub_rincian_objek.nama_sub_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, rekening.no_rekening, rekening.bank, rekening.pemilik');
		$this->db->from('npd');
		$this->db->join('dpa', 'npd.dpa_id=dpa.dpa_id');
		$this->db->join('belanja', 'npd.belanja_id = belanja.belanja_id', 'left');
		$this->db->join('sub_rincian_objek', 'belanja.sub_rincian_objek_id = sub_rincian_objek.sub_rincian_objek_id', 'left');
        $this->db->join('rincian_objek', 'sub_rincian_objek.rincian_objek_id = rincian_objek.rincian_objek_id', 'left');
        $this->db->join('objek', 'rincian_objek.objek_id = objek.objek_id', 'left');
        $this->db->join('jenis', 'objek.jenis_id = jenis.jenis_id', 'left');
        $this->db->join('kelompok', 'jenis.kelompok_id = kelompok.kelompok_id', 'left');
        $this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
		$this->db->join('rekening', 'npd.rekening_id = rekening.rekening_id', 'left');
		$this->db->join('sppd', 'npd.sppd_id = sppd.sppd_id', 'left');
		if($id !=null) {
			$this->db->where('npd.dpa_id', $id);
		}
		$this->db->order_by('npd.npd_id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function detail($npd_id)
	{
		$this->db->select('npd.*, sub_rincian_objek.nama_sub_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, rekening.no_rekening, rekening.bank, rekening.pemilik, sppd.tempat_tujuan');
		$this->db->from('npd');
		$this->db->join('belanja', 'npd.belanja_id = belanja.belanja_id', 'left');
		$this->db->join('sub_rincian_objek', 'belanja.sub_rincian_objek_id = sub_rincian_objek.sub_rincian_objek_id', 'left');
        $this->db->join('rincian_objek', 'sub_rincian_objek.rincian_objek_id = rincian_objek.rincian_objek_id', 'left');
        $this->db->join('objek', 'rincian_objek.objek_id = objek.objek_id', 'left');
        $this->db->join('jenis', 'objek.jenis_id = jenis.jenis_id', 'left');
        $this->db->join('kelompok', 'jenis.kelompok_id = kelompok.kelompok_id', 'left');
        $this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
		$this->db->join('rekening', 'npd.rekening_id = rekening.rekening_id', 'left');
		$this->db->join('sppd', 'npd.sppd_id = sppd.sppd_id', 'left');
		$this->db->where('npd_id', $npd_id);
		$this->db->order_by('npd_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function get_pengikut($id = null)
    {
        $this->db->select('pengikut.*, pegawai.name as pengikut_name, pegawai.nip as pengikut_nip, pangkat.golongan as pengikut_golongan, pangkat.pangkat as pengikut_pangkat, jabatan.jabatan as pengikut_jabatan, surat_tugas.maksud, sppd.sppd_id, sppd.lama_perjalanan, sppd.tempat_tujuan');
		$this->db->from('pengikut');
		$this->db->join('pegawai', 'pengikut.pegawai_id = pegawai.pegawai_id', 'left');
		$this->db->join('pangkat', 'pegawai.pangkat_id = pangkat.pangkat_id', 'left');
		$this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.jabatan_id', 'left');
		$this->db->join('surat_tugas', 'pengikut.surat_tugas_id = surat_tugas.surat_tugas_id', 'left');
		$this->db->join('sppd', 'sppd.surat_tugas_id = surat_tugas.surat_tugas_id', 'left');
		if($id !=null) {
			$this->db->where('pengikut.surat_tugas_id', $id);
		}
		$this->db->order_by('pengikut.surat_tugas_id');
		$query = $this->db->get();
		return $query;
    }

	public function add($data)
	{
		$this->db->insert('npd', $data);
	}

	public function edit($data)
	{
		$this->db->where('npd_id', $data['npd_id']);
		$this->db->update('npd', $data);
	}

	public function del_npd($id)
	{
		$this->db->where('npd_id', $id);
        $this->db->delete('npd'); 
	}

	public function get_dpa($id = null)
	{
		$this->db->select('npd.*, program.kode as kode_program, program.name as nama_program, kegiatan.kode as kode_kegiatan, kegiatan.name as nama_kegiatan, dpa.kode, dpa.name');
		$this->db->from('npd');
		$this->db->join('dpa', 'npd.dpa_id = dpa.dpa_id', 'left');
		$this->db->join('kegiatan', 'dpa.kegiatan_id= kegiatan.kegiatan_id', 'left');
		$this->db->join('program', 'kegiatan.program_id = program.program_id', 'left');
		if($id !=null) {
			$this->db->where('npd.dpa_id', $id);
		}
    	$query = $this->db->get();
    	return $query;
  	}

  	public function get_belanja($id=null)
	{
		$this->db->select('belanja.*, dpa.kode, dpa.name, program.kode as kode_program, program.name as nama_program, kegiatan.kode as kode_kegiatan, kegiatan.name as nama_kegiatan, akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, sub_rincian_objek.nama_sub_rincian_objek, SUM(biaya*lama_perjalanan) as total_belanja');
        $this->db->from('belanja');
        $this->db->join('dpa', 'belanja.dpa_id = dpa.dpa_id', 'left');
        $this->db->join('kegiatan', 'dpa.kegiatan_id = kegiatan.kegiatan_id', 'left');
        $this->db->join('program', 'kegiatan.program_id = program.program_id', 'left');
        $this->db->join('sub_rincian_objek', 'belanja.sub_rincian_objek_id = sub_rincian_objek.sub_rincian_objek_id', 'left');
        $this->db->join('rincian_objek', 'sub_rincian_objek.rincian_objek_id = rincian_objek.rincian_objek_id', 'left');
        $this->db->join('objek', 'rincian_objek.objek_id = objek.objek_id', 'left');
        $this->db->join('jenis', 'objek.jenis_id = jenis.jenis_id', 'left');
        $this->db->join('kelompok', 'jenis.kelompok_id = kelompok.kelompok_id', 'left');
        $this->db->join('akun', 'kelompok.akun_id = akun.akun_id', 'left');
        $this->db->join('npd', 'npd.belanja_id=belanja.belanja_id');
        if($id !=null) {
            $this->db->where('belanja.dpa_id', $id);
            $this->db->group_by('npd.belanja_id');
        }
        $query = $this->db->get();
        return $query;
	}

  	public function get_selected_data($ttd_keuangan_id) 
	{
        $this->db->select('ttd_keuangan.*, pegawai.name, pegawai.nip, pangkat.pangkat, pangkat.golongan, jabatan.jabatan');
		$this->db->from('ttd_keuangan');
		$this->db->join('pegawai', 'ttd_keuangan.pegawai_id = pegawai.pegawai_id', 'left');
		$this->db->join('pangkat', 'pegawai.pangkat_id = pangkat.pangkat_id', 'left');
		$this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.jabatan_id', 'left');
		$this->db->where('ttd_keuangan_id', $ttd_keuangan_id);
		$query = $this->db->get();
        return $query->row();
    }

	public function getNpdData($tanggalDipilih) {
    $sql = "
    SELECT
        npd.npd_id AS npd_id,
        sub_rincian_objek.kode_sub_rincian_objek AS kode_sub_rincian_objek,
        npd.uraian AS uraian,
        npd.biaya AS biaya,
        npd.tanggal_npd AS tanggal_npd,
        npd.dpa_id as dpa_id,
        npd.lama_perjalanan as lama_perjalanan,
        npd.hasil_pajak as hasil_pajak,
        akun.kode_akun as kode_akun,
        kelompok.kode_kelompok as kode_kelompok,
        jenis.kode_jenis as kode_jenis,
        objek.kode_objek as kode_objek,
        rincian_objek.kode_rincian_objek as kode_rincian_objek,
        sub_rincian_objek.nama_sub_rincian_objek as nama_sub_rincian_objek,
        belanja.pagu_belanja_murni as pagu_belanja_murni,
        belanja.belanja_id as belanja_id,
        rekening.pemilik as pemilik,
        rekening.no_rekening as no_rekening,
        rekening.bank as bank,
        SUM(CASE WHEN DATE(npd.tanggal_npd) < ? THEN npd.biaya ELSE 0 END) AS akumulasi_pencairan_sebelumnya,
        SUM(CASE WHEN DATE(npd.tanggal_npd) = ? THEN npd.biaya ELSE 0 END) AS pencairan_saat_ini,
        SUM(npd.biaya*npd.lama_perjalanan) AS total_per_belanja  -- Tambahan: Total berdasarkan belanja_id
    FROM
        npd
    LEFT JOIN
    belanja ON npd.belanja_id = belanja.belanja_id
    LEFT JOIN
    sub_rincian_objek on belanja.sub_rincian_objek_id=sub_rincian_objek.sub_rincian_objek_id
    LEFT JOIN
    rincian_objek on sub_rincian_objek.rincian_objek_id=rincian_objek.rincian_objek_id
    LEFT JOIN
    objek ON rincian_objek.objek_id=objek.objek_id
    LEFT JOIN
    jenis on objek.jenis_id=jenis.jenis_id
    LEFT JOIN
    kelompok on jenis.kelompok_id=kelompok.kelompok_id
    LEFT JOIN
    akun on kelompok.akun_id=akun.akun_id
    LEFT JOIN
    rekening on npd.rekening_id=rekening.rekening_id
    GROUP BY
    sub_rincian_objek.kode_sub_rincian_objek, npd.uraian, npd.biaya, npd.tanggal_npd, akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek, sub_rincian_objek.nama_sub_rincian_objek, belanja.pagu_belanja_murni, npd.belanja_id;
    ";

    $query = $this->db->query($sql, array($tanggalDipilih, $tanggalDipilih));
    return $query->result();
}

public function get_total_belanja($tanggalDipilih)
	{
		$this->db->select('npd.*, SUM(biaya*lama_perjalanan) as total_per_belanja, SUM(hasil_pajak) as total_per_pajak');
		$this->db->from('npd');
		$this->db->join('belanja', 'npd.belanja_id = belanja.belanja_id', 'left');
		$this->db->where('DATE(tanggal_npd)', $tanggalDipilih); // Menambahkan kondisi WHERE
		$this->db->group_by('npd.belanja_id');
		$query = $this->db->get();
		return $query;
	}
}