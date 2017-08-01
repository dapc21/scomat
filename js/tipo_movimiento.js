function  cargar_form_tipo_movimiento(){
   $.ajax({
    type: "GET",
    url: "Formulario/tipo_movimiento.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_tipo_movimiento.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_tipo_movimiento(accion,clase){
         validardatos("gestion_tipo_movimiento",accion,clase)
}
function  gestion_tipo_movimiento(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_tipo_mov":getD("id_tipo_mov"),
                  "nombre_tipo_mov":getD("nombre_tipo_mov"),
                  "descrip_tipo_mov":getD("descrip_tipo_mov"),
                  "status_tipo_mov":getOption("status_tipo_mov")
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
               cargar_form_tipo_movimiento();
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
function  buscar_id_tipo_mov(id_tipo_mov){
   var parametros=[{
            "clase":"tipo_movimiento",
            "consulta":"select * from tipo_movimiento where id_tipo_mov='"+id_tipo_mov+"' and id_estatus_reg = 1"
         }]
   buscar_tipo_movimiento(parametros);
}
function  buscar_tipo_movimiento(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_tipo_movimiento(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_tipo_movimiento(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "tipo_movimiento":
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
            case "tipo_movimiento":
               setD("id_tipo_mov",campo.id_tipo_mov);
               setD("nombre_tipo_mov",campo.nombre_tipo_mov);
               setD("descrip_tipo_mov",campo.descrip_tipo_mov);
               setOption("status_tipo_mov",campo.status_tipo_mov);
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