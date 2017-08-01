function  cargar_form_soporte_pago(){
   $.ajax({
    type: "GET",
    url: "Formulario/soporte_pago.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_soporte_pago.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_soporte_pago(accion,clase){
         validardatos("gestion_soporte_pago",accion,clase)
}
function  gestion_soporte_pago(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_pd":getD("id_pd"),
                  "id_cuba":getD("id_cuba"),
                  "id_contrato":getD("id_contrato"),
                  "monto_dep":getD("monto_dep"),
                  "fecha_reg":getD("fecha_reg"),
                  "fecha_dep":getD("fecha_dep"),
                  "numero_ref":getD("numero_ref"),
                  "status_pd":getD("status_pd"),
                  "tipo_dt":getOption("tipo_dt"),
                  "telefono":getD("telefono"),
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
               cargar_form_soporte_pago();
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
function  buscar_id_pd(id_pd){
   var parametros=[{
            "clase":"soporte_pago",
            "consulta":"select * from soporte_pago where id_pd='"+id_pd+"'"
         }]
   buscar_soporte_pago(parametros);
}
function  buscar_soporte_pago(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_soporte_pago(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_soporte_pago(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "soporte_pago":
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
            case "soporte_pago":
               setD("id_pd",campo.id_pd);
               setD("id_cuba",campo.id_cuba);
               setD("id_contrato",campo.id_contrato);
               setD("monto_dep",campo.monto_dep);
               setD("fecha_reg",campo.fecha_reg);
               setD("fecha_dep",campo.fecha_dep);
               setD("numero_ref",campo.numero_ref);
               setD("status_pd",campo.status_pd);
               setOption("tipo_dt",campo.tipo_dt);
               setD("telefono",campo.telefono);
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