<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('movimiento'))) //validar privilegios
{

$idMov = id_unico();
$refMov = 'MOV'.$ini_u.substr($idMov, 13,20);
?>
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Movimientos de Materiales</h3></div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<section class="panel">
		
			<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<header class="panel-heading">Datos del Movimiento</header>
				<div class="panel-body">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label>Referencia</label>
							<input data-parsley-id="ref_mov" required="" disabled class="form-control" type="text" name="ref_mov" id="ref_mov" maxlength="20" size="20" value="<?php echo $refMov; ?>">
							<ul id="parsley-id-ref_mov" class="parsley-errors-list"></ul>
						</div>
						
						<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label>Responsable</label>
							<select data-parsley-id="id_res" required="" class="form-control" name="id_res" id="id_res" onchange="" >
								<?php echo verResponsableMovimiento($acceso);?>
							</select>
							<ul id="parsley-id-id_res" class="parsley-errors-list"></ul>							
						</div>
					
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label>Tipo de Movimiento</label>
							<select data-parsley-id="id_tipo_mov" required="" class="form-control" name="id_tipo_mov" id="id_tipo_mov" onchange="" >
								<?php echo verTipoMovimiento($acceso);?>
							</select>
							<ul id="parsley-id-id_tipo_mov" class="parsley-errors-list"></ul>							
						</div>
						
						<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label>Motivo del Movimiento</label>
							<select data-parsley-id="id_mot_mov" required="" class="form-control" name="id_mot_mov" id="id_mot_mov" onchange="" disabled >
								<option value="">Seleccione...</option>
							</select>
							<ul id="parsley-id-id_mot_mov" class="parsley-errors-list"></ul>							
						</div>
						
					</div>
				
				</div> <!-- FIN DEL PANEL -->	
		</section>
		
		</div>
	
	</div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<!-- ?EA DE PANEL O PANELES -->
		<section class="panel" style="height:250px;">
		
			<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<header class="panel-heading">Datos del Almacén</header>
				<div class="panel-body">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<input class="form-control" type="hidden" name="id_mov" id="id_mov" maxlength="20" size="20" value="<?php echo $idMov; ?>">
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>Almacén</label>
							<select data-parsley-id="id_alm" required="" class="form-control" name="id_alm" id="id_alm" onchange="" disabled >
								<?php echo verAlmacenStock($acceso);?>
							</select>
							<ul id="parsley-id-id_alm" class="parsley-errors-list"></ul>			
						</div>
						
						<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label id="label_id_alm2">Almacén Destino</label>
							<select class="form-control" name="id_alm2" id="id_alm2" onchange="">
								<?php echo verAlmacenStock($acceso);?>
							</select>		
						</div>
						
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div id="info"></div>
					</div>
					
				</div> <!-- FIN DEL PANEL -->	
		</section>
		
		</div>
	
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		
			<section class="panel" style="height:250px;">
			
				<header class="panel-heading">Material(es) seleccionado(s)
				<span class="tools pull-right">
				<button id="btn-add_mat" name="btn-add_mat" class="btn btn-success btn-xs" type="button" data-toggle="tooltip" data-placement="top" title="Agregar Material(es)" disabled ><i class="glyphicon glyphicon-plus"></i> Agregar </button>
				<button id="btn-del_mat" name="btn-del_mat" class="btn btn-danger btn-xs" type="button" data-toggle="tooltip" data-placement="left" title="Quitar Material(es)" disabled ><i class="glyphicon glyphicon-minus"></i> Quitar </button>
				</span>
				</header>
				
					<div class="panel-body2">
						<section id="flip-scroll">
							<table id="tabla_movimiento_material" class="table-aux">
								<thead>
									<tr>
										<th class="inbox-small-cells"><input type="checkbox" value="" id="chxmatadd" name="chxmatadd[]" onclick="selCheckAllMM();" ></th>
										<th class="hidden">ID MAT</th>
										<th class="hidden">ID STOCK</th>
										<th class="hidden">DISPONIBLE</th>
										<th class="hidden-phone">MATERIAL(ES)</th>
										<th>CANTIDAD</th>
										<th class="hidden-phone">STOCK MÍNIMO</th>
										<th class="hidden">ID STOCK 2</th>
										<th>CANT. EXPRESADAS EN</th>
										<th class="hidden-phone">ACCIONES</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</section>
					</div>	
			</section>
		
		</div>
	
	</div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		<!-- ?EA DE PANEL O PANELES -->
		<section class="panel">		
			<div class="panel-body">	
				<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
				<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
					<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_movimiento('incluir','movimiento')"><i class="fa fa-exchange"></i> Mover</button>		
					<button disabled name="modificar" id="modificar" class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_movimiento('incluir','movimiento')"><i class="glyphicon glyphicon-plus"></i> Agregar <i class="glyphicon glyphicon-minus"></i> Quitar</button>
					<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_movimiento();" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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
	$.getScript("bootstrap/js/jquery.searchabledropdown-1.0.8.min.js");
	configStockM();
	
	$('[data-toggle="tooltip"]').tooltip();
	
	var alm='', mat='',valAlm='', valMat='', alm2='', valAlm2='';
	$('#id_alm').on('change', function() {
		valAlm = $(this).val();
		alm = this.options[this.selectedIndex].text;
		if(valAlm == ''){
			mjeInfoSelAlmacen();
		}else{
			$('table#tabla_movimiento_material tbody').html("");
			$('#info').html("");
			$('#btn-add_mat').removeAttr('disabled');
		}
		
	});
	
	$('#id_alm2').on('change', function() {
		valAlm2 = $(this).val();
		alm2 = this.options[this.selectedIndex].text;

		if(alm2 != '' && mat != ''){
			console.log("ID: "+valAlm2 + " - Nombre Almacen: "+this.options[this.selectedIndex].text);
			buscar_id_stock_almacen2();
		}
		
	});
	
	$('#id_tipo_mov').on('change', function() {
		valor = $(this).val(); console.log(valor);
		var tipoMov = $("#id_tipo_mov option:selected").text();
		if(valor == ''){
			$("#id_mot_mov").attr('disabled','disabled');
			$("#id_mot_mov").val('');
			$('#id_mot_mov > option[value=""]').attr('selected', 'selected');
			$("#label_id_alm2").fadeOut("slow");
			$("#id_alm2").fadeOut("slow");
			$("#id_alm2").attr('data-parsley-required', false);
			$("#id_alm").attr('disabled','disabled');
			$("#id_alm").val('');
		}else{
			$("#id_mot_mov").removeAttr('disabled');
			$("#id_alm").removeAttr('disabled');
			
			buscar_motivo_movi(valor);
			if(tipoMov == "TRANSFERENCIA" || valor=="558CDD95D59A28310560"){
				$("#label_id_alm2").fadeIn("slow");
				$("#id_alm2").fadeIn("slow");
				$("#id_alm2").attr('data-parsley-required', true);
			}
			else{
				$("#label_id_alm2").fadeOut("slow");
				$("#id_alm2").fadeOut("slow");
				$("#id_alm2").attr('data-parsley-required', false);
			}
		}
		
	});
	
	function configStockM(){
		$("#modificar").hide();
		$("#label_id_alm2").hide();
		$("#id_alm2").hide();
	}
	
	function mjeInfoSelAlmacen(){
		$("#info").html("<div class='well well-lg'><strong>Atención!</strong> Estimado usuario, usted debe seleccionar un almacén.</div>");
		cssMje();
	}
	
	function cssMje(){
		$(".well").css({ "background-color": "#d9edf7", "border-color": "#bce8f1", "color": "#31708f" });
		$(".well-lg").css({ "padding": "15px", "border-radius": "3px" });
		$(".well").effect("highlight", {color:"#ffff99"}, 1000);
	}
	
	function asignarValoresStock(){
		$('#id_tipo_mov').removeAttr('disabled');
		$('#id_tipo_mov').val("");
		$('#id_res').removeAttr('disabled');
		$('#id_res').val("");				
	}
	
	function borrarValoresStock(){
		$('#id_tipo_mov').val("");
		$('#id_res').val("");
		$('#id_tipo_mov').attr('disabled','disabled');
		$("#id_mot_mov").empty();
		$("#id_mot_mov").append("<option value=''>Seleccione...</option>");
		$('#id_mot_mov').attr('disabled','disabled');
		$('#id_res').attr('disabled','disabled');
		$("#label_id_alm2").fadeOut("slow");
		$("#id_alm2").fadeOut("slow");
		$("#id_alm2").attr('data-parsley-required', false);
		$("#btn-add_mat").attr('disabled','disabled');
		$("#registrar").show();
		$("#modificar").hide();
		enabled("registrar");
		disabled("modificar");
	}
	
	function formatDec(id, valor){
		if( valor != "" ){
			var calc = parseFloat(Math.round(valor * 100) / 100).toFixed(2);
			$('#'+id).val(calc);
			if( calc == '0.00'){
				$('#'+id).val("");
			}
		}
	}
	
	function formatDecStockMin(id, valor){
		if( valor != "" ){
			var calc = parseFloat(Math.round(valor * 100) / 100).toFixed(2);
			$('#'+id).val(calc);
			if( calc == '0.00'){
				$('#'+id).val("1.00");
			}
		}
		else $('#'+id).val("1.00");
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
	
	function asignarIdUnicoMat(){ //asignar id_unico() a aquellos registros que se introducen por primera vez desde la tabla
		$('#tabla_movimiento_material tr').each(function () {
			
			if( $(this).find("td").eq(2).html() == ""){
				$(this).find("td").eq(2).load('Formulario/idUnicoStockMaterial.php');
			}
			if( $(this).find("td").eq(7).html() == ""){
				$(this).find("td").eq(7).load('Formulario/idUnicoStockMaterial.php');
			}

		});
	}
	
	$('#btn-add_mat').on('click', function() { //acciones del boton agregar materiales
		var tipoMov = $("#id_tipo_mov option:selected").text();
		if(tipoMov == "ENTRADA"){
			cargarMaterialEntrada();
		}else{
			cargarMaterialSalida();
		}
	});
	
	$('#btn-del_mat').on('click', function() { //acciones del boton quitar materiales 
		var registros = '';
		$('.selrow').remove();
		if(registros == 0){
			$('#btn-del_mat').attr('disabled','disabled');
			$('#btn-del_mat').tooltip('hide');
			$("#chxmatadd").prop("checked", false);
		}
	});
	
	$(document).on('click','.clsEliminarFila',function(){ //eliminar fila una por una
		var objFila=$(this).parents().get(1);
		var registros = '';
		$(objFila).remove();
		registros = $('#tabla_movimiento_material tbody tr').length;
		if(registros == 0){
			$('#btn-del_mat').attr('disabled','disabled');
			$('#btn-del_mat').tooltip('hide');
			$("#chxmatadd").prop("checked", false);
		}
	});
	
	function selCheckAllMM(){
		var marcado = $("#chxmatadd").prop("checked");
		$('#tabla_movimiento_material tbody tr').each(function () {
			if(marcado){
				$('#btn-del_mat').removeAttr('disabled'); //habilito el botón
				$('input[type=checkbox]').prop("checked", true);
				$(this).addClass('selrow');
			}
			else{ 
				$('#btn-del_mat').attr('disabled','disabled'); //deshabilito el botón
				$('#btn-del_mat').tooltip('hide');
				$('input[type=checkbox]').prop("checked", false);
				$(this).removeClass('selrow');
			}
		});
	}
	
	function selCheckOnlyMM(i,id){
		var marcado = $(id).prop("checked");
		var checkados = $('input[type=checkbox]:checked').length;
		//console.log(checkados);
		if(checkados == 0) {
			$('#btn-del_mat').attr('disabled','disabled');
			$('#btn-del_mat').tooltip('hide');
		}
		else {
			$('#btn-del_mat').removeAttr('disabled');
		}
		
		if(marcado){
			$(id).closest('tr').addClass('selrow');
		}
		else{ 
			$(id).closest('tr').removeClass('selrow');
		}
	}

	/*
	$("select").searchable({
		maxListSize: 100,						// if list size are less than maxListSize, show them all
		maxMultiMatch: 50,						// how many matching entries should be displayed
		exactMatch: false,						// Exact matching on search
		wildcards: true,						// Support for wildcard characters (*, ?)
		ignoreCase: true,						// Ignore case sensitivity
		latency: 200,							// how many millis to wait until starting search
		warnMultiMatch: 'top {0} matches ...',	// string to append to a list of entries cut short by maxMultiMatch 
		warnNoMatch: 'no matches ...',			// string to show in the list when no entries match
		zIndex: 'auto'							// zIndex for elements generated by this plugin
	});*/
	
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

