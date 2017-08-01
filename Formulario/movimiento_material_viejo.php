<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('movimiento_material'))) //validar privilegios
{

$idStock = id_unico();
$idMov = id_unico();
$idMovMat = id_unico();
$refMov = 'MOV'.$ini_u.substr($idMov, 13,20);
?>
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Administración de Movimientos Entradas/Salidas</h3></div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<!-- ?EA DE PANEL O PANELES -->
		<section class="panel">
		
			<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<header class="panel-heading">Datos del Stock (Material en Almacén)</header>
				<div class="panel-body">
				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<input class="form-control" type="hidden" name="id_stock" id="id_stock" maxlength="20" size="20" value="<?php echo $idStock; ?>">
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<input class="form-control" type="hidden" name="id_mov" id="id_mov" maxlength="20" size="20" value="<?php echo $idMov; ?>">
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<input class="form-control" type="hidden" name="id_mov_mat" id="id_mov_mat" maxlength="20" size="20" value="<?php echo $idMovMat; ?>">
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>almacén</label>
							<select data-parsley-id="id_alm" required="" class="form-control" name="id_alm" id="id_alm" onchange="">
								<?php echo verAlmacenStock($acceso);?>
							</select>
							<ul id="parsley-id-id_alm" class="parsley-errors-list"></ul>			
						</div>

						<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>material</label>
							<select data-parsley-id="id_mat" required="" class="form-control" name="id_mat" id="id_mat" onchange="">
								<?php echo verMaterialStock($acceso);?>
							</select>
							<ul id="parsley-id-id_mat" class="parsley-errors-list"></ul>							
						</div>
						
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div id="info"></div>
						<div id="infoStock"></div>
					</div>
					
				</div> <!-- FIN DEL PANEL -->	
		</section>
		
		</div>
	
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		
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
							<select data-parsley-id="id_res" required="" class="form-control" name="id_res" id="id_res" onchange="" disabled >
								<?php echo verResponsableMovimiento($acceso);?>
							</select>
							<ul id="parsley-id-id_res" class="parsley-errors-list"></ul>							
						</div>
					
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>Tipo de Movimiento</label>
							<select data-parsley-id="id_tipo_mov" required="" class="form-control" name="id_tipo_mov" id="id_tipo_mov" onchange="" disabled >
								<?php echo verTipoMovimiento($acceso);?>
							</select>
							<ul id="parsley-id-id_tipo_mov" class="parsley-errors-list"></ul>							
						</div>
						
						<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<section class="panel" id="dstock">
		
			<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<header class="panel-heading">Stock Disponible</header>
				<div class="panel-body">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<label>cantidad disponible</label>
							<input data-parsley-id="cant_stock_disp" required="" class="form-control" type="text" name="cant_stock_disp" id="cant_stock_disp" maxlength="20" size="20" onblur="formatDec(this.id,this.value);" disabled />
							<ul id="parsley-id-cant_stock_disp" class="parsley-errors-list"></ul>							
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<label>Unidad de Medida</label>
							<input class="form-control" type="text" name="uni_stock_disp" id="uni_stock_disp" size="20" disabled />				
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<label>cantidad mínima</label>
							<input data-parsley-id="cant_stock_min" required="" class="form-control" type="text" name="cant_stock_min" id="cant_stock_min" maxlength="20" size="20" onblur="formatDec(this.id,this.value);" disabled />
							<ul id="parsley-id-cant_stock_min" class="parsley-errors-list"></ul>							
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<label>Unidad de Medida</label>
							<input class="form-control" type="text" name="uni_stock_min_disp" id="uni_stock_min_disp" size="20" disabled />				
						</div>
						
					</div>
					
				</div> <!-- FIN DEL PANEL -->	
		</section>
		
		</div>
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<section class="panel">
		
			<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
			<header class="panel-heading">Entradas/Salidas en el Stock</header>
				<div class="panel-body">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<input class="form-control" type="hidden" name="cant_uni_med_entrada" id="cant_uni_med_entrada" maxlength="20" size="20" value="">
						</div>
						
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<input class="form-control" type="hidden" name="cant_uni_med_salida" id="cant_uni_med_salida" maxlength="20" size="20" value="">
						</div>
						
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<input class="form-control" type="hidden" name="cant_stock_disp_real" id="cant_stock_disp_real" maxlength="20" size="20" value="">
						</div>
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div id="infoValStock"></div>
						</div>

						<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<label id="label_cant_mov_mat">cantidad (entra/sale)</label>
							<input data-parsley-id="cant_mov_mat" required="" class="form-control" type="text" name="cant_mov_mat" id="cant_mov_mat" maxlength="20" size="20" onblur="formatDec(this.id,this.value);" disabled >
							<ul id="parsley-id-cant_mov_mat" class="parsley-errors-list"></ul>							
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<label>Unidad de Medida</label>
							<input class="form-control" type="text" name="uni_cant_ent" id="uni_cant_ent" size="20" disabled />
						</div>
						
						<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label id="label_info_cant_ent">Nota Informativa: </label>
							<input class="form-control" type="text" name="info_cant_ent" id="info_cant_ent" size="20" disabled />
						</div>
						
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<label>stock (entra/sale)</label>
							<input disabled data-parsley-id="stock" required="" class="form-control" type="text" name="stock" id="stock" maxlength="20" size="20" onblur="formatDec(this.id,this.value);" >
							<ul id="parsley-id-stock" class="parsley-errors-list"></ul>							
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<label>Unidad de Medida</label>
							<input class="form-control" type="text" name="uni_stock" id="uni_stock" size="20" disabled />
						</div>

						<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<label>stock mínimo</label>
							<input data-parsley-id="stock_min" required="" class="form-control" type="text" name="stock_min" id="stock_min" value="" maxlength="20" size="20" onblur="formatDec(this.id,this.value);" disabled >
							<ul id="parsley-id-stock_min" class="parsley-errors-list"></ul>							
						</div>
						
						<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<label>Unidad de Medida</label>
							<input class="form-control" type="text" name="uni_stock_min" id="uni_stock_min" size="20" disabled />				
						</div>
						
					</div>
					
				</div> <!-- FIN DEL PANEL -->	
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
					<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_stock_mov_movmat(0); "><i class="glyphicon glyphicon-plus"></i> Agregar</button>		
					<button disabled name="modificar" id="modificar" class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_stock_mov_movmat(1); "><i class="glyphicon glyphicon-plus"></i> Agregar <i class="glyphicon glyphicon-minus"></i> Quitar</button>
					<!--button disabled class="btn btn-danger" type="button" type="<?php /*echo $obj->el;*/ ?>" class="boton" name="eliminar" id="eliminar" value="<?php /*echo _("eliminar");*/?>" onclick="gestionar_movimiento_material('eliminar','movimiento_material')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button-->
					<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_movimiento_material();" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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
	
	var alm='', mat='',valAlm='', valMat='';
	$('#id_alm').on('change', function() {
		valAlm = $(this).val();
		alm = this.options[this.selectedIndex].text;
		if(valAlm == ''){
			mjeInfoSelAlmacen();
			$("#infoStock").html("");
			borrarValoresStock();
		}
		else if(valMat == ''){
			mjeInfoSelMaterial()
			$("#infoStock").html("");
			borrarValoresStock();
		}else{
			
			if(alm != '' && mat != ''){
				console.log("ID: "+valAlm + " - Nombre Almacen: "+this.options[this.selectedIndex].text);
				mjeInfoStock(mat, alm);
				buscar_material_stock_material();
				asignarValoresStock();
			}
		}
		
	});
	
	$('#id_mat').on('change', function() {
		valMat = $(this).val();
		mat = this.options[this.selectedIndex].text;
		if(valAlm == ''){
			mjeInfoSelAlmacen();
			$("#infoStock").html("");
			borrarValoresStock();
		}
		else if(valMat == ''){
			mjeInfoSelMaterial();
			$("#infoStock").html("");
			borrarValoresStock();
		}else{
			
			if(alm != '' && mat != ''){
				console.log("ID: "+valMat + " - Nombre Material: "+this.options[this.selectedIndex].text);
				mjeInfoStock(mat, alm);
				buscar_material_stock_material();
				asignarValoresStock();
			}
		}
		
	});
	
	$('#id_tipo_mov').on('change', function() {
		valor = $(this).val(); console.log(valor);
		if(valor == ''){
			$("#id_mot_mov").attr('disabled','disabled');
		}else{
			$("#id_mot_mov").removeAttr('disabled');
			buscar_motivo_movi(valor);
		}
		
	});
	
	function configStockM(){
		$("#dstock").hide(); /** oculto de entrada el panel de disponibilidad en stock, si ya existía el material en stock aparece luego **/
		$("#modificar").hide();
		$("#label_cant_mov_mat").css({ "color": "#3c763d" });
		$("#label_info_cant_ent").css({ "background-color": "#fff", "color": "#fff"});
		$("#info_cant_ent").css({ "background-color": "#fff", "color": "#31708f", "border":"0", "padding-left":"0"});
		$("#info_cant_ent").val("Cantidad = Stock (Uni. de medida definida en Materiales).");
		$("#dstock header").css({ "background-color": "#3c763d none repeat scroll 0 0", "border-radius": "4px 4px 0 0", "color": "#fff", "line-height": "50 px" });
		$("#dstock .panel-body").css({ "background-color": "#dff0d8 none repeat scroll 0 0", "color": "#3c763d"});
		$("#dstock label").css({ "background-color": "#dff0d8", "color": "#3c763d" });
		$("#cant_mov_mat").css({ "background-color": "#dff0d8", "border-color": "#d6e9c6", "color": "#3c763d" });
		cant_dispo = $("#cant_stock_disp").val();
		if(cant_dispo != "0.00"){
			$("#cant_stock_disp").css({ "color": "#3c763d" });
		}else{
			$("#cant_stock_disp").css({ "color": "#C10000" });
		}
	}
	
	function mjeInfoStock(material, almacen){
		$("#info").html("<div class='well well-lg'>Gestionará <strong>"+material+"</strong> en el <strong>Almacén "+almacen+".</strong><br>Introduzca la cantidad del material en <strong>CANTIDAD (ENTRA/SALE).</strong></div>");
		cssMje();
	}
	
	function mjeInfoSelAlmacen(){
		$("#info").html("<div class='well well-lg'><strong>Atención!</strong> Estimado usuario, usted debe seleccionar un almacén.</div>");
		cssMje();
	}
	
	function mjeInfoSelMaterial(){
		$("#info").html("<div class='well well-lg'><strong>Atención!</strong> Estimado usuario, usted debe seleccionar un material.</div>");
		cssMje();
	}
	
	function mjeStockNuevo(){
		$("#infoStock").fadeIn("slow", function() {
			$("#infoStock").html("<div class='well well-lg well-danger'><strong>Atención!</strong> El material no está asignado a este almacén.</div>");
			$(".well-danger").css({ "background-color": "#f2dede", "border-color": "#ebccd1", "color": "#a94442" });
			$(".well-lg").css({ "padding": "15px", "border-radius": "3px" });
			$(".well-danger").effect("highlight", {color:"#ffff99"}, 1000);
		});
		$("#infoStock").fadeOut(3000);
	}
	
	function mjeStockExiste(){
		$("#infoStock").fadeIn("slow", function() {
			$("#infoStock").html("<div class='well well-lg well-success'><strong>Atención!</strong> Este material se encontró en este almacén.</div>");
			$(".well-success").css({ "background-color": "#dff0d8", "border-color": "#d6e9c6", "color": "#3c763d" });
			$(".well-lg").css({ "padding": "15px", "border-radius": "3px" });
			$(".well-success").effect("highlight", {color:"#ffff99"}, 1000);
		});
		$("#infoStock").fadeOut(3000);
	}
	
	function mjeAlertaCantidad(mje){
		$("#infoValStock").fadeIn("slow", function() {
			$("#infoValStock").html("<div class='well well-lg well-warning'><strong>Atención!</strong> "+mje+" </div>");
			$(".well-warning").css({ "background-color": "#f2dede", "border-color": "#ebccd1", "color": "#a94442" });
			$(".well-lg").css({ "padding": "15px", "border-radius": "3px" });
			$(".well-warning").effect("highlight", {color:"#ffff99"}, 1000);
		});
		$("#infoValStock").fadeOut(5000);
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
		$('#cant_mov_mat').removeAttr('disabled');
		$('#cant_mov_mat').val("");
		$('#stock_min').removeAttr('disabled');
		$('#stock_min').val("");
		$('#stock').val("");
	}
	
	function borrarValoresStock(){
		$("#dstock").fadeOut("fast", function() {
			$('#cant_stock_disp').val("");
			$('#uni_stock_disp').val("");
			$('#cant_stock_min').val("");
			$('#uni_stock_min_disp').val("");
			$('#cant_uni_med_entrada').val("");
			$('#cant_uni_med_salida').val("");
			$('#id_tipo_mov').val("");
			$('#id_res').val("");
			$('#cant_mov_mat').val("");
			$('#uni_cant_ent').val("");
			$('#stock').val("");
			$('#uni_stock').val("");
			$('#stock_min').val("");
			$('#uni_stock_min').val("");
			$('#id_tipo_mov').attr('disabled','disabled');
			$("#id_mot_mov").empty();
			$("#id_mot_mov").append("<option value=''>Seleccione...</option>");
			$('#id_mot_mov').attr('disabled','disabled');
			$('#id_res').attr('disabled','disabled');
			$('#cant_mov_mat').attr('disabled','disabled');
			$('#stock_min').attr('disabled','disabled');
			$("#registrar").show();
			$("#modificar").hide();
			enabled("registrar");
			disabled("modificar");
		});
	}
	
	function formatDec(id, valor){
		var calc = parseFloat(Math.round(valor * 100) / 100).toFixed(2);
		$('#'+id).val(calc);
		if( calc != '0.00'){
			if(id == 'cant_mov_mat'){
				var uni_ent = parseFloat($('#cant_uni_med_entrada').val()).toFixed(2); console.log(uni_ent);
				var uni_sal = parseFloat($('#cant_uni_med_salida').val()).toFixed(2); console.log(uni_sal);
				$('#stock').val(parseFloat(calc * uni_sal / uni_ent).toFixed(2)); console.log(parseFloat(calc * uni_sal / uni_ent).toFixed(2));
			}
		}
		else{
			console.log("Debe ingresar valores válidos o distintos a cero");
			mjeAlertaCantidad("Debe ingresar valores válidos o distintos a cero."); 
			$('#'+id).val("");
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