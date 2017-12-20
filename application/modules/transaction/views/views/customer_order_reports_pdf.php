<?php

$this->load->library('mypdf');
// create new PDF document
$pdf = new mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
// $pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Customer Order Reports');
// $pdf->SetSubject('TCPDF Tutorial');
// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$page_title = "Terms & Condition";
$page_title_header = '';
// set default header data

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage('P','A4');

// create some HTML content
$img = file_get_contents(base_url().'/img/grafx_terms_condition.png');
// $pdf->SetLineWidth(2);
$pdf->Image('@' . $img, 5, 2, 200, 24, 'png', '', 'T', false, 0, '', false, false, 200, false, false, false);
$pdf->Ln(24);
$html = '<span style="text-align:justify;">
			<b>Payment</b><br/>
				&nbsp;&nbsp;&nbsp;       - A Deposit of 75% will be payable at the time of booking.<br/>
				&nbsp;&nbsp;&nbsp;       - Balance due of 25% shall be fully payable on collection of product(s).<br/>
				&nbsp;&nbsp;&nbsp;       - The deposit is non-refundable if booking is cancelled less than 90 days prior to the event.<br/>
				&nbsp;&nbsp;&nbsp;       - Products will not be given until the balance due is paid in full.<br/><br/>

			<b>Title and Music Choice</b><br/>
				&nbsp;&nbsp;&nbsp;       - Client is responsible for providing "names", "files" and "songs" to be inserted in the movie within 3 days of <br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;the function. Otherwise Grafx Media hold the right to use their own materials and this may <br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;also result in the movie product being delayed.<br/>
				&nbsp;&nbsp;&nbsp;       - If no music choice is given we will choose the music and a charge will be made for subsequent changes. <br/>
				&nbsp;&nbsp;&nbsp;       - payment and clearance of music used and absolved Grafx Media from breaking any copyright laws.<br/>
				&nbsp;&nbsp;&nbsp;       - Any changes to the edited video will be charge at the daily rate.<br/><br/>

			<b>Re-edits</b><br/>
				&nbsp;&nbsp;&nbsp;       - Technical erros will be corrected free of charge.<br/>
				&nbsp;&nbsp;&nbsp;       - Client-requested changes to their video will be charge at the prevailing daily edit rate.<br/>
				&nbsp;&nbsp;&nbsp;       - We will supply you with a preliminary edit for you to check before the final copy/copies are made.<br/>
				&nbsp;&nbsp;&nbsp;       - A charge will be made to correct any errors reported after the final copy is supplied. <br/>
				&nbsp;&nbsp;&nbsp;       - An Extra charge of £50 is payable for adding photographs to the DVD title for each event. <br/><br/>

			<b>Delivery of Product</b><br/>
				&nbsp;&nbsp;&nbsp;       - The editing process take 6-8 weeks from the date fo the wedding (Not including weekends).<br/><br/>
			
			<b>Disclaimer</b><br/>
				&nbsp;&nbsp;&nbsp;       - Any extra time spend on the videography and photography outwith the agreed the function times will be <br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;charge at £35 per hour.<br/>
				&nbsp;&nbsp;&nbsp;       - The client is responsible for informing their main family members and relatives during the function of <br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grafx Media staff for videography and photography purposes. <br/><br/>

			<b>Photography</b><br/>
				&nbsp;&nbsp;&nbsp;       - All original materials whether film or digital remain the property of Grafx Media.<br/>
				&nbsp;&nbsp;&nbsp;       - All reprints and enlargement will be at the price current at the time of the wedding.<br/>
				&nbsp;&nbsp;&nbsp;       - Colour photography is undertaken within the technical limitations of the process and certains colours may not necessarily be.<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;facsimile of the whole range of colours within a subjects.<br/>
				&nbsp;&nbsp;&nbsp;       - It is understood that the copyright of all the photographs belong to Grafx Media and may be used to promote Grafx Media. <br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No photographs may be copied or reproduced by any means photographic or otherwise by any person or machine.<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;other than the Grafx Media employees.<br/>
				&nbsp;&nbsp;&nbsp;       - Wedding album orders placed more than 12 months after the wedding date maybe subject to an additional product charge. <br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All requested manipulation to image would be charged at the prevailing daily edit rate.<br/><br/>

			<b>Copyright</b><br/>
				&nbsp;&nbsp;&nbsp;       - Grafx Media retains the copyright to all material recorded by them.<br/>
				&nbsp;&nbsp;&nbsp;       - Grafx Media hold the right to use any highlight and photography material of any event on the <br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;company website. This will be strictly be used for advertisement and promotional purposes only.<br/><br/>

				<b>Complaints</b><br/>
				&nbsp;&nbsp;&nbsp;       - Any complaints must be received in writing no more than 14 days after receipt of final product.
		</span>';

// set core font
$pdf->SetFont('helvetica', '', 8);

// output the HTML content
$pdf->writeHTML($html, true, 0, true, true);

$pdf->SetFont('helvetica', 'B',11);
$pdf->setCellPaddings(4, 2, 2, 2);
$pdf->setCellMargins(1, 1, 2, 1);
$pdf->MultiCell(193, 74, 'Additional Notes', 1, 'L', 0, 0);
$p1x   = $pdf->getX();
$p1y   = $pdf->getY();
$style = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, '');
$pdf->Line(20, $p1y+15, 195, $p1y+15, $style);
$pdf->Ln();
$style = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, '');
$pdf->Line(20, $p1y+25, 195, $p1y+25, $style);
$pdf->Ln();
$style = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, '');
$pdf->Line(20, $p1y+35, 195, $p1y+35, $style);
$pdf->Ln();
$style = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, '');
$pdf->Line(20, $p1y+45, 195, $p1y+45, $style);
$pdf->Ln();
$style = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, '');
$pdf->Line(20, $p1y+55, 195, $p1y+55, $style);
$pdf->Ln();
$style = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, '');
$pdf->Line(20, $p1y+65, 195, $p1y+65, $style);
$pdf->Ln();

// reset pointer to the last page
$pdf->lastPage();


$pdf->AddPage('P','A4');
$pdf->SetFont('helvetica', '',11);
$pdf->setCellMargins(8, 0, 0, 0);
$pdf->setCellPaddings(4, 2, 2, 2);
$pdf->Cell(70, 8, 'Booking By:', 1, '', 'L', 0, 0);

$pdf->Cell(70, 8, 'Date:', 1, '', 'L', 0, 0);
$pdf->Ln(5);
$img = file_get_contents(base_url().'/img/grafx_event_booking1.png');
// $pdf->SetLineWidth(2);
$pdf->Image('@' . $img, 10, 22, 196, 30, 'png', '', 'T', false, 0, '', false, false, 200, false, false, false);
$pdf->Ln(33);

$getY_name = $pdf->getY();
$getX_name = $pdf->getX();
$pdf->SetFont('helvetica', 'B',11);
$pdf->setCellPaddings(3, 5, 2, 2);
$pdf->setCellMargins(1, 1, 2, 1);
$pdf->MultiCell(194, 45, '', 1, 'L', 0, 0);
$pdf->Ln();

$pdf->SetFont('helvetica', '',10);
$pdf->setY($getY_name+2);
$pdf->Cell(60,5,"Name: ____________________________________________________", 0);
$pdf->Ln();



$pdf->setY($getY_name+10);
$pdf->Cell(60,5,"Address: __________________________________________________", 0);
$pdf->Ln();
$pdf->setY($getY_name+18);
$pdf->Cell(60,5," _________________________________________________________", 0);
$pdf->Ln();
$pdf->setY($getY_name+26);
$pdf->Cell(60,5," _________________________________________________________", 0);
$pdf->Ln();

$pdf->setXY($getX_name+118, $getY_name+2);
$pdf->Cell(60,5,"Telephone: __________________________", 0);
$pdf->Ln();
$pdf->setXY($getX_name+118, $getY_name+10);
$pdf->Cell(60,5,"Home:  _____________________________", 0);
$pdf->Ln();
$pdf->setXY($getX_name+118, $getY_name+18);
$pdf->Cell(60,5,"Work: ______________________________", 0);
$pdf->Ln();
$pdf->setXY($getX_name+118, $getY_name+26);
$pdf->Cell(60,5,"Mobile: _____________________________", 0);
$pdf->Ln();

$pdf->setY($getY_name+34);
$pdf->Cell(60,5,"Email: ____________________________________________________", 0);
$pdf->Ln();

// $pdf->setXY($getX_name+14, $getY_name+10);
// $pdf->MultiCell(160, 35, '__________________________________________________________________________________________________________________', 1, 'L', 0, 0);
// $pdf->Ln();

$pdf->setXY($getX_name+12, $getY_name+2);
$pdf->Cell(80,0,"Kristian Rafael D. Claridad", 0, 'C');
$pdf->Ln();
$pdf->setXY($getX_name+12, $getY_name+10);
$pdf->Cell(80,0,"Philippines", 0, 'C');
$pdf->Ln();

$pdf->setXY($getX_name+140, $getY_name+2);
$pdf->Cell(80,0,"77-7777", 0, 'C');
$pdf->Ln();
$pdf->setXY($getX_name+130, $getY_name+10);
$pdf->Cell(80,0,"Philippines", 0, 'C');
$pdf->Ln();
$pdf->setXY($getX_name+128, $getY_name+18);
$pdf->Cell(80,0,"Amertron Inc. Philippines", 0, 'C');
$pdf->Ln();
$pdf->setXY($getX_name+129, $getY_name+26);
$pdf->Cell(80,0,"+63 9073 712 599", 0, 'C');
$pdf->Ln();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Customer_Order_Reports.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+