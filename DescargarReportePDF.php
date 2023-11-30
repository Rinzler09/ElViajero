<?php
require_once('tcpdf/tcpdf.php'); //Llamando a la Libreria TCPDF
require_once('config.php'); //Llamando a la conexión para BD
date_default_timezone_set('America/Tegucigalpa');


ob_end_clean(); //limpiar la memoria


class MYPDF extends TCPDF{
      
    	public function Header() {
            $bMargin = $this->getBreakMargin();
            $auto_page_break = $this->AutoPageBreak;
            $this->SetAutoPageBreak(false, 0);
            $img_file = dirname( __FILE__ ) .'/icons/logo.png';
            $this->Image($img_file, 85, 8, 40, 45, '', '', '', false, 30, '', false, false, 0);
            $this->SetAutoPageBreak($auto_page_break, $bMargin);
            $this->setPageMark();
	    }
}


//Iniciando un nuevo pdf
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);
 
//Establecer margenes del PDF
$pdf->SetMargins(20, 35, 25);
$pdf->SetHeaderMargin(20);
$pdf->setPrintFooter(false);
$pdf->setPrintHeader(true); //Eliminar la linea superior del PDF por defecto
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //Activa o desactiva el modo de salto de página automático
 
//Informacion del PDF
$pdf->SetCreator('ediaz');
$pdf->SetAuthor('ediaz');
$pdf->SetTitle('Reporte de Empleados');
 
/** Eje de Coordenadas
 *          Y
 *          -
 *          - 
 *          -
 *  X ------------- X
 *          -
 *          -
 *          -
 *          Y
 * 
 * $pdf->SetXY(X, Y);
 */

//Agregando la primera página
$pdf->AddPage();
$pdf->SetFont('helvetica','B',10); //Tipo de fuente y tamaño de letra
$pdf->SetXY(150, 20);
$pdf->Write(0, 'Código: REM00001');
$pdf->SetXY(150, 25);
$pdf->Write(0, 'Fecha: '. date('d-m-Y'));
$pdf->SetXY(150, 30);
$pdf->Write(0, 'Hora: '. date('h:i A'));

$canal ='UTH';
$pdf->SetFont('helvetica','B',10); //Tipo de fuente y tamaño de letra
$pdf->SetXY(15, 20); //Margen en X y en Y
$pdf->SetTextColor(204,0,0);
$pdf->Write(0, 'Desarrollador: Edwin Diaz');
$pdf->SetTextColor(0, 0, 0); //Color Negrita
$pdf->SetXY(15, 25);
$pdf->Write(0, 'Empresa: '. $canal);



$pdf->Ln(35); //Salto de Linea
$pdf->Cell(40,26,'',0,0,'C');
/*$pdf->SetDrawColor(50, 0, 0, 0);
$pdf->SetFillColor(100, 0, 0, 0); */
$pdf->SetTextColor(34,68,136);
//$pdf->SetTextColor(255,204,0); //Amarillo
//$pdf->SetTextColor(34,68,136); //Azul
//$pdf->SetTextColor(153,204,0); //Verde
//$pdf->SetTextColor(204,0,0); //Marron
//$pdf->SetTextColor(245,245,205); //Gris claro
//$pdf->SetTextColor(100, 0, 0); //Color Carne
$pdf->SetFont('helvetica','B', 15); 
$pdf->Cell(100,6,'LISTA DE EMPLEADOS',0,0,'C');


$pdf->Ln(10); //Salto de Linea
$pdf->SetTextColor(0, 0, 0); 

//Armando la cabecera de la Tabla
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('helvetica','B',12); //La B es para letras en Negritas
$pdf->Cell(20,6,'Id',1,0,'C',1);
$pdf->Cell(50,6,'Nombre',1,0,'C',1);
$pdf->Cell(50,6,'Apellidos',1,0,'C',1);
$pdf->Cell(20,6,'Edad',1,0,'C',1);
$pdf->Cell(30,6,'Telefono',1,1,'C',1); 
//$pdf->Cell(35,6,'Direccion',1,1,'C',1); 
/*El 1 despues de  Fecha Ingreso indica que hasta alli 
llega la linea */

$pdf->SetFont('helvetica','',10);


//SQL para consultas Empleados
//$fechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
//$fechaFin  = date("Y-m-d", strtotime($_POST['fechaFin']));

$filtro = ($_POST['buscar']);

$sqlTrabajadores = "SELECT * FROM empleados WHERE idempleado like '%$filtro%' OR nombre like '%$filtro%' OR apellidos like '%$filtro%' OR edad like '%$filtro%' OR telefono like '%$filtro%'";
//$sqlTrabajadores = ("SELECT * FROM trabajadores");
$query = mysqli_query($con, $sqlTrabajadores);

while ($dataRow = mysqli_fetch_array($query)) {
    $pdf->Cell(20,6,$dataRow['idempleado'],1,0,'C');
        $pdf->Cell(50,6,($dataRow['nombre']),1,0,'C');
        $pdf->Cell(50,6,$dataRow['apellidos'],1,0,'C');
        $pdf->Cell(20,6,$dataRow['edad'],1,0,'C');
        $pdf->Cell(30,6,$dataRow['telefono'],1,1,'C');
       // $pdf->Ln();
        //$pdf->Cell(60,6,$dataRow['direccion'],1,0,'C');
        //$pdf->Cell(35,6,('$ '. $dataRow['sueldo']),1,0,'C');
        //$pdf->Cell(35,6,(date('m-d-Y', strtotime($dataRow['fecha_ingreso']))),1,1,'C');
    }


//$pdf->AddPage(); //Agregar nueva Pagina

$pdf->Output('ReporteEmpleados_'.date('d_m_y').'.pdf', 'I'); 
// Output funcion que recibe 2 parameros, el nombre del archivo, ver archivo o descargar,
// La D es para Forzar una descarga