<?php
//archivo destinado a procesar y devolver datos o informacion relaciona con la aplicacion
session_start();
//require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
$cadena=$_POST['d'];
$valor=explode("=@",$cadena);
$clase=$valor[0];

//echo ":".$_SESSION["autenticacion"].":".$_SESSION["ini_u"].":";
if($_SESSION["autenticacion"]!="On"){
	
	if($clase=='Manejador')
		echo Manejador();
	else
		echo "SecurityFalse";
}
else{
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
$cadena=$_POST['d'];
$valor=explode("=@",$cadena);
$clase=$valor[0];
//echo ":$ini_u:";
switch($clase)
{
	
	case asig_falla_rep:
		echo  asig_falla_rep($acceso,$valor[1],$valor[2],$valor[3],$valor[4]);
		break;
	case procesar_list_denuncia:
		echo  procesar_list_denuncia($acceso,$valor[1],$valor[2],$valor[3]);
		break;
	case procesar_list_reclamo:
		echo  procesar_list_reclamo($acceso,$valor[1],$valor[2],$valor[3]);
		break;
	case rec_falla_rep:
		echo  rec_falla_rep($acceso,$valor[1],$valor[2],$valor[3],$valor[4]);
		break;
	case verificaSMS:
		echo  verificaSMS($acceso);
		break;
	case eliminar_sms_enviar:
		echo  eliminar_sms_enviar($acceso,$valor[1]);
		break;
	case eliminar_email_enviar:
		echo  eliminar_email_enviar($acceso,$valor[1]);
		break;
	case eliminar_todos_sms_enviar:
		echo  eliminar_todos_sms_enviar($acceso);
		break;
	case eliminar_todos_email_enviar:
		echo  eliminar_todos_email_enviar($acceso);
		break;
	case eliminar_sms_enviados:
		echo  eliminar_sms_enviados($acceso);
		break;
	case eliminar_email_enviados:
		echo  eliminar_email_enviados($acceso);
		break;
	case marcar_como_sms_enviar:
		echo  marcar_como_sms_enviar($acceso,$valor);
	case marcar_como_email_enviar:
		echo  marcar_como_email_enviar($acceso,$valor);
	case marcar_como_admin_sms_enviar:
		echo  marcar_como_admin_sms_enviar($acceso,$valor);
	case marcar_list_denuncia:
		echo  marcar_list_denuncia($acceso,$valor);
	case marcar_list_reclamo:
		echo  marcar_list_reclamo($acceso,$valor);
	case marcar_list_falla:
		echo  marcar_list_falla($acceso,$valor);
		break;
	
	default:
		echo titulo("El contenido de ".$clase." no esta Construdio Disculpe las molestias");
}
}//security

function marcar_list_falla($acceso,$valor){
	$status_list=$valor[1];
//	echo ":$status_list:";
	for($i=2;$i<count($valor);$i++){
		$id_sms=$valor[$i];
		if($status_list=="ELIMINAR"){
			$acceso->objeto->ejecutarSql("delete from sms where id_sms='$id_sms'");
		}
		else{
			$acceso->objeto->ejecutarSql("update sms set status_list='$status_list' where id_sms='$id_sms'");
		}
	}
	return;
}
function marcar_list_reclamo($acceso,$valor){
	$status_list=$valor[1];
//	echo ":$status_list:";
	for($i=2;$i<count($valor);$i++){
		$id_sms=$valor[$i];
		if($status_list=="ELIMINAR"){
			$acceso->objeto->ejecutarSql("delete from sms where id_sms='$id_sms'");
		}
		else{
			$acceso->objeto->ejecutarSql("update sms set status_list='$status_list' where id_sms='$id_sms'");
		}
	}
	return;
}
function marcar_list_denuncia($acceso,$valor){
	$status_list=$valor[1];
	//echo ":$status_list:";
	for($i=2;$i<count($valor);$i++){
		$id_sms=$valor[$i];
		if($status_list=="ELIMINAR"){
			$acceso->objeto->ejecutarSql("delete from sms where id_sms='$id_sms'");
		}
		else{
			$acceso->objeto->ejecutarSql("update sms set status_list='$status_list' where id_sms='$id_sms'");
		}
	}
	return;
}
function marcar_como_sms_enviar($acceso,$valor){
	$status_sinc=$valor[1];
	for($i=2;$i<count($valor);$i++){
		$id_sinc=$valor[$i];
		if($status_sinc=="ELIMINAR"){
			$acceso->objeto->ejecutarSql("delete from sms_sinc where id_sinc='$id_sinc'");
		}
		else{
			$acceso->objeto->ejecutarSql("update sms_sinc set status_sinc='$status_sinc' where id_sinc='$id_sinc'");
		}
	}
	return;
}

function marcar_como_email_enviar($acceso,$valor){
	$status_e_sinc=$valor[1];
	for($i=2;$i<count($valor);$i++){
		$id_e_sinc=$valor[$i];
		if($status_e_sinc=="ELIMINAR"){
			$acceso->objeto->ejecutarSql("delete from email_sinc where id_e_sinc='$id_e_sinc'");
		}
		else{
			$acceso->objeto->ejecutarSql("update email_sinc set status_e_sinc='$status_e_sinc' where id_e_sinc='$id_e_sinc'");
		}
	}
	return;
}
function marcar_como_admin_sms_enviar($acceso,$valor){
	$tipo_sms=$valor[1];
	for($i=2;$i<count($valor);$i++){
		$id_sms=$valor[$i];
		if($tipo_sms=="ELIMINAR"){
			$acceso->objeto->ejecutarSql("delete from sms where id_sms='$id_sms'");
		}else if($tipo_sms=='SIN LEER'){
			ECHO "update sms set  tipo_sms='DELIVER', status_sms='UNREAD' where id_sms='$id_sms';";
			$acceso->objeto->ejecutarSql("update sms set  tipo_sms='DELIVER', status_sms='UNREAD' where id_sms='$id_sms'");
		}else if($tipo_sms=='LEIDOS'){
			$acceso->objeto->ejecutarSql("update sms set  tipo_sms='DELIVER', status_sms='READ' where id_sms='$id_sms'");
		}else if($tipo_sms=='RECIBIDOS'){
			$acceso->objeto->ejecutarSql("update sms set  tipo_sms='DELIVER' where id_sms='$id_sms'");
		}else if($tipo_sms=='ENVIADOS'){
			$acceso->objeto->ejecutarSql("update sms set  tipo_sms='SUBMIT', status_sms='SENT' where id_sms='$id_sms'");
		}
	}
	return;
}
function eliminar_email_enviados($acceso){
	$acceso->objeto->ejecutarSql("delete from email_sinc where status_e_sinc='TRUE'");
	return;
}
function eliminar_sms_enviados($acceso){
	$acceso->objeto->ejecutarSql("delete from sms_sinc where status_sinc='TRUE'");
	return;
}
function eliminar_todos_sms_enviar($acceso){
	
	//echo "select *from ordenes_tecnicos where id_contrato='$id_contrato' and status_orden='CREADO'";
	$acceso->objeto->ejecutarSql("delete from sms_sinc");
	return;
}
function eliminar_todos_email_enviar($acceso){
	
	//echo "select *from ordenes_tecnicos where id_contrato='$id_contrato' and status_orden='CREADO'";
	$acceso->objeto->ejecutarSql("delete from email_sinc");
	return;
}
function eliminar_sms_enviar($acceso,$id_sinc){
	
	//echo "select *from ordenes_tecnicos where id_contrato='$id_contrato' and status_orden='CREADO'";
	$acceso->objeto->ejecutarSql("delete from sms_sinc where id_sinc='$id_sinc'");
	return;
}
function eliminar_email_enviar($acceso,$id_e_sinc){
	$acceso->objeto->ejecutarSql("delete from email_sinc where id_e_sinc='$id_e_sinc'");
	return;
}
function verificaSMS($acceso){
	
	//echo "select *from ordenes_tecnicos where id_contrato='$id_contrato' and status_orden='CREADO'";
	$acceso->objeto->ejecutarSql("select count(*) as num from sms where status_sms='UNREAD' and tipo_sms='DELIVER' ");
	$row=row($acceso);
		return "=@".trim($row["num"]);
}
function rec_falla_rep($acceso,$omitir,$id_det_orden,$resp,$cade){
	$valor=explode("-Class-",$cade);
	
	if($omitir=="false"){
			require_once "Clases/sms.php";
			$objeto=new sms();
	}
	
	for($i=0;$i<count($valor)-1;$i++){
		$id_sms=$valor[$i];
		$acceso->objeto->ejecutarSql("select *from sms where id_sms='$id_sms'");
		if($row=row($acceso)){
			$id_contrato=trim($row["id_contrato"]);
			$telefono_sms=trim($row["telefono_sms"]);
		}
		$acceso->objeto->ejecutarSql("Update sms Set status_list='RECHAZADO' Where id_sms='$id_sms'");
		
		if($omitir=="false"){
			echo ":$telefono_sms,$resp:";
			$objeto->EnviarSMSUnico($acceso,$telefono_sms,$resp);
		}
	}
}

function procesar_list_reclamo($acceso,$omitir,$resp,$cade){
	$valor=explode("-Class-",$cade);
	for($i=0;$i<count($valor)-1;$i++){
		$id_sms=$valor[$i];
		$acceso->objeto->ejecutarSql("select *from sms where id_sms='$id_sms'");
		if($row=row($acceso)){
			$telefono_sms=trim($row["telefono_sms"]);
			$id_contrato=trim($row["id_contrato"]);
		}
		$acceso->objeto->ejecutarSql("Update sms Set status_list='REVISADO' Where id_sms='$id_sms'");
		if($omitir=="false"){
			require_once "Clases/sms.php";
			$objeto=new sms();
			$objeto->EnviarSMSUnico($acceso,$telefono_sms,$resp,$id_contrato);
		}
	}
}

function procesar_list_denuncia($acceso,$omitir,$resp,$cade){
	$valor=explode("-Class-",$cade);
	for($i=0;$i<count($valor)-1;$i++){
		$id_sms=$valor[$i];
		$acceso->objeto->ejecutarSql("select *from sms where id_sms='$id_sms'");
		if($row=row($acceso)){
			$telefono_sms=trim($row["telefono_sms"]);
			$id_contrato=trim($row["id_contrato"]);
		}
		$acceso->objeto->ejecutarSql("Update sms Set status_list='REVISADO' Where id_sms='$id_sms'");
		if($omitir=="false"){
			require_once "Clases/sms.php";
			$objeto=new sms();
			$objeto->EnviarSMSUnico($acceso,$telefono_sms,$resp,$id_contrato);
		}
	}
}

function asig_falla_rep($acceso,$omitir,$id_det_orden,$resp,$cade){
	$valor=explode("-Class-",$cade);
	
	if($omitir=="false"){
			require_once "Clases/sms.php";
			$objeto=new sms();
	}
	
	for($i=0;$i<count($valor)-1;$i++){
		$id_sms=$valor[$i];
		//echo ":$id_sms:";
		$acceso->objeto->ejecutarSql("select *from sms where id_sms='$id_sms'");
		if($row=row($acceso)){
			$id_contrato=trim($row["id_contrato"]);
			$telefono_sms=trim($row["telefono_sms"]);
		}
		
session_start();
						$id_fr = $_SESSION["id_franq"]; 
						$serie='';
						if($id_fr!='0'){
							$cons=" and  id_franq='$id_fr'";
							$acceso->objeto->ejecutarSql("select serie from franquicia where id_franq='$id_fr'");
							$row=row($acceso);
							$serie= trim($row["serie"]);
						}
						else{
							$cons=" and  id_franq='1'";
						}
						
						$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos, contrato,vista_ubica where  ordenes_tecnicos.id_contrato = contrato.id_contrato and contrato.id_calle=vista_ubica.id_calle  ORDER BY num_o desc  LIMIT 1 offset 0 "); 
						$id_orden = verNumero($acceso,"id_orden");
		$id_persona=verPrimerTecnico($acceso);
		$fecha=date("Y-m-d");
		
		require_once "../Clases/ordenes_tecnicos.php";
		$obj=new ordenes_tecnicos($id_orden,$fecha,$id_det_orden,$fecha,$fecha,'REPORTADA POR SMS','','CREADO',$id_contrato,'NORMAL');
		$obj->incluirordenes_tecnicos($acceso);
						
		$acceso->objeto->ejecutarSql("Update sms Set status_list='ASIGNADO' Where id_sms='$id_sms'");
		
		if($omitir=="false"){
			//echo ":$telefono_sms,$resp:";
			$objeto->EnviarSMSUnico($acceso,$telefono_sms,$resp,$id_contrato);
		}
	}
}
?>