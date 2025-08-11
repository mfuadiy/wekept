<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
class Surat_model extends CI_Model
{

    public function getAllSurat($limit, $start, $keyword = null)
    {
        $this->db->select('*');
        $this->db->from('surat_masuk');
        if ($keyword) {
            $this->db->like('perihal', $keyword);
            $this->db->or_like('no_surat', $keyword);
            $this->db->or_like('tgl_surat', $keyword);
            $this->db->or_like('no_agenda', $keyword);
        }
        $this->db->order_by('date_created', 'DESC');
        return $this->db->get('', $limit, $start)->result_array();
    }

    public function getSurat()
    {
        return $this->db->get('surat_masuk')->result_array();
    }

    public function delete_surat_masuk_by_id($id)
    {
        // Menghapus data dari tabel surat_masuk berdasarkan id
        return $this->db->delete('surat_masuk', ['id' => $id]);
    }

    public function getSuratById($id)
    {
        return $this->db->get_where('surat_masuk', ['id' => $id])->row_array();
    }
}
