// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function  cargar_form_franquicia(){
   $.ajax({
    type: "GET",
    url: "Formulario/franquicia.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_franquicia.php","datagrid_franquicia");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_franquicia(accion,clase){
         validardatos("gestion_franquicia",accion,clase)
}
			
function  gestion_franquicia(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_franq":getD("id_franq"),
                  "nombre_franq":getD("nombre_franq"),
                  "obser_franq":getD("obser_franq"),
                  "id_gf":getD("id_gf"),
                  "id_emp":getD("id_emp"),
                  "direccion_franq":getD("direccion_franq"),                 
                  "serie":getD("serie")                 
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
               cargar_form_franquicia();
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
function  buscar_id_franq(id_franq){
   var parametros=[{
            "clase":"franquicia",
            "consulta":"select * from franquicia where id_franq='"+id_franq+"'"
         }]
   buscar_franquicia(parametros);
}
function  buscar_nombre_franq(){
   var parametros=[{
            "clase":"franquicia",
            "consulta":"select * from franquicia where nombre_franq='"+getD("nombre_franq")+"'"
         }]
   buscar_franquicia(parametros);
}
function  buscar_franquicia(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_franquicia(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_franquicia(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "franquicia":
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
            case "franquicia":
               setD("id_franq",campo.id_franq);
               setD("nombre_franq",campo.nombre_franq);
               setD("obser_franq",campo.obser_franq);
               setD("id_gf",campo.id_gf);
               setD("id_emp",campo.id_emp);
               setD("direccion_franq",campo.direccion_franq);
               setD("serie",campo.serie);
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