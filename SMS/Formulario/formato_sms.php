<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('FORMATO_SMS')))
{
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_sms_masivo" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Plantilla para Envío SMS Masivo</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Plantilla para Envío SMS Masivo</header>
		
		<div class="panel-body">
		
		<input type="hidden" name="id_form" maxlength="8" size="30"onChange="validarformato_sms();" value="<?php $acceso->objeto->ejecutarSql("select *from formato_sms  where (id_form ILIKE '$ini_u%') ORDER BY id_form desc"); echo $ini_u.verCo($acceso,"id_form")?>">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<label>Nombre para la Plantilla</label >
			<input class="form-control" type="text" name="nombre_form" maxlength="50" size="50" value="" >
		</div>
		
		<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<label>Descripción</label>
			<textarea class="form-control" name="formato" cols="1" rows="3"  onKeyUp="cuenta_carac_com_f();"></textarea>
			<span class="help-inline">Caracteres: </span><label id="cant_car_f">15</label> / <label id="cant_sms_f">1</label></span>
		</div>
		
		<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<label>Estatus</label >
			<div>
				<input type="radio" checked name="status_form" id="status_activo" value="ACTIVO" onclick="checkRadio();"/> ACTIVO &nbsp;&nbsp;
				<input type="radio" name="status_form" id="status_inactivo" value="INACTIVO" onclick="checkRadio();" /> INACTIVO
			</div>
		</div>
		
		<input  type="hidden" value="dato" name="dato">
		<input  type="hidden" value="1" name="id_franq">
		
		</div>
			
		</div> <!-- FIN DEL PANEL -->	
			
	</section>
	
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" name="registrar" value="REGISTRAR" onclick="verificar_sms('incluir','formato_sms')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" name="modificar" value="MODIFICAR" onclick="verificar_sms('modificar','formato_sms')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" name="eliminar" value="ELIMINAR" onclick="verificar_sms('eliminar','formato_sms')"><i class="fa fa-trash-o"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_sms('formulario.php','formato_sms')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i>Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>
	
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Listado de Formatos Agregados</header>
		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid" class="data"></div>						
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>
	
	<section class="panel">

	<header class="panel-heading">Listado de Variables Definidas</header>
	
		<div class="panel-body">
		
		<table class="table table-condensed">
		  <thead>
		  <tr class="titulo-tabla">
			  <th>VARIABLE</th>
			  <th>DESCRIPCIÓN</th>
		  </tr>
		  </thead>
		  <tbody>
		  <?php
			$acceso->objeto->ejecutarSql("select * from variables_sms where status_var='ACTIVO'");
			$i=1;
			$bgc=array("0"=>"tbl-row-even","1"=>"tbl-row-odd");
			$fill=1;
			while ($row=row($acceso))
			{
				$fill=!$fill;
				$id_var=trim($row["id_var"]);		
				$variable=trim($row["variable"]);
				$descrip_var=trim($row["descrip_var"]);
				echo "
				<tr class='$bgc[$fill]'>
					<td>
						$variable
					</td>
					<td>
						$descrip_var
					</td>
					
				</tr>
				";
				$i++;
			}	
			?>
			
			</tbody>
		</table>
		
		</div>
		
	</section>
 
</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->

<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP_sms(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>