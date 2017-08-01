function  cargar_form_ubicacion_equipo_sis(){
   $.ajax({
    type: "GET",
    url: "Formulario/ubicacion_equipo_sis.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_ubicacion_equipo_sis.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_ubicacion_equipo_sis(accion,clase){
         validardatos("gestion_ubicacion_equipo_sis",accion,clase)
}
function  gestion_ubicacion_equipo_sis(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_ues":getD("id_ues"),
                  "nombre_ues":getD("nombre_ues"),
                  "direccion_ues":getD("direccion_ues"),
                  "status_ues":getOption("status_ues"),
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
               cargar_form_ubicacion_equipo_sis();
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
function  buscar_id_ues(id_ues){
   var parametros=[{
            "clase":"ubicacion_equipo_sis",
            "consulta":"select * from ubicacion_equipo_sis where id_ues='"+id_ues+"'"
         }]
   buscar_ubicacion_equipo_sis(parametros);
}
function  buscar_ubicacion_equipo_sis(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_ubicacion_equipo_sis(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_ubicacion_equipo_sis(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "ubicacion_equipo_sis":
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
            case "ubicacion_equipo_sis":
               setD("id_ues",campo.id_ues);
               setD("nombre_ues",campo.nombre_ues);
               setD("direccion_ues",campo.direccion_ues);
               setOption("status_ues",campo.status_ues);
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