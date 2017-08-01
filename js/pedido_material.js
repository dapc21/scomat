function  cargar_form_pedido_material(){
   $.ajax({
    type: "GET",
    url: "Formulario/pedido_material.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);
     activar_validar_datos();
     listar_datos("procesos/datagrid_pedido_material.php","datagrid");  
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function  gestionar_pedido_material(accion,clase){
         validardatos("gestion_pedido_material",accion,clase)
}
function  gestion_pedido_material(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "id_ped_mat":getD("id_ped_mat"),
                  "id_stock":getD("id_stock"),
                  "id_ped":getD("id_ped"),
                  "cant_ped_mat":getD("cant_ped_mat"),
					"stock_material":stock_material()
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
               cargar_form_pedido_material();
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
function  buscar_id_ped_mat(id_ped_mat){
   var parametros=[{
            "clase":"pedido_material",
            "consulta":"select * from vista_pedido_material where id_ped_mat='"+id_ped_mat+"'"
         }]
   buscar_pedido_material(parametros);
}
function  buscar_pedido_material(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_pedido_material(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_pedido_material(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
	  $("#cant_reg").val(cantidad);
      if(cantidad==0){
         switch(clase){
            case "pedido_material":
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
            case "pedido_material":
               setD("id_ped_mat",campo.id_ped_mat);
               setD("id_stock",campo.id_stock);
               setD("id_ped",campo.id_ped);
               setD("cant_ped_mat",campo.cant_ped_mat);
               disabled("registrar");
               enabled("modificar");
               enabled("eliminar");
			   
				idStockPed[0] = campo.id_stock;
				idAlmPed[0] = campo.id_alm;
				idMatPed[0] = campo.id_mat;
				stockPed[0] = campo.stock;
				stockMinPed[0] = campo.stock_min;
				
               break;
            default:
            log( "no existe la clase: "+clase+" para asignar parametros");
         }
      }
      else{

		switch(clase){
			case "pedido_material":
			
			for (var datos in objetos[objeto].data){
				var campo = objetos[objeto].data[datos];
				idStockPed[datos] = campo.id_stock;
				idAlmPed[datos] = campo.id_alm;
				idMatPed[datos] = campo.id_mat;
				stockPed[datos] = campo.stock;
				stockMinPed[datos] = campo.stock_min;
				
			}
				break;
				default:
					log( "no existe la clase: "+clase+" para asignar parametros");
		}
		
      }
   }
}

		
/**********************************************
	FUNCIÓN OBJETO PARA STOCK_MATERIAL
**********************************************/
var idStockPed = new Array(),idAlmPed = new Array(),idMatPed = new Array(), stockPed = new Array(), stockMinPed = new Array();
function stock_material(){
	var stPed = new Array();
	var cantidad = $("#cant_reg").val();
    for (i = 0; i < cantidad; i++) {
		
		var obj = new Object();
		obj.id_stock  = idStockPed[i];
		obj.id_alm  = idAlmPed[i];
		obj.id_mat  = idMatPed[i];
		obj.stock = stockPed[i];
		obj.stock_min =  stockMinPed[i];
		stPed[i] = obj;
    }
	return stPed;
}