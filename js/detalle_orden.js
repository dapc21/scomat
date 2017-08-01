function  cargar_form_detalle_orden(){
  log("entro a cargar detalle_orden.")
   $.ajax({
    type: "GET",
    url: "Formulario/detalle_orden.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_detalle_orden.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_detalle_orden(accion,clase){
         validardatos("gestion_detalle_orden",accion,clase)
}
function  gestion_detalle_orden(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_det_orden":getD("id_det_orden"),
                  "id_tipo_orden":getD("id_tipo_orden"),
                  "nombre_det_orden":getD("nombre_det_orden"),
                  "status":getOption("status"),
                  "id_serv":getD("id_serv"),
                  "tipo_detalle":estatusCheck_orden()
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
               cargar_form_detalle_orden();
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
function  buscar_id_det_orden(id_det_orden){
   var parametros=[{
            "clase":"detalle_orden",
            "consulta":"select * from detalle_orden where id_det_orden='"+id_det_orden+"'"
         }]
   buscar_detalle_orden(parametros);
}
function  buscar_detalle_orden(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_detalle_orden(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_detalle_orden(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "detalle_orden":
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
            case "detalle_orden":
               setD("id_det_orden",campo.id_det_orden);
               setD("id_tipo_orden",campo.id_tipo_orden);
               setD("nombre_det_orden",campo.nombre_det_orden);
               setOption("status",campo.status);
               setD("id_serv",campo.id_serv);
               asignarCheck(campo.tipo_detalle);
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

function estatusCheck_orden(){
	var cade='';
	for (i = 0; i < document.f1.status_contrato.length; i++) {
		if(document.f1.status_contrato[i].checked == true){
			cade= cade+document.f1.status_contrato[i].value+";";
		}
	}
	return cade;
}