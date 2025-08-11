<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */

require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\WriterMultiSheetsAbstract;
use Box\Spout\Common\Entity\Row;

class Laporan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//is_logged_in();
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
		$this->load->model('Aktif_model');
		$this->load->library('form_validation');
	}

	public function pdf_proyeksi_mp($npk)
	{
		$data['title'] 			= 'SK Proyeksi Perhitungan Manfaat Pensiun';

		$data['npk']			= $npk;
		$data['phdp_1'] 		= $_POST['phdp_1'];
		$data['p_phdp'] 		= $_POST['p_phdp'];
		$data['nama_pes'] 		= $_POST['nama_pes'];
		$data['tgl_lhr'] 		= $_POST['tgl_lhr'];
		$data['tgl_mb'] 		= $_POST['tgl_mb'];
		$data['tgl_brnt'] 		= $_POST['tgl_brnt'];
		$data['st_kwn'] 		= $_POST['st_kwn'];
		$data['p_mk'] 			= $_POST['p_mk'];
		$data['usia_pensiun'] 	= $_POST['usia_pensiun'];
		$data['s_mk'] 			= $_POST['s_mk'];
		$data['fgus'] 			= $_POST['fgus'];
		$data['ns'] 			= $_POST['ns'];
		$data['p_mp'] 			= $_POST['p_mp'];
		$data['p_mpsek'] 		= $_POST['p_mpsek'];
		$data['p_mpsek20'] 		= $_POST['p_mpsek20'];
		$data['p_mpsek2050']	= $_POST['p_mpsek2050'];
		$data['p_pph2120'] 		= $_POST['p_pph2120'];
		$data['p_mp20'] 		= $_POST['p_mp20'];
		$data['p_mp80'] 		= $_POST['p_mp80'];
		$data['ter_jan_nov_p1'] = $_POST['ter_jan_nov_p1'];
		$data['ter_des_p1'] 	= $_POST['ter_des_p1'];
		$data['mp_jan_nov_p1']	= $_POST['mp_jan_nov_p1'];
		$data['mp_des_p1'] 		= $_POST['mp_des_p1'];
		$data['pph21mpber'] 	= $_POST['pph21mpber'];
		$data['par20'] 			= $_POST['par20'];
		$data['totpenmp']   	= $_POST['totpenmp'];
		$data['totpenmp80'] 	= $_POST['totpenmp80'];
		$data['total_penmp_pil_1'] 	= $_POST['total_penmp_pil_1'];

		$nama_dok	= "SK Proyeksi Perhitungan Manfaat Pensiun " . $data['nama_pes'] . ".pdf";
		$tampilan = $this->load->view('laporan/pdf_proyeksi_mp', $data, TRUE);
		$mpdf = new \Mpdf\Mpdf([
			'format' => 'Legal',
			'margin_top' => 20,
			'margin_right' => 3,
		]);
		$mpdf->WriteHTML($tampilan);
		$mpdf->Output($nama_dok, 'I');
	}

	public function pdf_proyeksi_mp_sekaligus($npk)
	{
		$data['title'] 			= 'SK Proyeksi Perhitungan Manfaat Pensiun';

		$data['npk']			= $npk;
		$data['phdp_1'] 		= $_POST['phdp_1'];
		$data['p_phdp'] 		= $_POST['p_phdp'];
		$data['nama_pes'] 		= $_POST['nama_pes'];
		$data['tgl_lhr'] 		= $_POST['tgl_lhr'];
		$data['tgl_mb'] 		= $_POST['tgl_mb'];
		$data['tgl_brnt'] 		= $_POST['tgl_brnt'];
		$data['st_kwn'] 		= $_POST['st_kwn'];
		$data['p_mk'] 			= $_POST['p_mk'];
		$data['usia_pensiun'] 	= $_POST['usia_pensiun'];
		$data['s_mk'] 			= $_POST['s_mk'];
		$data['fgus'] 			= $_POST['fgus'];
		$data['ns'] 			= $_POST['ns'];
		$data['p_mp'] 			= $_POST['p_mp'];
		$data['p_mpsek'] 		= $_POST['p_mpsek'];
		$data['p_mpsek20'] 		= $_POST['p_mpsek20'];
		$data['p_mpsek2050']	= $_POST['p_mpsek2050'];
		$data['p_pph2120'] 		= $_POST['p_pph2120'];
		$data['p_mp20'] 		= $_POST['p_mp20'];
		$data['p_mp80'] 		= $_POST['p_mp80'];
		$data['ter_jan_nov_p1'] = $_POST['ter_jan_nov_p1'];
		$data['ter_des_p1'] 	= $_POST['ter_des_p1'];
		$data['mp_jan_nov_p1']	= $_POST['mp_jan_nov_p1'];
		$data['mp_des_p1'] 		= $_POST['mp_des_p1'];
		$data['pph21mpber'] 	= $_POST['pph21mpber'];
		$data['par20'] 			= $_POST['par20'];
		$data['totpenmp']   	= $_POST['totpenmp'];
		$data['totpenmp80'] 	= $_POST['totpenmp80'];
		$data['total_penmp_pil_1'] 	= $_POST['total_penmp_pil_1'];
		$data['ter_jan_nov']    = $_POST['ter_jan_nov'];
		$data['mp_jan_nov']     = $_POST['mp_jan_nov'];
		$data['mp_des']         = $_POST['mp_des'];
		$data['ter_des']        = $_POST['ter_des'];
		$data['pph21mpber_p1']  = $_POST['pph21mpber_p1'];
		// $data['totpenmp_p1']    = $_POST['totpenmp_p1'];


		$nama_dok	= "SK Proyeksi Perhitungan Manfaat Pensiun " . $data['nama_pes'] . ".pdf";
		$tampilan = $this->load->view('laporan/pdf_proyeksi_mp_sekaligus', $data, TRUE);
		$mpdf = new \Mpdf\Mpdf([
			'format' => 'Legal',
			'margin_top' => 20,
			'margin_right' => 3,
		]);
		$mpdf->WriteHTML($tampilan);
		$mpdf->Output($nama_dok, 'I');
	}



	public function pdf_proyeksi_mp_sek($npk)
	{
		$data['title'] 			= 'SK Proyeksi Perhitungan Manfaat Pensiun';

		$data['npk']			= $npk;
		$data['phdp_1'] 		= $_POST['phdp_1'];
		$data['p_phdp'] 		= $_POST['p_phdp'];
		$data['nama_pes'] 		= $_POST['nama_pes'];
		$data['tgl_lhr'] 		= $_POST['tgl_lhr'];
		$data['tgl_mb'] 		= $_POST['tgl_mb'];
		$data['tgl_brnt'] 		= $_POST['tgl_brnt'];
		$data['st_kwn'] 		= $_POST['st_kwn'];
		$data['p_mk'] 			= $_POST['p_mk'];
		$data['usia_pensiun'] 	= $_POST['usia_pensiun'];
		$data['s_mk'] 			= $_POST['s_mk'];
		$data['fgus'] 			= $_POST['fgus'];
		$data['ns'] 			= $_POST['ns'];
		$data['p_mp'] 			= $_POST['p_mp'];
		$data['p_mpsek'] 		= $_POST['p_mpsek'];
		$data['p_mpsek20'] 		= $_POST['p_mpsek20'];
		$data['p_mpsek2050']	= $_POST['p_mpsek2050'];
		$data['p_pph2120'] 		= $_POST['p_pph2120'];
		$data['p_mp20'] 		= $_POST['p_mp20'];
		$data['p_mp80'] 		= $_POST['p_mp80'];
		$data['ter_jan_nov_p1'] = $_POST['ter_jan_nov_p1'];
		$data['ter_des_p1'] 	= $_POST['ter_des_p1'];
		$data['ter_jan_nov'] 	= $_POST['ter_jan_nov'];
		$data['ter_des'] 		= $_POST['ter_des'];
		$data['mp_jan_nov_p1']	= $_POST['mp_jan_nov_p1'];
		$data['mp_des_p1'] 		= $_POST['mp_des_p1'];
		$data['mp_jan_nov'] 	= $_POST['mp_jan_nov'];
		$data['mp_des'] 		= $_POST['mp_des'];
		$data['pph21mpber'] 	= $_POST['pph21mpber'];
		$data['par20'] 			= $_POST['par20'];
		$data['totpenmp']   	= $_POST['totpenmp'];
		$data['totpenmp80'] 	= $_POST['totpenmp80'];
		$data['pph21mpber_p1'] 	= $_POST['pph21mpber_p1'];
		$data['totpenmp_p1'] 	= $_POST['totpenmp_p1'];
		$data['total_penmp_pil_1'] 	= $_POST['total_penmp_pil_1'];

		$nama_dok	= "SK Proyeksi Perhitungan Manfaat Pensiun " . $data['nama_pes'] . ".pdf";
		$tampilan = $this->load->view('laporan/pdf_proyeksi_mp_sekaligus', $data, TRUE);
		$mpdf = new \Mpdf\Mpdf([
			'format' => 'Legal',
			'margin_top' => 20,
			'margin_right' => 3,
		]);
		$mpdf->WriteHTML($tampilan);
		$mpdf->Output($nama_dok, 'I');
	}
}
