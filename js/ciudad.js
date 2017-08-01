// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function  cargar_form_ciudad(){
   $.ajax({
    type: "GET",
    url: "Formulario/ciudad.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_ciudad.php","datagrid_ciudad");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_ciudad(accion,clase){
         validardatos("gestion_ciudad",accion,clase)
}
function  gestion_ciudad(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_ciudad":getD("id_ciudad"),
                  "id_mun":getD("id_mun"),
				  "nombre_ciudad":getD("nombre_ciudad"),
                  "status_ciudad":getOption("status_ciudad"),                                                                                                           
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
               cargar_form_ciudad();
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
function  buscar_id_ciudad(id_ciudad){
   var parametros=[{
            "clase":"ciudad",
            "consulta":"select * from vista_ciudad where id_ciudad='"+id_ciudad+"'"
         }]
   buscar_ciudad(parametros);
}
function  buscar_nombre_ciudad(){
   var parametros=[{
            "clase":"ciudad",
            "consulta":"select * from vista_ciudad where nombre_esta='"+getD("nombre_ciudad")+"'"
         }]
   buscar_ciudad(parametros);
}
function  buscar_ciudad(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_ciudad(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_ciudad(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "ciudad":
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
            case "ciudad":
               setD("id_ciudad",campo.id_ciudad);
               setD("id_mun",campo.id_mun);
               setD("nombre_ciudad",campo.nombre_ciudad);        
               setOption("status_ciudad",campo.status_ciudad);  
			   setD("id_esta",campo.id_esta); 
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
