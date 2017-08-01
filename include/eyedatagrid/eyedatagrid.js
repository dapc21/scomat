//DataGrid

var archivoDataGrid="";
var claseDataGrid="DataGrid";
var divDataGrid="datagrid";
var params = ''; 
var tblpage = ''; 
var tblorder = ''; 
var tblfilter = ''; 
var tblresul = '';

function tblSetResulTodo(archivoDataGrid,divDataGrid,metodo,tblpage,tblorder,tblfilter,tblresul) { 
	document.getElementById('tblresul_'+divDataGrid).value = document.getElementById('tblresulTodo_'+divDataGrid).value; 
	tblSetResul(archivoDataGrid,divDataGrid,metodo,tblpage,tblorder,tblfilter,tblresul)}
function tblSetResul(archivoDataGrid,divDataGrid,metodo,tblpage,tblorder,tblfilter,tblresul) {
 
	var tblresul = document.getElementById('tblresul_'+divDataGrid).value; 
	var params = 'useajax=true&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter + '&tblresul=' + tblresul+ "&divDataGrid=" + divDataGrid;
	eval(metodo+"('"+archivoDataGrid+"','"+divDataGrid+"','"+params+"')");
}

function tblSetPage(page,archivoDataGrid,divDataGrid,metodo,tblpage,tblorder,tblfilter,tblresul) { 
	var tblpage = page; 
	var params = 'useajax=true&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter + '&tblresul=' + tblresul+ "&divDataGrid=" + divDataGrid;
	eval(metodo+"('"+archivoDataGrid+"','"+divDataGrid+"','"+params+"')"); 
}

function tblSetOrder(column, order,archivoDataGrid,divDataGrid,metodo,tblpage,tblorder,tblfilter,tblresul) { 
	var tblorder = column + ':' + order; 
	var params = 'useajax=true&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter + '&tblresul=' + tblresul+ "&divDataGrid=" + divDataGrid;
	eval(metodo+"('"+archivoDataGrid+"','"+divDataGrid+"','"+params+"')"); 
}


function tblSetFilter(column,archivoDataGrid,divDataGrid,metodo,tblpage,tblorder,tblfilter,tblresul) { 
	val = document.getElementById('filter-value-'+divDataGrid + column).value; 
	var tblfilter = column + ':' + val; 
	var params = 'useajax=true&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter + '&tblresul=' + tblresul+ "&divDataGrid=" + divDataGrid;
	eval(metodo+"('"+archivoDataGrid+"','"+divDataGrid+"','"+params+"')"); 

}
function tblClearFilter() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter=' + '&tblresul=' + tblresul; updateTable(); }
function tblToggleCheckAll() { 
	for (i = 1; i < document.f1.checkbox.length; i++) {
		document.f1.checkbox[i].checked = document.f1.checkbox[0].checked; 
		
	} 
}
function tblToggleCheckAll_gu() { for (i = 1; i < document.f1.checkbox_gu.length; i++) { document.f1.checkbox_gu[i].checked = !document.f1.checkbox_gu[i].checked; } }

function tblShowHideFilter(column,archivoDataGrid,divDataGrid) {
	var o = document.getElementById('filter-'+divDataGrid+ column);
	if (o.style.display == 'block'){
		tblClearFilter(); 
	} else {
		o.style.display = 'block'; 
	}
}
function tblReset() { params = '&page=1'; updateTable(); }
//function updateTable1(archivoDataGrid,params) { conexionPHP(archivoDataGrid+'?useajax=true'+ params,claseDataGrid,divDataGrid);
function updateTable(){
	//if (!isset(archivoDataGrid1)) {archivoDataGrid=archivoDataGrid1;}
	//if (!isset(divDataGrid1)) {divDataGrid=divDataGrid1;}

	listar_datos(archivoDataGrid,divDataGrid)
 //conexionPHP(archivoDataGrid+'?useajax=true'+ params+ "&divDataGrid=" + divDataGrid,claseDataGrid,divDataGrid);
//alert(divDataGrid);
//document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function updateTableExcel(archivoDataGrid,divDataGrid,metodo,tblpage,tblorder,tblfilter,tblresul){
	var params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter + '&tblresul=' + tblresul+ "&divDataGrid=" + divDataGrid;
	location.href=archivoDataGrid+'?useajax=true'+ params+'&modo=EXCEL&';
}
//fin DataGrid

/*archivoDataGrid: ruta del archivo donde va a buscar el listado*/
/*divDataGrid: div donde va a colocar el resultado*/
/*params: lista de parametros adicionales*/
/*llamafuncion: funcion a ejecutar una vez cargado el datagrid*/
function listar_datos(archivoDataGrid,divDataGrid,params,llamafuncion){
	var arg=listar_datos.arguments.length;
	
	log("cant:"+arg);
   if (!isset(params)) {var params="useajax=true&divDataGrid="+divDataGrid;}
   if(params==''){var params="useajax=true&divDataGrid="+divDataGrid;}
      log("div:"+divDataGrid);
      params=params+"&metodo=listar_datos";
      document.getElementById(divDataGrid).innerHTML='<div style="text-align: center;color:#058CB6;"><br><i class="fa fa-spinner fa-spin fa-2x"></i></div><br><br><br>';
   $.ajax({
      data: params,
      type: "GET",
      url: archivoDataGrid,
   })
   .done(function( respuesta, textStatus, jqXHR ) {
      document.getElementById(divDataGrid).innerHTML=respuesta;
      
      if(arg==4){
      	eval(llamafuncion);
      }
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}