<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('BANCO')))
{
$acceso->objeto->ejecutarSql("select id_sinc from sincronizacion_servi  where (id_sinc ILIKE '$ini_u%')   ORDER BY id_sinc desc LIMIT 1 offset 0 ");
	$id_sinc=$ini_u.verCoo($acceso,"id_sinc");
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="sincronizacion_servi" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>sincronización de base de datos</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos a registrar</header>
		
		<div class="panel-body">

			<input class="form-control" type="hidden" name="id_sinc" maxlength="10" size="30"onChange="validarsincronizacion_servi()" value="<?php echo $id_sinc;?>">
			<input class="form-control" type="hidden" value="" name="dato">
			<input class="form-control" type="hidden" value="" name="id_servidor">
			<input class="form-control" type="hidden" value="" name="fecha_sinc">
			<input class="form-control" type="hidden" value="" name="hora_sin">
			<input class="form-control" type="hidden" value="" name="oid_inicial">
			<input class="form-control" type="hidden" value="" name="oid_final">
			<input class="form-control" type="hidden" value="" name="id_servidor">
			
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("Sincronizar Base de Datos");?>" onclick="verificar('incluir','sincronizacion_servi')"><i class="fa fa-cog"></i> Sincronizar Base de Datos</button>		
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','sincronizacion_servi')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
				<input class="form-control" type="HIDDEN" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','sincronizacion_servi')">
				<input class="form-control" type="HIDDEN" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','sincronizacion_servi')">
			</div>
			
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	
	<section class="panel" id="tabla-sincroniza-servidor">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la última sincronización exitosa</header>
		
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




