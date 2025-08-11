<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';



class Otentikasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Otentikasi_model', 'otentikasi');
        is_logged_in();
        // $this->load->model('Otentikasi_model', 'otentikasi');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $data['judul'] = 'Otentikasi';
        $data['title'] = 'Otentikasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $npk = $data['user']['npk'];
        $data['otentikasi'] = $this->db->get_where('otentikasi', ['npk' => $npk])->result_array();
        $data['months'] = [
            ['id' => '01', 'name' => 'Januari'],
            ['id' => '02', 'name' => 'Februari'],
            ['id' => '03', 'name' => 'Maret'],
            ['id' => '04', 'name' => 'April'],
            ['id' => '05', 'name' => 'Mei'],
            ['id' => '06', 'name' => 'Juni'],
            ['id' => '07', 'name' => 'Juli'],
            ['id' => '08', 'name' => 'Agustus'],
            ['id' => '09', 'name' => 'September'],
            ['id' => '10', 'name' => 'Oktober'],
            ['id' => '11', 'name' => 'November'],
            ['id' => '12', 'name' => 'Desember']
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('otentikasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function do_upload($month)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $npk = $data['user']['npk'];

        $config['upload_path'] = './assets/img/otentikasi';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $month . '_' . $npk;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            // $this->load->view('upload_form', $error);
        } else {
            $upload_data = $this->upload->data();

            // Compress and resize image
            $config_img['image_library'] = 'gd2';
            $config_img['source_image'] = $upload_data['full_path'];
            $config_img['new_image'] = $upload_data['full_path'];
            $config_img['maintain_ratio'] = TRUE;
            $config_img['quality'] = '50%';
            $config_img['width'] = 1080;
            $config_img['height'] = 1920;

            $this->load->library('image_lib', $config_img);

            if (!$this->image_lib->resize()) {
                $error = array('error' => $this->image_lib->display_errors());
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
  			Data gagal disimpan!
			</div>');
            } else {
                $database = array(
                    'npk' => $npk,
                    'bln' => $month,
                    'nama_foto' => $upload_data['file_name'],
                    'date_created' => time()
                );
                $this->otentikasi->insert_data($database);

                // Insert notification into the database
                $this->db->insert('notifications', [
                    'email' => 'admin@dpkbpjamsostek.com',
                    'message' => 'User ' . $this->session->userdata('name') . ' has uploaded a photo for month ' . $month,
                    'link' => 'pasif/otentikasi',
                    'icon' => '',
                    'is_read' => False,
                    'date_created' => time()
                ]);
                $response = array('status' => 'success', 'message' => 'Data berhasil dikirim, foto akan divalidasi!', 'file_name' => $upload_data['file_name']);
            }
        }
        echo json_encode($response);
    }

    public function approval($npk)
    {
        $data = array(
            'status' => true
        );

        $this->db->where('npk', $npk);
        $update = $this->db->update('otentikasi', $data);

        if ($update) {
            $response = array('message' => 'Approval status updated successfully.');
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($response));
        } else {
            $response = array('message' => 'Failed to update approval status.');
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode($response));
        }
    }
}
