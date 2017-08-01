// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function cargar_form_cobrador(){
   $.ajax({
    type: "GET",
    url: "Formulario/cobrador.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_cobrador.php","datagrid_cobrador");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_cobrador(accion,clase){
         validardatos("gestion_cobrador",accion,clase)
}
			
function  gestion_cobrador(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_persona":getD("id_persona"),
                  "cedula":getD("cedula"),
                  "nombre":getD("nombre"),
                  "apellido":getD("apellido"),
                  "telefono":getD("telefono"),
                  "nro_cobrador":getD("nro_cobrador"),                 
                  "direccion_cob":getD("direccion_cob"),           
                  "id_franq":getD("id_franq"),                 
                  "dato":getD("dato")                 
               }
         }];
         $.ajax({
           data: parametros,
           type: "POST",
           dataType: "json",
           url: "controlador.php",
         })
         .done(function( respuesta, textStatus, jqXHR ){
            ventaG.close();
            if( respuesta.success ) {
               cargar_form_cobrador();
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
function  buscar_cedula_cobrador(){
   var parametros=[{
            "clase":"cobrador",
            "consulta":"select * from vista_cobrador where cedula='"+getD("cedula")+"'"
         }]
   buscar_cobrador(parametros);
}
function  buscar_id_cobrador(id){
   var parametros=[{
            "clase":"cobrador",
            "consulta":"select * from vista_cobrador where id_persona='"+id+"'"
         }]
   buscar_cobrador(parametros);
}

function  buscar_cobrador(parametros){
   $.ajax({
     data: parametros,
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_cobrador(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_cobrador(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "cobrador":
               enabled("registrar");
               disabled("modificar");
               disabled("eliminar");
               buscar_cedula_persona_global()
               break;
            default:
            log( "no existe la clase: "+clase+" para asignar parametros");
         }
      }
      else if(cantidad==1){
         var campo=objetos[objeto].data[0];
         switch(clase){
            case "cobrador":


            
               setD("id_persona",campo.id_persona);
               setD("cedula",campo.cedula);
               setD("nombre",campo.nombre);
               setD("apellido",campo.apellido);
               setD("nro_cobrador",campo.nro_cobrador);
               setD("direccion_cob",campo.direccion_cob);
               setD("telefono",campo.telefono);
               setD("id_franq",campo.id_franq);
               setD("dato",campo.codcob);
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