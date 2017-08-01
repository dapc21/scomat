// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function  cargar_form_urbanizacion(){
   $.ajax({
    type: "GET",
    url: "Formulario/urbanizacion.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_urbanizacion.php","datagrid_urbanizacion");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  agregar_urb_ext(accion,clase){
         validardatos_f3("agrega_urb",accion,clase)
}
function  agrega_urb(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_urb":getD("id_urb_add"),
                  "id_sector":getD("id_sector"),
                  "nombre_urb":getD("nombre_urb") 
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
              $('#id_urb').append(new Option(getD("nombre_urb"),getD("id_urb_add"), true, true));
              setD("id_urb",getD("id_urb_add"));
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
function  gestionar_urbanizacion(accion,clase){
         validardatos("gestion_urbanizacion",accion,clase)
}
function  gestion_urbanizacion(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_urb":getD("id_urb"),
                  "id_sector":getD("id_sector"),
                  "nombre_urb":getD("nombre_urb"),				 
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
               cargar_form_urbanizacion();
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
function  buscar_id_urb(id_urb){
   var parametros=[{
            "clase":"urbanizacion",
            "consulta":"select * from vista_urb where id_urb='"+id_urb+"'"
         }]
   buscar_urbanizacion(parametros);
}
function  buscar_nombre_urb(){
   var parametros=[{
            "clase":"urbanizacion",
            "consulta":"select * from vista_urb where nombre_urb='"+getD("nombre_urb")+"'"
         }]
   buscar_urbanizacion(parametros);
}
function  buscar_urbanizacion(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_urb(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_urb(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "urbanizacion":
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
            case "urbanizacion":
               setD("id_urb",campo.id_urb);
               setD("id_sector",campo.id_sector);
               setD("nombre_urb",campo.nombre_urb);                            
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