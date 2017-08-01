<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REALIZAR_COMPRA'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_registrar_compra"  action="javascript:func_vacia();">
	
	<div class="border-head"><h3>Registro de Compras</h3></div>
	
	<div id="div_ped" style="display:none;">
	<!-- AREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TITULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Proveedor</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<input  type="hidden" name="id_mov" id="id_mov" maxlength="10" size="30"onChange="validarmovimiento()" value="<?php $acceso->objeto->ejecutarSql("select *from movimiento  where (id_mov ILIKE '$ini_u%') ORDER BY id_mov desc LIMIT 1 offset 0"); echo $ini_u.verCodLong($acceso,"id_mov")?>">
			<input  type="hidden" name="id_ped" maxlength="8" size="30"onChange="validarpedido()" value="" > 
			<input readonly type="hidden" name="fecha_ent_sal" id="fecha_ent_sal" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
			<input readonly type="hidden" name="hora_ent_sal" maxlength="15" size="10" value="<?php echo date("H:i:s");?>" >
			<input  type="hidden" name="tipo_mov" maxlength="20" size="30" value="A0000001" >
			<input  type="hidden" name="id_tm" maxlength="20" size="30" value="A0000001" >
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Proveedor</label>
				<select class="form-control" name="id_prov"  id="id_prov" onchange="validarpedido2();">
					<?php echo verProveedor($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Fecha del Pedido</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text"  name="fecha_ped" id="fecha_ped" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
				<!--  FECHA DE ENTREGA PEDIDO-->
				<input type="hidden" readonly name="fecha_ent" id="fecha_ent" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Observación</label>
				<textarea class="form-control" name="obser_ped" cols="1" rows="2"></textarea>
			</div>

			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Nº de Factura</label>
				<input class="form-control" type="text"  name="nro_fact_ped" maxlength="10" size="20" value="0" >
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>% de Descuento</label>
				<input class="form-control" type="text" name="porc_desc" maxlength="10" size="20" value="0" >
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Descuento Pedido</label>
				<input class="form-control" type="text" name="desc_ped" maxlength="10" size="20" value="0" >
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Base Pedido</label>
				<input class="form-control" type="text" name="base_ped" maxlength="10" size="20" value="0" >
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>IVA</label>
				<input class="form-control" type="text" name="iva_ped" maxlength="10" size="20" value="0" >	
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Total</label>
				<input class="form-control" type="text" name="total_ped" maxlength="10" size="20" value="0" >
			</div>
			
			</div>
			
			<div style="display:none;">		
				<input  type="text" readonly name="nro_fact_ped" maxlength="10" size="20" value="0000" >
				<input  type="text" name="porc_desc" maxlength="10" size="20" value="0" >
				<input  type="text" name="desc_ped" maxlength="10" size="20" value="0" >
				<input  type="text" name="base_ped" maxlength="10" size="20" value="0" >
				<input  type="text" name="iva_ped" maxlength="10" size="20" value="0" >			
				<input  type="text" name="total_ped" maxlength="10" size="20" value="00000000" >		
			</div>

			<input type="hidden" DISABLED  name="status_ped" value="COMPRADO">	
			<input  type="hidden" value="dato" name="dato">
			

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="<?php echo $obj->in;?>" name="modificar" value="<?php echo _("registrar");?>" onclick="verificar_mat('modificar','realizar_compra')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_mat('formulario.php','realizar_compra')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			<input type="hidden" name="registrar" value="<?php echo _("guardar");?>" onclick="verificar_mat('incluir','pedido')">
			<input type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','pedido')">
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL AREA DE PANEL O PANELES -->
	
	</div> <!-- FIN DEL DIV OCULTO --> 
	
	<section class="panel" id="tabla-pedido-aprobado">
	
		<header class="panel-heading">Datos de los Pedidos Registrados</header>
	
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