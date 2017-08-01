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
	<div class="border-head"><h3>INTERFAZ DECODIFICADORES</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos del decodificador</header>
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
						<label>status deco</label>													
							<select class="form-control"  disabled name="status_da" id="-1" onchange="">
							<option value="">DISPONIBLE</option>
							<option value="I" >ACTIVO</option>
							<option value="S" >SUSPENDIDO</option>
							
						</select>
					</div>
				
		
					
				
				</div>
				
		<input  type="hidden" name="marca_da" maxlength="30" size="30" value="" >
				<input  type="hidden" name="modelo_da" maxlength="30" size="30" value="" >
				
		<input class="form-control"  type="hidden" name="tipo_da" maxlength="10" size="30" value="" >
		<input class="form-control"  type="hidden" name="fecha_act_da" maxlength="10" size="30" value="" >
		<input class="form-control"  type="hidden" name="obser_da" maxlength="10" size="30" value="" >
		<input class="form-control"  type="hidden" name="id_contrato" maxlength="10" size="30" value="" >
		<input class="form-control"  type="hidden" name="servicio" maxlength="100" size="30" value="" >
		<input class="form-control"  type="hidden" name="prov_da" maxlength="80" size="30" value="" >
		<input class="form-control"  type="hidden" name="chanmap_da" maxlength="30" size="30" value="" >
		
		<input class="form-control"  type="hidden" name="nota3" maxlength="50" size="30" value="" >
		
		<input class="form-control"  type="hidden" value="dato" name="dato">

			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos del abonado</header>
			<div class="panel-body">	
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>nro contrato</label>													
						<input class="form-control" disabled type="text" name="nro_contrato" onChange="" maxlength="10" size="10" value="" >		
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>rif / cedula</label>													
						<input class="form-control" disabled type="text" name="cedula" maxlength="10" size="10" value="" onChange="buscarXcedula()">	
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>cliente</label>													
						<input class="form-control" disabled type="text" name="nombre" maxlength="30" size="15" value="" >	
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>status contrato</label>													
						<input class="form-control" disabled type="text" name="status_contrato" maxlength="15" size="15" value="" >
					</div>
				
		
					
				
				</div>
				<input  type="hidden" name="apellido" maxlength="10" size="30" value="" >
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Comando a enviar</header>
		<input class="form-control"  type="hidden" name="id_accquery" maxlength="10" size="30"onChange="validarinterfazacc()" value="<?php $acceso->objeto->ejecutarSql("select *from interfazacc  where (id_accquery ILIKE '$ini_u%') ORDER BY id_accquery desc"); echo $ini_u.verCo($acceso,"id_accquery")?>">
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>serial Decodificador</label>													
						<input class="form-control" type="text" name="serial_deco" id="serial_deco" maxlength="16" size="30" value="" >
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>comando</label>													
						<select  class="form-control" name="comando_acc" id="-1" onchange="">
							<option value="0">Seleccione...</option>
							<option value="AGREGAR">AGREGAR</option>
							<option value="ACTIVAR">ACTIVAR</option>
							<option value="DESACTIVAR">DESACTIVAR</option>
							<option value="SERVICIOS">SERVICIOS</option>
							<option value="BORRAR">BORRAR</option>
						</select>
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>status</label>	<br>												
						<label>
							<input   type="radio" name="status_accquery" value="FALSE"CHECKED>&nbsp;FALSE
							<input  type="radio" name="status_accquery" value="TRUE">&nbsp;TRUE
						</label>		
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>fecha</label>													
						<input class="form-control"  type="text" name="fecha_accquery" id="fecha_accquery" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
					</div>

				</div>
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="regisertrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','interfazacc')"><i class="glyphicon glyphicon-ok"></i> EJECUTAR</button>		
				<input class="form-control"  type="hidden" name="registrar" value="enviar comando" onclick="verificar('incluir','interfazacc')">&nbsp;
					<input class="form-control"  type="hidden" name="modificar" value="MODIFICAR" onclick="verificar('modificar','interfazacc')">&nbsp;
					<input class="form-control"  type="hidden" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','interfazacc')">&nbsp;
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','interfazacc')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel" id="tabla-estado">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">comandos procesados</header>
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
					<input  type="button" class="boton" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>








