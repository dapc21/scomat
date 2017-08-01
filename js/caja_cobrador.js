// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function  cargar_form_caja_cobrador(){
   $.ajax({
    type: "GET",
    url: "Formulario/caja_cobrador.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     //listar_datos("procesos/datagrid_caja_cobrador.php","datagrid_caja_cobrador");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  cargar_form_cerrar_caja(){
   $.ajax({
    type: "GET",
    url: "Formulario/cerrar_caja.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);

      listar_datos("reportes/Rep_detallecobros.php?&id_caja_cob="+getD("id_caja_cob")+"&","datagrid");

     activar_validar_datos();
     //listar_datos("procesos/datagrid_caja_cobrador.php","datagrid_caja_cobrador");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_caja_cobrador(accion,clase){
         validardatos("gestion_caja_cobrador",accion,clase)
}
function  gestion_caja_cobrador(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_caja_cob":getD("id_caja_cob"),
                  "id_caja":getD("id_caja"),
                  "id_persona":getD("id_persona"),
        				  "fecha_caja":getD("fecha_caja"), 
        				  "apertura_caja":getD("apertura_caja"), 
        				  "cierre_caja":getD("cierre_caja"), 
        				  "monto_acum":getD("monto_acum"),
                  "status_caja":getD("status_caja"),
        				  "id_est":getD("id_est"),
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
            if( respuesta.success ){
              if(accion=="cerrar"){
                GuardarRep_detcob(getD("id_caja_cob"));
                cargar_form_caja_cobrador();
              }
              else if(accion=="aperturar"){
                cargar_form_pagos();
              }

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
function  buscar_id_caja_cob(id_caja_cob){
   var parametros=[{
            "clase":"caja_cobrador",
            "consulta":"select * from vista_caja where id_caja_cob='"+id_caja_cob+"'"
         }]
   buscar_caja_cobrador(parametros);
}
function  buscar_caja_cobrador(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_caja_cobrador(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_caja_cobrador(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "caja_cobrador":
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
            case "caja_cobrador":
               setD("id_caja_cob",campo.id_caja_cob);
               setD("id_caja",campo.id_caja);
               setD("id_persona",campo.id_persona);        
               setD("fecha_caja",campo.fecha_caja);  
			   setD("apertura_caja",campo.apertura_caja);
			   setD("cierre_caja",campo.cierre_caja);
               setD("monto_acum",campo.monto_acum);
               setD("status_caja",campo.status_caja);                  
			   setD("nombre",campo.nombre);   
               setD("nombre_est",campo.nombre_est);                 		  
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
function GuardarRep_detcob(id_caja_cob){
    location.href="reportepdf/Rep_detallecobrosImpreso.php?&id_caja_cob="+id_caja_cob+"&";
}