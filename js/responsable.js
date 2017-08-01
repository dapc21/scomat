function  cargar_form_responsable(){
   $.ajax({
    type: "GET",
    url: "Formulario/responsable.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_responsable.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_responsable(accion,clase){
         validardatos("gestion_responsable",accion,clase)
}
function  gestion_responsable(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_res":getD("id_res"),
                  "id_persona":getD("id_persona"),
                  "cedula":getD("cedula"),
                  "nombre":getD("nombre"),
                  "apellido":getD("apellido"),
                  "id_tipo_res":getD("id_tipo_res"),
                  "descrip_res":getD("descrip_res"),
                  "status_res":getOption("status_res")
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
               cargar_form_responsable();
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
function  buscar_cedula_responsable(){
   var parametros=[{
            "clase":"responsable",
            "consulta":"select * from vista_responsable where cedula='"+getD("cedula")+"' and id_estatus_reg = 1"
         }]
   buscar_responsable(parametros);
}
function  buscar_id_res(id_persona){
   var parametros=[{
            "clase":"responsable",
            "consulta":"select * from vista_responsable where id_persona='"+id_persona+"' and id_estatus_reg = 1"
         }]
   buscar_responsable(parametros);
}
function  buscar_responsable(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_responsable(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_responsable(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "responsable":
               enabled("registrar");
               disabled("modificar");
               disabled("eliminar");
			   buscar_cedula_persona_global();
               break;
            default:
            log( "no existe la clase: "+clase+" para asignar parametros");
         }
      }	 	  
      else if(cantidad==1){
         var campo=objetos[objeto].data[0];
         switch(clase){
            case "responsable":
               setD("id_res",campo.id_res);
			   setD("id_persona",campo.id_persona);
               setD("cedula",campo.cedula);
               setD("nombre",campo.nombre);
               setD("apellido",campo.apellido);
               setD("id_tipo_res",campo.id_tipo_res);
               setD("descrip_res",campo.descrip_res);
               setOption("status_res",campo.status_res);
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