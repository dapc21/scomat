<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('BANCO')))
{

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Bancos</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Banco</header>
			<div class="panel-body">

				<input class="form-control" type="hidden" name="id_banco" id="id_banco" maxlength="10" size="30"onChange="" value="<?php $acceso->objeto->ejecutarSql("select *from banco  where (id_banco ILIKE '$ini_u%') ORDER BY id_banco desc"); echo $ini_u.verCodigo($acceso,"id_banco")?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-12">
						<label>Banco</label>													
							<input data-parsley-id="1"  required=""  class="form-control" type="text" name="banco" id="banco" maxlength="50" value="" onChange="">
							<ul id="parsley-id-1" class="parsley-errors-list"></ul>						
					</div>
					
					<div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-12">
						<label for="tipo_banco" >Tipo de Banco</label>													
							<select data-parsley-id="2"  required="" class="form-control" name="tipo_banco" id="tipo_banco">
								<option selected="selected" value="">Seleccione...</option>
								<option value="CLIENTE"><?php echo _("CLIENTE");?></option>
								<option value="EMPRESA"><?php echo _("EMPRESA");?></option>
							</select>
							<ul id="parsley-id-2" class="parsley-errors-list"></ul>
					</div>
				</div>
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
		<div class="panel-body" >
			<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>	
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				
<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" id="registrar" value="" onclick="gestionar_banco('incluir','banco')"><i class="glyphicon glyphicon-ok"></i> Registrar banco</button>		

				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" id="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_banco('modificar','banco')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>

				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_banco('eliminar','banco')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" id="salir" onclick="cargar_form_banco()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	
		
	<section class="panel" id="tabla-banco">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Bancos Registrados</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid_banco"></div>
					
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