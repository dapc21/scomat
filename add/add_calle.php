<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CALLE')))
{

?>
<form role="form" name="f3" id="f3"  data-parsley-validate="">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<section class="panel">
		<div class="panel-body">
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<input class="form-control" type="hidden" id="id_calle_add" maxlength="10" size="20"onChange="validarcalle();" value="<?php $acceso->objeto->ejecutarSql("select *from calle  where (id_calle ILIKE '$ini_u%') ORDER BY id_calle desc"); echo $ini_u.verCodlong($acceso,"id_calle")?>">

				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label>Nombre de la calle Nueva</label >
					<input data-parsley-id="5" required="" class="form-control" type="text" id="nombre_calle" maxlength="50" size="60" value="" onChange="">
					<ul id="parsley-id-5" class="parsley-errors-list"></ul>
				</div>
				
			</div>
			<div id="error_f3" style="display: none;"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" id="registrar" value="<?php echo _("registrar");?>" onclick="agregar_calle_ext('incluir','calle')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
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