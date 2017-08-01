function  cargar_form_statuscont(){
   $.ajax({
    type: "GET",
    url: "Formulario/statuscont.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_statuscont.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_statuscont(accion,clase){
         validardatos("gestion_statuscont",accion,clase)
}
function  gestion_statuscont(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "status_contrato":getD("status_contrato"),
                  "nombrestatus":getD("nombrestatus"),
                  "abrev":getD("abrev"),
                  "penet":getD("penet"),
                  "tipo_sta":getD("tipo_sta"),
                  "status":getOption("status"),
                  "color":getD("color"),
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
               cargar_form_statuscont();
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
function  buscar_status_contrato(status_contrato){
   var parametros=[{
            "clase":"statuscont",
            "consulta":"select * from statuscont where status_contrato='"+status_contrato+"'"
         }]
   buscar_statuscont(parametros);
}
function  buscar_statuscont(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_statuscont(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_statuscont(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "statuscont":
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
            case "statuscont":
               setD("status_contrato",campo.status_contrato);
               setD("nombrestatus",campo.nombrestatus);
               setD("abrev",campo.abrev);
               setD("penet",campo.penet);
               setD("tipo_sta",campo.tipo_sta);
               setOption("status",campo.status);
               setD("color",campo.color);
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