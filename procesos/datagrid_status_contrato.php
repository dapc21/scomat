<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

$gen_fec = $_GET['gen_fec'];
$desde1 = formatfecha($_GET['desde1']);
$hasta1 = formatfecha($_GET['hasta1']);
$por_fecha = $_GET['por_fecha'];
$tipo_lista = $_GET['tipo_lista'];
$deuda = $_GET['deuda'];
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$hasta_filtro = sumames(formatfecha($hasta));

$id_franq = $_GET['id_franq'];
$cod_id_persona = $_GET['cod_id_persona'];

$sd = trim($_GET['sd']);
$dep = trim($_GET['dep']);

$id_tipo_servicio = $_GET['id_tipo_servicio'];
$id_serv = $_GET['id_serv'];
$id_g_a = $_GET['id_g_a'];
$id_esta = $_GET['id_esta'];
$id_mun = $_GET['id_mun'];
$id_ciudad = $_GET['id_ciudad'];
$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$urbanizacion = $_GET['urbanizacion'];
$id_calle = $_GET['id_calle'];

$convenio = $_GET['convenio'];

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
	
	
$orden_list = $_GET['orden_list'];	
	
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
		
		$servicio='';
		$servici='';
		if($id_serv!='' && $id_serv!='0'){
			$servicio=$servicio. " and  ( SELECT count(*) FROM contrato_servicio , servicios WHERE contrato_servicio.id_serv=servicios.id_serv and contrato_servicio.id_contrato = vista_contrato_auditoria.id_contrato and (status_con_ser='CONTRATO' OR status_con_ser='SUSPENDIDO')  and (servicios.id_serv ILIKE '%$id_serv%'))>0";
			$servici=$servici. " and  (servicios.id_serv ILIKE '%$id_serv%')";
		}
		else if($id_tipo_servicio!='' && $id_tipo_servicio!='0'){
			$servicio=$servicio. " and  ( SELECT count(*) FROM contrato_servicio , servicios WHERE contrato_servicio.id_serv=servicios.id_serv and contrato_servicio.id_contrato = vista_contrato_auditoria.id_contrato and (status_con_ser='CONTRATO' OR status_con_ser='SUSPENDIDO') and (id_tipo_servicio ILIKE '%$id_tipo_servicio%'))>0";
			$servici=$servici. " and  (id_tipo_servicio ILIKE '%$id_tipo_servicio%')";
		}
	
		$fecha_act=date("Y-m-01");
		
		if($sd!=''){
			$sql_sd="
			       and  (select count(*) FROM vista_deuda WHERE vista_deuda.id_contrato = vista_contrato_auditoria.id_contrato  and fecha_inst < '$hasta_filtro'  )>$deuda 
			      and  (select count(*) FROM vista_deuda WHERE vista_deuda.id_contrato = vista_contrato_auditoria.id_contrato  and fecha_inst < '$desde' )<=0
      ";
			
		
		}
	
	
		
		$conv='';
		if($convenio=='CON CONVENIO'){
			
			$conv=" and ( SELECT count(*) FROM vista_convenio WHERE vista_convenio.id_contrato = vista_contrato_auditoria.id_contrato AND vista_convenio.status_con_ser = 'DEUDA'::bpchar  $sd_conv) > 0 ";
		}
		else if($convenio=='SIN CONVENIO'){
			$conv=" and ( SELECT count(*) FROM vista_convenio WHERE vista_convenio.id_contrato = vista_contrato_auditoria.id_contrato AND vista_convenio.status_con_ser = 'DEUDA'::bpchar  $sd_conv) <= 0 ";
			
		}
		else if($convenio=='CONVENIO POR FECHA'){
			$conv=" and ( SELECT count(*) FROM vista_convenio WHERE vista_convenio.id_contrato = vista_contrato_auditoria.id_contrato   $sd_conv) > 0 ";
		}

			$fecha_ven_conv = " ( SELECT vista_convenio.fecha_ven FROM vista_convenio WHERE vista_convenio.id_contrato = vista_contrato_auditoria.id_contrato AND vista_convenio.status_con_ser = 'DEUDA'::bpchar  $sd_conv order by fecha_ven limit  1 OFFSET 0) as convenio, ";
			
			$fecha_corte_c = " ( SELECT ordenes_tecnicos.fecha_final FROM ordenes_tecnicos WHERE ordenes_tecnicos.id_contrato = vista_contrato_auditoria.id_contrato AND ordenes_tecnicos.status_orden = 'FINALIZADO'  order by fecha_final desc limit 1) ";
			$fecha_corte = " ( SELECT ordenes_tecnicos.fecha_final FROM ordenes_tecnicos WHERE ordenes_tecnicos.id_contrato = vista_contrato_auditoria.id_contrato AND ordenes_tecnicos.status_orden = 'FINALIZADO'  order by fecha_final desc limit 1) as fecha_corte ";
	if($tipo_lista=="LISTADO GENERAL AUDITORIA"){
		$sql=" 	SELECT id_contrato, 
		nro_contrato,id_franq,cedula,apellido,nombre,status_contrato,tipo_fact,	 saldo, $fecha_corte, fecha_contrato,	nombre_g_a,nombre_calle,numero_casa,urbanizacion,edificio, nombre_sector ,nombre_zona ,nombre_mun,nombre_franq , direc_adicional  ,cobrador,postel,etiqueta,telefono as celular,telf_casa as telefono,telf_adic   FROM vista_contrato_auditoria  WHERE vista_contrato_auditoria.id_contrato<>'' $sql_sd $esta $zona $sector $servicio $conv  ";
	}
	else if($tipo_lista=="LISTADO CORTO PARA CORTE"){
		$sql=" 	SELECT nro_contrato,apellido,nombre,status_contrato, 
		suscripcion(id_contrato) AS suscripcion,
		saldo,nombre_sector , direc_adicional ,postel ,etiqueta,telefono as celular,telf_casa as telefono  FROM vista_contrato_auditoria  WHERE vista_contrato_auditoria.id_contrato<>'' $sql_sd $esta $zona $sector $servicio $conv  ";
	}
	$where=  $sql;
	
	if($gen_fec!='GENERAL'){
		if($por_fecha=='CORTE'){
			$where=$where. " and $fecha_corte_c between '$desde1' and '$hasta1'";
		}else if($por_fecha=='INSTALACION'){
			$where=$where. " and fecha_contrato between '$desde1' and '$hasta1'";
		}{
		}
	}
	
	
$tipo_fact = $_GET['tipo_fact'];
		if($tipo_fact!='' && $tipo_fact!='0'){
			$where=$where. " and (tipo_fact = '$tipo_fact')";
		}
		
		if($id_franq!='' && $id_franq!='0'){
			$where=$where. " and (id_franq = '$id_franq')";
		}
		if($cod_id_persona!='' && $cod_id_persona!='0'){
			$where=$where. " and (cod_id_persona ILIKE '%$cod_id_persona%')";
		}
		if($id_g_a!='' && $id_g_a!='0'){
			$where=$where. " and (id_g_a ILIKE '%$id_g_a%')";
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
	
	
if(!isset($_GET['order'])){
	if($orden_list!=''){
		$where=$where." order by  $orden_list";
	}
	$_GET['order']='';
}

	//echo $where;
	



//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_persona, nro_contrato, cedula, apellido, nombre,telefono,status_contrato,nombre_calle,nombre_sector,nombre_zona,nombre_franq,direc_adicional,etiqueta,postel,deuda","FROM vista_contrato_auditoria","","status_contrato='ACTIVO'");

$x->consultas($where);

$x->setColumnHeader("deuda_total", _("DEUDA TOTAL"));
$x->setColumnHeader("deuda_servicio", _("DEUDA SERVICIO"));
$x->setColumnHeader("tipo_fact", _("TIPO FACT"));
$x->setColumnHeader("id_persona", _("ID"));
$x->setColumnHeader("nro_contrato", _("Cont."));
$x->setColumnHeader("cedula,", _("Cédula"));
$x->setColumnHeader("apellido", _("Apellido"));
$x->setColumnHeader("nombre", _("Nombre"));
$x->setColumnHeader("status_contrato", _("Est."));
$x->setColumnHeader("postel", _("Pt"));
$x->setColumnHeader("etiqueta", _("Etiq."));
$x->setColumnHeader("telefono", _("Tlf."));
$x->setColumnHeader("deuda", _("Deu."));
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
//$x->hideColumn('postel');
//$x->hideColumn('etiqueta');
$x->hideColumn('celular');
$x->hideColumn('telefono');
$x->hideColumn('id_franq');
//$x->hideColumn('fecha_corte');
//$x->hideColumn('id_contrato');
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');
$x->setColumnType('fecha_corte', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
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
