<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->header = "header";
        $this->controller = "setting";
        $this->footer = "footer";
        $this->title = "Setting";
//        $this->comman_lib->isLogin();
        
        $this->tableName = "tbl_user";
        $this->PK = "id";
        $this->userID = '1';
    }

    public function index() {
        
        $data['controller'] = $this->controller;
        $data['title'] =   $this->title;
        $data['memberlist'] = $this->Commonmodel->memberlist();
        $arrData = $this->Commonmodel->getByID($this->tableName, $this->PK, $this->userID);
        $strStatusCombo = $this->Commonmodel->getActiveInativeCombo('status', 'class=""', $arrData->status);
        $data['strStatusCombo'] = $strStatusCombo;
        $data['arrData'] = $arrData;
        
        $this->load->view( $this->header, $data);
        $this->load->view($this->controller, $data);
        $this->load->view($this->footer);
    }
    
    public function save() {
        $id = $this->userID;
        if (isset($_POST['firstname'])){
               $arrData = array(
                "firstname" => $_POST['firstname'],
                "lastname" => $_POST['lastname'],
                "email" => $_POST['email'],
                "phone" => $_POST['phone'],
                "phone2" => $_POST['phone2'],
                "address" => $_POST["address"],
                "city" => $_POST['city'],
                "pincode" => $_POST['pincode'],
                "website" => $_POST['website'],                
                "state" => $_POST['state'],
                "tin_no" => $_POST['tin_no'],
                "gstn" => $_POST['gstn'],
                "pan" => $_POST['pan'],
                "vat_tin" => $_POST['vat_tin'],
                "cst" => $_POST['cst'],
                "cin" => $_POST['cin'],
                "excise_number" => $_POST["excise_number"],
                "service_tax_number" => $_POST["service_tax_number"],
                "lbt_number" => $_POST["lbt_number"],
                "price" => $_POST['price'],
                "status" => $_POST['status'],
                "created_date" => date('Y-m-d H:i:s')
                );
                $strWhere = ' id=' . $id;
                $this->Commonmodel->update($this->tableName, $arrData, $strWhere);
            
            redirect($this->controller);
        }   
    }


}
