function  cargar_form_empresa(){
   $.ajax({
    type: "GET",
    url: "Formulario/empresa.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_empresa.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_empresa(accion,clase){
         validardatos("gestion_empresa",accion,clase)
}
function  gestion_empresa(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_emp":getD("id_emp"),
                  "rif_emp":getD("rif_emp"),
                  "razon_social_emp":getD("razon_social_emp"),
                  "nombre_comercial_emp":getD("nombre_comercial_emp"),
                  "telefono_emp":getD("telefono_emp"),
                  "correo_emp":getD("correo_emp"),
                  "logo_emp":getD("logo_emp"),
                  "infor_adic_emp":getD("infor_adic_emp"),
                  "direccion_emp":getD("direccion_emp"),
                  "obsrv_emp":getD("obsrv_emp"),
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
               cargar_form_empresa();
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
function  buscar_id_emp(id_emp){
   var parametros=[{
            "clase":"empresa",
            "consulta":"select * from empresa where id_emp='"+id_emp+"'"
         }]
   buscar_empresa(parametros);
}
function  buscar_empresa(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_empresa(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_empresa(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "empresa":
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
            case "empresa":
               setD("id_emp",campo.id_emp);
               setD("rif_emp",campo.rif_emp);
               setD("razon_social_emp",campo.razon_social_emp);
               setD("nombre_comercial_emp",campo.nombre_comercial_emp);
               setD("telefono_emp",campo.telefono_emp);
               setD("correo_emp",campo.correo_emp);
               setD("logo_emp",campo.logo_emp);
               setD("infor_adic_emp",campo.infor_adic_emp);
               setD("direccion_emp",campo.direccion_emp);
               setD("obsrv_emp",campo.obsrv_emp);
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