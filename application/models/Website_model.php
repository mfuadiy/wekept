<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // Function to get articles
    public function getArtikel()
    {
        $query = $this->db->get('artikel'); // Assuming 'artikel' is the table name
        return $query->result_array();
    }

    // Function to get bulletins
    public function getBuletin()
    {
        $query = $this->db->get('buletin'); // Assuming 'buletin' is the table name
        return $query->result_array();
    }

    // Function to get carousel items
    public function getCarousel()
    {
        $query = $this->db->get('carousel'); // Assuming 'carousel' is the table name
        return $query->result_array();
    }

    // Function to get gallery items
    public function getGaleri()
    {
        $query = $this->db->get('galeri'); // Assuming 'galeri' is the table name
        return $query->result_array();
    }
}
