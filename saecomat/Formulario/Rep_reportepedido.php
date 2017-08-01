<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_REPORTEPEDIDO'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_reporte_pedido" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Reporte de Pedidos</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Pedido</header>
		
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<input type="hidden" name="id_contrato" maxlength="10" size="20" value="">

			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Desde</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fechades" id="fechades" maxlength="10" size="12" value="<?php echo date("d/m/Y");?>" >
			</div>	
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Hasta</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fechahas" id="fechahas" maxlength="10" size="12" value="<?php echo date("d/m/Y");?>" >
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Proveedor</label >			
				<select class="form-control" name="id_prov" id="id_prov" onchange="filtraReporPedido('status','fechades','fechahas','id_prov');">
					<?php echo verProveedor($acceso);?>
				</select>				
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Estatus</label>			
				<select class="form-control" name="id_prov" id="id_prov" onchange="filtraReporPedido('status','fechades','fechahas','id_prov');">
					<option value="0"><?php echo _("Seleccione...");?></option>
					<option value="SOLICITADO"><?php echo _("SOLICITADO");?></option>
					<option value="APROBADO"><?php echo _("APROBADO");?></option>
					<option value="COMPRADO"><?php echo _("COMPRADO");?></option>
					<option value="DENEGADO"><?php echo _("DENEGADO");?></option>
				</select>
			</div>
			<input  type="hidden" value="dato" name="dato">
		</div> <!-- FIN DEL PANEL -->
		
		</div>
		
	</section>	

	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" name="buscar" value="<?php echo _("buscar");?>" onclick="filtraReporPedido('status','fechades','fechahas','id_prov');"><i class="glyphicon glyphicon-search"></i> Buscar</button>
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','Rep_reportepedido')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>
		
		</div> <!-- FIN DEL PANEL --> 						
	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	
	<section class="panel">
		<header class="panel-heading">Movimientos</header>
		<div class="panel-body">
		
			<div id="datagrid" class="data"></div>
		
		</div> <!-- FIN DEL PANEL --> 						
	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->	
	
	<div align="center">
		<input  type="HIDDEN" name="registrar" value="IMPRIMIR REPORTE" onclick="ImprimirRep_reportepedido()">
		<input  type="hidden" name="modificar" value="CANCELAR">
		<input  type="hidden" name="eliminar" value="CANCELAR">
		
	</div>

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