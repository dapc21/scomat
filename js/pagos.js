var detalle_tipopagoG='';
function  cargar_form_pagos(){
  $.ajax({
  type: "GET",
  url: "Formulario/pagos.php",
  })
  .done(function( respuesta, textStatus, jqXHR ){
   claseGlobal='pagos';
   $("#principal").html(respuesta);
   foco("nro_contrato");
    //imprimir_recibo_pago("AB0000001800");
   if(id_contrato_G!=''){
      buscar_id_contrato_id(id_contrato_G);
      ruta_G='';
      id_contrato_G='';
    }
   activar_validar_datos();
   //listar_datos("procesos/datagrid_pagos.php","datagrid");  
  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
    alerta("Error al cargar formulario:\n "+textStatus);
  });
}
function  cargar_form_nota_credito_factura(){
  $.ajax({
  type: "GET",
  url: "Formulario/nota_credito_factura.php",
  })
  .done(function( respuesta, textStatus, jqXHR ){
   claseGlobal='nota_credito_factura';
   $("#principal").html(respuesta);
   foco("nro_factura_nc");
   activar_validar_datos();
   //listar_datos("procesos/datagrid_pagos.php","datagrid");  
  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
    alerta("Error al cargar formulario:\n "+textStatus);
  });
}
function  cargar_form_nota_debito_factura(){
  $.ajax({
  type: "GET",
  url: "Formulario/nota_debito_factura.php",
  })
  .done(function( respuesta, textStatus, jqXHR ){
   claseGlobal='nota_debito_factura';
   $("#principal").html(respuesta);
   foco("nro_factura_nc");
   activar_validar_datos();
   //listar_datos("procesos/datagrid_pagos.php","datagrid");  
  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
    alerta("Error al cargar formulario:\n "+textStatus);
  });
}
function  gestionar_pagos(accion,clase,impresion){
  setD("impresion",impresion);
  if(ver_pago_factura() && verdetalle_tipopago()){
         validardatos("gestion_pagos",accion,clase)
  }
}
function  gestionar_nota_credito(accion,clase){
  if(registrarCobroCN()){
         validardatos("gestion_pagos",accion,clase)
  }
}
function  gestionar_nota_debito(accion,clase){
  if(registrarCobroCD()){
         validardatos("gestion_pagos",accion,clase)
  }
}
function  gestion_detalle_tipopago_temp(accion,clase){
  if(valida_forma_pago()){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_tp":getD("id_tp"),
                  "id_pago":getD("id_pago"),
                  "id_tipo_pago":getD("id_tipo_pago"),
                  "id_banco":getD("id_banco"),
                  "monto_tp":getD("monto_tp"),
                  "refer_tp":getD("refer_tp"),
                  "lote_tp":getD("lote_tp")
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
                  setD("id_banco",""),
                  setD("monto_tp","0"),
                  setD("refer_tp",""),
                  setD("lote_tp","")
               listar_datos("procesos/datagrid_detalle_tipopago_temp.php?&id_pago="+getD("id_pago")+"&","datagrid_forma_pago",'','resp_detalle_tipopago_temp()');
               cargardetalle_tipopago();

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
}
function resp_detalle_tipopago_temp(){
  var total_fp=parseFloat(getD("total_fp"));
  var monto_pago=parseFloat(getD("monto_pago"));
  var monto_tp=monto_pago-total_fp;
  setD("monto_tp",monto_tp);
}
function cargardetalle_tipopago(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargardetalle_tipopago",
      "datos":{"id_pago":getD("id_pago")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      detalle_tipopagoG=respuesta.campo;
   });
}
function  gestion_pagos(accion,clase){
  if(accion=="incluir"){
   var parametros=[{
         "clase":clase,
         "accion":accion,
         "datos":{
            "id_pago":getD("id_pago"),
            "id_contrato":getD("id_contrato"),
            "id_caja_cob":getD("id_caja_cob"),
            "monto_pago":getD("monto_pago"),
            "obser_pago":getD("obser_pago"),
            "nro_factura":getD("nro_factura"),
            "nro_control":getD("nro_control"),
            "impresion":getD("impresion"),
            "por_iva":getD("por_iva"),
            "desc_pago":getD("desc_pago"),
            "pago_factura":ver_pago_factura(),
            "detalle_tipopago":verdetalle_tipopago()
          }
        }];
  }else if(accion=="nota_credito_factura"){
    var parametros=[{
         "clase":clase,
         "accion":accion,
         "datos":{
            "id_pago":getD("id_pago"),
            "id_pago_fac":getD("id_pago_fac"),
            "id_contrato":getD("id_contrato"),
            "monto_pago":getD("monto_pago"),
            "obser_pago":getD("obser_pago"),
            "nro_factura":getD("nro_factura"),
            "nro_control":getD("nro_control"),
            "motivo":getD("motivo"),
            "pago_factura":registrarCobroCN()
          }
        }];
  }else if(accion=="nota_debito_factura"){
    var parametros=[{
         "clase":clase,
         "accion":accion,
         "datos":{
            "id_pago":getD("id_pago"),
            "id_pago_fac":getD("id_pago_fac"),
            "id_contrato":getD("id_contrato"),
            "monto_pago":getD("monto_pago"),
            "obser_pago":getD("obser_pago"),
            "nro_factura":getD("nro_factura"),
            "nro_control":getD("nro_control"),
            "motivo":getD("motivo"),
            "pago_factura":registrarCobroCD()
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
      ventaG.close();
      if( respuesta.success ) {
        if(accion=="incluir"){
          imprimir_recibo_pago(getD("id_pago"));
          cargar_form_pagos();
        }else if(accion=="nota_credito_factura"){
          cargar_form_nota_credito_factura();
        }else if(accion=="nota_debito_factura"){
          cargar_form_nota_debito_factura();
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
function  buscar_id_pago(id_pago){
   var parametros=[{
            "clase":"pagos",
            "consulta":"select * from pagos where id_pago='"+id_pago+"'"
         }]
   buscar_pagos(parametros);
}
function  buscar_pagos(parametros){
  $.ajax({
   data:{"parametros":JSON.stringify(parametros)},
   type: "GET",
   dataType: "json",
   url: "controlador_buscar.php",
  })
  .done(function( respuesta, textStatus, jqXHR ) {
    if(respuesta.success ){
       asignar_pagos(respuesta);
    }else {
       log( "Error: " + respuesta.error);
    }
  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
   log( "La solicitud a fallado: " +  textStatus);
  });
}
function  asignar_pagos(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "pagos":
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
            case "pagos":
               setD("id_pago",campo.id_pago);
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
function eliminardetalle_tipopago_temp(id_tp,id_tipo_pago,id_banco,refer_tp,monto_tp,lote_tp){
  setD("id_tp",id_tp);
  setD("id_tipo_pago",id_tipo_pago);
  setD("id_banco",id_banco);
  setD("refer_tp",refer_tp);
  setD("monto_tp",monto_tp);
  setD("lote_tp",lote_tp);

  gestion_detalle_tipopago_temp('eliminar','detalle_tipopago_temp');
}
function valida_forma_pago(){
  if(getD("id_tipo_pago")=="TPA00001"){
    if(validaCampo(document.f1.monto_tp,isNumber,false,"Debe colocar el monto de la forma de pago"))
    {
      return true;
    }
    else{
      return false;
    }
  }else if(getD("id_tipo_pago")=="TPA00005" || getD("id_tipo_pago")=="TPA00007"){
    if( validaCampo(document.f1.monto_tp,isNumber,false,"Debe colocar el monto de la forma de pago") && 
      validaCampo(document.f1.id_banco,isSelect,false,"Debe seleccionar el banco") && 
      validaCampo(document.f1.refer_tp,isInteger,false,"Debe introducir la referencia") && 
      validaCampo(document.f1.lote_tp,isInteger,false,"Debe introducir el lote del punto" ))
    {
      return true;
    }
    else{
      return false;
    }
  }else if(getD("id_tipo_pago")=="TPA00009"){
    if( validaCampo(document.f1.monto_tp,isNumber,false,"Debe colocar el monto de la forma de pago") && 
      validaCampo(document.f1.id_banco,isSelect,false,"Debe seleccionar tipo de retencion") && 
      validaCampo(document.f1.refer_tp,isInteger,false,"Debe introducir la referencia de la retencion"))
    {
      return true;
    }
    else{
      return false;
    }
  }else{
    if( validaCampo(document.f1.monto_tp,isNumber,false,"Debe colocar el monto de la forma de pago") && 
      validaCampo(document.f1.id_banco,isSelect,false,"Debe seleccionar el banco") && 
      validaCampo(document.f1.refer_tp,isInteger,false,"Debe introducir la referencia"))
    {
      return true;
    }
    else{
      return false;
    }
  }
}
function cambia_forma_pago(){
  if(getD("id_tipo_pago")=="TPA00001"){
    disabled("id_banco");
    disabled("refer_tp");
    disabled("lote_tp");
  }else if(getD("id_tipo_pago")=="TPA00005" || getD("id_tipo_pago")=="TPA00007"){
    enabled("id_banco");
    enabled("refer_tp");
    enabled("lote_tp");
  }else if(getD("id_tipo_pago")=="TPA00009"){
    enabled("id_banco");
    enabled("refer_tp");
    disabled("lote_tp");
  }else{
    enabled("id_banco");
    enabled("refer_tp");
    enabled("lote_tp");
  }
}
function adaptar_cargos(){
  if(getD("id_contrato")!=''){
    var monto=parseFloat(getD("monto_pago"));
    divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
    archivoDataGrid="procesos/datagrid_pagos.php?&id_contrato="+getD("id_contrato")+"&monto_pago="+getD("monto_pago")+"&";
    if(monto>999){
      if (confirm('Confirma que el cliente va pagar este monto?\n Bs. '+monto)){
        listar_datos(archivoDataGrid,divDataGrid,'',"resp_adaptar_cargos()")
      }else{
        foco("monto_pago");
      }
    }else{
      listar_datos(archivoDataGrid,divDataGrid,'',"resp_adaptar_cargos()")
    }
 }else{
  alerta("Debe cargar un contrato");
  setD("monto_pago","0");
 }
}
function resp_adaptar_cargos(){
 //$("#imprimir").focus();
            document.f1.saldo1.value=document.f1.sald.value;
            if(parseFloat(getD("saldo1"))>0){
              document.getElementById("saldo1").style='color:#FF0000;font-weight:blod; font-size:16;';
            }else{
              document.getElementById("saldo1").style='color:#00BB00;font-weight:blod; font-size:16;';
            }
            if(document.f1.id_select.value!=''){
              asignar_check_pagos();
            }

}
function asignar_check_pagos(){
  cade=document.f1.id_select.value.split("=@");
  tam=cade.length;

  var i=0,j=0;
  for(j=1;j<tam;j++){
    for (i = 1; i < document.f1.checkbox.length; i++) {
      var cadena= document.f1.checkbox[i].value.split("=@");
      id_cont_serv_pago=cadena[0];
      if(id_cont_serv_pago == cade[j]){
        contSel++;
        document.f1.checkbox[i].checked=true;
      }
    }
  }
  calcularMontoPago();
  // document.f1.registrar1.focus();
}
function calcularMontoPago(){
  var suma=0;
  
  for (i = document.f1.checkbox.length-1 ; i >= 1; i--) {
    if(document.f1.checkbox[i].checked == true){
      for (j = i ; j >= 1; j--) {
        document.f1.checkbox[j].checked = true;
        var total= document.f1.checkbox[j].value.split("=@");
        suma=suma+parseFloat(total[1])+0;
      }
      break;
    }
  }

  document.f1.monto_pago.value=suma;
  document.f1.monto_tp.value=document.f1.monto_pago.value;
}
function ver_pago_factura(){
  var  dat = new Array();
  var ind=0;
  var cont=0;
  cade='';
  for (i = 1; i < document.f1.checkbox.length; i++){
    if(document.f1.checkbox[i].checked == true){
      var id_pago_serv= document.f1.checkbox[i].value.split("=@");
        cade=cade+"=@";
        var pago_factura = new Object();
        pago_factura.id_pago=getD("id_pago");
        pago_factura.id_cont_serv=id_pago_serv[0];
        dat[ind]=pago_factura;
        ind++;
    }
  }
  if(cade!='')
  {
    return dat;
  }
  else{
    alerta("Error, debe seleccionar al menos un Cargo a pagar.");
    return "";
  }
}
function verdetalle_tipopago(){
  if(getD("total_fp")==getD("monto_pago")){
    return detalle_tipopagoG;
  }
  else{
    if(getD("monto_tp")==getD("monto_pago")){
      if(valida_forma_pago()){
      var  dat = new Array();
      var detalle_tipopago = new Object();
        detalle_tipopago.id_tp=getD("id_tp");
        detalle_tipopago.id_pago=getD("id_pago");
        detalle_tipopago.id_tipo_pago=getD("id_tipo_pago");
        detalle_tipopago.id_banco=getD("id_banco");;
        detalle_tipopago.monto_tp=getD("monto_tp");;
        detalle_tipopago.refer_tp=getD("refer_tp");;
        detalle_tipopago.lote_tp=getD("lote_tp");
        dat[0]=detalle_tipopago;
        return dat;
      }
    }else{
      alerta("Error, el monto de la forma de pago no coincide con el total a pagar");
      return false;
    }

  }
}
function  c_nro_factura_nc(){
  $.ajax({ 
  data:{
      "clase":"c_nro_factura_nc",
      "nro_factura":getD("nro_factura_nc"),
      "cedula_b":getD("cedula_b"),
      "nro_contrato":getD("nro_contrato")
    },
  type: "GET",
  url: "datos_factura.php",
  })
  .done(function( respuesta, textStatus, jqXHR ){
   $("#result").html(respuesta);
  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
    alerta("Error al cargar formulario:\n "+textStatus);
  });
}
function  c_nro_factura_nd(){
  $.ajax({ 
  data:{
      "clase":"c_nro_factura_nd",
      "nro_factura":getD("nro_factura_nc"),
      "cedula_b":getD("cedula_b"),
      "nro_contrato":getD("nro_contrato")
    },
  type: "GET",
  url: "datos_factura.php",
  })
  .done(function( respuesta, textStatus, jqXHR ){
   $("#result").html(respuesta);
  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
    alerta("Error al cargar formulario:\n "+textStatus);
  });
}
function  traer_id_pago_nc(id_pago_fac,nro_factura){
  setD("id_pago_fac",id_pago_fac);
  setD("nro_factura_nc",nro_factura);
  $.ajax({ 
  data:{
      "clase":"traeinfoFactura_nc",
      "id_pago":getD("id_pago_fac")
    },
  type: "GET",
  url: "datos_factura.php",
  })
  .done(function( respuesta, textStatus, jqXHR ){
   $("#result").html(respuesta);
    if(claseGlobal=="nota_credito_factura"){

        archivoDataGrid="procesos/datagrid_nota_credito.php?&id_contrato="+getD("id_contrato")+"&id_pago="+getD("id_pago_fac")+"&monto_pago="+getD("monto_pago")+"&";
         listar_datos(archivoDataGrid,"datagrid");
    }
    else if(claseGlobal=="nota_debito_factura"){
        archivoDataGrid="procesos/datagrid_nota_debito.php?&id_contrato="+getD("id_contrato")+"&id_pago="+getD("id_pago_fac")+"&monto_pago="+getD("monto_pago")+"&";
         listar_datos(archivoDataGrid,"datagrid");
    }else{
     listar_datos(archivoDataGrid,"datagrid");
    }
  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
    alerta("Error al cargar formulario:\n "+textStatus);
  });
}
function adaptar_cargos_nc(){
  var monto_pago=parseFloat(document.f1.monto_pago.value);
  var cont=0;
  cade='';
  for (i = 1; i < document.f1.checkbox.length; i++) {
    if(monto_pago>0){
    
      var id_cont_serv= document.f1.checkbox[i].value;
      
      var apagar=parseFloat(document.getElementById(id_cont_serv+"_apagar").value);
      var total=parseFloat(document.getElementById(id_cont_serv+"_total").value);
      //alert(":"+monto_pago+":"+total+":"+apagar+":")
      if(monto_pago<=total){
        document.getElementById(id_cont_serv+"_apagar").value=monto_pago;
        monto_pago=0;
      }else {
        document.getElementById(id_cont_serv+"_apagar").value=total;
        monto_pago=monto_pago-total;
      }
      document.f1.checkbox[i].checked = true;
    }else{
      document.f1.checkbox[i].checked = false;
    }
  }
  //lert("monto_pago:"+monto_pago+":")
  if(monto_pago>0){
    alerta("Error, el monto total de la nota de credito no debe ser mayor al total de la factura");
        document.f1.monto_pago.value=0.00;
  }
}
function adaptar_cargos_nd(){
  var monto_pago=parseFloat(document.f1.monto_pago.value);
  var cant_c= document.f1.checkbox.length-1;
  var res=monto_pago/cant_c;
  var monto=parseInt(res);
  var cant_1=cant_c-1
  var monto_ini=monto_pago-(monto*cant_1);


  var cont=0;
  cade='';
  for (i = 1; i < document.f1.checkbox.length; i++) {
    var id_cont_serv= trim(document.f1.checkbox[i].value);
    if(i==1){
      document.getElementById(id_cont_serv+"_apagar").value=monto_ini;
    }else{
      document.getElementById(id_cont_serv+"_apagar").value=monto;
    }
    
    document.f1.checkbox[i].checked = true;
  }
}
function colocar_monto_nc(){
  
  for (i = 1; i < document.f1.checkbox.length; i++) {
    var id_cont_serv= trim(document.f1.checkbox[i].value);
    if(document.f1.checkbox[i].checked == true){
      document.getElementById(id_cont_serv+"_apagar").value=document.getElementById(id_cont_serv+"_total").value;
    }else{
      document.getElementById(id_cont_serv+"_apagar").value='0.00';
    }
  }
}
function colocar_monto_nd(){
  
  for (i = 1; i < document.f1.checkbox.length; i++) {
    var id_cont_serv= trim(document.f1.checkbox[i].value);
    if(document.f1.checkbox[i].checked == true){
      document.getElementById(id_cont_serv+"_apagar").value=document.getElementById(id_cont_serv+"_total").value;
    }else{
      document.getElementById(id_cont_serv+"_apagar").value='0.00';
    }
  }
}
function colocar_monto_nc_unico(id_cont_serv){
  id_cont_serv=trim(id_cont_serv)
  
  for (i = 1; i < document.f1.checkbox.length; i++) {
    var id_cont_serv1= trim(document.f1.checkbox[i].value);
    
    if(id_cont_serv1==id_cont_serv){
      if(document.f1.checkbox[i].checked == true){
        document.getElementById(id_cont_serv+"_apagar").value=document.getElementById(id_cont_serv+"_total").value;
      }else{
        document.getElementById(id_cont_serv+"_apagar").value='0.00';
      }
      return;
    }
  }
}
function colocar_monto_nd_unico(id_cont_serv){
  id_cont_serv=trim(id_cont_serv)
  
  for (i = 1; i < document.f1.checkbox.length; i++) {
    var id_cont_serv1= trim(document.f1.checkbox[i].value);
    
    if(id_cont_serv1==id_cont_serv){
      if(document.f1.checkbox[i].checked == true){
        document.getElementById(id_cont_serv+"_apagar").value=document.getElementById(id_cont_serv+"_total").value;
      }else{
        document.getElementById(id_cont_serv+"_apagar").value='0.00';
      }
      return;
    }
  }
}
function calcularMonto_NC_unico(id_cont_serv){
  id_cont_serv=trim(id_cont_serv)
  //alert(":"+id_cont_serv1+":")
  for (i = 1; i < document.f1.checkbox.length; i++) {
    var id_cont_serv1= trim(document.f1.checkbox[i].value);
    if(id_cont_serv1==id_cont_serv){
    
    //  alert(":"+id_cont_serv1+":")
      document.f1.checkbox[i].checked = true
      calcularMonto_NC();
      return;
    }
  }
}
function calcularMonto_NC(){
  var suma=0;
  var monto_factura=parseFloat(document.f1.monto_factura.value)
  for (i = 1; i < document.f1.checkbox.length; i++) {
    var id_cont_serv= trim(document.f1.checkbox[i].value);
    if(document.f1.checkbox[i].checked == true){
      var apagar=parseFloat(document.getElementById(id_cont_serv+"_apagar").value);
      var total=parseFloat(document.getElementById(id_cont_serv+"_total").value);
      if(apagar>total){
        alerta("Error, el monto total del cargo no debe ser menor a monto de la nota de credito");
        document.f1.monto_pago.value=0.00;
        return ;
      }
      suma=suma+apagar;
    }
  }
  if(suma>monto_factura){
        alerta("Error, el monto total de la nota de credito no debe ser mayor al total de la factura");
        document.f1.monto_pago.value=0.00;
        return ;
  }
  document.f1.monto_pago.value=suma;
}
function calcularMonto_ND_unico(id_cont_serv){
  id_cont_serv=trim(id_cont_serv)
  //alert(":"+id_cont_serv1+":")
  for (i = 1; i < document.f1.checkbox.length; i++) {
    var id_cont_serv1= trim(document.f1.checkbox[i].value);
    if(id_cont_serv1==id_cont_serv){
    
    //  alert(":"+id_cont_serv1+":")
      document.f1.checkbox[i].checked = true
      calcularMonto_ND();
      return;
    }
  }
}
function calcularMonto_ND(){
  var suma=0;
  var monto_factura=parseFloat(document.f1.monto_factura.value)
  for (i = 1; i < document.f1.checkbox.length; i++) {
    var id_cont_serv= trim(document.f1.checkbox[i].value);
    if(document.f1.checkbox[i].checked == true){
      var apagar=parseFloat(document.getElementById(id_cont_serv+"_apagar").value);
      var total=parseFloat(document.getElementById(id_cont_serv+"_total").value);
      
      suma=suma+apagar;
    }
  }
  
  document.f1.monto_pago.value=suma;
}
function registrarCobroCN(){
  var  dat = new Array();
  var ind=0;
  var cont=0;
  cade='';
  for (i = 1; i < document.f1.checkbox.length; i++) {
    if(document.f1.checkbox[i].checked == true){
      var id_cont_serv= trim(document.f1.checkbox[i].value);
      
      var apagar=parseFloat(document.getElementById(id_cont_serv+"_apagar").value);
        cade=cade+"=@";
        
        var pago_factura = new Object();
        pago_factura.id_pago=getD("id_pago");
        pago_factura.id_cont_serv=id_cont_serv;
        pago_factura.apagar=apagar;
        dat[ind]=pago_factura;
        ind++;
    }
  }
  if(cade!='')
  {
    return dat;
  }
  else{
    alerta("Error, debe seleccionar al menos un Servicio para la nota de credito.");
    return false;
  }

}
function registrarCobroCD(){
  var  dat = new Array();
  var ind=0;
  var cont=0;
  cade='';
  for (i = 1; i < document.f1.checkbox.length; i++) {
    if(document.f1.checkbox[i].checked == true){
      var id_cont_serv= trim(document.f1.checkbox[i].value);
      
      var apagar=parseFloat(document.getElementById(id_cont_serv+"_apagar").value);
        cade=cade+"=@";
        
        var pago_factura = new Object();
        pago_factura.id_pago=getD("id_pago");
        pago_factura.id_cont_serv=id_cont_serv;
        pago_factura.apagar=apagar;
        dat[ind]=pago_factura;
        ind++;
    }
  }
  if(cade!='')
  {
    return dat;
  }
  else{
    alerta("Error, debe seleccionar al menos un Servicio para la nota de credito.");
    return false;
  }
 }


function llamar_cargar_deuda_pagos(){
  if(getD('id_contrato')!=''){
    ruta_G='cargar_form_pagos()';
    id_contrato_G=getD("id_contrato");
    cargar_form_cargar_deuda();
  }
  else{
    alerta("debe cargar un cliente para para cargarle una deuda ");
  }
}
function llamar_cargar_nota_credito(){
  if(getD('id_contrato')!=''){
    ruta_G='cargar_form_pagos()';
    id_contrato_G=getD("id_contrato");
    cargar_form_nota_credito_factura();
  }
  else{
    alerta("debe cargar una factura para cargarle una nota de crédito ");
  }
}
function llamar_cargar_nota_debito(){
  if(getD('id_contrato')!=''){
    ruta_G='cargar_form_pagos()';
    id_contrato_G=getD("id_contrato");
    cargar_form_nota_debito_factura();
  }
  else{
    alerta("debe cargar una factura para cargarle una nota de débito ");
  }
}
function llamar_ordenes_tecnicos_pagos(){
  if(getD('id_contrato')!=''){
    ruta_G='cargar_form_pagos()';
    id_contrato_G=getD("id_contrato");
    cargar_form_ordenes_tecnicos();
  }
  else{
    alerta("debe cargar un cliente para generarle una orden");
  }
}

function llamar_actualizar_datos_pagos(){
  if(getD('id_contrato')!=''){
    ruta_G='cargar_form_pagos()';
    id_contrato_G=getD("id_contrato");
    cargar_form_act_contrato();
  }
  else{
    alerta("debe cargar un cliente para para cargarle una deuda ");
  }
}

function ver_notas_cd_sel(){
  var  dat = new Array();
  var ind=0;
  var cont=0;
  cade='';
  for (i = 1; i < document.f1.checkbox.length; i++){
    if(document.f1.checkbox[i].checked == true){
      var id_pago= document.f1.checkbox[i].value
        cade=cade+"=@";
        var pagos = new Object();
        pagos.id_pago=id_pago;
        dat[ind]=pagos;
        ind++;
    }
  }
  if(cade!='')
  {
    return dat;
  }
  else{
    alerta("Error, debe seleccionar al menos un Cargo a pagar.");
    return "";
  }
}
function autorizar_notas_seleccionada(){
  var pagos=ver_notas_cd_sel();
  autorizar_notas_sel(pagos);
}
function autorizar_nota_cd_fiscal(id_pago){
  log("entro aqui:"+id_pago)
  var  dat = new Array();
  var pagos = new Object();
  pagos.id_pago=id_pago;
  dat[0]=pagos;
  autorizar_notas_sel(dat);
}

function autorizar_notas_sel(pagos){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"autorizar_notas_sel",
      "datos":{"pagos":pagos}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        alerta("Solicitud Procesada con exito");
        conexionPHP('formulario.php','notas_conf');
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      if ( console && console.log ) {
         alerta("ERROR DURANTE TRANSACCION\n"+respuesta.error);
      }
   });
}

function negar_notas_seleccionada(){
  var pagos=ver_notas_cd_sel();
  negar_notas_sel(pagos);
}
function negar_nota_cd_fiscal(id_pago){
  log("entro a negar:"+id_pago)
  var  dat = new Array();
  var pagos = new Object();
  pagos.id_pago=id_pago;
  dat[0]=pagos;
  negar_notas_sel(dat);
}

function negar_notas_sel(pagos){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"negar_notas_sel",
      "datos":{"pagos":pagos}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        alerta("Solicitud Procesada con exito");
        conexionPHP('formulario.php','notas_conf');
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      if ( console && console.log ) {
         alerta("ERROR DURANTE TRANSACCION\n"+respuesta.error);
      }
   });
}


function traerBanco(){
  cambia_forma_pago();
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traerBanco",
      "datos":{"id_tipo_pago":getD("id_tipo_pago")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        setHTML("id_banco",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
//location.href="ReporteJava/recibo_pago.php?&id_pago="+getD("id_pago")+"&";


function  imprimir_recibo_pago(id_pago){
  $.ajax({
    data:{"id_pago":id_pago },
    type: "GET",
    url: "ReporteJava/recibo_pago.php",
  })
  .done(function( respuesta, textStatus, jqXHR ){
    var ventimp = window.open('print.html', 'popimpr');
    ventimp.document.write(respuesta);
    ventimp.print();
    ventimp.close();
  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
    alerta("Error al cargar formulario:\n "+textStatus);
  });
}