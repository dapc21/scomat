<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CALLE')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="idiomas" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Configuración Regional de Idiomas</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Configuración Regional de Idiomas</header>
		
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>Idioma</label>													
					<select class="form-control" name="idioma" id="idioma" onchange="">
						<option value="en_SP=spanish"><?php echo _("espa&ntilde;ol");?></option>
						<option value="en_US=english"><?php echo _("ingles");?></option>
						<option value="en_PO=portuguese"><?php echo _("portugues");?></option>
					</select>
				</div>
				
				<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>País</label>													
					<select class="form-control" name="pais" id="pais" onchange="">
						<option value="Venezuela"><?php echo _("venezuela");?></option>
						<option value="Colombia"><?php echo _("colombia");?></option>
						<option value="Brasil"><?php echo _("brasil");?></option>
						<option value="ESTADOS UNIDOS"><?php echo _("estados unidos");?></option>
					</select>
				</div>
				
				<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>Moneda</label>													
					<select class="form-control" name="moneda" id="moneda" onchange="">
						<option value="Bs"><?php echo _("bolivar");?></option>
						<option value="Pesos"><?php echo _("peso");?></option>
						<option value="$"><?php echo _("dolar");?></option>
						<option value="R$"><?php echo _("real");?></option>
					</select>
				</div>
	
			
			</div>

		</div> <!-- FIN DEL PANEL -->
	
	</section>	

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("registrar");?>" onclick="cambiarIdioma()"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<input class="form-control" type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','calle')">
				<input class="form-control" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','calle')">
				<input class="form-control" type="hidden" name="salir" onclick="conexionPHP('formulario.php','calle')" value="LIMPIAR">
										
			</div>
		</div> <!-- FIN DEL PANEL -->	
	</section>	

	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Idiomas Registrados</header>
		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid" class="data"></div>						
					
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