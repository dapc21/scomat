function  cargar_form_cargar_deuda(){
   $.ajax({
    type: "GET",
    url: "Formulario/cargar_deuda.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
    claseGlobal='cargar_deuda';
     $("#principal").html(respuesta);
     foco("nro_contrato");
     activar_validar_datos();
     if(id_contrato_G!=''){
      buscar_id_contrato_id(id_contrato_G);
     }
    // listar_datos("procesos/datagrid_cargar_deuda.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  cargar_cargar_deuda(accion,clase){
  if(getOption("tipo_costo")=="COSTO UNICO"){
    if(parseInt(getD("cont_serv"))>0){
         gestionar_cargar_deuda(accion,clase);
    }else{
       alerta("Error, Debe cargar por lo menos servicio unico");
    }
  }else{
    gestionar_cargar_deuda(accion,clase);
  }
         
}
function  gestionar_cargar_deuda(accion,clase){
         validardatos("gestion_cargar_deuda",accion,clase)
}
function  gestion_cargar_deuda(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_cd":getD("id_cd"),
                  "id_contrato":getD("id_contrato"),
                  "id_serv":getD("id_serv"),
                  "tipo_costo":getOption("tipo_costo"),
                  "costo":getD("costo"),
                  "cantidad":getD("cantidad"),
                  "mes":getD("mes")
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
            if( respuesta.success ){
              log("accion"+accion+":");
              if(accion=="cargar"){
                if(ruta_G!=''){
                  eval(ruta_G);
                }else{
                  cargar_form_cargar_deuda();
                }
              }else{
                setD("id_serv","");
                setD("costo","0");
                setD("cantidad","1");
                setD("total","0");
                listar_datos("procesos/datagrid_cargar_deuda.php?id_contrato="+getD("id_contrato")+"&","datagrid");  
              }
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
function  gestion_cargar_deuda_inst(accion,clase){
  if(validar_datos_form_f5()){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_cd":getD("id_cd"),
                  "id_contrato":getD("id_contrato"),
                  "id_serv":getD("id_serv_i"),
                  "costo":getD("costo"),
                  "cantidad":getD("cantidad")
               }
         }];
         $.ajax({
           data:{"parametros":JSON.stringify(parametros)},
           type: "POST",
           dataType: "json",
           url: "controlador.php",
         })
         .done(function( respuesta, textStatus, jqXHR ){
            if( respuesta.success ){
                setD("id_serv_i","");
                setD("costo","0");
                setD("cantidad","1");
                setD("total","0");
                listar_datos("procesos/datagrid_cargar_deuda_inst.php?id_contrato="+getD("id_contrato")+"&","datagrid_instalacion");  
                listar_datos("procesos/datagrid_contrato_servicio_temp.php?&id_contrato="+getD("id_contrato")+"&","datagrid");
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
  }else{$("#error_f5").html(errorGlobal);}
}

function  buscar_id_cd(id_cd){
   var parametros=[{
            "clase":"cargar_deuda",
            "consulta":"select * from cargar_deuda where id_cd='"+id_cd+"'"
         }]
   buscar_cargar_deuda(parametros);
}
function  buscar_id_cd_inst(id_cd){
   var parametros=[{
            "clase":"cargar_deuda_inst",
            "consulta":"select * from cargar_deuda where id_cd='"+id_cd+"'"
         }]
   buscar_cargar_deuda(parametros);
}
function  eliminarcargar_deuda(id_cd,id_serv){
  setD("id_serv",id_serv);
  setD("id_cd",id_cd);
  gestionar_cargar_deuda("eliminar","cargar_deuda");
}
function  eliminarcargar_deuda_inst(id_cd,id_serv){
  setD("id_serv_i",id_serv);
  setD("id_cd",id_cd);
  gestion_cargar_deuda_inst('eliminar_inst','cargar_deuda');
}
function  buscar_cargar_deuda(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_cargar_deuda(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_cargar_deuda(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==1){
         var campo=objetos[objeto].data[0];
         switch(clase){
            case "cargar_deuda":
               setD("id_cd",campo.id_cd);
               setD("cantidad",campo.cantidad);
               setD("id_serv",campo.id_serv);
               setD("costo",campo.costo);
               calcular_total_cargar_deuda();
               break;
            case "cargar_deuda_inst":
               setD("id_cd",campo.id_cd);
               setD("cantidad",campo.cantidad);
               setD("id_serv_i",campo.id_serv);
               setD("costo",campo.costo);
               calcular_total_cargar_deuda();
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

function activa_serv_cargo(){
  if(getOption("tipo_costo")=="COSTO MENSUAL"){
    enabled("mes");
    disabled("id_serv");
    //disabled("costo");
    disabled("cantidad");
    setD("id_serv","");
    setD("costo","0");
    setD("cantidad","1");
    setD("total","0");
  }
  else if(getOption("tipo_costo")=="COSTO UNICO"){
    disabled("mes");
    enabled("id_serv");
    //enabled("costo");
    enabled("cantidad");
    
  }
}

function traer_costo_ser_inst(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traer_costo_ser",
      "datos":{"id_serv":getD("id_serv_i"),
               "id_contrato":getD("id_contrato")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("costo",c.tarifa_ser);
        calcular_total_cargar_deuda();
        if(c.aviso!=''){
          alerta(c.aviso);
        }
        
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function traer_costo_ser(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traer_costo_ser",
      "datos":{"id_serv":getD("id_serv"),
               "id_contrato":getD("id_contrato")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("costo",c.tarifa_ser);
        calcular_total_cargar_deuda();
        if(c.aviso!=''){
          alerta(c.aviso);
        }
        
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function eliminar_cargar_deuda_contrato(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"eliminar_cargar_deuda_contrato",
      "datos":{"id_contrato":getD("id_contrato")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        log( "registros eliminados");
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function calcular_total_cargar_deuda(){
  //if(parseInt(getD("cantidad"))>=1){
  //  if(parseFloat(getD("costo"))>=0){
      setD("total",parseFloat(getD("costo"))*parseInt(getD("cantidad")));
  /*  }
    else{
      setD("costo","0");
      calcular_total_cargar_deuda();
    }
  }else{
     setD("cantidad","1");
     calcular_total_cargar_deuda();
  }
  */
}