<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_PROVEEDORES'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_reporte_mat_indep" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Listado de Proveedores</h3></div>
	
					
	<section class="panel">
	
		<div class="panel-body">
		
			<div id="datagrid" class="data"></div>
		
		</div> <!-- FIN DEL PANEL --> 						
	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->	

	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" name="registrar" value="IMPRIMIR REPORTE" onclick="ImprimirRep_proveedores();"><i class="glyphicon glyphicon-print"></i> Imprimir</button>
			<input  type="hidden" name="modificar" value="CANCELAR">
			<input  type="hidden" name="eliminar" value="CANCELAR">
			<input  type="hidden" name="Resetear" value="CANCELAR">
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