<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('movimiento_equipo'))) //validar privilegios
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administracion de movimiento_equipo</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos a registrar</header>
			<div class="panel-body">
				<input  type="hidden" name="id_mov_e" id="id_mov_e" maxlength="" size=""  value="<?php $acceso->objeto->ejecutarSql("select *from movimiento_equipo  where (id_mov_e ILIKE '$ini_u%') ORDER BY id_mov_e desc"); echo $ini_u.verCoo($acceso,"id_mov_e")?>">
				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>equipo</label>
					<input data-parsley-id="id_es" required=""  data-parsley-type="alphanum"  class="form-control" type="text" name="id_es" id="id_es" maxlength="10"  value="" >
					<ul id="parsley-id-id_es" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>ubic_ant</label>
					<input data-parsley-id="ubic_ant" required=""  data-parsley-type="alphanum"  class="form-control" type="text" name="ubic_ant" id="ubic_ant" maxlength="5"  value="" >
					<ul id="parsley-id-ubic_ant" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>ubic_post</label>
					<input data-parsley-id="ubic_post" required=""  data-parsley-type="alphanum"  class="form-control" type="text" name="ubic_post" id="ubic_post" maxlength="5"  value="" >
					<ul id="parsley-id-ubic_post" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>login</label>
					<input data-parsley-id="login" required=""  data-parsley-type="alphanum"  class="form-control" type="text" name="login" id="login" maxlength="25"  value="" >
					<ul id="parsley-id-login" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>fecha</label>
					<input data-parsley-id="fecha" required=""    class="form-control" type="text" name="fecha" id="fecha" maxlength="10"  value="" >
					<ul id="parsley-id-fecha" class="parsley-errors-list"></ul>							
				</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>motivo</label>
					<input data-parsley-id="motivo" required=""    class="form-control" type="text" name="motivo" id="motivo" maxlength="30"  value="" >
					<ul id="parsley-id-motivo" class="parsley-errors-list"></ul>							
				</div>

				<input  type="hidden" value="dato" name="dato" id="dato">
		<tr>
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_movimiento_equipo('incluir','movimiento_equipo')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled name="modificar" id="modificar" class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_movimiento_equipo('modificar','movimiento_equipo')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_movimiento_equipo('eliminar','movimiento_equipo')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_movimiento_equipo()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos Agregados</header>
			<div class="panel-body">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid"></div>
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	 
 
</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->

	
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

