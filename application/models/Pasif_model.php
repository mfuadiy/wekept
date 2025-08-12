<?php

/**
 * 
 */
class Pasif_model extends CI_Model
{

    public function getPensiun()
    {
        $this->db->select('*');
        $this->db->from('peserta_pasif');
        $this->db->join('dbpn', 'dbpn.npk = peserta_pasif.npk', 'right');
        $this->db->where('dbpn.p_bln', '01');
        $this->db->where('dbpn.p_thn', '2025');
        $this->db->order_by('dbpn.nama', 'ASC');
        $query = $this->db->get()->result_array();
        return ($query);
    }

    public function getAllPensiun()
    {
        $this->db->select('peserta_pasif.npk, peserta_pasif.nopen, peserta_pasif.nama');
        $this->db->from('peserta_pasif');
        $this->db->join('dbpn', 'dbpn.npk = peserta_pasif.npk');
        $this->db->where('dbpn.p_bln', '01');
        $this->db->where('dbpn.p_thn', '2025');
        $this->db->order_by('dbpn.nama', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getDetailPensiun($npk)
    {
        $this->db->select('*');
        $this->db->from('peserta_pasif');
        $this->db->join('dbpn', 'dbpn.npk = peserta_pasif.npk', 'right');
        $this->db->where('peserta_pasif.npk', $npk);
        $this->db->where('dbpn.p_bln', '01');
        $this->db->where('dbpn.p_thn', '2025');
        $this->db->order_by('peserta_pasif.nama', 'ASC');
        $query = $this->db->get()->row_array();
        return ($query);
    }

    public function getAhliWaris($npk)
    {
        $this->db->order_by('norut', 'ASC');
        return $this->db->get_where('ahli_waris', ['npk' => $npk])->result_array();
    }

    public function getDatul()
    {
        return $this->db->get('datul')->result_array();
    }

    public function getOtentikasi()
    {
        return $this->db->get('otentikasi')->result_array();
    }
}
