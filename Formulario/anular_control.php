<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('anular_pagos')))
{

$fecha= date("Y-m-d");
$id_persona=$_SESSION["id_persona"];
$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha' and status_caja_cob='Abierta'");

	$row=row($acceso);
	$id_caja_cob=trim($row['id_caja_cob']);
	$id_est=trim($row['id_est']);
	$nombre=trim($row["nombre_caja"])." => ".trim($row["nombre"])." ".trim($row["apellido"]);
	/*
	$ip_est = $_SERVER['REMOTE_ADDR'];
	$acceso->objeto->ejecutarSql("select * from estacion_trabajo where ip_est='$ip_est' and status_est='IMPRESORAFISCAL'");
	if($row=row($acceso)){
		$id_est=trim($row['id_est']);
	}
	*/
	$acceso->objeto->ejecutarSql("select n_credito,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob and status_pago='ANULADO' ORDER BY inc desc LIMIT 1 offset 0 "); 
	$n_credito = verCodFact($acceso,"n_credito");
	
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_anular_pagos" >
	
	<div class="border-head"><h3>Anular Control</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Factura</header>
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<label>Nº Control</label>
			<div class="input-group">
			<input class="form-control" type="text" name="nro_factura" onChange="c_nro_control();" maxlength="12" size="20" value="" >
			<div class="input-group-btn">
				<button type="button" class="btn btn-info" id="buscar_abonado" onclick="c_nro_control();"><i class="fa fa-search"></i></button>	
			</div>
			</div>
			</div>
			
			</div>

		</div> <!-- FIN DEL PANEL --> 

	</section>
	
	<div id="result"></div>
	
	

	<input disabled  type="hidden" name="total" maxlength="8" size="20" value="0" >
	<input disabled  type="hidden" name="desc"  maxlength="10" size="20" value="0" >
	<input disabled type="hidden" name="base_imp" maxlength="10" size="20" value="0" >
	<input disabled type="hidden" name="monto_iva" maxlength="10" size="20" value="0" >
	<input disabled type="hidden" name="monto_islr" maxlength="10" size="20" value="0" >
	<input disabled type="hidden" name="porc_reten" maxlength="10" size="20" value="0" >
	<input disabled type="hidden" name="monto_reten" maxlength="10" size="20" value="0" >
	<input  type="hidden" name="id_cont_serv" maxlength="12" size="15"onChange="validarcontrato_servicio()" value="<?php $acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); echo $ini_u.verCodLong($acceso,"id_cont_serv")?>">
	<input  type="hidden" name="fecha_inst" id="fecha_inst" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
	<input  type="hidden" name="cant_serv" maxlength="2" size="15" value="1" >
	
	<div id="datagrid" class="data">
		<input  type="hidden" name="total_reg_data" value="0">
	</div>

	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<input class="btn btn-danger" readonly type="hidden" name="registrar" value="<?php echo _("anular factura");?>" onclick="verificar('anular','pagos')">
			<input class="btn btn-danger" readonly type="hidden" name="eliminar" value="<?php echo _("anular factura");?>" onclick="verificar('anular','pagos')">
			<input class="btn btn-danger" readonly type="hidden" name="modificar" value="<?php echo _("anular factura");?>" onclick="verificar('anular','pagos')">
			<button class="btn btn-warning" type="<?php echo $obj->mo; ?>" name="modififgfcar" value="<?php echo _("anular pago");?>" onclick="anular_control()"><i class="fa fa-trash-o"></i> Anular Nro de control</button>
			
			<button class="btn btn-success" type="button" name="salir" onclick="conexionPHP('formulario.php','anular_control')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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