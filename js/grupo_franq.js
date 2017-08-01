function  cargar_form_grupo_franq(){
   $.ajax({
    type: "GET",
    url: "Formulario/grupo_franq.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_grupo_franq.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_grupo_franq(accion,clase){
         validardatos("gestion_grupo_franq",accion,clase)
}
function  gestion_grupo_franq(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_gf":getD("id_gf"),
                  "nombre_gf":getD("nombre_gf"),
                  "desc_gf":getD("desc_gf"),
                  "status_gf":getOption("status_gf"),
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
               cargar_form_grupo_franq();
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
function  buscar_id_gf(id_gf){
   var parametros=[{
            "clase":"grupo_franq",
            "consulta":"select * from grupo_franq where id_gf='"+id_gf+"'"
         }]
   buscar_grupo_franq(parametros);
}
function  buscar_grupo_franq(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_grupo_franq(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_grupo_franq(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "grupo_franq":
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
            case "grupo_franq":
               setD("id_gf",campo.id_gf);
               setD("nombre_gf",campo.nombre_gf);
               setD("desc_gf",campo.desc_gf);
               setOption("status_gf",campo.status_gf);
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