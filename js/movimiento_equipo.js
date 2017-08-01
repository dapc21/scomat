function  cargar_form_movimiento_equipo(){
   $.ajax({
    type: "GET",
    url: "Formulario/movimiento_equipo.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_movimiento_equipo.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_movimiento_equipo(accion,clase){
         validardatos("gestion_movimiento_equipo",accion,clase)
}
function  gestion_movimiento_equipo(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_mov_e":getD("id_mov_e"),
                  "id_es":getD("id_es"),
                  "ubic_ant":getD("ubic_ant"),
                  "ubic_post":getD("ubic_post"),
                  "login":getD("login"),
                  "fecha":getD("fecha"),
                  "motivo":getD("motivo"),
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
               cargar_form_movimiento_equipo();
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
function  buscar_id_mov_e(id_mov_e){
   var parametros=[{
            "clase":"movimiento_equipo",
            "consulta":"select * from movimiento_equipo where id_mov_e='"+id_mov_e+"'"
         }]
   buscar_movimiento_equipo(parametros);
}
function  buscar_movimiento_equipo(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_movimiento_equipo(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_movimiento_equipo(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "movimiento_equipo":
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
            case "movimiento_equipo":
               setD("id_mov_e",campo.id_mov_e);
               setD("id_es",campo.id_es);
               setD("ubic_ant",campo.ubic_ant);
               setD("ubic_post",campo.ubic_post);
               setD("login",campo.login);
               setD("fecha",campo.fecha);
               setD("motivo",campo.motivo);
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