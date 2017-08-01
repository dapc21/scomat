<?php session_start();require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"]; 
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
		<div class="border-head"><h3>Administración de Cuentas Bancarias</h3></div>
			
			<section class="panel">
	
				<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Datos de Cuentas Bancarias</header>
		
				<div class="panel-body">	
		
					<input  type="HIDDEN" name="id_cuba" id="id_cuba"maxlength="8" size="30"onChange="validarcuenta_bancaria()" value="<?php $acceso->objeto->ejecutarSql("select *from cuenta_bancaria  where (id_cuba ILIKE '$ini_u%') ORDER BY id_cuba desc"); echo $ini_u.verCo($acceso,"id_cuba")?>">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>Empresa</label>
							<select data-parsley-id="desc_cuba" required="" class="form-control" name="desc_cuba" id="desc_cuba" onchange="">
								<?php echo verEmpresas($acceso);?>
							</select>
							<ul id="parsley-id-desc_cuba" class="parsley-errors-list"></ul>
						</div>
					
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>BANCO</label>
							<select data-parsley-id="banco_cuba" required="" class="form-control" name="banco_cuba" id="banco_cuba" onchange="">
								<?php echo verbancoEmp($acceso);?>
							</select>
							<ul id="parsley-id-banco_cuba" class="parsley-errors-list"></ul>
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>número de cuenta</label>
							<input data-parsley-id="numero_cuba" required="" class="form-control" type="text" name="numero_cuba" id="numero_cuba" maxlength="20" size="30" value="" onChange="validar_numero_cuba_cuenta_bancaria()">
							<ul id="parsley-id-numero_cuba" class="parsley-errors-list"></ul>
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>abreviatura</label>
							<input data-parsley-id="abrev_cuba" required="" class="form-control" type="text" name="abrev_cuba" id="abrev_cuba" maxlength="20" size="30" value="">
							<ul id="parsley-id-abrev_cuba" class="parsley-errors-list"></ul>
						</div>
						
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							
							<label>FORMATO ARCHIVO</label>							
							<select class="form-control" name="formato_archivo" id="formato_archivo" onchange="">					
								<OPTION VALUE=".XLS">.CSV</OPTION>								
							</select>
							
						</div>												
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>comision débito</label>							
							<input class="form-control" type="text" name="comision_pv" id="comision_pv" maxlength="10" size="10" value="0" onChange="">&nbsp;&nbsp;							
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<label>comision Crédito</label>														
							<input class="form-control" type="text" name="comision_pv_c" id="comision_pv_c" maxlength="10" size="10" value="0" onChange="">
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
							
							<label>pago planilla / aplicacion</label>
							<div>	
								<input type="radio" name="conc_cliente" value="SI"CHECKED>SI
								<input type="radio" name="conc_cliente" value="NO">NO
							</div>
							
						</div>
										
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
							
							<label>punto de venta</label>
							<div>									
								<input  type="radio" name="conc_franq" value="SI"CHECKED>SI
								<input  type="radio" name="conc_franq" value="NO">NO
							</div>
							
						</div>
						
						<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
							
							<label>Status</label>
							<div>									
								<input  type="radio" name="status_cuba" value="ACTIVO"CHECKED>ACTIVO
								<input  type="radio" name="status_cuba" value="INACTIVO">INACTIVO
							</div>
							
						</div>
							
							<input  type="hidden" value="dato" name="dato" id="dato">
						
					</div>
		
				</div> <!--FIN PANEL BODY-->
				
			</section>
			
			<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">		
				<div class="panel-body">
				<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
					
						<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" onclick="gestionar_cuenta_bancaria('incluir','cuenta_bancaria')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
						
						<button disabled class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" id="modificar" onclick="gestionar_cuenta_bancaria('modificar','cuenta_bancaria')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
						
						<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" onclick="gestionar_cuenta_bancaria('eliminar','cuenta_bancaria')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>	

						<button class="btn btn-info" type="button" name="salir" onclick="cargar_form_cuenta_bancaria()"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
						
					</div>		
				</div> <!-- FIN DEL PANEL -->	
			</section>		
			
			<section class="panel">		
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Cuentas Bancarias Agregadas</header>
					<div class="panel-body">	
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
							<div id="datagrid_cuenta_bancaria" class="data">
							
						</div>		
				</div> <!-- FIN DEL PANEL -->	
			</section>	
			
	</form>
</div>	<!--FIN PANEL PRINCIPAL-->
							
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