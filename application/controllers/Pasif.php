<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\WriterMultiSheetsAbstract;
use Box\Spout\Common\Entity\Row;

class Pasif extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pasif_model', 'pasif');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['judul'] = 'Peserta Pasif';
        $data['title'] = 'Inquiry Peserta Pasif';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['start'] = $this->uri->segment(3);

        $data['pensiun']    = $this->pasif->getPensiun();
        $role_user = $data['user']['role_id'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        if ($role_user !== "1") {
            $this->load->view('auth/blocked');
        } else {
            $this->load->view('pasif/index', $data);
        }
        $this->load->view('templates/footer');
    }

    public function detail($npk)
    {
        $data['title']          = 'Inquiry Peserta Pasif';
        $data['judul']          = 'Peserta Pasif';
        $data['user']           = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $role_user = $data['user']['role_id'];
        // if ($role_user == 4) {
        // } else {
        //     redirect('auth/blocked');
        // }
        // $npk = $data['user']['npk'];

        $data['pensiun']        = $this->pasif->getDetailPensiun($npk);
        $data['ahli_waris']     = $this->pasif->getAhliWaris($npk);
        $data['jenis_pensiun']  = $this->db->get('jenis_pensiun')->result_array();
        $data['prov']           = $this->db->get('prov')->result_array();
        $data['jk'] = $this->db->get('jk')->result_array();
        $data['agama'] = $this->db->get('agama')->result_array();
        $data['cabang'] = $this->db->get('cabang')->result_array();


        $data['datul']          = $this->db->get_where('datul', ['npk' => $npk])->row_array();

        $this->db->where('npk', $npk);
        $b = $this->db->get('datul');
        $data['jum'] = $b->num_rows();
        $data['ada']        = "";
        $data['ada1']        = "";

        $this->db->where('npk', $npk);
        $this->db->get('datul');
        $a = $this->db->count_all_results();
        $c = "";

        if ($b->num_rows() > 0) {
            $c = $data['datul']['status'];
        }
        if ($c > 0) {
            $data['ada'] = "disabled";
        }
        if ($c < 1) {
            $data['ada1'] = "disabled";
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasif/detail_pasif', $data);
        $this->load->view('templates/footer');
    }

    public function datul()
    {
        $data['title']  = 'Data Ulang';
        $data['judul']  = 'Peserta Pasif';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['peoples']    = $this->pasif->getAllPensiun();
        $data['datul'] = $this->db->get('datul')->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasif/datul', $data);
        $this->load->view('templates/footer');
    }

    public function otentikasi()
    {
        $data['judul'] = 'Peserta Pasif';
        $data['title'] = 'Otentikasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['otentikasi'] = $this->pasif->getOtentikasi();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasif/otentikasi', $data);
        $this->load->view('templates/footer');
    }

    public function detail_datul($npk)
    {
        $data['title']          = 'Data Ulang';
        $data['judul']          = 'Peserta Pasif';
        $data['user']           = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $data['pensiun']        = $this->pasif->getDetailPensiun($npk);
        $data['ahli_waris']     = $this->pasif->getAhliWaris($npk);
        // $data['datul']          = $this->db->get('datul')->row_array();
        $data['jenis_pensiun']  = $this->db->get('jenis_pensiun')->result_array();
        $data['prov']           = $this->db->get('prov')->result_array();

        $data['datul']          = $this->db->get_where('datul', ['npk' => $npk])->row_array();

        $this->db->where('npk', $npk);
        $b = $this->db->get('datul');
        $data['jum'] = $b->num_rows();
        $data['ada']    = "";
        $data['ada1']    = "";

        $this->db->where('npk', $npk);
        $this->db->get('datul');
        $a = $this->db->count_all_results();
        $c = "";

        if ($b->num_rows() > 0) {
            $c = $data['datul']['status'];
        }


        if ($c > 0) {
            $data['ada'] = "disabled";
        }
        if ($c < 1) {
            $data['ada1'] = "disabled";
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasif/detail_datul', $data);
        $this->load->view('templates/footer');
    }

    public function update_datul()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $nama           = $this->input->post('nama');
        $nopen          = $this->input->post('nopen');
        $npk            = $this->input->post('npk');
        $stppp          = $this->input->post('stppp');
        $alamat         = $this->input->post('alamat');
        $rt_rw          = $this->input->post('rt_rw');
        $kelurahan      = $this->input->post('kelurahan');
        $kecamatan      = $this->input->post('kecamatan');
        $kota           = $this->input->post('kota');
        $provinsi       = $this->input->post('provinsi');
        $kodepos        = $this->input->post('kodepos');
        $no_hp          = $this->input->post('no_hp');
        $no_hplain      = $this->input->post('no_hplain');
        $email          = $this->input->post('email');
        $npwp           = $this->input->post('npwp');
        $tgl_lahir      = $this->input->post('tgl_lahir');
        $date_created   = time();
        $pic            = $data['user']['name'];

        $data['pensiun'] = $this->Datul_model->getPensiun($npk);

        $a = "";
        $b = "";
        $c = "";
        $d = "";
        $e = "";
        $f = "";
        $g = "";
        $h = "";
        $i = "";

        if ($stppp != $data['pensiun']['stppp']) {
            $a = "Jenis Pensiun, ";
        }
        if ($alamat != $data['pensiun']['alamat']) {
            $b = "Alamat, ";
        }
        if ($rt_rw != $data['pensiun']['rt_rw']) {
            $c = "RT/RW, ";
        }
        if ($kelurahan != $data['pensiun']['kelurahan']) {
            $d = "Kelurahan, ";
        }
        if ($kecamatan != $data['pensiun']['kecamatan']) {
            $e = "Kecamatan, ";
        }
        if ($kota != $data['pensiun']['kota']) {
            $f = "Kota, ";
        }
        if ($no_hp != $data['pensiun']['hp']) {
            $g = "Nomor HP, ";
        }
        if ($npwp != $data['pensiun']['npwp']) {
            $h = "NPWP, ";
        }
        if ($kodepos != $data['pensiun']['kodepos']) {
            $i = "Kodepos, ";
        }

        $insert = array(
            'nama'          => $nama,
            'nopen'         => $nopen,
            'npk'           => $npk,
            'stppp'         => $stppp,
            'alamat'        => $alamat,
            'rt_rw'         => $rt_rw,
            'kelurahan'     => $kelurahan,
            'kecamatan'     => $kecamatan,
            'kota'          => $kota,
            'provinsi'      => $provinsi,
            'kodepos'       => $kodepos,
            'no_hp'         => $no_hp,
            'no_hplain'     => $no_hplain,
            'email'         => $email,
            'npwp'          => $npwp,
            'date_created'  => $date_created,
            'tgl_lahir'     => $tgl_lahir,
            'status'        => '1',
            'perubahan'     => '' . $a . '' . $b . '' . $c . '' . $d . '' . $e . '' . $f . '' . $g . '' . $h . '' . $i,
            'pic'           => $pic
        );
        $this->db->insert('datul', $insert);
        /*
        $upload_ktp       = $_FILES['file_ktp']['name'];
        $waktu            = time();

        $data['datul']    = $this->db->get_where('datul', ['npk' => $npk])->row_array();

        if ($upload_ktp) {
            $waktu = time();

            $namafile = "ktp-" . $nopen . "-" . $nama . "-" . $waktu;
            $config['allowed_types'] = 'jpg|png|bmp|jpeg|pdf';
            $config['upload_path'] = './assets/img/datul/ktp/';
            $config['file_name'] = $namafile;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file_ktp')) {
                $new_image = $this->upload->data('file_name');
                $this->db->set('file_ktp', $new_image);
                $this->db->where('npk', $data['datul']['npk']);
                $this->db->update('datul');
            } else {
                echo $this->upload->display_errors();
            }
        }

        $upload_npwp      = $_FILES['file_npwp']['name'];
        if ($upload_npwp) {
            $namafile1 = "npwp-" . $nopen . "-" . $nama . "-" . $waktu;
            $config1['allowed_types'] = 'jpg|png|bmp|jpeg|pdf';
            $config1['upload_path'] = './assets/img/datul/npwp/';
            $config1['file_name'] = $namafile1;
            $this->load->library('upload', $config1);

            if ($this->upload->do_upload('file_npwp')) {
                $new_image1 = $this->upload->data('file_name');
                $this->db->set('file_npwp', $new_image1);
                $this->db->where('npk', $data['datul']['npk']);
                $this->db->update('datul');
            } else {
                echo $this->upload->display_errors();
            }
        }

        $upload_skmati    = $_FILES['file_sk_kematian']['name'];
        if ($upload_skmati) {
            $namafile2 = "skmati-" . $nopen . "-" . $nama . "-" . $waktu;
            $config2['allowed_types'] = 'jpg|png|bmp|jpeg|pdf';
            $config2['upload_path'] = './assets/img/datul/sk_kematian/';
            $config2['file_name'] = $namafile2;
            $this->load->library('upload', $config2);

            if ($this->upload->do_upload('file_sk_kematian')) {
                $new_image2 = $this->upload->data('file_name');
                $this->db->set('file_skkematian', $new_image2);
                $this->db->where('npk', $data['datul']['npk']);
                $this->db->update('datul');
            } else {
                echo $this->upload->display_errors();
            }
        }

        $upload_aktanikah = $_FILES['file_akta_nikah']['name'];
        if ($upload_aktanikah) {
            $namafile3 = "aktanikah-" . $nopen . "-" . $nama . "-" . $waktu;
            $config3['allowed_types'] =  'jpg|png|bmp|jpeg|pdf';
            $config3['upload_path'] = './assets/img/datul/akta_nikah/';
            $config3['file_name'] = $namafile3;
            $this->load->library('upload', $config3);

            if ($this->upload->do_upload('file_aktanikah')) {
                $new_image3 = $this->upload->data('file_name');
                $this->db->set('file_aktanikah', $new_image3);
                $this->db->where('npk', $data['datul']['npk']);
                $this->db->update('datul');
            } else {
                echo $this->upload->display_errors();
            }
        }

        $upload_kk        = $_FILES['file_kk']['name'];
        if ($upload_kk) {
            $namafile4 = "kk-" . $nopen . "-" . $nama . "-" . $waktu;
            $config4['allowed_types'] = 'jpg|png|bmp|jpeg|pdf';
            $config4['upload_path'] = './assets/img/datul/kk/';
            $config4['file_name'] = $namafile4;
            $this->load->library('upload', $config4);

            if ($this->upload->do_upload('file_kk')) {
                $new_image4 = $this->upload->data('file_name');
                $this->db->set('file_kk', $new_image4);
                $this->db->where('npk', $data['datul']['npk']);
                $this->db->update('datul');
            } else {
                echo $this->upload->display_errors();
            }
        }
*/

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                        Berhasil Ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span> 
                    </div>');
        redirect('datul/detail/' . $npk);
    }

    public function dataUlang()
    {
        $data['title']          = 'Data Ulang';
        $data['judul']          = 'Data Ulang';
        $data['user']           = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $npk                    = $data['user']['npk'];

        $data['pensiun']        = $this->pasif->getDetailPensiun($npk);
        $data['ahli_waris']     = $this->pasif->getAhliWaris($npk);
        $data['jenis_pensiun']  = $this->db->get('jenis_pensiun')->result_array();
        $data['prov']           = $this->db->get('prov')->result_array();

        $data['datul']          = $this->db->get_where('datul', ['npk' => $npk])->row_array();

        $this->db->where('npk', $npk);
        $b = $this->db->get('datul');
        $data['jum'] = $b->num_rows();

        // var_dump($data['jum']);

        $data['ada']        = "";
        $data['ada1']        = "";

        $this->db->where('npk', $npk);
        $this->db->get('datul');
        $a = $this->db->count_all_results();
        $c = "";

        if ($b->num_rows() > 0) {
            $c = $data['datul']['status'];
        }


        if ($c > 0) {
            $data['ada'] = "disabled";
        }
        if ($c < 1) {
            $data['ada1'] = "disabled";
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasif/detail_datul', $data);
        $this->load->view('templates/footer');
    }

    public function daftar_pensiunan()
    {
        $data['title']          = 'Peserta Pasif';
        $data['judul']          = 'Kepesertaan';
        $data['user']           = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pensiun/daftar_pensiunan', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $a = "";
        $b = "";
        $c = "";
        $d = "";
        $e = "";
        $f = "";
        $g = "";
        $h = "";
        $i = "";

        $nama           = $this->input->post('nama');
        $nopen          = $this->input->post('nopen');
        $npk            = $this->input->post('npk');
        $stppp          = $this->input->post('stppp');
        $alamat         = $this->input->post('alamat');
        $rt_rw          = $this->input->post('rt_rw');
        $kelurahan      = $this->input->post('kelurahan');
        $kecamatan      = $this->input->post('kecamatan');
        $kota           = $this->input->post('kota');
        $provinsi       = $this->input->post('provinsi');
        $kodepos        = $this->input->post('kodepos');
        $no_hp          = $this->input->post('no_hp');
        $no_hplain      = $this->input->post('no_hplain');
        $email          = $this->input->post('email');
        $npwp           = $this->input->post('npwp');
        $tgl_lahir      = $this->input->post('tgl_lahir');
        $date_created   = time();
        $pic            = $data['user']['name'];
        $data['pensiun'] = $this->pasif->getDetailPensiun($npk);

        if ($stppp != $data['pensiun']['stppp']) {
            $a = "Jenis Pensiun, ";
        }
        if ($alamat != $data['pensiun']['alamat']) {
            $b = "Alamat, ";
        }
        if ($rt_rw != $data['pensiun']['rt_rw']) {
            $c = "RT/RW, ";
        }
        if ($kelurahan != $data['pensiun']['kelurahan']) {
            $d = "Kelurahan, ";
        }
        if ($kecamatan != $data['pensiun']['kecamatan']) {
            $e = "Kecamatan, ";
        }
        if ($kota != $data['pensiun']['kota']) {
            $f = "Kota, ";
        }
        if ($no_hp != $data['pensiun']['hp']) {
            $g = "Nomor HP, ";
        }
        if ($npwp != $data['pensiun']['npwp']) {
            $h = "NPWP, ";
        }
        if ($kodepos != $data['pensiun']['kodepos']) {
            $i = "Kodepos, ";
        }

        $insert = array(
            'nama'          => $nama,
            'nopen'         => $nopen,
            'npk'           => $npk,
            'stppp'         => $stppp,
            'alamat'        => $alamat,
            'rt_rw'         => $rt_rw,
            'kelurahan'     => $kelurahan,
            'kecamatan'     => $kecamatan,
            'kota'          => $kota,
            'provinsi'      => $provinsi,
            'kodepos'       => $kodepos,
            'no_hp'         => $no_hp,
            'no_hplain'     => $no_hplain,
            'email'         => $email,
            'npwp'          => $npwp,
            'date_created'  => $date_created,
            'tgl_lahir'     => $tgl_lahir,
            'status'        => '1',
            'perubahan'     => '' . $a . '' . $b . '' . $c . '' . $d . '' . $e . '' . $f . '' . $g . '' . $h . '' . $i,
            'pic'           => $pic
        );
        $this->db->insert('datul', $insert);


        $data['datul']    = $this->db->get_where('datul', ['npk' => $npk])->row_array();

        // $upload_ktp       = $_FILES['file_ktp']['name'];
        // $waktu            = time();
        // if ($upload_ktp) {
        //     $waktu = time();

        //     $namafile = "ktp-" . $nopen . "-" . $nama . "-" . $waktu;
        //     $config['allowed_types'] = 'jpg|png|bmp|jpeg|pdf';
        //     $config['upload_path'] = './assets/img/datul/ktp/';
        //     $config['file_name'] = $namafile;
        //     $this->load->library('upload', $config);
        //     $this->upload->initialize($config);
        //     if ($this->upload->do_upload('file_ktp')) {
        //         $new_image = $this->upload->data('file_name');
        //         $this->db->set('file_ktp', $new_image);
        //         $this->db->where('npk', $data['datul']['npk']);
        //         $this->db->update('datul');
        //     } else {
        //         echo $this->upload->display_errors();
        //     }
        // }

        // $upload_npwp      = $_FILES['file_npwp']['name'];
        // $waktu            = time();
        // if ($upload_npwp) {
        //     $waktu = time();

        //     $namafile1 = "npwp-" . $nopen . "-" . $nama . "-" . $waktu;
        //     $config1['allowed_types'] = 'jpg|png|bmp|jpeg|pdf';
        //     $config1['upload_path'] = './assets/img/datul/npwp/';
        //     $config1['file_name'] = $namafile1;
        //     $this->load->library('upload', $config1);
        //     $this->upload->initialize($config1);
        //     if ($this->upload->do_upload('file_npwp')) {
        //         $new_image1 = $this->upload->data('file_name');
        //         $this->db->set('file_npwp', $new_image1);
        //         $this->db->where('npk', $data['datul']['npk']);
        //         $this->db->update('datul');
        //     } else {
        //         echo $this->upload->display_errors();
        //     }
        // }

        // $upload_skmati    = $_FILES['file_sk_kematian']['name'];
        // $waktu            = time();
        // if ($upload_skmati) {
        //     $waktu = time();

        //     $namafile2 = "skmati-" . $nopen . "-" . $nama . "-" . $waktu;
        //     $config2['allowed_types'] = 'jpg|png|bmp|jpeg|pdf';
        //     $config2['upload_path'] = './assets/img/datul/sk_kematian/';
        //     $config2['file_name'] = $namafile2;
        //     $this->load->library('upload', $config2);
        //     $this->upload->initialize($config2);
        //     if ($this->upload->do_upload('file_sk_kematian')) {
        //         $new_image2 = $this->upload->data('file_name');
        //         $this->db->set('file_skkematian', $new_image2);
        //         $this->db->where('npk', $data['datul']['npk']);
        //         $this->db->update('datul');
        //     } else {
        //         echo $this->upload->display_errors();
        //     }
        // }

        // $upload_aktanikah = $_FILES['file_akta_nikah']['name'];
        // $waktu = time();
        // if ($upload_aktanikah) {
        //     $waktu = time();

        //     $namafile3 = "aktanikah-" . $nopen . "-" . $nama . "-" . $waktu;
        //     $config3['allowed_types'] = 'jpg|png|bmp|jpeg|pdf';
        //     $config3['upload_path'] = './assets/img/datul/akta_nikah/';
        //     $config3['file_name'] = $namafile3;
        //     $this->load->library('upload', $config3);
        //     $this->upload->initialize($config3);
        //     if ($this->upload->do_upload('file_akta_nikah')) {
        //         $new_image3 = $this->upload->data('file_name');
        //         $this->db->set('file_aktanikah', $new_image3);
        //         $this->db->where('npk', $data['datul']['npk']);
        //         $this->db->update('datul');
        //     } else {
        //         echo $this->upload->display_errors();
        //     }
        // }


        // $upload_kk        = $_FILES['file_kk']['name'];
        // $waktu = time();
        // if ($upload_kk) {
        //     $waktu = time();

        //     $namafile4 = "kk-" . $nopen . "-" . $nama . "-" . $waktu;
        //     $config4['allowed_types'] = 'jpg|png|bmp|jpeg|pdf';
        //     $config4['upload_path'] = './assets/img/datul/kk/';
        //     $config4['file_name'] = $namafile4;
        //     $this->load->library('upload', $config4);
        //     $this->upload->initialize($config4);
        //     if ($this->upload->do_upload('file_kk')) {
        //         $new_image4 = $this->upload->data('file_name');
        //         $this->db->set('file_kk', $new_image4);
        //         $this->db->where('npk', $data['datul']['npk']);
        //         $this->db->update('datul');
        //     } else {
        //         echo $this->upload->display_errors();
        //     }
        // }


        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                        Data Berhasil Disimpan <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span> 
                    </div>');
        redirect('pasif/detail_datul/' . $npk);
    }
    public function export_datul()
    {

        $semuabarang = $this->pasif->getDatul();

        //$customTempFolderPath = 'C:\Users\hp\Downloads';

        // setup Spout Excel Writer, set tipenya xlsx
        $writer = WriterEntityFactory::createXLSXWriter();
        // $writer->setTempFolder($customTempFolderPath);
        // download to browser
        $writer->openToBrowser('Rekap-Datul.xlsx');


        $writer->getCurrentSheet()->setName('Rekap Datul');
        $header = [
            WriterEntityFactory::createCell('No'),
            WriterEntityFactory::createCell('NPK'),
            WriterEntityFactory::createCell('Nopen'),
            WriterEntityFactory::createCell('Nama'),
            WriterEntityFactory::createCell('Tanggal Lahir'),
            WriterEntityFactory::createCell('Alamat'),
            WriterEntityFactory::createCell('RT/RW'),
            WriterEntityFactory::createCell('Kelurahan'),
            WriterEntityFactory::createCell('Kecamatan'),
            WriterEntityFactory::createCell('Kota'),
            WriterEntityFactory::createCell('Provinsi'),
            WriterEntityFactory::createCell('Nomor HP'),
            WriterEntityFactory::createCell('Nomor HP Suami/Istri'),
            WriterEntityFactory::createCell('Jenis Pensiun'),
            WriterEntityFactory::createCell('Tanggal Datul'),
            WriterEntityFactory::createCell('Perubahan Data'),
            WriterEntityFactory::createCell('Update Simadu'),
            WriterEntityFactory::createCell('PIC')
        ];

        $data1 = array();
        $i = 1;

        foreach ($semuabarang as $d) {
            $barang = [
                WriterEntityFactory::createCell($i++),
                WriterEntityFactory::createCell($d['npk']),
                WriterEntityFactory::createCell($d['nopen']),
                WriterEntityFactory::createCell($d['nama']),
                WriterEntityFactory::createCell(date('d-m-Y', strtotime($d['date_created']))),
                WriterEntityFactory::createCell($d['alamat']),
                WriterEntityFactory::createCell($d['rt_rw']),
                WriterEntityFactory::createCell($d['kelurahan']),
                WriterEntityFactory::createCell($d['kecamatan']),
                WriterEntityFactory::createCell($d['kota']),
                WriterEntityFactory::createCell($d['provinsi']),
                WriterEntityFactory::createCell($d['no_hp']),
                WriterEntityFactory::createCell($d['no_hplain']),
                WriterEntityFactory::createCell($d['stppp']),
                WriterEntityFactory::createCell(date('d-m-Y', $d['date_created'])),
                WriterEntityFactory::createCell($d['perubahan']),
                WriterEntityFactory::createCell($d['simadu']),
                WriterEntityFactory::createCell($d['pic'])
            ];
            array_push($data1, WriterEntityFactory::createRow($barang));
        }

        $singleRow = WriterEntityFactory::createRow($header);
        $writer->addRow($singleRow); //tambah row untuk header data
        $writer->addRows($data1); //tambah row data

        // https://opensource.box.com/spout/docs/#new-sheet-creation

        // close writter
        $writer->close();
    }
}
