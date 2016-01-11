<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * ***************************************************************
 * Version : 0.1 
 * Date : 30 Oktober 2015
 * ***************************************************************
 */

/**
 * Description of Dashboard
 *
 * @author Dede
 */
class Dashboard extends MX_Controller{
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
    }    
    
    public function index() {        

        $this->load->view('design/header');
        $this->load->view('dashboard/admin');
        $this->load->view('design/footer');
    }
}
