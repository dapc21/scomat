function  cargar_form_movimiento_material(){
   $.ajax({
    type: "GET",
    url: "Formulario/movimiento_material.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_movimiento_material.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_movimiento_material(accion,clase){
         validardatos("gestion_movimiento_material",accion,clase)
}
function  gestion_movimiento_material(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_mov_mat":getD("id_mov_mat"),
                  "id_stock":getD("id_stock"),
                  "id_mov":getD("id_mov"),
                  "cant_mov_mat":getD("stock"),
				  "stock_material":stockM(),
				  "stock_material_destino":stockMdestino()
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
               cargar_form_movimiento_material();
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
function  buscar_id_mov_mat(id_mov_mat){
   var parametros=[{
            "clase":"movimiento_material",
            "consulta":"select * from vista_movimiento_material where id_mov_mat='"+id_mov_mat+"'"
         }]
   buscar_movimiento_material(parametros);
}
function  buscar_movimiento_material(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_movimiento_material(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_movimiento_material(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "movimiento_material":
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
            case "movimiento_material":
				setD("id_mov_mat",campo.id_mov_mat);
				setD("id_stock",campo.id_stock);
				setD("id_mov",campo.id_mov);
				setD("stock",campo.cant_mov_mat);
				disabled("registrar");
				enabled("modificar");
				enabled("eliminar");
								
               break;
            default:
            log( "no existe la clase: "+clase+" para asignar parametros");
         }
      }
      else{
			switch(clase){
				case "movimiento_material":
				
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
			}
      }
   }
}

