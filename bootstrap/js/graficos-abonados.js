
function selectAniosFranqAbo(item, valor){

	var inicio = parseInt($("#anio_i").val());
	var fin = parseInt($("#anio_f").val());
	var franq = $("#id_franq").val();

	if( inicio <= fin ){
		destruirGraficos();
		ajaxGraficoParametros(item, valor, inicio, fin, franq);
	}
	else{
		alert("El año inicial debe ser menor al año final.");
		reiniciarSelect();
	}
	
}

function selectAniosFranqAboMes(item, valor){

	var anio = parseInt($("#anio_f").val());
	var franq = $("#id_franq").val();

	destruirGraficos();
	ajaxGraficoParametros(item, valor, '0', anio, franq);
	
}

/*********************************************************************/
/*********************** GRÁFICOS PARA ABONADOS  *********************/
/*********************************************************************/

function abonadoBarra(datos){

	var activos=[], cortados=[], xinstalar=[], xcortar=[], xreconectar=[], exonerado=[], otros=[], total=[], anio=[];

	for (var i in datos){
		activos[i]=datos[i].activos;
		cortados[i]=datos[i].cortados;
		/*
		xinstalar[i]=datos[i].xinstalar;
		xcortar[i]=datos[i].xcortar;
		xreconectar[i]=datos[i].xreconectar;
		exonerado[i]=datos[i].exonerado;
		otros[i]=datos[i].otros;
		*/
		total[i]=datos[i].total;
		anio[i]=datos[i].anio;
	}
		
	p1 = {
		animate: !$.jqplot.use_excanvas,
		seriesColors:['#73C774', '#C7754C', '#00749F', '#4bb2c5', '#c5b47f', '#EAA228', '#579575', '#839557'],
		seriesDefaults:{
			renderer:$.jqplot.BarRenderer,
			pointLabels: { show: true }
		},
		axes: {
			xaxis: {
				renderer: $.jqplot.CategoryAxisRenderer,
				ticks: anio,
				label:'Años'
			},
			yaxis:{
				label:'Nº de Abonados',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		highlighter: { show: false },
		series:[
			{label:'Activos'},
			{label:'Cortados'},
			/*
			{label:'Por Instalar'},
			{label:'Por Cortar'},
			{label:'Por Reconectar'},
			{label:'Exonerados'},
			{label:'Otros'},
			*/
			{label:'Total'}
		],
		legend: {
			show: true,
			placement: 'outsideGrid'
		},   
		grid:{
			background: '#f8f8f8'
		},
		cursor: {
		 show: true
		}
	};
	
	plot1 = $.jqplot('hero-bar', [activos, cortados], p1);
	
}


function abonadoMesBarra(datos){

	var activos=[], cortados=[], xinstalar=[], xcortar=[], xreconectar=[], exonerado=[], otros=[], total=[], mes=[];
	
	for (var i in datos){
		activos[i]=datos[i].activos;
		cortados[i]=datos[i].cortados;
		/*
		xinstalar[i]=datos[i].xinstalar;
		xcortar[i]=datos[i].xcortar;
		xreconectar[i]=datos[i].xreconectar;
		exonerado[i]=datos[i].exonerado;
		otros[i]=datos[i].otros;
		*/
		total[i]=datos[i].total;
		mes[i]=datos[i].mes;
	}
		
	p4 = {
		animate: !$.jqplot.use_excanvas,
		seriesColors:['#73C774', '#C7754C', '#00749F', '#4bb2c5', '#c5b47f', '#EAA228', '#579575', '#839557'],
		seriesDefaults:{
			renderer:$.jqplot.BarRenderer,
			pointLabels: { show: true }
		},
		axes: {
			xaxis: {
				renderer: $.jqplot.CategoryAxisRenderer,
				ticks: mes,
				label:'Meses del año '+datos[0].anio
			},
			yaxis:{
				label:'Nº de Abonados',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		highlighter: { show: false },
		series:[
			{label:'Activos'},
			{label:'Cortados'},/*
			{label:'Por Instalar'},
			{label:'Por Cortar'},
			{label:'Por Reconectar'},
			{label:'Exonerados'},
			{label:'Otros'},*/
			{label:'Total'}
		],
		legend: {
			show: true,
			placement: 'outsideGrid'
		},   
		grid:{
			background: '#f8f8f8'
		},
		cursor: {
		 show: true
		}
	};
	
	plot4 = $.jqplot('hero-bar', [activos, cortados], p4);
	
}


function abonadoLinea(datos){

	var activos=[], cortados=[], xinstalar=[], xcortar=[], xreconectar=[], exonerado=[], otros=[], total=[], anio=[];

	for (var i in datos){
		activos[i]=datos[i].activos;
		cortados[i]=datos[i].cortados;/*
		xinstalar[i]=datos[i].xinstalar;
		xcortar[i]=datos[i].xcortar;
		xreconectar[i]=datos[i].xreconectar;
		exonerado[i]=datos[i].exonerado;
		otros[i]=datos[i].otros;
		total[i]=datos[i].total;*/
		anio[i]=datos[i].anio;
	}
	
	p2 = {
		animate: !$.jqplot.use_excanvas,
		seriesColors:['#73C774', '#C7754C', '#00749F', '#4bb2c5', '#c5b47f', '#EAA228', '#579575', '#839557'],
		seriesDefaults:{
			pointLabels: { show: true }
		},
		axes: {
		xaxis: {
			renderer: $.jqplot.CategoryAxisRenderer,
			ticks: anio,
			label:'Años'
		 },
		yaxis: {
			label:'Nº de Abonados',
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer
		 }
		},
		series:[
			{label:'Activos'},
			{label:'Cortados'},/*
			{label:'Por Instalar'},
			{label:'Por Cortar'},
			{label:'Por Reconectar'},
			{label:'Exonerados'},
			{label:'Otros'},*/
			{label:'Total'}
		],
		highlighter: { show: false },
		legend: {
			show: true,
			placement: 'outsideGrid'
		},   
		grid:{
			background: '#f8f8f8'
		},
		cursor: {
		 show: true
		}
	};
	
	plot2 = $.jqplot('hero-graph', [activos, cortados], p2);
	
}

function abonadoMesLinea(datos){

	var activos=[], cortados=[], xinstalar=[], xcortar=[], xreconectar=[], exonerado=[], otros=[], total=[], mes=[];
	
	for (var i in datos){
		activos[i]=datos[i].activos;
		cortados[i]=datos[i].cortados;/*
		xinstalar[i]=datos[i].xinstalar;
		xcortar[i]=datos[i].xcortar;
		xreconectar[i]=datos[i].xreconectar;
		exonerado[i]=datos[i].exonerado;
		otros[i]=datos[i].otros;*/
		total[i]=datos[i].total;
		mes[i]=datos[i].mes;
	}
	
	p5 = {
		animate: !$.jqplot.use_excanvas,
		seriesColors:['#73C774', '#C7754C', '#00749F', '#4bb2c5', '#c5b47f', '#EAA228', '#579575', '#839557'],
		seriesDefaults:{
			pointLabels: { show: true }
		},
		axes: {
		xaxis: {
			renderer: $.jqplot.CategoryAxisRenderer,
			ticks: mes,
			label:'Meses del año '+datos[0].anio
		 },
		yaxis: {
			label:'Nº de Abonados',
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer
		 }
		},
		series:[
			{label:'Activos'},
			{label:'Cortados'},/*
			{label:'Por Instalar'},
			{label:'Por Cortar'},
			{label:'Por Reconectar'},
			{label:'Exonerados'},
			{label:'Otros'},*/
			{label:'Total'}
		],
		highlighter: { show: false },
		legend: {
			show: true,
			placement: 'outsideGrid'
		},   
		grid:{
			background: '#f8f8f8'
		},
		cursor: {
		 show: true
		}
	};
	
	plot5 = $.jqplot('hero-graph', [activos, cortados], p5);
	
}

function abonadoArea(datos){

	var activos=[], cortados=[], xinstalar=[], xcortar=[], xreconectar=[], exonerado=[], otros=[], total=[], anio=[];

	for (var i in datos){
		activos[i]=datos[i].activos;
		cortados[i]=datos[i].cortados;/*
		xinstalar[i]=datos[i].xinstalar;
		xcortar[i]=datos[i].xcortar;
		xreconectar[i]=datos[i].xreconectar;
		exonerado[i]=datos[i].exonerado;
		otros[i]=datos[i].otros;*/
		total[i]=datos[i].total;
		anio[i]=datos[i].anio;
	}
		
	p3 = {
		animate: !$.jqplot.use_excanvas,
		seriesColors:['#73C774', '#C7754C', '#00749F', '#4bb2c5', '#c5b47f', '#EAA228', '#579575', '#839557'],
		seriesDefaults:{
			showMarker: true,
			fill: true
		},
		stackSeries: true,
		axes: {
			xaxis: {
				renderer: $.jqplot.CategoryAxisRenderer,
				ticks: anio,
				label:'Años'
			},
			yaxis: {
				label:'Nº de Abonados',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		series:[
			{label:'Activos'},
			{label:'Cortados'},/*
			{label:'Por Instalar'},
			{label:'Por Cortar'},
			{label:'Por Reconectar'},
			{label:'Exonerados'},
			{label:'Otros'},*/
			{label:'Total'}
		],
		legend: {
			show: true,
			placement: 'outsideGrid'
		},   
		grid:{
			background: '#f8f8f8'
		},
		cursor: {
		 show: true
		}
	};
	
	plot3 = $.jqplot('hero-area', [activos, cortados], p3);
	
}

function abonadoMesArea(datos){

	var activos=[], cortados=[], xinstalar=[], xcortar=[], xreconectar=[], exonerado=[], otros=[], total=[], mes=[];
	
	for (var i in datos){
		activos[i]=datos[i].activos;
		cortados[i]=datos[i].cortados;/*
		xinstalar[i]=datos[i].xinstalar;
		xcortar[i]=datos[i].xcortar;
		xreconectar[i]=datos[i].xreconectar;
		exonerado[i]=datos[i].exonerado;
		otros[i]=datos[i].otros;*/
		total[i]=datos[i].total;
		mes[i]=datos[i].mes;
	}
		
	p6 = {
		animate: !$.jqplot.use_excanvas,
		seriesColors:['#73C774', '#C7754C', '#00749F', '#4bb2c5', '#c5b47f', '#EAA228', '#579575', '#839557'],
		seriesDefaults:{
			showMarker: true,
			fill: true
		},
		stackSeries: true,
		axes: {
			xaxis: {
				renderer: $.jqplot.CategoryAxisRenderer,
				ticks: mes,
				label:'Meses del año '+datos[0].anio
			},
			yaxis: {
				label:'Nº de Abonados',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		series:[
			{label:'Activos'},
			{label:'Cortados'},/*
			{label:'Por Instalar'},
			{label:'Por Cortar'},
			{label:'Por Reconectar'},
			{label:'Exonerados'},
			{label:'Otros'},*/
			{label:'Total'}
		],
		legend: {
			show: true,
			placement: 'outsideGrid'
		},   
		grid:{
			background: '#f8f8f8'
		},
		cursor: {
		 show: true
		}
	};
	
	plot6 = $.jqplot('hero-area', [activos, cortados], p6);
	
}
