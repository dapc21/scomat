<?php
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 	 
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('PERFIL')))
{
		
$acceso->objeto->ejecutarSql("select *from perfil ORDER BY codigoperfil desc");
?>


<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="perfil" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Perfiles de Usuario</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Perfil de Usuario</header>
			<div class="panel-body">

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label>Código</label>													
							<input class="form-control" type="text" name="codigo" maxlength="7" size="15"onChange="validarCodigo();" value="<?php echo "PERF".verCodigo($acceso,'codigoperfil')?>">
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Nombre</label>													
							<input class="form-control" type="text" name="nombre" maxlength="25" size="30" value="">
					</div>
					
					<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label>Estatus</label>						
						<div>						
							&nbsp;<?php echo _("ACTIVO");?>
							<input  type="radio" name="status" value="ACTIVO"CHECKED>&nbsp;&nbsp;&nbsp;
							<?php echo _("INACTIVO");?>
							<input  type="radio" name="status" value="INACTIVO">					
						</div>
					</div>	
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>Descripción</label>																				
							<textarea class="form-control" name="descripcion" cols="70" rows="1"></textarea>
					</div>
				
				</div>

			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Asignar Modulos</header>
			<div class="panel-body">								
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																	
					<table class="table table-condensed">
						<thead>
							<tr class="titulo-tabla">					  
							  <th>Asignar Modulos</th>
							  <th>Operaciones</th>
							  <th>Descripción</th>
							</tr>
						</thead>					
						<tbody>															
							<?php echo perfiles($acceso)?>
						</tbody>						
					
					</table>
					
				</div>
				
			</div> <!-- FIN DEL PANEL -->	
			
	</section>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','Perfil')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','Perfil')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','Perfil')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','Perfil')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>			
			
	<section class="panel" id="tabla-perfil-usuario">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Perfiles de Usuarios Agregados</header>
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