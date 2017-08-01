function  cargar_form_perso(){
   $.ajax({
    type: "GET",
    url: "Formulario/perso.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_persona.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_persona(accion,clase){
         validardatos("gestion_persona",accion,clase)
}
function  gestion_persona(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_persona":getD("id_persona"),
                  "cedula":getD("cedula"),
                  "nombre":getD("nombre"),
                  "apellido":getD("apellido"),
                  "telefono":getD("telefono")
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
               cargar_form_perso();
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
function  buscar_cedula(){
   var parametros=[{
            "clase":"persona",
            "consulta":"select * from persona where id_persona='"+getD("cedulax")+"'"
         }]
   buscar_persona(parametros);
}
function  buscar_persona(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_persona(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_persona(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "persona":
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
            case "persona":
               setD("id_persona",campo.id_persona);
               setD("nombre",campo.nombre);
               setD("apellido",campo.apellido);
               setD("telefono",campo.telefono);
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


function  buscar_cedula_persona_global(){
   var parametros=[{
            "clase":"persona",
            "consulta":"select * from persona where cedula='"+getD("cedula")+"'"
         }]
   buscar_persona_global(parametros);
}

function buscar_persona_global(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
   })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var objetos=respuesta.objetos;
   		for (var objeto in objetos){
   			var clase=objetos[objeto].clase;
			var cantidad=objetos[objeto].cantidad;
			if(cantidad==1){
				var campo=objetos[objeto].data[0];
				switch(clase){
					case "persona":
						setD("id_persona",campo.id_persona);
						setD("cedula",campo.cedula);
						setD("nombre",campo.nombre);
						setD("apellido",campo.apellido);
					break;
					default:
						log( "no existe la clase: "+clase+" para asignar parametros");
				}
			}
   		}
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}