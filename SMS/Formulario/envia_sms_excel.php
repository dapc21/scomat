<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ENVIAR_SMS_EXCEL')))
{


?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_sms_lista_excel" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Envio de SMS de Lista de Excel</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Mensaje</header>
		
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<label>Cargar Archivo Excel</label >
			<div class="input-group">
			<input class="form-control" type="text" readonly onfocus="cargarExcel();" name="excel" maxlength="100" size="80" value="" >
			<div class="input-group-btn">
				<button type="button" class="btn btn-info" id="cargar" onclick="cargarExcel();"><i class="fa fa-plus"> Cargar</i></button>
			</div>
			</div>
		</div>
		
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<label>Formatos Agregados</label>
			<select class="form-control" name="id_form" id="id_form" onchange="validarformato_sms();">
				<?php echo verFormatos($acceso);?>
			</select>
		</div>
		
		<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<label>Mensaje</label>
			<textarea class="form-control" name="sms" rows="3" cols="1" onKeyUp="cuenta_carac_com_m();">
			<?php
			$acceso->objeto->ejecutarSql("select * from formato_sms where status='ACTIVO'");
			$row=row($acceso);
			echo trim($row["formato"]);
			?>
			</textarea>
			<span class="help-inline">Caracteres: </span><label id="cant_car_m">0</label> / <label id="cant_sms_m">1</label></span>
		</div>
		
		</div>
			
		</div> <!-- FIN DEL PANEL -->	
			
	</section>
	
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="<?php echo $obj->in;?>" name="LISTAR" value="listar datos" onclick="listarDatosSMS()"><i class="glyphicon glyphicon-list"></i> Listar Datos</button>
				<button class="btn btn-warning" disabled type="<?php echo $obj->in;?>" name="registrar" value="ENVIAR MENSAJE" onclick="enviar_sms_excel()"><i class="glyphicon glyphicon-envelope"></i> Enviar Mensaje</button>
				<input disabled type="hidden" name="modificar" value="ACTUALIZAR ARCHIVO" onclick="act_datos_sms()">
				<input type="hidden" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','status_contrato')">
				<button class="btn btn-info" type="button" name="Resetear" onclick="javascript:conexionPHP_sms('formulario.php','envia_sms_excel')" value="LIMPIAR"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>
	
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Listado de Clientes a Enviar Mensajes</header>
		
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
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>