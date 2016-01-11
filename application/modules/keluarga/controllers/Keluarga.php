<?php 
class Keluarga extends MX_Controller {
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
        $this->load->model('keluarga_model');
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
		$sql = "SELECT k.id, k.nikk, k.alamat_detail, mk.rt, mk.rw, mk.kampung, COUNT(ak.id) as jumlah_anggota
		FROM keluarga k 
		LEFT OUTER JOIN `master-kampung` mk 
		ON k.`master_kampung_id` = mk.`id`
		LEFT OUTER JOIN `anggota_keluarga` ak 
		ON k.`id` = ak.id_keluarga
		GROUP BY k.`nikk`
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
        $this->form_validation->set_rules('nikk', 'NIKK', 'required|integer|is_unique[keluarga.nikk]');
        $this->form_validation->set_rules('alamat_detail', 'Alamat Rumah', 'required');
        $this->form_validation->set_rules('master_kampung', 'Kampung', 'required|integer');
        
        if ($this->form_validation->run() == true)
        {
			//var_dump($_POST);
			//die();
            $nikk = $this->input->post('nikk');
            $alamat_detail = $this->input->post('alamat_detail');
            $master_kampung = $this->input->post('master_kampung');
			
            $insert = $this->db->insert('keluarga', array(
                'nikk' => $nikk,
                'alamat_detail' => $alamat_detail,
                'master_kampung_id' => $master_kampung
            ));
			
            if ($insert) {
                $this->session->set_flashdata('message', "<p class='alert alert-success' >Penambahan Data Keluarga Berhasil <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('keluarga', 'refresh');
            } else {
                $this->session->set_flashdata('message', "<p class='alert alert-danger' >Penambahan Data keluarga Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('keluarga', 'refresh');
            }
        }
        else 
        {
            $this->load->view('design/header');
            $this->load->view('tambah');
            $this->load->view('design/footer');      
            
        }
    }
	function hapus($id) {
		$this->load->model('anggota_keluarga/anggota_keluarga_model');
        if ($this->keluarga_model->delete($id) && $this->anggota_keluarga_model->delete_by_id_keluarga($id)) {
                $this->session->set_flashdata('message', "<p class='alert alert-success' >Hapus Data Berhasil <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('keluarga', 'refresh');
            } else {
                $this->session->set_flashdata('message', "<p class='alert alert-danger' >Hapus Data Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('', 'refresh');
            }
        
    }
    function detail($id) {
        if (!is_numeric($id)) {
            $this->session->set_flashdata('message', "<p class='alert alert-danger' >Detail Data Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
            redirect('keluarga', 'refresh');
        }
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('nikk', 'NIKK', 'required|integer');
        $this->form_validation->set_rules('alamat_detail', 'Alamat Rumah', 'required');
        $this->form_validation->set_rules('master_kampung', 'Kampung', 'required|integer');
        if ($this->form_validation->run() == true)
        {
            $nikk = $this->input->post('nikk');
            $alamat_detail = $this->input->post('alamat_detail');
            $master_kampung = $this->input->post('master_kampung');
			
            $insert = $this->keluarga_model->update($_POST['id'], array(
                'nikk' => $nikk,
                'alamat_detail' => $alamat_detail,
                'master_kampung_id' => $master_kampung
            ));
            if ($insert) {
                $this->session->set_flashdata('message', "<p class='alert alert-success' >Update Data Berhasil <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('keluarga', 'refresh');
            } else {
                $this->session->set_flashdata('message', "<p class='alert alert-danger' >Update Data Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('', 'refresh');
            }
            
        }
        else 
        {
            $data = $this->keluarga_model->get_keluarga_by_id($id);
            $this->load->view('design/header');
            $this->load->view('edit', array('data' => $data));
            $this->load->view('design/footer');      

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