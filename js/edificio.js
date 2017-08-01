// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function  cargar_form_edificio(){
   $.ajax({
    type: "GET",
    url: "Formulario/edificio.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_edificio.php","datagrid_edificio");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  agregar_edif_ext(accion,clase){
         validardatos_f3("agrega_edif",accion,clase)
}
function  agrega_edif(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_edif":getD("id_edif_add"),
                  "id_sector":getD("id_sector"),
                  "edificio":getD("edificio") 
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
              $('#id_edif').append(new Option(getD("edificio"),getD("id_edif_add"), true, true));
              setD("id_edif",getD("id_edif_add"));
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
function  gestionar_edificio(accion,clase){
         validardatos("gestion_edificio",accion,clase)
}
function  gestion_edificio(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_edif":getD("id_edif"),
                  "edificio":getD("edificio"),
                  "id_sector":getD("id_sector")       
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
               cargar_form_edificio();
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
function  buscar_id_edif(id_edif){
   var parametros=[{
            "clase":"edificio",
            "consulta":"select * from vista_edificio where id_edif='"+id_edif+"'"
         }]
   buscar_edificio(parametros);
}
function  buscar_nombre_edificio(){
   var parametros=[{
            "clase":"edificio",
            "consulta":"select * from vista_edificio where edificio='"+getD("edificio")+"'"
         }]
   buscar_edificio(parametros);
}
function  buscar_edificio(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_edificio(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_edificio(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "edificio":
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
            case "edificio":
               setD("id_edif",campo.id_edif);
               setD("edificio",campo.edificio);
               setD("id_sector",campo.id_sector);                 
      			   setD("id_esta",campo.id_esta);
               setD("id_mun",campo.id_mun);
               setD("id_ciudad",campo.id_ciudad);
               setD("id_zona",campo.id_zona);                		                 		   
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