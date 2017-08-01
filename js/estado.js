// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function  cargar_form_estado(){
   $.ajax({
    type: "GET",
    url: "Formulario/estado.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_estado.php","datagrid_estado");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_estado(accion,clase){
         validardatos("gestion_estado",accion,clase)
}
function  gestion_estado(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_esta":getD("id_esta"),
                  "status_esta":getOption("status_esta"),                       
                  "nombre_esta":getD("nombre_esta"),                                                        
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
               cargar_form_estado();
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
function  buscar_id_esta(id_esta){
   var parametros=[{
            "clase":"estado",
            "consulta":"select * from estado where id_esta='"+id_esta+"'"
         }]
   buscar_estado(parametros);
}
function  buscar_nombre_esta(){
   var parametros=[{
            "clase":"estado",
            "consulta":"select * from estado where nombre_esta='"+getD("nombre_esta")+"'"
         }]
   buscar_estado(parametros);
}
function  buscar_estado(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_estado(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_estado(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "estado":
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
            case "estado":
               setD("id_esta",campo.id_esta);
               setD("nombre_esta",campo.nombre_esta);        
               setOption("status_esta",campo.status_esta);        
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
