//DataGrid
var archivoDataGrid="";
var claseDataGrid="DataGrid";
var divDataGrid="datagrid";
var params = ''; var tblpage = ''; var tblorder = ''; var tblfilter = ''; var tblresul = '';
function tblSetResulTodo_cas(archivoDataGrid1,divDataGrid1) { divDataGrid=divDataGrid1; document.getElementById('tblresul_'+divDataGrid).value = document.getElementById('tblresulTodo_'+divDataGrid).value; tblSetResul_cas(archivoDataGrid1,divDataGrid1)}
function tblSetResul_cas(archivoDataGrid1,divDataGrid1) { archivoDataGrid=archivoDataGrid1; divDataGrid=divDataGrid1; tblresul = document.getElementById('tblresul_'+divDataGrid).value; tblpage = 1; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter + '&tblresul=' + tblresul; updateTable_cas(); }
function tblSetPage_cas(page,archivoDataGrid1,divDataGrid1) { archivoDataGrid=archivoDataGrid1; divDataGrid=divDataGrid1;  tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter + '&tblresul=' + tblresul; updateTable_cas(); }
function tblSetOrder_cas(column, order,archivoDataGrid1,divDataGrid1) { archivoDataGrid=archivoDataGrid1; divDataGrid=divDataGrid1; tblorder = column + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter + '&tblresul=' + tblresul; updateTable_cas(); }
function tblSetFilter_cas(column,archivoDataGrid1,divDataGrid1) { archivoDataGrid=archivoDataGrid1; divDataGrid=divDataGrid1;  val = document.getElementById('filter-value-'+divDataGrid + column).value; tblfilter = column + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter + '&tblresul=' + tblresul; updateTable_cas(); }
function tblClearFilter_cas() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter=' + '&tblresul=' + tblresul; updateTable_cas(); }
function tblToggleCheckAll_cas() { for (i = 1; i < document.f1.checkbox.length; i++) { document.f1.checkbox[i].checked = !document.f1.checkbox[i].checked; } }
function tblShowHideFilter_cas(column,archivoDataGrid1,divDataGrid1) { archivoDataGrid=archivoDataGrid1; divDataGrid=divDataGrid1; var o = document.getElementById('filter-'+divDataGrid+ column); if (o.style.display == 'block') { tblClearFilter_cas(); } else { o.style.display = 'block'; } }
function tblReset_cas() { params = '&page=1'; updateTable_cas(); }
function updateTable_cas() { conexionPHP_cas(archivoDataGrid+'?useajax=true'+ params+ "&divDataGrid=" + divDataGrid,claseDataGrid,divDataGrid);}
function updateTable_cas1() { conexionPHP_cas1(archivoDataGrid+'?useajax=true'+ params+ "&divDataGrid=" + divDataGrid,claseDataGrid,divDataGrid);}
function updateTableExcel_cas(archivoDataGrid1){
	//alert(':'+"SMS/"+archivoDataGrid1+'?useajax=true'+ params+'&modo=EXCEL&'+":")
	location.href="CAS/"+archivoDataGrid1+'?useajax=true'+ params+'&modo=EXCEL&';
}
