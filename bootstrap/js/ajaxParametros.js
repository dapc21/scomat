
function ajaxGraficoParametros(item, valor, fi, ff, franq) {

	$.ajax("estadisticas/opcionEstadistica.php", {
		"type": "post",   // usualmente post o get
		"beforeSend": function(x) {
		if(x && x.overrideMimeType) {
				x.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		"success": function(data) {
		/*$('#gr').show();
		$('#gr').html('<div id="gr-cargando"><img src="bootstrap/img/ajax-loader.gif"/></div>');
		$('#gr-cargando').fadeOut(3000);
			$('#gr').hide();*/
			//Llamado a las funciones
			//Abonados
			if(item == 'graficoAbonadoParam'){ graficoAbonadoParam(data); }
			if(item == 'graficoAbonadoMesParam'){ graficoAbonadoMesParam(data);}
			//Ingreso y Deudas
			if(item == 'graficoIngresoDeudaParam'){ graficoIngresoDeudaParam(data); }
			if(item == 'graficoIngresoDeudaMesParam'){ graficoIngresoDeudaMesParam(data); }
			//Ordenes asignadas
			if(item == 'graficoOrdenAsigParam'){ graficoOrdenAsigParam(data); }
			if(item == 'graficoOrdenAsigMesParam'){ graficoOrdenAsigMesParam(data); }
			//Ordenes impresas
			if(item == 'graficoOrdenImpParam'){ graficoOrdenImpParam(data); }
			if(item == 'graficoOrdenImpMesParam'){ graficoOrdenImpMesParam(data); }
			//Ordenes finalizadas
			if(item == 'graficoOrdenFinParam'){ graficoOrdenFinParam(data); }
			if(item == 'graficoOrdenFinMesParam'){ graficoOrdenFinMesParam(data); }
			
			//Activación del scrollbar
			$("html").niceScroll({ styler : "fb", cursorcolor : "#A7A7A7", cursorwidth : '10', cursorborderradius : '10px', background : '#FFFFFF', spacebarenabled : false, cursorborder       : '', zindex : '1000'});
			$("html").getNiceScroll().resize();

		},
		"error": function(data) {
			//var data.error = "Error interno del servidor";
			//console.error("Este callback maneja los errores", result);
		},
		"data": {opcion: valor, fecha_i: fi, fecha_f: ff, franquicia: franq},
		"async": true,
	});
 
}

function graficoAbonadoParam(datos){

	var tp = $("#tipo_grafico").val();
		
		switch (tp) {
            case 'BARRA':
                abonadoBarra(datos);
			break;
            case 'LINEA':
                abonadoLinea(datos);
			break;
            case 'AREA':
                abonadoArea(datos);
			break;
            default:
			break;
		}
		
	
}

function graficoAbonadoMesParam(datos){

	var tp = $("#tipo_grafico").val();
		
		switch (tp) {
            case 'BARRA':
                abonadoMesBarra(datos);
			break;
            case 'LINEA':
                abonadoMesLinea(datos);
			break;
            case 'AREA':
                abonadoMesArea(datos);
			break;
            default:
			break;
		}
		
	
}

function graficoIngresoDeudaParam(datos){

	var tp = $("#tipo_grafico").val();
		
		switch (tp) {
            case 'BARRA':
                ingresoDeudaBarra(datos);
			break;
            case 'LINEA':
                ingresoDeudaLinea(datos);
			break;
            case 'AREA':
                ingresoDeudaArea(datos);
			break;
            default:
			break;
		}
		
	
}

function graficoIngresoDeudaMesParam(datos){

	var tp = $("#tipo_grafico").val();
		
		switch (tp) {
            case 'BARRA':
                ingresoDeudaMesBarra(datos);
			break;
            case 'LINEA':
                ingresoDeudaMesLinea(datos);
			break;
            case 'AREA':
                ingresoDeudaMesArea(datos);
			break;
            default:
			break;
		}
		
	
}

function graficoOrdenAsigParam(datos){

	var tp = $("#tipo_grafico").val();
		
		switch (tp) {
            case 'BARRA':
                ordenAsignadaBarra(datos);
			break;
            case 'LINEA':
                ordenAsignadaLinea(datos);
			break;
            case 'AREA':
                ordenAsignadaArea(datos);
			break;
            default:
			break;
		}
		
	
}

function graficoOrdenAsigMesParam(datos){

	var tp = $("#tipo_grafico").val();
		
		switch (tp) {
            case 'BARRA':
                ordenAsignadaMesBarra(datos);
			break;
            case 'LINEA':
                ordenAsignadaMesLinea(datos);
			break;
            case 'AREA':
                ordenAsignadaMesArea(datos);
			break;
            default:
			break;
		}
		
	
}

function graficoOrdenImpParam(datos){

	var tp = $("#tipo_grafico").val();
		
		switch (tp) {
            case 'BARRA':
                ordenImpresaBarra(datos);
			break;
            case 'LINEA':
                ordenImpresaLinea(datos);
			break;
            case 'AREA':
                ordenImpresaArea(datos);
			break;
            default:
			break;
		}
		
	
}

function graficoOrdenImpMesParam(datos){

	var tp = $("#tipo_grafico").val();
		
		switch (tp) {
            case 'BARRA':
                ordenImpresaMesBarra(datos);
			break;
            case 'LINEA':
                ordenImpresaMesLinea(datos);
			break;
            case 'AREA':
                ordenImpresaMesArea(datos);
			break;
            default:
			break;
		}
		
	
}

function graficoOrdenFinParam(datos){

	var tp = $("#tipo_grafico").val();
		
		switch (tp) {
            case 'BARRA':
                ordenFinalizadaBarra(datos);
			break;
            case 'LINEA':
                ordenFinalizadaLinea(datos);
			break;
            case 'AREA':
                ordenFinalizadaArea(datos);
			break;
            default:
			break;
		}
		
	
}

function graficoOrdenFinMesParam(datos){

	var tp = $("#tipo_grafico").val();
		
		switch (tp) {
            case 'BARRA':
                ordenFinalizadaMesBarra(datos);
			break;
            case 'LINEA':
                ordenFinalizadaMesLinea(datos);
			break;
            case 'AREA':
                ordenFinalizadaMesArea(datos);
			break;
            default:
			break;
		}
		
	
}