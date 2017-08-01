var ventana;
/*---AJAX VENTANAS----*/

function ajaxVentana_msg(ubicacion, id,titulo){
	
		$.ajax("procesos/"+ubicacion, {
			"type": "post",   // usualmente post o get
			"success": function(result) {//log(result);
				var contenido = result;
				//alert(contenido)
				ventanaFormulario_msg(titulo, contenido, id);
				//log("Llego el contenido y no hubo error", result);
			},
			"error": function(result) {
				var contenido = "Error interno del servidor";
				ventanaFormulario_msg(titulo, contenido, id);	   
				//console.error("Este callback maneja los errores", result);
			},
			"data": {archivo: id},
			"async": true,
		});
	
}

/*---VENTANAS MODALES----*/
function ventanaFormulario_msg(titulo, contenido, id) {

	 ventana = BootstrapDialog.show({
		title    : titulo,
		message  : $(contenido),
		closable : false,
		type     : BootstrapDialog.TYPE_INFO,
		cssClass: 'ventana-formulario',
		buttons  : [{
			icon     : 'glyphicon glyphicon-thumbs-up',
			label    : 'OK',
			cssClass : 'btn-info',
			action   : function(dialogItself) {
				dialogItself.close();
			}
		}]
	});

	ventana.getModalFooter().css('border', '0');
	ventana.getModalFooter().css('text-align', 'center');
}

function procesando() {
	 ventana = BootstrapDialog.show({
		title    : "Procesando...",
		
		message  : '<div style="text-align: center;color:#058CB6;"><br>Por favor espere<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>',
		//message  : '<div style="text-align: center;"><br>Por favor espere<br><img id="loading" src="imagenes/loading.gif"><br></div>',
		closable : false,
		type     : BootstrapDialog.TYPE_INFO
		
	});
	return ventana;
}


function ajaxVentana_BA(titulo, id){
	//alert(id)
	if(valida_form_externo(id)){
		$.ajax("ventanaFormulario/buscarFormulario.php", {
			"type": "post",   // usualmente post o get
			"success": function(result) {//log(result);
				var contenido = result;
				ventanaFormulario_BA(titulo, contenido, id);
				//log("Llego el contenido y no hubo error", result);
			},
			"error": function(result) {
				var contenido = "Error interno del servidor";
				ventanaFormulario_BA(titulo, contenido, id);	   
				//console.error("Este callback maneja los errores", result);
			},
			"data": {archivo: id},
			"async": true,
		});
	}
}

function ajaxVentana_BAT(titulo, id){
	//alert(id)
	if(valida_form_externo(id)){
		$.ajax("ventanaFormulario/buscarFormularioT.php", {
			"type": "post",   // usualmente post o get
			"success": function(result) {//log(result);
				var contenido = result;
				ventanaFormulario_BAT(titulo, contenido, id);
				//log("Llego el contenido y no hubo error", result);
			},
			"error": function(result) {
				var contenido = "Error interno del servidor";
				ventanaFormulario_BAT(titulo, contenido, id);	   
				//console.error("Este callback maneja los errores", result);
			},
			"data": {archivo: id},
			"async": true,
		});
	}
}

function ventanaFormulario_BAT(titulo, contenido, id) {

	 ventana = BootstrapDialog.show({
		title    : titulo,
		message  : $(contenido),
		closable : false,
		type     : BootstrapDialog.TYPE_INFO,
		cssClass: 'ventana-formulario',
		buttons  : [{
			icon     : 'glyphicon glyphicon-search',
			label    : 'Buscar',
			cssClass : 'btn-success',
			action   : function(dialog) {
				
					//verificar_form_externo("incluir",id);
					buscarContAvanzT();
				
			}
		},{
			icon   : 'glyphicon glyphicon-remove',
			label  : 'Cerrar',
			cssClass : 'btn-default',
			action : function(dialogItself){
				dialogItself.close();
			}
		}]
	});

	ventana.getModalFooter().css('border', '0');
	ventana.getModalFooter().css('text-align', 'center');

}

function ventanaFormulario_BA(titulo, contenido, id) {

	 ventana = BootstrapDialog.show({
		title    : titulo,
		message  : $(contenido),
		closable : false,
		type     : BootstrapDialog.TYPE_INFO,
		cssClass: 'ventana-formulario',
		buttons  : [{
			icon     : 'glyphicon glyphicon-search',
			label    : 'Buscar',
			cssClass : 'btn-success',
			action   : function(dialog) {
				
					//verificar_form_externo("incluir",id);
					buscarContAvanz();
				
			}
		},{
			icon   : 'glyphicon glyphicon-remove',
			label  : 'Cerrar',
			cssClass : 'btn-default',
			action : function(dialogItself){
				dialogItself.close();
			}
		}]
	});

	ventana.getModalFooter().css('border', '0');
	ventana.getModalFooter().css('text-align', 'center');

}
function ajaxVentana_BA_cedula(titulo, id,cedula){
	
		$.ajax("ventanaFormulario/buscarFormulario.php", {
			"type": "post",   // usualmente post o get
			"success": function(result) {//log(result);
				var contenido = result;
				ventanaFormulario_BA_cedula(titulo, contenido, id,cedula);
				//log("Llego el contenido y no hubo error", result);
			},
			"error": function(result) {
				var contenido = "Error interno del servidor";
				ventanaFormulario_BA(titulo, contenido, id);	   
				//console.error("Este callback maneja los errores", result);
			},
			"data": {archivo: cedula},
			"async": true,
		});
	
}

/*---VENTANAS MODALES----*/
function ventanaFormulario_BA_cedula(titulo, contenido, id,cedula='') {

	 ventana = BootstrapDialog.show({
		title    : titulo,
		message  : $(contenido),
		closable : false,
		type     : BootstrapDialog.TYPE_INFO,
		cssClass: 'ventana-formulario',
		buttons  : [{
			icon     : 'glyphicon glyphicon-search',
			label    : 'Buscar',
			cssClass : 'btn-success',
			action   : function(dialog) {
				
					//verificar_form_externo("incluir",id);
					buscarContAvanz();
				
			}
		},{
			icon   : 'glyphicon glyphicon-remove',
			label  : 'Cerrar',
			cssClass : 'btn-default',
			action : function(dialogItself){
				dialogItself.close();
			}
		}]
	});
	ventana.getModalFooter().css('border', '0');
	ventana.getModalFooter().css('text-align', 'center');
	//alert("hjola")
}
function ajaxVentana_AD(titulo, id){
		$.ajax("ActualizarDeuda.php", {
			"type": "post",   // usualmente post o get
			"success": function(result) {//log(result);
				var contenido = result;
				ventanaFormulario_AD(titulo, contenido, id);
				//log("Llego el contenido y no hubo error", result);
			},
			"error": function(result) {
				var contenido = "Error interno del servidor";
				ventanaFormulario_AD(titulo, contenido, id);	   
				//console.error("Este callback maneja los errores", result);
			},
			"data": {id_cont_serv: id},
			"async": true,
		});
}

function ventanaFormulario_AD(titulo, contenido, id) {

	 ventana = BootstrapDialog.show({
		title    : titulo,
		message  : $(contenido),
		closable : false,
		type     : BootstrapDialog.TYPE_INFO,
		cssClass: 'ventana-formulario',
		buttons  : [{
			icon     : 'glyphicon glyphicon-search',
			label    : 'Solicitar',
			cssClass : 'btn-success',
			action   : function(dialog) {
				RespActualizarDeuda();
					//verificar_form_externo("incluir",id);
			//		buscarContAvanz();
				
			}
		},{
			icon   : 'glyphicon glyphicon-remove',
			label  : 'Cerrar',
			cssClass : 'btn-default',
			action : function(dialogItself){
				dialogItself.close();
			}
		}]
	});

	ventana.getModalFooter().css('border', '0');
	ventana.getModalFooter().css('text-align', 'center');

}


