<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('SECTOR')))
{
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='7'");
	if($row=row($acceso))
	{
		$valor_param= trim($row["valor_param"]);
	}

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" id="f1" name="f1"  data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Sectores</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Sector</header>
			<div class="panel-body">

				<input class="form-control" type="hidden" id="id_sector" maxlength="8" size="20"onChange="validarsector()" value="<?php $acceso->objeto->ejecutarSql("select *from sector  where (id_sector ILIKE '$ini_u%') ORDER BY id_sector desc"); echo $ini_u.verCo($acceso,"id_sector")?>">

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Estado</label>													
							<!--<select data-parsley-id="2" required="" class="form-control" id="id_esta" onchange="traer_pais();cargar_municipio();">-->
							<select data-parsley-id="2" required="" class="form-control" id="id_esta" name="id_esta" onchange="cargar_municipio_n();">
								<?php echo ver_estado($acceso);?>
							</select>
							<ul id="parsley-id-2" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Municipio</label>													
							<!--<select data-parsley-id="3" required="" class="form-control" id="id_mun" onchange="traer_estado();cargar_ciudad();">-->
							<select data-parsley-id="3" required="" class="form-control" id="id_mun" name="id_mun" onchange="traer_estado_n();cargar_ciudad_n();">
								<?php echo ver_municipio($acceso);?>
							</select>
							<ul id="parsley-id-3" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Ciudad</label>													
							<!--<select data-parsley-id="4" required="" class="form-control" id="id_ciudad" onchange="traer_municipio();cargarZona();">-->
							<select data-parsley-id="4" required="" class="form-control" id="id_ciudad" name="id_ciudad"  onchange="traer_municipio_n();cargarZona_n();">
								<?php echo ver_ciudad($acceso);?>
							</select>
							<ul id="parsley-id-4" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Zona</label>													
							<!--<select data-parsley-id="5" required="" class="form-control" id="id_zona" onchange="traer_ciudad();validar_nom_sector();">-->
							<select data-parsley-id="5" required="" class="form-control" id="id_zona" name="id_zona"  onchange="traer_ciudad_n();">
								<?php echo verZona($acceso);?>
							</select>
							<ul id="parsley-id-5" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<label>Franquicia</label>
							<!--<select data-parsley-id="1" required="" class="form-control" id="id_franq" onchange="cargar_estado()">-->
							<select data-parsley-id="1" required="" class="form-control" id="id_franq" onchange="">
								<?php echo verFranquicia($acceso);?>
							</select>
							<ul id="parsley-id-1" class="parsley-errors-list"></ul>
					</div>
					

					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Sector</label>													
							<input data-parsley-id="6" required="" class="form-control" type="text" id="nombre_sector" maxlength="50" size="30" value="" >
							<ul id="parsley-id-6" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Hogares</label>													
							<input data-parsley-id="7" required="" class="form-control" type="text" id="nro_sector" maxlength="4" size="20"  value="1" >
							<ul id="parsley-id-7" class="parsley-errors-list"></ul>
					</div>
				
				</div>
				
				<?php if($valor_param=="1"){ ?>
				<tr>
				<td width="150px">
					<span class="fuente"><?php echo _("paquete de mantenimiento");?></span>
				</td>
				<td width="280px">
					<select data-parsley-id="8" required="" id="dato" style="width: 150px;">
						<?php echo verpaquetebasico($acceso);?>
					</select>
					<ul id="parsley-id-8" class="parsley-errors-list"></ul>
				</td>
				<td width="150px">
					<span class="fuente"><?php echo _("paquete de afiliacion");?></span>
				</td>
				<td width="280px">
					<select data-parsley-id="9" required="" id="afiliacion" style="width: 150px;">
						<?php echo verpaqueteunico($acceso);?>
					</select>
					<ul id="parsley-id-9" class="parsley-errors-list"></ul>
				</td>
				
				</tr>
				<?php }else{?>
				<input  type="hidden" value="SER00001" id="dato">
				<input  type="hidden" value="dato" id="afiliacion">
				<?php }?>
			</div> <!-- FIN DEL PANEL -->	
			
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_sector('incluir','sector')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_sector('modificar','sector')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_sector('eliminar','sector')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" id="salir" onclick="cargar_form_sector()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>		
		
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-sector">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Sectores Agregados</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid_sector" class="data"></div>
					
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