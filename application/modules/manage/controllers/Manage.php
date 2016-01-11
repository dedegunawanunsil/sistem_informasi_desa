<?php if ( ! defined('BASEPATH')) exit('No direct script auth allowed');

/*
 * ***************************************************************
 * Version : 0.1 
 * Date : 06 November 2015
 *        07 November 2015
 * ***************************************************************
 */

/**
 * 
 *
 * @author Dede
 */
class Manage extends CI_Controller{
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
        
        $this->load->helper('form');
        $this->load->library('form_validation', 'config');
    }    
    
    public function index() {        
        redirect('manage/profil');
    }
    function profil() {
        $this->load->view('design/header', array(
            'main_title' => 'Profil ',
            'sub_title' => ' '
        ));
        $this->load->view('auth/profil', array(
            'csrf' => $this->_get_csrf_nonce()
        ));
        $this->load->view('design/footer');
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
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    // edit a user
    function update_profil()
    {
        $user = $_SESSION['user'];
        $id = $user->id;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
        $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

        if (isset($_POST) && !empty($_POST))
        {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>Non Valid ID & CSRF Token</div>');
                redirect('manage/profil');
            }

            if ($this->form_validation->run() === TRUE)
            {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name'  => $this->input->post('last_name'),
                    'company'    => $this->input->post('company'),
                    'phone'      => $this->input->post('phone'),
                );
                if($this->ion_auth->update($user->id, $data))
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->ion_auth->messages().'</div>' );

                }
                else
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message',  '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->ion_auth->errors().'</div>'  );
                }
                redirect('manage/profil');
            }
            else {
                $this->session->set_flashdata('message', validation_errors('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>','</div>'));
                redirect('manage/profil');
            }
        }
    }
    // edit a user
    function update_password()
    {
        $user = $_SESSION['user'];
        $id = $user->id;
        if (isset($_POST) && !empty($_POST))
        {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>Non Valid ID & CSRF Token</div>');
                redirect('manage/profil');
            }
            $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

            if ($this->form_validation->run() === TRUE)
            {
                
                $data['password'] = $this->input->post('password');
                // check to see if we are updating the user
                if($this->ion_auth->update($user->id, $data))
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->ion_auth->messages().'</div>' );

                }
                else
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message',  '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->ion_auth->errors().'</div>'  );
                }
                redirect('manage/profil');
            }
            else {
                $this->session->set_flashdata('message', validation_errors('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>','</div>'));
                redirect('manage/profil');
            }
        }
    }
    function change_foto_profil() {
        $config['upload_path']          = './assets/foto/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 200;
        $config['max_width']            = 3000;
        $config['max_height']           = 2000;
        $config['overwrite']            = true;
        $user = $_SESSION['user'];
        $id = $user->id;
        $this->load->library('upload', $config);
        function have_file_upload() {
            if (isset($_FILES['userfile'])) {
                return true;
            }
            else {
                return false;
            }
        }
        $this->form_validation->set_rules('userfile', 'User File', 'have_file_upload');
        $this->form_validation->set_rules('id', 'ID', 'required');
        if (isset($_POST) && !empty($_POST))
        {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>Non Valid ID & CSRF Token</div>');
                redirect('manage/profil');
            }

            if ($this->form_validation->run() === TRUE)
            {
                if (!$this->upload->do_upload())
                {
                    $this->session->set_flashdata('message',  '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->upload->display_errors().'</div>'  );
                }
                else
                {
                    $data = $this->upload->data();
                    if ($data && is_array($data)) {
                        $assets_file = FCPATH."assets/foto/";
                        if (file_exists($assets_file.$user->id.".jpg")) {
                          unlink($assets_file.$user->id.".jpg");
                        } else if (file_exists($assets_file.$user->id.".png") ) {
                          unlink($assets_file.$user->id.".png");
                        }
                        rename($data['full_path'], FCPATH.'assets/foto/'.$user->id.$data['file_ext']);
                    }
                    $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>Pengubahan Foto Berhasil</div>' );

                }
                redirect('manage/profil');
            }
            else {
                $this->session->set_flashdata('message', validation_errors('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>','</div>'));
                redirect('manage/profil');
            }
        }

    }
    function list_all_user() {
        $this->_sure_admin();
        $data['data'] = $this->ion_auth->users()->result();
        foreach ($data['data'] as $k => $user)
        {
            $data['data'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }
        $this->load->view('design/header');
        $this->load->view('auth/all_user', $data);
        $this->load->view('design/footer');

    }
    function add_user() {
        $this->_sure_admin();
        // validate form input
        $tables = $this->config->item('tables','ion_auth');
        $this->form_validation->set_rules('first_name', 'Nama Depan', 'required');
        $this->form_validation->set_rules('last_name', 'Nama Belakang', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');
        $this->form_validation->set_rules('company', 'Perusahaan / Sekolah / Institusi', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required');
        if ($this->form_validation->run() === TRUE) {
            if ($this->_valid_csrf_nonce()) {
                $email    = strtolower($this->input->post('email'));
                $password = $this->input->post('password');
                $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name'  => $this->input->post('last_name'),
                    'company'    => $this->input->post('company'),
                    'phone'      => $this->input->post('phone'),
                );
                if ($this->ion_auth->register($identity, $password, $email, $additional_data)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>Penambahan User Baru Berhasil</div>');
                    redirect('manage/list_all_user');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>Penambahan User Baru Gagal</div>');
                }
            }
            else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>CSRF not Valid.</div>');
            }
        } 
        $this->load->view('design/header');
        $this->load->view('auth/add_user', array(
            'csrf' => $this->_get_csrf_nonce(),
            'message' => (validation_errors()) ? validation_errors('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>','</div>') : $this->session->flashdata('message')
        ));
        $this->load->view('design/footer');
        
    }
    function edit_user($id) {
        $this->_sure_admin();
        if (!$id) {
            redirect('manage/list_all_user');
        }
        // validate form input
        $tables = $this->config->item('tables','ion_auth');
        $this->form_validation->set_rules('first_name', 'Nama Depan', 'required');
        $this->form_validation->set_rules('last_name', 'Nama Belakang', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');
        $this->form_validation->set_rules('company', 'Perusahaan / Sekolah / Institusi', 'trim');
        if ($this->input->post('password'))
        {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required');
        }
        if ($this->form_validation->run() === TRUE) {
            if ($this->_valid_csrf_nonce()) {
                //$email    = strtolower($this->input->post('email'));
                $password = $this->input->post('password');
                $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name'  => $this->input->post('last_name'),
                    'company'    => $this->input->post('company'),
                    'phone'      => $this->input->post('phone'),
                    'email'      => strtolower($this->input->post('email')),

                );
                // update the password if it was posted
                if ($this->input->post('password'))
                {
                    $data['password'] = $this->input->post('password');
                }
                if ($this->ion_auth->update($user->id, $additional_data)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>Update User Berhasil</div>');
                    redirect('manage/list_all_user');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>Update User Gagal</div>');
                }
            }
            else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>CSRF not Valid.</div>');
            }
            header("Refresh:0");
        } 
        else 
        {
            $this->load->view('design/header');
            $this->load->view('auth/edit_user', array(
                'csrf' => $this->_get_csrf_nonce(),
                'user' => $this->ion_auth->user($id)->row(),
                'message' => $this->session->flashdata('message')
            ));
            $this->load->view('design/footer');
        }
    }
    function _sure_admin() {
        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>You are not Administrator, sorry.</div>');
            redirect('/');
        }
    }
    function hapus_user($id) {
        $this->_sure_admin();
        if (!$id) {
            redirect('manage/list_all_user');
        }
        if ($this->ion_auth->is_admin($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>This User cannot deleted.</div>');
        }
        elseif ($this->ion_auth->delete_user($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>Success delete user.</div>');
            $assets_file = FCPATH."assets/foto/";
            if (file_exists($assets_file.$id.".jpg")) {
                unlink($assets_file.$id.".jpg");
            } else if (file_exists($assets_file.$id.".png")) {
                unlink($assets_file.$id.".png");
            }
            
        }
        redirect('manage/list_all_user');
    }
    function deactivate($id) {
        $this->_sure_admin();
        if (!$id) {
            redirect('manage/list_all_user');
        }
        if ($this->ion_auth->is_admin($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>This User cannot be deactivated.</div>');
        }
        elseif ($this->ion_auth->deactivate($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>Success Deactivate user.</div>');
        }
        redirect('manage/list_all_user');
    }
    function activate($id) {
        $this->_sure_admin();
        if (!$id) {
            redirect('manage/list_all_user');
        }
        if ($this->ion_auth->activate($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>Success Activate user.</div>');
        }
        redirect('manage/list_all_user');
    }
    function detail_group($id) {
        $this->_sure_admin();
        if (!$id) {
            redirect('manage/list_all_user');
        }
        $group = $this->ion_auth->group($id)->row();
        $this->load->view('design/header');
        $this->load->view('auth/detail_group', array(
            'group' => $group 
        ));
        $this->load->view('design/footer');

    }
}
