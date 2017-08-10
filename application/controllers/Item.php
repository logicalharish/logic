<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->controller = "item";
        $this->title = "Items";
//        $this->comman_lib->isLogin();
        
        $this->tableName = "product_master";
        $this->PK = "id";
        $this->arrayField = array('id', 'product_code', 'description', 'unit','status');
        $this->units = array('KG'=>'KG', 'PCS'=>'PCS');
    }

    public function index() {
        
        $data['title'] =   $this->title;
        $data['controller'] = $this->controller;
        
        $this->load->view('header', $data);
        $this->load->view($this->controller.'/index');
        $this->load->view('footer');
    }
    
    function view() {

        $dataTableColumns = array('id', 'product_code', 'description', 'unit', 'status');
        
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
        $data['units'] = $this->units;
        $data['formMode'] = $strFormMode;
        $data['controller'] = $this->controller;
        
        $this->load->view('header', $data);
        $this->load->view($this->controller.'/add', $data);
        $this->load->view('footer');
    }
    
    public function save() {
        $id = $_POST['id'];
        
        if ($id == '') {
            $arrData = array(
            "product_code" => $_POST['product_code'],
            "description" => $_POST['description'],
            "unit" => $_POST['unit'],
            "status" => $_POST['status']
            );
            $id = $this->Commonmodel->insert($this->tableName, $arrData);
        } else {
           $arrData = array(
            "product_code" => $_POST['product_code'],
            "description" => $_POST['description'],
            "unit" => $_POST['unit'],
            "status" => $_POST['status'],
            );
            $strWhere = ' id=' . $id;
            $this->Commonmodel->update($this->tableName, $arrData, $strWhere);
        }
        redirect($this->controller);
    }

    function delete($id) {

        if ($id != '') {
            $this->Commonmodel->deleteRecord($this->tableName, $this->PK, $id);
        }
        redirect(base_url() . $this->controller);
    }

    function searchItem()
    {
        $keyword = $this->input->post('term');
        $serachData = $this->Commonmodel->getSerachData('product_master', 'description', $keyword);
        echo json_encode($serachData);
    }
    
    function checkItemCode() {
        $code = $_POST['code'];
        $serachData = $this->Commonmodel->getSerachData('product_master', 'product_code', $code);
        if($serachData)
        {
            echo json_encode(array("action"=>1, "data" => $serachData));
        }else{
            echo json_encode(array("action"=>0));
        }
    }
}
