// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function cargar_form_gerentes_permitidos(){
   $.ajax({
    type: "GET",
    url: "Formulario/gerentes_permitidos.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_gerentes_permitidos.php","datagrid_gerentes_permitidos");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_gerentes_permitidos(accion,clase){
         validardatos("gestion_gerentes_permitidos",accion,clase)
}
function  gestion_gerentes_permitidos(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_persona":getD("id_persona"),
				          "cedula":getD("cedula"),
                  "nombre":getD("nombre"),
                  "apellido":getD("apellido"),
                  "telefono":getD("telefono"),
                  "nro_gerente":getD("nro_gerente"),
                  "tipo_gerente":getD("tipo_gerente"),
                  "cargo_gerente":getD("cargo_gerente"),
                  "descrip_gerente":getD("descrip_gerente"),
                  "sattus_gerente":getOption("sattus_gerente"),                 
                  "correo_gerente":getD("correo_gerente"),           
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
               cargar_form_gerentes_permitidos();
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
function  buscar_cedula_gerentes_permitidos(){
   var parametros=[{
            "clase":"gerentes_permitidos",
            "consulta":"select * from vista_gerentes where cedula='"+getD("cedula")+"'"
         }]
   buscar_gerentes_permitidos(parametros);
}
function  buscar_id_gerentes_permitidos(id){
   var parametros=[{
            "clase":"gerentes_permitidos",
            "consulta":"select * from vista_gerentes where id_persona='"+id+"'"
         }]
   buscar_gerentes_permitidos(parametros);
}

function  buscar_gerentes_permitidos(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_gerentes_permitidos(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_gerentes_permitidos(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "gerentes_permitidos":
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
            case "gerentes_permitidos":
               setD("id_persona",campo.id_persona);
               setD("cedula",campo.cedula);
               setD("nombre",campo.nombre);
               setD("apellido",campo.apellido);               
               setD("telefono",campo.telefono);
               setD("nro_gerente",campo.nro_gerente);
               setD("tipo_gerente",campo.tipo_gerente);
               setD("cargo_gerente",campo.cargo_gerente);
               setD("descrip_gerente",campo.descrip_gerente);
			   setOption("sattus_gerente",campo.sattus_gerente); 
               setD("correo_gerente",campo.correo_gerente);
               setD("id_franq",campo.id_franq);
              // setD("dato",campo.codcob);
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