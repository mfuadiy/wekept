<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Otentikasi_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_data($data)
    {
        return $this->db->insert('otentikasi', $data);
    }
}
