<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();


        $this->controller = "login";
        $this->title = "Login";
    }

    public function index() {
        $this->load->view('login');
    }

    function signup() {

        $strUsername = $_REQUEST['username'];
        $strPassword = $_REQUEST['password'];
        $arrLogin = $this->Commonmodel->checkLogin($strUsername, md5($strPassword));
        
        if (count($arrLogin) > 0 && $arrLogin['firstname'] != '') {

            $this->session->set_userdata('user', $arrLogin);
            $this->session->set_userdata('AdminId', $arrLogin['aid']);
            
            $url = site_url() . 'dashboard';
            redirect($url);
        } else {

            $url = site_url();
            redirect($url);
        }
    }

    function logout() {
        $this->session->unset_userdata('user');
        session_destroy();
        $url = site_url();
        redirect($url);
    }

}
