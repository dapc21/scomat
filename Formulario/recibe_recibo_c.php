<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('RECIBIR_CONTRATO')))
{
$login=$_SESSION["login"];
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="f1" data-parsley-validate="">
	
	<div class="border-head"><h3>Procesar Contratos</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Contrato</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

		<input  type="hidden" name="id_rec" id="id_rec" maxlength="30" size="30"onChange="validarrecibe_recibo()" value="<?php $acceso->objeto->ejecutarSql("select *from recibe_recibo where (id_rec ILIKE '$ini_u%')  ORDER BY id_rec desc"); echo $ini_u.verCo($acceso,"id_rec")?>">
		<input  type="hidden" name="login_rec" id="login_rec" maxlength="30" size="30" value="<?php echo $login;?>" >
		<input  type="hidden" value="CONTRATO" name="tipo" id="tipo">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Vendedor</label>
				<select data-parsley-id="id_cobrador" required="" class="form-control" name="id_cobrador" id="id_cobrador" onchange="listar_facturas_asig_c();">			
					<?php echo verVendedores($acceso);?>
				</select>
				<ul id="parsley-id-id_cobrador" class="parsley-errors-list"></ul>
			</div>

			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Fecha</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fecha_rec" id="fecha_rec" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
			</div>

			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Observación</label>
				<textarea class="form-control" name="obser_rec" id="obser_rec" cols="1" rows="2"></textarea>
			</div>

			</div>

		</div> <!-- FIN DEL PANEL --> 
		
	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">

			<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>

			<!--<button class="btn btn-success" type="button" name="registrar" id="registrar" value="RECIBIDO" onclick="gestionar_recibe_recibo_c('incluir','recibe_recibo_CON')"><i class="glyphicon glyphicon-ok"></i> Recibido</button>-->
			<button class="btn btn-success" type="button" name="registrar" id="registrar" value="RECIBIDO" onclick="gestionar_recibe_recibo_c('RECIBIDO','recibe_recibo')"><i class="glyphicon glyphicon-ok"></i> Recibido</button>

			<button class="btn btn-warning" type="button" name="registrDar" id="registrDar" value="DEVUELTO" onclick="gestionar_recibe_recibo_c('DEVUELTO','recibe_recibo')"><i class="fa fa-mail-reply"></i> Devuelto</button>

			<button class="btn btn-danger" type="button" name="registrDaDr" id="registrDaDr" value="ANULADO" onclick="gestionar_recibe_recibo_c('ANULADO','recibe_recibo')"><i class="fa fa-trash-o"></i> Anulado</button>

			<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_recibe_recibo_c()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>

			<input class="btn btn-info" type="hidden" name="modificar" id="modificar" value="MODIFICAR" onclick="gestionar_recibe_recibo_c('modificar','recibe_recibo')">

			<input class="btn btn-danger" type="hidden" name="eliminar" id="eliminar" value="ELIMINAR" onclick="gestionar_recibe_recibo_c('eliminar','recibe_recibo')">

		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	
	<!-- EA DE PANEL O PANELES -->
	<section class="panel">	
		<div class="panel-body">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<div id="datagrid_recibos_c" class="data"></div>
				
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