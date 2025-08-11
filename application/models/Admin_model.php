<?php

/**
 * 
 */
class Admin_model extends CI_Model
{
    public function getAktif()
    {
        return $this->db->get_where('peserta_aktif', array('st_pes' => 'A'))->result_array();
    }

    public function getNumAktif()
    {
        return $this->db->where(['st_pes' => 'A'])->from('peserta_aktif')->count_all_results();
    }

    public function getNumPasif()
    {
        return $this->db->where(array('p_bln' => '01', 'p_thn' => '2024'))->from('dbpn')->count_all_results();
    }

    public function getDatul()
    {
        return $this->db->where(array('status' => '1'))->from('datul')->count_all_results();
    }

    public function get_user_by_id($id)
    {
        // Query untuk mendapatkan data user dari tabel user
        $this->db->where('id', $id);
        $query = $this->db->get('user');

        // Jika data ditemukan, kembalikan data sebagai array
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
}
