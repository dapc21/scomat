function  cargar_form_devolver_recibo(){
  log("entro a cargar devolver_recibo.")
   $.ajax({
    type: "GET",
    url: "Formulario/devolver_recibo.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
       
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_devolver_recibo(accion,clase){
   
    if(eliminar_recibe_fact(tipo)!=false){
        validardatos("gestion_devolver_recibo",accion,clase);               
   }
}
function  gestion_devolver_recibo(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_rec":getD("id_rec"),
                  "recibos":eliminar_recibe_fact(getD("tipo"))
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
               cargar_form_devolver_recibo();
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
function listar_facturas_devolver(){  
  archivoDataGrid="procesos/datagrid_recibos_devolver.php?&id_cobrador="+getD("id_cobrador")+"&";  
  listar_datos(archivoDataGrid,"datagrid_recibos_devolver");
}
function cargar_cob_ven(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargar_cob_ven",
      "datos":{"tipo":getD("tipo")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        setHTML("id_cobrador",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });    

}
function eliminar_recibe_fact(tipo){  
  var recibo_fact = new Array();
  var ind=0;
    for (i = 1; i < document.f1.checkbox.length; i++) {
      if(document.f1.checkbox[i].checked == true){
          var obj = new Object();
          obj.id_rec=getD("id_rec");
          obj.nro_recibo=document.f1.checkbox[i].value;
          obj.tipo=tipo;
          recibo_fact[ind]=obj;
          ind++;
      }
    }
    if(ind>0)
    {
      //log(recibos)
      return recibo_fact;
    }
    else{
      alerta("Error, debe seleccionar al menos un TIPO de la lista.");
      return false;
    }
  
}



