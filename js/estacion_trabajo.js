function  cargar_form_estacion_trabajo(){
  log("entro a cargar estacion_trabajo.")
   $.ajax({
    type: "GET",
    url: "Formulario/estacion_trabajo.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_estacion_trabajo.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_estacion_trabajo(accion,clase){
         validardatos("gestion_estacion_trabajo",accion,clase)
}
function  gestion_estacion_trabajo(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_est":getD("id_est"),
                  "login":getD("login"),
                  "nombre_est":getD("nombre_est"),
                  "ip_est":getD("ip_est"),
                  "nom_comp":getD("nom_comp"),
                  "mac_est":getD("mac_est"),
                  "status_est":getOption("status_est"),
                  "dato":getD("dato"),
                  "id_franq":getD("id_franq")
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
               cargar_form_estacion_trabajo();
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
function  buscar_id_est(id_est){
   var parametros=[{
            "clase":"estacion_trabajo",
            "consulta":"select * from estacion_trabajo where id_est='"+id_est+"'"
         }]
   buscar_estacion_trabajo(parametros);
}
function  buscar_estacion_trabajo(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_estacion_trabajo(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_estacion_trabajo(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "estacion_trabajo":
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
            case "estacion_trabajo":
               setD("id_est",campo.id_est);
               setD("login",campo.login);
               setD("nombre_est",campo.nombre_est);
               setD("ip_est",campo.ip_est);
               setD("nom_comp",campo.nom_comp);
               setD("mac_est",campo.mac_est);
               setOption("status_est",campo.status_est);
               setD("dato",campo.dato);
               setD("id_franq",campo.id_franq);
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