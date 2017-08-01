<?php  
/*session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CARGAR_DEUDA1')))
{*/
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<form role="form" id="form_add_cargar_deuda" name="f1" >
<section class="panel">

<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
<header class="panel-heading">Datos del Cliente</header>

<div class="panel-body">

		<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Nº de Abonado</label>
				<input class="form-control" readonly type="text" name="nro_contrato" onChange="validarcontrato();" maxlength="11" size="12" value="" >
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>RIF/Cédula</label>
				<input class="form-control" readonly type="text" name="cedula" maxlength="10" size="10" value="" onChange="buscarXcedula();">
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Nombre(s)</label>
				<input  class="form-control" readonly type="text" name="nombre" maxlength="30" size="15" value="" >
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Apellido(s)</label>
				<input class="form-control" readonly type="text" name="apellido" maxlength="30" size="15" value="" >
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Estatus</label>
				<input class="form-control" readonly type="text" name="status_pago" maxlength="15" size="15" value="" >
			</div>
		</div>
		
</div> <!-- FIN DEL PANEL -->
	
</section>
<section class="panel">

<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
<header class="panel-heading">Datos de la Deuda a Cargar</header>

<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Tipo de Cargo</label>
				<div>
				<label for="tipo_cargo_mensual">
					<input type="radio" name="tipo_cargo" id="tipo_cargo_mensual" value="COSTO MENSUAL" checked onchange="activa_serv_cargo()"> Mensual &nbsp;
				</label>
				<label for="tipo_cargo_unico">
					<input type="radio" name="tipo_cargo" id="tipo_cargo_unico" value="COSTO UNICO"  onchange="activa_serv_cargo()"> Único
				</label>
				</div>
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Servicio</label>
				<select class="form-control" disabled name="id_serv" id="id_serv" onchange="traercs();">
					<?php /*echo verServiciosCostoU($acceso);*/?>
				</select>
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">	
				<label><i class="fa fa-edit label-blanco"></i></label>
				<input class="form-control" disabled type="text" name="costo" maxlength="10" size="10" value="" >
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">	
				<label>Mes</label>
				<select class="form-control" name="mes" id="mes" onchange="">
					<?php /*echo verMesCorte();*/?>
				</select>
			</div>
			
			</div>
			
				<!--div align="center">
					<input  type="<?php /*echo $obj->in;*/ ?>" name="registrar" value=<?php /*echo _("cargar deuda");*/?> onclick="verificar('cargar','cargar_d')">&nbsp;
					<input  type="hidden" name="modificar" value="<?php /*echo _("modificar");*/?>" onclick="verificar('modificar','ordenes_tecnicos')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php/* echo _("eliminar");*/?>" onclick="verificar('eliminar','ordenes_tecnicos')">&nbsp;
					
				</div-->

</div> <!-- FIN DEL PANEL -->			


</section>
</form>
</div>
<?php 
	/*}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}*/
?>