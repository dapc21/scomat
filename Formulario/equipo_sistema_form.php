<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('DECO_ANA')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="estado" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administracion de EQUIPOS</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos a registrar</header>
			<div class="panel-body">	
				<input  type="hidden" name="id_es" maxlength="8" size="30"onChange="" value="<?php $acceso->objeto->ejecutarSql("select *from equipo_sistema where (id_es ILIKE '$ini_u%') ORDER BY id_es desc"); echo $ini_u.verCo($acceso,"id_es")?>">
		
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>sistema</label>
						<select class="form-control" name="id_tse" id="id_tse" onchange="cargar_marca_modelo()">
							<?php echo ver_tipo_sist_equipo($acceso);?>
						</select>
					</div>
					
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>codigo</label>													
						<input  class="form-control"  type="text" name="codigo_es" maxlength="12" size="30" value=""  onchange="cargar_deco()" >		
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>codigo adic</label>													
						<input class="form-control"  disabled type="text" name="codigo_adic" maxlength="9" size="30" value=""  onchange="" >			
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>status</label>													
							<select class="form-control"  disabled name="status_es" id="status_es" onchange="">
							<option value="DISPONIBLE">DISPONIBLE</option>
							<option value="ACTIVO" >ACTIVO</option>
							<option value="SUSPENDIDO" >SUSPENDIDO</option>
							
						</select>
					</div>
				
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>marca</label>													
							<select  class="form-control" name="id_marca" id="id_marca" onchange="cargar_modelo_m()" >
								<?php echo ver_marca($acceso); ?>
							</select>
					</div>
					
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>modelo</label>													
						<select  class="form-control" name="id_modelo" id="id_modelo" onchange="traer_sistema_marca()">
								<?php echo ver_modelo($acceso);?>
						</select>			
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>tipo da</label>													
						<select class="form-control"  name="tipo_es" id="tipo_es" onchange="" >
							<option value="36" >36</option>
						</select>
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>ubicacion</label>													
						<select  class="form-control" name="id_ues" id="id_ues" onchange="traer_sistema_marca()">
								<?php echo ver_ubicacion_equipo_sist($acceso);?>
						</select>			
					</div>
					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<label>estado fisico</label>			
						<select  class="form-control" name="estado_fisico" id="estado_fisico" onchange="" >
							<option value="BUENO">BUENO</option>
							<option value="DAÑADO">DAÑADO</option>
						</select>
					</div>

					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>abonado</label>													
						<input  class="form-control" disabled type="text" name="nro_contrato" maxlength="12" size="30" value=""  onchange="cargar_deco()" >		
					</div>
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>OBSERVACION</label>													
						<textarea  class="form-control" name="obser_es"  rows="1"></textarea>
					</div>

		
					
				
				</div>
				<input  type="hidden" name="id_contrato" maxlength="10" size="30" value="" >
				
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','equipo_sistema')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','equipo_sistema')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','equipo_sistema')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','equipo_sistema')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-estado">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Cablemodem Agregados</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label>STATUS</label>	
					<select  class="form-control"  name="status" id="status" onchange="cargar_cable_modem()"style="width: 250px;">
						<option value="DISPONIBLE">DISPONIBLE</option>
						<option value="ACTIVO" >ACTIVO</option>
						<option value="SUSPENDIDO" >SUSPENDIDO</option>
						<option value="" >TODOS</option>
					</select>
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
					<input  type="button" class="boton" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>








