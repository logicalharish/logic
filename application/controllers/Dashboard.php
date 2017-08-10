<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->controller = "dashboard";
        $this->title = "Dashboard";
//        $this->comman_lib->isLogin();
    }

    public function index() {
        
        $data['title'] =   $this->title;
        
        $this->load->view('header', $data);
        $this->load->view($this->controller);
        $this->load->view('footer');
    }


}
