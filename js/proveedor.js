function  cargar_form_proveedor(){
  log("entro a cargar proveedor.")
   $.ajax({
    type: "GET",
    url: "Formulario/proveedor.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_proveedor.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_proveedor(accion,clase){
         validardatos("gestion_proveedor",accion,clase)
}
function  gestion_proveedor(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_prov":getD("id_prov"),
                  "rif_prov":getD("rif_prov"),
                  "nombre_prov":getD("nombre_prov"),
                  "direccion_prov":getD("direccion_prov"),
                  "telefonos_prov":getD("telefonos_prov"),
                  "fax_prov":getD("fax_prov"),
                  "web_prov":getD("web_prov"),
                  "email_prov":getD("email_prov"),
                  "obser_prov":getD("obser_prov"),
                  "forma_pago":getD("forma_pago"),
                  "banco":getD("banco"),
                  "cuenta":getD("cuenta"),
                  "status_prov":getOption("status_prov"),
        				  "contacto":getD("contacto"),
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
               cargar_form_proveedor();
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
function  buscar_id_prov(id_prov){
   var parametros=[{
            "clase":"proveedor",
            "consulta":"select * from proveedor where id_prov='"+id_prov+"'"
         }]
   buscar_proveedor(parametros);
}
function  buscar_proveedor(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_proveedor(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_proveedor(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "proveedor":
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
            case "proveedor":
               setD("id_prov",campo.id_prov);
               setD("rif_prov",campo.rif_prov);
               setD("nombre_prov",campo.nombre_prov);
               setD("direccion_prov",campo.direccion_prov);
               setD("telefonos_prov",campo.telefonos_prov);
               setD("fax_prov",campo.fax_prov);
               setD("web_prov",campo.web_prov);
               setD("email_prov",campo.email_prov);
               setD("obser_prov",campo.obser_prov);
               setD("forma_pago",campo.forma_pago);
               setD("banco",campo.banco);
               setD("cuenta",campo.cuenta);
               setOption("status_prov",campo.status_prov);
			   setD("contacto",campo.contacto);
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
