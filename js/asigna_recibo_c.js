function  cargar_form_asigna_recibo_c(){
  log("entro a cargar asigna_recibo_c.")
   $.ajax({
    type: "GET",
    url: "Formulario/asigna_recibo_c.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_asigna_recibo.php?tipo=CONTRATO&","datagrid_asigna_recibo");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_asigna_recibo(accion,clase){
         validardatos("gestion_asigna_recibo",accion,clase)
}
function  gestion_asigna_recibo(accion,clase){
          var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_asig":getD("id_asig"),
                  "id_cobrador":getD("id_cobrador"),
                  "fecha_asig":getD("fecha_asig"),
                  "obser_asig":getD("obser_asig"),
                  "login_asig":getD("login_asig"),
                  "desde":getD("desde"),
                  "hasta":getD("hasta"),
                  "cantidad":getD("cantidad"),
                  "tipo":getD("tipo"),
                  "serie":getD("serie")
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
               cargar_form_asigna_recibo_c();
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
function  buscar_id_asig(id_asig){  
   var parametros=[{     
            "clase":"asigna_recibo",            
            "consulta":"select * from vista_asignarecibo where id_asig='"+id_asig+"'"
         }]   
  buscar_asigna_recibo(parametros);
}
function  buscar_asigna_recibo(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_asigna_recibo(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_asigna_recibo(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "asigna_recibo":
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
            case "asigna_recibo":
               setD("id_asig",campo.id_asig);
               setD("id_cobrador",campo.id_cobrador);
               setD("fecha_asig",formatdatei(campo.fecha_asig));
               setD("obser_asig",campo.obser_asig);
               setD("login_asig",campo.login_asig);
               setD("desde",campo.desde);
               setD("hasta",campo.hasta);
               setD("cantidad",campo.cantidad);
               setD("tipo",campo.tipo);
               setD("serie",campo.serie);
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
function valida_fact_c(){
  if(getD("desde")!='' && getD("hasta")!=''){
    if(validaCampo(document.f1.desde,isInteger) && validaCampo(document.f1.hasta,isInteger)){
      if(getD("desde").length==dig_cont_fisico_G){
        if(getD("hasta").length==dig_cont_fisico_G){
          if(parseInt(getD("desde"))<=parseInt(getD("hasta"))){
           setD("cantidad",parseInt(getD("hasta"))-parseInt(getD("desde"))+1);
            //conexionPHP('informacion.php',"valida_fact_c",getD("desde")+"=@"+getD("hasta")+"=@"+getD("cantidad"));
            valida_fact_c_info(getD("desde"),getD("hasta"),getD("cantidad"));
          }else{
            foco("hasta");
            setD("cantidad",'');
            alerta("Error, el campo factura hasta debe ser mayor o igual a la factura desde.");
          }
        }else{
          foco("hasta");
          alerta("Error, la factura hasta debe ser de "+dig_cont_fisico_G+" digitos.");
        }
      }else{
        
        foco("desde");
        alerta("Error, la factura desde debe ser de "+dig_cont_fisico_G+" digitos.");
      }
    }
  }
}

// Solicitar Informacion al servidor
function valida_fact_c_info(desde,hasta,cantidad){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"valida_fact_c",  /*funcion a la que llama en procesos y parametros*/
      "datos":{ /*lista de parametros a enviar*/
        "desde":desde,
        "hasta":hasta,
        "cantidad":cantidad
      }
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo; /*Valores php devueltos*/
        //setD("id_esta",c.id_esta); //en caso de asignarlo a un campo de formulario
        //setHTML("id_mun",c.id_mun); // en caso de asignarlo en formato html a div o select
    log("c.recibos:"+c.recibos+":");
       if(c.recibos!=""){
          alerta("Error, las siguientes numero de facturas estan asignadas:\n"+c.recibos);
          setD("cantidad",'');
        } 

      }else {
         log( "Error: " + respuesta.error);
      }
   });
}