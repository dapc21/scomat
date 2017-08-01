<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ADMIN_SMS')))
{

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="admin_sms" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de SMS</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los SMS</header>
			
			<div class="panel-body">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Mostrar SMS</label>																																		
							<select class="form-control" name="tipo_sms" id="tipo_sms" onchange="buscar_admin_sms_enviar()">
								<option value="SIN LEER">SIN LEER</option>
								<option value="LEIDOS">LEIDOS</option>	
								<option value="RECIBIDOS">RECIBIDOS</option>
								<option value="ENVIADOS">ENVIADOS</option>
								<option value="">TODOS</option>
							</select>
							
					</div>
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Desde</label>																																		
						<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="desde" id="desde" maxlength="10" size="20" value="" >	
					</div>
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Hasta</label>																																		
						<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="hasta" id="hasta" maxlength="10" size="20" value="" >
					</div>
					
					
				
				</div>
				
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" name="registrar" value="<?php echo _("buscar");?>" onclick="buscar_admin_sms_enviar()"><i class="glyphicon glyphicon-search"></i> Buscar</button>
				<button class="btn btn-info" type="button" name="Resetear" onclick="javascript:conexionPHP_sms('formulario.php','admin_sms')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>		
		
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>marcar sms seleccionado como</label>																																		
						<select class="form-control" name="marcar_como" id="marcar_como" onchange="marcar_como_admin_sms_enviar();">
							<option value="">SELECCIONE...</option>	
							<option value="SIN LEER">SIN LEER</option>	
							<option value="LEIDOS">LEIDOS</option>	
							<option value="RECIBIDOS">RECIBIDOS</option>
							<option value="ENVIADOS">ENVIADOS</option>
							<option value="ELIMINAR">ELIMINAR</option>
						</select>
					</div>
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>		
			
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Listado de Mensajes</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid" class="data"></div>
					
					<input class="form-control" type="hidden" name="registrar" value="<?php echo _("agregar");?>" onclick="verificar_sms('incluir','comandos_sms')">&nbsp;
					<input class="form-control" type="hidden" name="modificar" value="<?php echo _("guardar");?>" onclick="verificar_sms('modificar','comandos_sms')">&nbsp;
					<input class="form-control" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_sms('eliminar','comandos_sms')">&nbsp
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	 
 
</form> <!-- FIN DEL FORMULARIO -->		
	
</div><!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->		
				

<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP_sms(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>