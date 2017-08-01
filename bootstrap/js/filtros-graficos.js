/*********************************************************************/
/************************ VARIABLES GLOBALES *************************/
/*********************************************************************/

var p1, p2, p3, p4, p5, p6, plot1, plot2, plot3, plot4, plot5, plot6;

/*********************************************************************/
/****** ACCIONES PARA LOS SELECTS O LISTAS DE TIPOS DE GRÁFICOS*******/
/*********************************************************************/

function filtroTipoGrafico(datos, opcg){

	var barra = opcg+'Barra';
	var linea = opcg+'Linea';
	var area = opcg+'Area';

	$('select[name=tipo_grafico]').change(function(){
	
		destruirGraficos();
		reiniciarSelect();
		
		switch ($(this).val()) {
            case 'BARRA':
                mostrarGraficoBarra(datos, barra);
			break;
            case 'LINEA':
                mostrarGraficoLinea(datos, linea);
			break;
            case 'AREA':
                mostrarGraficoArea(datos, area);
			break;
            default:
			break;
		}

    });
	
}

/*********************************************************************/
/************* ACCIONES PARA LOS SELECTS O LISTAS DE AÑOS*************/
/*********************************************************************/

function filtroAniosFranq(opcion, item, valor){
		 
	$('select[name=anio_i]').change(function(){
		selectAniosFranq(opcion, item, valor);
    });

	$('select[name=anio_f]').change(function(){
		selectAniosFranq(opcion, item, valor);
    });
	
	$('select[name=id_franq]').change(function(){
		selectAniosFranq(opcion, item, valor);
    });
	
}

function selectAniosFranq(opcion, item, valor){

	switch (opcion) {
		case 'selectAniosFranqAbo':
			selectAniosFranqAbo(item, valor);
		break;
		case 'selectAniosFranqAboMes':
			selectAniosFranqAboMes(item, valor);
		break;
		case 'selectAniosFranqIngDeu':
			selectAniosFranqIngDeu(item, valor);
		break;
		case 'selectAniosFranqIngDeuMes':
			selectAniosFranqIngDeuMes(item, valor);
		break;
		case 'selectAniosFranqOrden':
			selectAniosFranqOrden(item, valor);
		break;
		case 'selectAniosFranqOrdenMes':
			selectAniosFranqOrdenMes(item, valor);
		break;
		default:
		break;
	}
	
}

/*********************************************************************/
/******************* REINICIO DE SELECTS O LISTAS ********************/
/*********************************************************************/

function reiniciarSelect(){
	$('#anio_i').val( $('#anio_i').prop('defaultSelected') );
	$('#anio_f').val( $('#anio_f').prop('defaultSelected') );
	$('#id_franq').val( $('#id_franq').prop('defaultSelected') );
}

/*********************************************************************/
/************************ REINICIO DE GRÁFICOS ***********************/
/*********************************************************************/

function destruirGraficos(){
	if( plot1 ) plot1.destroy();
	if( plot2 ) plot2.destroy();
	if( plot3 ) plot3.destroy();
	if( plot4 ) plot4.destroy();
	if( plot5 ) plot5.destroy();
	if( plot6 ) plot6.destroy();
}

/*********************************************************************/
/********* LLAMADO A UN TIPO DE GRÁFICO EN PARTICULAR  ***************/
/*********************************************************************/

function mostrarGraficoBarra(datos, opcion){
	$('#linea').hide();
	$('#area').hide();
	$('#barra').fadeToggle(2000);
	opcGraficoBarra(datos, opcion);
}

function mostrarGraficoLinea(datos, opcion){
	$('#barra').hide();
	$('#area').hide();
	$('#linea').fadeToggle(2000);
	opcGraficoLinea(datos, opcion);
}

function mostrarGraficoArea(datos, opcion){
	$('#barra').hide();
	$('#linea').hide();
	$('#area').fadeToggle(2000);
	opcGraficoArea(datos, opcion);
}

/*********************************************************************/
/**************** OPCIONES PARA EL TIPO DE GRÁFICO  ******************/
/*********************************************************************/

function opcGraficoBarra(datos, opcion){
	
	switch (opcion) {
		case 'ordenAsignadaBarra':
			ordenAsignadaBarra(datos);
		break;
		case 'ordenAsignadaMesBarra':
			ordenAsignadaMesBarra(datos);
		break;
		case 'ordenImpresaBarra':
			ordenImpresaBarra(datos);
		break;
		case 'ordenImpresaMesBarra':
			ordenImpresaMesBarra(datos);
		break;
		case 'ordenFinalizadaBarra':
			ordenFinalizadaBarra(datos);
		break;
		case 'ordenFinalizadaMesBarra':
			ordenFinalizadaMesBarra(datos);
		break;
		case 'abonadoBarra':
			abonadoBarra(datos);
		break;
		case 'abonadoMesBarra':
			abonadoMesBarra(datos);
		break;
		case 'ingresoDeudaBarra':
			ingresoDeudaBarra(datos);
		break;
		case 'ingresoDeudaMesBarra':
			ingresoDeudaMesBarra(datos);
		break;
		default:
		break;
	}
	
}

function opcGraficoLinea(datos, opcion){
	
	switch (opcion) {
		case 'ordenAsignadaLinea':
			ordenAsignadaLinea(datos);
		break;
		case 'ordenAsignadaMesLinea':
			ordenAsignadaMesLinea(datos);
		break;
		case 'ordenImpresaLinea':
			ordenImpresaLinea(datos);
		break;
		case 'ordenImpresaMesLinea':
			ordenImpresaMesLinea(datos);
		break;
		case 'ordenFinalizadaLinea':
			ordenFinalizadaLinea(datos);
		break;
		case 'ordenFinalizadaMesLinea':
			ordenFinalizadaMesLinea(datos);
		break;
		case 'abonadoLinea':
			abonadoLinea(datos);
		break;
		case 'abonadoMesLinea':
			abonadoMesLinea(datos);
		break;
		case 'ingresoDeudaLinea':
			ingresoDeudaLinea(datos);
		break;
		case 'ingresoDeudaMesLinea':
			ingresoDeudaMesLinea(datos);
		break;
		default:
		break;
	}
	
}

function opcGraficoArea(datos, opcion){
	
	switch (opcion) {
		case 'ordenAsignadaArea':
			ordenAsignadaArea(datos);
		break;
		case 'ordenAsignadaMesArea':
			ordenAsignadaMesArea(datos);
		break;
		case 'ordenImpresaArea':
			ordenImpresaArea(datos);
		break;
		case 'ordenImpresaMesArea':
			ordenImpresaMesArea(datos);
		break;
		case 'ordenFinalizadaArea':
			ordenFinalizadaArea(datos);
		break;
		case 'ordenFinalizadaMesArea':
			ordenFinalizadaMesArea(datos);
		break;
		case 'abonadoArea':
			abonadoArea(datos);
		break;
		case 'abonadoMesArea':
			abonadoMesArea(datos);
		break;
		case 'ingresoDeudaArea':
			ingresoDeudaArea(datos);
		break;
		case 'ingresoDeudaMesArea':
			ingresoDeudaMesArea(datos);
		break;
		default:
		break;
	}
	
}

/*********************************************************************/
/********* ACCIONES PARA EL TIPO DE GRÁFICO POR DEFECTO **************/
/*********************************************************************/

function tipoGraficoPorDefecto(datos, opcion){
	mostrarGraficoBarra(datos, opcion);
}

/*********************************************************************/
/********* ACCIONES PARA GENERAR LA IMAGEN DE LA GRÁFICA *************/
/*********************************************************************/

function generarImg(){
	var capa = opcTP();
	
	var img = $(capa).jqplotToImage(50, 0);

	if (img) {
		var data = img.toDataURL("image/png");
		sendToServer(data);
	}
}

function sendToServer(data) {

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
		// request complete
		if (xhr.readyState == 4) {
			window.open("estadisticas/generarPDF.php?nombre="+myTrim(xhr.responseText),"estadisticas","menubar=no,resizable=yes,location=no,scrollbars=yes,status=yes,toolbar=no");
		}
    }
    xhr.open('POST','estadisticas/guardarImg.php',true);
    xhr.setRequestHeader('Content-Type', 'application/upload');
    xhr.send(data);
}

function myTrim(x) {
    return x.replace(/^\s+|\s+$/gm,'');
}
	
function opcTP(){

	var res ='';
	var barra = '#hero-bar';
	var linea = '#hero-graph';
	var area = '#hero-area';
	
	
	switch ( $('#tipo_grafico').val() ) {
		case 'BARRA':
			res = barra;
		break;
		case 'LINEA':
			res = linea;
		break;
		case 'AREA':
			res = area;
		break;
		default: 
		break;
	}

	return res;	
}