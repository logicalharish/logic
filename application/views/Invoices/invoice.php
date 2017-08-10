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
                                
                                <td colspan="9" align="center" valign="top">
                                    <h2 class="mtop-10">TAX INVOICE</h2>
                                   
                                </td>
                              </tr>
							  <tr>
                                
                                <td colspan="9" align="center">
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
                                <td width="50%" >
									<table width="100%" cellpadding="2">
									<tr><td>GST Number</td><td align="left">' . $adminData[0]['gstn'] . '</td></tr>
									<tr><td>PAN Number</td><td align="left">' . $adminData[0]['pan'] . '</td></tr>
									<tr><td>Bank Account Number</td><td align="left">' . $adminData[0]['pan'] . '</td></tr>
									<tr><td>Bank Details</td><td align="left">' . $adminData[0]['pan'] . '</td></tr>
									
									</table>
									
                                    
                                    
                                </td>
                                <td width="50%"><table width="100%" cellpadding="2">
									<tr><td>Bill Book</td><td align="left" colspan="3">' . $invoiceMasterData[0]['bill_book']. '</td></tr>
									<tr><td>Invoice Number</td><td align="left">' . $invoiceMasterData[0]['invoice_number'] . '</td><td>Invoice Date</td><td>' . date_format(date_create($invoiceMasterData[0]['invoice_date']), 'Y-m-d') . '</td></tr>
									<tr><td>Chalan Number</td><td align="left">' . $invoiceMasterData[0]['chalan_no'] . '</td><td>Chalan Date</td><td>' . date_format(date_create($invoiceMasterData[0]['chalan_date']), 'Y-m-d') . '</td></tr>
									<tr><td>PO Number</td><td align="left">' . $invoiceMasterData[0]['po_number'] . '</td><td>PO Date</td><td>' . date_format(date_create($invoiceMasterData[0]['po_date']), 'Y-m-d') . '</td></tr>
									
									</table>
								
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
                                <td width="50%" align="center" class="bdr-bottom"><strong>Transport Deatails</strong></td>
                              </tr>
                              <tr>
                                <td>
								<table width="100%" cellpadding="2">
									<tr><td  width="20%" >Name</td><td align="left"  width="80%">' . $memberData[0]['firstname'] . ' ' . $memberData[0]['lastname'] . '</td></tr>
									<tr><td>Address</td><td align="left">' . $memberData[0]['address'] . ' ' .$memberData[0]['city'] . '</td></tr>
									<tr><td>State</td><td align="left">' . $memberData[0]['state'] . ' </td></tr>
									<tr><td>State Code</td><td align="left">' . $memberData[0]['pincode'] . '</td></tr>
									<tr><td>GST Number</td><td align="left">' . $memberData[0]['gstn'] . '</td></tr>
									
									</table>
                                </td>
                                <td>
								<table width="100%" cellpadding="2">
									<tr><td  >Transportation Mode <br><small>(Apply for Supply of Goods only) </small> </td><td align="left">' . $invoiceMasterData[0]['transport']. '</td></tr>
									<tr><td>Veh.No</td><td align="left">' . $invoiceMasterData[0]['vehical_number'] . '</td></tr>
									<tr><td>Date & Time of Supply</td><td align="left">' . date_format(date_create($invoiceMasterData[0]['date_suply']), 'Y-m-d') . '</td></tr>
									<tr><td>Place OF Supply</td><td align="left">' . $invoiceMasterData[0]['place_suply'] . '</td></tr>
									
									</table>
                                </td>
                              </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <table width="100%" border="1" cellspacing="0" cellpadding="0">
                              <tr>
                                <td rowspan="2" width="3%"><strong>No</strong></td>
                                <td rowspan="2" width="18%"><strong>Description of Goods</strong></td>
                                <td rowspan="2" width="8%"><strong>HSN<br>Code<br>(GST)</strong></td>
                                <td rowspan="2" width="7%" valign="middle"><strong> Qty</strong></td>
                                <td rowspan="2" width="5%"><strong> UOM</strong></td>
                                <td rowspan="2" width="8%"><strong> Rate</strong></td>
                                <td rowspan="2" width="10%"><strong> Total</strong></td>
                                <td rowspan="2" width="7%"><strong>Discount</strong></td>
                                <td rowspan="2" width="8%"><strong> Taxable<br> value</strong></td>';
	
				if($invoiceDetailsData[0]['IGST_amount']==0.00)
				{
					$tax = 'GST';
				}
				else
				{
					$tax = 'IGST'; 
				}
				$html			 .= '<td colspan="2" align="center"><strong>'.$tax.'</strong></td>';
                                $html			 .= '<td rowspan="2"  width="9.3%"><strong>Amount</strong></td>
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
	//foreach ($invoiceDetailsData as $invoiceDetailsData[$intIndex])
	$intRow = 10-count($invoiceDetailsData);
	
	for ($intIndex=0;$intIndex < count($invoiceDetailsData);$intIndex++)
	{
		
//                                    $productData = $this->Commonmodel->getRecord('product_master', "*", array('id' => $invoiceDetailsData[$intIndex]['product_id']));
		$total	 += $invoiceDetailsData[$intIndex]['final_amount'];
		$nettotal	 += $invoiceDetailsData[$intIndex]['taxable_value'];
		$srno	 += 1;

		$Cgst	 += $invoiceDetailsData[$intIndex]['CGST_amount'];
		$Sgst	 += $invoiceDetailsData[$intIndex]['SGST_amount'];
		$Igst	 += $invoiceDetailsData[$intIndex]['IGST_amount'];

		$html .= '<tr>
                                    <td>' . $srno . '</td>
                                    <td> ' . $invoiceDetailsData[$intIndex]['product_code'] . '</td>
                                    <td> ' . $invoiceDetailsData[$intIndex]['hsn_code'] . '</td>
                                    <td> ' . $invoiceDetailsData[$intIndex]['qty'] . '</td>
                                    <td> ' . $invoiceDetailsData[$intIndex]['uom'] . '</td>
                                    <td> ' . number_format($invoiceDetailsData[$intIndex]['rate'], 2) . '</td>
                                    <td> ' . number_format($invoiceDetailsData[$intIndex]['total'], 2) . '</td>
                                    <td> ' . $invoiceDetailsData[$intIndex]['discount'] . ' </td>
                                    <td align="right"> ' . $invoiceDetailsData[$intIndex]['taxable_value'] . ' &nbsp;</td>';
		if ($invoiceDetailsData[$intIndex]['IGST_rate'] == 0)
		{
			
			$html .= '<td align="right"> ' . number_format($invoiceDetailsData[$intIndex]['CGST_rate'], 2) . ' &nbsp; </td>
                                    <td align="right"> ' . number_format($invoiceDetailsData[$intIndex]['CGST_amount'], 2) . ' &nbsp;</td>';
		} else
		{
			$html .= '<td align="right"> ' . number_format($invoiceDetailsData[$intIndex]['IGST_rate'], 2) . '&nbsp; </td>
                                    <td align="right">' . number_format($invoiceDetailsData[$intIndex]['IGST_amount'], 2) . '&nbsp;</td>';
		}
		$html .= ' <td align="right"><strong>' . number_format($invoiceDetailsData[$intIndex]['final_amount'], 2) . '</strong></td>
                                    </tr>';
	}
	for($intInner = 0; $intInner < $intRow; $intInner++)
	{
		$html .= '<tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>';
		
			$html .= '<td></td>
                                    <td></td>';
		
		$html .= ' <td><strong></strong></td>
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
                                <td colspan="5" align="right"><strong>CGST Total &nbsp;</strong></td>
                                <td><strong> ' . number_format($taxTotal/2, 2) . '</strong></td>
                              
                                <td colspan="2" align="right"><strong>SGST Total &nbsp;</strong></td>
                                <td><strong> ' . number_format($taxTotal/2, 2) . '</strong></td>
                              ';
					$colspan =2;
				}
				else
				{
					$colspan =11;
				}

				
                              $html			 .='<tr>
                                <td colspan="11" align="right"><strong>Gross Total&nbsp; </strong></td>
                                <td align="right"><strong> ' . number_format($nettotal, 2) . ' </strong></td>
                              </tr><tr>'.$taxtype.'
                                <td colspan="'.$colspan.'" align="right"><strong>Tax Total &nbsp;</strong></td>
                                <td align="right"><strong> ' . number_format($taxTotal, 2) . '</strong></td>
                              </tr>
                              
                              <tr>
                                <td colspan="11" align="right"><strong>Freight Charges &nbsp;</strong></td>
                                <td align="right"><strong> ' . number_format($invoiceMasterData[0]['freight_charges'], 2) . ' </strong></td>
                              </tr>
                              <tr>
                                <td colspan="11" align="right"><strong>Loading and Packing Charges &nbsp;</strong></td>
                                <td align="right"><strong> ' . number_format($invoiceMasterData[0]['loading_packeges_charges'], 2) . ' </strong></td>
                              </tr>
                              <tr>
                                <td colspan="11" align="right"><strong>Insurance Charges &nbsp;</strong></td>
                                <td align="right"><strong> ' . number_format($invoiceMasterData[0]['insurance_charges'], 2) . ' </strong></td>
                              </tr>
                              <tr>
                                <td colspan="11" align="right"><strong>Other Charges &nbsp;</strong></td>
                                <td align="right"><strong> ' . number_format($invoiceMasterData[0]['other_charges'], 2) . ' </strong></td>
                              </tr>
                              <tr>
                                <td colspan="8" align="left"><strong>Invoice Value (In Words) </strong> ' . $obj->convert_number($invoiceTotal) . ' Only</td>
                                <td colspan="3" align="right"><strong>Invoice Total  &nbsp;</strong></td>
                                <td align="right"><strong>' . number_format($invoiceTotal, 2) . '</strong></td>
                              </tr>
                              <tr>
                                <td colspan="12" height="50">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="12" align="left">Amount of Tax Subject to Reverse Charge</td>
                             
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
                                <td width="50%" align="center" valign="bottom"><strong> TERM &amp; CONDITION OF SALE</strong></td>
                                <td width="50%" align="center" valign="bottom"><strong> COMPANY NAME</strong></td>
                              </tr>
                              <tr>
                                    <td></td>
                                <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr height="50">
                                        <td width="30%" valign="bottom"><strong>Signature:</strong></td>
                                        <td width="70%" valign="bottom"><br><br><br><br>________________________</td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" class="bg-gray border-1" align="center"><strong>Authorised Signatory</strong></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Name:</strong></td>
                                        <td> ' . $adminData[0]['firstname'] . ' ' . $adminData[0]['lastname'] . '</td>
                                      </tr>
                                      <tr>
                                        <td><br><strong>Designation:</strong></td>
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
//die;
                              
       $pdf->SetHeaderData('', '0', 'Invoice Systems', '510, Venus Amedues, Jodhpur Cross Raod, Satelite,Ahmedabad - 380015', '','');
        $pdf->setFooterData('');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
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
        
        $pdf->Output('PDF Invoice.pdf', 'I');

} 
