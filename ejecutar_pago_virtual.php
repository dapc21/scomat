<?php
require_once "procesos.php";
	$cable=conectar("Postgres",'localhost','postgres','123456','oficina_virtual');
	$cable2=conectar("Postgres",'localhost','postgres','123456','oficina_virtual');
	$acceso=conectar("Postgres",'localhost','postgres','123456','saeco_cablehogar');

//$acceso=conexion();
$id_contrato=$_GET['id_contrato'];
//echo ";$id_contrato";
$resp=conciliar_pago_cli($acceso);
registrar_pago_virtual($acceso,$id_contrato);
actualizar_datos_oficina_virtual($acceso,$cable,$id_contrato);
if($resp==true){
	echo "Pago procesado con exito";
}else{
	echo "Pago pendiente por procesar.";
}
?>