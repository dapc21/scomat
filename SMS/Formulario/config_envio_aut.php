<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ENVIO_SMS')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="config_envio_aut" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>configuración de envio automatico para sms y e-mail</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Configurar</header>
		
		<div class="panel-body">		
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">								
						<label>Servicios</label>
						<div>					
							<input type='checkbox' id='checkgrupo' name='sel_envio_a_c' value="" onchange='sel_todo_envio();checkRadio();'>
								Seleccionar Todo
						</div>
				</div>	
				
			</div>
				
		</div> <!-- FIN DEL PANEL -->	
			
	</section>		
	
<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-envio-cliente">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Envio Automático para Clientes</header>
			
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<table class="table table-condensed">
				<thead>
					<tr class="titulo-tabla">
					  <th class="numeric">#</th>
					  <th class="numeric">Descripción</th>
					  <th class="numeric">Envio</th>
					  <th class="numeric">Editar</th>
					</tr>
				</thead>
				<tbody>	
				<?php
				$acceso->objeto->ejecutarSql("select * from envio_aut where tipo_envio='PARA CLIENTES' order by id_envio desc");
				$i=1;
				$bgc=array("0"=>"tbl-row-even","1"=>"tbl-row-odd");
				$fill=1;
				while ($row=row($acceso))
				{
					$fill=!$fill;
					$id_envio=trim($row["id_envio"]);		
					$nombre_envio=trim($row["nombre_envio"]);
					$envio_sms=trim($row["envio_sms"]);
					$envio_email=trim($row["envio_email"]);
					
					$envio_s="";
					if($envio_sms=="TRUE"){
						$envio_s="CHECKED";
					}
					$envio_e="";
					if($envio_email=="TRUE"){
						$envio_e="CHECKED";
					}
					echo "
					<tr>
						<td>
							<label>$i</label>
						</td>
						<td>
							<label>$nombre_envio</label>
						</td>
						<td align='center'>
							<label><input type='checkbox' name='envio_a' value='$id_envio' $envio_s/>SMS</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label><input type='checkbox' name='envio_a' value='$id_envio' $envio_e/>E-MAIL</label>
						</td>
						
						<td align='center'>
							<label> <a href='#' onclick=\"editar_env_aut('$id_envio')\"><img src='include/eyedatagrid/images/edit.png' alt='Edit' title='Editar Mensaje' class='tbl-control-image'></a> </label>
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
	<section class="panel" id="tabla-envio-gerente">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Envio Automático para Gerentes</header>
			
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<table class="table table-condensed">
				<thead>
					<tr class="titulo-tabla">
					  <th class="numeric">#</th>
					  <th class="numeric">Descripción</th>
					  <th class="numeric">Envio</th>
					  <th class="numeric">Editar</th>
					</tr>
				</thead>
				<tbody>	
				<?php								
				$acceso->objeto->ejecutarSql("select *from envio_aut where tipo_envio='PARA GERENTES' order by ref_envio desc");				
				$i=1;
				$bgc=array("0"=>"tbl-row-even","1"=>"tbl-row-odd");
				$fill=1;
				while ($row=row($acceso))
				{
					$fill=!$fill;
					$id_envio=trim($row["id_envio"]);		
					$nombre_envio=trim($row["nombre_envio"]);
					$envio_sms=trim($row["envio_sms"]);
					$envio_email=trim($row["envio_email"]);
					
					$envio_s="";
					if($envio_sms=="TRUE"){
						$envio_s="CHECKED";
					}
					$envio_e="";
					if($envio_email=="TRUE"){
						$envio_e="CHECKED";
					}
					echo "
					<tr>
						<td>
							<label>$i</label>
						</td>
						<td>
							<label>$nombre_envio</label>
						</td>
						<td align='center'>
							<label><input type='checkbox' name='envio_a' value='$id_envio' $envio_s/>SMS</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label><input type='checkbox' name='envio_a' value='$id_envio' $envio_e/>E-MAIL</label>
						</td>
						
						<td align='center'>
							<label> <a href='#' onclick=\"editar_env_aut('$id_envio')\"><img src='include/eyedatagrid/images/edit.png' alt='Edit' title='Editar Mensaje' class='tbl-control-image'></a> </label>
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
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" name="registrar" value= "<?php echo _("guardar cambios");?>" onclick="guardar_conf_env_aut()"><i class="glyphicon glyphicon-ok"></i> Guardar Cambios</button>
				<input class="form-control" type="HIDDEN" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_sms('modificar','banco')">
				<input class="form-control" type="HIDDEN" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_sms('eliminar','banco')">
				<input class="form-control" type="HIDDEN" name="salir" onclick="cerrarVenta()" value="<?php echo _("limpiar");?>">
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