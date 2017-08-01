<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ZONA')))
{

	$acceso->objeto->ejecutarSql("select *from zona order by n_zona desc");
	$n_zona = verCodigo($acceso,"n_zona");


?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" id="f1" name="f1"  data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Zonas</h3></div>
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Zona</header>
			<div class="panel-body">

				<input class="form-control" type="hidden" id="id_zona" maxlength="8" size="30"onChange="validarzona()" value="<?php $acceso->objeto->ejecutarSql("select *from zona  where (id_zona ILIKE '$ini_u%') ORDER BY id_zona desc"); echo $ini_u.verCo($acceso,"id_zona")?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Estado</label>													
							<!--<select data-parsley-id="2" required="" class="form-control" id="id_esta" onchange="traer_pais();cargar_municipio();">-->
							<select data-parsley-id="2" required="" class="form-control" id="id_esta" name="id_esta"  onchange="cargar_municipio();">
								<?php echo ver_estado($acceso);?>
							</select>
							<ul id="parsley-id-2" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>Municipio</label>													
							<!--<select data-parsley-id="3" required="" class="form-control" id="id_mun" onchange="traer_estado();cargar_ciudad();">-->
							<select data-parsley-id="3" required="" class="form-control" id="id_mun"  name="id_mun" onchange="traer_estado_n();cargar_ciudad_n();">
								<?php echo ver_municipio($acceso);?>
							</select>
							<ul id="parsley-id-3" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>ciudad</label>
							<!--<select data-parsley-id="4" required="" class="form-control" id="id_ciudad" onchange="traer_municipio();validar_nom_zona();">-->
							<select data-parsley-id="4" required="" class="form-control" id="id_ciudad"  name="id_ciudad" onchange="traer_municipio_n();">
								<?php echo ver_ciudad($acceso);?>
							</select>
							<ul id="parsley-id-4" class="parsley-errors-list"></ul>
					</div>
					<div class="form-group col-lg-8 col-md-9 col-sm-12 col-xs-12">
						<label>Nombre Zona</label>													
							<input data-parsley-id="5" required="" class="form-control" type="text" id="nombre_zona" maxlength="50" size="60" value="">
							<ul id="parsley-id-5" class="parsley-errors-list"></ul>
					</div>
					
					<div class="form-group col-lg-2 col-md-3 col-sm-12 col-xs-12">
						<label>Inicial Nro abonado</label>													
							<input data-parsley-id="n_zona" required="" class="form-control" type="text" id="n_zona" name="n_zona"  maxlength="4" size="20" value="<?php echo $n_zona;?>" >
							<ul id="parsley-id-n_zona" class="parsley-errors-list"></ul>
					</div>

					<div class="form-group col-lg-2 col-md-3 col-sm-12 col-xs-12">
						<label>Hogares</label>													
							<input data-parsley-id="6" required="" class="form-control" type="text" id="nro_zona"  maxlength="4" size="20" value="1" >
							<ul id="parsley-id-6" class="parsley-errors-list"></ul>
					</div>
				</div>
				<input class="form-control" type="hidden" value="dato" id="dato">
			</div> <!-- FIN DEL PANEL -->
	</section>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_zona('incluir','zona')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_zona('modificar','zona')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_zona('eliminar','zona')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" id="salir" onclick="cargar_form_zona()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-zona">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Zonas Agregadas</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid_zona" class="data"></div>
					
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