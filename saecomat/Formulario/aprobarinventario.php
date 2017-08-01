<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('APROBARINVENTARIO'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_aprobar_inventario"  action="javascript:func_vacia();">


	<div id="div_ped" style="display:none;">
	
	<div class="border-head"><h3>Aprobación de Inventarios</h3></div>
	
	<!-- AREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TITULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Inventario</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<input  type="hidden" name="id_mov" id="id_mov" maxlength="10" size="30"onChange="validarmovimiento()" value="<?php $acceso->objeto->ejecutarSql("select *from movimiento where (id_mov ILIKE '$ini_u%') ORDER BY id_mov desc LIMIT 1 offset 0"); echo $ini_u.verCodLong($acceso,"id_mov")?>">
			<input  type="hidden" name="id_mov2" id="id_mov2" maxlength="10" size="30"onChange="validarmovimiento()" value="<?php $acceso->objeto->ejecutarSql("select *from movimiento where (id_mov ILIKE '$ini_u%') ORDER BY id_mov desc LIMIT 1 offset 0"); echo $ini_u.verCodLong2($acceso,"id_mov")?>">
			<input  type="hidden" name="idinventario" maxlength="8" size="30"onChange="validarinventario_mat()" value="<?php $acceso->objeto->ejecutarSql("select *from inventario where (id_inv ILIKE '$ini_u%') ORDER BY id_inv desc LIMIT 1 offset 0"); echo $ini_u.verCo($acceso,"id_inv")?>">
			<input  type="hidden"  name="tipoinv" maxlength="15" size="30" value="MATERIALES" >
			<input  type="hidden"  name="status_inv" id="status_inv" maxlength="15" size="30" value="AJUSTADO" >
			<input  type="hidden" name="id_tmaunmento" id="id_tmaunmento" maxlength="10" size="30" value="A0000003">
			<input  type="hidden" name="id_tmdescuento" id="id_tmdescuento" maxlength="10" size="30" value="A0000004">
			
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<label>Fecha</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" disabled name="fechainv" id="fechainv" maxlength="12" size="20" value="<?php echo date("d/m/Y");?>" >
			</div>
			
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<label>Hora</label>
				<input class="form-control" type="text" readonly name="horainv" maxlength="12" size="15" value="<?php echo date("H:i:s");?>" >
			</div>
			
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<label>Motivo</label>
				<select class="form-control" name="idmotivo" id="idmotivo" onchange="">
						<?php echo verMotivoInv($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Observación</label>
				<textarea class="form-control" name="obserinv" cols="1" rows="2"></textarea>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Depósito</label>
				<select class="form-control" name="iddep" id="iddep" onchange="filtraInventario(this.id,'idfam','aprobarinventario');">
					<?php echo verDeposito02($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Familia</label>
				<select class="form-control" name="idfam" id="idfam" onchange="filtraInventario('iddep',this.id,'aprobarinventario');" >
					<?php echo verFamilia($acceso);?>
				</select>
			</div>
			
			<input  type="hidden" value="dato" name="dato">
			
			</div>
			

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<input  type="hidden" name="registrar"  value="<?php echo _("registrar");?>" onclick="verificar_mat('incluir','inventario')">
			<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','inventario')">
			<button class="btn btn-success"  type="<?php echo $obj->in;?>" name="ajustar" value="<?php echo _("ajustar stock");?>" onclick="verificar_mat('modificar','aprobarinventario')"><i class="glyphicon glyphicon-ok"></i> Ajustar Stock</button>
			<button class="btn btn-success"  type="<?php echo $obj->in;?>" name="modificar" value="<?php echo _("verificar");?>" onclick="verificar_mat('modificar','inventario')"><i class="glyphicon glyphicon-ok"></i> Verificar</button>
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_mat('formulario.php','aprobarinventario')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL AREA DE PANEL O PANELES -->
	
	</div>
	
	<section class="panel" id="tabla-aprobarinventario">
	
		<header class="panel-heading">Datos de los Inventarios Registrados</header>
	
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