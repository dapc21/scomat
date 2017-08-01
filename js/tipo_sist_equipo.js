function  cargar_form_tipo_sist_equipo(){
   $.ajax({
    type: "GET",
    url: "Formulario/tipo_sist_equipo.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_tipo_sist_equipo.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_tipo_sist_equipo(accion,clase){
         validardatos("gestion_tipo_sist_equipo",accion,clase)
}
function  gestion_tipo_sist_equipo(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_tse":getD("id_tse"),
                  "sistema":getD("sistema"),
                  "ubicacion":getD("ubicacion"),
                  "abrev_nombre_tse":getD("abrev_nombre_tse"),
                  "status_tse":getOption("status_tse"),
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
               cargar_form_tipo_sist_equipo();
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
function  buscar_id_tse(id_tse){
   var parametros=[{
            "clase":"tipo_sist_equipo",
            "consulta":"select * from tipo_sist_equipo where id_tse='"+id_tse+"'"
         }]
   buscar_tipo_sist_equipo(parametros);
}
function  buscar_tipo_sist_equipo(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_tipo_sist_equipo(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_tipo_sist_equipo(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "tipo_sist_equipo":
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
            case "tipo_sist_equipo":
               setD("id_tse",campo.id_tse);
               setD("sistema",campo.sistema);
               setD("ubicacion",campo.ubicacion);
               setD("abrev_nombre_tse",campo.abrev_nombre_tse);
               setOption("status_tse",campo.status_tse);
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