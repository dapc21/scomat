function cargar_form_stock_material(){
	$.ajax({
		type: "GET",
		url: "Formulario/stock_material.php"
	})
	.done(function( respuesta, textStatus, jqXHR ){
	$("#principal").html(respuesta);
		activar_validar_datos();
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		alerta("Error al cargar formulario:\n "+textStatus);
	});
}
function gestionar_stock_material(accion,clase){
	//if(validarVentanaMatStock()) {
		validarStock("gestion_stock_material",accion,clase);
	//}
}
function validarStock(llamafuncion,accion,clase){
	if(validarVentanaMatStock()) {
		ventaG =  new BootstrapDialog({
			title: 'CONFIRMACIÓN DE SAECO',
			message: 'Seguro que desea enviar este formulario?',
			type: BootstrapDialog.TYPE_INFO,
			closable: true,
			buttons: [{
				label: 'NO',
				icon: 'glyphicon glyphicon-thumbs-down',
				cssClass: 'btn-danger',
				action: function(dialog) {
					dialog.close();
					return false;
				}
			},
			{
				label: 'SI',
				icon : 'glyphicon glyphicon-thumbs-up',
				cssClass: 'btn-info',
				action: function(dialog) {
				dialog.setTitle('Procesando Información');
				dialog.setButtons('');
				dialog.setType(BootstrapDialog.TYPE_SUCCESS);
				dialog.setMessage('<div style="text-align: center;color:#058CB6;"><br>Por favor espere<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>');

				eval(llamafuncion+"('"+accion+"','"+clase+"')");

				}
			}]
		}).open();
	}
}
function gestion_stock_material(accion,clase){
	
	var parametros=[{
		"clase":clase,
		"accion":accion,
		"datos":{
			"stock_material":ajustar_stock()
		}
	}];
	$.ajax({
		data:{"parametros":JSON.stringify(parametros)},
		type: "POST",
		dataType: "json",
		url: "controlador.php",
	})
	.done(function( respuesta, textStatus, jqXHR ){
		ventaG.close();
		if( respuesta.success ) {
			console.log("se procesó (ingresó o actualizó) el stock");
			cargar_form_stock_material();
		}else {
			alerta("ERROR DURANTE TRANSACCION\n"+respuesta.error);
		}

	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		ventaG.close();
		if ( console && console.log ) {
			alerta("ERROR DURANTE TRANSACCION\nError: "+textStatus);
			log( "La solicitud a fallado: " +  textStatus);
		}
	});
}
/**********************************************
	FUNCIÓN OBJETO PARA STOCK_MATERIAL
**********************************************/
function ajustar_stock(){
	var stockMat = new Array();
	var tabla = $('#tabla_stock_material').DataTable(); //Obtenemos la tabla
	var nodo = tabla.fnGetNodes();
	//index recorre toda la tabla.
	//i lleva el control de los ids ej. para i=5, $('#txt_mat_5', nodo).val();
	//j lleva el control del array stockMat si cumple la condición incrementa.
	var i = 0, j = 0; 
	$.each(nodo, function( index, obj ) {
		i = index+1;
		if ( $('#txt_mat_'+i, nodo).val() != "" ) {
			var obj = new Object();
			obj.id_stock  = $("#id_stock"+i, nodo).text(); //viene de la tabla
			obj.id_alm  = $("#id_alm"+i, nodo).text(); //viene de la tabla
			obj.id_mat  = $("#id_mat"+i, nodo).text(); //viene de la tabla
			obj.stock  = $("#txt_mat_"+i, nodo).val(); //viene de la tabla
			obj.stock_min  = $("#stock_min_mat"+i, nodo).text(); //viene de la tabla 
			stockMat[j] = obj;
			j++;
		}
    });
	return stockMat;
}

/**********************************************
	STOCK (CARGA TABLA)
**********************************************/

function  buscar_mat_stock_general(){
	var parametros=[{
		"clase":"stock_material",
		"consulta":"SELECT * FROM vista_stock_material WHERE id_estatus_reg = 1 AND status_alm = 'ACTIVO'"
	}]
	buscar_mate_stock_general(parametros);
}
function  buscar_mate_stock_general(parametros){
	$.ajax({
		data:{"parametros":JSON.stringify(parametros)},
		type: "GET",
		dataType: "json",
		beforeSend: function() {
			$("#divTabStockMat").html('<div style="text-align: center; color: #344151;"><br>Cargando...<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>');
		},
		url: "controlador_buscar.php"
	})
	.done(function( respuesta, textStatus, jqXHR ) {
		if(respuesta.success ){
			asignar_mate_stock_general(respuesta);
		}else {
			log( "Error: " + respuesta.error);
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		log( "La solicitud a fallado: " +  textStatus);
	});
}
function asignar_mate_stock_general(respuesta){
	var objetos=respuesta.objetos;
	for (var objeto in objetos){
		var clase=objetos[objeto].clase;
		var cantidad=objetos[objeto].cantidad;
		var output='';
		if(cantidad==0){
			switch(clase){
				case "stock_material":
					$("#divTabStockMat").html('');
					output += '<table id="tabla_stock_material" class="table table-striped table-advance table-hover">';
					output += '<thead>';
					output += '<tr>';
					output += '<th>N°</th>';
					output += '<th class="hidden">ID MATERIAL</th>';
					output += '<th class="hidden">ID STOCK</th>';
					output += '<th class="hidden">ID ALMACEN</th>';
					output += '<th class="hidden-phone">MATERIAL(ES)</th>';
					output += '<th>STOCK DISPONIBLE</th>';
					output += '<th>AJUSTE DE STOCK</th>';
					output += '<th>STOCK MÍNIMO</th>';
					output += '<th>ALMACÉN</th>';
					output += '</tr>';
					output += '</thead>';
					output += '<tbody>';
					output += '<tr class="odd">';
					output += '<td class="dataTables_empty" valign="top" colspan="9">No se encontraron resultados</td>';
					output += '</tr>';
					output += '</tbody>';
					output += '</table>';
					tablaStockMaterialNoData(output);
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}
		else{
			switch(clase){
				case "stock_material":
				
						$("#divTabStockMat").html('');
						output += '<table id="tabla_stock_material" class="table table-striped table-advance table-hover">';
						output += '<thead>';
						output += '<tr>';
						output += '<th>N°</th>';
						output += '<th class="hidden">ID MATERIAL</th>';
						output += '<th class="hidden">ID STOCK</th>';
						output += '<th class="hidden">ID ALMACEN</th>';
						output += '<th class="hidden-phone">MATERIAL(ES)</th>';
						output += '<th>STOCK DISPONIBLE</th>';
						output += '<th>AJUSTE DE STOCK</th>';
						output += '<th>STOCK MÍNIMO</th>';
						output += '<th>ALMACÉN</th>';
						output += '</tr>';
						output += '</thead>';
						output += '<tbody>';
						
					for (var datos in objetos[objeto].data){
						var conteo = parseInt(datos);
						conteo = conteo+1;
						var campo = objetos[objeto].data[datos];
						var unidad="", disp="";
						
						if(campo.nombre_uni_sal == "UNIDAD") unidad = campo.nombre_uni_sal+"(ES)";
						else unidad = campo.nombre_uni_sal+"(S)";
						if(campo.stock == "") disp = "<strong style='color:#a94442;' id=disp" + conteo + ">0.00</strong>";
						else disp = "<strong style='color:#3c763d;' id=disp" + conteo + ">" + campo.stock + "</strong>";
						
						output += '<tr id="fila'+conteo+'">';
						output += '<td id="num'+conteo+'">' +conteo+ '</td>';
						output += '<td id="id_mat'+conteo+'" class="hidden">' + campo.id_mat + '</td>';
						output += '<td id="id_stock'+conteo+'" class="hidden">' + campo.id_stock + '</td>';
						output += '<td id="id_alm'+conteo+'" class="hidden">' + campo.id_alm + '</td>';
						output += '<td id="material'+conteo+'" class="hidden-phone">' + campo.nombre_mat + '</td>';
						output += '<td id="stock'+conteo+'">' + disp + ' <strong id="uni_abrev'+conteo+'">' + campo.abrev_uni_sal + '</strong></td>';
						output += '<td id="cantidad'+conteo+'"><input class="form-control" type="text" name="txt_mat_'+conteo+'" id="txt_mat_'+conteo+'" maxlength="20" size="15" value="" onKeyPress="return SoloNumeroDecimal(event,this);" onblur="formatDec(this.id,this.value);" /> <strong>'+unidad+'</strong></td>';
						output += '<td id="stock_min'+conteo+'"><strong style="color:#a94442;" id="stock_min_mat'+conteo+'">' + campo.stock_min + '</strong> <strong>' + campo.abrev_uni_sal + '</strong></td>';
						output += '<td id="almacen'+conteo+'" class="hidden-phone">' + campo.nombre_alm + '</td>';
						output += '</tr>';
						
					}
						output += '</tbody>';
						output += '</table>';
						tablaStockMaterial(output);
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}
	}
}


function confTablaStockMaterial(nombreTabla){
	
	return $(nombreTabla).dataTable({
		"bRetrieve": true,
		"bProcessing": true,
		"bDestroy": true,
		"bPaginate": true,
		"bLengthChange": true,
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bAutoWidth": true,
		'bPagination' : true,
		"iDisplayLength": 6,
		"aLengthMenu": [[6, 10, 15, 25, 50, -1], [6, 10, 15, 25, 50, "Todos"]]
	});

}

function tablaStockMaterialNoData(tabla){
	$("#divTabStockMat").append(tabla);
	$('#divTabStockMat').css('height', '435px');
	$('#divTabStockMat').css('margin', 'auto 0');
	$('#divTabStockMat').css('padding-right', '6px');
	$('#divTabStockMat').css('padding-left', '6px');
	$('#divTabStockMat').css('font-size', '11px');
	$('#divTabStockMat table').css('font-size', '11px');
	$('#divTabStockMat table').css('width', '100%');
	$('#divTabStockMat').css('overflow', 'auto');
}

function tablaStockMaterial(tabla){
	
	$("#divTabStockMat").append(tabla);
	confTablaStockMaterial("#tabla_stock_material");
	$('#divTabStockMat').css('height', '435px');
	$('#divTabStockMat').css('margin', 'auto 0');
	$('#divTabStockMat').css('padding-right', '6px');
	$('#divTabStockMat').css('padding-left', '6px');
	$('#divTabStockMat .row').css('margin-right', '6px');
	$('#divTabStockMat .row').css('margin-left', '6px');
	$('#divTabStockMat .row').css('margin-bottom', '-26px');
	$('#divTabStockMat .row').css('padding-bottom', '0px');
	$('#divTabStockMat .row  select').css('font-size', '11px');
	$('#divTabStockMat .row  select').css('color', '#797979');
	$('#divTabStockMat .row select').addClass('form-control');
	$('#divTabStockMat .row input[type="text"]').addClass('form-control');
	$('#divTabStockMat .row input[type="text"]').css('font-size', '11px');
	$('#divTabStockMat .row input[type="text"]').css('width', '100%');
	$('#divTabStockMat .row .dataTables_filter').css('width', '100%');
	$('#divTabStockMat .row input[type="text"]').attr("placeholder", "BUSCAR MATERIAL...");
	$('#divTabStockMat').css('font-size', '11px');
	$('#divTabStockMat table').css('font-size', '11px');
	$('#divTabStockMat table').css('width', '100%');
	$('#divTabStockMat').css('overflow', 'auto');
}

function validarVentanaMatStock(){ //validación Global
	var tablaMat = $('#tabla_stock_material').DataTable();
	var nodo = tablaMat.fnGetNodes();
	var i = 0, contVacio = 0;
	$.each(nodo, function( index, obj ) {
		i = index+1;
		if ( $('#txt_mat_'+i, nodo).val() == "" ) contVacio++;
	});
	
	if ( contVacio == i ){ 
		alerta("DEBE INTRODUCIR POR LO MENOS UNA CANTIDAD."); 
		return false; 
	}
	return true;
}