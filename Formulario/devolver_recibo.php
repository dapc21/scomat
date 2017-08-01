<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ZONA')))
{
$login=$_SESSION["login"];
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1" data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Liberar facturas y contratos</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos a registrar</header>
		
		<div class="panel-body">		
			
			<input class="form-control" type="hidden" name="id_rec" id="id_rec" maxlength="30" size="30"onChange="validarrecibe_recibo()" value="<?php $acceso->objeto->ejecutarSql("select *from recibe_recibo where (id_rec ILIKE '$ini_u%')  ORDER BY id_rec desc"); echo $ini_u.verCo($acceso,"id_rec")?>">
			<input class="form-control" type="hidden" name="login_rec" ="login_rec" maxlength="30" size="30" value="<?php echo $login;?>" >
			<!--<input class="form-control" type="hidden" value="FACTURA" name="dato">-->
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Tipo</label>													
					<select data-parsley-id="tipo" required=""  class="form-control" name="tipo" id="tipo" onchange="listar_facturas_devolver();cargar_cob_ven();">
						<option value=""><?php echo _("TODOS");?></option>
						<option value="FACTURA"><?php echo _("FACTURA");?></option>
						<option value="CONTRATO"><?php echo _("CONTRATO");?></option>
					</select>
					<ul id="parsley-id-tipo" class="parsley-errors-list"></ul>
				</div>
				
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Cobrador/Vendedor</label>													
					<select data-parsley-id="id_cobrador" required="" class="form-control" name="id_cobrador" id="id_cobrador" onchange="listar_facturas_devolver()">
						<?php echo vercobradores($acceso);?>
					</select>
					<ul id="parsley-id-id_cobrador" class="parsley-errors-list"></ul>
				</div>
				
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<label>Fecha</label >
					<input class="form-control form-control-inline input-medium default-date-picker" type="text" name="fecha_rec" data-mask="99/99/9999" id="fecha_rec" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >																	
				</div>
				
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label>Observación</label >
					<textarea class="form-control" name="obser_rec" id="obser_rec" cols="100" rows="1"></textarea>																	
				</div>
			
			</div>
			
		</div> <!-- FIN DEL PANEL -->	
			
	</section>	

	<!-- AREA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">

				<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>

				<button class="btn btn-danger" type="button" class="boton" name="elimDFinar" id="elimDFinar" value="ELIMINAR" onclick="gestionar_devolver_recibo('liberar_recibos','recibe_recibo')"><i class="fa fa-trash-o"></i> Eliminar</button>					

				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_devolver_recibo()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
				
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	

	<section class="panel">		
		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid_recibos_devolver" class="data"></div>						
					
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