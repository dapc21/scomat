// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function cargar_form_tecnico(){
   $.ajax({
    type: "GET",
    url: "Formulario/tecnico.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_tecnico.php","datagrid_tecnico");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_tecnico(accion,clase){
         validardatos("gestion_tecnico",accion,clase)
}	
function  gestion_tecnico(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_persona":getD("id_persona"),
                  "cedula":getD("cedula"),
                  "nombre":getD("nombre"),
                  "apellido":getD("apellido"),
                  "telefono":getD("telefono"),
                  "num_tecnico":getD("num_tecnico"),                 
                  "direccion_tec":getD("direccion_tec"),                 
                  "correo_tec":getD("correo_tec"),                 
                  "status_tec":getOption("status_tec"),                 
                  "id_franq":getD("id_franq"),                 
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
               cargar_form_tecnico();
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
function  buscar_cedula_tecnico(){
   var parametros=[{
            "clase":"tecnico",
            "consulta":"select * from vista_tecnico where cedula='"+getD("cedula")+"'"
         }]
   buscar_tecnico(parametros);
}
function  buscar_id_tecnico(id){
	var parametros=[{
            "clase":"tecnico",
            "consulta":"select * from vista_tecnico where id_persona='"+id+"'"
         }]
   buscar_tecnico(parametros);
}

function  buscar_tecnico(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
	  log("llamado");
         asignar_tecnico1(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_tecnico1(respuesta){
log("asignar");
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "tecnico":
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
		log("cantidad");
         var campo=objetos[objeto].data[0];	
         switch(clase){
            case "tecnico":		
				log("entro");
               setD("id_persona",campo.id_persona);
               setD("cedula",campo.cedula);
               setD("nombre",campo.nombre);
               setD("apellido",campo.apellido);
               setD("num_tecnico",campo.num_tecnico);
               setD("direccion_tec",campo.direccion_tec);
               setOption("status_tec",campo.status_tec);
               setD("correo_tec",campo.correo_tec);
               setD("telefono",campo.telefono);
               setD("id_franq",campo.id_franq);
               setD("dato",campo.dato);
               disabled("registrar");
               enabled("modificar");
               enabled("eliminar");
			   log("salio");
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