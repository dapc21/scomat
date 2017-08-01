<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('VARIABLE_SMS')))
{
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_variables_sms" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Variables para SMS</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<header class="panel-heading">Datos de Configuración para las Variables SMS</header>
		
		<div class="panel-body">
		
		<input  type="hidden" name="id_var" maxlength="5" size="30"onChange="validarvariables_sms()" value="<?php $acceso->objeto->ejecutarSql("select *from variables_sms ORDER BY id_var desc"); echo verNumero($acceso,"id_var")?>">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Nombre de la Variable</label>
				<input class="form-control" type="text" name="variable" maxlength="20" value="@@" >
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">								
				<label>Tipo de Variable</label>
				<div>
					<input  type="checkbox" name="tipo_var" value="CONTRATO" onclick="checkRadio();">
					Contrato </br>
					<input type="checkbox" name="tipo_var" value="ORDEN" onclick="checkRadio();">
					Orden </br>
					<input type="checkbox" name="tipo_var" value="PAGO" onclick="checkRadio();">
					Pago </br>
					<input type="checkbox" name="tipo_var" value="CIERRE_CAJA" onclick="checkRadio();">
					Cierre de Caja </br>
					<input type="checkbox" name="tipo_var" value="CIERRE_DIARIO" onclick="checkRadio();">
					Cierre Diario </br>
					<input type="checkbox" name="tipo_var" value="INGRESO_ACTUAL" onclick="checkRadio();">
					Ingreso Actual </br>
					<input type="checkbox" name="tipo_var" value="INFORME_TECNICO" onclick="checkRadio();">
					Informe Técnico </br>
				</div>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Descripción</label>
				<textarea class="form-control" name="descrip_var"  cols="1" rows="2"></textarea>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Estatus</label >
				<div>
					<input type="radio" checked name="status_var" id="status_activo" value="ACTIVO" onclick="checkRadio();"/> ACTIVO &nbsp;&nbsp;
					<input type="radio" name="status_var" id="status_inactivo" value="INACTIVO" onclick="checkRadio();" /> INACTIVO
				</div>
			</div>
			
			<input  type="hidden" value="1" name="id_franq">
			<input  type="hidden" value="dato" name="dato">
		
		</div>
		
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" name="registrar" value="REGISTRAR" onclick="verificar_sms('incluir','variables_sms')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" name="modificar" value="MODIFICAR" onclick="verificar_sms('modificar','variables_sms')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" name="eliminar" value="ELIMINAR" onclick="verificar_sms('eliminar','variables_sms')"><i class="fa fa-trash-o"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_sms('formulario.php','variables_sms')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i>Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>
	
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Variables para SMS Registradas</header>
		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid" class="data"></div>						
					
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
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP_sms(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>