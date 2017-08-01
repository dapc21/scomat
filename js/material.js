function  cargar_form_material(){
   $.ajax({
    type: "GET",
    url: "Formulario/material.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_material.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_material(accion,clase){
         validardatos("gestion_material",accion,clase)
}
function  gestion_material(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_mat":getD("id_mat"),
                  "id_fam":getD("id_fam"),
                  "codigo_mat":getD("codigo_mat"),
                  "nombre_mat":getD("nombre_mat"),
                  "cant_uni_ent":getD("cant_uni_ent"),
                  "id_uni":getD("id_uni"),
                  "cant_uni_sal":getD("cant_uni_sal"),
                  "uni_id_uni":getD("uni_id_uni"),
                  "impreso":getD("impreso")
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
               cargar_form_material();
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
function  buscar_id_mat(id_mat){
   var parametros=[{
            "clase":"material",
            "consulta":"select * from vista_material where id_mat='"+id_mat+"' and id_estatus_reg = 1"
         }]
   buscar_material(parametros);
}
function  buscar_material(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_material(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_material(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "material":
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
            case "material":
               setD("id_mat",campo.id_mat);
               setD("id_fam",campo.id_fam);
               setD("codigo_mat",campo.codigo_mat);
               setD("nombre_mat",campo.nombre_mat);
               setD("cant_uni_ent",campo.cant_uni_ent);
               setD("id_uni",campo.id_uni);
               setD("cant_uni_sal",campo.cant_uni_sal);
               setD("uni_id_uni",campo.uni_id_uni);
               setD("impreso",campo.impreso);
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