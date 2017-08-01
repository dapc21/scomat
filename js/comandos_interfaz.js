function  cargar_form_comandos_interfaz(){
   $.ajax({
    type: "GET",
    url: "Formulario/comandos_interfaz.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_comandos_interfaz.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_comandos_interfaz(accion,clase){
         validardatos("gestion_comandos_interfaz",accion,clase)
}
function  gestion_comandos_interfaz(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_com_int":getD("id_com_int"),
                  "id_tse":getD("id_tse"),
                  "nombre_com_int":getD("nombre_com_int"),
                  "tipo_com":getD("tipo_com"),
                  "status_com_int":getOption("status_com_int"),
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
               cargar_form_comandos_interfaz();
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
function  buscar_id_com_int(id_com_int){
   var parametros=[{
            "clase":"comandos_interfaz",
            "consulta":"select * from comandos_interfaz where id_com_int='"+id_com_int+"'"
         }]
   buscar_comandos_interfaz(parametros);
}
function  buscar_comandos_interfaz(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_comandos_interfaz(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_comandos_interfaz(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "comandos_interfaz":
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
            case "comandos_interfaz":
               setD("id_com_int",campo.id_com_int);
               setD("id_tse",campo.id_tse);
               setD("nombre_com_int",campo.nombre_com_int);
               setD("tipo_com",campo.tipo_com);
               setOption("status_com_int",campo.status_com_int);
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