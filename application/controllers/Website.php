<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Website_model', 'web');
    }

    public function artikel()
    {
        $data['title']          = 'Website';
        $data['judul']          = 'Artikel';
        $data['user']           = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['artikel']        = $this->web->getArtikel();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('website/artikel', $data);
        $this->load->view('templates/footer');
    }

    private function curl_get($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function buletin()
    {
        $data['title']          = 'Website';
        $data['judul']          = 'Buletin';
        $data['user']           = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['buletin']        = $this->web->getBuletin();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('website/buletin', $data);
        $this->load->view('templates/footer');
    }

    public function carousel()
    {
        $data['title']          = 'Website';
        $data['judul']          = 'Carousel';
        $data['user']           = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['artikel']        = $this->web->getArtikel();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('website/carousel', $data);
        $this->load->view('templates/footer');
    }

    public function galeri()
    {
        $data['title']          = 'Website';
        $data['judul']          = 'Galeri';
        $data['user']           = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['artikel']        = $this->web->getArtikel();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('website/galeri', $data);
        $this->load->view('templates/footer');
    }
}
