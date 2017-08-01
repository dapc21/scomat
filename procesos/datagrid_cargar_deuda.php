<?php
require_once("../procesos.php");
$ini_u = $_SESSION["ini_u"];
$acceso->objeto->ejecutarSql("select id_cd from cargar_deuda  where (id_cd ILIKE '$ini_u%')  ORDER BY id_cd desc LIMIT 1 offset 0 "); 
$id_cd= $ini_u.verCoo($acceso,"id_cd");

require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);

$id_contrato=$_GET['id_contrato'];
$x->setQuery("id_cd,servicios.id_serv,nombre_servicio,cantidad,costo,(cantidad*costo) as total", "cargar_deuda, servicios","id_cd","cargar_deuda.id_serv= servicios.id_serv and id_contrato='$id_contrato'");
$x->hideColumn('id_cd');
$x->hideColumn('id_serv');

$x->setColumnHeader('nombre_servicio',  _("Descripcion"));
$x->setColumnHeader('tipo_servicio', _("Tipo Servicio"));


//para permitir filtros

$x->allowFilters();

$x->setResultsPerPage(100);
//llama al evento al darle click a la fila
//$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "conexionPHP('validarExistencia.php','1=@cargar_deuda','id_cd=@%id_cd%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "buscar_id_cd('%id_cd%');window.location.replace('#');");
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarcargar_deuda('%id_cd%','%id_serv%');");
$x->hideFooter(true);
$x->printTable();
                                                                                                                                                                                                                                                                                                                                                                                                                                        
	
if($modo!='EXCEL'){
	$acceso->objeto->ejecutarSql("select count(*) as cont_serv from cargar_deuda where  id_contrato='$id_contrato'");
	if($row=row($acceso)){
		$cont_serv=trim($row["cont_serv"]);
	}
echo '<input  type="hidden" value="'.$cont_serv.'" name="cont_serv" id="cont_serv">	';
echo '<input  type="hidden" value="'.$id_cd.'" name="id_cd" id="id_cd">	';
}
$acceso->objeto->ejecutarSql("select sum(cantidad * costo) as total from cargar_deuda where id_contrato='$id_contrato' ");
	$total=0;
	if($row=row($acceso)){
		$total=trim($row["total"])+0;
	}
	
if($modo!='EXCEL'){	
echo '<div align="right" class="fuente">'._("total cargos").': <span class="fuenteN">'.number_format($total,2,",",".").'</span></div>';
}

?>