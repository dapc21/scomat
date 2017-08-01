<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('BITACORA')))
{
 
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//$tipo_caja=verCajaPrincipal($acceso);
//echo $tipo_caja;	

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$com = $_GET['com'];
$login = $_GET['login'];
if($login!="TODOS" && $login!="0"){
	$where_c= " and login='$login'";
}

if(!isset($_GET['order'])){
	$x->setOrder('fecha', 'ORDER_ASC');
}

$x->setQuery("vista_contrato.id_contrato,nro_contrato,cedula,(nombre || ' ' || apellido) as cliente, login, fecha, hora, info_a","motivollamada,vista_contrato,info_adic","","vista_contrato.id_contrato=info_adic.id_contrato  and info_adic.info_a=motivollamada.idmotivonota and fecha between '$desde' and '$hasta' $where_c $consult");
$x->hideColumn('inicial_doc');
$x->hideColumn('id_contrato');
$x->setColumnHeader("fecha", _("Fecha"));
$x->setColumnHeader("hora", _("Hora"));
$x->setColumnHeader("nombremotivonota", _("Asunto"));
$x->setColumnHeader("desc_a", _("Descripcion"));
$x->setColumnHeader("cedulacli", _("Cedula"));
$x->setColumnHeader("nombrecli", _("Nombre"));

$x->hideColumn('id_contrato');
$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "respRefActCont('%id_contrato%')");

$x->setColumnType('fecha', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->desde=$desde;
$x->hasta=$hasta;

//$x->setClase("rep_libroventa");
$x->allowFilters();
$x->showRowNumber();

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

$x->printTable();

?>

<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>
