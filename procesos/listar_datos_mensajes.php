<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

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
		$servicio='';
		if($id_tipo_servicio!='' && $id_tipo_servicio!='0'){
			$servicio=$servicio. " and (id_tipo_servicio ILIKE '%$id_tipo_servicio%')";
		}
		if($id_serv!='' && $id_serv!='0'){
			$servicio=$servicio. " and (servicios.id_serv ILIKE '%$id_serv%')";
		}
		$fecha_act=date("Y-m-01");

		if($sd!=''){
			$sql_sd=" and  ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda , servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv $servicio and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and 
			
			(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=vista_contrato_auditoria.id_contrato and fecha_inst < '$hasta_filtro'  and costo_cobro>0 )>0 and 	(select count(*) from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato=vista_contrato_auditoria.id_contrato and fecha_inst < '$desde'  and costo_cobro>0 )<=0
						
			and ( SELECT count(vista_convenio.costo_cobro) FROM vista_convenio WHERE  vista_convenio.id_cont_serv = contrato_servicio_deuda.id_cont_serv AND vista_convenio.status_con_ser = 'DEUDA' and vista_convenio.status_conv='ACTIVO' and fecha_ven>='$hasta') <= 0
			) > $deuda  and ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda, servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv $servicio and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst < '$fecha_act')> $deuda";
			
			$sd_conv="  and vista_convenio.fecha_ven between '$desde' and '$hasta'";


		}
		
		
			if($dep!=''){
				$sql_sd=$sql_sd." and  ( SELECT count(*) FROM pagodeposito WHERE  pagodeposito.id_contrato = vista_contrato_auditoria.id_contrato AND (status_pd = 'REGISTRADO' or status_pd = 'CONFIRMADO')) =0 ";
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
			
	$sql=" 	SELECT 
	nro_contrato,id_franq,cedula,apellido,nombre,status_contrato,	 ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda, servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv $servicio and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst < '$fecha_act') AS deuda,	nombre_g_a,nombre_calle,urbanizacion,edificio, nombre_sector ,nombre_zona ,nombre_mun,nombre_franq,direc_adicional  ,cobrador,postel,etiqueta,telefono as celular,telf_casa as telefono,telf_adic   FROM vista_contrato_auditoria  WHERE vista_contrato_auditoria.id_contrato<>'' $sql_sd $esta  $conv  ";
	$where=  $sql;
	
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
		if($id_zona!='' && $id_zona!='0'){
			$where=$where. " and (id_zona ILIKE '%$id_zona%')";
		}
		if($id_sector!='' && $id_sector!='0'){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
		}
		if($id_calle!='' && $id_calle!='0'){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
		}
		if($urbanizacion!='' && $urbanizacion!='0'){
			$where=$where. " and (urbanizacion = '$urbanizacion')";
		}
		
	//$where=$where." order by id_zona $order";
//	echo $where;


//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("nro_contrato,cedula,cedula, apellido,nombre,status_contrato,id_persona,nombre_calle,nombre_sector,nombre_zona,nombre_franq,direc_adicional","FROM vista_contrato_auditoria","","status_contrato='ACTIVO'");

	$x->consultas($where);
$x->setColumnHeader("cedula", _("cedula"));
$x->setColumnHeader("id_persona", _("deuda"));
$x->setColumnHeader("nro_contrato", _("nro Cont"));
$x->setColumnHeader("cedula,", _("cedula"));
$x->setColumnHeader("nombre", _("cliente"));
$x->setColumnHeader("status_contrato", _("status"));
$x->setColumnHeader('nombre_calle', _("Calle"));
$x->setColumnHeader('nombre_sector', _("sector"));
$x->setColumnHeader('nombre_zona', _("zona"));

$x->setColumnHeader('nombre_franq', _("franquicia"));
$x->setColumnHeader('nombre_g_a', _("Grupo Afinidad"));
$x->setColumnHeader('direc_adicional', _("referencia"));

$x->hideColumn('apellido');
$x->hideColumn('direc_adicional');
$x->hideColumn('id_franq');
$x->hideColumn('id_contrato');
//$x->setColumnHeader('nombre Columna', 'Titulo Columna');
$x->setClase("status_contrato");
$x->desde=$desde;
$x->hasta=$hasta;
//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas

//mostrar resultados por pagina
if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
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

//llama al evento al darle click a la fila
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@status_contrato','status_contrato=@%status_contrato%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarstatus_contrato('%status_contrato%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarstatus_contrato('%status_contrato%')");
*/
$x->printTable();
?>
