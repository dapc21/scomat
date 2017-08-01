// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function cargar_form_vendedor(){
   $.ajax({
    type: "GET",
    url: "Formulario/vendedor.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_vendedor.php","datagrid_vendedor");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_vendedor(accion,clase){
         validardatos("gestion_vendedor",accion,clase)
}
			
function  gestion_vendedor(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_persona":getD("id_persona"),
                  "cedula":getD("cedula"),
                  "nombre":getD("nombre"),
                  "apellido":getD("apellido"),
                  "telefono":getD("telefono"),
                  "nro_vendedor":getD("nro_vendedor"),                 
                  "direccion_ven":getD("direccion_ven"),           
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
               cargar_form_vendedor();
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
function  buscar_cedula_vendedor(){
   var parametros=[{
            "clase":"vendedor",
            "consulta":"select * from vista_vendedor where cedula='"+getD("cedula")+"'"
         }]
   buscar_vendedor(parametros);
}
function  buscar_cedula_persona(){
   var parametros=[{
            "clase":"persona",
            "consulta":"select * from persona where cedula='"+getD("cedula")+"'"
         }]
   buscar_vendedor(parametros);
}
function  buscar_id_vendedor(id){
   var parametros=[{
            "clase":"vendedor",
            "consulta":"select * from vista_vendedor where id_persona='"+id+"'"
         }]
   buscar_vendedor(parametros);
}

function  buscar_vendedor(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_vendedor(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_vendedor(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "vendedor":
               enabled("registrar");
               disabled("modificar");
               disabled("eliminar");
               //buscar_cedula_persona_global()
               break;
            case "persona":
               setD("id_persona",getD("id_persona_g"));
               setD("nombre","");
               setD("apellido","");
               setD("telefono","");
               break;
            default:
            log( "no existe la clase: "+clase+" para asignar parametros");
         }
      }
      else if(cantidad==1){
         var campo=objetos[objeto].data[0];
         switch(clase){
            case "vendedor":
               setD("id_persona",campo.id_persona);
               setD("cedula",campo.cedula);
               setD("nombre",campo.nombre);
               setD("apellido",campo.apellido);
               setD("nro_vendedor",campo.nro_vendedor);
               setD("direccion_ven",campo.direccion_ven);
               setD("telefono",campo.telefono);
               setD("id_franq",campo.id_franq);
              // setD("dato",campo.codcob);
               disabled("registrar");
               enabled("modificar");
               enabled("eliminar");
               break;
            case "persona":
               setD("id_persona",campo.id_persona);
               setD("cedula",campo.cedula);
               setD("nombre",campo.nombre);
               setD("apellido",campo.apellido);
               setD("telefono",campo.telefono);
               
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