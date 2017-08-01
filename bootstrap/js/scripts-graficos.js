
function ajaxGrafico(opc, valor) {

	$.ajax("estadisticas/opcionEstadistica.php", {
		"type": "post",   // usualmente post o get
		"beforeSend": function(x) {
		if(x && x.overrideMimeType) {
				x.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		"success": function(data) {

			$('#gr-cargando').fadeOut(1000);
			$('#gr').hide();

			//Llamado a las funciones
			if(opc == 'ingresoDeuda'){ graficoIngresoDeuda(data); }
			else if(opc == 'abonado'){ graficoAbonado(data); }
			else if(opc == 'ordenAsignada'){ graficoOrdenAsignada(data); }
			else if(opc == 'ordenImpresa'){ graficoOrdenImpresa(data); }
			else if(opc == 'ordenFinalizada'){ graficoOrdenFinalizada(data); }
			else if(opc == 'llamada_asig_resp'){grafico_llamada_asig_resp(data);}
			else if(opc == 'llamada_asig_ubic'){grafico_llamada_asig_ubic(data);}
			
			//Activación del scrollbar
			$("html").niceScroll({ styler : "fb", cursorcolor : "#A7A7A7", cursorwidth : '10', cursorborderradius : '10px', background : '#FFFFFF', spacebarenabled : false, cursorborder       : '', zindex : '1000'});
			$("html").getNiceScroll().resize();

		},
		"error": function(data) {
			//var data.error = "Error interno del servidor";
			//console.error("Este callback maneja los errores", result);
		},
		"data": {opcion: valor},
		"async": true,
	});
 
}

function ajaxGraficoMes(item, valor, anio, franq) {

	$.ajax("estadisticas/opcionEstadistica.php", {
		"type": "post",   // usualmente post o get
		"beforeSend": function(x) {
		if(x && x.overrideMimeType) {
				x.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		"success": function(data) {
		
			$('#gr-cargando').fadeOut(1000);
			$('#gr').hide();

			if(item == 'abonadoMes'){ graficoAbonadoMes(data); }
			if(item == 'ingresoDeudaMes'){ graficoIngresoDeudaMes(data); }
			if(item == 'ordenAsignadaMes'){ graficoOrdenAsignadaMes(data); }
			if(item == 'ordenImpresaMes'){ graficoOrdenImpresaMes(data); }
			if(item == 'ordenFinalizadaMes'){ graficoOrdenFinalizadaMes(data); }
			
			//Activación del scrollbar
			$("html").niceScroll({ styler : "fb", cursorcolor : "#A7A7A7", cursorwidth : '10', cursorborderradius : '10px', background : '#FFFFFF', spacebarenabled : false, cursorborder       : '', zindex : '1000'});
			$("html").getNiceScroll().resize();

		},
		"error": function(data) {
			//var data.error = "Error interno del servidor";
			//console.error("Este callback maneja los errores", result);
		},
		"data": {opcion: valor, fecha_f: anio, franquicia: franq},
		"async": true,
	});
 
}

function graficoOrdenAsignadaMes(datos){
	tipoGraficoPorDefecto(datos, 'ordenAsignadaMesBarra');
	filtroTipoGrafico(datos, 'ordenAsignadaMes');
	filtroAniosFranq('selectAniosFranqOrdenMes','graficoOrdenAsigMesParam', 'ordAsigParamMes');
}

function graficoOrdenImpresaMes(datos){
	tipoGraficoPorDefecto(datos, 'ordenImpresaMesBarra');
	filtroTipoGrafico(datos, 'ordenImpresaMes');
	filtroAniosFranq('selectAniosFranqOrdenMes','graficoOrdenImpMesParam', 'ordImpParamMes');
}

function graficoOrdenFinalizadaMes(datos){
	tipoGraficoPorDefecto(datos, 'ordenFinalizadaMesBarra');
	filtroTipoGrafico(datos, 'ordenFinalizadaMes');
	filtroAniosFranq('selectAniosFranqOrdenMes','graficoOrdenFinMesParam', 'ordFinParamMes');
}

function graficoIngresoDeudaMes(datos){
	tipoGraficoPorDefecto(datos, 'ingresoDeudaMesBarra');
	filtroTipoGrafico(datos, 'ingresoDeudaMes');
	filtroAniosFranq('selectAniosFranqIngDeuMes','graficoIngresoDeudaMesParam', 'ingresoDeudaParamMes');
}

function graficoIngresoDeuda(datos){
	tipoGraficoPorDefecto(datos, 'ingresoDeudaBarra');
	filtroTipoGrafico(datos, 'ingresoDeuda');
	filtroAniosFranq('selectAniosFranqIngDeu','graficoIngresoDeudaParam', 'ingresoDeudaParam');
}

function graficoAbonadoMes(datos){
	tipoGraficoPorDefecto(datos, 'abonadoMesBarra');
	filtroTipoGrafico(datos, 'abonadoMes');
	filtroAniosFranq('selectAniosFranqAboMes','graficoAbonadoMesParam', 'aboParamMes');
}

function graficoAbonado(datos){
	tipoGraficoPorDefecto(datos, 'abonadoBarra');
	filtroTipoGrafico(datos, 'abonado');
	filtroAniosFranq('selectAniosFranqAbo','graficoAbonadoParam', 'aboParam');
}

function graficoOrdenAsignada(datos){
	tipoGraficoPorDefecto(datos, 'ordenAsignadaBarra');
	filtroTipoGrafico(datos, 'ordenAsignada');
	filtroAniosFranq('selectAniosFranqOrden','graficoOrdenAsigParam', 'ordAsigParam');
}

function graficoOrdenImpresa(datos){
	tipoGraficoPorDefecto(datos, 'ordenImpresaBarra');
	filtroTipoGrafico(datos, 'ordenImpresa');
	filtroAniosFranq('selectAniosFranqOrden','graficoOrdenImpParam', 'ordImpParam');
}

function graficoOrdenFinalizada(datos){
	tipoGraficoPorDefecto(datos, 'ordenFinalizadaBarra');
	filtroTipoGrafico(datos, 'ordenFinalizada');
	filtroAniosFranq('selectAniosFranqOrden','graficoOrdenFinParam', 'ordFinParam');
}



function grafico_llamada_asig_ubic(datos){
 
        $.jqplot.config.enablePlugins = true;
		
		//DATOS
		var total=[], moroso=[], pagado=[], pendiente=[], responsable=[], llamadas_real=[], llamadas_atend=[], llamadas_no_atend=[], por_llamar=[], deuda_moroso=[], monto_pagado=[], monto_pendiente=[];
		var suma_pago=0;
		var suma_pend=0;
		for (var i in datos){
			total[i]=datos[i].total;
			moroso[i]=datos[i].moroso;
			pendiente[i]=datos[i].pendiente;
			pagado[i]=datos[i].pagado;
			responsable[i]=datos[i].responsable;
			llamadas_real[i]=datos[i].llamadas_real;
			llamadas_atend[i]=datos[i].llamadas_atend;
			llamadas_no_atend[i]=datos[i].llamadas_no_atend;
			por_llamar[i]=datos[i].por_llamar;
			deuda_moroso[i]=datos[i].deuda_moroso;
			monto_pagado[i]=datos[i].monto_pagado;
			monto_pendiente[i]=datos[i].monto_pendiente;
			suma_pago=suma_pago+datos[i].pagado;
			suma_pend=suma_pend+datos[i].pendiente;
		}
		
        
		//GRAFICO DE BARRAS llamadas
        plot1 = $.jqplot('llamada_barra', [total, llamadas_real, llamadas_atend,llamadas_no_atend,por_llamar], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
			seriesColors:['#5081BF', '#C3524E', '#98DE99', '#56446E', '#A0C25D'],
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: responsable
                },
				yaxis:{
					label:'Llamadas',
					labelRenderer: $.jqplot.CanvasAxisLabelRenderer
				}
            },
            highlighter: { show: false },
			series:[
				{label:'Totales'},
				{label:'Realizadas'},
				{label:'Atendidas'},
				{label:'No Atendidas'},
				{label:'Por Llamar'}
			],
			legend: {
				show: true,
				placement: 'outsideGrid'
			},
        });

  
		//GRAFICO DE BARRAS
        plot2 = $.jqplot('hero-bar', [moroso, pagado, pendiente], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
			seriesColors:['#5081BF', '#C3524E', '#98DE99'],
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: responsable
                },
				yaxis:{
					label:'Clientes',
					labelRenderer: $.jqplot.CanvasAxisLabelRenderer
				}
            },
            highlighter: { show: false },
			series:[
				{label:'Morosos '},
				{label:'Pagaron '},
				{label:'Pendientes '}
			],
			legend: {
				show: true,
				placement: 'outsideGrid'
			},
        });

var data_total = [
    ['Que Pagaron', suma_pago],['Pendientes por Pagar ', suma_pend]
  ];
  var plot3 = jQuery.jqplot ('hero-area', [data_total], 
    { 
		
      seriesDefaults: {
        // Make this a pie chart.
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: {
		fill: true,
          // Put data labels on the pie slices.
          // By default, labels show the percentage of the slice.
          showDataLabels: true
        }
      }, 
      legend: { show:true, location: 'e' }
    }
  );

}


function grafico_llamada_asig_resp(datos){
 
        $.jqplot.config.enablePlugins = true;
		
		//DATOS
		var total=[], moroso=[], pagado=[], pendiente=[], responsable=[], llamadas_real=[], llamadas_atend=[], llamadas_no_atend=[], por_llamar=[], deuda_moroso=[], monto_pagado=[], monto_pendiente=[];
		var suma_pago=0;
		var suma_pend=0;
		for (var i in datos){
			total[i]=datos[i].total;
			moroso[i]=datos[i].moroso;
			pendiente[i]=datos[i].pendiente;
			pagado[i]=datos[i].pagado;
			responsable[i]=datos[i].responsable;
			llamadas_real[i]=datos[i].llamadas_real;
			llamadas_atend[i]=datos[i].llamadas_atend;
			llamadas_no_atend[i]=datos[i].llamadas_no_atend;
			por_llamar[i]=datos[i].por_llamar;
			deuda_moroso[i]=datos[i].deuda_moroso;
			monto_pagado[i]=datos[i].monto_pagado;
			monto_pendiente[i]=datos[i].monto_pendiente;
			suma_pago=suma_pago+datos[i].pagado;
			suma_pend=suma_pend+datos[i].pendiente;
		}
        
		//GRAFICO DE BARRAS llamadas
        plot1 = $.jqplot('llamada_barra', [total, llamadas_real, llamadas_atend,llamadas_no_atend,por_llamar], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
			seriesColors:['#5081BF', '#C3524E', '#98DE99', '#56446E', '#A0C25D'],
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: responsable
                },
				yaxis:{
					label:'Llamadas',
					labelRenderer: $.jqplot.CanvasAxisLabelRenderer
				}
            },
            highlighter: { show: false },
			series:[
				{label:'Totales'},
				{label:'Realizadas'},
				{label:'Atendidas'},
				{label:'No Atendidas'},
				{label:'Por Llamar'}
			],
			legend: {
				show: true,
				placement: 'outsideGrid'
			},
        });

  
		//GRAFICO DE BARRAS
        plot2 = $.jqplot('hero-bar', [moroso, pagado, pendiente], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
			seriesColors:['#5081BF', '#C3524E', '#98DE99'],
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: responsable
                },
				yaxis:{
					label:'Clientes',
					labelRenderer: $.jqplot.CanvasAxisLabelRenderer
				}
            },
            highlighter: { show: false },
			series:[
				{label:'Morosos '},
				{label:'Pagaron '},
				{label:'Pendientes '}
			],
			legend: {
				show: true,
				placement: 'outsideGrid'
			},
        });

var data_total = [
    ['Que Pagaron', suma_pago],['Pendientes por Pagar ', suma_pend]
  ];
  var plot3 = jQuery.jqplot ('hero-area', [data_total], 
    { 
		
      seriesDefaults: {
        // Make this a pie chart.
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: {
		fill: true,
          // Put data labels on the pie slices.
          // By default, labels show the percentage of the slice.
          showDataLabels: true
        }
      }, 
      legend: { show:true, location: 'e' }
    }
  );

}
