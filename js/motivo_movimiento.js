function  cargar_form_motivo_movimiento(){
   $.ajax({
    type: "GET",
    url: "Formulario/motivo_movimiento.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_motivo_movimiento.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_motivo_movimiento(accion,clase){
         validardatos("gestion_motivo_movimiento",accion,clase)
}
function  gestion_motivo_movimiento(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_mot_mov":getD("id_mot_mov"),
                  "nombre_mot_mov":getD("nombre_mot_mov"),
                  "status_mot_mov":getOption("status_mot_mov"),
                  "id_tipo_mov":getD("id_tipo_mov")
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
               cargar_form_motivo_movimiento();
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
function  buscar_id_mot_mov(id_mot_mov){
   var parametros=[{
            "clase":"motivo_movimiento",
            "consulta":"select * from vista_motivo_movimiento where id_mot_mov='"+id_mot_mov+"' and id_estatus_reg = 1"
         }]
   buscar_motivo_movimiento(parametros);
}
function  buscar_motivo_movimiento(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_motivo_movimiento(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_motivo_movimiento(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "motivo_movimiento":
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
            case "motivo_movimiento":
               setD("id_mot_mov",campo.id_mot_mov);
               setD("nombre_mot_mov",campo.nombre_mot_mov);
               setOption("status_mot_mov",campo.status_mot_mov);
			   setD("id_tipo_mov",campo.id_tipo_mov);
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