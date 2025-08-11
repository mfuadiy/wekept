<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model atau helper jika dibutuhkan
        $this->load->model('Absensi_model', 'absensi');
    }

    public function index()
    {
        $data['judul'] = 'Absensi'; //Menu
        $data['title'] = 'Absensi'; // Sub Menu
        $data['user']     = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // Dapatkan data absensi dari model
        $data['absensi'] = $this->absensi->get_all_absensi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('absensi/index', $data);
        $this->load->view('templates/footer');
    }

    public function proses_absen()
    {
        $nama_karyawan = $this->input->post('nama_karyawan');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $jarak = $this->input->post('jarak');
        $tanggal = date('Y-m-d');
        $jam_masuk = date('H:i:s');

        // Validasi apakah karyawan berada dalam jarak yang diperbolehkan
        if ($jarak <= 50) {
            // Proses absensi (misalnya simpan ke database)
            $data = [
                'nama_karyawan' => $nama_karyawan,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'tanggal' => $tanggal,
                'jam_masuk' => $jam_masuk
            ];

            $this->db->insert('absensi', $data);
            $this->session->set_flashdata('message', 'Absensi berhasil');
        } else {
            $this->session->set_flashdata('message', 'Anda berada di luar jangkauan absensi.');
        }

        redirect('absensi/proses_absensi');
    }
}
