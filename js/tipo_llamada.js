function  cargar_form_tipo_llamada(){
  log("entro a cargar tipo_llamada.")
   $.ajax({
    type: "GET",
    url: "Formulario/tipo_llamada.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_tipo_llamada.php","datagrid_tipo_llamada");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_tipo_llamada(accion,clase){
         validardatos("gestion_tipo_llamada",accion,clase)
}
function  gestion_tipo_llamada(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_tll":getD("id_tll"),
                  "nombre_tll":getD("nombre_tll"),
                  "status_tll":getOption("status_tll"),
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
               cargar_form_tipo_llamada();
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
function  buscar_id_tll(id_tll){
   var parametros=[{
            "clase":"tipo_llamada",
            "consulta":"select * from tipo_llamada where id_tll='"+id_tll+"'"
         }]
   buscar_tipo_llamada(parametros);
}
function  buscar_tipo_llamada(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_tipo_llamada(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_tipo_llamada(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "tipo_llamada":
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
            case "tipo_llamada":
               setD("id_tll",campo.id_tll);
               setD("nombre_tll",campo.nombre_tll);
               setOption("status_tll",campo.status_tll);
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