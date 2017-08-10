<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ledger extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->header = "header";
        $this->controller = "ledger";
        $this->footer = "footer";
        $this->title = "Ledger";
//        $this->comman_lib->isLogin();
        
        $this->tableName = "transaction_master";
        $this->PK = "id";
        $this->arrayField = array('id', 'action', 'user_id', 'order_id', 'date', 'type', 'check_neft', 'journal', 'amount', 'balance', 'status');
        
    }

    public function index() {
        
        $data['title'] =   $this->title;        
        $data['controller'] = $this->controller;
        
        $this->load->view($this->header, $data);
        $this->load->view($this->controller.'/index');
        $this->load->view($this->footer);
    }
    
    function view() {

        $dataTableColumns = array('id', 'action', 'user_id', 'order_id', 'date', 'type', 'check_neft', 'journal', 'amount', 'balance', 'status');
        $arrResult = $this->Commonmodel->getListing($this->controller, $this->tableName, $this->PK, $this->arrayField, $dataTableColumns);

        foreach ($arrResult['data'] as $key => $value) {
            $arrParentName = $this->Commonmodel->getByID('tbl_user', 'id', $arrResult['data'][$key]['1']);
            $arrResult['data'][$key]['1'] = $arrParentName->firstname.' '.$arrParentName->lastname;
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
    
    public function add($id = '' ) {
        
        $arrData = array();
        
        if ($id != '' && isset($id)) {
            $arrData = $this->Commonmodel->getByID($this->tableName, $this->PK, $id);
            $strFormMode = 'E';
            $strStatusCombo = $this->Commonmodel->getActiveInativeCombo('status', 'class=""', $arrData->status);
            $data['title'] = $this->title.' edit';
            $data['customerData'] = $this->Commonmodel->getRecord('tbl_user', "*", array("id" => $arrData->user_id));
        } else {
            $strFormMode = 'A';
            $strStatusCombo = $this->Commonmodel->getActiveInativeCombo('status');
            $data['title'] = $this->title.' add';
        }
        $data['memberData'] = $this->Commonmodel->getRecord('tbl_user', "*", array("type" => 'member'));
        $data['strStatusCombo'] = $strStatusCombo;
        $data['arrData'] = $arrData;
        
        $data['formMode'] = $strFormMode;
        $data['controller'] = $this->controller;
        
        $this->load->view($this->header, $data);
        $this->load->view($this->controller.'/add', $data);
        $this->load->view($this->footer);
    }
    
    public function save() {
        $id = $_POST['id'];
        if (isset($_POST['action'])){
            if ($id == '') {
                $arrData = array(
                "action" => $_POST['action'],
                "user_id" => $_POST['user_id'],
                "date" => date('Y-m-d H:i:s'),
                "type" => $_POST['type'],
                "check_neft" => $_POST["check_neft"],
                "journal" => $_POST['journal'],
                "amount" => $_POST['amount'],
                "balance" => $_POST['amount'],
                "status" => $_POST['status'],
                "created_date" => date('Y-m-d H:i:s')
                );
                $id = $this->Commonmodel->insert($this->tableName, $arrData);
                
                if($id > 0)
                {
                    //ledger Balance Update
                    $this->balanceUpdate($id, $_POST['amount'],$_POST['user_id'], $_POST['action']);
                }
            } else {
                //ledger Balance Update
                $ledgerInfo = $this->Commonmodel->getRecord($this->tableName, "*", array('id' => $id));
                
                if(!empty($ledgerInfo)){
                    $this->balanceUpdate($id, $ledgerInfo[0]['amount'],$_POST['user_id'], 'Debit');
                }
                
                $arrData = array(
                "action" => $_POST['action'],
                "user_id" => $_POST['user_id'],
                "type" => $_POST['type'],
                "check_neft" => $_POST["check_neft"],
                "journal" => $_POST['journal'],
                "amount" => $_POST['amount'],
                "status" => $_POST['status'],
                "created_date" => date('Y-m-d H:i:s')
                );
                $strWhere = ' id=' . $id;
                $this->Commonmodel->update($this->tableName, $arrData, $strWhere);
                
                //ledger Balance Update
                $this->balanceUpdate($id, $_POST['amount'],$_POST['user_id'], $_POST['action']);
                
            }
            redirect($this->controller);
        }   
    }

    function delete($id) {

        if ($id != '') {
            $arrData = array('status'=> 'Inactive');
            $strWhere = ' id=' . $id;
            $this->Commonmodel->update($this->tableName, $arrData, $strWhere);
        }
        redirect(base_url() . $this->controller);
    }
    
    public function balanceUpdate($id, $amount, $userID, $mode)
    {
        if($mode == 'Credit'){
            // Member Balance Update
            $memberInfo = $this->Commonmodel->getRecord('tbl_user', "*", array('id' => $userID));
            
            $arrLedgerData = array(
                "balance" => round($memberInfo[0]['price'] + $amount, 2)
            );
            $strLedgerWhere = ' id=' . $id;            
            $this->Commonmodel->update($this->tableName, $arrLedgerData, $strLedgerWhere);
            
            if (!empty($memberInfo)) {
                $memberEmail = $memberInfo[0]['email'];
                $arrData = array(
                    "price" => round($memberInfo[0]['price'] + $amount, 2)
                );
                $strWhere = ' id=' . $userID;
                $this->Commonmodel->update('tbl_user', $arrData, $strWhere);
            }
        }else{
            
            // Member Balance Update
            $memberInfo = $this->Commonmodel->getRecord('tbl_user', "*", array('id' => $userID));
            
            $arrLedgerData = array(
                "balance" => round($memberInfo[0]['price'] - $amount, 2)
            );
            
            $strLedgerWhere = ' id=' . $id;
            $this->Commonmodel->update($this->tableName, $arrLedgerData, $strLedgerWhere);
            
            if (!empty($memberInfo)) {
                $memberEmail = $memberInfo[0]['email'];
                $arrData = array(
                    "price" => round($memberInfo[0]['price'] - $amount, 2)
                );
                $strWhere = ' id=' . $userID;
                $this->Commonmodel->update('tbl_user', $arrData, $strWhere);
            }
        }
        
        
    }

}
