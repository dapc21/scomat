<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('TIPO_MOVIMIENTO'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_tipo_movimiento"  >
	
	<div class="border-head"><h3>Administración de Tipos de Movimientos</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Tipos de Movimientos</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<input  type="hidden" name="uso_tm" maxlength="15" size="30" value="vacio" >
			<input  type="hidden" value="dato" name="dato">
			<input  type="hidden" name="id_tm" maxlength="8" size="30"onChange="" value="<?php $acceso->objeto->ejecutarSql("select *from tipo_movimiento where (id_tm ILIKE '$ini_u%') ORDER BY id_tm desc LIMIT 1 offset 0"); echo $ini_u.verCoo($acceso,"id_tm")?>">

			<div class="form-group col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<label>Nombre</label>
				<input class="form-control" type="text" name="nombre_tm" onChange="validartipo_movimiento()" maxlength="50" size="40" value="" >
			</div>
			
			<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<label>Tipo de Movimiento</label>
				<select class="form-control" name="tipo_ent_sal">
					<option value="0" SELECT><?php echo _("seleccione...");?></option>
					<option value="ENTRADA"><?php echo _("ENTRADA");?></option>
					<option value="SALIDA"><?php echo _("SALIDA");?></option>
				</select>
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Estatus</label >
				<div>
					<input type="radio" checked name="status_tm" id="estatus_activo" value="ACTIVO" onchange="checkRadio();" /> Activo &nbsp;&nbsp;
					<input type="radio" name="status_tm" id="estatus_inactivo" value="INACTIVO" onchange="checkRadio();" /> Inactivo
				</div>
			</div>
			
			
			</div>
			

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar_mat('incluir','tipo_movimiento')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
			<button class="btn btn-warning" type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_mat('modificar','tipo_movimiento')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
			<button class="btn btn-danger" type="<?php echo $obj->el;?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','tipo_movimiento')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_mat('formulario.php','tipo_movimiento')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<header class="panel-heading">Datos de los Tipos de Movimientos Registrados</header>
	
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