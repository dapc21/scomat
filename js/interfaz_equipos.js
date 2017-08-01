function  cargar_form_interfaz_equipos(){
   $.ajax({
    type: "GET",
    url: "Formulario/interfaz_equipos.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     $("#codigo_es").select();
     activar_validar_datos();
     listar_datos("procesos/datagrid_interfaz_equipos.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_interfaz_equipos(accion,clase){
         validardatos("gestion_interfaz_equipos",accion,clase)
}
function  gestion_interfaz_equipos(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_inte":getD("id_inte"),
                  "id_com_int":getD("id_com_int"),
                  "id_es":getD("id_es")
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
               cargar_form_interfaz_equipos();
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
function  buscar_id_inte(id_inte){
   var parametros=[{
            "clase":"interfaz_equipos",
            "consulta":"select * from interfaz_equipos where id_inte='"+id_inte+"'"
         }]
   buscar_interfaz_equipos(parametros);
}
function  buscar_interfaz_equipos(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_interfaz_equipos(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_interfaz_equipos(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "interfaz_equipos":
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
            case "interfaz_equipos":
               setD("id_inte",campo.id_inte);
               setD("id_com_int",campo.id_com_int);
               setD("id_es",campo.id_es);
               setD("status",campo.status);
               setD("fecha",campo.fecha);
               setD("login",campo.login);
               setD("errmsg",campo.errmsg);
               setD("cad_env",campo.cad_env);
               setD("cad_rec",campo.cad_rec);
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

function cargar_comandos_interfaz(){
  $.ajax({
     data: {
      "parametros":JSON.stringify({
      "clase":"cargar_comandos_interfaz",
      "datos":{"id_tse":getD("id_tse")}
    })
  },
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        setHTML("id_com_int",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function traer_comandos_interfaz(){
  $.ajax({
     data: {
      "parametros":JSON.stringify({
      "clase":"traer_comandos_interfaz",
      "datos":{"id_com_int":getD("id_com_int")}
    })
  },
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        setD("id_tse",respuesta.campo.id_tse);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}