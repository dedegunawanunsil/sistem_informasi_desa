<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * ***************************************************************
 * Version : 0.1 
 * Date : 30 Oktober 2015
 * ***************************************************************
 */

/**
 *
 * @author Dede
 */
class Kampung extends CI_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login');
        }
        $user = $this->ion_auth->user()->row();
        $user_groups = $this->ion_auth->get_users_groups()->row();
        $_SESSION['user'] = $user;
        $_SESSION['user_groups'] = $user_groups;
        $this->load->model('kampung_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }  
    public function index() {    
        $this->load->view('design/header');
        $this->load->view('kampung/all', array(
            'data' => $this->kampung_model->get_all_kampung()
        ));
        $this->load->view('design/footer');
    }
    function tambah() {
        $this->form_validation->set_rules('kampung', 'Kampung', 'required');
        $this->form_validation->set_rules('rt', 'Rt', 'required|integer');
        $this->form_validation->set_rules('rw', 'Rw', 'required|integer');
        if ($this->form_validation->run() == true)
        {
            $insert = $this->kampung_model->insert(array(
                'kampung' => $_POST['kampung'],
                'rt' => $_POST['rt'],
                'rw' => $_POST['rw']
            ));
            if ($insert) {
                $this->session->set_flashdata('message', "<p class='alert alert-success' >Penambahan Data Berhasil <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('kampung', 'refresh');
            } else {
                $this->session->set_flashdata('message', "<p class='alert alert-danger' >Penambahan Data Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('', 'refresh');
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
        if ($this->kampung_model->delete($id)) {
                $this->session->set_flashdata('message', "<p class='alert alert-success' >Hapus Data Berhasil <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('kampung', 'refresh');
            } else {
                $this->session->set_flashdata('message', "<p class='alert alert-danger' >Hapus Data Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('', 'refresh');
            }
        
    }
    function detail($id) {
        if (!is_numeric($id)) {
            $this->session->set_flashdata('message', "<p class='alert alert-danger' >Detail Data Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
            redirect('kampung', 'refresh');
        }
        $this->form_validation->set_rules('kampung', 'Kampung', 'required');
        $this->form_validation->set_rules('rt', 'Rt', 'required|integer');
        $this->form_validation->set_rules('rw', 'Rw', 'required|integer');
        if ($this->form_validation->run() == true)
        {
            //var_dump($_POST['id']);
            //exit();
            $insert = $this->kampung_model->update($_POST['id'], array(
                'kampung' => $_POST['kampung'],
				'rt' => $_POST['rt'],
                'rw' => $_POST['rw']
            ));
            if ($insert) {
                $this->session->set_flashdata('message', "<p class='alert alert-success' >Update Data Berhasil <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('kampung', 'refresh');
            } else {
                $this->session->set_flashdata('message', "<p class='alert alert-danger' >Update Data Gagal <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button></p>");
                redirect('', 'refresh');
            }
            
        }
        else 
        {
            $data = $this->kampung_model->get_kampung_by_id($id);
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
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}
