<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('comandos_interfaz'))) //validar privilegios
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administracion de comandos_interfaz</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos a registrar</header>
			<div class="panel-body">
				<input  type="hidden" name="id_com_int" id="id_com_int" maxlength="" size=""  value="<?php $acceso->objeto->ejecutarSql("select *from comandos_interfaz  where (id_com_int ILIKE '$ini_u%') ORDER BY id_com_int desc"); echo $ini_u.verCodigo($acceso,"id_com_int")?>">
					<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<label>tipo sistema</label>
						<select data-parsley-id="id_tse" required=""   class="form-control" name="id_tse" id="id_tse" onchange="">
							<?php echo ver_tipo_sist_equipo($acceso);?>
						</select>
						<ul id="parsley-id-id_tse" class="parsley-errors-list"></ul>			
					</div>

				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>comando</label>
					<input data-parsley-id="nombre_com_int" required=""    class="form-control" type="text" name="nombre_com_int" id="nombre_com_int" maxlength="20"  value="" >
					<ul id="parsley-id-nombre_com_int" class="parsley-errors-list"></ul>							
				</div>

					<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<label>tipo comando</label>
						<select    class="form-control" name="tipo_com" id="tipo_com" onchange="">
							<option value="">NO APLICA</option>
							<option value="AGREGAR">AGREGAR</option>
							<option value="ACTIVAR">ACTIVAR</option>
							<option value="DESACTIVAR">DESACTIVAR</option>
							<option value="SERVICIOS">SERVICIOS</option>
							<option value="BORRAR">BORRAR</option>
							<option value="REFRESCAR">REFRESCAR</option>
							
						</select>
							
					</div>

					<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<label>Status</label>
						<div>
							<input  type="radio" name="status_com_int" value="ACTIVO"CHECKED>ACTIVO
							&nbsp;&nbsp;&nbsp;<input  type="radio" name="status_com_int" value="INACTIVO">INACTIVO
						</div>
					</div>

				<input  type="hidden" value="dato" name="dato" id="dato">
		<tr>
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_comandos_interfaz('incluir','comandos_interfaz')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled name="modificar" id="modificar" class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_comandos_interfaz('modificar','comandos_interfaz')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_comandos_interfaz('eliminar','comandos_interfaz')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_comandos_interfaz()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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

