<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class mypdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }

    public function Footer() {
        // Position at 25 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 10);
        $this->Cell(0, 0, 'Printed on:'.date('d-m-Y'),'T', 0, 'L');
        // Page number
        $this->Cell(0, 0, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }

    
}
