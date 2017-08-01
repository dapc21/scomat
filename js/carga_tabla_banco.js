function  cargar_form_carga_tabla_banco(){
  log("entro a cargar carga_tabla_banco.")
   $.ajax({
    type: "GET",
    url: "Formulario/carga_tabla_banco.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_carga_tabla_banco.php","datagrid_carga_tabla_banco");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_carga_tabla_banco(accion,clase){
         validardatos("gestion_carga_tabla_banco",accion,clase)
} 
function  gestion_carga_tabla_banco(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_ctb":getD("id_ctb"),
                  "id_cuba":getD("id_cuba"),
                  "fecha_ctb":getD("fecha_ctb"),
                  "hora_ctb":getD("hora_ctb"),
                  "login_ctb":getD("login_ctb"),
                  "fecha_desde_ctb":getD("fecha_desde_ctb"),
                  "fecha_hasta_ctb":getD("fecha_hasta_ctb"),
                  "status_ctb":getD("status_ctb"),
                  "formato_ctb":getD("formato_ctb")                 
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
               cargar_form_carga_tabla_banco();
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
function  buscar_id_carga_tabla_banco(id_ctb){
   var parametros=[{
            "clase":"carga_tabla_banco",
            "consulta":"select * from carga_tabla_banco where id_ctb='"+id_ctb+"'"
         }]
   buscar_carga_tabla_banco(parametros);
}
function  buscar_carga_tabla_banco(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_carga_tabla_banco(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_carga_tabla_banco(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "carga_tabla_banco":
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
            case "carga_tabla_banco":
               setD("id_ctb",campo.id_ctb);
               setD("id_cuba",campo.id_cuba);
               setD("fecha_ctb",formatdatei(campo.fecha_ctb));
               setD("hora_ctb",campo.hora_ctb);               
               setD("login_ctb",campo.login_ctb);
               setD("fecha_desde_ctb",formatdatei(campo.fecha_desde_ctb));
               setD("fecha_hasta_ctb",formatdatei(campo.fecha_hasta_ctb));
               setOption("status_ctb",campo.status_ctb);              
               setOption("formato_ctb",campo.formato_ctb);               
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
function cargar_tabla_banco(){
      creaVenta("Formulario/cargar_archivo_banco.php?id_ctb="+id_ctb()+"&",600,400);
    
}

function cerrarVenCarga_archivo(){
  document.f1.excel.value="Archivo Cargado...";
  parent.dhxWins.window("w2").close();
}