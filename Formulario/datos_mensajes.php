<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ENVIAR_SMS_LOTES')))
{
?>


<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="datos_mensajes" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Envío de SMS y Email Masivo</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Con Deuda</header>
		
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">								
					<label>Seleccione</label>
					<div>
						<input type="checkbox" name="checkgrupo" onclick="bloquea_sd()">
						Sin Tomar en Cuenta Deuda &nbsp;&nbsp;  </br>
						<input type="checkbox" name="checkdeposito" onclick="">
						Sin Tomar en Abonados con Pagos/Transferencias Pendientes
					</div>
				</div>		
				
				<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<label>Desde</label>					
					<select class="form-control" name="desde" id="desde" onchange="">
						<option value='2005-01-01'>TODOS</option>
							<?php echo verMesCorte();?>
					</select>
				</div>
				
				<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<label>Hasta</label>					
					<select class="form-control" name="hasta" id="hasta" onchange="">
						<?php echo verMesCorte();?>
					</select>
				</div>
				
				<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<label>y deuda mayor a:</label >
					<div class="input-group">												
					<input class="form-control" type="text" name="deuda" id="deuda"  maxlength="10" size="5" value="0">
					<span class="input-group-addon">BsF</span>
					</div>
					
				</div>
			
			</div>
			
		</div> <!-- FIN DEL PANEL -->
	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Por ubicación</header>
		
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
				<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<label>Franquicia</label>
						<select class="form-control" name="id_franq" id="id_franq" onchange="cargar_estado()">
							<?php echo verFranquicia($acceso);?>
						</select>						
				</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<label>Estado</label>													
						<select class="form-control" name="id_esta" id="id_esta" onchange="traer_pais();cargar_municipio();">
							<?php echo verEstado($acceso);?>
						</select>						
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<label>Municipio</label>													
						<select class="form-control" name="id_mun" id="id_mun" onchange="traer_estado();cargar_ciudad();">
							<?php echo verMun($acceso);?>
						</select>						
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<label>ciudad</label>													
						<select class="form-control" name="id_ciudad" id="id_ciudad" onchange="traer_municipio();cargarZona();">
							<?php echo verCiudad($acceso);?>
						</select>						
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<label>Zonas</label>													
						<select class="form-control" name="id_zona" id="id_zona" onchange="traer_ciudad();cargarSector();">
							<?php echo verZona($acceso);?>
						</select>						
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<label>Sector</label>													
						<select class="form-control" name="id_sector" id="id_sector" onchange="traerZona();cargarCalle();cargarUrb();">
							<?php echo verSector($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<label>Urbanización</label>													
						<select class="form-control" name="urbanizacion" id="urbanizacion" onchange="traerSectorUrb()">
							<?php echo verUrb($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<label>Calle</label>													
						<select class="form-control" name="id_calle" id="id_calle"  onchange="traerSector()">
							<?php echo verCalle($acceso);?>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<label>Edificio</label>													
						<select class="form-control" name="edificio" id="edificio"  onchange="traerCalle()">
							<?php echo verEdif($acceso);?>
						</select>
					</div>
			
			</div>
			
		</div> <!-- FIN DEL PANEL -->
	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Por Estatus de Contrato</header>
			<div class="panel-body">
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
																			
						<?php 
							$acceso->objeto->ejecutarSql("select *from statuscont order By nombrestatus");
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
								'.trim($row["nombrestatus"]).'</br>';	
									
							}
							echo '</div>';
						?>
					</div>
				
							
			</div> <!-- FIN DEL PANEL -->	
			
	</section>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Otros Parametros</header>
			<div class="panel-body">
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
																			
						<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<label>Tipo de Servicio</label>													
							<select class="form-control" name="id_tipo_servicio" id="id_tipo_servicio" onchange="cargarServicioMensual()">
								<?php echo verTipoSer($acceso);?>
							</select>
						</div>
						
						<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<label>Servicios</label>													
							<select class="form-control" name="id_serv" id="id_serv" onchange="traerTipoSer()">
								<?php echo verServicioMensual($acceso);?>
							</select>
						</div>
						
						<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<label>Grupo de Afinidad</label>													
							<select class="form-control" name="id_g_a" id="id_g_a" onchange="">
								<?php echo verGrupoAfinidad($acceso);?>
							</select>
						</div>
						
						<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<label>Promoción</label>													
							<select class="form-control" name="id_promo" id="id_promo" onchange="">
								<?php echo verPromocionesActivasR($acceso);?>
							</select>	
						</div>
						
						<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<label>Convenio de Pago</label>													
							<select class="form-control" name="convenio" id="convenio" onchange="">
								<option value=''>Seleccione...</option>
								<option value='CON CONVENIO'>CON CONVENIO</option>
								<option value='SIN CONVENIO'>SIN CONVENIO</option>
								<option value='CONVENIO POR FECHA'>CONVENIO POR FECHA</option>
							</select>
						</div>
												
								
					</div>
							
			</div> <!-- FIN DEL PANEL -->	
			
	</section>	
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Mensaje</header>
			<div class="panel-body">
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
																			
						<div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<label>formatos agregados</label>													
							<select class="form-control" name="id_form" id="id_form" onchange="validarformato_sms()">
								<?php echo verFormatos($acceso);?>
							</select>
						</div>
						
						<div class="col-lg-9 col-md-4 col-sm-4 col-xs-12">
							<label><i class="fa fa-edit label-blanco"></i></label>							
						</div>	
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label><i class="fa fa-edit label-blanco"></i></label>							
							<textarea class="form-control" name="sms" rows="3"  onKeyUp="cuenta_carac_com_m()">
								<?php
									$acceso->objeto->ejecutarSql("select *from formato_sms where status='ACTIVO'");
									$row=row($acceso);
									echo trim($row["formato"]);
								?>
							</textarea>
						</div>	
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<label>Caracteres:</label> <label id="cant_car_m">0</label>/<label id="cant_sms_m">1</label>							
						</div>						
								
					</div>
							
			</div> <!-- FIN DEL PANEL -->	
			
	</section>		
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="LISTAR" value="<?php echo _("listar clientes");?>" onclick="buscarDatos_sms_listado();"><i class="glyphicon glyphicon-list"></i> Listar Clientes</button>								
				<button class="btn btn-warning" type="button" disabled type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("enviar mensaje");?>" onclick="buscarDatos_sms();"><i class="glyphicon glyphicon-envelope"></i> Enviar Mensaje</button>						
				<button class="btn btn-info" type="button" name="Resetear" onclick="javascript:conexionPHP('formulario.php','datos_mensajes')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>												
				<input class="form-control" disabled type="hidden" name="modificar" value="<?php echo _("actualizar archivo");?>" onclick="act_datos_sms();">
				<input class="form-control" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_sms('eliminar','status_contrato')">
										
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>		

	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">listado de clientes a enviar mensajes</header>
		
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
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP_sms(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>