<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);


	
//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_cuba,banco_cuba,numero_cuba,abrev_cuba,desc_cuba,conc_cliente,conc_franq,comision_pv,comision_pv_c,status_cuba", "cuenta_bancaria","id_cuba","");
$x->hideColumn('id_cuba');
$x->setColumnHeader('numero_cuba', _("numero de cuenta"));
$x->setColumnHeader('banco_cuba',_("Banco"));
$x->setColumnHeader('abrev_cuba',_("Abreviatura"));
$x->setColumnHeader('desc_cuba',_("observacion"));
$x->setColumnHeader('status_cuba',_("status"));
$x->setColumnHeader('conc_cliente',_("planilla/aplicacion"));
$x->setColumnHeader('conc_franq',_("punto Venta"));
$x->setColumnHeader('comision_pv',_("comision debito"));
$x->setColumnHeader('comision_pv_c',_("comision credito"));

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
		if(trim($row["valor_param"])>0){
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$x->addRowSelect("buscar_id_cuenta_bancaria('%id_cuba%');window.location.replace('#');");
//llama al evento al darle click a la fila
//$x->addCustomControl(EyeDataGrid::CUSCTRL_TEXT, "alert('%numero_cuba%\'s been promoted!')", EyeDataGrid::TYPE_ONCLICK, 'Promote Me');
//$x->addRowSelect("conexionPHP('validarExistencia.php','1=@cuenta_bancaria','id_cuba=@%id_cuba%')");
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarcaja('%pago_comisiones%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarcaja('%pago_comisiones%')");
*/
$x->printTable();



?>
