<!--AplicaTem-->
			<link rel="stylesheet" type="text/css" href="estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="estilos/css.css">
			<script language="JavaScript" type="text/javascript" src="javascript/validacion.js"> </script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/ajax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/validacionAjax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/controlador.js"></script>
		<!--Fin AplicaTem-->
		
		<!--DataGrid-->
			<link rel="stylesheet" type="text/css" href="include/eyedatagrid/table.css" >
			<script type="text/javascript" src="include/eyedatagrid/eyedatagrid.js"></script>
		<!-- fin DataGrid -->
		<!--datepicker  epoch-->
			<link rel="stylesheet" type="text/css" href="include/epoch/epoch_styles.css" >
			<script type="text/javascript" src="include/epoch/epoch_classes.js"></script>
		<!--fin datepicker epoch-->
<?php
require_once("DataBase/Acceso.php");
require 'include/eyedatagrid/class.eyepostgresadap.inc.php';
require 'include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_mat,numero_mat,nombre_mat,unidad_mat,cant_existencia,tipo", "materiales","id_mat","");
$x->hideColumn('id_mat');
$x->setColumnHeader('numero_mat','Nro Material');
$x->setColumnHeader('nombre_mat','Nombre');
$x->setColumnHeader('unidad_mat','Medida');
$x->setColumnHeader('cant_existencia','Stock');
$x->setColumnHeader('tipo','Tipo');
$x->setColumnHeader('','');
$x->setColumnHeader('','');
$x->setColumnHeader('','');

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

//llama al evento al darle click a la fila
$x->addRowSelect("parent.conexionPHP('validarExistencia.php','1=@materiales','id_mat=@%id_mat%');parent.dhxWins.window('w2').close();");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarmateriales('%id_mat%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarmateriales('%id_mat%')");
*/
$x->printTable();
?>