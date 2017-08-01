function  cargar_form_cuenta_bancaria(){
  log("entro a cargar cuenta_bancaria.")
   $.ajax({
    type: "GET",
    url: "Formulario/cuenta_bancaria.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_cuenta_bancaria.php","datagrid_cuenta_bancaria");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_cuenta_bancaria(accion,clase){
         validardatos("gestion_cuenta_bancaria",accion,clase)
} 
function  gestion_cuenta_bancaria(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_cuba":getD("id_cuba"),
                  "numero_cuba":getD("numero_cuba"),
                  "banco_cuba":getD("banco_cuba"),                  
                   "abrev_cuba":getD("abrev_cuba"),
                   "desc_cuba":getD("desc_cuba"),
                   "status_cuba":getOption("status_cuba"), 
                   "conc_cliente":getOption("conc_cliente"),   
                   "conc_franq":getOption("conc_franq"),
                   "formato_archivo":getOption("formato_archivo"),
                   "comision_pv":getD("comision_pv"),
                   "comision_pv_c":getD("comision_pv_c")                               
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
               cargar_form_cuenta_bancaria();
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
function  buscar_id_cuenta_bancaria(id_cuba){
   var parametros=[{
            "clase":"cuenta_bancaria",
            "consulta":"select * from cuenta_bancaria where id_cuba='"+id_cuba+"'"
         }]
   buscar_cuenta_bancaria(parametros);
}
function  buscar_cuenta_bancaria(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_cuenta_bancaria(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_cuenta_bancaria(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "cuenta_bancaria":
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
            case "cuenta_bancaria":

               setD("id_cuba",campo.id_cuba);               
               setD("numero_cuba",campo.numero_cuba);    
               setD("banco_cuba",campo.banco_cuba);           
               setD("abrev_cuba",campo.abrev_cuba);
               setD("desc_cuba",campo.desc_cuba);
               setOption("status_cuba",campo.status_cuba);
               setOption("conc_cliente",campo.conc_cliente);
               setOption("conc_franq",campo.conc_franq);
               setOption("formato_archivo",campo.formato_archivo);
               setD("comision_pv",campo.comision_pv);
               setD("comision_pv_c",campo.comision_pv_c);
               
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
