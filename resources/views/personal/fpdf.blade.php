<?php
use App\Models\Pdf\FPDF;

/**
* 
*/
class pdf extends FPDF
{
	public function Header()
	{
		$this->Image(asset('/assets/images/logo_inicio_tope.png'),13,13,0,0);
    	$this->SetFont('Times','I',9);
    	$fecha=date('d/m/y h:i:s');
		$this->Cell(190,13,$fecha, '0','0','R');
    	$this->Ln(25);

    	$this->SetFont('Times','',16);
    	$this->Cell(200,13,'Listado de Usuarios del Sistema',0,2,'C');
    	$this->Ln(8);
	}

	public function Footer()
	{
		// Posición: a 1,5 cm del final
    	$this->SetY(-15);
    	$this->SetFont('Arial','I',6);
    	$this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
	}

	function LoadData($personals)
	{
    	$data = array();
    	$i=1;
    	foreach($personals as $personal)
        $data[] =  [$i++, $personal->cedula, $personal->nombre." ".$personal->apellido, $personal->telefono, $personal->departamento->departamento, $personal->user->username, $personal->user->email, $personal->status];
    	return $data;
	}

	function FancyTable($header, $data)
	{
	    $w = array(8, 25, 35, 23, 22, 25, 35, 20);
	    $this->SetTextColor(255);
	    $this->SetFont('Times','B',10);
	    for($i=0;$i<count($header);$i++)
	    	$this->Cell($w[$i],11,$header[$i],1,0,'C',true);
	    	$this->SetFillColor(240, 240, 240);
	    	$this->SetTextColor(0);
	    	$this->SetFont('Times','',10);
	    	$this->Ln();
	    	$fill = true;
	    	foreach($data as $row)
	    	{
	        	$this->Cell($w[0],14,number_format($row[0]),'L',0,'C',$fill);
	        	$this->Cell($w[1],14,$row[1],'',0,'C',$fill);
	        	$this->Cell($w[2],14,$row[2],'',0,'C',$fill);
	        	$this->Cell($w[3],14,$row[3],'',0,'C',$fill);
	        	$this->Cell($w[4],14,$row[4],'',0,'C',$fill);
	        	$this->Cell($w[5],14,$row[5],'',0,'C',$fill);
	        	$this->Cell($w[6],14,$row[6],'',0,'C',$fill);
	        	if ($row[7]==1) {
    				$this->Cell($w[7],14,'Activo','R',0,'C',$fill);
    			}
    			else{
    				$this->Cell($w[7],14,'Inactivo','R',0,'C',$fill);
    			}
	        	$this->Ln();
	        	$fill = !$fill;
	    	}
	    $this->Cell(array_sum($w),0,'','T');
	}
}

/*$pdf = new pdf('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(40,10,$contenido);
$pdf->Footer();
$pdf->Output('D',' Reporte.pdf');
*/
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();
$header = array('#', 'Cedula', 'Nombre', 'Telefono', 'Departamento', 'Usuario', 'Correo', 'Estatus');
$data = $pdf->LoadData($personals);
$pdf->SetFont('Times','',11);
$pdf->FancyTable($header,$data);
$pdf->Output('D','Personal.pdf');
/*
use App\Models\dompdf\src\Dompdf;
$html=' 
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Ejemplo de Documento en PDF.</title>
	</head>
	<body>
		<center><h2>Personal con Acceso al Sistema </h2></center>
	</body>
</html>';

$mipdf = new DOMPDF();
$mipdf->set_paper("A4", "portrait");
$mipdf->load_html(utf8_decode($html));
$mipdf->render();
$mipdf->stream('Fichero_Ejemplo.pdf');
*/
?>

