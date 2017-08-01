<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('servicios')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Servicios</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Servicio</header>
			<div class="panel-body">	
				<input class="form-control" type="hidden" name="id_serv" id="id_serv" maxlength="8" size="30"onChange="validarservicios();" value="<?php $acceso->objeto->ejecutarSql("select * from servicios  where (id_serv ILIKE '$ini_u%')  ORDER BY id_serv desc"); echo $ini_u.verCo($acceso,"id_serv")?>">
				<input class="form-control" type="hidden" name="id_tar_ser" id="id_tar_ser" maxlength="8" size="20"onChange="validartarifa_servicio()" value="<?php $acceso->objeto->ejecutarSql("select *from tarifa_servicio  where (id_tar_ser ILIKE '$ini_u%') ORDER BY id_tar_ser desc"); echo $ini_u.verCo($acceso,"id_tar_ser")?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Tipo de Servicio</label>													
							<select  data-parsley-id="id_tipo_servicio" required="" class="form-control" name="id_tipo_servicio" id="id_tipo_servicio" onchange="validar_nom_servicios();">
								<?php echo verTipoSer($acceso);?>
							</select>
							<ul id="parsley-id-id_tipo_servicio" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Generar Deuda</label>
						<div>														
							<input  type="radio" name="tipo_costo" value="COSTO MENSUAL" CHECKED onchange="hab_tipo_paq();" /> Mensual &nbsp;
							<input  type="radio" name="tipo_costo" value="COSTO UNICO" onchange="hab_tipo_paq();" /> Único
						</div>	
						
					</div>										
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Tipo de Paquete</label>													
							<select  data-parsley-id="tipo_paq" required="" class="form-control" name="tipo_paq" id="tipo_paq">
								<option value="PAQUETE BASICO"><?php echo _("paquete basico");?></option>
								<option value="PAQUETE ADICIONAL"><?php echo _("paquete adicional");?></option>
							</select>
							<ul id="parsley-id-tipo_paq" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
							<label>Nombre del Servicio</label>													
								<input  data-parsley-id="nombre_servicio" required="" class="form-control" type="text" name="nombre_servicio" id="nombre_servicio" maxlength="30" value="" onChange="">
								<ul id="parsley-id-nombre_servicio" class="parsley-errors-list"></ul>
					</div>	
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Clasificación</label>
						<select  data-parsley-id="tipo_serv" required="" class="form-control" name="tipo_serv" id="tipo_serv">
							<option value="OTROS"><?php echo _("OTROS");?></option>
							<option value="MENSUALIDAD"><?php echo _("MENSUALIDAD");?></option>
							<option value="INSTALACION"><?php echo _("INSTALACION");?></option>
							<option value="RECONEXION"><?php echo _("RECONEXION");?></option>
							<option value="PUNTO ADICIONAL"><?php echo _("PUNTO ADICIONAL");?></option>
							<option value="ALQUILER"><?php echo _("ALQUILER");?></option>
						</select>	
						<ul id="parsley-id-tipo_serv" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-12 col-sm-12 col-xs-12">
						<label>Estatus</label>
						<div>																
							<input type="radio" name="status_serv" value="ACTIVO"CHECKED /> Activo &nbsp;&nbsp;																
							<input  type="radio" name="status_serv" value="INACTIVO" /> Inactivo
						</div>
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Tipo tarifa</label>													
							<select   class="form-control" name="tarifa_esp" id="tarifa_esp">
								<option value=""><?php echo _("TARIFA NORMAL");?></option>
								<option value="TRUE"><?php echo _("TARIFA ESPECIAL");?></option>
							</select>
							
					</div>
					
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>Tarifa</label >
						<div class="input-group">						
						<input  data-parsley-id="tarifa_ser" required="" data-parsley-type="number" class="form-control" type="text" name="tarifa_ser" id="tarifa_ser" maxlength="10" size="20" value="" >
						<span class="input-group-addon">BsF</span>
						</div>
						<ul id="parsley-id-tarifa_ser" class="parsley-errors-list"></ul>
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>PAQUETE (opcional)</label>
							<select   class="form-control" name="id_paq" id="id_paq">
								<option value="">NO APLICA</option>
								<?php echo ver_paquete($acceso);?>
							</select>
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>CANT TV (opcional)</label>
							<select  class="form-control" name="id_cant" id="id_cant">
								<option value="">NO APLICA</option>
								<?php echo ver_cant_tv($acceso);?>
							</select>
					</div>
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Franquicias</label><br>																			
					<?php 
						$acceso1=conexion();
						$acceso1->objeto->ejecutarSql("select *from grupo_franq  order By id_gf");
						$i=1;
						while ($row1=row($acceso1))
						{
							$id_gf=trim($row1["id_gf"]);
							$nombre_gf=trim($row1["nombre_gf"]);
							
							echo '<br><div style="width:160px; display: inline-block;" ><input  type="checkbox" name="grupo_franq" value="" id="'.$id_gf.'gf" onclick="activacheckf(\''.$id_gf.'\')">
							<label>'.$nombre_gf.'</label></div>';
						
							$acceso->objeto->ejecutarSql("select *from franquicia where id_gf='$id_gf' order By id_franq");
							$i=1;
							while ($row=row($acceso))
							{
								if($i==5){
								//	echo "<br>";
									$i=0;
								}	
								$i++;
								echo '<div style="width:160px; display: inline-block;" > <input  type="checkbox" name="franquicia" id="'.$id_gf.trim($row["id_franq"]).'gf" value="'.trim($row["id_franq"]).'">
								<label> '.trim($row["nombre_franq"]).'</label></div>';
							}
							echo "<hr>";
						}
					?>
					
					
					</div>
					
				
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Observación</label>																				
							<textarea   class="form-control" name="obser_serv" id="obser_serv" rows="1" maxlength="100"></textarea>
							
					</div>
				
				</div>
			
			
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">SISTEMAS CODIFICADOS</header>
			<div class="panel-body">	
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<?php 
						$acceso1->objeto->ejecutarSql("select *from tipo_sist_equipo  order By id_tse");
						$i=1;
						while ($row1=row($acceso1))
						{
							$id_tse=trim($row1["id_tse"]);
							$sistema=trim($row1["sistema"]);
							$ubicacion=trim($row1["ubicacion"]);
							
							echo '<br><div style="width:220px; display: inline-block;" ><input  type="checkbox" name="tipo_sistema" value="" id="'.$id_tse.'ts" onclick="activacheckf_ts(\''.$id_tse.'\')">
							<label>Interfaz '.$sistema.' '.$ubicacion.'</label></div>';
						
							$acceso->objeto->ejecutarSql("select *from servicios_sistema WHERE status_serv_sist='ACTIVO' and id_tse='$id_tse' order By abrev_serv_sist");
							$i=1;
							while ($row=row($acceso))
							{
								if($i==5){

									$i=0;
								}	
								$i++;
								echo '<div style="width:110px; display: inline-block;" ><input  type="checkbox" name="servicio" id="'.$id_tse.trim($row["id_serv_sist"]).'ts" value="'.trim($row["id_serv_sist"]).'">
						<label> '.trim($row["abrev_serv_sist"]).'</label></div>';
							}
							echo "<hr>";
						}
					?>
					
			</div>
				
			<input class="form-control" type="hidden" value="dato" name="dato" id="dato">
		</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_servicios('incluir','servicios')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_servicios('modificar','servicios')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_servicios('eliminar','servicios')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_servicios()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>			

	<section class="panel" id="tabla-servicio-adm">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Servicios Registrados</header>
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