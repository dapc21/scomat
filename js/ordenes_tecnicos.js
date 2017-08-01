//LLAMADO AL FORMULARIO FINALIZAR ORDENES
function  cargar_form_final_ordenes_tecnicos(){
  $.ajax({
  type: "GET",
  url: "Formulario/final_ordenes_tecnicos.php",
  })
  .done(function( respuesta, textStatus, jqXHR ){
  claseGlobal="final_ordenes_tecnicos";
   $("#principal").html(respuesta);
   activar_validar_datos();
   listar_datos("procesos/datagrid_final_ordenes_tecnicos.php","datagrid");
  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
    alerta("Error al cargar formulario:\n "+textStatus);
  });
}
//LLAMADO AL FORMULARIO ASIGNAR/IMPRIMIR ORDENES
function  cargar_form_imprimir_ordenes_tecnicos(){
  $.ajax({
  type: "GET",
  url: "Formulario/imprimir_ordenes_tecnicos.php",
  })
  .done(function( respuesta, textStatus, jqXHR ){
    claseGlobal="imprimir_ordenes_tecnicos";
   $("#principal").html(respuesta);
   activar_validar_datos();
   listar_datos("procesos/datagrid_imprimir_ordenes_tecnicos.php","datagrid");
  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
    alerta("Error al cargar formulario:\n "+textStatus);
  });
}
function  cargar_form_ordenes_tecnicos(){
  $.ajax({
  type: "GET",
  url: "Formulario/ordenes_tecnicos.php",
  })
  .done(function( respuesta, textStatus, jqXHR ){
  claseGlobal="ordenes_tecnicos";
   $("#principal").html(respuesta);
   activar_validar_datos();
  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
    alerta("Error al cargar formulario:\n "+textStatus);
  });
}
function filtrar_imprimir_orden(){
  archivoDataGrid="procesos/datagrid_imprimir_ordenes_tecnicos.php?desde="+getD("desde")+"&hasta="+getD("hasta")+"&id_gt="+getD("id_gt1")+"&id_tipo_orden="+getD("id_tipo_orden")+"&id_det_orden="+getD("id_det_orden")+"&prioridad="+getD("prioridad")+"&id_franq="+getD("id_franq")+"&";
   divDataGrid='datagrid';
   listar_datos(archivoDataGrid,"datagrid");
}
function imprimirOrdenTec(id_orden){
    setD("id_orden",id_orden);
    gestionar_ordenes_tecnicos('imprimir','ordenes_tecnicos')
}
function filtrar_final_orden(){
  archivoDataGrid="procesos/datagrid_final_ordenes_tecnicos.php?desde="+getD("desde")+"&hasta="+getD("hasta")+"&id_gt="+getD("id_gt1")+"&id_tipo_orden="+getD("id_tipo_orden1")+"&id_det_orden="+getD("id_det_orden1")+"&prioridad="+getD("prioridad")+"&id_franq="+getD("id_franq")+"&";
  
  listar_datos(archivoDataGrid,"datagrid");

  mostrar("mostrar_busqueda");
}
function  gestionar_ordenes_tecnicos(accion,clase){
         validardatos("gestion_ordenes_tecnicos",accion,clase)
}
function  gestion_ordenes_tecnicos(accion,clase){
  if(claseGlobal=="ordenes_tecnicos"){
    var parametros=[{
       "clase":clase,
       "accion":accion,
       "datos":{
          "id_orden":getD("id_orden"),                                   
          "id_det_orden":getD("id_det_orden"),
          "fecha_orden":getD("fecha_orden"),                 
          "detalle_orden":getD("detalle_orden"),
          "comentario_orden":getD("comentario_orden"),
          "id_contrato":getD("id_contrato"),
          "status_orden":getD("status_orden"),
          "prioridad":getD("prioridad")                    
       }
    }];
  }
  else if(claseGlobal=="imprimir_ordenes_tecnicos"){
    var parametros=[{
       "clase":clase,
       "accion":accion,
       "datos":{
          "id_orden":getD("id_orden"),                                   
          "id_gt":getD("id_gt")                      
       }
    }];
  }
  else if(claseGlobal=="final_ordenes_tecnicos"){
        //conexionPHP('informacion.php',"modificar_poste_cont",id_contrato()+"=@"+postel()+"=@"+pto());
        //conexionPHP("administrar.php","ordenes_tecnicos",id_orden()+"=@"+id_gt()+"=@"+document.f1.nombre_det_orden.value+"=@=@"+formatdate(fecha_final())+"=@=@"+comentario_orden()+"=@"+etiqueta()+"=@=@","finalizar");

    var parametros=[{
       "clase":clase,
       "accion":accion,
       "datos":{
          "id_orden":getD("id_orden"),
          "id_det_orden":getD("id_det_orden"),
          "comentario_orden":getD("comentario_orden"),
          "etiqueta":getD("etiqueta"),                                   
          "fecha_final":getD("fecha_final"),                                   
          "id_gt":getD("id_gt")                      
       }
    }];
  }
  controlador_ordenes_tecnicos(accion,clase,parametros);       
}
function  controlador_ordenes_tecnicos(accion,clase,parametros){
         $.ajax({
           data:{"parametros":JSON.stringify(parametros)},
           type: "POST",
           dataType: "json",
           url: "controlador.php",
         })
         .done(function( respuesta, textStatus, jqXHR ){
            ventaG.close();
            if( respuesta.success ) {
              if(claseGlobal=="ordenes_tecnicos"){
                cargar_form_ordenes_tecnicos();
              }else if(claseGlobal=="imprimir_ordenes_tecnicos"){

                if(planilla_orden_G==""){
                  location.href="reportepdf/imp_orden_serv.php?&id_orden="+id_orden()+"&";
                }else{
                  location.href="reportepdf/imp_orden_serv"+planilla_orden_G+".php?&id_orden="+id_orden()+"&";
                }
                listar_datos("procesos/datagrid_imprimir_ordenes_tecnicos.php","datagrid");
              }else if(claseGlobal=="final_ordenes_tecnicos"){
                cargar_form_final_ordenes_tecnicos();
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

function  buscar_id_ordenes_tecnicos(id_orden){
   var parametros=[{
            "clase":"ordenes_tecnicos",
            "consulta":"select * from vista_orden where id_orden='"+id_orden+"'"
         }]
   buscar_ordenes_tecnicos(parametros);
}

function  buscar_id_orden_final(id_orden){
   var parametros=[{
            "clase":"vista_orden_final",
            "consulta":"select * from vista_orden where id_orden='"+id_orden+"'"
         }]
   buscar_ordenes_tecnicos(parametros);
}
function  buscar_id_orden_final_cont(){
   var parametros=[{
            "clase":"vista_orden_final",
            "consulta":"select * from vista_orden where status_orden='IMPRESO' AND nro_contrato='"+getD("nro_contrato")+"'"
         }]
   buscar_ordenes_tecnicos(parametros);
}
function  buscar_orden_final_id_orden(){
   var parametros=[{
            "clase":"vista_orden_final",
            "consulta":"select * from vista_orden where status_orden='IMPRESO' AND id_orden='"+getD("id_orden")+"'"
         }]
   buscar_ordenes_tecnicos(parametros);
}

function  buscar_ordenes_tecnicos(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_ordenes_tecnicos(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_ordenes_tecnicos(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "ordenes_tecnicos":
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
            case "ordenes_tecnicos":
               setD("id_orden",campo.id_orden);
               setD("id_det_orden",campo.id_det_orden);
               setD("fecha_orden",campo.fecha_orden);        
               setD("comentario_orden",campo.comentario_orden);  
               setD("status_orden",campo.status_orden);
               setD("id_contrato",campo.id_contrato);
               setD("prioridad",campo.prioridad);
               setD("nombrecli",campo.nombrecli);
               setD("apellidocli",campo.apellidocli);
               setD("status_contrato",campo.status_contrato);
               setD("id_zona",campo.id_zona);
               setD("nombre_sector",campo.nombre_sector);
               setD("nombre_calle",campo.nombre_calle);
               setD("contrato_fisico",campo.contrato_fisico);        
               disabled("registrar");
               enabled("modificar");
               enabled("eliminar");
               break;		
            case "vista_orden_final":
               setD("id_contrato",campo.id_contrato);
               setD("nro_contrato",campo.nro_contrato);
               setD("nombre",campo.nombrecli+" "+campo.nombrecli);
               setD("status_contrato",campo.status_contrato);
               setD("saldo",campo.saldo);
               setD("contrato_fisico",campo.contrato_fisico);
               setD("etiqueta",campo.etiqueta);
               setD("postel",campo.postel);
               setD("pto",campo.pto);
               
                document.getElementById("status_contrato").style='color:'+campo.color+';font-weight:blod; font-size:14;';
                document.f1.saldo.value=campo.saldo;
                if(parseFloat(getD("saldo"))>0){
                  document.getElementById("saldo").style='color:#FF0000;font-weight:blod; font-size:16;';
                }else{
                  document.getElementById("saldo").style='color:#00BB00;font-weight:blod; font-size:16;';
                }


               setD("id_orden",campo.id_orden);
               setD("id_tipo_orden",campo.id_tipo_orden);
               setD("id_det_orden",campo.id_det_orden);
               setD("detalle_orden",campo.detalle_orden);
               setD("comentario_orden",campo.comentario_orden);
               setD("comentario_cliente",campo.comentario_cliente);

               enabled("registrar_ord");
               enabled("cancelar_ord");
               enabled("devolver_ord");
               enabled("btnvisita_ord");
               enabled("salcvir_ord");
               enabled("reasignar_grupo");
               enabled("agregar_deco");
               enabled("agregar_material");

               listar_datos("procesos/datagrid_equipo_sistema_add_orden.php?id_contrato="+getD("id_contrato"),"terminales_orden"); 
/*
  document.f1.registrar_ord.disabled=false; 
  document.f1.cancelar_ord.disabled=false;
  document.f1.devolver_ord.disabled=false;
  document.f1.btnvisita_ord.disabled=false;


               document.f1.nombre_det_orden.disabled=false;
  document.f1.etiqueta.value=trim(etiqueta);
  document.f1.tipo_detalle.value=trim(tipo_detalle);
  document.f1.id_orden.value=trim(id_orden);
  document.f1.id_contrato.value=trim(id_contrato);
  document.f1.nro_contrato.value=trim(nro_contrato);
  document.f1.nombre.value=trim(nombre);
  document.f1.nombre_tipo_orden.value=trim(id_tipo_orden);
  document.f1.nombre_det_orden.value=trim(nombre_det_orden);
  document.f1.comentario_orden.value=trim(comentario_orden);
  document.f1.contrato_fisico.value=trim(contrato_fisico);
  
  document.f1.etiqueta.disabled=false;
  document.f1.comentario_orden.disabled=false;
  document.f1.costo_dif_men.disabled=true;
  
  conexionPHP("informacion.php","trae_info_grupo",id_orden);
  id_det_orderG=trim(id_det_orden);
  conexionPHP('informacion.php',"cargarDOF",id_tipo_orden);
  conexionPHP('informacion.php',"traer_infor_orden",id_contrato);
*/

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

function guardarOrdenTec(id_orden){
  if(planilla_orden_G==""){
    location.href="reportepdf/imp_orden_serv.php?&id_orden="+id_orden+"&";
  }else{
    location.href="reportepdf/imp_orden_serv"+planilla_orden_G+".php?&id_orden="+id_orden+"&";
  }
}


function guardar_orden_sel(){
  var cont=0;
  cade='';
  for (i = 1; i < document.f1.checkbox.length; i++) {
    if(document.f1.checkbox[i].checked == true){
        cade=cade+trim(document.f1.checkbox[i].value)+"=@";
        cont++;
    }
  }
  if(cade!='')
  {
    if(valida_sel_automatica()){
          if(planilla_orden_G==""){
            location.href="reportepdf/imp_orden_serv_varias.php?&id_orden="+cade+"&id_gt="+id_gt()+"&";
          }else{
            location.href="reportepdf/imp_orden_serv_varias"+planilla_orden_G+".php?&id_orden="+cade+"&id_gt="+id_gt()+"&";
          }
    conexionPHP('formulario.php','imprimir_ordenes_tecnicos');
    }
  }
  else{
    alerta("Error, debe seleccionar al menos un Item de la lista.");
  }
}
function guardar_orden_sel_corte(){
  var cont=0;
  cade='';
  for (i = 1; i < document.f1.checkbox.length; i++) {
    if(document.f1.checkbox[i].checked == true){
        cade=cade+trim(document.f1.checkbox[i].value)+"=@";
        cont++;
    }
  }
  if(cade!='')
  {
    if(valida_sel_automatica()){  
      if(id_franq()!='0'){
        if (confirm("Confirma que desea Imprimir este listado para corte?")){
          location.href="reportepdf/imp_orden_serv_corte.php?&id_franq="+id_franq()+"&id_gt="+id_gt()+"&id_orden="+cade+"&";
         cargar_form_imprimir_ordenes_tecnicos();
        }
      }
      else{
        alerta("Debe Seleccionar una Franquicia.");
      }
    }
  }
  else{
    alerta("Error, debe seleccionar al menos un Item de la lista.");
  }
}

function valida_sel_automatica(){
  
    if(getD("id_gt")!='0' && getD("id_gt")!=''){
      return true;
    }
    else{
      alerta("Error debe seleccionar un Grupo de Trabajo.");
      return false;
    }
  
}


function cargar_form_add_terminal(){
     $.ajax({
      data:{"id_contrato":getD("id_contrato")},
      type: "GET",
      url: "Formulario/add_equipo_sistema.php",
     })
     .done(function( contenido, textStatus, jqXHR ){
        
      ventanaModal = BootstrapDialog.show({
          title    : "Agregar Equipos ",
          message  : $(contenido),
          closable : true,
          type     : BootstrapDialog.TYPE_INFO,
          cssClass: 'ventana-formulario',
          buttons  : [{}]
        });
      setTimeout('cargar_datagrid_equipo_sistema_add();', 1000);
     })
     .fail(function( jqXHR, textStatus, errorThrown ) {
        alerta("Error al cargar formulario:\n "+textStatus);
     });
}
function cargar_datagrid_equipo_sistema_add(){
  listar_datos("procesos/datagrid_equipo_sistema_add.php?id_contrato="+getD("id_contrato"),"terminales");
}
function cargar_form_add_material(){
     $.ajax({
      data:{"id_contrato":getD("id_contrato")},
      type: "GET",
      url: "Formulario/add_material.php",
     })
     .done(function( contenido, textStatus, jqXHR ){
        
      ventanaModal = BootstrapDialog.show({
          title    : "Agregar Materiales Utilizados ",
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
