function  cargar_form_almacen(){
   $.ajax({
    type: "GET",
    url: "Formulario/almacen.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_almacen.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_almacen(accion,clase){
         validardatos("gestion_almacen",accion,clase)
}
function  gestion_almacen(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_alm":getD("id_alm"),
                  "id_gt":getD("id_gt"),
                  "id_enc":getD("id_enc"),
                  "codigo_alm":getD("codigo_alm"),
                  "nombre_alm":getD("nombre_alm"),
                  "direccion_alm":getD("direccion_alm"),
                  "descrip_alm":getD("descrip_alm"),
                  "status_alm":getOption("status_alm")
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
               cargar_form_almacen();
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
function  buscar_id_alm(id_alm){
   var parametros=[{
            "clase":"almacen",
            "consulta":"select * from vista_almacen where id_alm='"+id_alm+"' and id_estatus_reg = 1"
         }]
   buscar_almacen(parametros);
}
function  buscar_almacen(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_almacen(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_almacen(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "almacen":
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
            case "almacen":
               setD("id_alm",campo.id_alm);
               setD("id_gt",campo.id_gt);
               setD("id_enc",campo.id_enc);
               setD("codigo_alm",campo.codigo_alm);
               setD("nombre_alm",campo.nombre_alm);
               setD("direccion_alm",campo.direccion_alm);
               setD("descrip_alm",campo.descrip_alm);
               setOption("status_alm",campo.status_alm);
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