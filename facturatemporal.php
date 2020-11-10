<?php

require '../modelo/factura.php';
require '../config/conexion.php';
require '../assets/includes/libs/fpdf.php';
require './StarterControlador.php';

$is = new StarterControlador();

if (empty($_SESSION['nombres'])) {
    $is->Logueate();
}

class ExpFactura extends Factura{
    
    public $pdf;
    public $files;

    public function __construct(){
        $this->pdf = new FPDF();
        $this->files = new Factura();
    }

    public function Documento()
    {
        $this->pdf->AddPage();
        $this->Header();
        $this->PacFacturaBD();
        $this->pdf->Output();
        
    }

    public function Header(){
        $this->pdf->SetFont('arial','B',12);
        $this->pdf->Cell(100, 12, utf8_decode('desarrollador'));
        $this->pdf->ln(5);
        $this->pdf->Cell(200, 12, 'Médico pedíatra');
        $this->pdf->ln(5);
        $this->pdf->Cell(100, 12, utf8_decode('centro comercial'));
        $this->pdf->ln(5);
        $this->pdf->Cell(100, 12, utf8_decode('29009 - Málaga'));
        $this->pdf->ln(5);
        $this->pdf->Cell(100, 12, 'DNI');
        $this->pdf->ln(5);
        $this->pdf->Cell(100, 12, utf8_decode('datos fiscales'));
        $this->pdf->ln(10);
    }
    
    public function PacFacturaBD(){
        #$fila = $this->files->DatosFactura();
        $this->pdf->SetFont('Arial','B',12);
        $this->pdf->Cell(190,10,utf8_decode('eduardo antonio'),0,0,'R');
        $this->pdf->Ln(5);
        $this->pdf->Cell(190,10,utf8_decode('Calle larios, 4'),0,0,'R');
        $this->pdf->Ln(5);
        $this->pdf->Cell(190,10,utf8_decode('29011 - Málaga'),0,0,'R');
        $this->pdf->Ln(5);
        $this->pdf->Cell(190,10,'DNI: 25048422 L',0,0,'R');
        $this->pdf->Ln(20);
    }
    
    public function Variables($pac, $nFac){
        $this->numFactura = $nFac;
        $this->idPaciente = $pac;
        $this->Documento();
    }
}

if (isset($_GET['accion']) && $_GET['accion'] == 'imprimir') {
    if (!empty($_GET['pac']) && !empty($_GET['fac'])) {
        $id = $_GET['pac'];
        $fac = $_GET['fac'];
        $doc =  new ExpFactura();
        $doc->Variables($id, $fac);
    }else{
        echo "error";
    }
}



