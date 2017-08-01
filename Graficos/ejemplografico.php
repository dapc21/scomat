
<?php
require_once "metodosGraficos.php";
include '../include/openflashchart/php-ofc-library/open-flash-chart.php' ;

$acceso->objeto->ejecutarSql("SELECT fecha_pago FROM pagos where status_pago='PAGADO'  ORDER BY fecha_pago asc LIMIT 1 offset 0");
$row=row($acceso);
$fecha_inicio = trim($row["fecha_pago"]);
$valor=explode("-",$fecha_inicio);
$inicio=$valor[0];

$acceso->objeto->ejecutarSql("SELECT fecha_pago FROM pagos where status_pago='PAGADO'  ORDER BY fecha_pago desc LIMIT 1 offset 0");
$row=row($acceso);
$fecha_fin = trim($row["fecha_pago"]);
$valor=explode("-",$fecha_fin);
$fin=$valor[0];


$acceso->objeto->ejecutarSql("SELECT sum(monto_pago) as total FROM pagos where status_pago='PAGADO'");
$row=row($acceso);
$total_ing = trim($row["total"])+0;
	
$year = array();
$data = array();
$data_pie = array();
$rango = array();
//$total_ing=0;
$resumen="";
$k=0;
for($i=$inicio;$i<=$fin;$i++){
	$fec_ini="$i-01-01";
	$fec_fin="$i-12-31";
	
	$acceso->objeto->ejecutarSql("SELECT sum(monto_pago) as total FROM pagos where fecha_pago between '$fec_ini' and '$fec_fin' and status_pago='PAGADO'");
	$row=row($acceso);
	$total = trim($row["total"])+0;
	
	$year[$k] = "$i";
	$data[$k] = $total;
	$porc=($total*100)/$total_ing;
	$porcentaje=number_format($porc, 2, ',','.');
	$data_pie[$k] = new pie_value($total, "$i ($porcentaje%)");
	$k++;
	$resumen.='<tr><td width="180px" class="estilocabe">A&ntilde;o '.$i.'</td><td width="40px" class="estilocabeN">'.$porcentaje.'%</td<td width="120px" align="right" class="estilocabe">'.number_format($total+0, 2, ',', '.').'</td></tr>';
}
$total_ingreso=number_format($total_ing+0, 2, ',', '.');
$rango=rango($data);



$title = new title("EN BOLIVARES");
$title->set_style( "{font-size: 15px; color: #A2ACBA; text-align: center;font-weight: bold;}" );


$bar = new bar_cylinder_outline();
//$bar->colour( '#BF3B69');
$bar->key('INGRESOS', 12);
$bar->set_values( $data );
$bar->set_on_show(new bar_on_show('grow-up', 0.3, 0));

/*
$data2 = array(300000,500000);
$bar2 = new bar_cylinder_outline();
//$bar2->colour( '#5E0722' );
$bar2->key('Clentes Cortados', 12);
$bar2->set_values( $data2 );
*/

$chart = new open_flash_chart();
$chart->set_title( $title );
$chart->add_element( $bar );
//$chart->add_element( $bar2 );


//$year = array('2009','2010','2011');
$x_labels = new x_axis_labels();
$x_labels->set_steps(1);
$x_labels->set_size(14);
$x_labels->set_colour( '#4A5A6D' );
$x_labels->set_labels( $year );

$x = new x_axis();
$x->set_colour( '#A2ACBA');
$x->set_tick_height(50);
$x->set_grid_colour( '#D7E4A3' );
$x->set_labels($x_labels);
$chart->set_x_axis($x);


$y = new y_axis();
$y->set_range($rango[0], $rango[1], 0);
$y->set_label_text( "   #val# Bs" );
$chart->set_y_axis($y);
$chart->set_number_format(2, false, false, false );

$data_1 = $chart->toPrettyString();

$title = new title("EN PORCENTAJE");
$title->set_style( "{font-size: 15px; color: #A2ACBA; text-align: center;font-weight: bold;}" );

$pie = new pie();
$pie->set_alpha(0.6);
$pie->set_start_angle( 35 );
$pie->add_animation( new pie_fade() );
$pie->set_tooltip( '#val# de #total#<br>#percent# de 100%' );
$pie->set_colours( array('#2929B5','#BF3B69','#BDCEE5') );
//$pie->set_values( array(2,3,4,new pie_value(6.5, "hello (6.5)")) );
$pie->set_values($data_pie);

$chart_1 = new open_flash_chart();
$chart_1->set_title( $title );
$chart_1->add_element( $pie );


$chart_1->x_axis = null;


$data_2 = $chart_1->toPrettyString();
?>

<html>
<head>

		<!--AplicaTem-->
			<link rel="stylesheet" type="text/css" href="../estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="../estilos/css.css">
		<!--Fin AplicaTem-->
			
<script type="text/javascript" src="../include/openflashchart/js/json/json2.js"></script>
<script type="text/javascript" src="../include/openflashchart/js/swfobject.js"></script>
<script type="text/javascript">
swfobject.embedSWF(
  "../include/openflashchart/open-flash-chart.swf", "div_chart_1",
  "760", "350", "9.0.0", "expressInstall.swf",
  {"get-data":"get_data_1"} );
 
swfobject.embedSWF(
  "../include/openflashchart/open-flash-chart.swf", "div_chart_2",
  "440", "250", "9.0.0", "expressInstall.swf",
  {"get-data":"get_data_2"} );
 
 
function ofc_ready()
{
}
 
 
function get_data_1()
{
	return JSON.stringify(data_1);
}
 
function get_data_2()
{
	// alert( 'reading data 2' );
	// alert(JSON.stringify(data_2));
	return JSON.stringify(data_2);
}
 
var data_1 = <?php echo $data_1 ?>;
var data_2 = <?php echo $data_2 ?>;
function chart(name) {
	this.name = name;
	this.image_saved = function(id) {
	//	alert('saved:'+this.name+', id:'+id );
	};
}

var div_chart_1 = new chart('chart 1');
var div_chart_2 = new chart('chart 1');

function post_image(debug)
{
	url = "../include/openflashchart/php-ofc-library/ofc_upload_image.php?name=tmpkk.jpg";
	var ofc = findSWF("div_chart_1");
 	x = ofc.post_image( url, 'done', debug );
	
	url = "../include/openflashchart/php-ofc-library/ofc_upload_image.php?name=dddtmpkk.jpg";
	var ofc = findSWF("div_chart_2");
 	x = ofc.post_image( url, 'done', debug );
}

function findSWF(movieName) {
	if (navigator.appName.indexOf("Microsoft")!= -1) {
		return window[movieName];
	} else {
		return document[movieName];
	}
}
</script>



</head>
<body>



<table border="0" width="760px" align="center"> 
	<tr>
		<td colspan="2" ALIGN="CENTER">
			<div class="cabe">ESTADISTICAS ANUALES DE INGRESOS POR FRANQUICIAS</div>
		</td>
	</tr>
	<tr>
		<td colspan="2" ALIGN="CENTER">
			<div id="div_chart_1"></div>
		</td>
	</tr>
	<tr>
		<td  ALIGN="CENTER">
			<div id="div_chart_2"></div>
		</td>
		<td  ALIGN="CENTER" valign="top">

		<table border="1" width="300px" align="center" cellpadding="4" cellspacing="0"> 
			<tr>
				<td colspan="3" ALIGN="CENTER">
					<span class="estilocabeN">RESUMEN
					</span>
				</td>
			</tr>
			<tr><td width="150px" class="estilocabeN">
					Descripci&oacute;n
				</td>
				<td width="40px" class="estilocabeN">
					Porc.
				</td>
				
				<td width="110px" align="right" class="estilocabeN">
					Ingresos (Bs)
				</td>
			</tr>
			<?php echo $resumen;?>
			<tr>
				<td width="150px" colspan="2">
					<span class="estilocabeN">TOTAL
					</span>
				</td>
				
				<td width="150px" align="right" >
					<span class="estilocabeN"> <?php echo $total_ingreso;?>
					</span>
				</td>
			</tr>
			
		</table>
			<BR>
			<input onClick="post_image(false)" value="IMPRIMIR REPORTE" type="BUTTON"> 
		</td>
		
	</tr>


</body>
</html>