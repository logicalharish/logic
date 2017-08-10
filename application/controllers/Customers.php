<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->controller = "customers";
        $this->title = "Customers";
//        $this->comman_lib->isLogin();
        
        $this->tableName = "tbl_user";
        $this->PK = "id";
        $this->arrayField = array('id', 'type', 'firstname', 'lastname', 'phone', 'phone2', 'email', 'website',  'status');
        $this->type = array('admin'=>'Admin', 'member'=>'Member');
    }

    public function index() {
        $data['controller'] = $this->controller;
        $data['title'] =   $this->title;
        $data['customerlist'] = $this->Commonmodel->userlist();
        
        $this->load->view('header', $data);
        $this->load->view($this->controller.'/index', $data);
        $this->load->view('footer');
    }
    
    function view() {

        $dataTableColumns = array('id', 'type',  'firstname', 'lastname', 'phone', 'phone2', 'email', 'website', 'status');
        
        $arrResult = $this->Commonmodel->getListing($this->controller, $this->tableName, $this->PK, $this->arrayField, $dataTableColumns);
//        print_r($arrResult);
//        die();

        $results = array(
            "draw" => $arrResult['draw'],
            "recordsTotal" => $arrResult['totalRecords'],
            "recordsFiltered" => $arrResult['totalRecords'],
            "data" => $arrResult['data']
        );

        echo json_encode($results);
    }
    
    public function add($id = '' ) {
        
        $arrData = array();
        
        if ($id != '' && isset($id)) {
            $arrData = $this->Commonmodel->getByID($this->tableName, $this->PK, $id);
            $strFormMode = 'E';
            $strStatusCombo = $this->Commonmodel->getActiveInativeCombo('status', 'class=""', $arrData->status);
            $data['title'] = $this->title.' edit';
        } else {
            $strFormMode = 'A';
            $strStatusCombo = $this->Commonmodel->getActiveInativeCombo('status');
            $data['title'] = $this->title.' add';
        }

        $data['strStatusCombo'] = $strStatusCombo;
        $data['arrData'] = $arrData;
        
        $data['formMode'] = $strFormMode;
        $data['controller'] = $this->controller;
        
        $data['userType'] = $this->type;
        
        $this->load->view('header', $data);
        $this->load->view($this->controller.'/add', $data);
        $this->load->view('footer');
    }
    
    public function save() {
        $id = $_POST['id'];
        if (isset($_POST['firstname'])){
            if ($id == '') {
                $arrData = array(
                "type" => $_POST['type'],
                "firstname" => $_POST['firstname'],
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
                "status" => $_POST['status'],
                "created_date" => date('Y-m-d H:i:s')
                );
                $id = $this->Commonmodel->insert($this->tableName, $arrData);
            } else {
               $arrData = array(
                "type" => $_POST['type'],
                "firstname" => $_POST['firstname'],
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
                "status" => $_POST['status'],
                "created_date" => date('Y-m-d H:i:s')
                );
                $strWhere = ' id=' . $id;
                $this->Commonmodel->update($this->tableName, $arrData, $strWhere);
            }
            redirect($this->controller);
        }   
    }

    function delete($id) {

        if ($id != '') {
            $this->Commonmodel->deleteRecord($this->tableName, $this->PK, $id);
        }
        redirect(base_url() . $this->controller);
    }
    
    function getCustomerInformation()
    {
        $id = $_POST['custID'];
        if ($id != '') {
            $customerData = $this->Commonmodel->userlist($id);
            echo json_encode($customerData);
        }
    }
}
