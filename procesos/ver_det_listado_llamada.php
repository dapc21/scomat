<?php
session_start();
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);


$id_all=$_GET['id_all'];

		$fecha_act=date("Y-m-01");
	
	
$x->setQuery("id_all,id_lc,vista_contrato_auditoria.id_contrato,nro_contrato,cedula,nombre,apellido,status_contrato,telf_casa,telefono,telf_adic,	 ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) FROM contrato_servicio_deuda, servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_contrato = vista_contrato_auditoria.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar  and fecha_inst <= '$fecha_act') AS deuda,	nombre_zona 
","vista_contrato_auditoria,asig_lla_cli","id_contrato","vista_contrato_auditoria.id_contrato=asig_lla_cli.id_contrato  AND status_lc='REGISTRADO' and id_all='$id_all'");
$x->hideColumn('id_lc');
$x->hideColumn('id_all');
$x->hideColumn('id_contrato');


$x->setColumnHeader("tipo_fact", _("TIPO FACT"));
$x->setColumnHeader("id_persona", _("ID"));
$x->setColumnHeader("nro_contrato", _("Nro Abonado"));
$x->setColumnHeader("cedula,", _("Cédula"));
$x->setColumnHeader("apellido", _("Apellido"));
$x->setColumnHeader("nombre", _("Nombre"));
$x->setColumnHeader("status_contrato", _("Status"));
$x->setColumnHeader("postel", _("Pt"));
$x->setColumnHeader("etiqueta", _("Etiq."));
$x->setColumnHeader("telefono", _("Tlf. Adic."));
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


$x->addRowSelect("llamar_llamadas('%id_all%','%id_contrato%','%id_lc%');window.location.replace('#');");
/*
$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "ver_det_listado_llamada('%id_all%');");
$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "imprimir_listado_llamada('%id_all%');");
*/
$x->setColumnType('fecha_all', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);

//para permitir filtros
$x->allowFilters();


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
$x->printTable();
?>
