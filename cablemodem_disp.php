		<link rel="stylesheet" type="text/css" href="estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="estilos/css.css">
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/controlador.js"></script>
		<!--DataGrid-->
			<link rel="stylesheet" type="text/css" href="include/eyedatagrid/table.css" >
			<script type="text/javascript" src="include/eyedatagrid/eyedatagrid.js"></script>
		<!-- fin DataGrid -->
	<fieldset >
		<legend class="fuenteN"><?php echo _("cablemodem disponibles en stock");?></legend>
<?php
require_once("procesos.php"); 
$ini_u = $_SESSION["$ini_u"]; 
//echo ":::$ini_u:";
 $acceso->objeto->ejecutarSql("select *from deco_ana  where (id_da ILIKE '$ini_u%') ORDER BY id_da desc LIMIT 1 offset 0"); 
 $id_da = $ini_u.verCoo($acceso,"id_da");
 
require 'include/eyedatagrid/class.eyepostgresadap.inc.php';
require 'include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$x->setQuery("id_cm,codigo_cm,marca_cm,modelo_cm,nota1,nota2", "cablemodem","id_cm","status_cm='' and nota1='EMPRESA' and nota2='BUENO'");
$x->hideColumn('id_cm');
$x->setColumnHeader('codigo_cm','Codigo');
$x->setColumnHeader('marca_cm','Marca');
$x->setColumnHeader('modelo_cm','Modelo');
$x->setColumnHeader('status_cm','Status');
$x->setColumnHeader('nota2','Estado Fisico');
$x->setColumnHeader('nota1','Ubicacion');
$x->hideOrder();
$x->addRowSelect("resp_cablemodem_disp('%id_cm%')");

//para permitir filtros

$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
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

$x->printTable();

?>
</fieldset>
