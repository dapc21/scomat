<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$tipo_caja=verCajaPrincipal($acceso);
//echo $tipo_caja;	
$x = new EyeDataGrid($db);

$id_franq = $_GET['id_franq'];
$id_f = $_SESSION["id_franq"];  
if($id_f!='0'){
	$consult=" and id_franq='$id_f'";
}else{
		$consult=" and id_franq='$id_franq'";
	
}
//echo $consult;
//echo $consult;
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

$dato=lectura($acceso,"select distinct fecha_factura,nro_factura from pagos where fecha_factura between '$desde' and '$hasta' order by fecha_factura, nro_factura limit 10000000");
	$k=0;
	$inc=1;
	$fecha='';
		ECHO "<span class='fuente'>";
		for($i=0;$i<count($dato);$i++)
		{
			$nro_factura=trim($dato[$i]['nro_factura']);
			
			if($k!=$nro_factura){
				$k=$nro_factura;
				if($i!=0){
					$fecha_factura=trim($dato[$i]['fecha_factura']);
					if($fecha!=$fecha_factura){
						$fecha=$fecha_factura;
						echo "<br><br>FECHA: ".formatofecha($fecha_factura);
					}
			
					ECHO "<br>$inc: $nro_factura";
					$inc++;
				}
				$k++;
			}
			else{
				$k++;
			}
		}	
		ECHO "</span>";
		
?>
