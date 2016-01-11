<?php 
class Anggota_keluarga extends MX_Controller {
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
        $this->load->model('anggota_keluarga_model');
        $this->load->model('keluarga/keluarga_model');
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
	
    function ajax_keluarga() {
		$SQL = "SELECT k.id, k.nikk as label,k.nikk as value from keluarga k left outer join `master-kampung` mk ON k.master_kampung_id = mk.id WHERE k.nikk LIKE \"%".(isset($_GET['term']) ? $_GET['term'] : '')."%\" LIMIT 0,10";
		$res = $this->db->query($SQL)->result();
		echo json_encode($res);
	}
    function ajax_penduduk() {
		$SQL = "SELECT dp.nik, dp.nik as label,dp.nik as value from `data-penduduk` dp LEFT OUTER JOIN anggota_keluarga ak ON dp.id = ak.id_penduduk WHERE ak.status IS NULL AND dp.nik LIKE \"%".(isset($_GET['term']) ? $_GET['term'] : '')."%\" LIMIT 0,10";
		$res = $this->db->query($SQL)->result();
		echo json_encode($res);
	}
	function index() {
		if(!isset($_POST['nikk_id']) && !isset($_POST['nik_id'])) {
			//passing variabel data ke view
			$this->load->view('design/header');
			//Mengambil Seluruh Data keluarga 
			//dari table keluarga
			if(!isset($_GET['nikk_id']) || !is_numeric($_GET['nikk_id'])) {
				$this->load->view('semua', array());
			}
			else {
				$idk = $_GET['nikk_id'];
				$resx= @$this->keluarga_model->get_keluarga_by('nikk', $idk)[0]->id;
				$id = ($resx ? $resx : $idk); 
				$sql = "SELECT ak.id, ak.id_keluarga, ak.`ayah`, ak.`ibu`, dp.`nik`, dp.nama, sk.nama AS `status`
				 FROM anggota_keluarga ak
				LEFT OUTER JOIN `data-penduduk` dp
				ON ak.`id_penduduk` = dp.`id`
				LEFT OUTER JOIN `status_keluarga` sk
				ON ak.`status` = sk.`id` WHERE ak.id_keluarga = $id";
				$data = $this->db->query($sql)->result();
				//$this->load->view('dashboard/admin');
				$this->load->view('semua', array('data' => $data, 'nikk_id' => $_GET['nikk_id']));
			}
			$this->load->view('design/footer');
		}
		else {
			$this->load->model('penduduk/penduduk_model');
			$kel = @$this->keluarga_model->get_keluarga_by('nikk', $_POST['nikk_id'])[0]->id;
			$pend = @$this->penduduk_model->get_penduduk_by('nik', $_POST['nik_id'])[0]->id;
			if($kel && $pend) {
				$exists = $this->db->where('id_keluarga', $kel)->where('id_penduduk', $pend)->get('anggota_keluarga')->num_rows();
				if(!$exists) {
					$result = $this->anggota_keluarga_model->insert(array(
						'id_keluarga' => $kel,
						'id_penduduk' => $pend,
						'status' => $_POST['status'],
						'ayah' => $_POST['nama_ayah'],
						'ibu' => $_POST['nama_ibu']
					));
				}
				if(@$result) {
					$this->session->set_flashdata('message', "<p class='alert alert-success' >Penambahan Data Hubungan Keluarga Berhasil <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
					redirect('anggota_keluarga?nikk_id='.$_POST['nikk_id'], 'refresh');
				}
				else if(@$exists) {
					$this->session->set_flashdata('message', "<p class='alert alert-danger' >Penambahan Data Hubungan Keluarga Gagal, Data Sebelumnya sudah pernah dimasukkan<button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
					redirect('anggota_keluarga?nikk_id='.$_POST['nikk_id'], 'refresh');
				}
				else {
					$this->session->set_flashdata('message', "<p class='alert alert-danger' >Penambahan Data Hubungan Keluarga Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
					redirect('anggota_keluarga?nikk_id='.$_POST['nikk_id'], 'refresh');
				}
			}
			else {
				$this->session->set_flashdata('message', "<p class='alert alert-danger' >Penambahan Data Hubungan Keluarga Gagal, NIKK atau NIK Tidak ada <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
				redirect('anggota_keluarga', 'refresh');
			}
		}
	}
	function hapus($id) {
        if ($this->anggota_keluarga_model->delete($id)) {
                $this->session->set_flashdata('message', "<p class='alert alert-success' >Hapus Data Berhasil <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('anggota_keluarga?nikk_id='.$_GET['nikk_id'], 'refresh');
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