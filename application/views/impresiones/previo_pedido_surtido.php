<?php
require_once('tcpdf/config/lang/spa.php');
require_once('tcpdf/tcpdf.php');
global $header_alt;
$header_alt = $header;

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    

	//Page header
	public function Header() {
	   
       global $header_alt;
        
        $this->SetFont('helvetica', 'B', 7);

$html = <<<EOF
$header_alt
EOF;

        // output the HTML content
        $this->writeHTML($html, true, false, true, false, '');
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 7);

// add a page


foreach($detalle->result() as $row){
    
    $pdf->AddPage();
    
$html = <<<EOF
<h1 align="center">$row->tipo_producto - $row->subtipo_producto</h1>
EOF;

        // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');
    
    $tabla = $this->pedidos_model->previo_pedido_tipo_subtipo($row->id_pedido, $row->tipo, $row->subtipo, $row->subtipo_producto);
$html = <<<EOF
$tabla
EOF;

        // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');
    
    
}





// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('previo_pedido.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
