<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace sam0786\pdf;
use FPDF;

class PDF extends FPDF
{
 public $id_folio='';
 public $data_serv='';
 public $Nserv = '';
 
	
 function Header()
{
	//global $id;
	
    // Logo
    $this->Image('images/logo.jpg',10,3,100);
	$this->Image('images/footer.jpg',110,216,100);
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    
	$this->Ln(15);
	
    // Thickness of frame (1 mm)
	$this->SetDrawColor(219,230,176);
    $this->SetLineWidth(1);
	//$this->SetFillColor(182, 205, 97);
	$this->Line(10,22,196,22);
	
	$this->Cell(106);
	 $this->SetLineWidth(0);
    // Título
	$this->SetFillColor(182, 205, 97);
    $this->Cell(80,6,'Orden de servicio No. '.$this->Nserv,1,0,'C', true);
	$this->SetFont('Arial','',10);
    $this->Ln(6);
	$this->Cell(106);	
	$this->Cell(20,6,'Folio ticket',1,0,'L');
	$this->Cell(60,6, $this->data_serv,1,0,'C');
	$this->Ln(6);
	$this->Cell(106);	
	$this->Cell(20,6,'Folio serv',1,0,'L');
	$this->Cell(60,6, $this->id_folio,1,0,'C');
	
	
	$this->Ln(6);
	$this->Cell(106);	
	$this->Cell(20,6,'Fecha',1,0,'L');
	$this->Cell(60,6,date('d/m/Y'),1,0,'C');	
	
	$this->Ln(10);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-22);
	$this->SetTextColor(128, 128, 128);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
	
    $this->Cell(0,10,utf8_decode('Nombre empresa'),0,0,'L');
	$this->Ln(3);
	$this->Cell(0,10,utf8_decode('Lugar Pais'),0,0,'L');
	$this->Ln(3);
	$this->Cell(0,10,'Tel (000) 000-0000',0,0,'L');
	$this->Ln(5);
	$this->Cell(0,10,'pagina.web.com',0,0,'L');
	 $this->Cell(10,10,$this->PageNo()."/{nb}",0,0,'C');     
	
}

function datosHorizontal($datos)
    {
        $this->SetXY(10, 90);
        $this->SetFont('Arial','',10);
        $bandera = false; //Para alternar el relleno
		$fin = count($datos);
		$i = 1;
        foreach($datos as $fila)
        {
            //El parámetro badera dentro de Cell: true o false
            //true: Llena  la celda con el fondo elegido
            //false: No rellena la celda
			if(isset($fila['concepto']) and isset($fila['cantidad']) and isset($fila['precio']) and isset($fila['importe'])){
				if($fin == $i){
					$this->Cell(82,7, $fila['concepto'],'L, R , B', 0 , 'L');
					$this->Cell(35,7, $fila['cantidad'],'L, R , B', 0 , 'L');
					$this->Cell(35,7, '$'.number_format($fila['precio'], 2),'L, R , B', 0 , 'L');
					$this->Cell(35,7, '$'.number_format($fila['importe'], 2),'L, R , B', 0 , 'C');
					$this->Ln();//Salto de línea para generar otra fila
				}else{
					$this->Cell(82,7, $fila['concepto'],'L, R', 0 , 'L');
					$this->Cell(35,7, $fila['cantidad'],'L, R', 0 , 'L');
					$this->Cell(35,7, '$'.number_format($fila['precio'], 2),'L, R', 0 , 'L');
					$this->Cell(35,7, '$'.number_format($fila['importe'], 2),'L, R', 0 , 'C');
					$this->Ln();//Salto de línea para generar otra fila			
				}
			}
            
            $bandera = !$bandera;//Alterna el valor de la bandera
			$i ++;
        }
    }
 
    function tablaHorizontal($datosHorizontal)
    {
        //$this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }
	
}

?>
