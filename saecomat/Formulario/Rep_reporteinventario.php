<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_REPORTEINVENTARIO'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_reporte_mat_indep" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Reporte de Inventarios</h3></div>

	<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Pedido</header>
		
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Desde</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fechades" id="fechades" maxlength="10" size="12" value="<?php echo date("d/m/Y");?>" >
			</div>	
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Hasta</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fechahas" id="fechahas" maxlength="10" size="12" value="<?php echo date("d/m/Y");?>" >
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Tipos</label>
				<select class="form-control" name="id_mov" id="id_mov" onchange="filtraReporInventario('id_mov','fechades','fechahas','id_dep','status');" >
					<?php echo verMotivoInv($acceso);?>
				</select>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Estatus</label>
				<select class="form-control" name="status" id="status" onchange="filtraReporInventario('id_mov','fechades','fechahas','id_dep','status');">
					<option value="0"><?php echo _("Seleccione...");?></option>
					<option value="REGISTRADO"><?php echo _("REGISTRADO");?></option>
					<option value="REVISADO"><?php echo _("REVISADO");?> </option>
					<option value="AJUSTADO"><?php echo _("AJUSTADO");?></option>
				</select>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Depósito</label>
				<select class="form-control" name="id_dep" id="id_dep" onchange="filtraReporInventario('id_mov','fechades','fechahas','id_dep','status');">
					<?php echo verDeposito02($acceso);?>
				</select>
			</div>
			
		</div>
		
		</div>
										
		<input  type="hidden" value="dato" name="dato">
			
		<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="<?php echo $obj->in;?>" name="buscar" value="<?php echo _("Buscar");?>" onclick="filtraReporInventario('id_mov','fechades','fechahas','id_dep','status');"><i class="glyphicon glyphicon-search"></i> Buscar</button>
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_mat('formulario.php','Rep_reporteinventario')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			
		</div>
		
		</div> <!-- FIN DEL PANEL --> 						
	
	</section>
	
	<section class="panel">
	
		<div class="panel-body">
		
			<div id="datagrid" class="data"></div>
		
		</div> <!-- FIN DEL PANEL --> 						
	
	</section>
				
	<div align="center">
		<input  type="hidden" name="registrar" value="IMPRIMIR REPORTE" onclick="ImprimirRep_reporteinventario()">&nbsp;
		<input  type="hidden" name="modificar" value="CANCELAR">
		<input  type="hidden" name="eliminar" value="CANCELAR">
		<input  type="hidden" name="Resetear" value="CANCELAR">
	</div>
	
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