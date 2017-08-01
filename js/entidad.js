function  cargar_form_entidad(){
  log("entro a cargar entidad.")
   $.ajax({
    type: "GET",
    url: "Formulario/entidad.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_entidad.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_entidad(accion,clase){
         validardatos("gestion_entidad",accion,clase)
}
function  gestion_entidad(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_te":getD("id_te"),
                  "id_persona":getD("id_persona"),
				          "cedula":getD("cedula"),
                  "nombre":getD("nombre"),
                  "apellido":getD("apellido"),
                  "telefono":getD("telefono"),
                  "descrip_ent":getD("descrip_ent"),
				          "status_ent":getOption("status_ent")
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
               cargar_form_entidad();
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
function  buscar_id_te(id){
   var parametros=[{
            "clase":"entidad",
            "consulta":"select * from vista_entidad where id_persona='"+id+"'"
         }]
   buscar_entidad(parametros);
}
function  buscar_entidad(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_entidad(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_entidad(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "entidad":
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
            case "entidad":
               setD("id_te",campo.id_te);
               setD("id_persona",campo.id_persona);
			   setD("cedula",campo.cedula);
               setD("nombre",campo.nombre);
               setD("apellido",campo.apellido);
               setD("telefono",campo.telefono);
               setD("descrip_ent",campo.descrip_ent);
			   setOption("status_ent",campo.status_ent);
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
