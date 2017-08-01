// BootstrapDialog.confirm('Seguro que desea enviar este formulario?', function(r){if(r) {
function  cargar_form_sector(){
   $.ajax({
    type: "GET",
    url: "Formulario/sector.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_sector.php","datagrid_sector");
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  agregar_sector_ext(accion,clase){
         validardatos_f3("agrega_sector",accion,clase)
}

function  agrega_sector(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_sector":getD("id_sector_add"),
                  "nro_sector":"0",
                  "id_zona":getD("id_zona"),
                  "id_franq":getD("id_franq"),
                  "nombre_sector":getD("nombre_sector") 
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
              $('#id_sector').append(new Option(getD("nombre_sector"),getD("id_sector_add"), true, true));
              setD("id_sector",getD("id_sector_add"));
              cerrar_ventana_externa();
            }else {
               alerta("ERROR DURANTE TRANSACCION\n"+respuesta.error);
            }
         })
         .fail(function( jqXHR, textStatus, errorThrown ) {
            ventaG.close();
               alerta("ERROR DURANTE TRANSACCION\nError: "+textStatus);
         });
}
function  gestionar_sector(accion,clase){
         validardatos("gestion_sector",accion,clase)
}
function  gestion_sector(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_sector":getD("id_sector"),
                  "nro_sector":getD("nro_sector"),
                  "id_zona":getD("id_zona"),
                  "id_franq":getD("id_franq"),
				          "nombre_sector":getD("nombre_sector")                                
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
               cargar_form_sector();
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
function  buscar_id_sector(id_sector){
   var parametros=[{
            "clase":"sector",
            "consulta":"select * from vista_sector1 where id_sector='"+id_sector+"'"
         }]
   buscar_sector(parametros);
}
function  buscar_nombre_sector(){
   var parametros=[{
            "clase":"sector",
            "consulta":"select * from vista_sector1 where nombre_sector='"+getD("nombre_sector")+"'"
         }]
   buscar_sector(parametros);
}
function  buscar_sector(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_sector(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_sector(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "sector":
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
            case "sector":
               setD("id_sector",campo.id_sector);
               setD("nro_sector",campo.nro_sector);
               setD("id_zona",campo.id_zona);        
               setD("nombre_sector",campo.nombre_sector);  
			         setD("id_franq",campo.id_franq);
			         setD("id_esta",campo.id_esta);
               setD("id_mun",campo.id_mun);              
               setD("id_ciudad",campo.id_ciudad);			   
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