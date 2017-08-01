//DataGrid
var archivoDataGrid="";
var claseDataGrid="DataGrid";
var divDataGrid="datagrid";
var params = ''; var tblpage = ''; var tblorder = ''; var tblfilter = ''; var tblresul = '';
function tblSetResulTodo_sms(archivoDataGrid1,divDataGrid1) { divDataGrid=divDataGrid1; document.getElementById('tblresul_'+divDataGrid).value = document.getElementById('tblresulTodo_'+divDataGrid).value; tblSetResul_sms(archivoDataGrid1,divDataGrid1)}
function tblSetResul_sms(archivoDataGrid1,divDataGrid1) { archivoDataGrid=archivoDataGrid1; divDataGrid=divDataGrid1; tblresul = document.getElementById('tblresul_'+divDataGrid).value; tblpage = 1; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter + '&tblresul=' + tblresul; updateTable_sms(); }
function tblSetPage_sms(page,archivoDataGrid1,divDataGrid1) { archivoDataGrid=archivoDataGrid1; divDataGrid=divDataGrid1;  tblpage = page; params = '&page=' + page + '&order=' + tblorder + '&filter=' + tblfilter + '&tblresul=' + tblresul; updateTable_sms(); }
function tblSetOrder_sms(column, order,archivoDataGrid1,divDataGrid1) { archivoDataGrid=archivoDataGrid1; divDataGrid=divDataGrid1; tblorder = column + ':' + order; params = '&page=' + tblpage + '&order=' + tblorder + '&filter=' + tblfilter + '&tblresul=' + tblresul; updateTable_sms(); }
function tblSetFilter_sms(column,archivoDataGrid1,divDataGrid1) { archivoDataGrid=archivoDataGrid1; divDataGrid=divDataGrid1;  val = document.getElementById('filter-value-'+divDataGrid + column).value; tblfilter = column + ':' + val; tblpage = 1; params = '&page=1&order=' + tblorder + '&filter=' + tblfilter + '&tblresul=' + tblresul; updateTable_sms(); }
function tblClearFilter_sms() { tblfilter = ''; params = '&page=1&order=' + tblorder + '&filter=' + '&tblresul=' + tblresul; updateTable_sms(); }
function tblToggleCheckAll_sms() { for (i = 1; i < document.f1.checkbox.length; i++) { document.f1.checkbox[i].checked = !document.f1.checkbox[i].checked; } }
function tblShowHideFilter_sms(column,archivoDataGrid1,divDataGrid1) { archivoDataGrid=archivoDataGrid1; divDataGrid=divDataGrid1; var o = document.getElementById('filter-'+divDataGrid+ column); if (o.style.display == 'block') { tblClearFilter_sms(); } else { o.style.display = 'block'; } }
function tblReset_sms() { params = '&page=1'; updateTable_sms(); }
function updateTable_sms() { conexionPHP_sms(archivoDataGrid+'?useajax=true'+ params+ "&divDataGrid=" + divDataGrid,claseDataGrid,divDataGrid);
document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function updateTable_sms1() { conexionPHP_sms1(archivoDataGrid+'?useajax=true'+ params+ "&divDataGrid=" + divDataGrid,claseDataGrid,divDataGrid);
document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function updateTableExcel_sms(archivoDataGrid1){
	//alert(':'+"SMS/"+archivoDataGrid1+'?useajax=true'+ params+'&modo=EXCEL&'+":")
	location.href="SMS/"+archivoDataGrid1+'?useajax=true'+ params+'&modo=EXCEL&';
}
