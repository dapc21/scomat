
function selectAniosFranqOrden(item, valor){

	var inicio = parseInt($("#anio_i").val());
	var fin = parseInt($("#anio_f").val());
	var franq = $("#id_franq").val();

	if( inicio <= fin ){
		if( plot1 ) plot1.destroy();
		if( plot2 ) plot2.destroy();
		if( plot3 ) plot3.destroy();
		ajaxGraficoParametros(item, valor, inicio, fin, franq);
	}
	else{
		alert("El año inicial debe ser menor al año final.");
		reiniciarSelect();
	}
	
}

function selectAniosFranqOrdenMes (item, valor){

	var anio = parseInt($("#anio_f").val());
	var franq = $("#id_franq").val();

	destruirGraficos();
	ajaxGraficoParametros(item, valor, '0', anio, franq);
	
}

/*********************************************************************/
/***************** GRÁFICOS PARA ÓRDENES ASIGNADAS  ******************/
/*********************************************************************/

function ordenAsignadaBarra(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], anio=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
				label:'Órdenes de Servicios Asignadas',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		highlighter: { show: false },
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot1 = $.jqplot('hero-bar', [instaladas, cortados, reconectados, reclamos, otros, total], p1);
	
}


function ordenAsignadaMesBarra(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], mes=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
				label:'Órdenes de Servicios Asignadas',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		highlighter: { show: false },
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot4 = $.jqplot('hero-bar', [instaladas, cortados, reconectados, reclamos, otros, total], p4);
	
}

function ordenAsignadaLinea(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], anio=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
		total[i]=datos[i].total;
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
			label:'Órdenes de Servicios Asignadas',
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer
		 }
		},
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot2 = $.jqplot('hero-graph', [instaladas, cortados, reconectados, reclamos, otros, total], p2);
	
}


function ordenAsignadaMesLinea(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], mes=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
			label:'Órdenes de Servicios Asignadas',
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer
		 }
		},
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot5 = $.jqplot('hero-graph', [instaladas, cortados, reconectados, reclamos, otros, total], p5);
	
}


function ordenAsignadaArea(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], anio=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
				label:'Órdenes de Servicios Asignadas',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot3 = $.jqplot('hero-area', [instaladas, cortados, reconectados, reclamos, otros, total], p3);
	
}


function ordenAsignadaMesArea(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], mes=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
				label:'Órdenes de Servicios Asignadas',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot6 = $.jqplot('hero-area', [instaladas, cortados, reconectados, reclamos, otros, total], p6);
	
}


/*********************************************************************/
/****************** GRÁFICOS PARA ÓRDENES IMPRESAS  ******************/
/*********************************************************************/

function ordenImpresaBarra(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], anio=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
				label:'Órdenes de Servicios Impresas',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		highlighter: { show: false },
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot1 = $.jqplot('hero-bar', [instaladas, cortados, reconectados, reclamos, otros, total], p1);
	
}


function ordenImpresaMesBarra(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], mes=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
				label:'Órdenes de Servicios Impresas',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		highlighter: { show: false },
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot4 = $.jqplot('hero-bar', [instaladas, cortados, reconectados, reclamos, otros, total], p4);
	
}

function ordenImpresaLinea(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], anio=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
		total[i]=datos[i].total;
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
			label:'Órdenes de Servicios Impresas',
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer
		 }
		},
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot2 = $.jqplot('hero-graph', [instaladas, cortados, reconectados, reclamos, otros, total], p2);
	
}


function ordenImpresaMesLinea(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], mes=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
			label:'Órdenes de Servicios Impresas',
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer
		 }
		},
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot5 = $.jqplot('hero-graph', [instaladas, cortados, reconectados, reclamos, otros, total], p5);
	
}

function ordenImpresaArea(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], anio=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
				label:'Órdenes de Servicios Impresas',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot3 = $.jqplot('hero-area', [instaladas, cortados, reconectados, reclamos, otros, total], p3);
	
}


function ordenImpresaMesArea(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], mes=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
				label:'Órdenes de Servicios Impresas',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot6 = $.jqplot('hero-area', [instaladas, cortados, reconectados, reclamos, otros, total], p6);
	
}

/*********************************************************************/
/*************** GRÁFICOS PARA ÓRDENES FINALIZADAS  ******************/
/*********************************************************************/

function ordenFinalizadaBarra(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], anio=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
				label:'Órdenes de Servicios Finalizadas',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		highlighter: { show: false },
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot1 = $.jqplot('hero-bar', [instaladas, cortados, reconectados, reclamos, otros, total], p1);
	
}


function ordenFinalizadaMesBarra(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], mes=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
				label:'Órdenes de Servicios Finalizadas',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		highlighter: { show: false },
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot4 = $.jqplot('hero-bar', [instaladas, cortados, reconectados, reclamos, otros, total], p4);
	
}

function ordenFinalizadaLinea(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], anio=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
		total[i]=datos[i].total;
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
			label:'Órdenes de Servicios Finalizadas',
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer
		 }
		},
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot2 = $.jqplot('hero-graph', [instaladas, cortados, reconectados, reclamos, otros, total], p2);
	
}


function ordenFinalizadaMesLinea(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], mes=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
			label:'Órdenes de Servicios Finalizadas',
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer
		 }
		},
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot5 = $.jqplot('hero-graph', [instaladas, cortados, reconectados, reclamos, otros, total], p5);
	
}

function ordenFinalizadaArea(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], anio=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
				label:'Órdenes de Servicios Finalizadas',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot3 = $.jqplot('hero-area', [instaladas, cortados, reconectados, reclamos, otros, total], p3);
	
}


function ordenFinalizadaMesArea(datos){

	var instaladas=[], cortados=[], reconectados=[], reclamos=[], otros=[], total=[], mes=[];

	for (var i in datos){
		instaladas[i]=datos[i].instaladas;
		cortados[i]=datos[i].cortados;
		reconectados[i]=datos[i].reconectados;
		reclamos[i]=datos[i].reclamos;
		otros[i]=datos[i].otros;
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
				label:'Órdenes de Servicios Finalizadas',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		series:[
			{label:'Instalados'},
			{label:'Cortados'},
			{label:'Reconectados'},
			{label:'Reclamos'},
			{label:'Otros'},
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
	
	plot6 = $.jqplot('hero-area', [instaladas, cortados, reconectados, reclamos, otros, total], p6);
	
}