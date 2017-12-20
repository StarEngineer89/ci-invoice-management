<?php
$body_text = rawurldecode($customer_template->d_body);
$body_text = str_replace('{id}', $invoice_list->id, $body_text);
$body_text = str_replace('{invoice_date}', $invoice_list->invoice_date , $body_text);
$body_text = str_replace('{invoice_no}', $invoice_list->invoice_no, $body_text);
$body_text = str_replace('{invoice_status}', $invoice_list->invoice_status, $body_text);
$body_text = str_replace('{receive_amount}', $invoice_list->receive_amount, $body_text);
$body_text = str_replace('{balance}', $invoice_list->balance, $body_text);
$body_text = str_replace('{paymentmode_id}', $invoice_list->paymentmode_id, $body_text);
$body_text = str_replace('{remarks}', $invoice_list->remarks, $body_text);
$body_text = str_replace('{balance_status}', $invoice_list->balance_status, $body_text);

$body_text = str_replace('{config_id}', $configuration_details->config_id, $body_text);
$body_text = str_replace('{cherity_name}', $configuration_details->cherity_name, $body_text);
$body_text = str_replace('{address}', $configuration_details->address, $body_text);
$body_text = str_replace('{phone}', $configuration_details->phone, $body_text);
$body_text = str_replace('{fax}', $configuration_details->fax, $body_text);
$body_text = str_replace('{email}', $configuration_details->email, $body_text);
$body_text = str_replace('{website}', $configuration_details->website, $body_text);
$body_text = str_replace('{logo}', $configuration_details->logo, $body_text);
$body_text = str_replace('{approval_disabled}', $configuration_details->approval_disabled, $body_text);
$body_text = str_replace('{registration_email}', $configuration_details->registration_email, $body_text);

$body_text = str_replace('{registration_sms}', $configuration_details->registration_sms, $body_text);
$body_text = str_replace('{donation_email}', $configuration_details->donation_email, $body_text);
$body_text = str_replace('{donation_sms}', $configuration_details->donation_sms, $body_text);
$body_text = str_replace('{event_email}', $configuration_details->event_email, $body_text);
$body_text = str_replace('{event_sms}', $configuration_details->event_sms, $body_text);
$body_text = str_replace('{pledges_email}', $configuration_details->pledges_email, $body_text);
$body_text = str_replace('{pledges_sms}', $configuration_details->pledges_sms, $body_text);
$body_text = str_replace('{dnregistrationemailtext}', $configuration_details->dnregistrationemailtext, $body_text);
$body_text = str_replace('{dnregistrationsmstext}', $configuration_details->dnregistrationsmstext, $body_text);
$body_text = str_replace('{eventemailtext}', $configuration_details->eventemailtext, $body_text);

$body_text = str_replace('{eventsmstext}', $configuration_details->eventsmstext, $body_text);
$body_text = str_replace('{donationemailtext}', $configuration_details->donationemailtext, $body_text);
$body_text = str_replace('{donationsmstext}', $configuration_details->donationsmstext, $body_text);
$body_text = str_replace('{pledgeemailtext}', $configuration_details->pledgeemailtext, $body_text);
$body_text = str_replace('{pledgesmstext}', $configuration_details->pledgesmstext, $body_text);
$body_text = str_replace('{smsuser}', $configuration_details->smsuser, $body_text);
$body_text = str_replace('{smspass}', $configuration_details->smspass, $body_text);
$body_text = str_replace('{opcashbalance}', $configuration_details->opcashbalance, $body_text);
$body_text = str_replace('{opbankbalance}', $configuration_details->opbankbalance, $body_text);
$body_text = str_replace('{receipttext}', $configuration_details->receipttext, $body_text);

$body_text = str_replace('{emailsendername}', $configuration_details->emailsendername, $body_text);
$body_text = str_replace('{emailsenderaddress}', $configuration_details->emailsenderaddress, $body_text);
$body_text = str_replace('{signaturetext}', $configuration_details->signaturetext, $body_text);
$body_text = str_replace('{signatureimage}', $configuration_details->signatureimage, $body_text);
$body_text = str_replace('{config_date}', $configuration_details->config_date, $body_text);
$body_text = str_replace('{vat_percent}', $configuration_details->vat_percent, $body_text);
$body_text = str_replace('{vat_no}', $configuration_details->vat_no, $body_text);


$setHeader =  str_replace('{d_letter_template_name}', $customer_template->d_letter_template_name, $body_text);
$html= <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
    table{ font-size:8px;}
</style>
$body_text
EOF;
;

$this->load->library('mypdf');
$pdf = new mypdf('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($this->session->userdata('sess_user_name'));
$pdf->SetAuthor($this->session->userdata('sess_user_name'));
$pdf->SetTitle('Invoice');
//config setting
$name="$page_title ".Date('d-m-Y');
$config=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>"1"));

// set default header data
// $pdf->SetHeaderData(.$setHeader, array(0,0,0), array(0,0,0));
// $pdf->SetHeaderData('assets/image/setUpwindow/'.$config->logo, 50,$config->cherity_name,$config->address."\n"."Phone: ".$config->phone, array(0,0,0), array(0,0,0));
// $pdf->setFooterData(array(0,0,0), array(0,0,0));
// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
// $pdf->SetMargins('10', '27', '5');
// $pdf->SetHeaderMargin('5');
// $pdf->SetFooterMargin('10');
$pdf->SetAutoPageBreak(TRUE,'18');
$pdf->AddPage('P','A4');

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output($name, 'I');