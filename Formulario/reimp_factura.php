<?php 
//session_start();

require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
//echo ":$ini_u:";  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REIM_FACTURA')))
{
	$fecha= date("Y-m-d");
$id_persona=$_SESSION["id_persona"];
	$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha' and status_caja_cob='Abierta'");
	$row=row($acceso);
	$id_caja_cob=trim($row['id_caja_cob']);
	$inicial=trim($row['inicial']);
	//echo "select id_pago from pagos where (id_pago ILIKE '%$inicial%') ORDER BY id_pago desc LIMIT 1 offset 0 ";
	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '%$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$row=row($acceso);
	$id_pago =trim($row['id_pago']);
	//echo ":$id_pago:";
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_reimprimir_factura" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Reimprimir Última Factura de Pago</h3></div>
	
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<label>Nº Factura</label>		
			<div class="input-group">
			<input class="form-control" type="text" name="nro_factura" onChange="c_nro_factura_reimp();" maxlength="12" size="20" value="" >
			<div class="input-group-btn">
				<button type="button" class="btn btn-info" id="buscar_abonado" onclick="c_nro_factura_reimp();"><i class="fa fa-search"></i></button>	
			</div>
			</div>
			</div>
			
			
			</div>
<div id="result" class="data"></div>
			
			
		</div> <!-- FIN DEL PANEL --> 
		
				<input type="hidden" name="modificar" value="CANCELAR">
				<input type="hidden" name="eliminar" value="CANCELAR">
				<input type="hidden" name="registrar" value="CANCELAR">
		
				
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