<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('BANCO')))
{
$acceso->objeto->ejecutarSql("select id_servidor from servidor  where (id_servidor ILIKE '$ini_u%')   ORDER BY id_servidor desc LIMIT 1 offset 0 ");
	$id_servidor=$ini_u.verCodigo($acceso,"id_servidor");
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="servidor" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Servidores</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Servidor</header>
		
		<div class="panel-body">
			<input class="form-control" type="hidden" name="id_servidor" maxlength="5" size="30"onChange="validarservidor();" value="<?php echo $id_servidor;?>">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<label>Nombre del Servidor</label>													
					<input class="form-control" type="text" name="nombre_servidor" maxlength="30" size="30" value="" >
				</div>
				
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<label>Estatus</label>
					<div class="has-js">
						<div class="radios">						
																				
								<input type="radio" name="status_ser" value="ACTIVO" CHECKED > Activo
							
							
								<input type="radio" name="status_ser" value="INACTIVO" > Inactivo
							
						</div>	
					</div>	
				</div>
				
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label>Dirección del Servidor</label>							
					<textarea class="form-control" name="direc_servidor" cols="100" rows="1"></textarea>
				</div>	
				
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<label>Tipo</label>
					<div class="has-js">
						<div class="radios">						
																														
								<input type="radio" name="status_servidor" value="LOCAL"CHECKED> Local
							
								<input type="radio" name="status_servidor" value="EXTERNO"> Externo
								
						</div>	
					</div>	
				</div>	
				
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<label>Sincronizar</label>
					<div class="has-js">
						<div class="radios">						
																													
								<input type="radio" name="sincronizar" value="SINCRONIZAR"CHECKED> Local
							
								<input type="radio" name="sincronizar" value="NO SINCRONIZAR"> Externo
							
						</div>	
					</div>	
				</div>	
				
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Usuario  de Postgres</label>
					<input class="form-control" type="text" name="usuario_p" maxlength="50" size="30" value="" >
				</div>
				
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Clave  de Postgres</label>
					<input class="form-control" type="text" name="clave_p" maxlength="50" size="30" value="" >
				</div>
				
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Dirección IP VPN</label>
					<input class="form-control" type="text" name="direccio_ip" maxlength="50" size="30" value="" >
				</div>
				
				<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<label>Base de Datos</label>
					<input class="form-control" type="text" name="database" maxlength="50" size="30" value="" >
				</div>

			</div>
		</div> <!-- FIN DEL PANEL -->
	
	</section>	

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','servidor')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','servidor')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','servidor')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','servidor')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	

	<section class="panel" id="tabla-servidor">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Servidores Registrados</header>
		
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

