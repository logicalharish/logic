<?php
//print_r($invoiceDetailsData);
//die();


class convert
{

	function convert_number($number)
	{
		if (($number < 0) || ($number > 999999999))
		{
			throw new Exception("Number is out of range");
		}

		$Gn		 = floor($number / 1000000);
		/* Millions (giga) */
		$number	 -= $Gn * 1000000;
		$kn		 = floor($number / 1000);
		/* Thousands (kilo) */
		$number	 -= $kn * 1000;
		$Hn		 = floor($number / 100);
		/* Hundreds (hecto) */
		$number	 -= $Hn * 100;
		$Dn		 = floor($number / 10);
		/* Tens (deca) */
		$n		 = $number % 10;
		/* Ones */

		$res = "";

		if ($Gn)
		{
			$res .= $this->convert_number($Gn) . " Lacs";
		}

		if ($kn)
		{
			$res .= (empty($res) ? "" : " ") . $this->convert_number($kn) . " Thousand";
		}

		if ($Hn)
		{
			$res .= (empty($res) ? "" : " ") . $this->convert_number($Hn) . " Hundred";
		}

		$ones	 = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
		$tens	 = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");

		if ($Dn || $n)
		{
			if (!empty($res))
			{
				$res .= " and ";
			}

			if ($Dn < 2)
			{
				$res .= $ones[$Dn * 10 + $n];
			} else
			{
				$res .= $tens[$Dn];

				if ($n)
				{
					$res .= " " . $ones[$n];
				}
			}
		}

		if (empty($res))
		{
			$res = "zero";
		}

		return $res;
	}

}

$obj = new convert();
$strIGST = false;


if (!empty($invoiceDetailsData))
{
	$html			 = '';
	$html			 .= '<html>
                    <body>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td>
                            <table width="100%" border="1" cellpadding="0" cellspacing="0" class="">
                              <tr>
                                <td>
                                <img src="' . base_url() . 'assets/core/img/favicon.png"/> 
								</td>
                                <td colspan="8" align="center">
                                    <h2 class="mtop-10">' . $adminData[0]['firstname'] . ' ' . $adminData[0]['lastname'] . '</h2>
                                    <address class="mbottom-10">' . $adminData[0]['address'] . ',' . $adminData[0]['city'] . ' - ' . $adminData[0]['pincode'] . ' <br>' . $adminData[0]['email'] . '<br>' . $adminData[0]['website'] . '</address>
                                </td>
                              </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <table width="100%" border="1" class="" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="50%">Your Gstin Number: ' . $adminData[0]['gstn'] . '
                                    <br>Your PAN Number: ' . $adminData[0]['pan'] . '
                                    <br>Tax Is Payable On Reverse Charge: (Yes/No)
                                    <br>Your Bill Book: ' . $invoiceMasterData[0]['bill_book'] . '
                                    <br>Your Purchase Number: ' . $invoiceMasterData[0]['invoice_number'] . '
                                    <br>Your Purchase Date: ' . date_format(date_create($invoiceMasterData[0]['invoice_date']), 'Y-m-d') . '
                                    <br>Your Chalan Number: ' . $invoiceMasterData[0]['chalan_no'] . '
                                    <br>Your Chalan Date: ' . date_format(date_create($invoiceMasterData[0]['chalan_date']), 'Y-m-d') . '
                                    <br>Your PO Number: ' . $invoiceMasterData[0]['po_number'] . '
                                    <br>Your PO Date: ' . date_format(date_create($invoiceMasterData[0]['po_date']), 'Y-m-d') . '
                                </td>
                                <td width="50%">Transportation Mode: <small>(Apply for Supply of Goods only) </small> ' . $invoiceMasterData[0]['transport'] . '
                                    <br>Veh.No : ' . $invoiceMasterData[0]['vehical_number'] . '
                                    <br>Date & Time of Supply: ' . date_format(date_create($invoiceMasterData[0]['date_suply']), 'Y-m-d') . '
                                    <br>Place OF Supply: ' . $invoiceMasterData[0]['place_suply'] . '
                                </td>
                              </tr>
                            </table>

                        </td>
                      </tr>
                      <tr>
                        <td>
                            <table width="100%" border="1" class="" cellpadding="0" cellspacing="0">
                              <tr class="bg-gray" height="30">
                                <td width="50%" align="center" class="bdr-bottom"><strong>Details of Receiver (Billed to)</strong></td>
                                <td width="50%" align="center" class="bdr-bottom"><strong>Details of Consignee (Shipped to)</strong></td>
                              </tr>
                              <tr>
                                <td>Name: ' . $memberData[0]['firstname'] . ' ' . $memberData[0]['lastname'] . '
                                <br>Address: ' . $memberData[0]['address'] . ' ' . $memberData[0]['city'] . '
                                <br>State: ' . $memberData[0]['state'] . ' 
                                <br>State Code: ' . $memberData[0]['pincode'] . '
                                <br>GSTIN Number: ' . $memberData[0]['gstn'] . '
                                </td>
                                <td>Name: ' . $memberData[0]['firstname'] . ' ' . $memberData[0]['lastname'] . '
                                <br>Address: ' . $memberData[0]['address'] . ' ' . $memberData[0]['city'] . '
                                <br>State: ' . $memberData[0]['state'] . ' 
                                <br>State Code: ' . $memberData[0]['pincode'] . '
                                <br>GSTIN Number: ' . $memberData[0]['gstn'] . '
                                </td>
                              </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <table width="100%" border="1" cellspacing="0" cellpadding="0">
                              <tr>
                                <td rowspan="2" width="5%"><strong>S.No</strong></td>
                                <td rowspan="2" width="15%"><strong>Description of Goods</strong></td>
                                <td rowspan="2" width="8%"><strong>HSN<br>Code<br>(GST)</strong></td>
                                <td rowspan="2" width="5%"><strong>Qty</strong></td>
                                <td rowspan="2" width="5%"><strong>UOM</strong></td>
                                <td rowspan="2" width="8%"><strong>Rate</strong></td>
                                <td rowspan="2" width="10%"><strong>Total</strong></td>
                                <td rowspan="2" width="8%"><strong>Discount</strong></td>
                                <td rowspan="2" width="8%"><strong>Taxable<br>value</strong></td>';
	
				if($invoiceDetailsData[0]['IGST_amount']==0.00)
				{
					$tax = 'GST';
				}
				else
				{
					$tax = 'IGST'; 
				}
				$html			 .= '<td colspan="2"><strong>'.$tax.'</strong></td>';
                                $html			 .= '<td rowspan="2"  width="11.3%"><strong>Amount</strong></td>
                              </tr>';
                               
				
                                 $html			 .=' <tr><td><strong>Rate</strong></td>
                                <td ><strong>Amount</strong></td>
                              </tr>';
				
	$total			 = 0;
	$Cgst			 = 0;
	$Sgst			 = 0;
	$Igst			 = 0;
	$srno			 = 0;
	$invoiceTotal	 = 0;
	$nettotal = 0;
	foreach ($invoiceDetailsData as $job)
	{
//                                    $productData = $this->Commonmodel->getRecord('product_master', "*", array('id' => $job['product_id']));
		$total	 += $job['final_amount'];
		$nettotal	 += $job['taxable_value'];
		$srno	 += 1;

		$Cgst	 += $job['CGST_amount'];
		$Sgst	 += $job['SGST_amount'];
		$Igst	 += $job['IGST_amount'];

		$html .= '<tr>
                                    <td>' . $srno . '</td>
                                    <td>' . $job['product_code'] . '</td>
                                    <td>' . $job['hsn_code'] . '</td>
                                    <td>' . $job['qty'] . '</td>
                                    <td>' . $job['uom'] . '</td>
                                    <td>' . number_format($job['rate'], 2) . '</td>
                                    <td>' . number_format($job['total'], 2) . '</td>
                                    <td>' . $job['discount'] . '</td>
                                    <td>' . $job['taxable_value'] . '</td>';
		if ($job['IGST_rate'] == 0)
		{
			
			$html .= '<td>' . number_format($job['CGST_rate'], 2) . '</td>
                                    <td>' . number_format($job['CGST_amount'], 2) . '</td>';
		} else
		{
			$html .= '<td>' . number_format($job['IGST_rate'], 2) . '</td>
                                    <td>' . number_format($job['IGST_amount'], 2) . '</td>';
		}
		$html .= ' <td><strong>' . number_format($job['final_amount'], 2) . '</strong></td>
                                    </tr>';
	}
	$taxTotal		 = $Cgst  + $Igst;
	$invoiceTotal	 = $total + $invoiceMasterData[0]['freight_charges'] + $invoiceMasterData[0]['loading_packeges_charges'] + $invoiceMasterData[0]['insurance_charges'] + $invoiceMasterData[0]['other_charges'];

	 $html			 .=' <tr>
                                <td colspan="12" height="35">&nbsp;</td>
                              </tr>';
	 $taxtype = '';
					if($invoiceDetailsData[0]['IGST_amount']==0.00)
				{
					$taxtype			 ='
                                <td colspan="5" align="right"><strong>CGST Total </strong></td>
                                <td><strong> ' . number_format($taxTotal/2, 2) . '</strong></td>
                              
                                <td colspan="2" align="right"><strong>SGST Total</strong></td>
                                <td><strong> ' . number_format($taxTotal/2, 2) . '</strong></td>
                              ';
					$colspan =2;
				}
				else
				{
					$colspan =11;
				}

				
                              $html			 .='<tr>
                                <td colspan="11" align="right"><strong>Gross Total </strong></td>
                                <td align="right"><strong> ' . number_format($nettotal, 2) . ' </strong></td>
                              </tr><tr>'.$taxtype.'
                                <td colspan="'.$colspan.'" align="right"><strong>Tax Total </strong></td>
                                <td align="right"><strong> ' . number_format($taxTotal, 2) . '</strong></td>
                              </tr>
                              
                              <tr>
                                <td colspan="11" align="right"><strong>Freight Charges </strong></td>
                                <td align="right"><strong> ' . number_format($invoiceMasterData[0]['freight_charges'], 2) . ' </strong></td>
                              </tr>
                              <tr>
                                <td colspan="11" align="right"><strong>Loading and Packing Charges </strong></td>
                                <td align="right"><strong> ' . number_format($invoiceMasterData[0]['loading_packeges_charges'], 2) . ' </strong></td>
                              </tr>
                              <tr>
                                <td colspan="11" align="right"><strong>Insurance Charges </strong></td>
                                <td align="right"><strong> ' . number_format($invoiceMasterData[0]['insurance_charges'], 2) . ' </strong></td>
                              </tr>
                              <tr>
                                <td colspan="11" align="right"><strong>Other Charges </strong></td>
                                <td align="right"><strong> ' . number_format($invoiceMasterData[0]['other_charges'], 2) . ' </strong></td>
                              </tr>
                              <tr>
                                <td colspan="8" align="left"><strong>Purchase Value (In Words) </strong> ' . $obj->convert_number($invoiceTotal) . ' Only</td>
                                <td colspan="3" align="right"><strong>Purchase Total </strong></td>
                                <td align="right"><strong>' . number_format($invoiceTotal, 2) . '</strong></td>
                              </tr>
                              <tr>
                                <td colspan="12" height="50">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="12" align="left"><strong>Amount of Tax Subject to Reverse Charge</strong></td>
                             
                              </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <table width="100%" border="1" cellspacing="0" cellpadding="0">
                              <tr height="40" class="bg-gray">
                                <td width="50%" align="center" valign="bottom"><strong>Certified that the Particulars given above are true and correct</strong></td>
                                <td width="50%" align="center" valign="bottom"><strong>Electronic Reference Number :</strong></td>
                              </tr>
                              <tr height="100">
                                <td></td>
                                <td></td>
                              </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <table width="100%" border="1" cellspacing="0" cellpadding="0">
                              <tr class="bg-gray">
                                <td width="50%" align="center" valign="bottom"><strong>YOUR TERM &amp; CONDITION OF SALE</strong></td>
                                <td width="50%" align="center" valign="bottom"><strong>YOUR COMPANY NAME</strong></td>
                              </tr>
                              <tr>
                                    <td></td>
                                <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr height="50">
                                        <td width="30%" valign="bottom"><strong>Signature:</strong></td>
                                        <td width="70%" valign="bottom">________________________</td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" class="bg-gray border-1" align="center"><strong>Authorised Signatory</strong></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Name:</strong></td>
                                        <td> ' . $adminData[0]['firstname'] . ' ' . $adminData[0]['lastname'] . '</td>
                                      </tr>
                                      <tr>
                                        <td><strong>Designation:</strong></td>
                                        <td> ' . $adminData[0]['type'] . '</td>
                                      </tr>
                                    </table>

                                </td>
                              </tr>
                            </table>
                        </td>
                      </tr>
                    </table>

                    </body>
                    </html>';
// echo $html;                      

                              
        $pdf->SetHeaderData('', '0', 'Purchase Systems', '510, Venus Amedues, Jodhpur Cross Raod, Satelite,Ahmedabad - 380015', '','');
        $pdf->setFooterData('');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // remove default header/footer
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // add a page
        $pdf->AddPage();
        
        // set font
        $pdf->SetFont('helvetica', '', 9);
        
        $pdf->writeHTML($html, true, false, true, false, '');
        
        $pdf->Output('PDF Purchase.pdf', 'I');

} 
