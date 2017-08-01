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
	<div class="border-head"><h3>INTERFAZ Cablemodem</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos DEL cablemodem</header>
			<div class="panel-body">	
				<input  type="hidden" name="id_da" maxlength="8" size="30"onChange="validardeco_ana()" value="<?php $acceso->objeto->ejecutarSql("select *from deco_ana  where (id_da ILIKE '$ini_u%') ORDER BY id_da desc"); echo $ini_u.verCo($acceso,"id_da")?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>codigo</label>													
						<input class="form-control"   type="text" name="codigo_da" maxlength="12" size="30" value=""  onchange="cargar_cablemodem()" >
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>status</label>													
						<select  class="form-control"  disabled name="status_da" id="-1" onchange=""style="width: 176px;">
							<option value="">DISPONIBLE</option>
							<option value="I" >INSTALADO</option>
							<option value="S" >SUSPENDIDO</option>
							<option value="D" >DA&Ntilde;ADO</option>
						</select>
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>marca</label>													
						<select  class="form-control"  disabled name="marca_da" id="-1" onchange=""style="width: 176px;">
							<?php echo ver_marca_m($acceso,'CABLE MODEM'); ?>
						</select>
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>modelo</label>													
						<select  class="form-control"  disabled name="modelo_da" id="-1" onchange=""style="width: 176px;">
								<?php echo ver_modelo($acceso,'CABLE MODEM');?>
						</select>

					</div>
				
		
					
				
				</div>
				
		<input  type="hidden" name="nota1" maxlength="30" size="30" value="" >
		<input  type="hidden" name="nota2" maxlength="30" size="30" value="" >
		
		
		<input class="form-control"   type="hidden" name="tipo_da" maxlength="10" size="30" value="" >
		<input class="form-control"   type="hidden" name="fecha_act_da" maxlength="10" size="30" value="" >
		<input class="form-control"   type="hidden" name="obser_da" maxlength="10" size="30" value="" >
		<input class="form-control"   type="hidden" name="id_contrato" maxlength="10" size="30" value="" >
		<input class="form-control"   type="hidden" name="servicio" maxlength="100" size="30" value="" >
		<input class="form-control"   type="hidden" name="prov_da" maxlength="80" size="30" value="" >
		<input class="form-control"   type="hidden" name="chanmap_da" maxlength="30" size="30" value="" >
		<input class="form-control"   type="hidden" name="punto_da" maxlength="30" size="30" value="" >
		<input class="form-control"   type="hidden" name="nota2" maxlength="50" size="30" value="" >
		<input class="form-control"   type="hidden" name="nota3" maxlength="50" size="30" value="" >
		
		<input class="form-control"   type="hidden" value="dato" name="dato">

		
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
		<input class="form-control"   type="hidden" name="id_accquery" maxlength="10" size="30"onChange="validarinterfaz_cablemodem()" value="<?php $acceso->objeto->ejecutarSql("select *from interfaz_cablemodem  where (id_accquery ILIKE '$ini_u%') ORDER BY id_accquery desc"); echo $ini_u.verCo($acceso,"id_accquery")?>">
			<div class="panel-body">	
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>serial CABLEMODEM</label>													
						<input class="form-control"  type="text" name="serial_deco" maxlength="12" size="30" value="" >
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>comando</label>													
						<select  class="form-control"  name="comando_acc" id="-1" onchange="">
							<option value="0">Seleccione...</option>
							<option value="ACTV">ACTIVAR</option>
							<option value="DESC">DESCONECTAR</option>
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
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="regisertrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','interfaz_cablemodem')"><i class="glyphicon glyphicon-ok"></i> EJECUTAR</button>		
				<input class="form-control"  type="hidden" name="registrar" value="enviar comando" onclick="verificar('incluir','interfaz_cablemodem')">&nbsp;
					<input class="form-control"  type="hidden" name="modificar" value="MODIFICAR" onclick="verificar('modificar','interfaz_cablemodem')">&nbsp;
					<input class="form-control"  type="hidden" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','interfaz_cablemodem')">&nbsp;
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','interfaz_cablemodem')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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








