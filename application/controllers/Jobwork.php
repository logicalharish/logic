<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'third_party/tcpdf/tcpdf.php';
        
class Jobwork extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->controller = "jobwork";
        $this->title = "Jobwork";
//        $this->comman_lib->isLogin();

        $this->tableName = "jobwork_master";
        $this->PK = "id";
        $this->arrayField = array('id', 'product_id', 'customer_id', 'job_desc', 'unit_type', 'unit', 'finished_product_id', 'finished_unit_type', 'finished_unit', 'updated', 'status');
        // $this->tableName1 = "invoice_details";
        
        // $this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	
    }

    public function index() {


        $data['title'] = $this->title;
        $data['controller'] = $this->controller;

        $data['strStatusCombo'] = $this->Commonmodel->getProductionStatusCombo('status');
        $data['strUnitTypeCombo'] = $this->Commonmodel->getUnitTypeCombo('unit_type');
        $data['strFinishedUnitTypeCombo'] = $this->Commonmodel->getUnitTypeCombo('finished_unit_type');
        $data['productData'] = $this->Commonmodel->getRecord('product_master', 'id,name');
        $data['customerData'] = $this->Commonmodel->getRecord('tbl_user', 'id,firstname');

        $this->load->view('header', $data);
        $this->load->view($this->controller . '/index', $data);
        $this->load->view('footer');
    }

    function view() {

        $dataTableColumns = $this->arrayField;

        $arrResult = $this->Commonmodel->getListingForJobWork($this->controller, $this->tableName, $this->PK, $this->arrayField, $dataTableColumns);
       // print_r($arrResult);
       // die();

       //  foreach ($arrResult['data'] as $key => $value) {
       //      $arrParentName = $this->Commonmodel->getByID('tbl_user', 'id', $arrResult['data'][$key]['0']);
       //      $arrResult['data'][$key]['0'] = $arrParentName->firstname;
       //  }
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
            $strFormMode = 'E';
            $strStatusCombo = $this->Commonmodel->getProductionStatusCombo('status', 'class=""', $arrData->status);
            $data['title'] = $this->title . ' edit';
            $data['productData'] = $this->Commonmodel->getRecord('product_master', "*", array("id" => $arrData->product_id));
            $data['customerData'] = $this->Commonmodel->getRecord('tbl_user', "*", array("id" => $arrData->customer_id));
        } else {
            $strFormMode = 'A';
            $strStatusCombo = $this->Commonmodel->getProductionStatusCombo('status');
            $data['title'] = $this->title . ' add';
            $data['productData'] = $this->Commonmodel->getRecord('product_master', 'id,name');
            $data['customerData'] = $this->Commonmodel->getRecord('tbl_user', 'id,firstname');
        }

        $data['strStatusCombo'] = $strStatusCombo;
        $data['arrData'] = $arrData;

        $data['formMode'] = $strFormMode;
        $data['controller'] = $this->controller;
        
        
        $this->load->view('header', $data);
        $this->load->view($this->controller . '/add', $data);
        $this->load->view('footer');
    }

    public function getEditData($id = '') {
        $arrData = array();
        if ($id != '' && isset($id)) {
            $arrData = $this->Commonmodel->getByID($this->tableName, $this->PK, $id);
        }
        echo json_encode($arrData);
    }

    public function save() {
       // echo "<pre>";
       // print_r($_POST);
       // die;
        if (isset($_POST)) {
            $id = $_POST['form_action_id'];
            if ($id == '') {
                $arrData = array(
                    "customer_id" => $_POST['customer'],
                    "product_id" => $_POST['product'],
                    "job_desc" => $_POST['job_desc'],
                    "unit" => $_POST['unit'],
                    "unit_type" => $_POST["unit_type"],
                    "finished_product_id" => $_POST['finished_product'],
                    "finished_unit" => $_POST['finished_unit'],
                    "finished_unit_type" => $_POST["finished_unit_type"],
                    "status" => $_POST['status'],
                    "created" => date('Y-m-d H:i:s'),
                    "updated" => date('Y-m-d H:i:s')
                );
                $insertId = $this->Commonmodel->insert($this->tableName, $arrData);
            } else {
                $arrData = array(
                    "customer_id" => $_POST['customer'],
                    "product_id" => $_POST['product'],
                    "job_desc" => $_POST['job_desc'],
                    "unit" => $_POST['unit'],
                    "unit_type" => $_POST["unit_type"],
                    "finished_product_id" => $_POST['finished_product'],
                    "finished_unit" => $_POST['finished_unit'],
                    "finished_unit_type" => $_POST["finished_unit_type"],
                    "status" => $_POST['status'],
                    "updated" => date('Y-m-d H:i:s')
                );
                $strWhere = ' id=' . $id;
                $this->Commonmodel->update($this->tableName, $arrData, $strWhere);
            }
            redirect($this->controller);
        } else {
            redirect($this->controller);
        }
    }

    function updateStatus($id, $status = 0){
        echo $status;
        if ($id != '') {
            $arrData = array(
                "status" => $status,
                "updated" => date('Y-m-d H:i:s')
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
    
    public function printInvoice($invoiceID) {
        
		$data['invoiceID'] = $invoiceID;
        $data['adminData'] = $this->Commonmodel->getRecord('tbl_user', "*", array('type' => 'Admin'));
        
        $arrInvoice = $this->Commonmodel->getRecord('invoice_master', "*", array('id' => $invoiceID));
		
		$data['invoiceMasterData'] = $arrInvoice;
        
        $data['memberData'] = $this->Commonmodel->getRecord('tbl_user', "*", array('id' => $arrInvoice[0]['customer_id']));
		
        $data['invoiceDetailsData'] = $this->Commonmodel->getRecord('invoice_details', "*", array('invoice_id' => $invoiceID));
        
        $data['pdf'] = $this->pdf;
        $this->load->view($this->controller . '/invoice', $data);
    }
    
    function convert_number($number) {
		if (($number < 0) || ($number > 999999999)) {
			throw new Exception("Number is out of range");
		}

		$Gn = floor($number / 1000000);
		/* Millions (giga) */
		$number -= $Gn * 1000000;
		$kn = floor($number / 1000);
		/* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);
		/* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);
		/* Tens (deca) */
		$n = $number % 10;
		/* Ones */

		$res = "";

		if ($Gn) {
            $res .= $this->convert_number($Gn) . "Million";
		}

		if ($kn) {
            $res .= (empty($res) ? "" : " ") . $this->convert_number($kn) . " Thousand";
		}

		if ($Hn) {
            $res .= (empty($res) ? "" : " ") . $this->convert_number($Hn) . " Hundred";
		}

		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");

		if ($Dn || $n) {
			if (!empty($res)) {
				$res .= " and ";
			}

			if ($Dn < 2) {
				$res .= $ones[$Dn * 10 + $n];
			} else {
				$res .= $tens[$Dn];

				if ($n) {
					$res .= "-" . $ones[$n];
				}
			}
		}

		if (empty($res)) {
			$res = "zero";
		}

		return $res;
	}
        
    function deleteInvoiceDetails($id) {

        if ($id != '') {
            $this->Commonmodel->deleteRecord($this->tableName1, $this->PK, $id);
        }
    }
    
    public function report() {
        
        
        $arrData = array();
        
        $where = array('type' => 'member', 'status' => 'Active');
        $data['memberData'] = $this->Commonmodel->getRecord('tbl_user','id,firstname,lastname', $where); 
        
        $customerId ='99999999';
        $startDate = $this->firstOfMonth();
        $endDate = $this->lastOfMonth(); 
        $startNumber  = '';
        $endNumber = '';
        $grandTotal = 0;
        
        if(isset($_POST) && !empty($_POST))
        {
            $customerId = ($_POST['customerId']) ? $_POST['customerId'] : '';
            
            $startDate = ($_POST['startdate']) ? $_POST['startdate'] : '';
            $endDate = ($_POST['enddate']) ? $_POST['enddate'] : '';
            $startNumber = ($_POST['startNumber']) ? $_POST['startNumber'] : '';
            $endNumber = ($_POST['endNumber']) ? $_POST['endNumber'] : '';
        }  
        $query = '';
        
        if($customerId != '99999999')
        {
            $query.= " and customer_id = $customerId ";
        }
        
        if($startNumber != '' && $endNumber != '')
        {
            $query .= "and (id BETWEEN '$startNumber' and '$endNumber')";
        }
        
        $qry = "select * from invoice_master WHERE (DATE(invoice_date) BETWEEN '$startDate' and '$endDate')".$query; 
        $jobDetailsData = $this->Commonmodel->customQuery($qry);
        
        foreach ($jobDetailsData as $key => $data) {
            $grandTotal += $data['invoice_total'];
            $where = array('id' => $data['customer_id']);
            $customerData = $this->Commonmodel->getRecord('tbl_user','*', $where); 
            
            $arrData[$key]['invoice_number'] = $data['invoice_number'];
            $arrData[$key]['invoice_date'] = date('Y-m-d',  strtotime($data['invoice_date'])) ;
            $arrData[$key]['customer'] = $customerData[0]['firstname'].' '.$customerData[0]['lastname'];
            $arrData[$key]['pan'] = $customerData[0]['pan'];
            $arrData[$key]['tin_no'] = $customerData[0]['tin_no'];
            $arrData[$key]['total'] = $data['invoice_total'];
            
            
        }
        
        $data['title'] = $this->title;
        $data['controller'] = $this->controller;
        $data['arrData'] = $arrData;        
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $data['startNumber'] = $startNumber;
        $data['endNumber'] = $endNumber;
        $data['customerId'] =   $customerId;
        $data['grandTotal'] = $grandTotal;
       
//        print_r($data);
        
        
        $this->load->view('header', $data);
        $this->load->view($this->controller . '/report',$data);
        $this->load->view('footer');
    }
    
    function firstOfMonth() {
        return date("Y-m-d", strtotime(date('m').'/01/'.date('Y').' 00:00:00'));
    }

    function lastOfMonth() {
        return date("Y-m-d", strtotime('-1 second',strtotime('+1 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00'))));
    }
    

}
