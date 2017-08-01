
function generar_mensualidad(){
  var parametros=[{
       "clase":"mensualidad",
       "accion":"cargar_mensualidad",
       "datos":{
          "id_mensualidad":""                 
       }
      }];
  $.ajax({
   data:{"parametros":JSON.stringify(parametros)},
   type: "POST",
   dataType: "json",
   url: "controlador.php",
  })
  .done(function( respuesta, textStatus, jqXHR ){
    if( respuesta.success ) {
      cargar_bienvenidos_saeco();
    }else {
       alerta("ERROR DURANTE TRANSACCION\n"+respuesta.error);
    }

  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
    if ( console && console.log ) {
       alerta("ERROR DURANTE TRANSACCION\nError: "+textStatus);
       log( "La solicitud a fallado: " +  textStatus);
    }
  });
}