<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('equipo_sistema'))) //validar privilegios
{
	$id_es=$_GET['id_es'];
	
?>
hoiadsfasdfasd
<form role="form" name="f3" id="f3"  >
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <!-- DIV QUE DIVIDE LA MITAD DE LA IZQUIERDA AL CENTRO-->
		<section class="panel">
			<header class="panel-heading">Materiales de Ordenes</header>
			<div class="panel-body">
			<?php

require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$valor= $_GET['id_dep'];
$valor=explode("==",$valor);
$id_dep=$valor[0];
$id_fam=$valor[1];
$tipo= $valor[2];
$donde= $valor[3];

$bus="status_fam='ACTIVO'";
$x->showCheckboxes();
	if($tipo=="1" && $id_dep!="0" && $id_fam!="0"){ 	
		$bus=$bus." AND id_dep='$id_dep' AND id_fam='$id_fam'";		
	}else 	if($tipo=="1" && $id_dep!="0"){ 	
		$bus=$bus." AND id_dep='$id_dep'";		
	}else 	if($tipo=="1" && $id_fam!="0"){ 	
		$bus=$bus." AND id_fam='$id_fam'";		
	}else{ 	
		$bus=$bus." AND id_dep='A0dfg0001'";		
		//$bus=$bus." AND id_dep='Asdff0001'";		
	}
		
		$x->setQuery("c_uni_sal,c_uni_ent,us_abre,id_mat,id_m,abreviatura,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock_min,stock,stock_min as min","vista_materiales_unid","id_mat",$bus);

if($donde!="aprobarinventario"){
	$x->hideColumn('abreviatura');
	//$x->hideColumn('precio');
}
		
$x->hideColumn('id_mat');
$x->hideColumn('numero_mat');
$x->hideColumn('id_m');
$x->hideColumn('nombre_dep');
$x->hideColumn('nombre_fam');
$x->hideColumn('c_uni_sal');
$x->hideColumn('c_uni_ent');
$x->hideColumn('nombre_unidad');
$x->hideColumn('us_abre');
$x->hideColumn('stock_min');
$x->hideColumn('precio');



//$x->setColumnHeader('numero_mat',_("num"));

$x->setColumnHeader('stock',_("stock deposito"));
$x->setColumnHeader('us_abre',_("cant us_abre"));
$x->setColumnHeader('c_uni_ent',_("cant entrante"));
$x->setColumnHeader('c_uni_sal',_("cant saliente"));
$x->setColumnHeader('id_m',_("id_m"));
//$x->hideColumn('cant_ped');
$x->setColumnHeader('precio',_("can real"));
//$x->setColumnHeader('numero_mat', _("#mat"));
$x->setColumnHeader('nombre_mat', _("material"));
$x->setColumnHeader('stock_min',_("cantE"));
$x->setColumnHeader('abreviatura',_("justificacion inventario2"));
$x->setColumnHeader('nombre_dep',_("deposito"));
$x->setColumnHeader('nombre_fam',_("familia"));
$x->setColumnHeader('nombre_unidad',_("medida"));

$x->setClase("inventario");

//$x->allowFilters();

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
 $x->setResultsPerPage(1000);
$x->printTable();
?>

			</div>
		</section>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <!-- DIV QUE DIVIDE LA MITAD DE LA IZQUIERDA AL CENTRO-->
		<section class="panel">
			<header class="panel-heading">Otros materiales</header>
			<div class="panel-body">
			</div>
		</section>
	</div>
	<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button disabled name="add_es" id="add_es" class="btn btn-warning" type="button" type="" class="boton" value="<?php echo _("modificar");?>" onclick="gestion_equipo_sistema_ext('modificar_add','equipo_sistema')"><i class="glyphicon glyphicon-refresh"></i> Guardar</button>
				<button class="btn btn-info" type="button" name="salfir" id="saflir" onclick="cerrar_ventana_externa()" value=""><i class="fa fa-plus"></i></i> Cerrar</button>
			</div>	
</form> 
<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" class="boton" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>

