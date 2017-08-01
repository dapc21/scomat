function  cargar_form_equipo_sistema(){
  $.ajax({
  type: "GET",
  url: "Formulario/equipo_sistema.php",
  })
  .done(function( respuesta, textStatus, jqXHR ){
   claseGlobal='equipo_sistema';
   $("#principal").html(respuesta);
   activar_validar_datos();
   listar_datos("procesos/datagrid_equipo_sistema.php","datagrid");  
  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
    alerta("Error al cargar formulario:\n "+textStatus);
  });
}

function  gestionar_equipo_sistema(accion,clase){
         validardatos("gestion_equipo_sistema",accion,clase)
}
function  gestion_equipo_sistema(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_es":getD("id_es"),
                  "id_modelo":getD("id_modelo"),
                  "id_ues":getD("id_ues"),
                  "id_contrato":getD("id_contrato"),
                  "codigo_es":getD("codigo_es"),
                  "tipo_es":getD("tipo_es"),
                  "status_es":getD("status_es"),
                  "obser_es":getD("obser_es"),
                  "codigo_adic":getD("codigo_adic"),
                  "estado_fisico":getD("estado_fisico"),
                  "serv_sist_equipo":ver_serv_sist_equipo(),
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
               cargar_form_equipo_sistema();
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
function  gestion_equipo_sistema_ext(accion,clase){
    if(accion=='modificar_edit'){
       var parametros=[{
             "clase":clase,
             "accion":accion,
             "datos":{
                "id_es":getD("id_es"),
                "obser_es":getD("obser_es"),
                "serv_sist_equipo":ver_serv_sist_equipo_f3()
             }
         }];
    }else if(accion=='modificar_add'){
      var parametros=[{
             "clase":clase,
             "accion":accion,
             "datos":{
                "id_es":getD("id_es"),
                "ubicacion":getD("ubicacion"),
                "id_contrato":getD("id_contrato"),
                "serv_sist_equipo":ver_serv_sist_equipo_f3()
             }
         }];
    }
         
         $.ajax({
           data:{"parametros":JSON.stringify(parametros)},
           type: "POST",
           dataType: "json",
           url: "controlador.php",
         })
         .done(function( respuesta, textStatus, jqXHR ){
            if( respuesta.success ) {
              if(accion=='modificar_edit'){
                 cerrar_ventana_externa_ter_contrato();
              }else if(accion=='modificar_add'){
                setD('codigo_es','');
                setD('ubicacion','');
                setD('sistema','');
                setHTML('datagrid_servicio','');
                listar_datos("procesos/datagrid_equipo_sistema_add.php?id_contrato="+getD("id_contrato"),"terminales");  
              }
              
            }else{
               alerta("ERROR DURANTE TRANSACCION\n"+respuesta.error);
            }
         })
         .fail(function( jqXHR, textStatus, errorThrown ) {
            if ( console && console.log ){
               alerta("ERROR DURANTE TRANSACCION\nError: "+textStatus);
               log( "La solicitud a fallado: " +  textStatus);
            }
         });
}
function  buscar_id_es(id_es){
   var parametros=[{
            "clase":"equipo_sistema",
            "consulta":"select * from equipo_sistema where id_es='"+id_es+"'"
         }]
   buscar_equipo_sistema(parametros);
}
function  buscar_codigo_es(){
   var parametros=[{
            "clase":"equipo_sistema",
            "consulta":"select * from equipo_sistema where codigo_es='"+getD("codigo_es")+"'"
         }]
   buscar_equipo_sistema(parametros);
}
function  buscar_equipo_s(){
   var parametros=[{
            "clase":"vista_equipo_sistema",
            "consulta":"select * from vista_equipo_sistema where codigo_es='"+getD("codigo_es")+"'"
         }]
   buscar_equipo_sistema(parametros);
}
function  buscar_equipo_codigo_es(codigo_es){
   var parametros=[{
            "clase":"vista_equipo_sistema",
            "consulta":"select * from vista_equipo_sistema where codigo_es='"+codigo_es+"'"
         }]
   buscar_equipo_sistema(parametros);
}
function  buscar_equipo_sistema(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_equipo_sistema(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_equipo_sistema(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "equipo_sistema":
               enabled("registrar");
               disabled("modificar");
               disabled("eliminar");
               break;
            case "vista_equipo_sistema":
               alerta("Aviso el equipo no esta registrado");
               disabled("registrar");
               break;
            default:
            log( "no existe la clase: "+clase+" para asignar parametros");
         }
      }	 	  
      else if(cantidad==1){
         var campo=objetos[objeto].data[0];
         switch(clase){
            case "equipo_sistema":
               setD("id_es",campo.id_es);
               setD("id_modelo",campo.id_modelo);
               setD("id_ues",campo.id_ues);
               setD("id_contrato",campo.id_contrato);
               setD("codigo_es",campo.codigo_es);
               setD("tipo_es",campo.tipo_es);
               setD("status_es",campo.status_es);
               setD("obser_es",campo.obser_es);
               setD("codigo_adic",campo.codigo_adic);
               setD("estado_fisico",campo.estado_fisico);

               traer_sistema_marca();
                buscar_id_contrato(id_contrato);
               traer_serv_sist_equipo();
               
               setD("dato",campo.dato);
               disabled("registrar");
               enabled("modificar");
               enabled("eliminar");
               break;
            case "vista_equipo_sistema":
              if(claseGlobal=='final_ordenes_tecnicos'){
               setD("id_es",campo.id_es);
               setD("codigo_es",campo.codigo_es);
               setD("id_tse",campo.id_tse);
               setD("nombre_modelo",campo.nombre_modelo);
               setD("sistema",campo.sistema);
               setD("ubicacion",campo.ubicacion);
               cargar_serv_sist_equipo_contrato();
               enabled("add_es");
              }else{
               setD("id_es",campo.id_es);
               setD("id_contrato",campo.id_contrato);
               setD("codigo_es",campo.codigo_es);
               setD("status_es",campo.status_es);
               setD("codigo_adic",campo.codigo_adic);
               setD("id_tse",campo.id_tse);
               setD("nro_contrato",campo.nro_contrato);
               setD("cedula",campo.cedula);
               setD("nombre",campo.nombre+" "+campo.apellido);
               setD("status_contrato",campo.status_contrato);
               enabled("registrar");
               cargar_comandos_interfaz();
               listar_datos("procesos/datagrid_interfaz_equipos.php?id_es="+getD("id_es")+"&","datagrid");  
              }
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

function traer_serv_sist_equipo(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traer_serv_sist_equipo",
      "datos":{"id_es":getD("id_es")}
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
function traer_equipo_sistema_add(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traer_equipo_sistema_add",
      "datos":{"codigo_es":getD("codigo_es")}
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
function cargar_marca_modelo(){
  $.ajax({
     data: {
      "parametros":JSON.stringify({
      "clase":"cargar_marca_modelo",
      "datos":{"id_tse":getD("id_tse")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        setHTML("id_marca",respuesta.campo.id_marca);
        setHTML("id_modelo",respuesta.campo.id_modelo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function cargar_serv_sist_equipo(){
  $.ajax({
     data: {
      "parametros":JSON.stringify({
      "clase":"cargar_serv_sist_equipo",
      "datos":{"id_tse":getD("id_tse")}
    })
  },
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        setHTML("datagrid_servicio",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function cargar_serv_sist_equipo_contrato(){
  $.ajax({
     data: {
      "parametros":JSON.stringify({
      "clase":"cargar_serv_sist_equipo_contrato",
      "datos":{"id_tse":getD("id_tse"),"id_es":getD("id_es"),"id_contrato":getD("id_contrato")}
    })
  },
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        setHTML("datagrid_servicio",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}


function ver_serv_sist_equipo(){
  var servicios = new Array();
  var ind=0;
  for (i = 0; i < document.f1.servicio.length; i++) {
    if(document.f1.servicio[i].checked == true){
        var ver_serv_sist_equipo = new Object();
        ver_serv_sist_equipo.id_es=getD("id_es");
        ver_serv_sist_equipo.id_serv_sist=document.f1.servicio[i].value;
        servicios[ind]=ver_serv_sist_equipo;
        ind++;
    }
  }
    return servicios;
}
function ver_serv_sist_equipo_f3(){
  log("entro a ver_servicios");
  var servicios = new Array();
  var ind=0;
  log(":"+document.f3.servicio.length);
  for (i = 1; i < document.f3.servicio.length; i++) {
    if(document.f3.servicio[i].checked == true){
        var ver_serv_sist_equipo = new Object();
        ver_serv_sist_equipo.id_es=getD("id_es");
        ver_serv_sist_equipo.id_serv_sist=document.f3.servicio[i].value;
        servicios[ind]=ver_serv_sist_equipo;
        ind++;
    }
  }
    return servicios;
  
}

function cerrar_ventana_externa_orden() {
  listar_datos("procesos/datagrid_equipo_sistema_add_orden.php?id_contrato="+getD("id_contrato"),"terminales_orden"); 
  ventanaModal.close();
}
function cerrar_ventana_externa_ter_contrato() {
  listar_datos("procesos/datagrid_equipo_sistema_contrato.php?id_contrato="+getD("id_contrato"),"terminales"); 
  ventanaModal.close();
}