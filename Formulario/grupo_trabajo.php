<?php require_once "procesos.php"; 
session_start();
$ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('GRUPO_TRABAJO')))
{

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="grupo_trabajo" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administracion de grupo de trabajos</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos a Registrar</header>
			<div class="panel-body">	
				<input class="form-control" type="hidden" name="id_gt" maxlength="8" size="30"onChange="validargrupo_trabajo()" value="<?php $acceso->objeto->ejecutarSql("select *from grupo_trabajo  where (id_gt ILIKE '$ini_u%') ORDER BY id_gt desc"); echo $ini_u.verCo($acceso,"id_gt")?>">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Nombre Grupo</label>						
							<input class="form-control" type="text" name="nombre_grupo" maxlength="30" size="30" value="" >
					</div>
					
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Franquicia</label>
						<select class="form-control" name="id_franq" id="id_franq">
							<?php echo verFranquicia_selec($acceso);?>
						</select>
					</div>
				
				
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Fecha</label >						
						<input class="form-control" disabled type="text" name="fecha_creacion" id="fecha_creacion" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
						<input class="form-control" disabled type="hidden" name="hora_creacion" maxlength="8" size="30" value="<?php echo date("H:i:s");?>" >
						<span class="help-inline">dd/mm/aaaa</span>						
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Status</label>
						<div>
						<input  type="radio" name="status_grupo" value="ACTIVO"CHECKED>&nbsp;<?php echo _("ACTIVO");?>&nbsp;&nbsp;&nbsp;
						<input  type="radio" name="status_grupo" value="INACTIVO">&nbsp;<?php echo _("INACTIVO");?>
						</div>
						
					</div>
					
					<input class="form-control" type="hidden" value="dato" name="dato">
				</div>
			</div> <!-- FIN DEL PANEL -->	
	</section>		

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-tecnico">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Seleccionar Tecnicos</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="tecnico" class="data"></div>
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	  
		
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Seleccionar Zonas/Sectores</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Organizar Por</label>
						<select class="form-control" name="organizar_por" id="organizar_por" onchange="organizar_grupo_por()">
							<option value="ZONAS">ZONAS</option>
							<option value="SECTORES">SECTORES</option>
						</select>
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Zonas</label>
						<select class="form-control" DISABLED name="id_zona" id="id_zona" onchange="buscar_grupo_sector()">
							<option value="">TODOS</option>
							<?php echo verZonaEst($acceso);?>
						</select>
					</div>
					
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	  	
				
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-tecnico-grupo_ubicacion">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Seleccionar Ubicación</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="grupo_ubicacion" class="data"></div>
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	  		
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
			<div class="panel-body">	
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
						<button class="btn btn-success" type="button" type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','grupo_trabajo')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
						<button class="btn btn-warning" type="button" type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','grupo_trabajo')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
						<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','grupo_trabajo')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i>Limpiar</button>
						<input class="form-control" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','grupo_trabajo')">
						

				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>		
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-tecnico-grupo_activo">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Grupos Activos</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="grupo" class="data"></div>
					
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

