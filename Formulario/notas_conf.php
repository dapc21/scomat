<?php require_once "procesos.php"; 
$ini_u = $_SESSION["ini_u"];
$login = $_SESSION["login"];
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('AUTORIZAR CREDITO/DEBITO')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="notas_conf" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Autorizar Débito/Crédito</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Búsqueda de Pagos Registrados</header>
		
		<div class="panel-body">	

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="text-btn" align="center">
					<input  type="hidden" name="registrar" value="<?php echo _("buscar");?>" onclick="buscar_confir_dep()">&nbsp;				
					<button class="btn btn-success" type="button" name="salir" onclick="conexionPHP('formulario.php','notas_conf')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i>Refrescar</button>
					
					<input class="form-control" type="hidden" value="dato" name="registrar">
					<input class="form-control" type="hidden" value="dato" name="modificar">
					<input class="form-control" type="hidden" value="dato" name="eliminar">
				</div>	
			</div>
			
		</div> <!-- FIN DEL PANEL -->
	
	</section>
			
	<section class="panel" id="tabla-autorizar-debitocredito1">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">DEPOSITOS / TRANSFERENCIAS PENDIENTES POR CONFIRMAR</header>
		
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