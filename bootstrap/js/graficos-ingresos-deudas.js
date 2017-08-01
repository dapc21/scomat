
function selectAniosFranqIngDeu(item, valor){

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

function selectAniosFranqIngDeuMes(item, valor){

	var anio = parseInt($("#anio_f").val());
	var franq = $("#id_franq").val();

	destruirGraficos();
	ajaxGraficoParametros(item, valor, '0', anio, franq);
	
}

/*********************************************************************/
/*********************** GRÁFICOS PARA ABONADOS  *********************/
/*********************************************************************/

function ingresoDeudaBarra(datos){

	var ingreso=[], deuda=[], deudaAct=[], anio=[];

	for (var i in datos){
		ingreso[i]=datos[i].total_ingreso;
		deuda[i]=datos[i].total_deuda;
		deudaAct[i]=datos[i].deuda_actual;
		anio[i]=datos[i].anio_pago;
	}
		
	p1 = {
		animate: !$.jqplot.use_excanvas,
		seriesColors:['#73C774', '#C7754C', '#00749F'],
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
				tickOptions: {
					formatString: '%.2f'
				},
				label:'BsF',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		highlighter: { show: false },
		series:[
			{label:'Ingresos Cierre'},
			{label:'Deudas Cierre'},
			{label:'Deuda Actual'}
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
	
	plot1 = $.jqplot('hero-bar', [ingreso, deuda], p1);
	
}


function ingresoDeudaMesBarra(datos){

	var ingreso=[], deuda=[], deudaAct=[], mes=[];

	for (var i in datos){
		ingreso[i]=datos[i].total_ingreso;
		deuda[i]=datos[i].total_deuda;
		deudaAct[i]=datos[i].deuda_actual;
		mes[i]=datos[i].mes;
	}
		
	p4 = {
		animate: !$.jqplot.use_excanvas,
		seriesColors:['#73C774', '#C7754C', '#00749F'],
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
				tickOptions: {
					formatString: '%.2f'
				},
				label:'BsF',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		highlighter: { show: false },
		series:[
			{label:'Ingresos Cierre'},
			{label:'Deudas Cierre'},
			{label:'Deuda Actual'}
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
	
	plot4 = $.jqplot('hero-bar', [ingreso, deuda], p4);
	
}

function ingresoDeudaLinea(datos){

	var ingreso=[], deuda=[], deudaAct=[], anio=[], anioingreso=[], aniodeuda=[];

	for (var i in datos){
		ingreso[i]=datos[i].total_ingreso;
		deuda[i]=datos[i].total_deuda;
		deudaAct[i]=datos[i].deuda_actual;
		anio[i]=datos[i].anio_pago;
	}
	
	p2 = {
		animate: !$.jqplot.use_excanvas,
		seriesColors:['#73C774', '#C7754C', '#00749F'],
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
			tickOptions: {
				formatString: '%.2f'
			},
			label:'BsF',
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer
		 }
		},
		series:[
			{label:'Ingresos Cierre'},
			{label:'Deudas Cierre'},
			{label:'Deuda Actual'}
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
	
	plot2 = $.jqplot('hero-graph', [ingreso, deuda], p2);
	
}


function ingresoDeudaMesLinea(datos){

	var ingreso=[], deuda=[], deudaAct=[], mes=[];

	for (var i in datos){
		ingreso[i]=datos[i].total_ingreso;
		deuda[i]=datos[i].total_deuda;
		deudaAct[i]=datos[i].deuda_actual;
		mes[i]=datos[i].mes;
	}
	
	p5 = {
		animate: !$.jqplot.use_excanvas,
		seriesColors:['#73C774', '#C7754C', '#00749F'],
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
			tickOptions: {
				formatString: '%.2f'
			},
			label:'BsF',
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer
		 }
		},
		series:[
			{label:'Ingresos Cierre'},
			{label:'Deudas Cierre'},
			{label:'Deuda Actual'}
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
	
	plot5 = $.jqplot('hero-graph', [ingreso, deuda], p5);
	
}

function ingresoDeudaArea(datos){

	var ingreso=[], deuda=[], deudaAct=[], anio=[], anioingreso=[], aniodeuda=[];

	for (var i in datos){
		ingreso[i]=datos[i].total_ingreso;
		deuda[i]=datos[i].total_deuda;
		deudaAct[i]=datos[i].deuda_actual;
		anio[i]=datos[i].anio_pago;
	}
		
	p3 = {
		animate: !$.jqplot.use_excanvas,
		seriesColors:['#73C774', '#C7754C', '#00749F'],
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
				tickOptions: {
					formatString: '%.2f'
				},
				label:'BsF',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		series:[
			{label:'Ingresos Cierre'},
			{label:'Deudas Cierre'},
			{label:'Deuda Actual'}
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
	
	plot3 = $.jqplot('hero-area', [ingreso, deuda], p3);
	
}


function ingresoDeudaMesArea(datos){

	var ingreso=[], deuda=[], deudaAct=[], mes=[];

	for (var i in datos){
		ingreso[i]=datos[i].total_ingreso;
		deuda[i]=datos[i].total_deuda;
		deudaAct[i]=datos[i].deuda_actual;
		mes[i]=datos[i].mes;
	}
		
	p6 = {
		animate: !$.jqplot.use_excanvas,
		seriesColors:['#73C774', '#C7754C', '#00749F'],
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
				tickOptions: {
					formatString: '%.2f'
				},
				label:'BsF',
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			}
		},
		series:[
			{label:'Ingresos Cierre'},
			{label:'Deudas Cierre'},
			{label:'Deuda Actual'}
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
	
	plot6 = $.jqplot('hero-area', [ingreso, deuda], p6);
	
}