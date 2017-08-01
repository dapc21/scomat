<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('detalle_orden')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1" data-parsley-validate="">
		<input  type="hidden" value="dato" id="dato" name="dato">
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Detalles de Orden</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos a Registrar</header>
			<div class="panel-body">

				<input class="form-control" type="hidden" id="id_det_orden" name="id_det_orden" maxlength="8" size="30"onChange="validardetalle_orden()" value="<?php $acceso->objeto->ejecutarSql("select * from detalle_orden where (id_det_orden ILIKE '$ini_u%') ORDER BY id_det_orden desc"); echo $ini_u.verCo($acceso,"id_det_orden")?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-5 col-sm-12 col-xs-12">
						<label>Tipo de Órden</label>													
						<select data-parsley-id="id_tipo_orden" required="" class="form-control" id="id_tipo_orden" name="id_tipo_orden" id="-1" onchange="">
							<?php echo verTipoOrden($acceso);?>
						</select>
						<ul id="parsley-id-id_tipo_orden" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-8 col-md-7 col-sm-12 col-xs-12">
						<label>Detalle de la Órden</label>													
						<input data-parsley-id="nombre_det_orden" required="" class="form-control" type="text" id="nombre_det_orden" name="nombre_det_orden" maxlength="50" size="50" value="" onChange="validar_nom_detalle_orden();">
						<ul id="parsley-id-nombre_det_orden" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-4 col-md-5 col-sm-12 col-xs-12">
						<label>Generar Deuda</label>
						<div>					
							<input disabled type="radio" name="status" value="SI" onchange="activa_id_serv();" />Si &nbsp;&nbsp;
							<input disabled type="radio" name="status" value="NO"  onchange="activa_id_serv();" CHECKED />No
						</div>	
						
					</div>
					
					<div class="form-group col-lg-8 col-md-7 col-sm-12 col-xs-12">
						<label>Costo del Servicio</label>													
						<select class="form-control" disabled name="id_serv" id="id_serv" onchange="">
							<?php echo verServiciosCostoU($acceso);?>
						</select>
					</div>										
										
					
				</div>	
				
			</div> <!-- FIN DEL PANEL -->	
			
	</section>	
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Para los Contratos</header>
			<div class="panel-body">
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
																			
						<?php 
							$acceso->objeto->ejecutarSql("select * from statuscont order By nombrestatus");
							$i=1;
							echo'<div>';
							while ($row=row($acceso))
							{
								if($i==5){
								//	echo "<br>";
									$i=0;
								}	
								$i++;																								
								echo '<input type="checkbox" name="status_contrato" value="'.trim($row["nombrestatus"]).'">
								'.trim($row["nombrestatus"].'</br>');	
									
							}
							echo '</div>';
						?>
					</div>
				
							
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" id="registrar" name="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_detalle_orden('incluir','detalle_orden')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" id="modificar" name="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_detalle_orden('modificar','detalle_orden')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" id="eliminar" name="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_detalle_orden('eliminar','detalle_orden')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" id="salir" name="salir" onclick="cargar_form_detalle_orden()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>
		</div> <!-- FIN DEL PANEL -->	
	</section>	
	
	<section class="panel" id="tabla-detalle-orden">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos los Detalles de Órdenes Registradas</header>
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