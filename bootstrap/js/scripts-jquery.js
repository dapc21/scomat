

/*---FUNCIÓN EJECUTADA CUANDO SE INVOCA EL LLAMADO DE LA CAPA PRINCIPAL TRAS CLICKEAR UN ITEM DEL MENÚ ----*/
function cargarPrincipal(){

	$("html").niceScroll({
		styler             : "fb",
		cursorcolor        : "#A7A7A7", 
		cursorwidth        : '10', 
		cursorborderradius : '10px', 
		background         : '#FFFFFF', 
		spacebarenabled    : false,  
		cursorborder       : '',
		zindex             : '1000'
	});

	$("html").getNiceScroll().resize(); //Redimensiona el scrollbar dependiendo del alto del contenido del div (en este caso #principal que contiene los formularios)

	// div cargando de la capa donde se cargan todos los formularios
	$('#carga').css({'display': 'none'});
	//$('#carga').loadingOverlay('remove'); //corto el cargando cuando carga la petición
	/** la aplicación de scrollbar de color carga una vez que la
	capa del formulario es redimensionada después de ejecutar ajax**********/
	
	/** Tooltip del botón de búsqueda **********/
	$("body").tooltip({ selector: '[data-toggle="tooltip"]' });

	/** Popovers del botón de búsqueda **********/
	$('#buscar_avanzado_cargar_deuda').on('hover', function () {
	  $( "#buscar_avanzado_cargar_deuda" ).popover('show');
	});
	
	$('#buscar_avanzado_facturar_clientes').on('hover', function () {
	  $( "#buscar_avanzado_facturar_clientes" ).popover('show');
	});
	
	$('#buscar_avanzado_consultar_clientes').on('hover', function () {
	  $( "#buscar_avanzado_consultar_clientes" ).popover('show');
	});
	
	$('#buscar_avanzado_promo_contrato').on('hover', function () {
	  $( "#buscar_avanzado_promo_contrato" ).popover('show');
	});
	
	$('#add_asignar_orden').on('hover', function () {
	  $( "#add_asignar_orden" ).popover('show');
	});
	
	$('#add_cargar_deuda').on('hover', function () {
	  $( "#add_cargar_deuda" ).popover('show');
	});
	
	$('#add_cargar_mes').on('hover', function () {
	  $( "#add_cargar_mes" ).popover('show');
	});
	
	$('#cargar_factura_imprimir').on('hover', function () {
	  $( "#cargar_factura_imprimir" ).popover('show');
	});
	
	$('#cargar_factura_anular').on('hover', function () {
	  $( "#cargar_factura_anular" ).popover('show');
	});
	
	$('#registrar_reimp_factura').on('hover', function () {
	  $( "#registrar_reimp_factura" ).popover('show');
	});
	
	$('#buscar_avanzado_reimprimir_ordenes').on('hover', function () {
	  $( "#buscar_avanzado_reimprimir_ordenes" ).popover('show');
	});
	
	$('.spinner-tabla').spinner({max: this.value});
	
	window.prettyPrint && prettyPrint();
    $('.default-date-picker').datepicker({
            format: 'dd/mm/yyyy'
    });
	
	checkRadio();

}

function checkRadio(){

	var d = document;
    var safari = (navigator.userAgent.toLowerCase().indexOf('safari') != -1) ? true : false;
	var gebtn = function(parEl,child) { return parEl.getElementsByTagName(child); };
	var body = gebtn(d,'body')[0];
	
	
		if (!d.getElementById || !d.createTextNode) return;
        var ls = gebtn(d,'label');
	
        for (var i = 0; i < ls.length; i++) {
            var l = ls[i];
            if (l.className.indexOf('label_') == -1) continue;
            var inp = gebtn(l,'input')[0];
            if (l.className == 'label_check') {
                l.className = (safari && inp.checked == true || inp.checked) ? 'label_check c_on' : 'label_check c_off';
                l.onclick = check_it;
            };
            if (l.className == 'label_radio') {
                l.className = (safari && inp.checked == true || inp.checked) ? 'label_radio r_on' : 'label_radio r_off';
                l.onclick = turn_radio;
            };
        };	
	
}	

var check_it = function() {

	var safari = (navigator.userAgent.toLowerCase().indexOf('safari') != -1) ? true : false;
	var gebtn = function(parEl,child) { return parEl.getElementsByTagName(child); };
	
	var inp = gebtn(this,'input')[0];
	if (this.className == 'label_check c_off' || (!safari && inp.checked)) {
		this.className = 'label_check c_on';
		if (safari) inp.click();
	} else {
		this.className = 'label_check c_off';
		if (safari) inp.click();
	};
};

var turn_radio = function() {

	var safari = (navigator.userAgent.toLowerCase().indexOf('safari') != -1) ? true : false;
	var gebtn = function(parEl,child) { return parEl.getElementsByTagName(child); };
	
	var inp = gebtn(this,'input')[0];
	if (this.className == 'label_radio r_off' || inp.checked) {
		var ls = gebtn(this.parentNode,'label');
		for (var i = 0; i < ls.length; i++) {
			var l = ls[i];
			if (l.className.indexOf('label_radio') == -1)  continue;
			l.className = 'label_radio r_off';
		};
		this.className = 'label_radio r_on';
		if (safari) inp.click();
	} else {
		this.className = 'label_radio r_off';
		if (safari) inp.click();
	};
};

var Script = function () {

	/*---LEFT BAR ACCORDION----*/
	$(function() {
		$('#nav-accordion').dcAccordion({
			eventType: 'click',
			autoClose: true,
			saveState: true,
			disableLink: true,
			speed: 'medium', /*fast (rápido), slow(lento), medium (medio)*/
			showCount: false,
			autoExpand: true,
	//        cookie: 'dcjq-accordion-1',
			classExpand: 'dcjq-current-parent'
		});
	});


	/*---CONTROL DE BOTÓN DE IR HACIA ARRIBA----*/
	$(function()
	 {
	 
		// Oculta la barra cuando la página ha terminado de cargar.
		 $(".site-footer").css("display", "none");
	 
		// Esta función se ejecuta cada vez que el usuario desplaza la página.
		$(window).scroll(function(){

			// Comprueba el tiempo que el usuario se ha desplazado hacia abajo (si "scrollTop ()" "es mayor que 0)
			if($(window).scrollTop() > 0){
				// Si es mayor a 0 (cero) muestra la barra con el botón para ir al inicio o tope de la página.
				//log("más");
				$(".site-footer").fadeIn("slow");
			}
			else {
				// Sino oculta la barra con el botón.
				//log("menos");
				$(".site-footer").fadeOut("slow");
			}
		});

		// Cuando el usuario clickea el botón, el scroll te lleva al inicio o tope de la página.
		$(".go-top").click(function(event){

			event.preventDefault();

			// Anima el movimiento durante el desplazamiento.
			$("html, body").animate({
				scrollTop:0
			},"slow");
		 
		});
		

	});

	/*--- CAPA CARGANDO CUANDO SE CLICKEA EN UN ITEM DEL MENÚ ----*/
	$(function () {
		//Id de la capa
		var capaCargando = $('#carga');
		
		//Evento "click" que muestra la capa de carga y dispara la función
		$('#sidebar .sub li > a:last-child').click(function () {
				var wSize = $(window).width();
				if (wSize <= 768) {
					$('#container').addClass('sidebar-close');
					//$('#sidebar > ul').fadeOut("medium");
					$('#sidebar > ul').hide("slow");
				}
				//Tuve que llevar el scroll hacia arriba para que tape la falta del div cargando
				$("html, body").animate({
					scrollTop:0
				},"medium");

			
			$('#carga').css({
				'display': 'block'
			});

			//capaCargando.loadingOverlay();
			//capaCargando.css({'display': 'none'});
			
		});	
			

	});


//Definición y manejo del niceScroll (para el menú lateral)

	$("#sidebar").niceScroll({
		styler:"fb",
		cursorcolor:"#A7A7A7", 
		cursorwidth: '8', 
		cursorborderradius: '12px', 
		background: '#FFFFFF', 
		spacebarenabled:false, 
		cursorborder: ''
	});
	
    jQuery('#sidebar .sub-menu > a').click(function () {
        var o = ($(this).offset()); 
        diff = 250 - o.top;
        if(diff>0){
            $("#sidebar").scrollTo("-="+Math.abs(diff),500);
			
        }else{
            $("#sidebar").scrollTo("+="+Math.abs(diff),500);
		}
    });
	
	$("#sidebar").mouseover(function() {
		$("#sidebar").getNiceScroll().resize();
	});
	
	$("#sidebar .sub-menu > a").click(function() {
		$("#sidebar").getNiceScroll().resize();
	});

//    sidebar toggle

    $(function() {
        function responsiveView() {
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#container').addClass('sidebar-close');
                $('#sidebar > ul').hide();
            }

            if (wSize > 768) {
                $('#container').removeClass('sidebar-close');
                $('#sidebar > ul').show();
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);
    });

    $('.fa-bars').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px'
            });
            $('#sidebar').css({
                'margin-left': '-260px'
            });
			
			//$('#sidebar > ul').hide(); //ocultar original
			$('#sidebar > ul').slideUp();  //ocultar con efecto
			$("#sidebar").getNiceScroll().hide();
			$("#container").addClass("sidebar-closed");
			
        } else {
            $('#main-content').css({
                'margin-left': '260px'
            });
            //$('#sidebar > ul').show(); //mostrar original
            $('#sidebar > ul').slideDown();  //mostrar con efecto
            $('#sidebar').css({
                'margin-left': '0'
            });
			
			$("#sidebar").getNiceScroll().show();
            $("#container").removeClass("sidebar-closed");
			
        }
    });

// custom scrollbar
	//$("#sidebar").niceScroll({styler:"fb",cursorcolor:"#5bc0de", cursorwidth: '6', cursorborderradius: '10px', background: '#404040', spacebarenabled:false, cursorborder: ''});

// widget tools

    jQuery('.panel .tools .fa-chevron-down').click(function () {
        var el = jQuery(this).parents(".panel").children(".panel-body");
        if (jQuery(this).hasClass("fa-chevron-down")) {
            jQuery(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.panel .tools .fa-times').click(function () {
        jQuery(this).parents(".panel").parent().remove();
    });


//    tool tips

    $('.tooltips').tooltip();
	

//    popovers

    $('.popovers').popover();



// custom bar chart

    if ($(".custom-bar-chart")) {
        $(".bar").each(function () {
            var i = $(this).find(".value").html();
            $(this).find(".value").html("");
            $(this).find(".value").animate({
                height: i
            }, 2000)
        })
    }
	

	
}();