// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function  cargar_form_contrato(){
   $.ajax({
    type: "GET",
    url: "Formulario/contrato.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
    claseGlobal='contrato';
     $("#principal").html(respuesta);
     activar_validar_datos();

   //  listar_datos("procesos/datagrid_contrato_servicio_temp.php?&id_contrato="+getD("id_contrato")+"&","datagrid");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  cargar_form_act_contrato(){
   $.ajax({
    type: "GET",
    url: "Formulario/act_contrato.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     claseGlobal='act_contrato';
     $("#principal").html(respuesta);
     foco("nro_contrato");
     if(id_contrato_G!=''){
      buscar_id_contrato_id(id_contrato_G);
     }
     activar_validar_datos();
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_contrato(accion,clase){
         validardatos("gestion_contrato",accion,clase)
}
function registrar_contrato(accion,clase){
  if(parseInt(getD("cont_serv"))>0){
      if( valida_tipo_cliente() && validaEdif())
      {
         validardatos("gestion_contrato",accion,clase)
      }
  }else{
     alerta("Error, Debe cargar por lo menos un PAQUETE BASICO.");
  }

}
function  gestionar_contrato_servicio_temp(accion,clase){
  if(validar_datos_form_f2()){
    gestion_contrato_servicio_temp(accion,clase);
  }else{$("#error_f2").html(errorGlobal);}
}
function  gestionar_contrato_servicio(accion,clase){
         validardatos_f2("gestion_contrato_servicio",accion,clase)
}
function  gestion_contrato_servicio_temp(accion,clase){
  
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_cont_serv":getD("id_cont_serv"),
                  "id_serv":getD("id_serv"),
                  "id_contrato":getD("id_contrato"),
                  "fecha_inst":getD("fecha_inst"),
                  "cant_serv":getD("cant_serv"),
                  "costo_cobro":getD("costo_cobro")
               }
         }];
         $.ajax({
           data:{"parametros":JSON.stringify(parametros)},
           type: "POST",
           dataType: "json",
           url: "controlador.php",
         })
         .done(function( respuesta, textStatus, jqXHR ){
            //ventaG.close();
            if( respuesta.success ) {
               listar_datos("procesos/datagrid_contrato_servicio_temp.php?&id_contrato="+getD("id_contrato")+"&","datagrid");
               cargar_servicio_tv_temp();
              // setD("cant_serv",document.getElementById("id_cant")[document.getElementById("id_cant").selectedIndex].text);
               setD("costo_cobro","0");
               //setD("id_cant","");
               //disabled("cant_serv");
              // disabled("id_cant");
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
function  gestion_contrato_servicio(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_cont_serv":getD("id_cont_serv"),
                  "id_serv":getD("id_serv"),
                  "id_contrato":getD("id_contrato"),
                  "fecha_inst":getD("fecha_inst"),
                  "cant_serv":getD("cant_serv"),
                  "costo_cobro":getD("costo_cobro")
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
               listar_datos("procesos/datagrid_contrato_servicio.php?&id_contrato="+getD("id_contrato")+"&","suscripcion");
               cargar_servicio_tv_c();
               //disabled("id_cant");
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
function  gestion_contrato(accion,clase){

         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_contrato":getD("id_contrato"),
                  "id_venta":getD("id_venta"),
                  "id_calle":getD("id_calle"),
                  "id_persona":getD("cli_id_persona"),
                  "vendedor_id_persona":getD("id_persona"),
                  "nro_contrato":getD("nro_contrato"),
                  "fecha_contrato":getD("fecha_contrato"),
                  "observacion":getD("observacion"),
                  "etiqueta":getD("etiqueta"),
                  "costo_dif_men":getD("costo_dif_men"),
                  "status_contrato":getD("status_contrato"),
                  "id_serv_v":getD("id_serv_v"),
                  "direc_adicional":getD("direc_adicional"),
                  "numero_casa":getD("numero_casa"),
                  "id_edif":getD("id_edif"),
                  "numero_piso":getD("numero_piso"),
                  "postel":getD("postel"),
                  "taps":getD("taps"),
                  "pto":getD("pto"),
                  "id_g_a":getD("id_g_a"),
                  "id_urb":getD("id_urb"),
                  "cod_id_persona":getD("cod_id_persona"),
                  "contrato_fisico":getD("contrato_fisico"),
                  "tipo_fact":getOption("tipo_fact"),
                  "etiqueta_n":getD("etiqueta_n"),
                  "contrato_imp":contrato_impreso(accion),
                  "ultima_act":getD("ultima_act"),

                  "cedula":getD("cedula"),
                  "nombre":get_nombre_cli(),
                  "apellido":getD("apellido"),
                  "telefono":getD("telefono"),
                  "telf_casa":getD("telf_casa"),
                  "email":getD("email"),
                  "telf_adic":getD("telf_adic"),
                  "numero_casa":getD("numero_casa"),
                  "tipo_cliente":getD("tipo_cliente"),
                  "inicial_doc":getD("inicial_doc"),
                  "fecha_nac":getD("fecha_nac")
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
              if(accion=='incluir'){
                cargar_form_contrato();
              }else{
                  if(ruta_G!=''){
                    eval(ruta_G);
                  }else{
                    cargar_form_act_contrato();
                  }
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
function  buscar_nro_contrato(){
   var parametros=[{
            "clase":"act_contrato",
            "consulta":"select * from vista_contrato_auditoria where nro_contrato='"+getD("nro_contrato")+"'"
         }]
   buscar_contrato(parametros);
}
function  buscar_cedula_contrato(){
   var parametros=[{
            "clase":"act_contrato",
            "consulta":"select * from vista_contrato_auditoria where cedula ='"+getD("cedula_b")+"'"
         }]
   buscar_contrato(parametros);
}
function  buscar_precinto_contrato(){
   var parametros=[{
            "clase":"act_contrato",
            "consulta":"select * from vista_contrato_auditoria where etiqueta ='"+getD("precinto_b")+"'"
         }]
   buscar_contrato(parametros);
}
function  buscar_id_contrato(id_contrato){
   var parametros=[{
            "clase":"act_contrato",
            "consulta":"select * from vista_contrato_auditoria where id_contrato='"+getD("id_contrato")+"'"
         }]
   buscar_contrato(parametros);
}
function  buscar_id_cache(){
  if(getD("id_cache")!=''){
    if(getD("id_cache")!=getD("id_contrato")){
     var parametros=[{
              "clase":"act_contrato",
              "consulta":"select * from vista_contrato_auditoria where id_contrato='"+getD("id_cache")+"'"
           }]
     buscar_contrato(parametros);
   }
  }
}
function  buscar_id_contrato_id(id_contrato){
   var parametros=[{
            "clase":"act_contrato",
            "consulta":"select * from vista_contrato_auditoria where id_contrato='"+id_contrato+"'"
         }]
   buscar_contrato(parametros);
}
function  buscar_id_persona_cliente(id_persona){
   var parametros=[{
            "clase":"vista_cliente",
            "consulta":"select * from vista_cliente where id_persona='"+id_persona+"'"
         }]
   buscar_contrato(parametros);
}
function  buscar_id_persona_persona(id_persona){
   var parametros=[{
            "clase":"persona",
            "consulta":"select * from persona where id_persona='"+id_persona+"'"
         }]
   buscar_contrato(parametros);
}
function  buscar_contrato(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_contrato(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_contrato(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
          if(confirm("Ningun resultado encontrato desea cargar la busqueda avanzada?")){
            ajaxVentana('Abonados', "busqueda_avanzada");
          
          }
          setD("nro_contrato","");
          /*
         switch(clase){
            case "act_contrato":
               disabled("modificar");
               disabled("imprimir_cont");
               disabled("imprimir_soli");
               break;
            default:
            log( "no existe la clase: "+clase+" para asignar parametros");
         }
         */
      }
      else if(cantidad==1){
         var campo=objetos[objeto].data[0];
         switch(clase){
            case "act_contrato":
            asigna_cache(campo);
            if(claseGlobal=='act_contrato'){
               setD("id_contrato",campo.id_contrato);
               setD("cli_id_persona",campo.cli_id_persona);
               setD("cedula",campo.cedula);
               setD("nombre",campo.nombre);
               setD("apellido",campo.apellido);
               setD("telefono",campo.telefono);
               setD("telf_casa",campo.telf_casa);
               setD("email",campo.email);
               setD("telf_adic",campo.telf_adic);
               setD("tipo_cliente",campo.tipo_cliente);
               activa_tipo_c(campo.nombre,campo.apellido);
               setD("inicial_doc",campo.inicial_doc);
               setD("fecha_nac",formatdatei(campo.fecha_nac));
               
               setD("id_calle",campo.id_calle);
               setD("id_persona",campo.id_persona);
               setD("nro_contrato",campo.nro_contrato);
               setD("fecha_contrato",formatdatei(campo.fecha_contrato));
               setD("observacion",campo.observacion);
               setD("etiqueta",campo.etiqueta);
               setD("costo_dif_men",campo.costo_dif_men);
               setD("status_contrato",campo.status_contrato);
               
               setD("direc_adicional",campo.direc_adicional);
               setD("numero_casa",campo.numero_casa);
               if(campo.id_edif!=''){
                setD("id_edif",campo.id_edif);
                setD("numero_piso",campo.numero_piso);
                enabled("id_edif");
                enabled("numero_piso");
               }else{
                 setD("id_edif",'');
                 setD("numero_piso",'');
                 disabled("id_edif");
                 disabled("numero_piso");
               }
               setD("numero_piso",campo.numero_piso);
               setD("postel",campo.postel);
               setD("taps",campo.taps);
               setD("pto",campo.pto);
               setD("id_g_a",campo.id_g_a);
               setD("id_urb",campo.id_urb);
               setD("cod_id_persona",campo.cod_id_persona);
               setD("n_contrato",campo.nro_contrato);
               setD("n_contrato1",campo.nro_contrato);
               setD("contrato_fisico",campo.contrato_fisico);
               setD("etiqueta_n",campo.etiqueta_n);
               setOption("tipo_fact",campo.tipo_fact);
               setOption("contrato_imp",campo.contrato_imp);
               setD("ultima_act",formatdatei(campo.ultima_act));
               setD("id_serv_v",campo.id_serv_v);
               setD("cedula",campo.cedula);

               setD("id_zona",campo.id_zona);
               setD("id_esta",campo.id_esta);
               setD("id_mun",campo.id_mun);
               setD("id_ciudad",campo.id_ciudad);
               setD("id_franq",campo.id_franq);
               setD("id_sector",campo.id_sector);

               setD("status1",campo.status_contrato);
               document.getElementById("status1").style='color:'+campo.color+';font-weight:blod; font-size:14;';
               document.f1.saldo1.value=campo.saldo;
              if(parseFloat(getD("saldo1"))>0){
                document.getElementById("saldo1").style='color:#FF0000;font-weight:blod; font-size:16;';
              }else{
                document.getElementById("saldo1").style='color:#00BB00;font-weight:blod; font-size:16;';
              }
              document.getElementById("dato_saldo").style='display:block;';


                divDataGrid="suscripcion";
                archivoDataGrid="procesos/datagrid_contrato_servicio.php?&id_contrato="+getD("id_contrato")+"&";
                listar_datos(archivoDataGrid,divDataGrid);

/*
                divDataGrid="estado_cuenta"; 
                archivoDataGrid="procesos/datagrid_estado_cuenta.php?&id_contrato="+getD("id_contrato")+"&";
                listar_datos(archivoDataGrid,divDataGrid);
*/

                divDataGrid="terminales"; 
                archivoDataGrid="procesos/datagrid_equipo_sistema_contrato.php?&id_contrato="+getD("id_contrato")+"&";
                listar_datos(archivoDataGrid,divDataGrid);

                //listar_datos("procesos/datagrid_equipo_sistema.php","datagrid");  

                enabled("modificar");
                enabled("imprimir_cont");
                enabled("imprimir_soli");

                setHTML("estado_cuenta","");
				
				mostrar("act_contrato");
				mostrar("mostrar_busqueda");
				ocultar("seccion_busqueda");
				

              }
              else if(claseGlobal=='cargar_deuda'){
                setD("nro_contrato",campo.nro_contrato);
                setD("id_contrato",campo.id_contrato);
                setD("cedula_b",campo.cedula);
                setD("nombre",campo.nombre);
                setD("apellido",campo.apellido);
                setD("status_contrato",campo.status_contrato);
                document.getElementById("status_contrato").style='color:'+campo.color+';font-weight:blod; font-size:14;';
                eliminar_cargar_deuda_contrato();
              }
              else if(claseGlobal=='ordenes_tecnicos'){
                setD("nro_contrato",campo.nro_contrato);
                setD("id_contrato",campo.id_contrato);
                setD("cedula_b",campo.cedula);
                setD("nombre",campo.nombre);
                setD("apellido",campo.apellido);
                setD("status_contrato",campo.status_contrato);
                document.getElementById("status_contrato").style='color:'+campo.color+';font-weight:blod; font-size:14;';
                
              }
              else if(claseGlobal=='llamadas'){
                setD("nro_contrato",campo.nro_contrato);
                setD("id_contrato",campo.id_contrato);
                setD("cedula_b",campo.cedula);
                setD("nombre",campo.nombre);
                setD("apellido",campo.apellido);
                setD("status_contrato",campo.status_contrato);
                document.getElementById("status_contrato").style='color:'+campo.color+';font-weight:blod; font-size:14;';
                
              }
              else if(claseGlobal=='equipo_sistema'){
                setD("nro_contrato",campo.nro_contrato);
                setD("id_contrato",campo.id_contrato);
                setD("nombre",campo.nombre);
                setD("apellido",campo.apellido);
                setD("status_contrato",campo.status_contrato);
                document.getElementById("status_contrato").style='color:'+campo.color+';font-weight:blod; font-size:14;';
              }
              else if(claseGlobal=='nota_credito_factura'){
                setD("nro_contrato",campo.nro_contrato);
                c_nro_factura_nc();
              }
              else if(claseGlobal=='nota_debito_factura'){
                setD("nro_contrato",campo.nro_contrato);
                c_nro_factura_nd();
              }
              else if(claseGlobal=='pagos'){
                setD("id_contrato",campo.id_contrato);
                setD("nro_contrato",campo.nro_contrato);
                //document.getElementById("abonado").innerHTML="<label class='border-head'><h4>Abonado: </h4></label > </label> "+campo.nro_contrato+"</label > ";
				document.getElementById("abonado").innerHTML="<label>Abonado: </label > <label class='border-head'> <h4>"+campo.nro_contrato+"</h4></label >";
				
                document.getElementById("status").innerHTML="<label>Status: </label > <span style='color:"+campo.color+"; font-weight:blod; font-size:11pt'  >"+campo.status_contrato+" </span > ";
				
                document.getElementById("ced").innerHTML="<label>C.I/RIF: </label> <label class='border-head'> <h4>"+campo.inicial_doc+campo.cedula+"</h4></label >  ";
                if(campo.telefono!=''){
                  var tele=campo.telefono;
                  if(campo.telf_casa!=''){
                    tele=tele+" / "+campo.telf_casa;
                  }
                  if(campo.telf_adic!=''){
                    tele=tele+" / "+campo.telf_adic;
                  }
                }
                else if(campo.telf_casa!=''){
                  var tele=campo.telf_casa;
                  if(campo.telf_adic!=''){
                    tele=tele+" / "+campo.telf_adic;
                  }
                }
                else if(campo.telf_adic!=''){
                  var tele=campo.telf_adic;
                }
                
                document.getElementById("tel").innerHTML="<label>TELF: </label> <label class='border-head'> <h4>"+tele+"</h4></label >  ";
                
                document.getElementById("cliente").innerHTML="<label>CLIENTE: </label > <label class='border-head'><h4>"+campo.nombre+" "+campo.apellido+"</h4></label >";
				
				document.getElementById("direccion").innerHTML="<label>DIRECCION: </label > <label class='border-head'><h4>"+campo.nombre_sector+"; "+campo.nombre_calle+"; "+campo.numero_casa+"</h4></label >";
				
				document.getElementById("referencia").innerHTML="<label>REFERENCIA: </label > <label class='border-head'><h4>"+campo.direc_adicional+"</h4></label >";
				               
                
                divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
                archivoDataGrid="procesos/datagrid_pagos.php?&id_contrato="+getD('id_contrato')+"&";

                listar_datos(archivoDataGrid,divDataGrid,'',"resp_adaptar_cargos()")
				
                foco("monto_pago");

                setHTML("estado_cuenta","");
				
				mostrar("pagos");
				mostrar("mostrar_busqueda");
				ocultar("seccion_busqueda");
				
				
				
								
				
              }
              
               break;
            case "vista_cliente":
               setD("cli_id_persona",campo.id_persona);
               setD("cedula",campo.cedula);
               setD("nombre",campo.nombre);
               setD("apellido",campo.apellido);
               setD("telefono",campo.telefono);
               setD("telf_casa",campo.telf_casa);
               setD("email",campo.email);
               setD("telf_adic",campo.telf_adic);
               setD("tipo_cliente",campo.tipo_cliente);
               activa_tipo_c(campo.nombre,campo.apellido);
               setD("inicial_doc",campo.inicial_doc);
               setD("fecha_nac",formatdatei(campo.fecha_nac));
               
               enabled("registrar");
               break;
            case "persona":
               setD("cli_id_persona",campo.id_persona);
               setD("cedula",campo.cedula);
               setD("nombre",campo.nombre);
               setD("apellido",campo.apellido);
               setD("telefono",campo.telefono);
               enabled("registrar");
               break;
            default:
            log( "no existe la clase: "+clase+" para asignar parametros");
         }
      }
      else{
        var cad='<ul class="nav nav-tabs nav-stacked span3">';
        for (var i = 0 ; i <cantidad ; i++) {
          var campo=objetos[objeto].data[i];
          cad=cad+'<li><a  href="javascript:buscar_id_contrato_msg(\''+campo.id_contrato+'\');">Abonado: '+campo.nro_contrato+' &nbsp; &nbsp; &nbsp; Sector: '+campo.nombre_sector+'</a></li>'
        }
        cad=cad+'</ul>';
       

         alerta("Aviso, La busqueda retorno "+cantidad+" registros<br>"+cad);
      }
   }
}


function buscar_id_contrato_msg(id_contrato){
  buscar_id_contrato_id(id_contrato);
  mje_Glo.close();
}

function buscar_id_contrato_busqueda(id_contrato){
  buscar_id_contrato_id(id_contrato);
  ventanaModal.close();
}


function activa_tipo_c(nombre='', apellido=''){
  if(getD("tipo_cliente")=="NATURAL"){
    mostrar("tipo_per");
    ocultar("tipo_jur");
    document.getElementById("inicial_doc").innerHTML='<option value="V">'+_("V")+'</option><option value="E">'+_("E")+'</option>';
    document.f1.empresa.disabled=true;
    document.f1.nombre.disabled=false;
    document.f1.apellido.disabled=false;
    document.f1.empresa.value='';
    document.f1.nombre.value=nombre;
    document.f1.apellido.value=apellido;
  }
  else {
    mostrar("tipo_jur");
    ocultar("tipo_per");
    document.getElementById("inicial_doc").innerHTML='<option value="J">'+_("J")+'</option><option value="G">'+_("G")+'</option><option value="V">'+_("V")+'</option><option value="E">'+_("E")+'</option>';
    document.f1.empresa.disabled=false;
    document.f1.nombre.disabled=true;
    document.f1.apellido.disabled=true;
    document.f1.nombre.value='';
    document.f1.apellido.value='';
    document.f1.empresa.value=nombre;
  }

}


function get_nombre_cli(){
  if(getD("tipo_cliente")=="NATURAL"){
    return getD("nombre");
  }
  else{
    return getD("empresa");
  }
}

function valida_ced_tipo_cliente(){
  if(getD("tipo_cliente")=="NATURAL"){
    if(validaCampo(document.f1.cedula,isCedula)){
      return true;
    }
    else{
      return false;
    }
  }
  else {
    if(validaCampo(document.f1.cedula,isRif)){
      
      return true;
    }
    else{
      return false;
    }
  }
}
function validar_dato_cliente(){
  if(valida_ced_tipo_cliente()){
    $.ajax({data:{
        "parametros":JSON.stringify({
        "clase":"verifica_cedula",
        "datos":{"cedula":getD("cedula")}
      })},
       type: "GET",
       dataType: "json",
       url: "controlador_informacion.php",
    })
     .done(function( respuesta, textStatus, jqXHR ) {
      var c=respuesta.campo;
        if(respuesta.success){
          if(c.existe){
            if(c.tipo=="CLIENTE"){
              if (confirm("AVISO: la cedula/rif corresponde al cliente: "+c.nombre+", desea continuar? ")){
                log( "entro a buscar: " + c.id_persona);
                buscar_id_persona_cliente(c.id_persona)
              }else{
                setD("cedula","");
              }
            }
            else{
              if (confirm("AVISO: la cedula corresponde al empleado: "+c.nombre+", desea continuar? ")){
               buscar_id_persona_persona(c.id_persona)
              }
            }
          }
        }else{
           log( "Error: " + respuesta.error);
        }
     });
  }
}


function traer_numero_abonado(){
  
    $.ajax({data:{
        "parametros":JSON.stringify({
        "clase":"traer_numero_abonado",
        "datos":{"id_franq":getD("id_franq")}
      })},
       type: "GET",
       dataType: "json",
       url: "controlador_informacion.php",
    })
     .done(function( respuesta, textStatus, jqXHR ) {
      var c=respuesta.campo;
        if(respuesta.success ){
          setD("nro_contrato_nuevo",c.nro_abonado);
          setD("nro_contrato",c.nro_abonado);
        }else{
           log( "Error: " + respuesta.error);
        }
     });
}
function traer_numero_abonado_zona(){
  
    $.ajax({data:{
        "parametros":JSON.stringify({
        "clase":"traer_numero_abonado_zona",
        "datos":{"id_zona":getD("id_zona")}
      })},
       type: "GET",
       dataType: "json",
       url: "controlador_informacion.php",
    })
     .done(function( respuesta, textStatus, jqXHR ) {
      var c=respuesta.campo;
        if(respuesta.success ){
          setD("nro_contrato_nuevo",c.nro_abonado);
          setD("nro_contrato",c.nro_abonado);
        }else{
           log( "Error: " + respuesta.error);
        }
     });
}
function traer_numero_contrato(){
    $.ajax({data:{
        "parametros":JSON.stringify({
        "clase":"traer_numero_contrato",
        "datos":{"id_persona":getD("id_persona")}
      })},
       type: "GET",
       dataType: "json",
       url: "controlador_informacion.php",
    })
     .done(function( respuesta, textStatus, jqXHR ) {
      var c=respuesta.campo;
        if(respuesta.success ){
          if(c.existe){
            setD("contrato_fisico",c.contrato_fisico);
          }else{
            alerta("Error, este vendedor no tiene asignado y recibido ningun nro de contrato");
            document.f1.contrato_fisico.value='';
          }
        }else{
           log( "Error: " + respuesta.error);
        }
     });
}
function cargarServicioMensual_c_temp(){
    $.ajax({data:{
        "parametros":JSON.stringify({
        "clase":"cargarServicioMensual_c_temp",
        "datos":{"id_tipo_servicio":getD("id_tipo_servicio"),
                 "id_contrato":getD("id_contrato")}
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
            //setD("id_cant",c.id_cant_e);
            //setD("cant_serv",document.getElementById("id_cant")[document.getElementById("id_cant").selectedIndex].text);
           // disabled("id_cant");
            //disabled("cant_serv");
          }else{
            setD("cant_serv","1");
           // enabled("id_cant");
            //enabled("cant_serv");
          }
          setD("costo_cobro","0");
        }else{
           log( "Error: " + respuesta.error);
        }
     });
}
function cargarServicioMensual_c(){
    $.ajax({data:{
        "parametros":JSON.stringify({
        "clase":"cargarServicioMensual_c",
        "datos":{"id_tipo_servicio":getD("id_tipo_servicio"),
                 "id_contrato":getD("id_contrato")}
      })},
       type: "GET",
       dataType: "json",
       url: "controlador_informacion.php",
    })
     .done(function( respuesta, textStatus, jqXHR ) {
      var c=respuesta.campo;
        if(respuesta.success ){
          //setHTML("id_cant",c.id_cant);
          setHTML("id_serv",c.id_serv);
          if(c.id_cant_e!=''){
            //setD("id_cant",c.id_cant_e);
           // disabled("id_cant");
          }else{
           // enabled("id_cant");
          }
        }else{
           log( "Error: " + respuesta.error);
        }
     });
}
function cargar_servicio_tv_temp(){
    $.ajax({data:{
        "parametros":JSON.stringify({
        "clase":"cargar_servicio_tv_temp",
        "datos":{"id_tipo_servicio":getD("id_tipo_servicio"),
                 "id_cant":getD("id_cant"),
                 "id_contrato":getD("id_contrato")}
      })},
       type: "GET",
       dataType: "json",
       url: "controlador_informacion.php",
    })
     .done(function( respuesta, textStatus, jqXHR ) {
      var c=respuesta.campo;
        if(respuesta.success ){
          setHTML("id_serv",c.id_serv);
        }else{
           log( "Error: " + respuesta.error);
        }
     });
}
function cargar_servicio_tv_c(){
    $.ajax({data:{
        "parametros":JSON.stringify({
        "clase":"cargar_servicio_tv_c",
        "datos":{"id_tipo_servicio":getD("id_tipo_servicio"),
                 "id_cant":getD("id_cant"),
                 "id_contrato":getD("id_contrato")}
      })},
       type: "GET",
       dataType: "json",
       url: "controlador_informacion.php",
    })
     .done(function( respuesta, textStatus, jqXHR ) {
      var c=respuesta.campo;
        if(respuesta.success ){
          setHTML("id_serv",c.id_serv);
        }else{
           log( "Error: " + respuesta.error);
        }
     });
}
function habilitaEdif(){
  if(getOption("tipo_costo")=="CASA"){
    disabled("id_edif");
    disabled("numero_piso");
    document.getElementById("id_edif").selectedIndex=0;
    setD("numero_piso","");
  }
  else{
    enabled("id_edif");
    enabled("numero_piso");
  }
}
function validaEdif(){
  if(getOption("tipo_costo")=="CASA"){
    return true;
  }
  else{
    if(validaCampo(document.f1.numero_piso,isInteger) && validaCampo(document.f1.edificio,isSelect,false,"Debe Selecionar un Edificio"))
    {
      return true;
    }
    else{
      return false;
    }
  }
}

function traer_costo_servicio(){
  $.ajax({data:{
        "parametros":JSON.stringify({
        "clase":"traer_costo_servicio",
        "datos":{"id_serv":getD("id_serv")}
      })},
       type: "GET",
       dataType: "json",
       url: "controlador_informacion.php",
    })
     .done(function( respuesta, textStatus, jqXHR ){
      var c=respuesta.campo;
        if(respuesta.success ){
          
          setD("costo_cobro",c.costo_cobro);
          if(c.tarifa_esp=="TRUE"){
            enabled("costo_cobro");
          }
          else{
            disabled("costo_cobro");
          }
        }else{
           log( "Error: " + respuesta.error);
        }
     });
}

function validarcontrato_control(){
  $.ajax({data:{
        "parametros":JSON.stringify({
        "clase":"validarcontrato_control",
        "datos":{"nro_recibo":getD("contrato_fisico"),
        "id_persona":getD("id_persona")}
      })},
       type: "GET",
       dataType: "json",
       url: "controlador_informacion.php",
    })
     .done(function( respuesta, textStatus, jqXHR ){
      var c=respuesta.campo;
        if(respuesta.success ){
          if(c.existe){
            alerta("Error, el numero de contrato no esta ASIGNADO y RECIBIDO por este vendedor");
            document.f1.contrato_fisico.value='';
          }

        }else{
           log( "Error: " + respuesta.error);
        }
     });
}

function contrato_impreso(accion){
  if(accion=="incluir"){
    return getD("contrato_imp");
  }else{
    return getOption("contrato_imp");
  }
}
function valida_tipo_cliente(){
    log( "valida_tipo_cliente");
  if(getD("tipo_cliente")=="NATURAL"){
     log( "valida_tipo_cliente");
    if(validaCampo(document.f1.cedula,isCedula,true) && validaCampo(document.f1.nombre,isName) && validaCampo(document.f1.apellido,isName)){
      return true;
    }
    else{
      return false;
    }
    
  }
  else{
    if(validaCampo(document.f1.cedula,isRif,true) && validaCampo(document.f1.empresa,isTexto)){
      return true;
    }
    else{
      return false;
    }
  }
}
function eliminarcontrato_servicio(id_cont_serv,id_serv,id_contrato){
  setD("id_cont_serv",id_cont_serv);
  setD("id_serv",id_serv);
  gestionar_contrato_servicio('eliminar','contrato_servicio');
}
function eliminarcontrato_servicio_temp(id_cont_serv,id_serv,id_contrato){
  setD("id_cont_serv",id_cont_serv);
  setD("id_serv",id_serv);
  gestion_contrato_servicio_temp('eliminar','contrato_servicio_temp');

}

function validarcontrato(){
  if(claseGlobal=="act_contrato" || claseGlobal=="llamadas" ||  claseGlobal=="pagos"  ||  claseGlobal=="cargar_deuda"  ||  claseGlobal=="equipo_sistema" ||  claseGlobal=="ordenes_tecnicos" ){
    var ncont=getD("nro_contrato");
    for(var i=ncont.length;i<dig_cont_G;i++){
      ncont="0"+ncont;
    }
    if(serie_correl_G!='0' && serie_correl_G!=''){
      if(getD("nro_contrato").length<=dig_cont_G){
        ncont=inicialG+ncont;
      }
    }
    
    setD("nro_contrato",ncont);
    buscar_nro_contrato();
  }else{
    var ncont=nro_contrato();
    for(var i=ncont.length;i<dig_cont_G;i++){
      ncont="0"+ncont;
    }
    if(serie_correl_G!='0' && serie_correl_G!=''){
      if(nro_contrato().length<=dig_cont_G){
        ncont=inicialG+ncont;
      }
    }
    
    document.f1.nro_contrato.value=ncont;
    conexionPHP("validarExistencia.php","1=@vista_contrato","nro_contrato=@"+ncont);
  }
}



function mostrar_estado_cuenta(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
        divDataGrid="estado_cuenta"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
        archivoDataGrid="procesos/datagrid_estado_cuenta.php?&id_contrato="+getD('id_contrato')+"&";
        listar_datos(archivoDataGrid,divDataGrid,"","mostrar_div('estado_cuenta')");
  }
}

function mostrarHistorial_pago(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
        divDataGrid="historial"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
        archivoDataGrid="reportes/historialpago.php?&id_contrato="+getD('id_contrato')+"&";
        listar_datos(archivoDataGrid,divDataGrid,"","mostrar_div('historial')");
  }
}

function mostrarHistorial_pago_boxi(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
        divDataGrid="historial_boxi"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
        archivoDataGrid="reportes/historialpago_boxi.php?&id_contrato="+getD('id_contrato')+"&";
        listar_datos(archivoDataGrid,divDataGrid,"","mostrar_div('historial_boxi')");
  }
}

function mostrarHistorial_ordenes(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
        divDataGrid="estado"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
        archivoDataGrid="reportes/estadocuenta.php?&id_contrato="+getD('id_contrato')+"&";
        listar_datos(archivoDataGrid,divDataGrid,"","mostrar_div('estado')");
  }
}
function mostrar_Suscripcion(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
        divDataGrid="suscripcion"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
        archivoDataGrid="procesos/datagrid_suscripcion.php?&id_contrato="+getD('id_contrato')+"&";
        listar_datos(archivoDataGrid,divDataGrid,"","mostrar_div('suscripcion')");
  }
}

function mostrar_Suscripcion_comp(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
        divDataGrid="suscripcion"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
        archivoDataGrid="procesos/datagrid_suscripcion.php?&id_contrato="+getD('id_contrato')+"&status_cont_ser=TODO&";
        listar_datos(archivoDataGrid,divDataGrid,"","mostrar_div('suscripcion')");
  }
}

function mostrarHistorial_comunicacion(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
        divDataGrid="comunicacion"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
        conexionPHP_sms("sms.php","listadoSMSEsp",getD('id_contrato'));
  }
}

function mostrarHistorial_vitacora(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
        divDataGrid="vitacora"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
        archivoDataGrid="procesos/datagrid_llamadas_his.php?&id_contrato="+getD('id_contrato')+"&";
        listar_datos(archivoDataGrid,divDataGrid,"","mostrar_div('vitacora')");
  }
}

function mostrarObservaciones(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
        divDataGrid="observa"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
        archivoDataGrid="procesos/datagrid_info_adic.php?&id_contrato="+getD('id_contrato')+"&";
        listar_datos(archivoDataGrid,divDataGrid,"","mostrar_div('observa')");
  }
}


function mostrarHistorial_dc(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
        divDataGrid="exoneracion"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
        archivoDataGrid="procesos/exoneracion.php?&id_contrato="+getD('id_contrato')+"&";
        listar_datos(archivoDataGrid,divDataGrid,"","mostrar_div('exoneracion')");
  }
}



function mostrarHistorial_viejo(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
        divDataGrid="historico"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
        archivoDataGrid="reportes/historicos.php?&id_contrato="+getD('id_contrato')+"&";
        listar_datos(archivoDataGrid,divDataGrid,"","mostrar_div('historico')");
  }
}



function mostrarpago_depositos(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
            divDataGrid="pagodep";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
            archivoDataGrid="procesos/datagrid_pagodeposito_act.php?&id_contrato="+getD('id_contrato')+"&";
            listar_datos(archivoDataGrid,divDataGrid,"","mostrar_div('pagodep')");
  }
}


function mostrar_promociones(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
            divDataGrid="promocion";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
            archivoDataGrid="procesos/datagrid_promo_contrato.php?&id_contrato="+getD('id_contrato')+"&";
            listar_datos(archivoDataGrid,divDataGrid,"","mostrar_div('promocion')");
  }
}

function mostrar_prop(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
            divDataGrid="camb_prop";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
            archivoDataGrid="procesos/camb_prop.php?&id_contrato="+getD('id_contrato')+"&";
            listar_datos(archivoDataGrid,divDataGrid,"","mostrar_div('camb_prop')");
  }
}

function ver_detalle_saldo(){
  mostrar_estado_cuenta();
  //document.getElementById("estado_cuenta").focus();
}
function mostrar_div(id){
  //log("entro ");
  window.location.replace('#'+id);
  //document.getElementById("saldo_e_c").select();
  //document.getElementById("saldo_e_c").focus();
  //document.getElementById("saldo_e_c").style='display:block;';
}
function asigna_cache(campo){
  document.getElementById("cache_abonado").style='display:block;';
  var cant=document.getElementById("id_cache").length;
  var sel_value = new Array();
  var sel_text = new Array();

  for (var i = 0; i < cant; i++){
    sel_value[i]=document.getElementById("id_cache")[i].value;
    sel_text[i]=document.getElementById("id_cache")[i].text;
  }

  $('#id_cache').html('');
  $('#id_cache').append(new Option(campo.nro_contrato+" --> "+campo.nombre+" "+campo.apellido,campo.id_contrato, true, true));

  var cont=0;
  for (var i = 0; i < cant; i++){
    if(campo.id_contrato!=sel_value[i]){
      $('#id_cache').append(new Option(sel_text[i],sel_value[i], true, true));
      cont++;
    }
    if(cont==9){
      break;
    }
  }
 // setD("id_cache",campo.id_contrato);
}


function llamar_cargar_deuda_act(){
  if(getD('id_contrato')!=''){
    ruta_G='cargar_form_act_contrato()';
    id_contrato_G=getD("id_contrato");
    cargar_form_cargar_deuda();
  }
  else{
    alerta("debe cargar un cliente para para cargarle una deuda ");
  }
}



function refrescar_terminales_todos(){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
    $.ajax({data:{
        "parametros":JSON.stringify({
        "clase":"refrescar_terminales_todos",
        "datos":{"id_contrato":getD("id_contrato")}
      })},
       type: "GET",
       dataType: "json",
       url: "controlador_informacion.php",
    })
     .done(function( respuesta, textStatus, jqXHR ) {
      var c=respuesta.campo;
        if(respuesta.success ){
          alerta("Comandos Enviados a la interfaz");
        }else{
           log( "Error: " + respuesta.error);
        }
     });
  }
}
function refrescar_terminal(id_es){
  if(getD('id_contrato')==''){
      alerta("Error, Debe Cargar un contrato");
  }
  else{
    $.ajax({data:{
        "parametros":JSON.stringify({
        "clase":"refrescar_terminal",
        "datos":{"id_es":id_es}
      })},
       type: "GET",
       dataType: "json",
       url: "controlador_informacion.php",
    })
     .done(function( respuesta, textStatus, jqXHR ) {
      var c=respuesta.campo;
        if(respuesta.success ){
          alerta("Comando Enviado a la interfaz");
        }else{
           log( "Error: " + respuesta.error);
        }
     });
  }
}
function cargar_form_edit_terminal(id_es){
     $.ajax({
      data:{"id_es":id_es,"id_contrato":getD("id_contrato")},
      type: "GET",
      url: "Formulario/edit_equipo_sistema.php",
     })
     .done(function( contenido, textStatus, jqXHR ){
        
      ventanaModal = BootstrapDialog.show({
          title    : "Editar datos del Terminal",
          message  : $(contenido),
          closable : true,
          type     : BootstrapDialog.TYPE_INFO,
          cssClass: 'ventana-formulario',
          buttons  : [{}]
        });
     })
     .fail(function( jqXHR, textStatus, errorThrown ) {
        alerta("Error al cargar formulario:\n "+textStatus);
     });
}


function calcular_total_susc(){
      setD("total_s",parseFloat(getD("costo_cobro"))*parseInt(getD("cant_serv")));
}