<?php

tcpdf();
global $_logo, $_titulo, $_titulo2, $_subtitulo, $_codigo, $_cliente, $_fecha;
$_logo = $logo;
$_titulo = $titulo;
$_titulo2 = $titulo2;
$_subtitulo = $subtitulo;
$_codigo = $codigo;
$_cliente = $cliente;
$_fecha = $fecha;
$i = 0;


class MYPDF extends TCPDF {
        // Page footer
        public function Footer() {
            // Position at 15 mm from bottom
            $this->SetY(-10);
            // Set font
            $this->SetFont('helvetica', 'I', 8);
            $fechaHora = "	Fecha y hora de impresión ".date("d/m/Y")." - ".date("H:i:s");
            $pagina = "	www.kamelottech.com";
            // Page number
            if (empty($this->pagegroups)) {
                    $pagenumtxt = ' Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages();
            } else {
                    $pagenumtxt = ' Página '.$this->getPageNumGroupAlias().' de '.$this->getPageGroupAlias();
            }
            
            $this->Cell(67, 0, $fechaHora, 'T', $ln=0, 'C', 0, '', 0, false, 'T', 'C');
            $this->Cell(67, 0, $pagenumtxt, 'T', $ln=0, 'C', 0, '', 0, false, 'T', 'C');
            $this->Cell(50, 0, $pagina, 'T', $ln=0, 'C', 0, '', 0, false, 'T', 'C');
        }

        public function Header() {
            global $_logo, $_titulo, $_titulo2, $_subtitulo, $_codigo, $_cliente, $_fecha;
            
            $this->SetFont('helvetica', 'B', 11);
            //<img src=\"".$logo."\"/>
            $tblReporte = "<table class=\"stlTabla\" cellpadding=\"2\"  border=\"1\" align=\"center\">
                            <tr>"
                                . "<th rowspan=\"3\"><img src=\"".$_logo."\"/></th>"
                                . "<th colspan=\"2\">$_cliente</th>"
                                . "<th>$_codigo</th>
                            </tr>
                            <tr>"
                                . "<th colspan=\"2\">$_subtitulo</th>"
                                . "<th>Vigencia</th>
                            </tr>
                            <tr>"
                                . "<th colspan=\"2\">$_titulo2</th>"
                                . "<th>$_fecha</th>
                            </tr>
                        </table>";
            $this->writeHTML($tblReporte, true, false, false, false, '');
        }
}

$pdf = new MYPDF("PORTRAIT", PDF_UNIT, 'LETTER', true, 'UTF-8', false);

//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'FOLIO', true, 'UTF-8', false); //LETTER   LEGAL
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kamelot');
$pdf->SetTitle($titulo);
$pdf->SetSubject('Historia Clinica');
$pdf->SetKeywords('KAMELOT', $cliente);
set_time_limit(0);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->startPageGroup();

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetFooterMargin(1);
//set margins
$pdf->setPrintHeader(true);
$pdf->SetMargins(20, 30, 20);
$pdf->SetHeaderMargin(7);
// remove default header

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
//$pdf->setLanguageArray($l);

set_time_limit(0);

$pdf->SetFont('helvetica', 'B', 11);

$apertura_hc = true;
// HISTORIA CLINICA GENERAL


    $pdf->SetFont('helvetica', 'B', 11);
    
    // INICIO IDENTIFICACIÓN PACIENTE
    $pdf->AddPage();

    $tblReporte = "<table class=\"stlTabla\" cellpadding=\"2\"  border=\"1\" align=\"center\">
                    <tr>"
                        . "<th colspan=\"2\" bgcolor=\"#d8d8d8\">NÚMERO DE HISTORIA CLÍNICA:</th>"
                        . "<th colspan=\"3\">".$paciente['historia']."</th>
                    </tr>
                </table>";
    $pdf->writeHTML($tblReporte, true, false, false, false, '');

    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(48, 6, 'NOMBRE DEL PACIENTE: ', 0, 0, '');
    $pdf->Cell(55, 6, $paciente['nombre1'].' '.$paciente['nombre2'].' '.$paciente['apellido1'].' '.$paciente['apellido2'], 'B', 0, '');
    
    $pdf->Cell(40, 6, 'EDAD: ', 0, 0, 'R');
    if(count($edad) > 0){
        $pdf->Cell(25, 6,  $edad, 1, 0, '');
    }
    else{
        $pdf->Cell(15, 6,  '', 1, 0, '');
    }
    
    $pdf->Ln(8);
    $pdf->Cell(40, 6, 'TIPO IDENTIFICACIÓN: ', 0, 0, '');
    $pdf->Cell(60, 6, $paciente['tc_documento'], 'B', 0, '');
    $pdf->Cell(45, 6, 'IDENTIFICACIÓN: ', 0, 0, 'R');
    $pdf->Cell(25, 6, $paciente['identificacion'], 'B', 0, '');

    $pdf->Ln(10);
    
    $pdf->SetFont('helvetica', 'B', 11);

    $pdf->SetFillColor(216, 216, 216);
    $pdf->Cell(120, 6, 'TRATAMIENTO', 1, 1, '', 1);
    $pdf->SetFont('helvetica', '', 11);
    $pdf->Ln(4);
    $pdf->MultiCell(70, 6, $consulta['tratamiento'], 0, '', '0', 0, '', '', true);
    
    $pdf->Output($titulo, 'I');