/*
function gestionar_movimiento(accion,clase,band){
	
	if( validardatos("gestion_movimiento",accion,clase) ){
		
		if( band == 0 ){
			gestion_movimiento_material("incluir","movimiento");
			gestion_stock_material("incluir","stock_material");
		}else {
			gestion_movimiento_material("incluir","movimiento");
			gestion_stock_material("modificar","stock_material");
		}
	}
	
}*/
function gestion_movimiento(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_mov":getD("id_mov"),
                  "id_tipo_mov":getD("id_tipo_mov"),
                  "id_alm":getD("id_alm"),
                  "id_res":getD("id_res"),
                  "ref_mov":getD("ref_mov"),
                  "mot_mov":$("#id_mot_mov option:selected").text()
              }
          }];
         $.ajax({
           data:{"parametros":JSON.stringify(parametros)},
           type: "POST",
           dataType: "json",
           url: "controlador.php",
         })
         .done(function( respuesta, textStatus, jqXHR ){
            if( respuesta.success ) { //si se ingresa el movimiento, entonces se ingresa el movimiento_material (dependiente : id_mov)
				gestion_movimiento_material("incluir","movimiento_material");
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
               disabled("eliminar");
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
               setD("id_tipo_mov",campo.id_tipo_mov);
               setD("id_alm",campo.id_alm);
               setD("id_res",campo.id_res);
               setD("ref_mov",campo.ref_mov);
               setD("mot_mov",campo.mot_mov);
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