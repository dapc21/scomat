<?php
require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('parametros')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1" data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Parámetros Generales del Sistema</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Parámetro General</header>
			<div class="panel-body">
			
				<input class="form-control" type="hidden" id="id_param" name="id_param" maxlength="4" size="30" onChange="validarparametros()" value="<?php $acceso->objeto->ejecutarSql("select * from parametros ORDER BY id_param desc"); echo verNumero($acceso,"id_param")?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Franquicia</label>																				
						<select data-parsley-id="id_franq" class="form-control" name="id_franq" id="id_franq" onchange="">
							<?php echo verFranquicia($acceso);?>
						</select>
						<ul id="parsley-id-id_franq" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Fecha</label >						
						<input data-parsley-id="fecha_param" class="form-control form-control-inline input-medium default-date-picker" type="text" name="fecha_param" data-mask="99/99/9999" id="fecha_param" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
						<ul id="parsley-id-fecha_param" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Parámetro</label>																				
						<input data-parsley-id="parametro" class="form-control" type="text" id="parametro" name="parametro" maxlength="30" size="30" value="" >
						<ul id="parsley-id-parametro" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Valor del Parámetro</label>																				
						<input data-parsley-id="valor_param" class="form-control" type="text" id="valor_param" name="valor_param" maxlength="60" size="30" value="" >
						<ul id="parsley-id-valor_param" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Observación</label>																				
						<textarea data-parsley-id="obser_param" class="form-control" id="obser_param" name="obser_param" cols="30" rows="2"></textarea>
						<ul id="parsley-id-obser_param" class="parsley-errors-list"></ul>
					</div>
				
				</div>
				
			</div> <!-- FIN DEL PANEL -->	
			
	</section>	

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
		<div id="error" class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
						<button disabled class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" id="modificar" name="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_parametros('modificar','parametros')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
						<button class="btn btn-info" type="button" id="salir" name="salir" onclick="cargar_form_parametros();" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
						<input class="form-control" type="hidden" id="registrar" name="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_parametros('incluir','parametros')">
						<input disabled class="form-control" type="hidden" id="eliminar" name="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_parametros('eliminar','parametros')">
				</div>	
			</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>		
		
	<section class="panel" id="tabla-parametro">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Parámetros Registrados</header>
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