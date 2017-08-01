<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('PEDIDO'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_pedido_material"  action="javascript:func_vacia();">
	
	<div class="border-head"><h3>Solicitud de Pedidos</h3></div>
	
	<!-- AREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TITULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Proveedor</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<input  type="hidden" name="id_ped" maxlength="8" size="30"onChange="validarpedido()" value="<?php $acceso->objeto->ejecutarSql("select * from pedido where (id_ped ILIKE '$ini_u%') ORDER BY id_ped desc LIMIT 1 offset 0"); echo $ini_u.verCoo($acceso,"id_ped")?>"> 
			<input  type="hidden" value="dato" name="dato">
			<input type="hidden" DISABLED  name="status_ped" value="SOLICITADO">
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Proveedor</label>
				<select class="form-control" name="id_prov" id="id_prov" onchange="validarpedido2()">
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
			
			<div style="display:none;">		
				<input  type="text" readonly name="nro_fact_ped" maxlength="10" size="20" value="0000" >
				<input  type="text" name="porc_desc" maxlength="10" size="20" value="0" >
				<input  type="text" name="desc_ped" maxlength="10" size="20" value="0" >
				<input  type="text" name="base_ped" maxlength="10" size="20" value="0" >
				<input  type="text" name="iva_ped" maxlength="10" size="20" value="0" >			
				<input  type="text" name="total_ped" maxlength="10" size="20" value="00000000" >		
			</div>
			
			</div>
			

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar_mat('incluir','pedido')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
			<button class="btn btn-warning" type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_mat('modificar','pedido')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
			<button class="btn btn-danger" type="<?php echo $obj->el;?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','pedido')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_mat('formulario.php','pedido')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL AREA DE PANEL O PANELES -->
	<section class="panel" id="tabla-pedido">
	
		<header class="panel-heading">Datos de los Materiales Registrados</header>
	
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Depósito</label>
				<select class="form-control" name="iddep" id="iddep" onchange="filtraPedido(this.id,'idfam')">
					<?php echo verDeposito02($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Familia</label>
				<select class="form-control" name="idfam" id="idfam" onchange="filtraPedido('iddep',this.id)" >
					<?php echo verFamilia($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label><i class="fa fa-edit label-blanco"></i></label>
				<div>
				<input type="checkbox" name="stock_min" id="checkbox01" value="" onchange="filtraPedido('iddep','idfam'); checkRadio();" />
					Con Stock Mínimo
				</div>
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
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