<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('INVENTARIO'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_inventario"  action="javascript:func_vacia();">
	
	<div class="border-head"><h3>Administración de Inventarios</h3></div>
	
	<!-- AREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TITULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Inventario</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<input  type="hidden" name="idinventario" maxlength="8" size="30"onChange="validarinventario_mat()" value="<?php $acceso->objeto->ejecutarSql("select *from inventario where (id_inv ILIKE '$ini_u%') ORDER BY id_inv desc LIMIT 1 offset 0"); echo $ini_u.verCo($acceso,"id_inv")?>">
			<input  type="hidden"  name="tipoinv" maxlength="15" size="30" value="MATERIALES" >
			<input  type="hidden"  name="status_inv" id="status_inv" maxlength="15" size="30" value="REGISTRADO" >
			
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<label>Motivo</label>
				<select class="form-control" name="idmotivo" id="idmotivo" onchange="">
						<?php echo verMotivoInv($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<label>Fecha</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" disabled name="fechainv" id="fechainv" maxlength="12" size="20" value="<?php echo date("d/m/Y");?>" >
			</div>
			
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<label>Hora</label>
				<input class="form-control" type="text" readonly name="horainv" maxlength="12" size="15" value="<?php echo date("H:i:s");?>" >
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Observación</label>
				<textarea class="form-control" name="obserinv" cols="1" rows="2"></textarea>
			</div>
			
			<input  type="hidden" value="dato" name="dato">
			
			</div>
			

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar_mat('incluir','inventario')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_mat('formulario.php','inventario')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
				<input  type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_mat('modificar','inventario')">
				<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','inventario')">
			</div>
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL AREA DE PANEL O PANELES -->
	<section class="panel" id="tabla-inventario">
	
		<header class="panel-heading">Datos de los Materiales Registrados</header>
	
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Depósito</label>
				<select class="form-control" name="iddep" id="iddep" onchange="filtraInventario_inv(this.id,'idfam','inventario');">
					<?php echo verDeposito02($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Familia</label>
				<select class="form-control" name="idfam" id="idfam" onchange="filtraInventario_inv('iddep',this.id,'inventario');" >
					<?php echo verFamilia($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg12 col-md-12 col-sm-12 col-xs-12">
				<div id="datagrid" class="data"></div>
			</div>
			
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