<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('imprimir_ordenes_tecnicos')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="imprimir_ordenes_tecnicos_corte" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>imprimir listado para llamdas</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-orden-tecnico-corte">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Listados de llamadas</header>
			<div class="panel-body">

				<input class="form-control" type="hidden" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','ordenes_tecnicos')">&nbsp;
				<input class="form-control" type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','ordenes_tecnicos')">&nbsp;
				<input class="form-control" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','ordenes_tecnicos')">&nbsp;
				<input class="form-control" type="hidden" name="id_orden" maxlength="10" size="15" value="">
				
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