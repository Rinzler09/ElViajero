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
            $img_file = dirname( __FILE__ ) .'/img/favicon.jpg';
            $this->Image($img_file, 85, 8, 40, 45, '', '', '', false, 30, '', false, false, 0);
            $this->SetAutoPageBreak($auto_page_break, $bMargin);
            $this->setPageMark();
	    }
}


//Iniciando un nuevo pdf
//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);
$pdf = new MYPDF('L', 'mm', 'Letter', true, 'UTF-8', false);

//Establecer margenes del PDF
$pdf->SetMargins(5, 35, 5);
$pdf->SetHeaderMargin(20);
$pdf->setPrintFooter(false);
$pdf->setPrintHeader(true); //Eliminar la linea superior del PDF por defecto
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //Activa o desactiva el modo de salto de página automático
 
//Informacion del PDF
$pdf->SetCreator('grupo#3');
$pdf->SetAuthor('grupo#3');
$pdf->SetTitle('Reporte de Ventas');
 
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

$canal ='EL VIAJERO';
$pdf->SetFont('helvetica','B',10); //Tipo de fuente y tamaño de letra
$pdf->SetXY(15, 20); //Margen en X y en Y
$pdf->SetTextColor(204,0,0);
$pdf->Write(0, 'Desarrollador: GRUPO #3');
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
$pdf->Cell(100,6,'LISTA DE VENTAS',0,0,'C');


$pdf->Ln(10); //Salto de Linea
$pdf->SetTextColor(0, 0, 0); 

//Armando la cabecera de la Tabla
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('helvetica','B',8); //La B es para letras en Negritas
$pdf->Cell(10, 6, 'Id', 1, 0, 'C', 1); // Cambié el alto de la celda a 10
$pdf->Cell(40, 6, 'Nombre Cliente', 1, 0, 'C', 1);
$pdf->Cell(35, 6, 'Destino', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Nombre Empleado', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Categoria', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Tipo Viaje', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Fecha Ida', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Fecha Vuelta', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Precio', 1, 1, 'C', 1); // El último argumento cambia a 1 para avanzar a la siguiente línea
/*El 1 despues de  Fecha Ingreso indica que hasta alli 
llega la linea */

$pdf->SetFont('helvetica','',8);


//SQL para consultas Empleados
//$filtroechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
//$filtroechaFin  = date("Y-m-d", strtotime($_POST['fechaFin']));

$filtro = ($_POST['buscar']);

$sqlTrabajadores = "SELECT viajes.viajeId, 
CONCAT(clientes.nombre, ' ', clientes.apellido) AS cliente_nombre, 
destinos.nombre AS destino_nombre, 
CONCAT(empleados.nombre, ' ', empleados.apellidos) AS empleado_nombre, 
categorias.nombre AS categoria_nombre, 
tipoviaje.nombre AS tipoviaje_nombre, 
viajes.fechaSalida, 
viajes.fechaRegreso, 
viajes.precio
FROM viajes
JOIN clientes ON viajes.clienteId = clientes.idcliente
JOIN destinos ON viajes.destinoId = destinos.destinoId
JOIN empleados ON viajes.empleadoId = empleados.idempleado
JOIN categorias ON viajes.categoriaId = categorias.categoriaId
JOIN tipoviaje ON viajes.tipoViajeId = tipoviaje.tipoViajeId
WHERE viajes.viajeId LIKE '%$filtro%' 
    OR CONCAT(clientes.nombre, ' ', clientes.apellido) LIKE '%$filtro%'
    OR destinos.nombre LIKE '%$filtro%'
    OR CONCAT(empleados.nombre, ' ', empleados.apellidos) LIKE '%$filtro%'
    OR categorias.nombre LIKE '%$filtro%'
    OR tipoviaje.nombre LIKE '%$filtro%'
    OR viajes.fechaSalida LIKE '%$filtro%'
    OR viajes.fechaRegreso LIKE '%$filtro%'
    OR viajes.precio LIKE '%$filtro%'";
//$sqlTrabajadores = ("SELECT * FROM trabajadores");
$query = mysqli_query($con, $sqlTrabajadores);

while ($dataRow = mysqli_fetch_array($query)) {
      $pdf->Cell(10,6,$dataRow['viajeId'],1,0,'C');
        $pdf->Cell(40,6,($dataRow['cliente_nombre']),1,0,'C');
        $pdf->Cell(35,6,$dataRow['destino_nombre'],1,0,'C');
        $pdf->Cell(40,6,$dataRow['empleado_nombre'],1,0,'C');
        $pdf->Cell(25,6,$dataRow['categoria_nombre'],1,0,'C');
        $pdf->Cell(30,6,$dataRow['tipoviaje_nombre'],1,0,'C');
        $pdf->Cell(40,6,$dataRow['fechaSalida'],1,0,'C');
        $pdf->Cell(40,6,$dataRow['fechaRegreso'],1,0,'C');
        $pdf->Cell(20,6,$dataRow['precio'],1,1,'C');

        //$pdf->Cell(60,6,$dataRow['direccion'],1,0,'C');
        //$pdf->Cell(35,6,('$ '. $dataRow['sueldo']),1,0,'C');
        //$pdf->Cell(35,6,(date('m-d-Y', strtotime($dataRow['fecha_ingreso']))),1,1,'C');
    }


//$pdf->AddPage(); //Agregar nueva Pagina

$pdf->Output('ReporteVentas_'.date('d_m_y').'.pdf', 'I'); 
// Output funcion que recibe 2 parameros, el nombre del archivo, ver archivo o descargar,
// La D es para Forzar una descarga
