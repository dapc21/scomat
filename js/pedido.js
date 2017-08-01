function cargar_form_pedido(){
	$.ajax({
		type: "GET",
		url: "Formulario/pedido.php"
	})
	.done(function( respuesta, textStatus, jqXHR ){
	$("#principal").html(respuesta);
		activar_validar_datos();
		listar_datos("procesos/datagrid_pedido.php","datagrid");  
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		alerta("Error al cargar formulario:\n "+textStatus);
	});
}
function  gestionar_pedido(accion,clase){
	if(validarVentanaMatPed()) {
		validardatos("gestion_pedido",accion,clase);
	}
}
function  gestion_pedido(accion,clase){
	var id_ped = getD("id_ped");
	var parametros=[{
		"clase":clase,
		"accion":accion,
		"datos":{
			"id_ped":getD("id_ped"),
			"ref_ped":getD("ref_ped"),
			"id_est_ped":getD("id_est_ped"),
			"obser_ped":getD("obser_ped"),
			"pedido_material":pedido_material()
		}
	}];
	$.ajax({
		data:{"parametros":JSON.stringify(parametros)},
		type: "POST",
		dataType: "json",
		url: "controlador.php"
	})
	.done(function( respuesta, textStatus, jqXHR ){
		ventaG.close();
		if( respuesta.success ) {
			location.href="reportes/reportePedidoPDF.php?id_ped="+id_ped+"&";
			cargar_form_pedido();
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
function  buscar_id_ped(id_ped){
	var parametros=[{
		"clase":"pedido",
		"consulta":"select * from pedido where id_ped='"+id_ped+"' AND id_estatus_reg = 1"
	}]
	buscar_pedido(parametros);
}
function  buscar_pedido(parametros){
	$.ajax({
		data:{"parametros":JSON.stringify(parametros)},
		type: "GET",
		dataType: "json",
		url: "controlador_buscar.php"
	})
	.done(function( respuesta, textStatus, jqXHR ) {
		if(respuesta.success ){
			asignar_pedido(respuesta);
		}else {
			log( "Error: " + respuesta.error);
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		log( "La solicitud a fallado: " +  textStatus);
	});
}
function  asignar_pedido(respuesta){
	var objetos=respuesta.objetos;
	for (var objeto in objetos){
		var clase=objetos[objeto].clase;
		var cantidad=objetos[objeto].cantidad;
		if(cantidad==0){
			switch(clase){
				case "pedido":
					enabled("registrar");
					disabled("modificar");
					//disabled("eliminar");
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}	  
		else if(cantidad==1){
			var campo=objetos[objeto].data[0];
			switch(clase){
				case "pedido":
					setD("id_ped",campo.id_ped);
					setD("ref_ped",campo.ref_ped);
					setD("id_est_ped",campo.id_est_ped);
					setD("obser_ped",campo.obser_ped);
					buscar_mat_ped(campo.id_ped);
					disabled("registrar");
					enabled("modificar");
					//enabled("eliminar");
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}
		else{
			alerta("Aviso, La busqueda retorno "+cantidad+" registros");
		}
   }
}
/**********************************************
	FUNCIÓN OBJETO PARA PEDIDO_MATERIAL
**********************************************/
function pedido_material(){
	var invPed = new Array();
	var tabla = $('#tabla_pedido_material').DataTable(); //Obtenemos la tabla
	var nodo = tabla.fnGetNodes();
	//index recorre toda la tabla.
	//i lleva el control de los ids ej. para i=5, $('#txt_mat_5', nodo).val();
	//j lleva el control del array invPed si cumple la condición incrementa.
	var i = 0, j = 0; 
	$.each(nodo, function( index, obj ) {
		i = index+1;
		if ( $('#txt_mat_'+i, nodo).val() != "" ) {
			var obj = new Object();
			obj.id_stock  = $("#id_stock"+i, nodo).text(); //viene de la tabla
			obj.id_ped    = getD("id_ped");
			obj.cant_ped_mat = $('#txt_mat_'+i, nodo).val(); //viene de la tabla
			obj.cant_comp_mat = $('#txt_mat_comp_'+i, nodo).val(); //viene de la tabla
			obj.id_alm  = $("#id_alm"+i, nodo).text();
			obj.almacen  = $("#almacen"+i, nodo).text();
			obj.unidad   = $("#uni_abrev"+i, nodo).text();
			obj.material = $("#material"+i, nodo).text();
			invPed[j] = obj;
			j++;
		}
    });
	return invPed;
}

/**********************************************
	MATERIAL(ES) EN STOCK (CARGA TABLA)
**********************************************/
var tipoPed = 0;
function  buscar_mat_stock_gen(){
	var parametros=[{
		"clase":"stock_material",
		"consulta":"SELECT * FROM vista_stock_material WHERE id_estatus_reg = 1 AND status_alm = 'ACTIVO'"
	}]
	buscar_mate_stock_ped(parametros);
}
function  buscar_mat_stock_min(){
	var parametros=[{
		"clase":"stock_material",
		"consulta":"SELECT * FROM vista_stock_material WHERE stock_min >= stock AND id_estatus_reg = 1 AND status_alm = 'ACTIVO'"
	}]
	buscar_mate_stock_ped(parametros);
}
function  buscar_mate_stock_ped(parametros){
	$.ajax({
		data:{"parametros":JSON.stringify(parametros)},
		type: "GET",
		dataType: "json",
		beforeSend: function() {
			$("#divTabPedMat").html('<div style="text-align: center; color: #344151;"><br>Cargando...<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>');
		},
		url: "controlador_buscar.php"
	})
	.done(function( respuesta, textStatus, jqXHR ) {
		if(respuesta.success ){
			asignar_mate_stock_ped(respuesta);
		}else {
			log( "Error: " + respuesta.error);
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		log( "La solicitud a fallado: " +  textStatus);
	});
}
function  asignar_mate_stock_ped(respuesta){
	var objetos=respuesta.objetos;
	for (var objeto in objetos){
		var clase=objetos[objeto].clase;
		var cantidad=objetos[objeto].cantidad;
		var output='';
		tipoPed = 0;
		if(cantidad==0){
			switch(clase){
				case "stock_material":
					$("#divTabPedMat").html('');
					output += '<table id="tabla_pedido_material" class="table table-striped table-advance table-hover">';
					output += '<thead>';
					output += '<tr>';
					output += '<th>N°</th>';
					output += '<th class="hidden">ID MATERIAL</th>';
					output += '<th class="hidden">ID STOCK</th>';
					output += '<th class="hidden">ID ALMACEN</th>';
					output += '<th class="hidden-phone">MATERIAL(ES)</th>';
					output += '<th>CANTIDAD DISPONIBLE</th>';
					output += '<th>CANTIDAD SOLICITADA</th>';
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
					tablaPedidoNoData(output);
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}
		else{
			switch(clase){
				case "stock_material":
				
						$("#divTabPedMat").html('');
						output += '<table id="tabla_pedido_material" class="table table-striped table-advance table-hover">';
						output += '<thead>';
						output += '<tr>';
						output += '<th>N°</th>';
						output += '<th class="hidden">ID MATERIAL</th>';
						output += '<th class="hidden">ID STOCK</th>';
						output += '<th class="hidden">ID ALMACEN</th>';
						output += '<th class="hidden-phone">MATERIAL(ES)</th>';
						output += '<th>CANTIDAD DISPONIBLE</th>';
						output += '<th>CANTIDAD SOLICITADA</th>';
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
						output += '<td id="stock_min'+conteo+'"><strong style="color:#a94442;">' + campo.stock_min + '</strong> <strong>' + campo.abrev_uni_sal + '</strong></td>';
						output += '<td id="almacen'+conteo+'" class="hidden-phone">' + campo.nombre_alm + '</td>';
						output += '</tr>';
						
					}
						output += '</tbody>';
						output += '</table>';
						tablaPedido(output);
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}
	}
}

function tablaPedido(tabla){
	
	$("#divTabPedMat").append(tabla);
	confTablaPedido("#tabla_pedido_material");
	$('#divTabPedMat').css('height', '435px');
	$('#divTabPedMat').css('margin', 'auto 0');
	$('#divTabPedMat').css('padding-right', '6px');
	$('#divTabPedMat').css('padding-left', '6px');
	$('#divTabPedMat .row').css('margin-right', '6px');
	$('#divTabPedMat .row').css('margin-left', '6px');
	$('#divTabPedMat .row').css('margin-bottom', '-26px');
	$('#divTabPedMat .row').css('padding-bottom', '0px');
	$('#divTabPedMat .row  select').css('font-size', '11px');
	$('#divTabPedMat .row  select').css('color', '#797979');
	$('#divTabPedMat .row select').addClass('form-control');
	$('#divTabPedMat .row input[type="text"]').addClass('form-control');
	$('#divTabPedMat .row input[type="text"]').css('font-size', '11px');
	$('#divTabPedMat .row input[type="text"]').css('width', '100%');
	$('#divTabPedMat .row .dataTables_filter').css('width', '100%');
	$('#divTabPedMat .row input[type="text"]').attr("placeholder", "BUSCAR MATERIAL...");
	$('#divTabPedMat').css('font-size', '11px');
	$('#divTabPedMat table').css('font-size', '11px');
	$('#divTabPedMat table').css('width', '100%');
	$('#divTabPedMat').css('overflow', 'auto');
}

function confTablaPedido(nombreTabla){
	
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

function tablaPedidoNoData(tabla){
	$("#divTabPedMat").append(tabla);
	$('#divTabPedMat').css('height', '435px');
	$('#divTabPedMat').css('margin', 'auto 0');
	$('#divTabPedMat').css('padding-right', '6px');
	$('#divTabPedMat').css('padding-left', '6px');
	$('#divTabPedMat').css('font-size', '11px');
	$('#divTabPedMat table').css('font-size', '11px');
	$('#divTabPedMat table').css('width', '100%');
	$('#divTabPedMat').css('overflow', 'auto');
}

function mostrarDetallePedido(idPed, refPed){
	ventaG =  BootstrapDialog.show({
		message: $('<div id="datagridPedMat"></div>').load('procesos/datagrid_pedido_material.php?idPed='+idPed),
		title: 'DETALLE(S) DEL PEDIDO CON REFERENCIA '+refPed,
		closable: false,
		buttons: [{
			id: 'btn-3',
			label: 'CERRAR',
			icon: 'glyphicon glyphicon-remove',
			action: function(dialog) {
				dialog.close();
				return false;
			}
		}]
    });
	ventaG.getModalDialog().css('width', '80%');
	ventaG.getModalHeader().css('background-color', '#344151');
	ventaG.getModalHeader().css('border-bottom', 'solid 1px #fff');
	ventaG.getModalBody().css('margin', '0px');
	ventaG.getModalBody().css('padding', '0px');
	ventaG.getButton('btn-3').css('background-color', '#344151');
	ventaG.getButton('btn-3').css('border-color', '#344151');
	
}

/**********************************************
	MATERIAL(ES) SOLICITADOS (CARGA TABLA)
**********************************************/
function  buscar_mat_ped(id_ped){
	var parametros=[{
		"clase":"pedido_material",
		"consulta":"SELECT * FROM vista_pedido_material WHERE id_ped = '"+id_ped+"' AND id_estatus_reg = 1"
	}]
	buscar_mate_stock_ped_bus(parametros);
}
function  buscar_mate_stock_ped_bus(parametros){
	$.ajax({
		data:{"parametros":JSON.stringify(parametros)},
		type: "GET",
		dataType: "json",
		beforeSend: function() {
			$("#divTabPedMat").html('<div style="text-align: center; color: #344151;"><br>Cargando...<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>');
		},
		url: "controlador_buscar.php"
	})
	.done(function( respuesta, textStatus, jqXHR ) {
		if(respuesta.success ){
			asignar_mate_stock_ped_bus(respuesta);
		}else {
			log( "Error: " + respuesta.error);
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		log( "La solicitud a fallado: " +  textStatus);
	});
}
function  asignar_mate_stock_ped_bus(respuesta){
	var objetos=respuesta.objetos;
	for (var objeto in objetos){
		var clase=objetos[objeto].clase;
		var cantidad=objetos[objeto].cantidad;
		var output='';
		tipoPed = 1;
		if(cantidad==0){
			switch(clase){
				case "pedido_material":
					$("#divTabPedMat").html('');
					output += '<table id="tabla_pedido_material" class="table table-striped table-advance table-hover">';
					output += '<thead>';
					output += '<tr>';
					output += '<th>N°</th>';
					output += '<th class="hidden">ID MATERIAL</th>';
					output += '<th class="hidden">ID STOCK</th>';
					output += '<th class="hidden">ID ALMACEN</th>';
					output += '<th class="hidden-phone">MATERIAL(ES)</th>';
					output += '<th>CANTIDAD DISPONIBLE</th>';
					output += '<th>CANTIDAD SOLICITADA</th>';
					output += '<th>CANTIDAD COMPRADA</th>';
					output += '<th>STOCK MÍNIMO</th>';
					output += '<th>ALMACÉN</th>';
					output += '</tr>';
					output += '</thead>';
					output += '<tbody>';
					output += '<tr class="odd">';
					output += '<td class="dataTables_empty" valign="top" colspan="10">No se encontraron resultados</td>';
					output += '</tr>';
					output += '</tbody>';
					output += '</table>';
					tablaPedidoNoData(output);
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}
		else{
			switch(clase){
				case "pedido_material":
				
						$("#divTabPedMat").html('');
						output += '<table id="tabla_pedido_material" class="table table-striped table-advance table-hover">';
						output += '<thead>';
						output += '<tr>';
						output += '<th>N°</th>';
						output += '<th class="hidden">ID MATERIAL</th>';
						output += '<th class="hidden">ID STOCK</th>';
						output += '<th class="hidden">ID ALMACEN</th>';
						output += '<th class="hidden-phone">MATERIAL(ES)</th>';
						output += '<th>CANTIDAD DISPONIBLE</th>';
						output += '<th>CANTIDAD SOLICITADA</th>';
						output += '<th class="hidden-phone">CANTIDAD COMPRADA</th>';
						output += '<th>STOCK MÍNIMO</th>';
						output += '<th>ALMACÉN</th>';
						output += '</tr>';
						output += '</thead>';
						output += '<tbody>';
						
					for (var datos in objetos[objeto].data){
						var conteo = parseInt(datos);
						conteo = conteo+1;
						var campo = objetos[objeto].data[datos];
						var unidad="", disp="", cant_ped_mat = campo.cant_ped_mat;
						
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
						output += '<td id="stock'+conteo+'">' + disp + ' <strong>' + campo.abrev_uni_sal + '</strong></td>';
						output += '<td id="solicitado'+conteo+'"><strong>' + cant_ped_mat + '</strong> <strong id="uni_abrev'+conteo+'">' + campo.abrev_uni_sal + '</strong></td>';
						output += '<td id="cantidad'+conteo+'" class="hidden-phone"><input class="form-control" type="text" name="txt_mat_comp_'+conteo+'" id="txt_mat_comp_'+conteo+'" maxlength="20" size="12" value="'+cant_ped_mat+'" onKeyPress="return SoloNumeroDecimal(event,this);" onblur="formatDec(this.id,this.value);" /> <strong>'+unidad+'</strong><div id="advErrorVent'+conteo+'" class="advErrorVent"><strong>Introduzca una cantidad</strong></div></td>';
						output += '<td id="stock_min'+conteo+'"><strong style="color:#a94442;">' + campo.stock_min + '</strong> <strong>' + campo.abrev_uni_sal + '</strong></td>';
						output += '<td id="almacen'+conteo+'" class="hidden-phone">' + campo.nombre_alm + '</td>';
						output += '</tr>';
						
					}
						output += '</tbody>';
						output += '</table>';
						tablaPedido(output);
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}
	}
}

function validarVentanaMatPed(){ //validación Global
	var tablaMat = $('#tabla_pedido_material').DataTable();
	var nodo = tablaMat.fnGetNodes();
	var error = 0, i = 0, contVacio = 0;
	$.each(nodo, function( index, obj ) {
		i = index+1;
		
		if ( tipoPed == 0 ) {
			if ( $('#txt_mat_'+i, nodo).val() == "" ) contVacio++;
		}
		if ( tipoPed == 1 ) {
			if ( $('#txt_mat_comp_'+i, nodo).val() != "" ) {
				$('#advErrorVent'+i, nodo).hide();
				$('#txt_mat_comp_'+i, nodo).closest('td').removeClass('has-error').addClass('has-success');
			}
			else{
				$('#advErrorVent'+i, nodo).show();
				$('#txt_mat_comp_'+i, nodo).closest('td').addClass('has-error');
				error = 1;
			}
		}
	});//alerta("DEBE HABER CARGA DE MATERIALES PARA REALIZAR PEDIDOS.");
	
	if ( contVacio == i ){ 
		alerta("DEBE HABER CARGA DE MATERIALES PARA REALIZAR PEDIDOS."); 
		return false; 
	}
	if ( nodo.length == i && error == 1 ){
		alerta("NO PUEDE DEJAR NINGÚN CAMPO 'CANTIDAD COMPRADA' EN BLANCO."); 
		return false;
	}
	return true;
}