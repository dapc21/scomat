function  cargar_form_movimiento(){
   $.ajax({
    type: "GET",
    url: "Formulario/movimiento.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_movimiento.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_movimiento(accion,clase){
	if($('table#tabla_movimiento_material tbody tr').length > 0) {
		validardatos("gestion_movimiento",accion,clase);
	}
	else{
		alerta("DEBE CARGAR MATERIALES.");
	}
}
function  gestion_movimiento(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_mov":getD("id_mov"),
				  "ref_mov":getD("ref_mov"),
                  "id_res":getD("id_res"),
                  "id_tipo_mov":getD("id_tipo_mov"),
                  "id_alm":getD("id_alm"),
                  "mot_mov":$("#id_mot_mov option:selected").text(),
                  "movimiento_material":movimientoM()
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
               cargar_form_movimiento();
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
function  buscar_id_mov(id_mov){
   var parametros=[{
            "clase":"movimiento",
            "consulta":"select * from movimiento where id_mov='"+id_mov+"'"
         }]
   buscar_movimiento(parametros);
}
function  buscar_movimiento(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_movimiento(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_movimiento(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "movimiento":
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
            case "movimiento":
               setD("id_mov",campo.id_mov);
               setD("id_res",campo.id_res);
               setD("id_tipo_mov",campo.id_tipo_mov);
               setD("id_alm",campo.id_alm);
               setD("ref_mov",campo.ref_mov);
               setD("mot_mov",campo.mot_mov);
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
	FUNCIÓN OBJETO PARA MOVIMIENTO_MATERIAL
**********************************************/
function movimientoM(){
	var movMat = new Array();
	var stockMat = new Array();
	var stockMatD = new Array();
	var destino = getD("id_alm2"); //--FORMULARIO--
	var tabla = "table#tabla_movimiento_material tbody tr";
	var fila = tabla+"#row";
	var cantidad = $(tabla).length;
	var conteo = 0;
	stockMat = stockM();
	stockMatD = stockMdestino();
	
    for (var i = 0; i < cantidad; i++) {
		conteo = i+1;
		var obj = new Object();
		obj.id_stock  = $(fila+conteo+" td#id_stock"+conteo).text(); //vendrá de la tabla
		obj.id_mov    = getD("id_mov"); //--FORMULARIO--
		obj.cant_mov_mat = $(fila+conteo+" td#cantidad").text(); //vendrá de la tabla
		obj.cant_stock_disp = $(fila+conteo+" td#stock").text(); //vendrá de la tabla
		obj.stock_material = stockMat[i];
		if (destino != ""){
		obj.stock_material_destino = stockMatD[i];
		obj.id_stock2 = $(fila+conteo+" td#id_st"+conteo).text(); //viene de la tabla
		obj.id_alm2  = getD("id_alm2"); //--FORMULARIO--
		obj.id_mat2  = $(fila+conteo+" td#id_mat").text(); //viene de la tabla
		}
		movMat[i] = obj;
	}
	return movMat;
}

/**********************************************
	FUNCIÓN OBJETO PARA STOCK_MATERIAL
**********************************************/
function stockM(){
	var stMat = new Array();
	var tabla = "table#tabla_movimiento_material tbody tr";
	var fila = tabla+"#row";
	var cantidad = $(tabla).length;
	var conteo = 0;
    for (var i = 0; i < cantidad; i++) {
		conteo = i+1;
		var obj = new Object();
		obj.id_stock  = $(fila+conteo+" td#id_stock"+conteo).text(); //viene de la tabla
		obj.id_alm  = getD("id_alm"); //--FORMULARIO--
		obj.id_mat  = $(fila+conteo+" td#id_mat").text(); //viene de la tabla
		obj.stock  = $(fila+conteo+" td#stock").text(); //viene de la tabla
		obj.stock_min  = $(fila+conteo+" td#stock_min").text(); //viene de la tabla
		stMat[i] = obj;
	}
	return stMat;
}

function stockMdestino(){
	var stMatD = new Array();
	var tabla = "table#tabla_movimiento_material tbody tr";
	var fila = tabla+"#row";
	var cantidad = $(tabla).length;
	var conteo = 0;
    for (var i = 0; i < cantidad; i++) {
		conteo = i+1;
		var obj = new Object();
		obj.id_stock  = $(fila+conteo+" td#id_st"+conteo).text(); //viene de la tabla
		obj.id_alm  = getD("id_alm2"); //--FORMULARIO--
		obj.id_mat  = $(fila+conteo+" td#id_mat").text(); //viene de la tabla
		obj.stock  = $(fila+conteo+" td#cantidad").text(); //viene de la tabla
		obj.stock_min  = $(fila+conteo+" td#stock_min").text(); //viene de la tabla
		stMatD[i] = obj;
	}
	return stMatD;
}


/**********************************************
	BÚSQUEDA DEL ID STOCK DEL ALM PARA TRANSF.
***********************************************/

function  buscar_id_stock_almacen2(id_stock){
	var parametros=[{
		"clase":"stock_material",
		"consulta":"select * from vista_stock_material where id_alm='"+getD("id_alm2")+"' and id_mat='"+getD("id_mat")+"' and id_estatus_reg = 1"
	}]
	buscar_stock_almacen2(parametros);
}
function  buscar_stock_almacen2(parametros){
	$.ajax({
		data:{"parametros":JSON.stringify(parametros)},
		type: "GET",
		dataType: "json",
		url: "controlador_buscar.php",
	})
	.done(function( respuesta, textStatus, jqXHR ) {
		if(respuesta.success ){
			asignar_stock_almacen2(respuesta);
		}else {
			log( "Error: " + respuesta.error);
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		log( "La solicitud a fallado: " +  textStatus);
	});
}
function  asignar_stock_almacen2(respuesta){
	var objetos=respuesta.objetos;
	for (var objeto in objetos){
		var clase=objetos[objeto].clase;
		var cantidad=objetos[objeto].cantidad;
		if(cantidad==0){
			switch(clase){
			case "stock_material":
			break;
			default:
            log( "no existe la clase: "+clase+" para asignar parametros");
			}
		} 	  
		else if(cantidad==1){ /** si habia existencia en stock, entonces muestro los datos **/
			var campo=objetos[objeto].data[0];
			switch(clase){
				case "stock_material":
				setD("id_stock2",campo.id_stock);
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}
		else{
				switch(clase){
				case "stock_material":
				setD("id_stock2",campo.id_stock);
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
				}
		}
	}
}

/**********************************************
	UNIDADES DE MEDIDAS
**********************************************/

function buscar_uni_mat(){
	var parametros=[{
		"clase":"material",
		"consulta":"select * from vista_material where id_mat='"+getD("id_mat")+"' and id_estatus_reg = 1"
	}]
	buscar_uni_material(parametros);
}
function buscar_uni_material(parametros){
	$.ajax({
		data:{"parametros":JSON.stringify(parametros)},
		type: "GET",
		dataType: "json",
		url: "controlador_buscar.php",
	})
	.done(function( respuesta, textStatus, jqXHR ) {
		if(respuesta.success ){
			asignar_uni_material(respuesta);
		}else {
			log( "Error: " + respuesta.error);
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		log( "La solicitud a fallado: " +  textStatus);
	});
}
function  asignar_uni_material(respuesta){
	var objetos=respuesta.objetos;
	for (var objeto in objetos){
		var clase=objetos[objeto].clase;
		var cantidad=objetos[objeto].cantidad;
		//$("#cant_reg").val(cantidad);
		if(cantidad==0){
			switch(clase){
				case "material":
					alerta("Aviso, Ocurrió un problema al cargar las unidades de medida.");
					$("#registrar").show();
					$("#modificar").hide();
					enabled("registrar");
					disabled("modificar");
				break;
				default:
				log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}	 	  
		else if(cantidad==1){
			var campo=objetos[objeto].data[0];
			switch(clase){
				case "material":
					$("#registrar").show();
					$("#modificar").hide();
					enabled("registrar");
					disabled("modificar");
					$('#id_mot_mov > option[value="558CDE146A0AE5962382"]').attr('selected', 'selected');
					$("#id_tipo_mov").attr('disabled','disabled');
					$("#id_mot_mov").attr('disabled','disabled');
				
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
	MOTIVO DE MOVIMIENTO (CARGA SELECT)
**********************************************/

function  buscar_motivo_movi(id_tipo_mov){
	var parametros=[{
		"clase":"motivo_movimiento",
		"consulta":"SELECT * FROM vista_motivo_movimiento WHERE id_tipo_mov='"+id_tipo_mov+"' AND id_estatus_reg = 1 AND status_mot_mov <> 'INACTIVO' AND status_mot_mov <> 'SISTEMA'"
	}]
	buscar_motivo_movim(parametros);
}
function  buscar_motivo_movim(parametros){
	$.ajax({
		data:{"parametros":JSON.stringify(parametros)},
		type: "GET",
		dataType: "json",
		beforeSend: function() {
			$("#id_mot_mov option:selected").html("<option>Cargando...</option>");
		},
		url: "controlador_buscar.php"
	})
	.done(function( respuesta, textStatus, jqXHR ) {
		if(respuesta.success ){
			asignar_motivo_movi(respuesta);
		}else {
			log( "Error: " + respuesta.error);
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		log( "La solicitud a fallado: " +  textStatus);
	});
}
function  asignar_motivo_movi(respuesta){
	var objetos=respuesta.objetos;
	var tipoMov = $("#id_tipo_mov option:selected").text(); 
	var valMov = $("#id_tipo_mov option:selected").val(); 
	
	for (var objeto in objetos){
		var clase=objetos[objeto].clase;
		var cantidad=objetos[objeto].cantidad;
		if(cantidad==0){
			switch(clase){
				case "motivo_movimiento":
					var comboMotivoMov = $("#id_mot_mov");
					comboMotivoMov.empty();
					comboMotivoMov.append("<option value=''>Seleccione...</option>");
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}	 	  
		else if(cantidad==1){
			switch(clase){
				case "motivo_movimiento":
					var comboMotivoMov = $("#id_mot_mov");
					comboMotivoMov.empty();
					comboMotivoMov.append("<option value=''>Seleccione...</option>");
					var campo=objetos[objeto].data[0];
					comboMotivoMov.append("<option value="+campo.id_mot_mov+">" + campo.nombre_mot_mov + "</option>");
					console.log(campo.id_mot_mov+" " + campo.nombre_mot_mov);
					
					if(tipoMov == "TRANSFERENCIA" || valMov=="558CDD95D59A28310560"){
						$('#id_mot_mov > option[value="558CE1B0685168501001"]').attr('selected', 'selected');
						$("#id_mot_mov").attr('disabled','disabled');
					}
					
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}
		else{
			switch(clase){
				case "motivo_movimiento":
					var comboMotivoMov = $("#id_mot_mov");
					comboMotivoMov.empty();
					comboMotivoMov.append("<option value=''>Seleccione...</option>");
					for (var datos in objetos[objeto].data){
						var campo = objetos[objeto].data[datos];
						comboMotivoMov.append("<option value="+campo.id_mot_mov+">" + campo.nombre_mot_mov + "</option>");
						console.log(campo.id_mot_mov+" " + campo.nombre_mot_mov);
					}
					
					if(tipoMov == "TRANSFERENCIA" || valMov=="558CDD95D59A28310560"){
						$('#id_mot_mov > option[value="558CE1B0685168501001"]').attr('selected', 'selected');
						$("#id_mot_mov").attr('disabled','disabled');
					}
					
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
			//alerta("Aviso, La busqueda retorno "+cantidad+" registros");
		}
	}
}

function mostrarDetalleMovimiento(idMov, refMov){
	ventaG =  BootstrapDialog.show({
		message: $('<div id="datagridMovMat"></div>').load('procesos/datagrid_movimiento_material.php?idMov='+idMov),
		title: 'DETALLE(S) DEL MOVIMIENTO CON REFERENCIA '+refMov,
		closable: false,
		buttons: [{
			id: 'btn-1',
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
	ventaG.getButton('btn-1').css('background-color', '#344151');
	ventaG.getButton('btn-1').css('border-color', '#344151');
}

/**********************************************
	VENTANA PARA MOSTRAR LOS MATERIALES
**********************************************/
var colIdMat = [], colIdStock = [], colMaterial = [], colStock = [], colCantidad = [], colStockMin = [], sw = false;
function mostrarTablaMaterial(tabla){
	ventaG =  BootstrapDialog.show({
		message: $('<div style="text-align: center; color: #344151;"><br>Por favor espere<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>'),
		title: 'MATERIAL(ES) DISPONIBLE(S)',
		closable: false,
		animate: false,
		onshow: function(dialog) {
			//botones deshabilitados al inicio para evitar errores
			dialog.getButton('btnMatVentAdd').disable();
			dialog.getButton('btnMatVentClose').disable();
		},
		buttons: [{
			id: 'btnMatVentAdd',
			label: 'AGREGAR',
			icon: 'glyphicon glyphicon-ok',
			action: function(dialog) {
				var tipoMov = $("#id_tipo_mov option:selected").text();
				var tablaMat = $('#tabla_material').DataTable(); //Obtenemos la tabla
				var nodo = tablaMat.fnGetNodes(); //Obtenemos los nodos de la tabla, independientemente de que sean visibles o no (por el paginado)
				var aData = [], chekMarcado = false, verif = false, errMonto = false, tablaMovMat = '', filaErrMonto = '';
				var checkados = $('input:checked', nodo).length;
				var i = 0, j = 1, z = 1;
				
				if(sw == true){ //retomo el conteo si ya había agregado materiales
					j = $('#tabla_movimiento_material tbody tr').length;
					j = j+1;
				}
				if(checkados > 0){ //si al menos hay una selección (igual está validado con el botón agregar)
					if( validarVentanaMat() ){
						$.each(nodo, function( index, obj ) {
							i = index+1;
							chekMarcado = $("#checkmat"+i, nodo).prop("checked");
							
							if ( chekMarcado ){
								
								if ( $('#txt_mat_'+i, nodo).val() != "" ) {
									$('#advErrorVent'+i, nodo).hide();
									$('#txt_mat_'+i, nodo).closest('td').removeClass('has-error').addClass('has-success');
									aData = tablaMat.fnGetData(nodo[index]);
									colIdMat = aData[1]; //IDS MATERIALES
									colIdStock = aData[2]; //IDS STOCK
									colMaterial = aData[4]; //MATERIALES
									colUnidad = aData[8]; //UNIDADES
									if(aData[2] == "") colStock = $('#txt_mat_'+i, nodo).val(); //STOCK
									else colStock = $('#disp'+i, nodo).text(); //STOCK
									colCantidad = $('#txt_mat_'+i, nodo).val(); //CANTIDADES
									colStockMin = $('#txt_stockmin_'+i, nodo).val(); //STOCK MÍNIMO
									
									var monInt = $('#txt_mat_'+i, nodo).val() , dispo = $('#disp'+i, nodo).text();
									var montoInt = parseFloat(monInt) , disponibilidad = parseFloat(dispo);
									
									if (  ( montoInt > disponibilidad ) && (tipoMov != "ENTRADA") ) { //fue salida o transferencia y el monto introducido fue mayor a lo disponible
										filaErrMonto += '<tr>';
										filaErrMonto += '<td>' + z + '</td>';
										filaErrMonto += '<td>' + aData[4] + '</td>';
										filaErrMonto += '<td><strong style="color:#3c763d;">' + $('#disp'+i, nodo).text() + '</strong></td>';
										filaErrMonto += '<td><strong style="color:#a94442;">' + $('#txt_mat_'+i, nodo).val() + '</strong></td>';
										filaErrMonto += '<td>' + aData[8] + '</td>';
										filaErrMonto += '<td><strong style="color:#a94442;">El monto excede la cantidad disponible.</strong></td>';
										filaErrMonto += '</tr>';
										z++;
										errMonto = true;
									}
									else{ //fue entrada o el monto introducido fue menor a lo disponible
									
										//VERIFICAMOS EN LA TABLA DEL FORMULARIO SI EXISTEN REGISTROS
										if( $('#tabla_movimiento_material tbody tr').length > 0){ //si existe al menos un registro en la tabla principal (abajo formulario)
											$('#tabla_movimiento_material tr').each(function () { //hago un recorrido por esa tabla
										
												//si el id material de esta tabla(ventana) coincide con el id material en la otra tabla (en formulario)
												//entonces sumale este monto introducido al monto existente en la tabla del formulario
												if( $(this).find("td").eq(1).text() == aData[1] ){
													var cantExist = $(this).find("td").eq(5).text();
													var suma = parseFloat(cantExist) + parseFloat(colCantidad);
													$(this).find("td").eq(5).text(parseFloat(suma).toFixed(2)); //asigno en el campo cantidad la suma del monto anterior mas el nuevo
													if(aData[2] == "") $(this).find("td").eq(3).text(parseFloat(suma).toFixed(2));
													verif = true; //cambio el valor de verif para no crear otra fila
												}
												
											});
										}
										
										if(!verif){ //SI NO HUBO COINCIDENCIAS ENTRE LAS TABLAS (CON EL ID MATERIAL) ENTONCES CREA LA FILA
											//CREACIÓN DE FILA
											tablaMovMat += '<tr id="row'+j+'">';
											tablaMovMat += '<td id="checkmatadd" class="inbox-small-cells"><input type="checkbox" value="" id="checkmatadd'+j+'" name="checkmatadd'+j+'[]" onclick="selCheckOnlyMM('+j+',this);"></td>';
											tablaMovMat += '<td id="id_mat" class="hidden">'+colIdMat+'</td>'; //COLUMNA ID MATERIAL (OCULTO)
											tablaMovMat += '<td id="id_stock'+j+'" class="hidden">'+colIdStock+'</td>'; //COLUMNA ID STOCK (OCULTO)
											tablaMovMat += '<td id="stock" class="hidden">'+colStock+'</td>'; //COLUMNA STOCK (OCULTO)
											tablaMovMat += '<td id="material">'+colMaterial+'</td>'; //COLUMNA MATERIAL
											tablaMovMat += '<td id="cantidad">'+colCantidad+'</td>'; //COLUMNA CANTIDAD
											tablaMovMat += '<td id="stock_min">'+colStockMin+'</td>'; //COLUMNA STOCK MINIMO
											tablaMovMat += '<td id="id_st'+j+'" class="hidden"></td>'; //COLUMNA STOCK DESTINO (EN CASO DE TRANSFERENCIA) (OCULTO)
											tablaMovMat += '<td id="unidad">'+colUnidad+'</td>'; //COLUMNA UNIDAD
											tablaMovMat += '<td><button class="btn btn-danger btn-xs clsEliminarFila" data-toggle="tooltip" data-placement="top" title="Eliminar este material"><i class="fa fa-trash-o "></i></button></td>'; //COLUMNA BOTON ELIMINAR FILA
											tablaMovMat += '</tr>';
										}
										j++;										
										sw = true;
									
									}
									
								}
								else{
									$('#advErrorVent'+i, nodo).show();
									$('#txt_mat_'+i, nodo).closest('td').addClass('has-error');
									return false;
								}
								
							}
						});
						
						if(errMonto){
							tablaErrorCantidad(filaErrMonto);
						}
						//console.log(tablaMovMat);
						$('table#tabla_movimiento_material tbody').append(tablaMovMat);
						asignarIdUnicoMat();
						$('[data-toggle="tooltip"]').tooltip();
						
						dialog.close();
						return false;
					}
				}
				else{
					BootstrapDialog.alert('Estimado Usuario, debe seleccionar algún Material para agregar.');
				}
				
			}
		},{
			id: 'btnMatVentClose',
			label: 'CERRAR',
			icon: 'glyphicon glyphicon-remove',
			action: function(dialog) {
				/*if($('table#tabla_movimiento_material tbody tr').length == 0) { //si la tabla de fondo no tiene registros
					$("#id_alm").val(""); //limpio select almacen para volver a cargar ventana
					$("#id_alm2").val(""); //limpio select almacen destino
					$("#btn-add_mat").attr('disabled','disabled'); //desabilito botón para agregar más materiales.
				}*/
				dialog.close();
				return false;
			}
		}]
    });
	ventaG.getModalDialog().css('width', '80%'); //ancho de la ventana
	ventaG.getModalHeader().css('background-color', '#344151'); //color de fondo del encabezado de la ventana
	ventaG.getModalBody().css('margin', '0px'); //cero margen en el cuerpo de la ventana
	ventaG.getModalBody().css('padding', '0px'); //cero espaciado en el cuerpo de la ventana
	ventaG.getButton('btnMatVentAdd').css('background-color', '#428bca'); //cambio del color del botón agregar
	ventaG.getButton('btnMatVentAdd').css('border-color', '#428bca'); //cambio del color del borde del botón agregar
	ventaG.getButton('btnMatVentClose').css('background-color', '#344151'); //cambio del color del botón cerrar
	ventaG.getButton('btnMatVentClose').css('border-color', '#344151'); //cambio del color del borde del botón cerrar
	
	var msg = $('<div id="divTablaMaterial" style="position: relative;">'+tabla+'</div>'); //inserto la tabla en un div con id
	setTimeout(function(){
		ventaG.setMessage(msg); //inserto el div y la tabla en el mensaje del cuerpo de la ventana
		configTabla('#tabla_material'); //configuro el dataTable para que agregue las demás propiedades
		ventaG.getModalBody().hide();
		ventaG.getModalBody().css('height', '70%'); //doy tamaño fijo al cuerpo de la ventana para que no se expanda hacia abajo
		ventaG.getModalBody().fadeIn(2000);
		$('.bootstrap-dialog-body').css('margin', 'auto 0');
		$('.bootstrap-dialog-body').css('padding-right', '6px');
		$('.bootstrap-dialog-body').css('padding-left', '6px');
		$('.bootstrap-dialog-body .row').css('margin-right', '6px');
		$('.bootstrap-dialog-body .row').css('margin-left', '6px');
		$('.bootstrap-dialog-body .row').css('margin-bottom', '-26px');
		$('.bootstrap-dialog-body .row').css('padding-bottom', '0px');
		$('.bootstrap-dialog-body .row  select').css('color', '#344151');
		$('.bootstrap-dialog-body .row select').addClass('form-control');
		$('.bootstrap-dialog-body .row input[type="text"]').addClass('form-control');
		$('.bootstrap-dialog-body .row input[type="text"]').css('width', '100%');
		$('.bootstrap-dialog-body .row .dataTables_filter').css('width', '100%');
		$('.bootstrap-dialog-body .row input[type="text"]').attr("placeholder", "BUSCAR MATERIAL...");
		$('.bootstrap-dialog-body table').css('font-size', '11px');
		//habilito el scroll si el contenido llegase a ser más largo que el 70% del cuerpo de la ventana
		ventaG.getModalBody().css('overflow', 'auto');
		ventaG.getButton('btnMatVentClose').enable();
		validarStockMin();
	},
	2500); //retrasamos un poco para aligerar la carga en la ventana
}

function tablaErrorCantidad(fila){
					
	var venTabMatErr = BootstrapDialog.show({
		message: $(''),
		title: 'MATERIAL(ES) NO AGREGADOS A LA LISTA',
		closable: false,
		buttons: [{
			id: 'btnErrCantidadMat',
			label: 'CERRAR',
			icon: 'glyphicon glyphicon-remove',
			action: function(dialog) {
				dialog.close();
				return false;
			}
		}]
	
	});
	var tbl = '';
	tbl += '<div id="divTablaErrCantidadMat" style="position: relative;">';
	tbl += '<br><div style="margin:4px;">Estimado Usuario, algunos materiales no se pudieron añadir a la lista. Debe introducir un monto menor a la disponibilidad del Material.</div><br><br>';
	tbl += '<section class="panel" style="height:200px;">';
	tbl += '<div class="panel-body2">';
	tbl += '<section id="flip-scroll">';
	tbl += '<table id="tablaErrCantidadMat" class="table-aux">';
	tbl += '<thead>';
	tbl += '<th class="hidden-phone">NRO.</th>';
	tbl += '<th class="hidden-phone">MATERIAL(ES)</th>';
	tbl += '<th class="hidden-phone">DISPONIBILIDAD</th>';
	tbl += '<th class="hidden-phone">MONTO INTRODUCIDO</th>';
	tbl += '<th class="hidden-phone">CANT. EXPRESADAS EN</th>';
	tbl += '<th class="hidden-phone">NOTA</th>';
	tbl += '</thead>';
	tbl += '<tbody>';
	tbl += fila;
	tbl += '</tbody>';
	tbl += '</table>';
	tbl += '</section>';
	tbl += '</div>';
	tbl += '</section>';
	tbl += '</div>';
	venTabMatErr.setMessage(tbl);
	venTabMatErr.getModalDialog().css('width', '80%');
	venTabMatErr.getModalHeader().css('border-bottom', 'solid 1px #fff');
	venTabMatErr.getModalBody().css('margin', '0px');
	venTabMatErr.getModalBody().css('padding', '0px');
}

function validarStockMin(){
	var tablaMat = $('#tabla_material').DataTable();
	var nodo = tablaMat.fnGetNodes();
	var i = 0;
	$.each(nodo, function( index, obj ) {
		i = index+1;
		aData = tablaMat.fnGetData(nodo[index]);
		console.log($('#tabla_material tbody tr#fila'+i+' td#claveStock', nodo).text());
		if ( aData[2] == "" ) {
			$("#txt_stockmin_"+i, nodo).removeAttr('disabled');
		}
		else{
			$("#txt_stockmin_"+i, nodo).attr('disabled','disabled');
		}
	});
	
}

function validarVentanaMat(){ //validación Global
	var tablaMat = $('#tabla_material').DataTable();
	var nodo = tablaMat.fnGetNodes();
	var error = 0, i = 0;
	$.each(nodo, function( index, obj ) {
		i = index+1;
		chekMarcado = $("#checkmat"+i, nodo).prop("checked");
		if ( chekMarcado ){
			
			if ( $('#txt_mat_'+i, nodo).val() != "" ) {
				$('#advErrorVent'+i, nodo).hide();
				$('#txt_mat_'+i, nodo).closest('td').removeClass('has-error').addClass('has-success');
			}
			else{
				$('#advErrorVent'+i, nodo).show();
				$('#txt_mat_'+i, nodo).closest('td').addClass('has-error');
				error = 1;
			}
		}
	});
	
	if ( nodo.length == i && error == 1 ) return false;
	return true;
}

/**********************************************
	MATERIALES (CARGAR Y CONSTRUÍR TABLA)
**********************************************/
function cargarMaterialEntrada(){
	var parametros=[{
		"clase":"material",
		"consulta":"(select vista_material.id_mat, vista_material.nombre_mat, vista_material.codigo_mat, vista_material.cant_uni_ent, vista_material.cant_uni_sal, vista_material.nombre_uni_ent, vista_material.abrev_uni_ent, vista_material.nombre_uni_sal, vista_material.abrev_uni_sal, vista_material.nombre_fam, stock_material.id_stock, stock_material.id_alm, stock_material.stock, stock_material.stock_min, stock_material.id_estatus_reg from vista_material left join stock_material on vista_material.id_mat = stock_material.id_mat where stock_material.id_stock is not null and stock_material.id_alm = '"+getD("id_alm")+"') union (select vista_material.id_mat, vista_material.nombre_mat, vista_material.codigo_mat, vista_material.cant_uni_ent, vista_material.cant_uni_sal, vista_material.nombre_uni_ent, vista_material.abrev_uni_ent, vista_material.nombre_uni_sal, vista_material.abrev_uni_sal, vista_material.nombre_fam, stock_material.id_stock, stock_material.id_alm, stock_material.stock, stock_material.stock_min, stock_material.id_estatus_reg from vista_material left join stock_material on vista_material.id_mat = stock_material.id_mat where stock_material.id_stock is null) order by nombre_mat"
	}]
	cargarMaterialGen(parametros);
}
function cargarMaterialSalida(){
	var parametros=[{
		"clase":"material",
		"consulta":"SELECT * FROM vista_stock_material WHERE id_estatus_reg = 1 and vista_stock_material.id_alm = '"+getD("id_alm")+"'"
	}]
	cargarMaterialGen(parametros);
}
function cargarMaterialGen(parametros){
	$.ajax({
		data:{"parametros":JSON.stringify(parametros)},
		type: "GET",
		dataType: "json",
		url: "controlador_buscar.php"
	})
	.done(function( respuesta, textStatus, jqXHR ) {
		if(respuesta.success ){
			asignarMaterialGen(respuesta);
		}else {
			log( "Error: " + respuesta.error);
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		log( "La solicitud a fallado: " +  textStatus);
	});
}
function  asignarMaterialGen(respuesta){
	var objetos=respuesta.objetos;
	for (var objeto in objetos){
		var clase=objetos[objeto].clase;
		var cantidad=objetos[objeto].cantidad;
		var output='';
		if(cantidad==0){
			switch(clase){
				case "material":
					$("#tabla_material").append('');
					output += '<tbody>';
					output += '<tr><td><b>No se encontraron resultados.</b></td></tr>';
					output += '</tbody>';
					$("#tabla_material").append(output);
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}	 	  
		else if(cantidad==1){
			switch(clase){
				case "material":
					var campo = objetos[objeto].data[0];
					var unidad="", disp="", stm="";
					if(campo.nombre_uni_sal == "UNIDAD") unidad = campo.nombre_uni_sal+"(ES)";
					else unidad = campo.nombre_uni_sal+"(S)";
					if(campo.stock == "") disp = "<strong style='color:#a94442;' id=disp" + 1 + ">0.00</strong>";
					else disp = "<strong style='color:#3c763d;' id=disp" + 1 + ">" + campo.stock + "</strong>";
					if(campo.stock_min == "") stm = "1.00";
					else stm = campo.stock_min;
					$("#tabla_material").append('');
					output += '<table id="tabla_material" class="table table-striped table-advance table-hover">';
					output += '<thead>';
					output += '<tr>';
					output += '<th>N°</th>';
					output += '<th class="hidden">ID MATERIAL</th>';
					output += '<th class="hidden">ID STOCK</th>';
					output += '<th class="inbox-small-cells"><input type="checkbox" value="" id="checkboxmat" name="checkboxmat[]" onclick="selCheckTodos();"></th>';
					output += '<th class="hidden-phone"><i class="fa fa-gavel"></i> MATERIAL(ES)</th>';
					output += '<th><i class="fa fa-sort-numeric-desc"></i></i> DISPONIBLE</th>';
					output += '<th><i class="fa fa-sort-numeric-asc"></i></i> CANTIDAD</th>';
					output += '<th><i class="fa fa-tachometer"></i> STOCK MÍNIMO</th>';
					output += '<th class="hidden"> UNIDAD</th>';
					output += '</tr>';
					output += '</thead>';
					output += '<tbody>';
					output += '<tr id="fila1">';
					output += '<td id="num">'+1+'</td>';
					output += '<td id="clave" class="hidden">' + campo.id_mat + '</td>';
					output += '<td id="claveStock" class="hidden">' + campo.id_stock + '</td>';
					output += '<td id="checkmat" class="inbox-small-cells"><input type="checkbox" value="" id="checkmat'+1+'" name="checkmat'+1+'[]" onclick="selCheckSolo('+1+',this);"></td>';
					output += '<td id="material" class="hidden-phone">' + campo.nombre_mat + '</td>';
					output += '<td id="disponible">' + disp + ' <strong>' + campo.abrev_uni_sal + '</strong></td>';
					output += '<td id="cantidad"><input class="form-control" type="text" name="txt_mat_'+1+'" id="txt_mat_'+1+'" maxlength="20" size="15" value="" onKeyPress="return SoloNumeroDecimal(event,this);" onblur="formatDec(this.id,this.value);" disabled /> '+unidad+'<div id="advErrorVent1" class="advErrorVent"><strong>Introduzca una cantidad</strong></div></td>';
					output += '<td id="cantidadstm"><input class="form-control" type="text" name="txt_stockmin_'+1+'" id="txt_stockmin_'+1+'" maxlength="20" value="'+stm+'" onKeyPress="return SoloNumeroDecimal(event,this);" onblur="formatDecStockMin(this.id,this.value);" size="10" /> '+unidad+'</td>';
					output += '<td id="unidad" class="hidden">' + unidad + '</td>';
					output += '</tr>';
					output += '</tbody>';
					output += '</table>';
					mostrarTablaMaterial(output);
					
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}
		else{
			switch(clase){
				case "material":
					
					$("#tabla_material").append('');
					output += '<table id="tabla_material" class="table table-striped table-advance table-hover">';
					output += '<thead>';
					output += '<tr>';
					output += '<th>N°</th>';
					output += '<th class="hidden">ID MATERIAL</th>';
					output += '<th class="hidden">ID STOCK</th>';
					output += '<th class="inbox-small-cells"><input type="checkbox" value="" id="checkboxmat" name="checkboxmat[]" onclick="selCheckTodos();"></th>';
					output += '<th class="hidden-phone"><i class="fa fa-gavel"></i> MATERIAL(ES)</th>';
					output += '<th><i class="fa fa-sort-numeric-desc"></i></i> DISPONIBLE</th>';
					output += '<th><i class="fa fa-sort-numeric-asc"></i></i> CANTIDAD</th>';
					output += '<th><i class="fa fa-tachometer"></i> STOCK MÍNIMO</th>';
					output += '<th class="hidden"> UNIDAD</th>';
					output += '</tr>';
					output += '</thead>';
					output += '<tbody>';
					for (var datos in objetos[objeto].data){
					var conteo = parseInt(datos);
					conteo = conteo+1;
					var campo = objetos[objeto].data[datos];
					var unidad="", disp="", stm="";
					if(campo.nombre_uni_sal == "UNIDAD") unidad = campo.nombre_uni_sal+"(ES)";
					else unidad = campo.nombre_uni_sal+"(S)";
					if(campo.stock == "") disp = "<strong style='color:#a94442;' id=disp" + conteo + ">0.00</strong>";
					else disp = "<strong style='color:#3c763d;' id=disp" + conteo + ">" + campo.stock + "</strong>";
					if(campo.stock_min == "") stm = "1.00";
					else stm = campo.stock_min;
					output += '<tr id="fila'+conteo+'">';
					output += '<td id="num">' +conteo+ '</td>';
					output += '<td id="clave" class="hidden">' + campo.id_mat + '</td>';
					output += '<td id="claveStock" class="hidden">' + campo.id_stock + '</td>';
					output += '<td id="checkmat" class="inbox-small-cells"><input type="checkbox" value="" id="checkmat'+conteo+'" name="checkmat'+conteo+'[]" onclick="selCheckSolo('+conteo+',this);"></td>';
					output += '<td id="material" class="hidden-phone">' + campo.nombre_mat + '</td>';
					output += '<td id="disponible">' + disp + ' <strong>' + campo.abrev_uni_sal + '</strong></td>';
					output += '<td id="cantidad"><input class="form-control" type="text" name="txt_mat_'+conteo+'" id="txt_mat_'+conteo+'" maxlength="20" size="15" value="" onKeyPress="return SoloNumeroDecimal(event,this);" onblur="formatDec(this.id,this.value);" disabled /> '+unidad+'<div id="advErrorVent'+conteo+'" class="advErrorVent"><strong>Introduzca una cantidad</strong></div></td>';
					output += '<td id="cantidadstm"><input class="form-control" type="text" name="txt_stockmin_'+conteo+'" id="txt_stockmin_'+conteo+'" maxlength="20" value="'+stm+'" onKeyPress="return SoloNumeroDecimal(event,this);" onblur="formatDecStockMin(this.id,this.value);" size="10" /> '+unidad+'</td>';
					output += '<td id="unidad" class="hidden">' + unidad + '</td>';
					output += '</tr>';
					}
					output += '</tbody>';
					output += '</table>';
					mostrarTablaMaterial(output);
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
			//alerta("Aviso, La busqueda retorno "+cantidad+" registros");
		}
	}
}

function configTabla(nombreTabla){
	
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
		"iDisplayLength": 8,
		"aLengthMenu": [[8, 10, 15, 25, 50, -1], [8, 10, 15, 25, 50, "Todos"]]
	});

}
				
function selCheckTodos(){
	var oTable = $('#tabla_material').DataTable();
	var nodo = oTable.fnGetNodes();
	var marcado = $("#checkboxmat").prop("checked");
	var i = 0;
	if(marcado){
		console.log("se marcó");
		ventaG.getButton('btnMatVentAdd').enable(); //habilito el botón agregar
		$('input', nodo).prop("checked", true);
		$.each(nodo, function( index, obj ) {
			i = index+1;
			$('#txt_mat_'+i, nodo).val('');
			$('#txt_mat_'+i, nodo).removeAttr('disabled');
		});
		return false; // to avoid refreshing the page
	}
	else{ 
		console.log("se desmarcó");
		ventaG.getButton('btnMatVentAdd').disable(); //deshabilito el botón agregar
		$('input', nodo).prop("checked", false);
		$.each(nodo, function( index, obj ) {
			i = index+1;
			$('#txt_mat_'+i, nodo).val('');
			$('#txt_mat_'+i, nodo).attr('disabled','disabled');
			$('#advErrorVent'+i, nodo).hide();
			$('#txt_mat_'+i, nodo).closest('td').removeClass('has-error').removeClass('has-success');
		});
		return false; // to avoid refreshing the page
	}
}

function selCheckSolo(i,id){
	var oTable = $('#tabla_material').DataTable();
	var nodo = oTable.fnGetNodes();
	var marcado = $(id).prop("checked");
	var checkados = $('input:checked', nodo).length;
	//console.log($('input:checked', nodo).length);
	if(checkados == 0) ventaG.getButton('btnMatVentAdd').disable();
		
	if(marcado){
		ventaG.getButton('btnMatVentAdd').enable(); //habilito el botón agregar
		$('#txt_mat_'+i, nodo).val('');
		$('#txt_mat_'+i, nodo).removeAttr('disabled');
		return false; // to avoid refreshing the page
	}
	else{
		$('#txt_mat_'+i, nodo).val('');
		$('#txt_mat_'+i, nodo).attr('disabled','disabled');
		return false; // to avoid refreshing the page
	}
}
