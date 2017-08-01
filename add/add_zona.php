<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ZONA')))
{

?>
<form role="form" name="f3" id="f3"  data-parsley-validate="">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<section class="panel">
		<div class="panel-body">
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<input class="form-control" type="hidden" id="id_zona_add" maxlength="8" size="30"onChange="validarzona()" value="<?php $acceso->objeto->ejecutarSql("select *from zona  where (id_zona ILIKE '$ini_u%') ORDER BY id_zona desc"); echo $ini_u.verCo($acceso,"id_zona")?>">

				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label>Nombre de la Zona Nueva</label >
					<input data-parsley-id="5" required="" class="form-control" type="text" id="nombre_zona" maxlength="50" size="60" value="" onChange="">
					<ul id="parsley-id-5" class="parsley-errors-list"></ul>
				</div>
				
			</div>
			<div id="error_f3" style="display: none;"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" id="registrar" value="<?php echo _("registrar");?>" onclick="agregar_zona_ext('incluir','zona')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
				<button class="btn btn-default" type="button" id="cerrar" onclick="cerrar_ventana_externa()" value=""><i class="glyphicon glyphicon-remove"></i> Cerrar </button>
			</div>	
			
		</div>
	</section>

</div>

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