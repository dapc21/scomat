function  cargar_form_servicios_sistema(){
   $.ajax({
    type: "GET",
    url: "Formulario/servicios_sistema.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_servicios_sistema.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_servicios_sistema(accion,clase){
         validardatos("gestion_servicios_sistema",accion,clase)
}
function  gestion_servicios_sistema(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_serv_sist":getD("id_serv_sist"),
                  "id_tse":getD("id_tse"),
                  "nombre_serv_sist":getD("nombre_serv_sist"),
                  "codigo_serv_sist":getD("codigo_serv_sist"),
                  "abrev_serv_sist":getD("abrev_serv_sist"),
                  "status_serv_sist":getOption("status_serv_sist"),
                  "dato":getD("dato")
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
               cargar_form_servicios_sistema();
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
function  buscar_id_serv_sist(id_serv_sist){
   var parametros=[{
            "clase":"servicios_sistema",
            "consulta":"select * from servicios_sistema where id_serv_sist='"+id_serv_sist+"'"
         }]
   buscar_servicios_sistema(parametros);
}
function  buscar_servicios_sistema(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_servicios_sistema(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_servicios_sistema(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "servicios_sistema":
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
            case "servicios_sistema":
               setD("id_serv_sist",campo.id_serv_sist);
               setD("id_tse",campo.id_tse);
               setD("nombre_serv_sist",campo.nombre_serv_sist);
               setD("codigo_serv_sist",campo.codigo_serv_sist);
               setD("abrev_serv_sist",campo.abrev_serv_sist);
               setOption("status_serv_sist",campo.status_serv_sist);
               setD("dato",campo.dato);
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