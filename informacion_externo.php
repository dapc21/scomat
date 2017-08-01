<?php
session_start();
$ini_u = $_SESSION["ini_u"];  
$cadena=$_POST['d'];
$valor=explode("=@",$cadena);
$clase=$valor[0];

if($_SESSION["autenticacion"]!="On"){
		echo "SecurityFalse";
}
else{
	require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
	$cadena=$_POST['d'];
	$valor=explode("=@",$cadena);
	$clase=$valor[0];
	
	switch($clase)
	{
		case add_zona:
			$id_ciudad=trim($valor[2]);
			$nombre_zona=trim($valor[1]);
			
			 $acceso->objeto->ejecutarSql("select *from zona  where (id_zona ILIKE '$ini_u%') ORDER BY id_zona desc"); 
			 $id_zona = $ini_u.verCo($acceso,"id_zona");
			 require_once "Clases/trans_pago.php";
			$obj_trans=new trans_pago();
			$obj_trans->begin($acceso);
			//echo "insert into zona(id_zona,nro_zona,id_ciudad,nombre_zona,id_franq) values ('$id_zona','0','$id_ciudad','$nombre_zona','1')";
			 $acceso->objeto->ejecutarSql("insert into zona(id_zona,nro_zona,id_ciudad,nombre_zona,id_franq) values ('$id_zona','0','$id_ciudad','$nombre_zona','1')");			
			$obj_trans->commit($acceso);	
			ECHO "=@$id_zona=@$nombre_zona";
			break;
			
		case add_sector:
			$id_zona=trim($valor[2]);
			$nombre_sector=trim($valor[1]);
			 $acceso->objeto->ejecutarSql("select *from sector  where (id_sector ILIKE '$ini_u%') ORDER BY id_sector desc"); 
			 $id_sector = $ini_u.verCo($acceso,"id_sector");
			 
			 require_once "Clases/trans_pago.php";
			$obj_trans=new trans_pago();
			$obj_trans->begin($acceso);
			//echo "insert into zona(id_zona,nro_zona,id_ciudad,nombre_zona,id_franq) values ('$id_zona','0','$id_ciudad','$nombre_zona','1')";
			 $acceso->objeto->ejecutarSql("insert into sector(id_sector,nro_sector,id_zona,nombre_sector,n_sector,afiliacion) values ('$id_sector','0','$id_zona','$nombre_sector','','')");			
			$obj_trans->commit($acceso);	
			ECHO "=@$id_sector=@$nombre_sector";
			break;
			
		case add_calle:
			$id_sector=trim($valor[2]);
			$nombre_calle=trim($valor[1]);
			 $acceso->objeto->ejecutarSql("select *from calle  where (id_calle ILIKE '$ini_u%') ORDER BY id_calle desc"); 
			 $id_calle = $ini_u.verCo($acceso,"id_calle");
			 
			 require_once "Clases/trans_pago.php";
			$obj_trans=new trans_pago();
			$obj_trans->begin($acceso);
			$acceso->objeto->ejecutarSql("insert into calle(id_calle,nro_calle,id_sector,nombre_calle) values ('$id_calle','0','$id_sector','$nombre_calle')");		
			$obj_trans->commit($acceso);	
			ECHO "=@$id_calle=@$nombre_calle";
			break;
			
		case add_edificio:
			$id_sector=trim($valor[2]);
			$edificio=trim($valor[1]);
			 $acceso->objeto->ejecutarSql("select *from edificio  where (id_edif ILIKE '$ini_u%') ORDER BY id_edif desc"); 
			 $id_edif = $ini_u.verCo($acceso,"id_edif");
			 
			 require_once "Clases/trans_pago.php";
			$obj_trans=new trans_pago();
			$obj_trans->begin($acceso);
			$acceso->objeto->ejecutarSql("insert into edificio(id_edif,id_sector,edificio) values ('$id_edif','$id_sector','$edificio')");			
			$obj_trans->commit($acceso);	
			ECHO "=@$id_edif=@$edificio";
			break;
			
		case add_urb:
			$id_sector=trim($valor[2]);
			$nombre_urb=trim($valor[1]);
			 $acceso->objeto->ejecutarSql("select *from urbanizacion  where (id_urb ILIKE '$ini_u%') ORDER BY id_urb desc"); 
			 $id_urb = $ini_u.verCo($acceso,"id_urb");
			 
			 require_once "Clases/trans_pago.php";
			$obj_trans=new trans_pago();
			$obj_trans->begin($acceso);
			$acceso->objeto->ejecutarSql("insert into urbanizacion(id_urb,id_sector,nombre_urb) values ('$id_urb','$id_sector','$nombre_urb')");		
			$obj_trans->commit($acceso);	
			ECHO "=@$id_urb=@$nombre_urb";
			break;
		default:
			echo titulo("El contenido de ".$clase." no está construídodo, Disculpe las molestias");
	}
}

?>