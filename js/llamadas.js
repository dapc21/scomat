function  cargar_form_llamadas(){
  log("entro a cargar llamadas.")
   $.ajax({
    type: "GET",
    url: "Formulario/llamadas.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     claseGlobal='llamadas';
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_llamadas.php","datagrid_llamadas");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_llamadas(accion,clase){
         validardatos("gestion_llamadas",accion,clase)
}
function  gestion_llamadas(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_lla":getD("id_lla"),
                  "id_drl":getD("id_drl"),
                  "id_tll":getD("id_tll"),
                  "id_contrato":getD("id_contrato"),
                  "fecha_lla":getD("fecha_lla"),
                  "hora_lla":getD("hora_lla"),
                  "login":getD("login"),
                  "obser_lla":getD("obser_lla"),                   
                  "crea_alarma":getOption("crea_alarma"),                 
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
               cargar_form_llamadas();
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
function  buscar_id_lla(id_lla){
   var parametros=[{
            "clase":"llamadas",
            "consulta":"select * from vista_llamadas where id_lla='"+id_lla+"'"
         }]
   buscar_llamadas(parametros);
}
function  buscar_llamadas(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_llamadas(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_llamadas(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "llamadas":
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
            case "llamadas":
               setD("id_lla",campo.id_lla);
               setD("id_drl",campo.id_drl);
               setD("id_tll",campo.id_tll);
               setD("id_contrato",campo.id_contrato);
               setD("fecha_lla",formatdatei(campo.fecha_lla));
               setD("hora_lla",campo.hora_lla);
               setD("login",campo.login);
               setD("obser_lla",campo.obser_lla);
               setOption("crea_alarma",campo.crea_alarma);               
               setD("dato",campo.dato);
               
               setD("id_trl",campo.id_trl);
               
               setD("nro_contrato",campo.nro_contrato); 
               setD("cedula_b",campo.cedula);  
               setD("nombre",campo.nombre);  
               setD("apellido",campo.apellido);  
               setD("status_contrato",campo.status_contrato);  
                                             
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
function cargar_detalle_resp(){
  $.ajax({data:{
      "parametros":JSON.stringify({
        "clase":"cargar_detalle_resp",
        "datos":{"id_trl":getD("id_trl")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        setHTML("id_drl",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function traer_tipo_resp(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traer_tipo_resp",
      "datos":{"id_drl":getD("id_drl")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        setD("id_trl",respuesta.campo.id_trl);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

