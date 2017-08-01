// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function  cargar_form_calle(){
   $.ajax({
    type: "GET",
    url: "Formulario/calle.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_calle.php","datagrid_calle");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  agregar_calle_ext(accion,clase){
         validardatos_f3("agrega_calle",accion,clase)
}
function  agrega_calle(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_calle":getD("id_calle_add"),
                  "nro_calle":"0",
                  "id_sector":getD("id_sector"),
                  "nombre_calle":getD("nombre_calle") 
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
              $('#id_calle').append(new Option(getD("nombre_calle"),getD("id_calle_add"), true, true));
              setD("id_calle",getD("id_calle_add"));
              cerrar_ventana_externa();
            }else {
               alerta("ERROR DURANTE TRANSACCION\n"+respuesta.error);
            }
         })
         .fail(function( jqXHR, textStatus, errorThrown ) {
            ventaG.close();
               alerta("ERROR DURANTE TRANSACCION\nError: "+textStatus);
         });
}
function  gestionar_calle(accion,clase){
         validardatos("gestion_calle",accion,clase)
}
function  gestion_calle(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_calle":getD("id_calle"),
                  "nro_calle":getD("nro_calle"),
                  "id_sector":getD("id_sector"),
				          "nombre_calle":getD("nombre_calle"), 
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
               cargar_form_calle();
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
function  buscar_id_calle(id_calle){
   var parametros=[{
            "clase":"calle",
            "consulta":"select * from vista_calle1 where id_calle='"+id_calle+"'"
         }]
   buscar_calle(parametros);
}
function  buscar_nombre_calle(){
   var parametros=[{
            "clase":"calle",
            "consulta":"select * from vista_calle1 where nombre_calle='"+getD("nombre_calle")+"'"
         }]
   buscar_calle(parametros);
}
function  buscar_calle(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_calle(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_calle(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "calle":
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
            case "calle":
               setD("id_calle",campo.id_calle);
               setD("nro_calle",campo.nro_calle);
               setD("id_sector",campo.id_sector);        
               setD("nombre_calle",campo.nombre_calle);  
      			   setD("id_esta",campo.id_esta);
               setD("id_mun",campo.id_mun);
               setD("id_ciudad",campo.id_ciudad);
               setD("id_zona",campo.id_zona);                             
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