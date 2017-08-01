<?php session_start();require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('BANCO')))
{
?>


<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
	<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
	<form role="form" name="f1" id="f1">
	
		<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
		<div class="border-head"><h3>Consulta de estados de cuentas bancarios</h3></div>
			
			<section class="panel">
	
				<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Consultar Tablas Banco</header>
		
				<div class="panel-body">	
				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>Cuenta Bancaria</label>
							<select class="form-control" name="id_cuba" id="id_cuba" onchange="">
								<?php echo vercuenta_bancaria($acceso);?>
							</select>
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>TIPO</label>
							<select class="form-control" name="tipo_tb" id="tipo_tb" onchange="">
								<option value="0">TODOS</OPTION>
								<option value="CLIENTES">CLIENTES</OPTION>
								<option value="FRANQUICIAS">FRANQUICIAS</OPTION>
								<option value="OTROS">OTROS</OPTION>
							</select>
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>Fecha Desde</label >
							<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="fecha_desde_ctb" id="fecha_desde_ctb" maxlength="10" size="30" value="">							
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>Fecha Hasta</label >
							<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="fecha_hasta_ctb" id="fecha_hasta_ctb" maxlength="10" size="30" value="">							
						</div>
					
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>Referencia</label>
							<input class="form-control" type="text" name="referencia_tb" id="referencia_tb" maxlength="30" size="30" value="" >
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>Monto</label>
							<input class="form-control" type="text" name="monto_tb" id="monto_tb" maxlength="10" size="30" value="" >
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>Status Tabla Banco</label>
							<select class="form-control" name="status_tb" id="status_tb" onchange="">
								<option value="0">TODOS</OPTION>
								<option value="REGISTRADO">REGISTRADO</OPTION>
								<option value="CONCILIADO">CONCILIADO</OPTION>
								<option value="NO RELACIONADO">NO RELACIONADO</OPTION>
							</select>
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>Descripción</label>
							<input class="form-control" type="text" name="descrip_tb" id="descrip_tb" maxlength="250" size="30" value="" >
						</div>
					
					</div>
					
					<input  type="hidden" value="dato" name="dato" id="dato">

				</div> <!--fin panel body-->	
				
			</section>
			
			<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">		
				<div class="panel-body">
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
						<button class="btn btn-info" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="BUSCAR" onclick="buscar_registro_banco()"><i class="glyphicon glyphicon-search"></i> Buscar</button>
						
						<input  type="hidden" name="modificar" id="modificar" value="MODIFICAR" onclick="verificar('modificar','tabla_bancos')">&nbsp;
						
						<input  type="hidden" name="eliminar" id="eliminar" value="ELIMINAR" onclick="verificar('eliminar','tabla_bancos')">&nbsp;																		
						<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_tabla_bancos()"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
						
					</div>		
				</div> <!-- FIN DEL PANEL -->	
			</section>	
			
			<section class="panel">		
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Tablas Bancos Agregadas</header>
					<div class="panel-body">	
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
							<div id="datagrid" class="data">
							
						</div>		
				</div> <!-- FIN DEL PANEL -->	
			</section>
			
		</form>	
		
</div>	<!--fin panel principal-->		


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