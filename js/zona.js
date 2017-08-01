// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function  cargar_form_zona(){
   $.ajax({
    type: "GET",
    url: "Formulario/zona.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_zona.php","datagrid_zona");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  agregar_zona_ext(accion,clase){
         validardatos_f3("agrega_zona",accion,clase)
}
function  agrega_zona(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_zona":getD("id_zona_add"),
                  "nro_zona":"0",
                  "id_ciudad":getD("id_ciudad"),
                  "nombre_zona":getD("nombre_zona") 
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
              $('#id_zona').append(new Option(getD("nombre_zona"),getD("id_zona_add"), true, true));
              setD("id_zona",getD("id_zona_add"));
              cerrar_ventana_externa();
            }else {
               alerta("ERROR DURANTE TRANSACCION\n"+respuesta.error);
            }
         })
         .fail(function( jqXHR, textStatus, errorThrown ) {
            ventaG.close();
               alerta("ERROR DURANTE TRANSACCION\nError: "+textStatus);
         });
}
function  gestionar_zona(accion,clase){
         validardatos("gestion_zona",accion,clase)
}
function  gestion_zona(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_zona":getD("id_zona"),
                  "nro_zona":getD("nro_zona"),
                  "id_ciudad":getD("id_ciudad"),
                  "nombre_zona":getD("nombre_zona"), 
                  "n_zona":getD("n_zona")                 
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
               cargar_form_zona();
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
function  gestion_zona_externo(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_zona":getD("id_zona"),
                  "nro_zona":getD("nro_zona"),
                  "id_ciudad":getD("id_ciudad"),
				  "nombre_zona":getD("nombre_zona"), 
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
               cargar_form_zona();
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
function  buscar_id_zona(id_zona){
   var parametros=[{
            "clase":"zona",
            "consulta":"select * from vista_zona1 where id_zona='"+id_zona+"'"
         }]
   buscar_zona(parametros);
}
function  buscar_nombre_zona(){
   var parametros=[{
            "clase":"zona",
            "consulta":"select * from vista_zona1 where nombre_zona='"+getD("nombre_zona")+"'"
         }]
   buscar_zona(parametros);
}
function  buscar_zona(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_zona(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_zona(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "zona":
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
            case "zona":
               setD("id_zona",campo.id_zona);
               setD("nro_zona",campo.nro_zona);
               setD("id_ciudad",campo.id_ciudad);        
               setD("nombre_zona",campo.nombre_zona);                              
               setD("id_mun",campo.id_mun);
               setD("id_esta",campo.id_esta);
               setD("n_zona",campo.n_zona);			   
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
