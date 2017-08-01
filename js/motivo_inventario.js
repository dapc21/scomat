function  cargar_form_motivo_inventario(){
   $.ajax({
    type: "GET",
    url: "Formulario/motivo_inventario.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_motivo_inventario.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_motivo_inventario(accion,clase){
         validardatos("gestion_motivo_inventario",accion,clase)
}
function  gestion_motivo_inventario(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_mot_inv":getD("id_mot_inv"),
                  "nombre_mot_inv":getD("nombre_mot_inv"),
                  "status_mot_inv":getOption("status_mot_inv")
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
               cargar_form_motivo_inventario();
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
function  buscar_id_mot_inv(id_mot_inv){
   var parametros=[{
            "clase":"motivo_inventario",
            "consulta":"select * from motivo_inventario where id_mot_inv='"+id_mot_inv+"' and id_estatus_reg = 1"
         }]
   buscar_motivo_inventario(parametros);
}
function  buscar_motivo_inventario(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_motivo_inventario(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_motivo_inventario(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "motivo_inventario":
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
            case "motivo_inventario":
               setD("id_mot_inv",campo.id_mot_inv);
               setD("nombre_mot_inv",campo.nombre_mot_inv);
               setOption("status_mot_inv",campo.status_mot_inv);
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