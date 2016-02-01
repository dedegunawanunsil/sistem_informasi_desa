<?php 
class Laporan_penduduk extends MX_Controller {
	function __construct()
	{
		//HArus Load Construct bawaan class MX_Controller
		//MX_Controller adalah class Constroller yang mengimplementasikan HMVC
		parent::__construct();
		//Load Library, helper, Lang & Config yang dibutuhkan
		$this->lang->load('auth');
		$this->config->load('ion_auth', TRUE, FALSE);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        $this->load->model('laporan_penduduk_model');
		//End Load

		//Cek USer Login Belum
		if(!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}
		//End Cek User
		$user = $this->ion_auth->user()->row();
        $user_groups = $this->ion_auth->get_users_groups()->row();
        $_SESSION['user'] = $user;
        $_SESSION['user_groups'] = $user_groups;
	}
	function index() {
		//Mengambil Seluruh Data keluarga 
		//dari table keluarga
		//passing variabel data ke view
		$this->load->view('design/header');
        //$this->load->view('dashboard/admin');
		$this->load->view('pilih-menu');
        $this->load->view('design/footer');
		
		
	}
	function p_k() {
		$data = array(
			'data_kk' => $this->laporan_penduduk_model->get_all_keluarga(),
			'data_kel' => $this->laporan_penduduk_model->get_all_penduduk()
		);
		//load the view and saved it into $html variable
		$html=$this->load->view('p_k', $data, true);

		$this->_pdf_it($html);
		
	}
	
	function jk() {
		$data = array(
			'data' => $this->laporan_penduduk_model->jk()
		);
		$html=$this->load->view('jk', $data, true);
		$this->_pdf_it($html);	
	}
	function pk() {
		$this->load->helper('romanic_number');
		$this->load->model('pendidikan/pendidikan_model');
		$data = array(
			'data' => $this->laporan_penduduk_model->jk(),
			'pendidikan_terakhir' => $this->pendidikan_model->get_all_pendidikan()
		);
		$html=$this->load->view('pk', $data, true);
		echo $html;
		//$this->_pdf_it($html);	
	}
	function agama() {
		$this->load->model('agama/agama_model');
		$data = array(
			'data' => $this->laporan_penduduk_model->jk(),
			'agama' => $this->agama_model->get_all_agama()
		);
		$html=$this->load->view('agama', $data, true);
		$this->_pdf_it($html);	
	}
	function s_k() {
		$this->load->model('status_nikah/status_nikah_model');
		$data = array(
			'data' => $this->laporan_penduduk_model->jk(),
			'status_nikah' => $this->status_nikah_model->get_all_status_nikah()
		);
		$html=$this->load->view('s_k', $data, true);
		$this->_pdf_it($html);	
	}
	function _pdf_it($html, $page_orientation = 'A4-L') {
		$this->load->library('m_pdf');
		$pdf = new mPDF('utf-8', $page_orientation);
		//generate the PDF from the given html
		$pdf->WriteHTML($html);
	
		//download it.
		$pdf->Output();
	}
}