<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('act_contrato')))
{

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="consultaID" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Consulta ID</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Contrato</header>
		
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>Id contrato</label>
					<div class="input-group">
						<input class="form-control" type="text" name="id_contrato" onChange="c_id_contrato()" maxlength="12" size="10" value="" >
						<div class="input-group-btn">
							<button type="button" class="btn btn-info" id="c_id_contrato" onclick="c_id_contrato();"><i class="fa fa-search"></i></button>	
						</div>
					</div>
				</div>
				
				<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>Nº de Abonado</label>
					<div class="input-group">
						<input class="form-control" type="text" name="nro_contrato" onChange="c_nro_contrato()" maxlength="10" size="10" value="" >
						<div class="input-group-btn">
							<button type="button" class="btn btn-info" id="c_nro_contrato" onclick="c_nro_contrato();"><i class="fa fa-search"></i></button>	
						</div>
					</div>
				</div>
				
				<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>RIF/Cédula</label>
					<div class="input-group">
						<input class="form-control" type="text" name="cedula_b" maxlength="10" size="10" value="" onChange="c_cedula();">
						<div class="input-group-btn">
							<button type="button" class="btn btn-info" id="c_cedula" onclick="c_cedula();"><i class="fa fa-search"></i></button>	
						</div>
					</div>
				</div>
			
			</div>
			
		</div> <!-- FIN DEL PANEL -->
	
	</section>			
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Pagos</header>
		
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>Id pago</label>
					<div class="input-group">
						<input class="form-control" type="text" name="id_pago" onChange="c_id_pago()" maxlength="12" size="20" value="" >
						<div class="input-group-btn">
							<button type="button" class="btn btn-info" id="id_pago" onclick="c_id_pago();"><i class="fa fa-search"></i></button>	
						</div>
					</div>
				</div>
				
				<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>Nº Factura</label>
					<div class="input-group">
						<input class="form-control" type="text" name="nro_factura" onChange="c_nro_factura()" maxlength="12" size="20" value="" >
						<div class="input-group-btn">
							<button type="button" class="btn btn-info" id="c_nro_factura" onclick="c_nro_factura();"><i class="fa fa-search"></i></button>	
						</div>
					</div>
				</div>
				
				<input class="form-control" disabled type="hidden" name="registrar" value="<?php echo _("registrar cobro");?>" onclick="verificar('incluir','pagos')">&nbsp;
				<input class="form-control" type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','pagos')">&nbsp;
				<input class="form-control" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','pagos')">&nbsp;
							
			
			</div>
			
		</div> <!-- FIN DEL PANEL -->
	
	</section>
			
	<section class="panel">				
		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="result" class="cabe"></div>
					
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