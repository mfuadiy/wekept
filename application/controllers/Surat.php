<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;


use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\WriterMultiSheetsAbstract;
use Box\Spout\Common\Entity\Row;

class Surat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //is_logged_in();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('Surat_model', 'surat');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Akun Saya';
        $data['judul'] = 'Surat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $npk = $data['user']['npk'];
        $data['detail'] = $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    public function getSuratById($id)
    {
        // Ambil data surat berdasarkan ID dari model
        $surat = $this->surat->getSuratById($id);

        // Kembalikan data dalam format JSON
        echo json_encode($surat);
    }

    public function suratmasuk()
    {
        $data['title'] = 'Surat Masuk';
        $data['judul'] = 'Surat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['surat'] = $this->db->get('surat_masuk')->result_array();

        //load library
        $this->load->library('pagination');
        $config['base_url'] = site_url('surat/suratmasuk');
        //Ambil Data Keyword
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }
        //Ambil Data Surat Berdasarkan Keyword
        $this->db->select('*');
        $this->db->from('surat_masuk');
        $this->db->like('perihal', $data['keyword']);
        $this->db->or_like('tgl_surat', $data['keyword']);
        $this->db->or_like('no_surat', $data['keyword']);
        $this->db->or_like('no_agenda', $data['keyword']);
        $this->db->order_by('id', 'ASC');
        //Config UI Pagination
        $config['total_rows']  = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;
        //styling
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');
        // Initialize
        $this->pagination->initialize($config);


        $data['start'] = $this->uri->segment(3);

        $data['allSurat']    = $this->surat->getAllSurat($config['per_page'], $data['start'], $data['keyword']);
        //$data['allSurat'] = $this->db->get('surat_masuk')->result_array();


        $this->form_validation->set_rules('tgl_agenda', 'Tanggal Agenda', 'required');
        $this->form_validation->set_rules('pengirim', 'Pengirim', 'required');
        $this->form_validation->set_rules('no_surat', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('tgl_surat', 'Tanggal Surat', 'required');
        $this->form_validation->set_rules('no_agenda', 'Nomor Agenda', 'required');
        // $this->form_validation->set_rules('tujuan', 'Tujuan', 'required');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('salur', 'Salur', 'required');

        $a1 = $this->input->post('dirut');
        $a2 = $this->input->post('direktur');
        $a3 = $this->input->post('menku');
        $a4 = $this->input->post('menkep');
        $a5 = $this->input->post('menum');
        $a6 = $this->input->post('audit');
        // $a1 = $this->input->post('dirut');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('surat/suratmasuk', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'tgl_agenda' => $this->input->post('tgl_agenda'),
                'pengirim' => $this->input->post('pengirim'),
                'no_surat' => $this->input->post('no_surat'),
                'tgl_surat' => $this->input->post('tgl_surat'),
                'no_agenda' => $this->input->post('no_agenda'),
                'tujuan' => $a1 . ', ' . $a2 . ', ' . $a3 . ', ' . $a4 . ', ' . $a5 . ', ' . $a6,
                'perihal' => $this->input->post('perihal'),
                'status' => $this->input->post('status'),
                'salur' => $this->input->post('salur'),
                'date_created' => time()
            ];
            $this->db->insert('surat_masuk', $data);

            $ab = $data['date_created'];
            $a = $this->db->get_where('surat_masuk', ['date_created' => $ab])->row_array();
            $c = $a['id'];

            // Cek Jika Ada Gambar Upload
            $upload_file = $_FILES["berkas"]["name"];

            if ($upload_file) {
                $waktu                   = time();
                // $namafile                = "berkas_" . $waktu;
                $config['allowed_types'] = 'pdf|jpg|jpeg|png';
                // $config['max_size']      = '5048';
                $config['upload_path']   = './assets/berkas/';
                // $config['file_name']     = $namafile;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('berkas')) {

                    $old_image = $data['surat_masuk']['berkas'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . './assets/berkas/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('berkas', $new_image);
                    $this->db->where('id', $c);
                    $this->db->update('surat_masuk');
                } else {
                    echo $this->upload->display_errors();
                }
            }



            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Surat Masuk Berhasil Di Tambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></div>');
            redirect('surat/suratmasuk');
        }
    }

    public function editsurat($id)
    {
        $data['title'] = 'Edit Surat Masuk';
        $data['judul'] = 'Surat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat'] = $this->db->get_where('surat_masuk', ['id' => $id])->row_array();
        $data['allSurat'] = $this->db->get('surat_masuk')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('surat/editsurat', $data);
        $this->load->view('templates/footer');
    }

    public function updatesurat()
    {
        $data['title'] = 'Edit Surat Masuk';
        $data['judul'] = 'Surat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $id = $this->input->post('id');
        $tgl_agenda = $this->input->post('tgl_agenda');
        $pengirim = $this->input->post('pengirim');
        $no_surat = $this->input->post('no_surat');
        $tgl_surat = $this->input->post('tgl_surat');
        $no_agenda = $this->input->post('no_agenda');
        $tujuan = $this->input->post('tujuan');
        $perihal = $this->input->post('perihal');
        $status = $this->input->post('status');
        $salur = $this->input->post('salur');
        $berkas = $this->input->post('berkas');
        $a1 = $this->input->post('dirut');
        $a2 = $this->input->post('direktur');
        $a3 = $this->input->post('menku');
        $a4 = $this->input->post('menkep');
        $a5 = $this->input->post('menum');
        $a6 = $this->input->post('audit');

        $this->db->set('tgl_agenda', $tgl_agenda);
        $this->db->set('pengirim', $pengirim);
        $this->db->set('no_surat', $no_surat);
        $this->db->set('tgl_surat', $tgl_surat);
        $this->db->set('no_agenda', $no_agenda);
        $this->db->set('tujuan', $a1 . ', ' . $a2 . ', ' . $a3 . ', ' . $a4 . ', ' . $a5 . ', ' . $a6);
        $this->db->set('perihal', $perihal);
        $this->db->set('status', $status);
        $this->db->set('salur', $salur);
        $this->db->set('berkas', $berkas);
        $this->db->where('id', $id);
        $this->db->update('surat_masuk');
        // var_dump($id);
        // die();

        // Cek Jika Ada Gambar Upload
        $upload_file = $_FILES["berkas"]["name"];

        if ($upload_file) {
            $waktu                   = time();
            // $namafile                = "berkas_" . $waktu;
            $config['allowed_types'] = 'pdf|jpg|jpeg|png';
            // $config['max_size']      = '5048';
            $config['upload_path']   = './assets/berkas/';
            // $config['file_name']     = $namafile;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('berkas')) {

                $old_image = $data['surat_masuk']['berkas'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . './assets/berkas/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->set('berkas', $new_image);
                $this->db->where('id', $id);
                $this->db->update('surat_masuk');
            } else {
                echo $this->upload->display_errors();
            }
        }
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Surat Berhasil Di Updated
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>'
        );
        redirect('surat/suratmasuk');
    }

    public function delete_surat_masuk($id)
    {
        $deleted = $this->surat->delete_surat_masuk_by_id($id);
        if ($deleted) {
            // Set pesan sukses jika berhasil dihapus
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Surat Berhasil Dihapus
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        } else {
            // Set pesan gagal jika tidak berhasil dihapus
            $this->session->set_flashdata('error', 'Gagal menghapus surat');
        }

        // Redirect kembali ke halaman sebelumnya atau ke halaman surat masuk
        redirect('surat/suratmasuk');
    }

    public function excel5()
    {

        $allSurat = $this->surat->getSurat();
        //$customTempFolderPath = 'C:\Users\hp\Downloads';
        // setup Spout Excel Writer, set tipenya xlsx
        //$writer->setTempFolder($customTempFolderPath);
        // download to browser
        $waktu                   = time();
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToBrowser('Rekap-Surat-Masuk-' . $waktu . '.xlsx');


        $writer->getCurrentSheet()->setName('Daftar Surat');
        $header = [
            WriterEntityFactory::createCell('No'),
            WriterEntityFactory::createCell('Tanggal Agenda'),
            WriterEntityFactory::createCell('Pengirim'),
            WriterEntityFactory::createCell('Nomor Surat'),
            WriterEntityFactory::createCell('Tanggal Surat'),
            WriterEntityFactory::createCell('Nomor Agenda'),
            WriterEntityFactory::createCell('Perihal'),
            WriterEntityFactory::createCell('Tujuan'),
            WriterEntityFactory::createCell('Isi Disposisi'),
            WriterEntityFactory::createCell('Di Salurkan'),
            WriterEntityFactory::createCell('Berkas')
        ];

        $data1 = array();
        $i = 1;

        foreach ($allSurat as $b) {
            $surat = [
                WriterEntityFactory::createCell($i++),
                WriterEntityFactory::createCell($b['tgl_agenda']),
                WriterEntityFactory::createCell($b['pengirim']),
                WriterEntityFactory::createCell($b['no_surat']),
                WriterEntityFactory::createCell($b['tgl_surat']),
                WriterEntityFactory::createCell($b['no_agenda']),
                WriterEntityFactory::createCell($b['perihal']),
                WriterEntityFactory::createCell($b['tujuan']),
                WriterEntityFactory::createCell($b['disposisi']),
                WriterEntityFactory::createCell($b['salur']),
                WriterEntityFactory::createCell($b['berkas'])

            ];
            array_push($data1, WriterEntityFactory::createRow($surat));
        }

        $singleRow = WriterEntityFactory::createRow($header);
        $writer->addRow($singleRow); //tambah row untuk header data
        $writer->addRows($data1); //tambah row data


        $writer->addNewSheetAndMakeItCurrent()->setName('Barang 2'); // Sheet baru
        $singleRow = WriterEntityFactory::createRow($header);
        $writer->addRow($singleRow); //tambah row untuk header data
        $writer->addRows($data1); //tambah row data

        $writer->addNewSheetAndMakeItCurrent()->setName('Barang 3'); // Sheet baru
        $singleRow = WriterEntityFactory::createRow($header);
        $writer->addRow($singleRow); //tambah row untuk header data
        $writer->addRows($data1); //tambah row data

        // https://opensource.box.com/spout/docs/#new-sheet-creation

        // close writter
        $writer->close();
    }
}
