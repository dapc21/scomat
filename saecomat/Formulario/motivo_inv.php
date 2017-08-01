<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('MOTIVO_INV'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_motivo_inventario"  action="javascript:func_vacia();">
	
	<div class="border-head"><h3>Administración de los Motivos de Inventarios</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Motivos de Inventarios</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<input  type="HIDDEN" name="id_motivo" maxlength="3" size="30"onChange="validarmotivo_inv()" value="<?php $acceso->objeto->ejecutarSql("select *from motivo_inv where (id_motivo ILIKE '$ini_u%') ORDER BY id_motivo desc"); echo $ini_u.verCodigo($acceso,"id_motivo")?>">
			<input  type="hidden" value="dato" name="dato">

			<div class="form-group col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<label>Nombre</label>
				<input class="form-control" type="text" name="nombre_motivo" maxlength="30" size="30" value="" onChange="validarmotivo_inv()">
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Estatus</label >
				<div>
					<input type="radio" checked name="status_motivo" id="estatus_activo" value="ACTIVO" onchange="checkRadio();" /> Activo &nbsp;&nbsp;
					<input type="radio" name="status_motivo" id="estatus_inactivo" value="INACTIVO" onchange="checkRadio();" /> Inactivo
				</div>
			</div>
			
			
			</div>
			

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar_mat('incluir','motivo_inv')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
			<button class="btn btn-warning" type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_mat('modificar','motivo_inv')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
			<button class="btn btn-danger" type="<?php echo $obj->el;?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','motivo_inv')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_mat('formulario.php','motivo_inv')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<header class="panel-heading">Datos de los Motivos de Inventarios Registrados</header>
	
		<div class="panel-body">	
		<div id="datagrid" class="data"></div>	
		</div> <!-- FIN DEL PANEL --> 

	</section>

</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->

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