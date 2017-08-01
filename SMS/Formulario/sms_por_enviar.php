<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ENVIAR_SMS_LOTES')))
{


?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_sms_por_enviar" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>SMS Enviados/Por Enviar</h3></div>
	
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-danger" type="<?php echo $obj->in;?>" name="modificar" value="<?php echo _("eliminar todos");?>" onclick="eliminar_todos_sms_enviar();"><i class="fa fa-trash-o"></i> Eliminar Todos</button>
			<button class="btn btn-danger" type="<?php echo $obj->mo;?>" name="registrar" value="<?php echo _("eliminar enviados");?>" onclick="eliminar_sms_enviados();"><i class="fa fa-trash-o"></i> Eliminar Enviados</button>
			<input disabled type="HIDDEN" name="eliminar" value="<?php echo _("eliminar seleccionados");?>" onclick="buscarDatos_sms();">
			<button class="btn btn-success" type="button" name="Resetear" onclick="javascript:conexionPHP_sms('formulario.php','sms_por_enviar');" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

		<input  type="hidden" value="dato" name="dato">	
		
		
	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<header class="panel-heading">Datos de Configuración de los SMS</header>
		
		<div class="panel-body">		
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<label>Mostrar SMS</label>
			<select  class="form-control" name="status_sinc" id="status_sinc" onchange="buscar_sms_enviar();">
				<option value="FALSE">POR ENVIAR</option>
				<option value="TRUE">ENVIADOS</option>
				<option value="">TODOS</option>
			</select>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<label>Marcar SMS Seleccionados Como</label>
			<select  class="form-control" name="marcar_como" id="marcar_como" onchange="marcar_como_sms_enviar();">
				<option value="">SELECCIONE...</option>
				<option value="FALSE">POR ENVIAR</option>
				<option value="TRUE">ENVIADO</option>
				<option value="ELIMINAR">ELIMINAR</option>
			</select>
			</div>
			
		</div>
		
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	
	<section class="panel">
	
	<header class="panel-heading">Listado de Mensajes</header>
	
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
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP_sms(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>