<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('motivo_nota')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1" data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Motivos para Notas de Crédito/Debito</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Motivo para Notas de Crédito/Debito</header>
			<div class="panel-body">	
				
				<input class="form-control" type="HIDDEN" id="idmotivonota" name="idmotivonota" maxlength="8" size="30" onChange="validarmotivonotas()" value="<?php $acceso->objeto->ejecutarSql("select *from motivonotas  where (idmotivonota ILIKE '$ini_u%') ORDER BY idmotivonota desc"); echo $ini_u.verCo($acceso,"idmotivonota")?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<label>Nombre del Motivo</label>													
						<input data-parsley-id="nombremotivonota" required="" class="form-control" type="text" id="nombremotivonota" name="nombremotivonota" maxlength="50" size="30" value="" onChange="validar_nom_otivonotas()" >								
						<ul id="parsley-id-nombremotivonota" class="parsley-errors-list"></ul>
					</div>	

					<div class="form-group col-lg-3 col-md-12 col-sm-12 col-xs-12">
						<label>Estatus</label>
						<div>																	
							<input type="radio" name="status" value="ACTIVO"CHECKED /> Activo &nbsp;&nbsp;														
							<input type="radio" name="status" value="INACTIVO" /> Inactivo
						</div>
					</div>												

				</div>	
				
			<input class="form-control" type="hidden" value="dato" id="dato" name="dato">
			</div> <!-- FIN DEL PANEL -->	
			
	</section>
				
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" id="registrar" name="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_motivonotas('incluir','motivonotas')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" id="modificar" name="modificar" value="<?php echo _("modificar");?>" onclick="gestionar_motivonotas('modificar','motivonotas')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" id="eliminar" name="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_motivonotas('eliminar','motivonotas')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" id="salir" name="salir" onclick="cargar_form_motivonotas();" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>			
				
	<section class="panel" id="tabla-motivo-nota">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Motivos para Notas de Crédito/Debito Registrados</header>
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid" class="data"></div>						
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	 
 
</form> <!-- FIN DEL FORMULARIO -->

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