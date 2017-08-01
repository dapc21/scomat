<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('COMANDO_SMS')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="config_comandos_sms" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Configuración de Comandos para Respuestas Automáticas</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Configurar</header>
			
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<div class="form-group col-lg-3 col-md-4col-sm-12 col-xs-12">					
					<!--<button class="btn btn-info" type="button" name="agregar" onclick="agregar_com_aut()"><i class="fa fa-plus"></i>Agregar Comando</button>	-->	
					<label></label>
					<div class="input-group text-btn">
					<button class="btn btn-info" type="button" name="agregar" value="<?php echo _("agregar comando");?>" onclick="ajaxVentana('comandos', this.id);agregar_com_aut();"><i class="fa fa-plus"></i>  Agregar Comando</button>
					</div>	
				</div>	
				
				<div class="form-group col-lg-9 col-md-8 col-sm-12 col-xs-12">								
					<label><i class="fa fa-edit label-blanco"></i></label>	
						<div>					
							<input type='checkbox' id='checkgrupo' name='sel_envio_a_c' value="" onchange='sel_todo_envio();checkRadio();'>
								Seleccionar Todo
						</div>
				</div>	
				
				
			</div>
				
		</div> <!-- FIN DEL PANEL -->	
			
	</section>		
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-comando-cliente">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Comandos para Clientes</header>
			
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<table class="table table-condensed">
					<thead>
						<tr class="titulo-tabla">
						  <th class="numeric">#</th>
						  <th class="numeric">Comando</th>
						  <th class="numeric">Descripción</th>
						  <th class="numeric">Envio</th>
						  <th class="numeric">Edit</th>
						</tr>
					</thead>
					<tbody>	
						<?php
							$acceso->objeto->ejecutarSql("select * from comandos_sms where tipo_com='PARA CLIENTES' order by id_com");
							$i=1;
							$bgc=array("0"=>"tbl-row-even","1"=>"tbl-row-odd");
							$fill=1;
							while ($row=row($acceso))
							{
								$fill=!$fill;
								$id_com=trim($row["id_com"]);		
								$nombre_com=trim($row["nombre_com"]);
								$status_com=trim($row["status_com"]);
								$status_error=trim($row["status_error"]);
								$descrip_com=trim($row["descrip_com"]);
								$status="";
								$status_e="";
								if($status_com=="TRUE"){
									$status="CHECKED";
								}
								if($status_error=="TRUE"){
									$status_e="CHECKED";
								}
								echo "
								<tr class='$bgc[$fill] tbl-row-highlight'>
									<td>
										<label>$i</label>
									</td>
									<td>
										<label>$nombre_com</label>
									</td>
									<td>
										<label>$descrip_com</label>
									</td>
									<td align='center'>
										<label><input type='checkbox' name='envio_a' value='$id_com'  $status/>SMS</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label><input type='checkbox' name='envio_a' value='$id_com'  $status_e/>EMAIL</label>
									</td>									
									<td align='center'>
										<label> <a href='#' onclick=\"editar_com_aut('$id_com')\"><img src='include/eyedatagrid/images/edit.png' alt='Edit' title='Editar Mensaje' class='tbl-control-image'></a> </label>
									</td>
								</tr>
								";
								$i++;
							}	
							
						?>
					</tbody>
				</table>
				
			</div>
				
		</div> <!-- FIN DEL PANEL -->	
			
	</section>		

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-comando-tecnico">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Comandos para Técnicos</header>
			
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<table class="table table-condensed">
					<thead>
						<tr class="titulo-tabla">
						  <th class="numeric">#</th>
						  <th class="numeric">Comando</th>
						  <th class="numeric">Descripción</th>
						  <th class="numeric">Envio</th>
						  <th class="numeric">Edit</th>
						</tr>
					</thead>
					<tbody>	
						<?php
							$acceso->objeto->ejecutarSql("select *from comandos_sms where tipo_com='PARA TECNICOS' order by id_com");
							$i=1;
							$bgc=array("0"=>"tbl-row-even","1"=>"tbl-row-odd");
							$fill=1;
							while ($row=row($acceso))
							{
								$fill=!$fill;
								$id_com=trim($row["id_com"]);		
								$nombre_com=trim($row["nombre_com"]);
								$status_com=trim($row["status_com"]);
								$status_error=trim($row["status_error"]);
								$descrip_com=trim($row["descrip_com"]);
								$status="";
								$status_e="";
								if($status_com=="TRUE"){
									$status="CHECKED";
								}
								if($status_error=="TRUE"){
									$status_e="CHECKED";
								}
								echo "
								<tr class='$bgc[$fill] tbl-row-highlight'>
									<td>
										<label>$i</label>
									</td>
									<td>
										<label>$nombre_com</label>
									</td>
									<td>
										<label>$descrip_com</label>
									</td>
									<td align='center'>
										<label><input type='checkbox' name='envio_a' value='$id_com'  $status/>SMS</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label><input type='checkbox' name='envio_a' value='$id_com'  $status_e/>EMAIL</label>
									</td>									
									<td align='center'>
										<label> <a href='#' onclick=\"editar_com_aut('$id_com')\"><img src='include/eyedatagrid/images/edit.png' alt='Edit' title='Editar Mensaje' class='tbl-control-image'></a> </label>
									</td>
								</tr>
								";
								$i++;
							}	
							
						?>
					</tbody>
				</table>
				
			</div>
				
		</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-comando-gerente">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Comandos para Gerentes</header>
			
		<div class="panel-body">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<table class="table table-condensed">
					<thead>
						<tr class="titulo-tabla">
						  <th class="numeric">#</th>
						  <th class="numeric">Comando</th>
						  <th class="numeric">Descripción</th>
						  <th class="numeric">Envio</th>
						  <th class="numeric">Edit</th>
						</tr>
					</thead>
					<tbody>	
						<?php
							$acceso->objeto->ejecutarSql("select *from comandos_sms where tipo_com='PARA GERENTES' order by id_com");
							$i=1;
							$bgc=array("0"=>"tbl-row-even","1"=>"tbl-row-odd");
							$fill=1;
							while ($row=row($acceso))
							{
								$fill=!$fill;
								$id_com=trim($row["id_com"]);		
								$nombre_com=trim($row["nombre_com"]);
								$status_com=trim($row["status_com"]);
								$status_error=trim($row["status_error"]);
								$descrip_com=trim($row["descrip_com"]);
								$status="";
								$status_e="";
								if($status_com=="TRUE"){
									$status="CHECKED";
								}
								if($status_error=="TRUE"){
									$status_e="CHECKED";
								}
								echo "
								<tr class='$bgc[$fill] tbl-row-highlight'>
									<td>
										<label>$i</label>
									</td>
									<td>
										<label>$nombre_com</label>
									</td>
									<td>
										<label>$descrip_com</label>
									</td>
									<td align='center'>
										<label><input type='checkbox' name='envio_a' value='$id_com'  $status/>SMS</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label><input type='checkbox' name='envio_a' value='$id_com'  $status_e/>EMAIL</label>
									</td>									
									<td align='center'>
										<label> <a href='#' onclick=\"editar_com_aut('$id_com')\"><img src='include/eyedatagrid/images/edit.png' alt='Edit' title='Editar Mensaje' class='tbl-control-image'></a> </label>
									</td>
								</tr>
								";
								$i++;
							}	
							
						?>
					</tbody>
				</table>
				
			</div>
				
		</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">						
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("guardar cambios");?>" onclick="guardar_conf_com_aut()"><i class="glyphicon glyphicon-ok"></i> Guardar Cambios</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_sms('formulario.php','config_comandos_sms')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
				<input class="form-control" type="HIDDEN" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_sms('modificar','banco')">
				<input class="form-control" type="HIDDEN" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_sms('eliminar','banco')">
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>		
		
	</form> <!-- FIN DEL FORMULARIO -->		
	
</div><!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->	
 
	
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