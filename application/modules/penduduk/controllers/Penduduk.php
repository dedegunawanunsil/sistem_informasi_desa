<?php 
class Penduduk extends MX_Controller {
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
        $this->load->model('penduduk_model');
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
		//Mengambil Seluruh Data Penduduk 
		//dari table penduduk
		$sql = "SELECT dp.id, dp.nik, dp.nama, dp.jenis_kelamin, ak.id_keluarga, ak.nikk 
		FROM `data-penduduk` dp 
		LEFT JOIN 
			(SELECT ak.id, ak.`id_keluarga`, kg.`nikk`, st.`nama` AS `status`, ak.`id_penduduk`
			FROM anggota_keluarga ak JOIN `status_keluarga` st ON ak.`status` = st.id 
			JOIN `keluarga` kg ON ak.`id_keluarga` = kg.id)
			AS ak
		ON dp.`id` = ak.`id_penduduk`
		";
		$data = $this->db->query($sql)->result();
		//passing variabel data ke view
		$this->load->view('design/header');
        //$this->load->view('dashboard/admin');
		$this->load->view('semua', array('data' => $data));
        $this->load->view('design/footer');
		
		
	}
	function tambah() {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->form_validation->set_rules('nik', 'NIK', 'required|integer|is_unique[data-penduduk.nik]');
		/*
         * $this->form_validation->set_rules('nikk', 'NIKK', 'required|integer');
         * $this->form_validation->set_rules('status_keluarga', 'Status Keluarga', 'required|integer');
		 */
		 
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('status_kawin', 'Status Kawin', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
		/* 
		if(@$_POST['status_keluarga'] && (@$_POST['status_keluarga'] == 1) || (@$_POST['status_keluarga'] == 2)) {
			$this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
			$this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
		}
		*/
        if ($this->form_validation->run() == true)
        {
			//var_dump($_POST);
			//die();
            $nik = $this->input->post('nik');
            $nama = $this->input->post('nama');
            $agama = $this->input->post('agama');
            $tgl_lahir = $this->input->post('tanggal_lahir');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $status_nikah = $this->input->post('status_kawin');
            $pekerjaan = $this->input->post('pekerjaan');
            $penghasilan = $this->input->post('penghasilan');
            $pendidikan = $this->input->post('pendidikan');
            $kewarganegaraan = $this->input->post('kewarganegaraan');
            $tgl_pendaftaran = date('Y-m-d');
            $tgl_update = date('0000-00-00');
			
            $insert = $this->db->insert('data-penduduk', array(
                'nik' => $nik,
                'nama' => $nama,
                'tgl_lahir' => $tgl_lahir,
                'tempat_lahir' => $tempat_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'status_nikah' => $status_nikah,
                'pekerjaan' => $pekerjaan,
                'penghasilan' => $penghasilan,
                'pendidikan' => $pendidikan,
                'kewarganegaraan' => $kewarganegaraan,
                'tgl_pendaftaran' => $tgl_pendaftaran,
                'tgl_update' => $tgl_update, 
				'agama' => $agama
            ));
			/*
			if($insert) {
				$id_penduduk = $this->db->insert_id();
				$nikk = $this->input->post('nikk');
				$id_keluarga = $this->db->select('id')->where('nikk', $nikk)->get('keluarga')->row()->id;
				$status = $this->input->post('status_keluarga');
				$nama_ayah = $this->input->post('nama_ayah');
				$nama_ibu = $this->input->post('nama_ibu');
				$data = array(
					'id_keluarga' => $id_keluarga,
					'status' => $status,
					'id_penduduk' => $id_penduduk
				);
				if(($status == 1) || ($status == 2)) {
					$data['ayah'] = $nama_ayah;
					$data['ibu'] = $nama_ibu;
				}
				$insert2 = $this->db->insert('anggota_keluarga', $data);
			}
            */
			if ($insert) {
                $this->session->set_flashdata('message', "<p class='alert alert-success' >Penambahan Data Penduduk Berhasil <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('penduduk', 'refresh');
            } else {
                $this->session->set_flashdata('message', "<p class='alert alert-danger' >Penambahan Data Penduduk Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('penduduk', 'refresh');
            }
        }
        else 
        {
            $this->load->view('design/header');
            $this->load->view('tambah');
            $this->load->view('design/footer');      
            
        }
    }
	function detail($id) {
		if (!is_numeric($id)) {
            $this->session->set_flashdata('message', "<p class='alert alert-danger' >Detail Data Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
            redirect('keluarga', 'refresh');
        }
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->form_validation->set_rules('nik', 'NIK', 'required|integer');
        $this->form_validation->set_rules('id', 'ID', 'required|integer');
		/*
         * $this->form_validation->set_rules('nikk', 'NIKK', 'required|integer');
         * $this->form_validation->set_rules('status_keluarga', 'Status Keluarga', 'required|integer');
		 */
		 
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('status_kawin', 'Status Kawin', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
		/* 
		if(@$_POST['status_keluarga'] && (@$_POST['status_keluarga'] == 1) || (@$_POST['status_keluarga'] == 2)) {
			$this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
			$this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
		}
		*/
        if ($this->form_validation->run() == true && !$this->db->where("id <> '$id' AND nik = ".$this->db->escape($_POST['nik']))->get('data-penduduk')->num_rows())
        {
			//var_dump($_POST);
			//die();
			
			$id = $this->input->post('id');
            $nik = $this->input->post('nik');
            $nama = $this->input->post('nama');
            $agama = $this->input->post('agama');
            $tgl_lahir = $this->input->post('tanggal_lahir');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $status_nikah = $this->input->post('status_kawin');
            $pekerjaan = $this->input->post('pekerjaan');
            $penghasilan = $this->input->post('penghasilan');
			$penghasilan = str_ireplace(".", "", trim(trim(trim($penghasilan), "Rp.")));
            $pendidikan = $this->input->post('pendidikan');
            $kewarganegaraan = $this->input->post('kewarganegaraan');
            $tgl_pendaftaran = date('Y-m-d');
            $tgl_update = date('0000-00-00');
            $insert = @$this->db->where('id', $id)->update('data-penduduk', array(
                'nik' => $nik,
                'nama' => $nama,
                'tgl_lahir' => $tgl_lahir,
                'tempat_lahir' => $tempat_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'status_nikah' => $status_nikah,
                'pekerjaan' => $pekerjaan,
                'penghasilan' => $penghasilan,
                'pendidikan' => $pendidikan,
                'kewarganegaraan' => $kewarganegaraan,
                'tgl_pendaftaran' => $tgl_pendaftaran,
                'tgl_update' => $tgl_update, 
				'agama' => $agama
            ));
			if ($insert) {
                $this->session->set_flashdata('message', "<p class='alert alert-success' >Update Data Penduduk Berhasil <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('penduduk', 'refresh');
            } else {
                $this->session->set_flashdata('message', "<p class='alert alert-danger' >Update Data Penduduk Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('penduduk', 'refresh');
            }
        }
        else 
        {
			$data = $this->penduduk_model->get_penduduk_by_id($id);
            $this->load->view('design/header');
            $this->load->view('edit', array('data' => $data));
            $this->load->view('design/footer');      
            
        }
    }
	function hapus($id) {
        if ($this->penduduk_model->delete($id)) {
                $this->session->set_flashdata('message', "<p class='alert alert-success' >Hapus Data Berhasil <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('penduduk', 'refresh');
            } else {
                $this->session->set_flashdata('message', "<p class='alert alert-danger' >Hapus Data Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('', 'refresh');
            }
        
    }
	function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey',  $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array('csrfkey' => $key, 'csrfvalue' => $value);
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue') && ($this->session->flashdata('csrfvalue') != FALSE))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}