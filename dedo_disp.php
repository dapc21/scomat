		<link rel="stylesheet" type="text/css" href="estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="estilos/css.css">
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/controlador.js"></script>
		<!--DataGrid-->
			<link rel="stylesheet" type="text/css" href="include/eyedatagrid/table.css" >
			<script type="text/javascript" src="include/eyedatagrid/eyedatagrid.js"></script>
		<!-- fin DataGrid -->
	<fieldset >
		<legend class="fuenteN"><?php echo _("decodificadores disponibles en stock");?></legend>
<?php
require_once("procesos.php"); 
$ini_u = $_SESSION["ini_u"]; 
//echo ":::$ini_u:";
 $acceso->objeto->ejecutarSql("select *from deco_ana  where (id_da ILIKE '$ini_u%') ORDER BY id_da desc LIMIT 1 offset 0"); 
 $id_da = $ini_u.verCoo($acceso,"id_da");
 
require 'include/eyedatagrid/class.eyepostgresadap.inc.php';
require 'include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$status=$_GET['status'];
$where="";
if($status!='TODOS'){
	$where= "status_da='$status'";
}
$x->setQuery("id_da,punto_da,codigo_da,nota2,marca_da,modelo_da,tipo_da", "deco_ana","id_da","status_da='' and id_contrato='' and prov_da='BUENO'");
$x->hideColumn('id_da');
$x->setColumnHeader('codigo_da', "Codigo");
$x->setColumnHeader('nota2', "Codigo2");
$x->setColumnHeader('marca_da', "Marca");
$x->setColumnHeader('modelo_da', "Modelo");
$x->setColumnHeader('tipo_da', "Tipo");
$x->setColumnHeader('status_da', "Status");
$x->setColumnHeader('punto_da','CODIFICACION');

$x->addRowSelect("resp_deco_disp('%id_da%')");

//para permitir filtros

//$x->allowFilters();
//para ir contanfo las filas
$x->hideOrder();
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

$x->printTable();

?>
</fieldset>


