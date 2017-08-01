<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);


$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$id_franq = $_GET['id_franq'];
$id_esta = $_GET['id_esta'];
$id_mun = $_GET['id_mun'];
$id_ciudad = $_GET['id_ciudad'];
$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$urbanizacion = $_GET['urbanizacion'];
$id_calle = $_GET['id_calle'];
$id_tll = $_GET['id_tll'];
$id_trl = $_GET['id_trl'];
$id_drl = $_GET['id_drl'];
$login_resp = $_GET['login_resp'];
$status_contrato = $_GET['status_contrato'];
	$esta='';
	if($status_contrato!=''){
		$status=explode("=@",$status_contrato);
			$valor=$status[0];
			$esta=$esta." and (status_contrato='$valor'";
			for($i=1;$i<count($status)-1;$i++)
			{
				$valor=$status[$i];
				$esta=$esta." or status_contrato='$valor'";
			}
			$esta=$esta." )";
	}
	
	$sector='';
	if($id_sector!=''){
		$dato=explode("=@",$id_sector);
			$valor=$dato[0];
			$sector=$sector." and (id_sector='$valor'";
			for($i=1;$i<count($dato)-1;$i++)
			{
				$valor=$dato[$i];
				$sector=$sector." or id_sector='$valor'";
			}
			$sector=$sector." )";
	}else{
		$zona='';
		if($id_zona!=''){
			$dato=explode("=@",$id_zona);
				$valor=$dato[0];
				$zona=$zona." and (id_zona='$valor'";
				for($i=1;$i<count($dato)-1;$i++)
				{
					$valor=$dato[$i];
					$zona=$zona." or id_zona='$valor'";
				}
				$zona=$zona." )";
		}
	}
		
		$fecha_act=date("Y-m-01");
		
		$sql=" 	SELECT id_contrato, 
		nro_contrato,cedula,apellido,nombre,fecha_lla,nombre_tll,nombre_trl,nombre_drl,login,status_contrato,saldo,  nombre_sector ,nombre_zona ,nombre_franq ,telefono as celular,telf_casa as telefono,telf_adic   FROM vista_llamadas  WHERE vista_llamadas.id_contrato<>''  $esta $zona $sector  ";
	
	$where=  $sql;
	
		if($desde!='' && $hasta!=''){
			$desde=formatfecha($desde);
			$hasta=formatfecha($hasta);
			$where=$where. " and (fecha_lla between '$desde' and '$hasta')";
		}
	
		if($id_tll!='' && $id_tll!='0'){
			$where=$where. " and (id_tll = '$id_tll')";
		}
	
		if($id_trl!='' && $id_trl!='0'){
			$where=$where. " and (id_trl = '$id_trl')";
		}
	
		if($id_drl!='' && $id_drl!='0'){
			$where=$where. " and (id_drl = '$id_drl')";
		}
		if($login_resp!='' && $login_resp!='0'){
			$where=$where. " and (login = '$login_resp')";
		}
	
		if($id_franq!='' && $id_franq!='0'){
			$where=$where. " and (id_franq = '$id_franq')";
		}
		if($id_esta!='' && $id_esta!='0'){
			$where=$where. " and (id_esta ILIKE '%$id_esta%')";
		}
		if($id_mun!='' && $id_mun!='0'){
			$where=$where. " and (id_mun ILIKE '%$id_mun%')";
		}
		if($id_ciudad!='' && $id_ciudad!='0'){
			$where=$where. " and (id_ciudad ILIKE '%$id_ciudad%')";
		}
		if($id_calle!='' && $id_calle!='0'){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		if($urbanizacion!='' && $urbanizacion!='0'){
			$where=$where. " and (urbanizacion = '$urbanizacion')";
		}
		
	//$where=$where." order by id_zona $order";
	
	/*
if(!isset($_GET['order'])){
	$where=$where." order by  $orden_list";
	$_GET['order']='';
}
*/
	


//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_persona, nro_contrato, cedula, apellido, nombre,telefono,status_contrato,nombre_calle,nombre_sector,nombre_zona,nombre_franq,direc_adicional,etiqueta,postel,deuda","FROM vista_llamadas","","status_contrato='ACTIVO'");

	$x->consultas($where);

$x->hideColumn('id_contrato');
$x->hideColumn('celular');
$x->hideColumn('telefono');
$x->hideColumn('telf_adic');
$x->setColumnHeader("login", _("responsable"));
$x->setColumnHeader("fecha_lla", _("fecha llamada"));
$x->setColumnHeader("nombre_tll", _("Tipo LLAmada"));
$x->setColumnHeader("nombre_trl", _("tipo respuesta"));
$x->setColumnHeader("nombre_drl", _("detalle respuesta"));
$x->setColumnHeader("tipo_fact", _("TIPO FACT"));
$x->setColumnHeader("id_persona", _("ID"));
$x->setColumnHeader("nro_contrato", _("Cont."));
$x->setColumnHeader("cedula,", _("Cédula"));
$x->setColumnHeader("apellido", _("Apellido"));
$x->setColumnHeader("nombre", _("Nombre"));
$x->setColumnHeader("status_contrato", _("Status"));
$x->setColumnHeader("postel", _("Pt"));
$x->setColumnHeader("etiqueta", _("Etiq."));
$x->setColumnHeader("telefono", _("Tlf."));
$x->setColumnHeader("deuda", _("Deuda"));
$x->setColumnHeader('nombre_calle', _("Calle"));
$x->setColumnHeader('nombre_sector', _("Sector"));
$x->setColumnHeader('nombre_zona', _("Zona"));
$x->setColumnHeader('urbanizacion', _("Urb."));
$x->setColumnHeader('edificio', _("Edif."));
$x->setColumnHeader('nombre_franq', _("franquicia"));
$x->setColumnHeader('nombre_g_a', _("Grupo Afinidad"));
$x->setColumnHeader('direc_adicional', _("Referencia"));
$x->setColumnHeader('numero_casa', _("Nro Casa"));
$x->setColumnHeader('fecha_corte', _("Fecha Corte"));
$x->setColumnHeader('fecha_contrato', _("Fecha Inst."));
$x->hideColumn('id_persona');

//$x->hideColumn('fecha_corte');
//$x->hideColumn('id_contrato');
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');
$x->setColumnType('fecha_lla', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_contrato', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setClase("status_contrato");
$x->desde=$desde;
$x->hasta=$hasta;
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas

//mostrar resultados por pagina
if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0){
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}


$x->printTable();
?>
