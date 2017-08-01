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
	<div class="border-head"><h3>administracion de decodificadores</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos a registrar</header>
			<div class="panel-body">	
				<input  type="hidden" name="id_da" maxlength="8" size="30"onChange="validardeco_ana()" value="<?php $acceso->objeto->ejecutarSql("select *from deco_ana  where (id_da ILIKE '$ini_u%') ORDER BY id_da desc"); echo $ini_u.verCo($acceso,"id_da")?>">
		
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>CODIFICACION</label>													
						<select  class="form-control" name="punto_da" id="punto_da" onchange="habilita_tam_campo_deco_ana()" >
							<option value="DIGITAL">DIGITAL</option>
							<option value="ACC">ACC400</option>
							<option value="SM">SYSTEM MANAGER</option>
						</select>			
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>codigo</label>													
						<input  class="form-control"  type="text" name="codigo_da" maxlength="12" size="30" value=""  onchange="cargar_deco()" >		
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>codigo2</label>													
						<input class="form-control"  disabled type="text" name="nota2" maxlength="9" size="30" value=""  onchange="" >			
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>status</label>													
							<select class="form-control"  disabled name="status_da" id="-1" onchange="">
							<option value="">DISPONIBLE</option>
							<option value="I" >ACTIVO</option>
							<option value="S" >SUSPENDIDO</option>
							
						</select>
					</div>
				
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>marca</label>													
							<select  class="form-control" name="marca_da" id="marca_da" onchange="" >
								<?php echo ver_marca_m($acceso,'DECODIFICADORES ANALOGICOS'); ?>
							</select>
					</div>
					
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>modelo</label>													
						<select  class="form-control" name="modelo_da" id="modelo_da" onchange="">
								<?php echo ver_modelo($acceso,'DECODIFICADORES ANALOGICOS');?>
						</select>			
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>tipo da</label>													
						<select class="form-control"  name="tipo_da" id="tipo_da" onchange="" >
							<option value="36" >36</option>
						</select>
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>fecha</label>													
							<input  class="form-control" disabled type="text" name="fecha_act_da" id="fecha_act_da" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
					</div>
					
					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<label>estado fisico</label>			
						<select  class="form-control" name="prov_da" id="prov_da" onchange="" >
							<option value="BUENO">BUENO</option>
							<option value="DAÑADO">DAÑADO</option>
						</select>
					</div>
					<div class="form-group col-lg-9 col-md-9 col-sm-12 col-xs-12">
						<label>OBSERVACION</label>													
						<textarea  class="form-control" name="obser_da"  rows="1"></textarea>
					</div>

		
					
				
				</div>
				<input  type="hidden" name="id_contrato" maxlength="10" size="30" value="" >
				
				<input  type="hidden" name="servicio" maxlength="30" size="30" value="" >
				<input  type="hidden" name="chanmap_da" maxlength="30" size="30" value="" >
				
				<input  type="hidden" name="nota3" maxlength="50" size="30" value="" >
				
				<input  type="hidden" value="dato" name="dato">
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','deco_ana_i')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','deco_ana_i')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','deco_ana_i')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','deco_ana')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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
						<option value="">DISPONIBLE</option>
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








