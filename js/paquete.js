/*LLAMADO A CARGAR FOMULARIO*/
function  cargar_form_paquete(){
   $.ajax({
    type: "GET",/*comunicacion a traves de ajax tipo GET*/
    url: "Formulario/paquete.php",/*ruta donde se encuentra en formulario*/
   })
   .done(function( respuesta, textStatus, jqXHR ){/* llamado una vez procesado la peticion positiva*/
     $("#principal").html(respuesta);/*div donde se va cargar el formulario*/
     activar_validar_datos(); /* llamado a activar las validacion con parsley*/
     listar_datos("procesos/datagrid_paquete.php?id_pago="+getD("id_pago"),"datagrid","","ejecutar_funcion()"); /* llamado a cargar el listado*/
  })
   .fail(function( jqXHR, textStatus, errorThrown ) { /* llamado una vez procesado la peticion fallida*/
      alerta( "ERROR DE CONEXION: " + textStatus); /*error a mostrar en caso de conexion fallida*/
   });
}

/* LLAMADO PARA GESTIONAR UN MODULO
accion:   funcion que va a ejecutar en la clase
clase:    clase donde va a ejecutar la accion*/
function  gestionar_paquete(accion,clase){
  /*llamado a validar campos de formulario con parsley y mostrar confirmacion de envio*/
  /*primer parametro: funcion a ejecutar una vez valide los campos de formulario*/
  validardatos("gestion_paquete",accion,clase)
}
/*LLAMADO PARA GESIONAR MODULO UNA VEZ VALIDADO LOS CAMPOS DEL FORMULARIO
accion:   funcion que va a ejecutar en la clase
clase:    clase donde va a ejecutar la accion*/
function  gestion_paquete(accion,clase){
         var parametros=[{
            "clase":clase,
            "accion":accion,
            "datos":{
              "id_paq":getD("id_paq"),
              "nombre_paq":getD("nombre_paq"),
              "status_paq":getOption("status_paq"),
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
               cargar_form_paquete();
            }else {
               alerta("ERROR DURANTE TRANSACCION\n"+respuesta.error);
            }
         })
         .fail(function( jqXHR, textStatus, errorThrown ){
            ventaG.close();
            alerta( "ERROR DE CONEXION: " + textStatus);
         });
}
function  buscar_id_paq(id_paq){
   var parametros=[{
            "clase":"paquete",
            "consulta":"select * from paquete where id_paq='"+id_paq+"'"
         }];
   buscar_paquete(parametros);
}
function  buscar_paquete(parametros){
   $.ajax({ 
     data: {"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_paquete(respuesta);
      }else{
         alerta( "ERROR: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ){
    alerta( "ERROR DE CONEXION: " + textStatus);
   });
}
function  asignar_paquete(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "paquete":
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
            case "paquete":
               setD("id_paq",campo.id_paq);
               setD("nombre_paq",campo.nombre_paq);
               setOption("status_paq",campo.status_paq);
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