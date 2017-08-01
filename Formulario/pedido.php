<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('pedido'))) //validar privilegios
{

$acceso->objeto->ejecutarSql("select * from estatus_pedido where codigo_est_ped = 'SOL'");
while($row=row($acceso)){
	$nom_estatus = trim($row['nombre_est_ped']);
	$idEstPed = trim($row['id_est_ped']);
}

$idPed = id_unico();
$refPed = 'PED'.$ini_u.substr($idPed, 13,20);
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Pedido de Materiales</h3></div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<section class="panel">
			
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Datos del Pedido</header>
					<div class="panel-body">
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
							<div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<label>Referencia</label>
								<input data-parsley-id="ref_ped" required="" class="form-control" type="text" name="ref_ped" id="ref_ped" maxlength="20" size="20" value="<?php echo $refPed; ?>" disabled >
								<ul id="parsley-id-ref_ped" class="parsley-errors-list"></ul>
							</div>

							<div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
								<label>Observación</label>
								<input data-parsley-id="obser_ped" required="" class="form-control" type="text" name="obser_ped" id="obser_ped" maxlength="65" >
								<ul id="parsley-id-obser_ped" class="parsley-errors-list"></ul>								
							</div>
							
							<div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
								<label>Criterio para Stock</label>
								<div class="form-group">
									<input  type="radio" name="cri_pedido" id="stgen" value="GEN" CHECKED>&nbsp;GENERAL
									&nbsp;&nbsp;&nbsp;
									<input type="radio" name="cri_pedido" id="stmin" value="MIN"  >&nbsp;BAJO MÍNIMO
								</div>
							</div>
							
						</div>
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

							<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<input type="hidden" class="form-control" name="nombre_est_ped" id="nombre_est_ped" maxlength="120" value="<?php echo $nom_estatus;  ?>"  >						
							</div>

							<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<input type="hidden" class="form-control" name="id_ped" id="id_ped" maxlength="" size="" value="<?php echo $idPed; ?>">
							</div>
							
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<input class="form-control" type="hidden" name="id_est_ped" id="id_est_ped" maxlength="20" size="20" value="<?php echo $idEstPed; ?>">
							</div>

						</div>
						
					</div> <!-- FIN DEL PANEL -->	
			</section>
		
		</div>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<section class="panel" style="height:485px;">
			
				<header class="panel-heading">material(es) solicitado(s)</header>
					
					<div id="divTabPedMat" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<!-- Aquí se inserta la tabla -->
					</div>
					
			</section>
		
		</div>
	
	</div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
			<section class="panel">		
				<div class="panel-body">	
					<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
						<button class="btn btn-warning" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_pedido('incluir','pedido')"><i class="glyphicon glyphicon-file"></i> Solicitar</button>		
						<button disabled name="modificar" id="modificar" class="btn btn-success" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_pedido('modificar','pedido')"><i class="glyphicon glyphicon-ok"></i> Confirmar</button>
						<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_pedido()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
					</div>	
				</div> <!-- FIN DEL PANEL -->	
			</section>	
			
		</div>
			
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
			<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">		
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Datos Agregados</header>
					<div class="panel-body">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
							<div id="datagrid"></div>
							
						</div>		
				</div> <!-- FIN DEL PANEL -->	
			</section>

		</div>
	
	</div>
 
</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->
<script type="text/javascript">
buscar_mat_stock_gen();
//Radio
$("input[name=cri_pedido]").click(function () {
	if( $(this).val() == "GEN") buscar_mat_stock_gen();
	if( $(this).val() == "MIN") buscar_mat_stock_min();
});

function formatDec(id, valor){
	if( valor != "" ){
		var calc = parseFloat(Math.round(valor * 100) / 100).toFixed(2);
		$('#'+id).val(calc);
		if( calc == '0.00'){
			$('#'+id).val("");
		}
	}
}

function SoloNumeroDecimal(e, field) {

	var key = e.keyCode ? e.keyCode : e.which;

	// backspace
	if (key == 8) return true;
	//<- -> flechas
	if (key > 35 && key < 40) return true;
	// 0-9 a partir del .decimal
	if (field.value != "") {
		if ((field.value.indexOf(".")) > 0) {
			//si tiene un punto valida dos digitos en la parte decimal
			if (key > 47 && key < 58) {
				if (field.value == "") return true;

				regexp = /^[0-9]{10}[\.][0-9]{2}$/;
				return !(regexp.test(field.value));
			}
		}
	}
	// 0-9
	if (key > 47 && key < 58) {
		if (field.value == "") return true;
		regexp = /[0-9]{10}/;
		return !(regexp.test(field.value));
	}
	// .
	if (key == 46) {
		if (field.value == "") return false;
		regexp = /^[0-9]+$/;
		return regexp.test(field.value);
	}
	//otra tecla
	return false;
}
</script>
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

