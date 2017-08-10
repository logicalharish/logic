<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'third_party/tcpdf/tcpdf.php';
        
class Invoices extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->controller = "invoices";
        $this->title = "Invoices";
//        $this->comman_lib->isLogin();

        $this->tableName = "invoice_master";
        $this->PK = "id";
        $this->arrayField = array('invoice_number','id', 'customer_id', 'invoice_total', 'invoice_date', 'status');
        $this->tableName1 = "invoice_details";
        
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

        $dataTableColumns = array('invoice_number','id', 'customer_id', 'invoice_total', 'invoice_date', 'status');

        $arrResult = $this->Commonmodel->getListing($this->controller, $this->tableName, $this->PK, $this->arrayField, $dataTableColumns);
	
        foreach ($arrResult['data'] as $key => $value) {
            $arrParentName = $this->Commonmodel->getByID('tbl_user', 'id', $arrResult['data'][$key]['1']);
            $arrResult['data'][$key]['1'] = $arrParentName->firstname;
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

    public function save() {
        
        if (isset($_POST)) {
        $id = $_POST['id'];
        if ($id == '') {
            $arrData = array(
                "customer_id" => $_POST['customers'],
                "invoice_number" => $_POST['invoice_number'],
                "freight_charges" => $_POST['freight_charges'],
                "loading_packeges_charges" => $_POST['loading_packeges_charges'],
                "insurance_charges" => $_POST["insurance_charges"],
                "other_charges" => $_POST['other_charges'],
                "total_words" => $_POST['total_words'],
                "invoice_total" => $_POST['invoice_total'],
                "po_number" => $_POST['po_number'],
                "gst_total" => $_POST['gst_total'],
                "igst_total" => $_POST['igst_total'],
                "chalan_no" => $_POST['chalan_no'],
                "chalan_date" => date_format(date_create($_POST['chalan_date']), 'Y-m-d H:i:s'),
                "po_date" => date_format(date_create($_POST["po_date"]), 'Y-m-d H:i:s'),
                "invoice_date" => date_format(date_create($_POST["invoice_date"]), 'Y-m-d H:i:s'),
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
                        $arrProductData = array(
                            "invoice_id" => $insertId,
                            "product_code" => $_POST['description'][$i],
                            "hsn_code" => $_POST['hsn_code'][$i],
                            "qty" => $_POST['qty'][$i],
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
                        //$this->productManage($insertDetailsid,$_POST['hsn_code'][$i],'insert');

                    }
                }
            }
        } else {
            $arrData = array(
                "customer_id" => $_POST['customers'],
                "invoice_number" => $_POST['invoice_number'],
                "freight_charges" => $_POST['freight_charges'],
                "loading_packeges_charges" => $_POST['loading_packeges_charges'],
                "insurance_charges" => $_POST["insurance_charges"],
                "other_charges" => $_POST['other_charges'],
                "total_words" => $_POST['total_words'],
                "gst_total" => $_POST['gst_total'],
                "igst_total" => $_POST['igst_total'],
				"invoice_total" => $_POST['invoice_total'],
                "po_number" => $_POST['po_number'],
                "chalan_no" => $_POST['chalan_no'],
                "chalan_date" => date_format(date_create($_POST['chalan_date']), 'Y-m-d H:i:s'),
                "po_date" => date_format(date_create($_POST["po_date"]), 'Y-m-d H:i:s'),
                "invoice_date" => date_format(date_create($_POST["invoice_date"]), 'Y-m-d H:i:s'),
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
            $getInvoiceDetailsData = $this->Commonmodel->getRecords($this->tableName1, "", array("invoice_id" => $id));
            if ($getInvoiceDetailsData) {
                //product stock manage
                foreach ($getInvoiceDetailsData as $value) {
                    //$this->productManage($value->id,$value->hsn_code,'delete');
                }
                // delete details
                $this->Commonmodel->deleteRecord($this->tableName1, 'invoice_id', $id);
            }

            $description = $_POST['description'];
            for ($i = 0; $i <= count($description); $i++) {
                if ($_POST['description'][$i] != "") {
                    $arrProductData = array(
                        "invoice_id" => $id,
                        "product_code" => $_POST['description'][$i],
                        "hsn_code" => $_POST['hsn_code'][$i],
                        "qty" => $_POST['qty'][$i],
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
                        //$this->productManage($insertDetailsid, $_POST['hsn_code'][$i],'insert');

                }
            }
        }
            redirect($this->controller);
        } else {
            redirect($this->controller);
        }
    }

        
    function productManage($invoiceID, $code, $action){
        
        $productInfo = $this->Commonmodel->getRecords('product_master', "*", array("code" => $code));
//        print_r($productInfo);
        
        if($action == 'insert'){
            $getInvoiceDetailsData = $this->Commonmodel->getRecords($this->tableName1, "", array("id" => $invoiceID));
    //        print_r($getInvoiceDetailsData);
            if ($getInvoiceDetailsData) {
                $stock = $productInfo[0]->stock - $getInvoiceDetailsData[0]->qty;

                $productData = array('stock' => $stock);
                $strWhere = ' id=' . $productInfo[0]->id;
                $this->Commonmodel->update('product_master', $productData, $strWhere);
    }
        }else{
            $getInvoiceDetailsData = $this->Commonmodel->getRecords($this->tableName1, "", array("id" => $invoiceID));
    //        print_r($getInvoiceDetailsData);
            if ($getInvoiceDetailsData) {
                $stock = $productInfo[0]->stock + $getInvoiceDetailsData[0]->qty;

                $productData = array('stock' => $stock);
                $strWhere = ' id=' . $productInfo[0]->id;
                $this->Commonmodel->update('product_master', $productData, $strWhere);
            }
        }
        
        
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

        $arrDiscount =  $this->Commonmodel->getRecord('invoice_details', "sum(discount)as discount", array('invoice_id' => $invoiceID));
        
		$data['discount'] = $arrDiscount[0]['discount'];
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
            $arrData[$key]['gstn'] = $customerData[0]['gstn'];
            $arrData[$key]['gst_total'] = $data['gst_total'];
            $arrData[$key]['igst_total'] = $data['igst_total'];
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
        
        $where = array('type' => 'member', 'status' => 'Active');
        $data['memberData'] = $this->Commonmodel->getRecord('tbl_user','id,firstname,lastname', $where); 
        
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
