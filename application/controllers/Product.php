<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->header = "header";
        $this->controller = "product";
        $this->footer = "footer";
        $this->title = "Product";
//        $this->comman_lib->isLogin();
        
        $this->tableName = "product_master";
        $this->PK = "id";
    }

    public function index() {
        
        $data['title'] =   $this->title;
        $data['controller'] = $this->controller;
        
        $data['productList'] = $this->Commonmodel->getRecord($this->tableName);
        
        $this->load->view($this->header, $data);
        $this->load->view($this->controller.'/index',$data);
        $this->load->view($this->footer);
    }
    
       
    public function save() {
        $id = $_POST['id'];
        
        if ($id == '') {
            $arrData = array(
            "name" => $_POST['name'],
            "code" => $_POST['code'],
            "hsn_code" => $_POST['hsn_code'],
            "uom" => $_POST['uom'],    
            "qty" => $_POST['qty'],
            "weight" => ($_POST['weight'] * 100),
            "status" => $_POST['status']
            );
            $id = $this->Commonmodel->insert($this->tableName, $arrData);
        } else {
           $arrData = array(
            "name" => $_POST['name'],
            "code" => $_POST['code'],
            "hsn_code" => $_POST['hsn_code'],
            "uom" => $_POST['uom'],
            "qty" => $_POST['qty'],
            "weight" => ($_POST['weight'] * 100),
            "status" => $_POST['status']
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
//        redirect(base_url() . $this->controller);
    }

    function searchProduct()
    {
        $data = array();
        $keyword = $this->input->get('term');
        $serachData = $this->Commonmodel->getSerachData('product_master', 'name', $keyword);
        foreach ($serachData as $key => $value) {
            $data[$key]['value'] = $value['name'];
            $data[$key]['label'] = $value['name'];
            $data[$key]['id'] = $value['id'];
            $data[$key]['code'] = $value['hsn_code'];
            $data[$key]['uom'] = $value['uom'];
        }
        echo json_encode($data);
    }
    
    function checkProductCode() {
        $code = $_POST['code'];
        $serachData = $this->Commonmodel->getSerachData('product_master', 'code', $code);
        if($serachData)
        {
            echo json_encode(array("action"=>1, "data" => $serachData));
        }else{
            echo json_encode(array("action"=>0));
        }
    }
    
    public function editProduct($id = '') {
        $ProductId   = '';
        $productName   = '';
        $productCode   = 'pr_';
        $productHCCode   = '';
        $productQty   = '0';
        $productWeight   = '0';
        $strFormMode = 'A';        
        $strStatusCombo = $this->Commonmodel->getActiveInativeCombo('status');
        $strPC	= '';
        $strKG  = '';
        
        $strDisableQty = 'disabled';
        $strDisableWeight = 'disabled';

        if($id != '')
        {
            $strFormMode = 'E';
            $arrData = $this->Commonmodel->getByID($this->tableName, $this->PK, $id);
            $ProductId   = $arrData->id;
            $productName   = $arrData->name;
            $productCode   = $arrData->code;
            $productHCCode   = $arrData->hsn_code;
            $productQty   = $arrData->qty;
            $productWeight   = number_format($arrData->weight / 100,2);
            $productUom = $arrData->uom;
            $strPC = ($arrData->uom == 'PC') ? 'selected' : '';
            $strKG = ($arrData->uom == 'KG') ? 'selected' : '';
            
            
            $strDisableQty = ($arrData->uom == 'PC') ? '' : 'disabled';
            $strDisableWeight = ($arrData->uom == 'KG') ? '' : 'disabled';
            
            $strStatusCombo = $this->Commonmodel->getActiveInativeCombo('status', 'class=""', $arrData->status);
        }
        
        $html='<div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Product Information
                            <button type="button" class="btn btn-link waves-effect pull-right" data-dismiss="modal">X</button>
                            </h4>
                        </div>';
            $html.='<div class="modal-body">
                       <div class="body">
                    <form name="productAdd" id="productAdd" method="POST" onsubmit="return false">
                        <div class="pcode"></div>
                        <input type="hidden" name="id" value="'.$ProductId.'" id="id"/>
                        <input type="hidden" name="formmode" value="'.$strFormMode.'" id="formmode"/>
                        <div class="col-md-12 form-inline row" >
                            <div class="form-group">
                                <label for="user_name"> Product Name  </label>
                                <input type="text" name="name" id="name" class="form-control"  value="'.$productName.'" required="">
                            </div>
                            <div class="form-group">
                                <label for="user_name"> Product Code  </label>
                                <input type="text" name="code" id="code" class="form-control"  value="'.$productCode.'" required="">
                            </div>
                            <div class="form-group">
                                <label for="user_name"> Product HSN Code  </label>
                                <input type="text" name="hsn_code" id="hsn_code" class="form-control"  value="'.$productHCCode.'" required="">
                            </div>
                            <div class="form-group">
                                <label class="form-label">UOM</label>
                                <select class="form-control simple-select" name="uom" id="uom">
                                    <option value="">Select</option>
                                    <option value="PC" '.$strPC.'>PC</option>
                                    <option value="KG" '.$strKG.'>KG</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_company"> Product Qty </label>
                                <input type="text" name="qty" id="qty" class="form-control" value="'.$productQty.'" required="" '.$strDisableQty.'>
                            </div>
                            <div class="form-group">
                                <label for="user_company"> Product Weight </label>
                                <input type="text" name="weight" id="weight" class="form-control" value="'.$productWeight.'" required="" '.$strDisableWeight.'>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">status</label>
                                '.$strStatusCombo.'
                            </div>
                        </div> 
                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                    </form>

                </div>     
                    </div>';
        echo $html;
       
    }
}
