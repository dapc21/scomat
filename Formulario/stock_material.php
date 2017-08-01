<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('stock_material'))) //validar privilegios
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
	<div class="border-head"><h3>Stock de Materiales</h3></div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<section class="panel" style="height:485px;">
			
				<header class="panel-heading">material(es)</header>
					
					<div id="divTabStockMat" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
						<button name="modificar" id="modificar" class="btn btn-success" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_stock_material('ajustarStock','stock_material')"><i class="glyphicon glyphicon-ok"></i> Ajustar</button>
						<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_stock_material()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
					</div>	
				</div> <!-- FIN DEL PANEL -->	
			</section>	
			
		</div>
	
	</div>
 
</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->
<script type="text/javascript">
buscar_mat_stock_general();

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

