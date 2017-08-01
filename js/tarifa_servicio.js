function  cargar_form_tarifa_servicio(){
   $.ajax({
    type: "GET",
    url: "Formulario/tarifa_servicio.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_tarifa_servicio.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_tarifa_servicio(accion,clase){
         validardatos("gestion_tarifa_servicio",accion,clase)
}
function  gestion_tarifa_servicio(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_tar_ser":getD("id_tar_ser"),
                  "fecha_tar_ser":getD("fecha_tar_ser"),
                  "tarifas":ver_reg_tarifas()
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
               cargar_form_tarifa_servicio();
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
function  buscar_id_tar_ser(id_tar_ser){
   var parametros=[{
            "clase":"tarifa_servicio",
            "consulta":"select * from tarifa_servicio where id_tar_ser='"+id_tar_ser+"'"
         }]
   buscar_tarifa_servicio(parametros);
}
function  buscar_tarifa_servicio(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_tarifa_servicio(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_tarifa_servicio(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "tarifa_servicio":
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
            case "tarifa_servicio":
               setD("id_tar_ser",campo.id_tar_ser);
               setD("id_serv",campo.id_serv);
               setD("fecha_tar_ser",campo.fecha_tar_ser);
               setOption("status_tarifa_ser",campo.status_tarifa_ser);
               setD("hora_tar_ser",campo.hora_tar_ser);
               setD("obser_tarifa_ser",campo.obser_tarifa_ser);
               setD("tarifa_ser",campo.tarifa_ser);
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
function filtrar_servicios(){
    $.ajax({data:{
        "parametros":JSON.stringify({
        "clase":"filtrar_servicios",
        "datos":{"id_tipo_servicio":getD("id_tipo_servicio")}
      })},
       type: "GET",
       dataType: "json",
       url: "controlador_informacion.php",
    })
     .done(function( respuesta, textStatus, jqXHR ) {
      var c=respuesta.campo;
        if(respuesta.success ){
          setHTML("id_cant",c.id_cant);
          setHTML("id_serv",c.id_serv);
          if(c.id_cant_e!=''){
            setD("id_cant",c.id_cant_e);
            disabled("id_cant");
          }else{
            enabled("id_cant");
          }
        }else{
           log( "Error: " + respuesta.error);
        }
     });
}
function filtrar_servicios(){
  archivoDataGrid="procesos/datagrid_tarifa_servicio.php?&id_tipo_servicio="+getD("id_tipo_servicio")+"&tipo_costo="+getD("tipo_costo")+"&tipo_paq="+getD("tipo_paq")+"&tipo_serv="+getD("tipo_serv")+"&id_paq="+getD("id_paq")+"&id_cant="+getD("id_cant")+"&";
  listar_datos(archivoDataGrid,"datagrid");
} 
function activa_check_tar(id_serv){
  
  if(parseFloat(getD(id_serv+"_tar"))>=0){
    document.getElementById(id_serv).checked=1;
  }else{
    document.getElementById(id_serv).checked=0;
    setD(id_serv+"_tar",'');
  }
}
function ver_reg_tarifas(){
  var arreglo = new Array();
  var ind=0;
  for (i = 1; i < document.f1.checkbox.length; i++) {
    if(document.f1.checkbox[i].checked == true){
      var id_serv= document.f1.checkbox[i].value;
      var tarifa_ser=parseFloat(getD(id_serv+"_tar"));
        var tarifas = new Object();
        tarifas.id_serv=id_serv;
        tarifas.tarifa_ser=tarifa_ser;
        arreglo[ind]=tarifas;
        ind++;

    }
  }
  return arreglo;
}