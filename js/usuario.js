function  cargar_form_usuario(){
  $.ajax({
  type: "GET",
  url: "Formulario/Usuario.php",
  })
  .done(function( respuesta, textStatus, jqXHR ){
   $("#principal").html(respuesta);
   activar_validar_datos();
   listar_datos("procesos/datagrid_usuario.php","datagrid");  
  })
  .fail(function( jqXHR, textStatus, errorThrown ) {
    alerta("Error al cargar formulario:\n "+textStatus);
  });
}
function  gestionar_usuario(accion,clase){
  if(document.f1.password.value!=document.f1.otropassword.value){
    alerta("Las Contrasenas no coinciden!");
        foco("password");
    }
    else{
      validardatos("gestion_usuario",accion,clase)
    }
}
function  gestion_usuario(accion,clase){
         var parametros=[{
               "clase":clase,
               "accion":accion,
               "datos":{
                  "login":getD("login_usuario"),
                  "id_persona":getD("id_persona"),
                  "status":getOption("status"),
                  "cedula":getD("cedula"),
                  "nombre":getD("nombre"),
                  "apellido":getD("apellido"),
                  "telefono":getD("telefono"),
                  "password":document.f1.password.value,
                  "id_franq":getD("id_franq"),
                  "codigoperfil":getD("codigoperfil"),
                  "id_servidor":getD("id_servidor")
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
               cargar_form_usuario();
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
function  buscar_id_usuario(id_usuario){
   var parametros=[{
            "clase":"usuario",
            "consulta":"select * from personausuario where id_usuario='"+id_usuario+"'"
         }]
   buscar_usuario(parametros);
}
function  buscar_login(){
   var parametros=[{
            "clase":"usuario",
            "consulta":"select * from personausuario where login='"+getD("login_usuario")+"'"
         }]
   buscar_usuario(parametros);
}
function  buscar_usuario(parametros){
   $.ajax({
     data:{"parametros":JSON.stringify(parametros)},
     type: "GET",
     dataType: "json",
     url: "controlador_buscar.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
         asignar_usuario(respuesta);
      }else {
         log( "Error: " + respuesta.error);
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function  asignar_usuario(respuesta){
   var objetos=respuesta.objetos;
   for (var objeto in objetos){
      var clase=objetos[objeto].clase;
      var cantidad=objetos[objeto].cantidad;
      if(cantidad==0){
         switch(clase){
            case "usuario":
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
            case "usuario":
            log("login:"+campo.login);  
               setD("login_usuario",campo.login);
               setD("id_persona",campo.id_persona);
               setD("cedula",campo.cedula);
               setD("nombre",campo.nombre);
               setD("apellido",campo.apellido);
               setD("telefono",campo.telefono);

               setOption("statususuario",campo.statususuario);
               setD("otropassword","");
               setD("password","");
               setD("codigoperfil",campo.codigoperfil);
               setD("id_franq",campo.id_franq);
               setD("id_servidor",campo.id_servidor);
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