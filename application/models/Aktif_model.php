<?php

/**
 * 
 */
class Aktif_model extends CI_Model
{

	public function getAllAktif()
	{
		return $this->db->get('dbpam_pa')->result_array();
	}

	public function getAktif()
	{
		return $this->db->get_where('peserta_aktif', array('st_pes' => 'A'))->result_array();
	}

	public function getPensiun($limit, $start, $keyword = null)
	{
		$this->db->select('*');
		$this->db->from('dbpnm_pn');
		if ($keyword) {
			$this->db->like('dbpnm_pn.npk', $keyword);
			$this->db->or_like('dbpnm_pn.nama', $keyword);
		}
		$this->db->join('pn', 'pn.npk = dbpnm_pn.npk');
		$this->db->where('dbpnm_pn.cab =', 'A00');
		$this->db->or_where('dbpnm_pn.kota', 'Lhokseumawe');
		$this->db->order_by('dbpnm_pn.nama', 'ASC');
		return $this->db->get('', $limit, $start)->result_array();
	}

	public function getAnalytic()
	{
		$this->db->select('*');
		$this->db->from('dbpam_pa');
		$this->db->where('st_pes', 'A');
		$query = $this->db->get()->result_array();
		return ($query);
	}

	public function getMulai($limit, $start, $keyword = null)
	{
		$this->db->select('*');
		$this->db->from('tanggal_pensiun');
		if ($keyword) {
			$this->db->like('tanggal_pensiun.npk', $keyword);
			$this->db->or_like('tanggal_pensiun.nama', $keyword);
		}
		$this->db->join('pn', 'pn.npk = tanggal_pensiun.npk');
		$this->db->where('tanggal_pensiun.mulai <', '2010-12-31');
		$this->db->order_by('tanggal_pensiun.nama', 'ASC');
		return $this->db->get('', $limit, $start)->result_array();
	}

	public function countAllAktif()
	{
		return $this->db->get('dbpam_pa')->num_rows();
	}

	public function updateDataAktif()
	{
		$data = [
			"nopen" => $this->input->post('nopen', true),
			"npk" => $this->input->post('npk', true),
			"nama_pes" => $this->input->post('nama_pes', true),
			"jnkel" => $this->input->post('jnkel'),
			"stts_kwn" => $this->input->post('stts_kwn'),
			"tgl_lhr" => $this->input->post('tgl_lhr'),
			"tgl_mlai_krj" => $this->input->post('tgl_mlai_krj'),
			"phdp" => $this->input->post('phdp')
		];
		$this->db->where('npk', $this->input->post('npk'));
		$this->db->update('sim_mp', $data);
	}

	public function getAktifById($npk)
	{
		return $this->db->get_where('peserta_aktif', ['npk' => $npk])->row_array();
	}

	public function getAhliWarisById($npk)
	{
		return $this->db->get_where('ahli_waris', ['npk' => $npk])->result_array();
	}
	public function getAhliWarisByNoId($no_id)
	{
		return $this->db->get_where('ahli_waris', ['no_id' => $no_id])->row_array();
	}
	public function getDetailById($npk)
	{
		return $this->db->get_where('peserta_aktif', ['npk' => $npk])->row_array();
	}
	public function update_ahliwaris($where, $data)
	{
		$this->db->where($where);
		$this->db->update('ahli_waris', $data);
	}

	public function getAllDataById($npk)
	{
		return $this->db->get_where('peserta_aktif', ['npk' => $npk])->row_array();
	}

	public function getAllTempDataById($npk)
	{
		return $this->db->get_where('temp_dbpam_pa', ['noreg' => $npk])->row_array();
	}

	public function update_datapribadi($where, $data)
	{
		$this->db->where($where);
		$this->db->update('temp_dbpam_pa', $data);
	}

	public function update_preview_datapribadi($where, $data)
	{
		$this->db->where($where);
		$this->db->update('peserta_aktif', $data);
	}

	
}
