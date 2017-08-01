<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ASIGNAR_CONTRATO')))
{
$login=$_SESSION["login"];


$acceso->objeto->ejecutarSql("select *from parametros where id_param='36' and id_franq='1'");
$row=row($acceso);
$dig_cont_fisico_G=trim($row['valor_param']);


?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="f1" data-parsley-validate="">
	
	<div class="border-head"><h3>Asignar Contratos</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Contrato</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

		<input  type="hidden" name="id_asig" id="id_asig" maxlength="10" size="30"onChange="validarasigna_recibo()" value="<?php $acceso->objeto->ejecutarSql("select *from asigna_recibo where (id_asig ILIKE '$ini_u%')  ORDER BY id_asig desc"); echo $ini_u.verCo($acceso,"id_asig")?>">
		<input  type="hidden" name="login_asig" id="login_asig" maxlength="25" size="30" value="<?php echo $login;?>" >
		
		<input  type="hidden" value="CONTRATO" name="tipo" id="tipo">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-7 col-md-6 col-sm-12 col-xs-12">
				<label>Vendedor</label>
				<select data-parsley-id="id_cobrador" required="" class="form-control" name="id_cobrador" id="id_cobrador" onchange="">
					<?php echo verVendedores($acceso);?>
				</select>
				<ul id="parsley-id-id_cobrador" class="parsley-errors-list"></ul>
			</div>

			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Fecha</label>
				<input data-parsley-id="fecha_asig" required="" class="form-control" type="text" name="fecha_asig" id="fecha_asig" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
				<ul id="parsley-id-fecha_asig" class="parsley-errors-list"></ul>
			</div>

			<div class="form-group col-lg-2 col-md-6 col-sm-12 col-xs-12">
				<label>Serie</label>
				<select  class="form-control" name="serie" id="serie" onchange="">
					<option value=''></option>
					<option value='A'>A</option>
					<option value='B'>B</option>
					<option value='C'>C</option>
					<option value='D'>D</option>
					<option value='E'>O</option>
				</select>
			</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<label>Contrato Desde</label>
				<input data-parsley-id="desde" required="" class="form-control" type="text" name="desde" id="desde" maxlength="<?php echo $dig_cont_fisico_G;?>" size="15" value="" onchange="valida_fact_c();">
				<ul id="parsley-id-desde" class="parsley-errors-list"></ul>
			</div>
			
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<label>Contrato Hasta</label>
				<input data-parsley-id="hasta" required="" class="form-control" type="text" name="hasta" id="hasta" maxlength="<?php echo $dig_cont_fisico_G;?>" size="15" value=""  onchange="valida_fact_c();">
				<ul id="parsley-id-hasta" class="parsley-errors-list"></ul>
			</div>
		
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<label>Cantidad</label>
				<input disabled data-parsley-id="cantidad" required="" class="form-control" type="text" name="cantidad" id="cantidad" maxlength="10" size="15" value="" >
				<ul id="parsley-id-cantidad" class="parsley-errors-list"></ul>
			</div>

			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Observación</label>
				<textarea class="form-control" name="obser_asig" id="obser_asig" cols="1" rows="2"></textarea>
				</div>
			</div>

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>

			<button class="btn btn-success" type="button" name="registrar" id="registrar" value="REGISTRAR" onclick="gestionar_asigna_recibo('incluir','asigna_recibo')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>

			<button disabled class="btn btn-danger" type="button" name="eliminar" id="eliminar" value="ELIMINAR" onclick="gestionar_asigna_recibo('eliminar','asigna_recibo')"><i class="fa fa-trash-o"></i> Eliminar</button>

			<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_asigna_recibo_c()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>

			<input type="hidden" name="modificar" id="modificar" value="MODIFICAR" onclick="gestionar_asigna_recibo('modificar','asigna_recibo')">
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	<section class="panel">
	
		<div class="panel-body">	
			<div id="datagrid_asigna_recibo" class="data"></div>	
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