<?php

defined('BASEPATH') OR exit('No direct script access allowed');
        
class Purchase extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->controller = "purchase";
        $this->title = "Purchase";
        $this->comman_lib->isLogin();
        
        $this->tableName = "purchase_master";
        $this->PK = "id";
        $this->arrayField = array('id', 'customer_id', 'invoice_total', 'invoice_date', 'status');
        

    }

    public function index() {
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;

        $this->load->view('header', $data);
        $this->load->view($this->controller . '/index');
        $this->load->view('footer');
    }
    
    function view() {

        $dataTableColumns = array('id', 'customer_id', 'invoice_total', 'invoice_date', 'status');

        $arrResult = $this->Commonmodel->getListing($this->controller, $this->tableName, $this->PK, $this->arrayField, $dataTableColumns);
//        print_r($arrResult);
//        die();

        foreach ($arrResult['data'] as $key => $value) {
            $arrParentName = $this->Commonmodel->getByID('tbl_user', 'id', $arrResult['data'][$key]['0']);
            $arrResult['data'][$key]['0'] = $arrParentName->firstname;
        }
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
    
    public function add($id = '') {
        $arrData = array();
        $arrSubData = array();
        if ($id != '' && isset($id)) {
            $arrData = $this->Commonmodel->getByID($this->tableName, $this->PK, $id);
            $arrSubData = $this->Commonmodel->getRecords($this->tableName1, "*", array("invoice_id" => $arrData->id));
            $strFormMode = 'E';
            $strStatusCombo = $this->Commonmodel->getActiveInativeCombo('status', 'class=""', $arrData->status);
            $data['title'] = $this->title . ' edit';
            $data['arrSubData'] = $arrSubData;
            $data['customerData'] = $this->Commonmodel->getRecord('tbl_user', "*", array("id" => $arrData->customer_id));
        } else {
            $strFormMode = 'A';
            $strStatusCombo = $this->Commonmodel->getActiveInativeCombo('status');
            $data['title'] = $this->title . ' add';
            $data['customerData'] = $this->Commonmodel->getRecord('tbl_user', 'id,firstname');
            $data['arrSubData'] = $arrSubData;
        }

        $data['strStatusCombo'] = $strStatusCombo;
        $data['arrData'] = $arrData;

        $data['formMode'] = $strFormMode;
        $data['controller'] = $this->controller;
        
        
        $this->load->view('header', $data);
        $this->load->view($this->controller . '/add', $data);
        $this->load->view('footer');
    }
    
}
