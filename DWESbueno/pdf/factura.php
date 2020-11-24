<?php

//Imprime en una plantilla pdf


require_once('./fpdf/fpdf.php');
require_once('./fpdi/fpdi.php');
require_once('db.php');

class Factura extends FPDF
{
	protected $datos; 
	protected $lineas_factura;
	
	
	function __construct()
	{
		FPDF::__construct();
		$this->datos = array();
		$this->lineas_factura = array();
		
	}
	
	function getByCodigo( $codigo )
	{
		
		$f = new Factura();
		
		$sql = "select * from PDF_FACTURAS where  PDF_FACTURAS.FACTURA_ID =  ?";
		$parameters = array( $codigo );
		$datos = SQLquery( $sql, $parameters );
		
		$f->datos = $datos[0];
		
		// lineas factura
		$sql = "select * from PDF_FACTURAS INNER JOIN PDF_LINEAS_FACTURA ON PDF_FACTURAS.FACTURA_ID = PDF_LINEAS_FACTURA.FACTURA_ID where  PDF_FACTURAS.FACTURA_ID =  ? ORDER BY LINEA_FACTURA_ID";
		$parameters = array( $codigo );
		$datos = SQLquery( $sql, $parameters );
	
		$f->lineas_factura = $datos;
		
		return $f;
		
	}
	
	function cabecera()
	{
		$this->SetXY(10, 10);
		$this->SetFont('Arial','B',10);
		$this->SetFillColor(2,157,116);//Fondo verde de celda
		$this->SetTextColor(240, 255, 240); //Letra color blanco

		$this->Cell(60,7,$this->datos['EMPRESA_NOMBRE'],1, 0 , 'L', true );
		
		$this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
		$this->SetTextColor(3, 3, 3); //Color del texto: Negro
		$bandera = false;
		
		$this->Ln();
		$this->Cell(60,7,'NIF '  .$this->datos['EMPRESA_NIF'],1, 0 , 'L', $bandera );
		$this->Ln();
		$this->Cell(60,7,$this->datos['EMPRESA_DIRECCION'],1, 0 , 'L', $bandera );
		$this->Ln();
		$this->Cell(60,7,$this->datos['EMPRESA_CP'] . ' ' . $this->datos['EMPRESA_LOCALIDAD'] ,1, 0 , 'L', $bandera );
		$this->Ln();
		
		$pos = 40; $step = 7;
		$this->SetXY(120,$pos);
		$this->SetFont('Arial','B',10);
		$this->SetFillColor(2,157,116);//Fondo verde de celda
		$this->SetTextColor(240, 255, 240); //Letra color blanco

		$this->Cell(60,7,'CLIENTE',1, 0 , 'L', true );
		$this->Ln();
		
		
		$this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
		$this->SetTextColor(3, 3, 3); //Color del texto: Negro
		$bandera = false;
		$this->SetXY(120, $pos + $step );
		$this->Cell(60,7,$this->datos['CLIENTE_NOMBRE'],1, 0 , 'L', $bandera );
		$this->SetXY(120, $pos + 2 * $step );
		$this->Cell(60,7,'NIF '  .$this->datos['CLIENTE_NIF'],1, 0 , 'L', $bandera );
		$this->SetXY(120, $pos + 3 * $step );
		$this->Cell(60,7,$this->datos['CLIENTE_DIRECCION'],1, 0 , 'L', $bandera );
		$this->SetXY(120, $pos + 4 * $step );
		$this->Cell(60,7,$this->datos['CLIENTE_CP'] . ' ' . $this->datos['CLIENTE_LOCALIDAD'] ,1, 0 , 'L', $bandera );
	
		
		
		$this->SetXY(10, 40);
	
		$this->Cell(30,7, 'FECHA',1, 0 , 'L', $bandera );
		$this->Cell(30,7, 'NUMERO',1, 0 , 'L', $bandera );
		
		$this->Ln();
		
		$this->Cell(30,7, $this->datos['FECHA'],1, 0 , 'R', $bandera );
		$this->Cell(30,7, $this->datos['FACTURA_ID'],1, 0 , 'R', $bandera );
		
			

	}

	function pies()
	{
		$this->SetXY(10, 250);
		$this->SetFont('Arial','B',10);
		$this->SetFillColor(2,157,116);//Fondo verde de celda
		$this->SetTextColor(240, 255, 240); //Letra color blanco

		$this->Cell(50,7,'TOTAL',1, 0 , 'L', true );
		$this->Cell(130,7,$this->datos[ 'TOTAL'],1, 0 , 'R', true );
		$this->Ln();//Salto de línea para generar otra fila
		
		
		
	}

	function lineas()
	{
		
		$this->SetXY(10, 80);
		$this->SetFont('Arial','B',10);
		$this->SetFillColor(2,157,116);//Fondo verde de celda
		$this->SetTextColor(240, 255, 240); //Letra color blanco

		$this->Cell(25,7,'CODIGO',1, 0 , 'L', true );
		$this->Cell(80,7,'CONCEPTO',1, 0 , 'L', true );
		$this->Cell(25,7,'CANTIDAD',1, 0 , 'L', true );
		$this->Cell(25,7,'PVP',1, 0 , 'L', true );
		$this->Cell(25,7,'IMPORTE',1, 0 , 'L', true );
		$this->Ln();//Salto de línea para generar otra fila
		
		
		$this->SetXY(10,80+7);
		$this->SetFont('Arial','',10);
		$this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
		$this->SetTextColor(3, 3, 3); //Color del texto: Negro
		$bandera = false; //Para alternar el relleno

		foreach (  $this->lineas_factura as $row  )
		{	
				
			$this->Cell(25,7,$row['CONCEPTO_ID'],1, 0 , 'R', $bandera );
			$this->Cell(80,7,$row['CONCEPTO'],1, 0 , 'L', $bandera );
			$this->Cell(25,7,$row['CANTIDAD'],1, 0 , 'R', $bandera );
			$this->Cell(25,7,$row['PVP'],1, 0 , 'R', $bandera );
			$this->Cell(25,7,$row['IMPORTE'],1, 0 , 'R', $bandera );
			$this->Ln();//Salto de línea para generar otra fila
			$bandera = !$bandera;//Alterna el valor de la bandera
		}

		
	}
	function generarPDF()
	{
		
		$this->SetFont('Arial','',14);
		$this->AddPage();
		
		
		$this->cabecera();
		$this->lineas();
		
		$this->pies();
		
		$this->Output();
		//$this->Output("prueba.php", "f");
	}
	

}




function listar_facturas()
{
		$result = $GLOBALS['db']->prepare( "select * from PDF_FACTURAS");
		$result->execute();
		
		while ( $row = $result->fetch() )
		{	
			?>
			<a href="factura.php?factura=<?php echo $row[ 'FACTURA_ID' ] ?>"><?php echo $row[ 'FACTURA_ID' ] ?></a>
			<br>
			<?php
		}
}

/*if( isset( $_GET[ 'factura' ] )) 
{
	listar_facturas();
}
else
{
	
}
*/
$factura = Factura::getByCodigo( 1 );

$factura->generarPDF();
?>


