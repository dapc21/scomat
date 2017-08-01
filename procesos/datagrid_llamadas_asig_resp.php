<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);


$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
	$desde=formatfecha($desde);
			$hasta=formatfecha($hasta);


$where="select  distinct (nombre || ' ' || apellido) as responsable,
sum((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all )) as total ,
sum((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all  AND status_lc='LLAMADO')) as llamadas_real,
sum((SELECT count(*) as cant FROM  asig_lla_cli,llamadas,detalle_resp where asig_lla_cli.id_lla=llamadas.id_lla and asig_lla_cli.id_all=asigna_llamada.id_all and llamadas.id_drl=detalle_resp.id_drl AND status_lc='LLAMADO' and id_trl='BG001')) as llamadas_atend,
sum((SELECT count(*) as cant FROM  asig_lla_cli,llamadas,detalle_resp where asig_lla_cli.id_lla=llamadas.id_lla and asig_lla_cli.id_all=asigna_llamada.id_all and llamadas.id_drl=detalle_resp.id_drl AND status_lc='LLAMADO' and id_trl='BG002')) as llamadas_no_atend,
sum((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all  AND status_lc='REGISTRADO')) as por_llamar,
sum((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0)) as moroso ,
sum((SELECT count(*) as cant FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0)) as pagado ,
sum(((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0) - 
(SELECT count(*) as cant FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0))) as pendiente ,
sum((SELECT sum(deuda) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all )) as deuda_moroso ,
sum((SELECT sum(monto_pago)  FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0)) as monto_pagado,
sum(((SELECT sum(deuda) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all ) -
(SELECT sum(monto_pago)  FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0))) as monto_pendiente
from asigna_llamada,personausuario where asigna_llamada.login_resp=personausuario.login and fecha_all between '$desde' and '$hasta'  group by responsable";


			

$x->setQuery("(nombre || ' ' || apellido) as responsable,
(SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all ) as total ,
(SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all  AND status_lc='LLAMADO') as llamadas_real,
(SELECT count(*) as cant FROM  asig_lla_cli,llamadas,detalle_resp where asig_lla_cli.id_lla=llamadas.id_lla and asig_lla_cli.id_all=asigna_llamada.id_all and llamadas.id_drl=detalle_resp.id_drl AND status_lc='LLAMADO' and id_trl='BG001') as llamadas_atend,
(SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all  AND status_lc='REGISTRADO') as por_llamar,
(SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0) as moroso ,
(SELECT count(*) as cant FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0) as pagado ,
((SELECT count(*) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0) - 
(SELECT count(*) as cant FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0)) as pendiente ,
(SELECT sum(deuda) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all ) as deuda_moroso ,
(SELECT sum(monto_pago)  FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0) as monto_pagado,
((SELECT sum(deuda) as cant FROM  asig_lla_cli where asig_lla_cli.id_all=asigna_llamada.id_all ) -
(SELECT sum(monto_pago)  FROM  asig_lla_cli,pagos where asig_lla_cli.id_contrato=pagos.id_contrato and fecha_pago>=fecha_all and asig_lla_cli.id_all=asigna_llamada.id_all and deuda>0)) as monto_pendiente
","from asigna_llamada","id_all","asigna_llamada.login_resp=personausuario.login and fecha_all between '$desde' and '$hasta' group by responsable");

$x->consultas($where);
$x->hideColumn('id_contrato');
$x->hideColumn('telefono');
$x->hideColumn('telf_adic');


$x->setColumnHeader('monto_pendiente', _("monto pendiente por pagar"));
$x->setColumnHeader('monto_pagado', _("monto pagado"));
$x->setColumnHeader('deuda_moroso', _("monto total morosos"));
$x->setColumnHeader('pendiente', _("pendiente por pagar"));
$x->setColumnHeader('pagado', _("pagaron"));
$x->setColumnHeader('por_llamar', _("Por Llamar"));
$x->setColumnHeader('llamadas_atend', _("Llamadas Atendidas"));
$x->setColumnHeader('llamadas_no_atend', _("Llamadas No Atendidas"));
$x->setColumnHeader('llamadas_real', _("Llamadas Realizadas"));
$x->setColumnHeader('moroso', _("Abonados Morosos"));
$x->setColumnHeader('total', _("Abonados Totales"));
$x->setColumnHeader('fecha_all', _("Fecha Asig."));
$x->setColumnHeader('login_enc', _("Asignado por"));
$x->setColumnHeader('obser_all', _("Observacion"));
$x->setColumnHeader('nombre_franq', _("Franquicia"));

$x->setColumnType('fecha_all', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setColumnHeader("ubica_all", _("Ubicacion"));
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
