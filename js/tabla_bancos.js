function  cargar_form_tabla_bancos(){
  log("entro a cargar tabla_bancos.")
   $.ajax({
    type: "GET",
    url: "Formulario/tabla_bancos.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
     $("#principal").html(respuesta);     
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function buscar_registro_banco(){
	log("entro aqui");
	divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
	archivoDataGrid="procesos/datagrid_tabla_bancos.php?id_cuba="+getD("id_cuba")+"&fecha_desde_ctb="+getD("fecha_desde_ctb")+"&fecha_hasta_ctb="+getD("fecha_hasta_ctb")+"&referencia_tb="+getD("referencia_tb")+"&monto_tb="+getD("monto_tb")+"&descrip_tb="+getD("descrip_tb")+"&status_tb="+getD("status_tb")+"&";
	updateTable();
}