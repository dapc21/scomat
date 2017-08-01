function  cargar_form_inventario_material(){
	$.ajax({
	type: "GET",
	url: "Formulario/inventario_material.php",
	})
	.done(function( respuesta, textStatus, jqXHR ){
		$("#principal").html(respuesta);
		activar_validar_datos();
		listar_datos("procesos/datagrid_inventario_material.php","datagrid");  
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		alerta("Error al cargar formulario:\n "+textStatus);
	});
}

function  gestionar_inventario_material(accion,clase){
	validardatos("gestion_inventario_material",accion,clase)
}
function  gestion_inventario_material(accion,clase){
	var parametros=[{
		"clase":clase,
		"accion":accion,
		"datos":{
			"id_inv_mat":getD("id_inv_mat"),
			"id_stock":getD("id_stock"),
			"id_inv":getD("id_inv"),
			"cant_sist":getD("stock"),
			"cant_real":getD("stock"),
			"inventario":inventario()
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
			cargar_form_inventario_material();
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
function buscar_id_inv_mat(id_inv_mat){
	var parametros=[{
		"clase":"inventario_material",
		"consulta":"select * from inventario_material where id_inv_mat='"+id_inv_mat+"'"
	}]
	buscar_inventario_material(parametros);
}
function  buscar_inventario_material(parametros){
	$.ajax({
		data:{"parametros":JSON.stringify(parametros)},
		type: "GET",
		dataType: "json",
		url: "controlador_buscar.php"
	})
	.done(function( respuesta, textStatus, jqXHR ) {
		if(respuesta.success ){
			asignar_inventario_material(respuesta);
		}else {
			log( "Error: " + respuesta.error);
		}
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
		log( "La solicitud a fallado: " +  textStatus);
	});
}
function  asignar_inventario_material(respuesta){
	var objetos=respuesta.objetos;
	for (var objeto in objetos){
		var clase=objetos[objeto].clase;
		var cantidad=objetos[objeto].cantidad;
		if(cantidad==0){
			switch(clase){
			case "inventario_material":
				enabled("registrar");
				disabled("modificar");
				disabled("eliminar");
			break;
			default:
				log( "no existe la clase: "+clase+" para asignar parametros");
			}
		}	 	  
		else if(cantidad==1){
			var campo=objetos[objeto].data[0];
			switch(clase){
			case "inventario_material":
				setD("id_inv_mat",campo.id_inv_mat);
				setD("id_stock",campo.id_stock);
				setD("id_inv",campo.id_inv);
				disabled("registrar");
				enabled("modificar");
				enabled("eliminar");
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
