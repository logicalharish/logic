<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'third_party/tcpdf/tcpdf.php';
        
class Purchase extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->controller = "purchase";
        $this->title = "Purchase";
//        $this->comman_lib->isLogin();

        $this->tableName = "purchase_master";
        $this->PK = "id";
        $this->arrayField = array('id', 'customer_id', 'purchase_total', 'purchase_date', 'status');
        $this->tableName1 = "purchase_details";
        
        $this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	
    }

    public function index() {


        $data['title'] = $this->title;
        $data['controller'] = $this->controller;

        $this->load->view('header', $data);
        $this->load->view($this->controller . '/index');
        $this->load->view('footer');
    }

    function view() {

        $dataTableColumns = array('id', 'customer_id', 'purchase_total', 'purchase_date', 'status');

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
            $arrSubData = $this->Commonmodel->getRecords($this->tableName1, "*", array("purchase_id" => $arrData->id));
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

    public function save() {
//        echo "<pre>";
//        print_r($_POST);
        if (isset($_POST)) {
        $id = $_POST['id'];
        if ($id == '') {
            $arrData = array(
                "customer_id" => $_POST['customers'],
                "purchase_number" => $_POST['purchase_number'],
                "freight_charges" => $_POST['freight_charges'],
                "loading_packeges_charges" => $_POST['loading_packeges_charges'],
                "insurance_charges" => $_POST["insurance_charges"],
                "other_charges" => $_POST['other_charges'],
                "total_words" => $_POST['total_words'],
                "purchase_total" => $_POST['purchase_total'],
                "po_number" => $_POST['po_number'],
                "chalan_no" => $_POST['chalan_no'],
                "chalan_date" => date_format(date_create($_POST['chalan_date']), 'Y-m-d H:i:s'),
                "po_date" => date_format(date_create($_POST["po_date"]), 'Y-m-d H:i:s'),
                "purchase_date" => date_format(date_create($_POST["purchase_date"]), 'Y-m-d H:i:s'),
                "bill_book" => $_POST['bill_book'],
                "transport" => $_POST['transport'],
                "vehical_number" => $_POST['vehical_number'],
                "place_suply" => $_POST['place_suply'],
                "date_suply" => date_format(date_create($_POST['date_suply']), 'Y-m-d H:i:s'),
                "created_date" => date('Y-m-d H:i:s'),
                "created_by" => 1
            );
            $insertId = $this->Commonmodel->insert($this->tableName, $arrData);
            if ($insertId) {
                $description = $_POST['description'];
                for ($i = 0; $i <= count($description); $i++) {
                    if ($_POST['description'][$i] != "") {
                        
                        if($_POST['uom'][$i] == 'PC')
                        {
                            $qty = $_POST['qty'][$i];
                        }else{
                            $qty = $_POST['weight'][$i];
                        }
                        
                        
                        $arrProductData = array(
                            "purchase_id" => $insertId,
                            "product_code" => $_POST['description'][$i],
                            "hsn_code" => $_POST['hsn_code'][$i],
                            "qty" => $qty,
                            "uom" => $_POST['uom'][$i],
                            "rate" => $_POST['rate'][$i],
                            "total" => $_POST['total'][$i],
                            "discount" => $_POST['discount'][$i],
                            "taxable_value" => $_POST['taxable_value'][$i],
                            "CGST_rate" => $_POST['CGST_rate'][$i],
                            "CGST_amount" => $_POST['CGST_amount'][$i],
                            "SGST_rate" => $_POST['SGST_rate'][$i],
                            "SGST_amount" => $_POST['SGST_amount'][$i],
                            "IGST_rate" => $_POST['IGST_rate'][$i],
                            "IGST_amount" => $_POST['IGST_amount'][$i],
                            "final_amount" => $_POST['final_amount'][$i],
                        );
                        $insertDetailsid = $this->Commonmodel->insert($this->tableName1, $arrProductData);

                        //product stock manage
                        $this->productManage($insertDetailsid,$arrProductData,'insert');

                    }
                }
            }
        } else {
            $arrData = array(
                "customer_id" => $_POST['customers'],
                "purchase_number" => $_POST['purchase_number'],
                "freight_charges" => $_POST['freight_charges'],
                "loading_packeges_charges" => $_POST['loading_packeges_charges'],
                "insurance_charges" => $_POST["insurance_charges"],
                "other_charges" => $_POST['other_charges'],
                "total_words" => $_POST['total_words'],
                "purchase_total" => $_POST['purchase_total'],
                "po_number" => $_POST['po_number'],
                "chalan_no" => $_POST['chalan_no'],
                "chalan_date" => date_format(date_create($_POST['chalan_date']), 'Y-m-d H:i:s'),
                "po_date" => date_format(date_create($_POST["po_date"]), 'Y-m-d H:i:s'),
                "purchase_date" => date_format(date_create($_POST["purchase_date"]), 'Y-m-d H:i:s'),
                "bill_book" => $_POST['bill_book'],
                "transport" => $_POST['transport'],
                "vehical_number" => $_POST['vehical_number'],
                "place_suply" => $_POST['place_suply'],
                "date_suply" => date_format(date_create($_POST['date_suply']), 'Y-m-d H:i:s'),
                "modified_date" => date('Y-m-d H:i:s'),
                "modified_by" => 1
            );
            $strWhere = ' id=' . $id;
            $this->Commonmodel->update($this->tableName, $arrData, $strWhere);

            // updates details table
            $getInvoiceDetailsData = $this->Commonmodel->getRecordsArray($this->tableName1, "", array("purchase_id" => $id));
            if ($getInvoiceDetailsData) {
                //product stock manage
                foreach ($getInvoiceDetailsData as $value) {
                    $this->productManage($value['id'],$value,'delete');
                }
                // delete details
                $this->Commonmodel->deleteRecord($this->tableName1, 'purchase_id', $id);
            }

            $description = $_POST['description'];
            for ($i = 0; $i <= count($description); $i++) {
                if ($_POST['description'][$i] != "") {
                    if($_POST['uom'][$i] == 'PC')
                    {
                        $qty = $_POST['qty'][$i];
                    }else{
                        $qty = $_POST['weight'][$i];
                    }
                    $arrProductData = array(
                        "purchase_id" => $id,
                        "product_code" => $_POST['description'][$i],
                        "hsn_code" => $_POST['hsn_code'][$i],
                        "qty" => $qty,
                        "uom" => $_POST['uom'][$i],
                        "rate" => $_POST['rate'][$i],
                        "total" => $_POST['total'][$i],
                        "discount" => $_POST['discount'][$i],
                        "taxable_value" => $_POST['taxable_value'][$i],
                        "CGST_rate" => $_POST['CGST_rate'][$i],
                        "CGST_amount" => $_POST['CGST_amount'][$i],
                        "SGST_rate" => $_POST['SGST_rate'][$i],
                        "SGST_amount" => $_POST['SGST_amount'][$i],
                        "IGST_rate" => $_POST['IGST_rate'][$i],
                        "IGST_amount" => $_POST['IGST_amount'][$i],
                        "final_amount" => $_POST['final_amount'][$i],
                    );
                    $insertDetailsid = $this->Commonmodel->insert($this->tableName1, $arrProductData);
                    //product stock manage
                    $this->productManage($insertDetailsid, $arrProductData,'insert');

                }
            }
        }
            redirect($this->controller);
        } else {
            redirect($this->controller);
        }
    }

        
    function productManage($purchaseID, $productData, $action){
        
        $productInfo = $this->Commonmodel->getRecords('product_master', "*", array("name" => $productData['product_code']));
//        print_r($productInfo);
        if(!empty($productInfo)){
            if($action == 'insert'){
                               
                $getInvoiceDetailsData = $this->Commonmodel->getRecords($this->tableName1, "", array("id" => $purchaseID));
        //        print_r($getInvoiceDetailsData);
                if ($getInvoiceDetailsData) {
                    
                    if($productData['uom'] == 'PC')
                    {
                        $qty = $productInfo[0]->qty + $getInvoiceDetailsData[0]->qty;
                        $arrProductData = array('qty' => $qty);
                    }else{
                        $weight = $productInfo[0]->weight + $getInvoiceDetailsData[0]->qty;
                        $arrProductData = array('weight' => $weight);
                    }
                    
                    $strWhere = ' id=' . $productInfo[0]->id;
                    $this->Commonmodel->update('product_master', $arrProductData, $strWhere);
                }
            }else{
                $getInvoiceDetailsData = $this->Commonmodel->getRecords($this->tableName1, "", array("id" => $purchaseID));
        //        print_r($getInvoiceDetailsData);
                if ($getInvoiceDetailsData) {
                    if($productData['uom'] == 'PC')
                    {
                        $qty = $productInfo[0]->qty - $getInvoiceDetailsData[0]->qty;
                        $arrProductData = array('qty' => $qty);
                    }else{
                        $weight = $productInfo[0]->weight - $getInvoiceDetailsData[0]->qty;
                        $arrProductData = array('weight' => $weight);
                    }
                    $strWhere = ' id=' . $productInfo[0]->id;
                    $this->Commonmodel->update('product_master', $arrProductData, $strWhere);
                }
            }
        }else{
            if($productData['uom'] == 'PC')
            {
                $qty = $productData['qty'];
                $weight = 0;
            }else{
                $weight = $productData['qty'];
                $qty = 0;
            }
            $arrData = array(
                "name" => $productData['product_code'],
                "code" => 'pr_'.  strtolower($productData['product_code']),
                "hsn_code" => $productData['hsn_code'],
                "uom" => $productData['uom'],    
                "qty" => $qty,
                "weight" => ($weight * 100),
                "status" => 'Active'
            );
            $this->Commonmodel->insert('product_master', $arrData);
        }
        
    }


    function delete($id) {

        if ($id != '') {
            $this->Commonmodel->deleteRecord($this->tableName, $this->PK, $id);
        }
        redirect(base_url() . $this->controller);
    }
    
    public function printInvoice($purchaseID) {
        
		$data['purchaseID'] = $purchaseID;
        $data['adminData'] = $this->Commonmodel->getRecord('tbl_user', "*", array('type' => 'Admin'));
        
        $arrInvoice = $this->Commonmodel->getRecord('purchase_master', "*", array('id' => $purchaseID));
		
		$data['purchaseMasterData'] = $arrInvoice;
        
        $data['memberData'] = $this->Commonmodel->getRecord('tbl_user', "*", array('id' => $arrInvoice[0]['customer_id']));
		
        $data['purchaseDetailsData'] = $this->Commonmodel->getRecord('purchase_details', "*", array('purchase_id' => $purchaseID));
        
        $data['pdf'] = $this->pdf;
        $this->load->view($this->controller . '/purchase', $data);
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
        
        $qry = "select * from purchase_master WHERE (DATE(purchase_date) BETWEEN '$startDate' and '$endDate')".$query; 
        $jobDetailsData = $this->Commonmodel->customQuery($qry);
        
        foreach ($jobDetailsData as $key => $data) {
            $grandTotal += $data['purchase_total'];
            $where = array('id' => $data['customer_id']);
            $customerData = $this->Commonmodel->getRecord('tbl_user','*', $where); 
            
            $arrData[$key]['purchase_number'] = $data['purchase_number'];
            $arrData[$key]['purchase_date'] = date('Y-m-d',  strtotime($data['purchase_date'])) ;
            $arrData[$key]['customer'] = $customerData[0]['firstname'].' '.$customerData[0]['lastname'];
            $arrData[$key]['pan'] = $customerData[0]['pan'];
            $arrData[$key]['tin_no'] = $customerData[0]['tin_no'];
            $arrData[$key]['total'] = $data['purchase_total'];
            
            
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
