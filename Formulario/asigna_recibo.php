<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ASIGNAR_RECIBO')))
{
$login=$_SESSION["login"];


$acceso->objeto->ejecutarSql("select *from parametros where id_param='54' and id_franq='1'");
$row=row($acceso);
$dig_recibo_G=trim($row['valor_param']);


?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_asignar_facturas" >
	
	<div class="border-head"><h3>Asignar Facturas</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Factura</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

		<input  type="hidden" name="id_asig" maxlength="10" size="30"onChange="validarasigna_recibo()" value="<?php $acceso->objeto->ejecutarSql("select *from asigna_recibo where (id_asig ILIKE '$ini_u%')  ORDER BY id_asig desc"); echo $ini_u.verCo($acceso,"id_asig")?>">
		<input  type="hidden" name="login_asig" maxlength="25" size="30" value="<?php echo $login;?>" >
		<input  type="hidden" value="FACTURA" name="dato">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-7 col-md-6 col-sm-12 col-xs-12">
			<label>Cobrador</label>
			<select class="form-control" name="id_cobrador" id="-1" onchange="">
				<?php echo vercobradores($acceso);?>
			</select>
			</div>

			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
			<label>Fecha</label>
			<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fecha_asig" id="fecha_asig" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
			</div>

			<div class="form-group col-lg-2 col-md-6 col-sm-12 col-xs-12">
			<label>Serie</label>
			<select class="form-control" name="serie" id="" onchange="">
				<option value=''></option>
				<option value='A'>A</option>
				<option value='B'>B</option>
				<option value='C'>C</option>
				<option value='D'>D</option>
				<option value='E'>O</option>
			</select>
			</div>
			
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
			<label>Factura Desde</label>
			<input class="form-control" type="text" name="desde" id="desde" maxlength="<?php echo $dig_recibo_G;?>" size="15" value="" onchange="valida_fact();">
			</div>
			
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
			<label>Factura Hasta</label>
			<input class="form-control" type="text" name="hasta" id="hasta" maxlength="<?php echo $dig_recibo_G;?>" size="15" value=""  onchange="valida_fact();">
			</div>
		
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
			<label>Cantidad</label>
			<input class="form-control" type="text" name="cantidad" id="cantidad" maxlength="10" size="15" value="" >
			</div>

			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<label>Observación</label>
			<textarea class="form-control" name="obser_asig" cols="1" rows="2"></textarea>
			</div>

			</div>

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<input type="hidden" name="modificar" value="MODIFICAR" onclick="verificar('modificar','asigna_recibo')">
			<button class="btn btn-info" type="button" name="registrar" value="REGISTRAR" onclick="verificar('incluir','asigna_recibo')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
			<button class="btn btn-danger" type="button" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','asigna_recibo')"><i class="fa fa-trash-o"></i> Eliminar</button>
			<button class="btn btn-success" type="button" name="salir" onclick="conexionPHP('formulario.php','asigna_recibo')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	
	<section class="panel" id="tabla-asigna-recibo">
	
		<div class="panel-body">	
		<div id="datagrid" class="data"></div>
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