<?php session_start();require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
$login= $_SESSION["login"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('BANCO')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
	<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
	<form role="form" name="f1" id="f1" data-parsley-validate="">
	
		<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
		<div class="border-head"><h3>Cargar Tabla Banco</h3></div>
			
			<section class="panel">
	
				<!-- CABECERA O T?TULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Datos de Tabla Banco</header>
		
				<div class="panel-body">	
				
					<input  type="hidden" name="id_ctb" id="id_ctb" maxlength="30" size="30"onChange="validarcarga_tabla_banco()" value="<?php $acceso->objeto->ejecutarSql("select *from carga_tabla_banco   where (id_ctb ILIKE '$ini_u%') ORDER BY id_ctb desc"); echo $ini_u.verCoo($acceso,"id_ctb")?>">
					<input  type="hidden" name="fecha_ctb" id="fecha_ctb" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
					<input  type="hidden" name="hora_ctb" id="hora_ctb" maxlength="8" size="30" value="<?php echo date("H:i:s");?>" >
					<input  type="hidden" name="login_ctb" id="login_ctb"  maxlength="25" size="30" value="<?php echo $login;?>" >
					<input  type="hidden" name="status_ctb" id="status_ctb" maxlength="20" size="30" value="REGISTRADO" >
				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<label>Cuenta Bancaria</label>
							<select data-parsley-id="id_cuba" required="" class="form-control" name="id_cuba" id="id_cuba" onchange="">
								<?php echo vercuenta_bancaria($acceso);?>
							</select>
							<ul id="parsley-id-id_cuba" class="parsley-errors-list"></ul>
						</div>
						
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label>Archivo Banco</label>
							<input class="form-control" type="text" onclick="cargar_tabla_banco();" name="excel" id="excel" maxlength="100" value="" >							
						</div>
						
						<div class="form-group area-btn-agregar col-lg-2 col-md-2 col-sm-12 col-xs-12">					
							<button type="button" class="btn btn-info btn-txt" name="cargar" id="cargar" value="Cargar" onclick="cargar_tabla_banco()">
							<i class="fa fa-plus"></i> Cargar
							</button>
						</div>																
						
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>Fecha Desde</label >
							<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="fecha_desde_ctb" id="fecha_desde_ctb" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>">							
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>Fecha Hasta</label >
							<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="fecha_hasta_ctb" id="fecha_hasta_ctb" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>">							
						</div>
						
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label>Formato</label>
							<select data-parsley-id="formato_ctb" required="" class="form-control" name="formato_ctb" id="formato_ctb" onchange="">
								<option value="NORMAL">NORMAL</OPTION>
								<option value="PLANILLA BOD">PLANILLA BOD</OPTION>
								<option value="PROVINCIAL CONSULTA">PROVINCIAL CONSULTA</OPTION>
								<option value="EXTERIOR UNION">EXTERIOR UNION</OPTION>
								<option value="SOFITASA FORMATO 1">SOFITASA FORMATO 1</OPTION>
							</select>
							<ul id="parsley-id-formato_ctb" class="parsley-errors-list"></ul>
						</div>
					
					</div>
						
						<input  type="hidden" value="dato" name="dato" id="dato">
					
				</div> <!--fin panel body-->
				
			</section>	
			
			<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">		
				<div class="panel-body">
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
						<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" onclick="gestionar_carga_tabla_banco('incluir','carga_tabla_banco')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
						
						<button disabled class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" id="modificar" onclick="gestionar_carga_tabla_banco('modificar','carga_tabla_banco')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
						
						<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" onclick="gestionar_carga_tabla_banco('eliminar','carga_tabla_banco')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>																		
						<button class="btn btn-info" type="button" name="salir" onclick="cargar_form_carga_tabla_banco()"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
						
					</div>		
				</div> <!-- FIN DEL PANEL -->	
			</section>	
			
			<section class="panel">		
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Tablas Bancos Agregadas</header>
					<div class="panel-body">	
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
							<div id="datagrid_carga_tabla_banco" class="data">
							
						</div>		
				</div> <!-- FIN DEL PANEL -->	
			</section>	
			
	</form>	
	
</div>	<!--fin div general-->

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