<?php
session_start();
require_once("../procesos.php");$ini_u = $_SESSION["ini_u"];  
$modo=trim($_GET['modo']);
	
if($modo!='EXCEL'){
?>



<form role="form" name="f1" id="form_info_adicional" >

	<section class="panel">
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Asunto</label>
				<select class="form-control" name="info_a" id="info_a" onchange="">
					<?php echo verMotivoLlamada($acceso);?>
				</select>
			</div>
			<div class="form-group col-lg-7 col-md-6 col-sm-12 col-xs-12">
				<label>Observación</label>
				<textarea class="form-control" name="desc_a" rows="1"></textarea>
			</div>
			<div class="form-group col-lg-2 col-md-4 col-sm-6 col-xs-12">
				<label><i class="fa fa-edit label-blanco"></i></label>
				<div class="input-group text-btn">
				<button class="btn btn-info" type="button" class="boton" name="agregar_info_adic" value="<?php echo _("agregar");?>" onclick="verificar('incluir','info_adic')"><i class="glyphicon glyphicon-plus"></i> GUARDAR</button>
				</div>
			</div>
		
		</div> <!-- FIN DEL PANEL --> 	
	
	</section>
	
<?php
}
$acceso->objeto->ejecutarSql("select *from info_adic  where (id_inf_a ILIKE '$ini_u%') ORDER BY id_inf_a desc LIMIT 1 offset 0"); 
$id_inf_a = $ini_u.verCo($acceso,"id_inf_a");
	
if($modo!='EXCEL'){
echo '<input  type="HIDDEN" name="id_inf_a" maxlength="10" size="30"onChange="validarnotas_con()" value="'.$id_inf_a.'">';
}
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); 

$id_contrato=$_GET['id_contrato'];
//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_inf_a,nombremotivonota,desc_a,fecha,hora,login", "info_adic,motivollamada","id_inf_a","id_contrato='$id_contrato' and info_adic.info_a=motivollamada.idmotivonota");
$x->hideColumn('id_inf_a');
$x->setColumnHeader('nombremotivonota','Asunto');
$x->setColumnHeader('desc_a','Descripcion');
$x->setColumnHeader('login','Creado por');


$x->setColumnType('fecha', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);


//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
//$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);
//llama al evento al darle click a la fila
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@info_adic','id_inf_a=@%id_inf_a%');window.location.replace('#');");
/*
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "conexionPHP('validarExistencia.php','1=@info_adic','id_inf_a=@%id_inf_a%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarinfo_adic('%id_inf_a%')");
*/
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
	
if($modo!='EXCEL'){
echo '
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<section id="tabla-bitacora">
	 ';
}
	$x->printTable();
	
	
if($modo!='EXCEL'){	
echo '
	</section>
</form>
</div>';
}
?>
