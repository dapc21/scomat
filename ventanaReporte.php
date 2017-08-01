<body bgcolor="#ffffff">
<?php
$clase=$_GET['clase'];
include "Formulario/$clase.php";
		
?>
</body>
<!--AplicaTem-->
			<link rel="stylesheet" type="text/css" href="estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="estilos/css.css">
			<script language="JavaScript" type="text/javascript" src="javascript/validacion.js"> </script>
			<script language="JavaScript" type="text/javascript" src="javascript/ajax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/validacionAjax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/controlador.js"></script>  
			<script language="JavaScript" type="text/javascript" src="Programador/script.js"></script>
		<!--Fin AplicaTem-->
		<!--datepicker  -->
			<link type="text/css" href="include/datepicker/themes/base/ui.all.css" rel="stylesheet" />
			<script type="text/javascript" src="include/datepicker/jquery-1.3.2.js"></script>
			<script type="text/javascript" src="include/datepicker/ui/ui.core.js"></script>
			<script type="text/javascript" src="include/datepicker/ui/ui.datepicker.js"></script>
			<link type="text/css" href="include/datepicker/demos.css" rel="stylesheet" />
		<!--fin datepicker -->
		<!--DataGrid-->
			<link rel="stylesheet" type="text/css" href="include/eyedatagrid/table.css" >
			<script type="text/javascript" src="include/eyedatagrid/eyedatagrid.js"></script>
		<!-- fin DataGrid -->
		
		<!--Temas calendar-->
			<link rel="stylesheet" type="text/css" href="include/dhtmlx/commonCalendar/codebase/dhtmlxcalendar.css"></link>
			<link rel="stylesheet" type="text/css" href="include/dhtmlx/commonCalendar/codebase/skins/dhtmlxcalendar_dhx_skyblue.css"></link>
			<script src="include/dhtmlx/commonCalendar/codebase/dhtmlxcalendar.js"></script>
		<!--calendar-->
		
		<APPLET id="miapplet" ARCHIVE ="include/JavaPrint/applet.jar" code="applet/PrintText.class" width=1 height=1></APPLET>
<?php

switch($clase)
{
	case Rep_totalclientes:
?>
		<script type="text/javascript">
			//$(function() {$('#desde').datepicker({			changeMonth: true,			changeYear: true		});	});
			//$(function() {$('#hasta').datepicker({			changeMonth: true,			changeYear: true		});	});
			myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		</script>
<?php
	break;
	case Rep_recuperados:
?>
		<script type="text/javascript">
			//$(function() {$('#desde').datepicker({			changeMonth: true,			changeYear: true		});	});
			//$(function() {$('#hasta').datepicker({			changeMonth: true,			changeYear: true		});	});
			myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		</script>
<?php
	break;
	case Rep_notas:
?>
		<script type="text/javascript">
			//$(function() {$('#desde').datepicker({			changeMonth: true,			changeYear: true		});	});
			//$(function() {$('#hasta').datepicker({			changeMonth: true,			changeYear: true		});	});
			myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		</script>
<?php
	break;
	case Rep_ORDENESTECNICOS:
?>
		<script type="text/javascript">
			//$(function() {$('#desde').datepicker({			changeMonth: true,			changeYear: true		});	});
			//$(function() {$('#hasta').datepicker({			changeMonth: true,			changeYear: true		});	});
			myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		</script>
<?php
	break;
	case Rep_libroventa:
?>
		<script type="text/javascript">
			//$(function() {$('#desde').datepicker({			changeMonth: true,			changeYear: true		});	});
			//$(function() {$('#hasta').datepicker({			changeMonth: true,			changeYear: true		});	});
			myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		</script>
<?php
	break;
	case Rep_libroventa1:
?>
		<script type="text/javascript">
			//$(function() {$('#desde').datepicker({			changeMonth: true,			changeYear: true		});	});
			//$(function() {$('#hasta').datepicker({			changeMonth: true,			changeYear: true		});	});
			myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		</script>
<?php
	break;
	case reimp_cierre_caja:
?>
		<script type="text/javascript">
		//	$(function() {$('#desde').datepicker({			changeMonth: true,			changeYear: true		});	});
		myCalendar = new dhtmlXCalendarObject(["desde"]);
		</script>
<?php
	break;
	case reimp_cierre_diario:
?>
		<script type="text/javascript">
			//$(function() {$('#desde').datepicker({			changeMonth: true,			changeYear: true		});	});
			myCalendar = new dhtmlXCalendarObject(["desde"]);
		</script>
<?php
	break;
	case reimp_cierre_diario1:
?>
		<script type="text/javascript">
//			$(function() {$('#desde').datepicker({			changeMonth: true,			changeYear: true		});	});
			myCalendar = new dhtmlXCalendarObject(["desde"]);
		</script>
<?php
	break;
}
?>