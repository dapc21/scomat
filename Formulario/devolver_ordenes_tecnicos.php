<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('imprimir_ordenes_tecnicos')))
{
?>
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="devolver_ordenes_tecnicos" >
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Órdenes de Servicios Devueltas</h3></div>
	
<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Grupo de Trabajo a Asignar Ordenes</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<input  class="form-control" type="hidden" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','ordenes_tecnicos')">&nbsp;
			<input  class="form-control" type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','ordenes_tecnicos')">&nbsp;
			<input  class="form-control" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','ordenes_tecnicos')">&nbsp;
			<input  class="form-control" type="hidden" name="id_orden" maxlength="10" size="15" value="">
			
			<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<label>Asignar a Grupo</label>			
				<select class="form-control" name="id_gt" id="gt" onchange="">
					<?php echo verGrupoTec($acceso);?>
				</select>
			</div>	
			<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">								
				<label><i class="fa fa-edit label-blanco"></i></label>
				<div>
				<input type="checkbox" name="checkgrupo" value="checkbox" onchange="bloquea_asig_grupo();" checked /> &nbsp;Selección Automática
				</div>
			</div>						
		</div> <!-- FIN DEL PANEL -->	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->

	<section class="panel" id="tabla-devolver-orden-servicio">			
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Órdenes de Servicios Para Imprimir</header>

		<div class="panel-body">
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div id="datagrid" class="data"></div>			
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