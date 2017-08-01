function cargar_form_inventario(){
	$.ajax({
		type: "GET",
		url: "Formulario/inventario.php"
	})
	.done(function( respuesta, textStatus, jqXHR ){
		$("#principal").html(respuesta);
		activar_validar_datos();
		listar_datos("procesos/datagrid_inventario.php","datagrid");  
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		alerta("Error al cargar formulario:\n "+textStatus);
	});
}
function gestionar_inventario(accion,clase){
	if($('table#tabla_inventario_material tbody tr').length > 0) {
		validardatos("gestion_inventario",accion,clase);
	}
	else{
		alerta("DEBE CARGAR MATERIALES.");
	}
}
function gestion_inventario(accion,clase){
	var id_inv = getD("id_inv");
	var parametros=[{
		"clase":clase,
		"accion":accion,
		"datos":{
			"id_inv":getD("id_inv"),
			"id_mot_inv":getD("id_mot_inv"),
			"id_est_inv":getD("id_est_inv"),
			"id_alm":getD("id_alm"),
			"obser_inv":getD("obser_inv"),
			"ref_inv":getD("ref_inv"),
			"inventario_material":inventario_material()
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
			location.href="reportes/reporteInventarioPDF.php?id_inv="+id_inv+"&";
			cargar_form_inventario();
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
function  buscar_id_inv(id_inv){
	var parametros=[{
		"clase":"inventario",
		"consulta":"select * from vista_inventario where id_inv='"+id_inv+"' AND id_estatus_reg = 1"
	}]
	buscar_inventario(parametros);
}
function  buscar_inventario(parametros){
	$.ajax({
		data:{"parametros":JSON.stringify(parametros)},
		type: "GET",
		dataType: "json",
		url: "controlador_buscar.php"
	})
	.done(function( respuesta, textStatus, jqXHR ) {
		if(respuesta.success ){
			asignar_inventario(respuesta);
		}else {
			log( "Error: " + respuesta.error);
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		log( "La solicitud a fallado: " +  textStatus);
	});
}
function  asignar_inventario(respuesta){
var objetos=respuesta.objetos;
	for (var objeto in objetos){
		var clase=objetos[objeto].clase;
		var cantidad=objetos[objeto].cantidad;
		if(cantidad==0){
			switch(clase){
				case "inventario":
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
				case "inventario":
					setD("id_inv",campo.id_inv);
					setD("id_mot_inv",campo.id_mot_inv);
					setD("id_est_inv",campo.id_est_inv);
					setD("id_alm",campo.id_alm);
					setD("nombre_est_inv",campo.nombre_est_inv);
					setD("obser_inv",campo.obser_inv);
					setD("ref_inv",campo.ref_inv);
					buscar_mat_stock(campo.id_alm);
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
	FUNCIÓN OBJETO PARA INVENTARIO_MATERIAL
**********************************************/
var idStockMat = new Array(), stockMat = new Array();
function inventario_material(){
	var invMat = new Array();
	var tabla = "table#tabla_inventario_material tbody tr";
	var fila = tabla+"#fila";
	var cantidad = $(tabla).length;
	var conteo = 0;
    for (i = 0; i < cantidad; i++) {
		conteo = i+1;
		var obj = new Object();
		obj.id_stock  = $(fila+conteo+" td#id_stock").text(); //viene de la tabla
		obj.id_inv    = getD("id_inv");
		obj.cant_sist = $(fila+conteo+" td#stock").text(); //viene de la tabla
		obj.cant_real = $(fila+conteo+" td#stock").text(); //viene de la tabla
		invMat[i] = obj;
    }
	return invMat;
}

/**********************************************
	MATERIAL(ES) EN STOCK (CARGA SELECT)
**********************************************/

function  buscar_mat_stock(id_alm){
	var parametros=[{
		"clase":"stock_material",
		"consulta":"SELECT * FROM vista_stock_material WHERE id_alm='"+id_alm+"' AND id_estatus_reg = 1 AND status_alm = 'ACTIVO'"
	}]
	buscar_mate_stock(parametros);
}
function  buscar_mate_stock(parametros){
	$.ajax({
		data:{"parametros":JSON.stringify(parametros)},
		type: "GET",
		dataType: "json",
		beforeSend: function() {
			$("#tabla_inventario_material tbody").html("Cargando...");
		},
		url: "controlador_buscar.php"
	})
	.done(function( respuesta, textStatus, jqXHR ) {
		if(respuesta.success ){
			asignar_mate_stock(respuesta);
		}else {
			log( "Error: " + respuesta.error);
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		log( "La solicitud a fallado: " +  textStatus);
	});
}
function  asignar_mate_stock(respuesta){
	var objetos=respuesta.objetos;
	for (var objeto in objetos){
		var clase=objetos[objeto].clase;
		var cantidad=objetos[objeto].cantidad;
		var output='';
		if(cantidad==0){
			switch(clase){
				case "stock_material":
					output += '<tr>';
					output += '<td><b>No se encontraron resultados.</b></td>';
					output += '<td></td>';
					output += '<td></td>';
					output += '<td></td>';
					output += '<td></td>';
					output += '</tr>';
					$("#tabla_inventario_material tbody").html(output);
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}	 	  
		else if(cantidad==1){
			switch(clase){
				case "stock_material":
					var campo = objetos[objeto].data[0];
					var unidad="", disp="";
					
					if(campo.nombre_uni_sal == "UNIDAD") unidad = campo.nombre_uni_sal+"(ES)";
					else unidad = campo.nombre_uni_sal+"(S)";
					if(campo.stock == "") disp = "<strong style='color:#a94442;' id=disp" + 1 + ">0.00</strong>";
					else disp = "<strong style='color:#3c763d;' id=disp" + 1 + ">" + campo.stock + "</strong>";
					
					$("#tabla_inventario_material tbody").html('');
					output += '<tr id="fila1">';
					output += '<td id="num">'+1+'</td>';
					output += '<td id="id_mat" class="hidden">' + campo.id_mat + '</td>';
					output += '<td id="id_stock" class="hidden">' + campo.id_stock + '</td>';
					output += '<td id="material" class="hidden-phone">' + campo.nombre_mat + '</td>';
					output += '<td id="stock">' + disp + '</td>';
					output += '<td id="stock_minimo">' + campo.stock_min + '</strong></td>';
					output += '<td id="unidad">' + unidad + '</td>';
					output += '</tr>';
					$("#tabla_inventario_material").append(output);
					
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}
		else{
			switch(clase){
				case "stock_material":
					
					for (var datos in objetos[objeto].data){
						var conteo = parseInt(datos);
						conteo = conteo+1;
						var campo = objetos[objeto].data[datos];
						var unidad="", disp="";
						
						if(campo.nombre_uni_sal == "UNIDAD") unidad = campo.nombre_uni_sal+"(ES)";
						else unidad = campo.nombre_uni_sal+"(S)";
						if(campo.stock == "") disp = "<strong style='color:#a94442;' id=disp" + conteo + ">0.00</strong>";
						else disp = "<strong style='color:#3c763d;' id=disp" + conteo + ">" + campo.stock + "</strong>";
						
						$("#tabla_inventario_material tbody").html('');
						output += '<tr id="fila'+conteo+'">';
						output += '<td id="num">' +conteo+ '</td>';
						output += '<td id="id_mat" class="hidden">' + campo.id_mat + '</td>';
						output += '<td id="id_stock" class="hidden">' + campo.id_stock + '</td>';
						output += '<td id="material" class="hidden-phone">' + campo.nombre_mat + '</td>';
						output += '<td id="stock">' + disp + '</td>';
						output += '<td id="stock_minimo">' + campo.stock_min + '</strong></td>';
						output += '<td id="unidad">' + unidad + '</td>';
						output += '</tr>';
						$("#tabla_inventario_material").append(output);
					}
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
			//alerta("Aviso, La busqueda retorno "+cantidad+" registros");
		}
	}
}

function mostrarDetalleInventario(idInv, refInv){
	ventaG =  BootstrapDialog.show({
		message: $('<div id="datagridInvMat"></div>').load('procesos/datagrid_inventario_material.php?idInv='+idInv),
		title: 'DETALLE(S) DEL INVENTARIO CON REFERENCIA '+refInv,
		closable: false,
		buttons: [{
			id: 'btn-2',
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
	ventaG.getButton('btn-2').css('background-color', '#344151');
	ventaG.getButton('btn-2').css('border-color', '#344151');
	
}