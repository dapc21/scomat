function  cargar_form_tipo_orden(){
  log("entro a cargar tipo_orden.")
   $.ajax({
    type: "GET",
    url: "Formulario/tipo_orden.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_tipo_orden.php","datagrid_tipo_orden");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ){
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_tipo_orden(accion,clase){
         validardatos("gestion_tipo_orden",accion,clase)
}
function  gestion_tipo_orden(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_tipo_orden":getD("id_tipo_orden"),
                  "nombre_tipo_orden":getD("nombre_tipo_orden"),
                  "status_tipord":getD("status_tipord")
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
               cargar_form_tipo_orden();
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
function  buscar_id_tipo_orden(id_tipo_orden){
   var parametros=[{
            "clase":"tipo_orden",
            "consulta":"select * from tipo_orden where id_tipo_orden='"+id_tipo_orden+"'"
         }]
   buscar_tipo_orden(parametros);
}
function  buscar_tipo_orden(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_tipo_orden(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_tipo_orden(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "tipo_orden":
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
            case "tipo_orden":
               setD("id_tipo_orden",campo.id_tipo_orden);
               setD("nombre_tipo_orden",campo.nombre_tipo_orden);
               setD("status_tipord",campo.status_tipord);
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