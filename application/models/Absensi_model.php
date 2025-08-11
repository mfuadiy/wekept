<?php
class Absensi_model extends CI_Model
{
    public function get_all_absensi()
    {
        // Misalkan tabel absensi bernama 'absensi'
        $query = $this->db->get('absensi');
        return $query->result_array();
    }
}
