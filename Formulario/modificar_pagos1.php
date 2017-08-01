<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('MODIFICAR_FACT')))
{

$fecha= date("Y-m-d");
$id_persona=$_SESSION["id_persona"];
$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha' and status_caja_cob='Abierta'");

	$row=row($acceso);
	$id_caja_cob=trim($row['id_caja_cob']);
	$nombre=trim($row["nombre_caja"])." => ".trim($row["nombre"])." ".trim($row["apellido"]);
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_modificar_nro_factura" >
	
	<div class="border-head"><h3>Modificar Nº de Factura</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Factura</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<label>Nº Factura</label>		
			<div class="input-group">
			<input class="form-control" type="text" name="nro_factura" onChange="c_nro_factura();" maxlength="12" size="20" value="" >
			<div class="input-group-btn">
				<button type="button" class="btn btn-info" id="buscar_abonado" onclick="c_nro_factura();"><i class="fa fa-search"></i></button>	
			</div>
			</div>
			</div>
			
			</div>

		</div> <!-- FIN DEL PANEL --> 

	</section>
	
	<div id="result"></div>
	
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Pago</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<input  type="hidden" name="id_pago" maxlength="15" size="10"onChange="validarpagos()" value="">
		
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Nº de Factura (nuevo)</label>
			<input class="form-control" type="text" name="nro_factura1" onChange="" maxlength="10" size="15" value="" >
			</div>

			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Nº de Control (nuevo)</label>
			<input class="form-control" type="text" name="nro_control1" onChange="" maxlength="10" size="15" value="" >
			</div>

			<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
			<label>Punto de Cobro</label>
			<select class="form-control" name="id_caja_cob" id="id_caja_cob" onchange="">
			<?php echo verPuntoC($acceso);?>
			</select>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Fecha</label>
			<input class="form-control" type="text" name="fecha_pago" id="fecha_pago" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Hora</label>
			<input class="form-control" type="text" name="hora_pago" maxlength="8" size="15" value="<?php echo date("H:i:s");?>" >
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Forma de Pago</label>
			<select class="form-control" name="id_tipo_pago" id="id_tipo_pago" onchange="cargarDetTipoPago();">
			<?php echo verTipoPago($acceso);?>
			</select>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Banco</label>
			<select class="form-control" name="banco" id="banco"  onchange="">
			<?php echo verBanco($acceso);?>
			</select>
			</div>

			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Número</label>
			<input class="form-control" type="text" name="numero" maxlength="25" size="15" value="" readonly>
			<input class="form-control" type="hidden" value="" name="obser_detalle">
			</div>

			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Monto del Pago</label>
			<input class="form-control" type="text" name="monto_pago" maxlength="10" size="15" value="0" readonly>
			</div>

			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<label>Observación</label>
			<textarea class="form-control" name="obser_pago" cols="1" rows="2" readonly></textarea>
			</div>
			
			<input  type="hidden" value="dato" name="dato">
			<input type="hidden" name="status_pago" maxlength="15" size="15" value="PAGADO" >
			<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">
			
		</div>

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-warning" type="<?php echo $obj->in; ?>" name="modificar" value="<?php echo _("modificar factura");?>" onclick="verificar('modificar_num_fac','modificar_pagos1')"><i class="glyphicon glyphicon-refresh"></i> Modificar nro Factura</button>
			<button class="btn btn-warning" type="<?php echo $obj->in; ?>" name="modificar" value="<?php echo _("modificar factura");?>" onclick="verificar('modificar_num_control','modificar_pagos1')"><i class="glyphicon glyphicon-refresh"></i> Modificar nro Control</button>
			<button class="btn btn-success" type="button" name="salir" onclick="conexionPHP('formulario.php','modificar_pagos1')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			<input class="btn btn-danger" readonly type="hidden" name="registrar" value="<?php echo _("anular pago");?>" onclick="verificar('anular','pagos')">
			<input class="btn btn-danger" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','pagos')">
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->

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