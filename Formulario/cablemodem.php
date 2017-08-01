<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CALEMODEN')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="estado" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administracion de cable modem</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos a registrar</header>
			<div class="panel-body">	
				<input  type="hidden" name="id_cm" maxlength="8" size="30"onChange="validarcablemodem()" value="<?php $acceso->objeto->ejecutarSql("select *from cablemodem  where (id_cm ILIKE '$ini_u%') ORDER BY id_cm desc"); echo $ini_u.verCo($acceso,"id_cm")?>">
		
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>MAC</label>													
						<input  class="form-control"  type="text" name="codigo_cm" maxlength="19" size="25" value="" onchange='valida_cablemodem_c()'>						
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>DIRECCION IP</label>													
						<input  class="form-control"  type="text" name="nota3" maxlength="12" size="25" value="" onchange='valida_cablemodem_c()'>				
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>MARCA</label>													
						<select  class="form-control"  name="marca_cm" id="-1" onchange="" >
							<?php echo ver_marca_m($acceso,'CABLE MODEM'); ?>
						</select>					
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>MODELO</label>													
							<select  class="form-control"  name="modelo_cm" id="-1" onchange="" >
								<?php echo ver_modelo($acceso,'CABLE MODEM');?>
							</select>
					</div>
					
					
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>ubicacion</label>													
							<select  class="form-control"  name="nota1" id="nota1" onchange="" >
								<option value="EMPRESA">EMPRESA</option>
								<option value="CLIENTE">CLIENTE</option>
							</select>				
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label> ESTADO FISICO</label>													
						<select  class="form-control"  name="nota2" id="nota2" onchange="" >
							<option value="BUENO">BUENO</option>
							<option value="DAÑADO">DAÑADO</option>
						</select>
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>fecha</label>													
						<input  class="form-control"  type="text" name="fecha_act_cm" id="fecha_act_cm" maxlength="10" size="25" value="<?php echo date("d/m/Y");?>" >			
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>status</label>													
							<select  class="form-control"  name="status_cm" id="status_cm" onchange="" >
							<option value="">DISPONIBLE</option>
							<option value="ACTIVO">ACTIVO</option>
							<option value="SUSPENDIDO">SUSPENDIDO</option>
						</select>
					</div>
					
					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<label>nro contrato</label>			
						
						<input  class="form-control"  DISABLED type="text" name="nro_contrato" onChange="c_nro_contrato()" maxlength="10" size="10" value="" >
						<input  class="form-control"   type="hidden" name="cedula" maxlength="10" size="10" value="" onChange="c_cedula()">
						
						<input  class="form-control"   type="hidden" name="id_contrato" maxlength="12" size="15" value="" onchange=''>
					</div>
					<div class="form-group col-lg-9 col-md-9 col-sm-12 col-xs-12">
						<label>OBSERVACION</label>													
							<textarea  class="form-control"  name="obser_cm"  rows="1"></textarea>
					</div>

		
					
				
				</div>
				<input class="form-control" type="hidden" value="dato" name="dato">
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','cablemodem_i')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','cablemodem_i')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','cablemodem_i')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','cablemodem')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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







