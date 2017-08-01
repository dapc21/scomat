// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function  cargar_form_municipio(){
   $.ajax({
    type: "GET",
    url: "Formulario/municipio.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_municipio.php","datagrid_municipio");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_municipio(accion,clase){
         validardatos("gestion_municipio",accion,clase)
}
function  gestion_municipio(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_mun":getD("id_mun"),
                  "id_esta":getD("id_esta"),
				          "nombre_mun":getD("nombre_mun"),
                  "status_mun":getOption("status_mun"),
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
               cargar_form_municipio();
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
function  buscar_id_mun(id_mun){
   var parametros=[{
            "clase":"municipio",
            "consulta":"select * from municipio where id_mun='"+id_mun+"'"
         }]
   buscar_municipio(parametros);
}
function  buscar_municipio(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_municipio(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_municipio(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "municipio":
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
            case "municipio":
               setD("id_mun",campo.id_mun);
               setD("id_esta",campo.id_esta);
               setD("nombre_mun",campo.nombre_mun);        
               setOption("status_mun",campo.status_mun);        
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
