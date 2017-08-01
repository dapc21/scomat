function  cargar_form_recibe_recibo_c(){
  log("entro a cargar recibe_recibo_c.")
   $.ajax({
    type: "GET",
    url: "Formulario/recibe_recibo_c.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     //activar_validar_datos();
     //ejemplo: listar_datos("procesos/datagrid_asigna_recibo.php?tipo=CONTRATO&","datagrid_asigna_recibo");
     //listar_datos("procesos/datagrid_recibos_c.php?id_cobrador","datagrid_recibos_c");      
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_recibe_recibo_c(accion,clase){
  if(recibe_fact(accion,"CONTRATO")!=false){
    validardatos("gestion_recibe_recibo_c",accion,clase);               
  }
}
function  gestion_recibe_recibo_c(accion,clase){
        var parametros=[{
               "clase":clase,
               "accion":"incluir",
               "datos":{
                  "id_rec":getD("id_rec"),
                  "id_cobrador":getD("id_cobrador"),
                  "fecha_rec":getD("fecha_rec"),
                  "obser_rec":getD("obser_rec"),
                  "login_rec":getD("login_rec"),
                  "tipo":getD("tipo"),
                  "recibos":recibe_fact(accion,"CONTRATO")
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
               cargar_form_recibe_recibo_c();
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
function listar_facturas_asig_c(){  
  archivoDataGrid="procesos/datagrid_recibos_c.php?&id_cobrador="+getD("id_cobrador")+"&";
  listar_datos(archivoDataGrid,"datagrid_recibos_c");
}

function recibe_fact(status_pago,tipo){  
  var recibos = new Array();
  var ind=0;
    for (i = 1; i < document.f1.checkbox.length; i++) {
      if(document.f1.checkbox[i].checked == true){
          var obj = new Object();
          obj.id_rec=getD("id_rec");
          obj.nro_recibo=document.f1.checkbox[i].value;
          obj.status_pago=status_pago;
          obj.tipo=tipo;
          obj.obser=getD("obser_rec");
          recibos[ind]=obj;
          ind++;
      }
    }
    if(ind>0)
    {
      //log(recibos)
      return recibos;
    }
    else{
      alerta("Error, debe seleccionar al menos un FACTURA/CONTRATO de la lista.");
      return false;
    }
  
}

