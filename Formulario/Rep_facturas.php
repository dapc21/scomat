<?php 
	session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_FACTURAS')))
{

?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_reporte_cliente_sector" >
	
	<div class="border-head"><h3>Reporte de Auditoría de Facturas/Contratos</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Facturas/Contratos</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Tipo</label>
				<select class="form-control" name="tipo" id="tipo" onchange="cargar_cob_ven();">
					<option value=""><?php echo _("TODOS");?></option>
					<option value="FACTURA"><?php echo _("FACTURA");?></option>
					<option value="CONTRATO"><?php echo _("CONTRATO");?></option>
				</select>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Nº de Factura/Contrato</label>
				<input class="form-control" type="text" name="nro_recibo" id="nro_recibo" maxlength="10" size="15" value="" onchange="buscar_facturas_a();">
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Cobrador</label>
				<select class="form-control" name="id_cobrador" id="id_cobrador"  onchange="buscar_facturas_a();">
					<?php echo vercobradores($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Asignado/Recibido por</label>
				<select class="form-control" name="login" id="login" onchange="buscar_facturas_a();">
					<option value=""><?php echo _("todos");?></option>
					<?php echo verUsuarios($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<label>Fecha de Asignación/Recepción</label >
				<div class="has-js">
				<div class="radios">
				<label class="label_radio" for="fecha_general">
					<input type="radio" checked name="tipo_costo" id="fecha_general" value="GENERAL" onchange="hab_total_cli_fec();" /> General
				</label>
				<label class="label_radio" for="fecha_especifica">
					<input type="radio" name="tipo_costo" id="fecha_especifica" value="ESPECIFICO" onchange="hab_total_cli_fec();" /> Específico
				</label>
				</div>
				</div>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Estatus Factura</label>
				<select class="form-control" name="status_pago" id="status_pago"  onchange="buscar_facturas_a();">
					<option value=""><?php echo _("TODOS");?></option>
					<option value="ASIGNADO"><?php echo _("ASIGNADO");?></option>
					<option value="RECIBIDO"><?php echo _("RECIBIDO");?></option>
					<option value="FACTURADO"><?php echo _("FACTURADO");?></option>
					<option value="DEVUELTO"><?php echo _("DEVUELTO");?></option>
					<option value="ANULADO"><?php echo _("ANULADO");?></option>
				</select>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Desde</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" disabled type="text" name="desde" id="desde" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Hasta</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" disabled type="text" name="hasta" id="hasta" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			</div>
			
			</div>

		</div> <!-- FIN DEL PANEL --> 

	</section>
	
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<input  type="hidden" name="registrar" value="<?php echo _("imprimir reporte");?>" onclick="ImprimirRep_totalclientes();">
			<button class="btn btn-success" type="button" name="registrar" value="<?php echo _("buscar");?>" onclick="buscar_facturas_a();"><i class="glyphicon glyphicon-search"></i> Buscar</button>
			<button class="btn btn-warning" type="button" name="registrar" value="imprimir" onclick="GuardarRep_facturas();"><i class="glyphicon glyphicon-print"></i> Imprimir</button>
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','Rep_facturas');" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	
	<section class="panel">
	
		<header class="panel-heading">Datos de los Clientes</header>
	
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