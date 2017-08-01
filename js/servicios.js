function  cargar_form_servicios(){
   $.ajax({
    type: "GET",
    url: "Formulario/servicios.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_servicios.php","datagrid");  
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_servicios(accion,clase){
         validardatos("gestion_servicios",accion,clase)
}
function  gestion_servicios(accion,clase){
      
        var parametros=[{
              "datos":{
                "id_serv":getD("id_serv"),
                "id_tipo_servicio":getD("id_tipo_servicio"),
                "status_serv":getOption("status_serv"),
                "tipo_costo":getOption("tipo_costo"),
                "nombre_servicio":getD("nombre_servicio"),
                "tipo_paq":getD("tipo_paq"),
                "obser_serv":getD("obser_serv"),
                "tipo_serv":getD("tipo_serv"),
                "tarifa_esp":getD("tarifa_esp"),
                "id_paq":getD("id_paq"),
                "id_cant":getD("id_cant"),
                "tarifa_ser":getD("tarifa_ser"),
                "id_tar_ser":getD("id_tar_ser"),
                "serv_sist_paq":ver_serv_sist_paq(),
                "servicio_franquicia":ver_servicio_franquicia()
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
               cargar_form_servicios();
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
function  buscar_id_serv(id_serv){
   var parametros=[{
            "clase":"servicios",
            "consulta":"select * from servicios where id_serv='"+id_serv+"'"
         }];
   buscar_servicios(parametros);
}
function  buscar_servicios(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
   })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_servicios(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_servicios(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "servicios":
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
            case "servicios":
               setD("id_serv",campo.id_serv);
               setD("id_tipo_servicio",campo.id_tipo_servicio);
               setOption("status_serv",campo.status_serv);
               setOption("tipo_costo",campo.tipo_costo);
               setD("nombre_servicio",campo.nombre_servicio);
               setD("tipo_paq",campo.tipo_paq);
               setD("obser_serv",campo.obser_serv);
               setD("tipo_serv",campo.tipo_serv);
               setD("tarifa_esp",campo.tarifa_esp);
               setD("id_paq",campo.id_paq);
               setD("id_cant",campo.id_cant);
               setD("tarifa_ser","0");
               
               traer_serv_sist_paq();
               traer_servicio_franquicia();

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
function ver_serv_sist_paq(){
  var servicios = new Array();
  var ind=0;
  for (i = 0; i < document.f1.servicio.length; i++) {
    if(document.f1.servicio[i].checked == true){
        var serv_sist_paq = new Object();
        serv_sist_paq.id_serv=getD("id_serv");
        serv_sist_paq.id_serv_sist=document.f1.servicio[i].value;
        servicios[ind]=serv_sist_paq;
        ind++;
        //cade=cade+"-Class-incluir=@serv_sist_paq=@"+id_serv()+"=@"+document.f1.servicio[i].value+"=@";
    }
  }

    //alert(cade);
    return servicios;
  
}
function ver_servicio_franquicia(){
  var arr = new Array();
  for (i = 0; i < document.f1.franquicia.length; i++) {
    if(document.f1.franquicia[i].checked == true){
        var obj = {};
        obj.id_serv=getD("id_serv");
        obj.id_franq=document.f1.franquicia[i].value;
        arr.push(obj);
    }
  }
    return arr;
}
function traer_serv_sist_paq(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traer_serv_sist_paq",
      "datos":{"id_serv":getD("id_serv")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var tam=document.f1.servicio.length;
        for(j=0;j<tam;j++){
          document.f1.servicio[j].checked=false;
        }
        var objetos = respuesta.campo;
        for (var objeto in objetos){
          var c=objetos[objeto];
          for(j=0;j<tam;j++){
            if(document.f1.servicio[j].value==c.id_serv_sist){
              document.f1.servicio[j].checked=true;
            }
        }
          }
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function traer_servicio_franquicia(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traer_servicio_franquicia",
      "datos":{"id_serv":getD("id_serv")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var tam=document.f1.franquicia.length;
        for(j=0;j<tam;j++){
          document.f1.franquicia[j].checked=false;
        }
        var objetos = respuesta.campo;
        for (var objeto in objetos){
          var c=objetos[objeto];
          for(j=0;j<tam;j++){
            if(document.f1.franquicia[j].value==c.id_franq){
              document.f1.franquicia[j].checked=true;
            }
        }
          }
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function activacheckf(id_gf)
{
  log("entro a activacheckf");
  tam1=document.f1.franquicia.length;

  //if(document.getElementById(id_gf).checked==)    
  for(j=0;j<tam1;j++){
    //log(document.f1.franquicia[j].id+":"+id_gf);
    if(  document.f1.franquicia[j].id.indexOf(id_gf) == 0 ){
      document.f1.franquicia[j].checked = document.getElementById(id_gf+"gf").checked;
    }
  }
}
function activacheckf_ts(id_ta)
{
  log("entro a activacheckf_ts");
  tam1=document.f1.servicio.length;
  for(j=0;j<tam1;j++){
    log(document.f1.servicio[j].id+":"+id_ta);
    if(  document.f1.servicio[j].id.indexOf(id_ta) == 0 ){
      document.f1.servicio[j].checked = document.getElementById(id_ta+"ts").checked;
    }
  }
}
function activacheckf_ts_f3(id_ta)
{
  log("entro a activacheckf_ts");
  tam1=document.f3.servicio.length;
  for(j=1;j<tam1;j++){
    log(document.f3.servicio[j].id+":"+id_ta);
    if(  document.f3.servicio[j].id.indexOf(id_ta) == 0 ){
      document.f3.servicio[j].checked = document.getElementById(id_ta+"ts").checked;
    }
  }
}