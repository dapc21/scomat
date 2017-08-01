//DataGrid
var archivoDataGrid="";
var claseDataGrid="DataGrid";
var divDataGrid_mat="datagrid";
var params_mat = ''; var tblpage_mat = ''; var tblorder_mat = ''; var tblfilter_mat = '';var tblresul_mat;

function tblSetResulTodo_mat(archivoDataGrid1,divDataGrid_mat1) { divDataGrid_mat=divDataGrid_mat1; document.getElementById('tblresul_'+divDataGrid_mat).value = document.getElementById('tblresulTodo_'+divDataGrid_mat).value; tblSetResul_mat(archivoDataGrid1,divDataGrid_mat1)}
function tblSetResul_mat(archivoDataGrid1,divDataGrid_mat1) { archivoDataGrid=archivoDataGrid1; divDataGrid_mat=divDataGrid_mat1; tblresul_mat = document.getElementById('tblresul_'+divDataGrid_mat).value; tblpage_mat = 1; params_mat = '&page=' + tblpage_mat + '&order=' + tblorder_mat + '&filter=' + tblfilter_mat + '&tblresul=' + tblresul_mat; updateTable_mat(); }
function tblSetPage_mat(page,archivoDataGrid1,divDataGrid_mat1) { archivoDataGrid=archivoDataGrid1; divDataGrid_mat=divDataGrid_mat1;  tblpage_mat = page; params_mat = '&page=' + page + '&order=' + tblorder_mat + '&filter=' + tblfilter_mat + '&tblresul=' + tblresul_mat; updateTable_mat(); }
function tblSetOrder_mat(column, order,archivoDataGrid1,divDataGrid_mat1) { archivoDataGrid=archivoDataGrid1; divDataGrid_mat=divDataGrid_mat1; tblorder_mat = column + ':' + order; params_mat = '&page=' + tblpage_mat + '&order=' + tblorder_mat + '&filter=' + tblfilter_mat + '&tblresul=' + tblresul_mat; updateTable_mat(); }
function tblSetFilter_mat(column,archivoDataGrid1,divDataGrid_mat1) { archivoDataGrid=archivoDataGrid1; divDataGrid_mat=divDataGrid_mat1;  val = document.getElementById('filter-value-'+divDataGrid_mat + column).value; tblfilter_mat = column + ':' + val; tblpage_mat = 1; params_mat = '&page=1&order=' + tblorder_mat + '&filter=' + tblfilter_mat + '&tblresul=' + tblresul_mat; updateTable_mat(); }
function tblClearFilter_mat() { tblfilter_mat = ''; params_mat = '&page=1&order=' + tblorder_mat + '&filter=' + '&tblresul=' + tblresul_mat; updateTable_mat(); }
function tblToggleCheckAll_mat() { for (i = 1; i < document.f1.checkbox.length; i++) { document.f1.checkbox[i].checked = !document.f1.checkbox[i].checked; } }
function tblShowHideFilter_mat(column,archivoDataGrid1,divDataGrid_mat1) { archivoDataGrid=archivoDataGrid1; divDataGrid_mat=divDataGrid_mat1; var o = document.getElementById('filter-'+divDataGrid_mat+ column); if (o.style.display == 'block') { tblClearFilter_mat(); } else { o.style.display = 'block'; } }
function tblReset_mat() { params_mat = '&page=1'; updateTable_mat(); }
function updateTable_mat() { conexionPHP_mat(archivoDataGrid+'?useajax=true'+ params_mat+ "&divDataGrid=" + divDataGrid_mat,claseDataGrid,divDataGrid_mat);
document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function updateTable_mat1() { conexionPHP_mat1(archivoDataGrid+'?useajax=true'+ params_mat+ "&divDataGrid=" + divDataGrid_mat,claseDataGrid,divDataGrid_mat);
document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function updateTableExcel_mat(archivoDataGrid1){
	location.href="saecomat/"+archivoDataGrid1+'?useajax=true'+ params_mat+'&modo=EXCEL&';
}