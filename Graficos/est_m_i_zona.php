
<?php
session_start();
require_once "metodosGraficos.php";

require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('EST_ING')))
{

include '../include/openflashchart/php-ofc-library/open-flash-chart.php' ;
$tipoGrafico=$_GET['tipoGrafico'];
$anio=$_GET['inicio_a'];
$id_zona=$_GET['id_zona'];
if($id_zona==""){
	$id_zona='ZON00001';
}

if($anio==""){
	$anio=date("Y");
}

$meses=ver_meses($acceso,$anio);
		$mes_ini=$meses[0];
		$mes_fin=$meses[1];

$fec_ini="$anio-$mes_ini-01";
$fec_fin="$anio-$mes_fin-31";

$total_ing = 0;
$acceso->objeto->ejecutarSql("SELECT sum(monto_pago) as monto_pago FROM pagos ,contrato, calle, sector where fecha_pago between '$fec_ini' and '$fec_fin' and sector.id_zona='$id_zona' and pagos.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
if($row=row($acceso))
	$total_ing += trim($row["monto_pago"])+0;

$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro) as deuda FROM contrato_servicio_deuda,contrato, calle, sector where fecha_inst between '$fec_ini' and '$fec_fin' and status_con_ser='DEUDA' and sector.id_zona='$id_zona' and contrato_servicio_deuda.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
$row=row($acceso);
$total_deu = trim($row["deuda"])+0;


	
//echo "<br>$total_ing:$total_deu:";	
$year = array();
$data = array();
$data2 = array();
$data_pie = array();
$data_pie1 = array();
$rango = array();
//$total_ing=0;
$resumen="";
$k=0;
$meses=ver_meses($acceso,$anio);
		$mes_ini=$meses[0];
		$mes_fin=$meses[1];
		
for($i=$mes_ini;$i<=$mes_fin;$i++){
			$ult_dia_mes=date("t",mktime( 0, 0, 0, $i, 1, $anio ));
			
			$fec_ini="$anio-$i-01";
			$fec_fin="$anio-$i-$ult_dia_mes";
	
	$total = 0;
	$acceso->objeto->ejecutarSql("SELECT sum(monto_pago) as monto_pago FROM pagos ,contrato, calle, sector where fecha_pago between '$fec_ini' and '$fec_fin' and sector.id_zona='$id_zona' and status_pago='PAGADO' and pagos.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
	if($row=row($acceso))
		$total += trim($row["monto_pago"])+0;
	
	$year[$k] = $dias_num[$i];
	$data[$k] = $total;
	@$porc=($total*100)/$total_ing;
	$porcentaje=number_format($porc, 2, ',','.');
	$data_pie[$k] = new pie_value($total, "$dias_num[$i] ($porcentaje%)");
	
	$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro) as deuda FROM contrato_servicio_deuda,contrato, calle, sector where fecha_inst between '$fec_ini' and '$fec_fin' and status_con_ser='DEUDA' and sector.id_zona='$id_zona' and contrato_servicio_deuda.id_contrato=contrato.id_contrato and contrato.id_calle = calle.id_calle and calle.id_sector = sector.id_sector");
	$row=row($acceso);
	$deuda = trim($row["deuda"])+0;
	
	$data2[$k]=$deuda;
	@$porc=($deuda*100)/$total_deu;
	$porcentaje1=number_format($porc, 2, ',','.');
	$data_pie1[$k] = new pie_value($deuda, "$dias_num[$i] ($porcentaje1%)");
	
	$k++;
	
	$resumen.='<tr><td width="180px" class="estilocabe">'.$mes_letra[$i].' '.$anio.'</td><td width="40px" class="estilocabe"  align="center">'.$porcentaje.'%</td<td width="120px" align="right" class="estilocabe">'.number_format($total+0, 2, ',', '.').'</td><td width="40px" class="estilocabe" align="center">'.$porcentaje1.'%</td<td width="120px" align="right" class="estilocabe">'.number_format($deuda+0, 2, ',', '.').'</td></tr>';
}
$num_k=count($data);

$total_ingreso=number_format($total_ing+0, 2, ',', '.');
$total_deuda=number_format($total_deu+0, 2, ',', '.');
$rango=rango_doble($data,$data2);



$title = new title("INGRESOS Y DEUDAS EN BOLIVARES");
$title->set_style( "{font-size: 15px; color: #A2ACBA; text-align: center;font-weight: bold;}" );

$chart = new open_flash_chart();
$chart->set_title( $title );

$tags = new ofc_tags();
$tags->font("Verdana", 12);
$tags->colour("#000000");
$tags->align_x_left();
$tags->align_y_center();
$tags->text('#y#');

$x=0;
foreach($data as $v)
{
    $tags->append_tag(new ofc_tag($x, $v));
    $x++;
}
$chart->add_element( $tags );

$tags1 = new ofc_tags();
$tags1->font("Verdana", 12);
$tags1->colour("#000000");
$tags1->align_x_right();
$tags1->align_y_center();
$tags1->text('#y#');

$x=0;
foreach($data2 as $v)
{
    $tags1->append_tag(new ofc_tag($x, $v));
    $x++;
}
$chart->add_element( $tags1 );

//////////////////////////////////////BARRA///////////////////////////////
if($tipoGrafico=="BARRA" || $tipoGrafico==""){
$bar = new bar_cylinder_outline();
$bar->key('INGRESOS', 12);
$bar->set_values( $data );
$bar->set_on_show(new bar_on_show('grow-up', 0.3, 0));
$chart->add_element( $bar );


$bar2 = new bar_cylinder_outline();
$bar2->colour( '#5E0722' );
$bar2->key('DEUDAS', 12);
$bar2->set_values( $data2 );
$bar2->set_on_show(new bar_on_show('grow-up', 0.1, 0.1));
$chart->add_element( $bar2 );

}
else if($tipoGrafico=="LINEA")
{
//////////////////////////////////////LINEA///////////////////////////////

$d = new solid_dot();
$d->size(3)->halo_size(1)->colour('#2929B5');
$line = new line();
$line->set_key( 'INGRESOS', 12 );
$line->set_default_dot_style($d);
$line->set_values( $data );
$line->set_width( 2 );
$line->set_colour( '#2929B5' );
$chart->add_element( $line );

$d = new solid_dot();
$d->size(3)->halo_size(1)->colour('#5E0722');
$line = new line();
$line->set_key( 'DEUDAS', 12 );
$line->set_default_dot_style($d);
$line->set_values( $data2 );
$line->set_width( 2 );
$line->set_colour( '#5E0722' );
$chart->add_element( $line );

}
else if($tipoGrafico=="AREA")
{
///////////////////////////////////////AREA//////////////////////////////
$d = new dot();
$d->colour('#9C0E57')->size(3)->halo_size(3);

$area = new area();
$area->set_key( 'INGRESOS', 12 );
$area->set_width( 2 );
$area->set_default_dot_style($d);
$area->set_colour( '#7979B4' );
$area->set_fill_colour( '#7979B4' );
$area->set_fill_alpha( 0.7 );
$area->on_show(new line_on_show('pop-up', 0.5, 0));
$area->set_values( $data );

$chart->add_element( $area );


$d1 = new dot();
$d1->colour('#9C0E57')->size(3)->halo_size(3);
$area1 = new area();
$area1->set_key( 'DUEDAS', 12 );
$area1->set_width( 2 );
$area1->set_default_dot_style($d1);
$area1->set_colour( '#A8686F' );
$area1->set_fill_colour( '#D8686F' );
$area1->set_fill_alpha( 0.7 );
$area1->on_show(new line_on_show('pop-up', 0.5, 0.1));
$area1->set_values( $data2 );

$chart->add_element( $area1 );
}
////////////////////////////////////////////////////////////////////////////////
//$year = array('2009','2010','2011');
$x_labels = new x_axis_labels();
$x_labels->set_steps(1);
$x_labels->set_size(14);
$x_labels->set_colour( '#4A5A6D' );
$x_labels->set_labels( $year );

$x = new x_axis();
$x->set_colour( '#A2ACBA');
$x->set_tick_height(15);
$x->set_grid_colour( '#D7E4A3' );
$x->set_labels($x_labels);
$chart->set_x_axis($x);


$y = new y_axis();
$y->set_range($rango[0], $rango[1], 0);
$y->set_label_text( "   #val# Bs" );
$chart->set_y_axis($y);
$chart->set_number_format(2, false, false, false );

$data_1 = $chart->toPrettyString();

//////////////////////////////////////TORTA///////////////////////////////
$title = new title("INGRESOS EN PORCENTAJE");
$title->set_style( "{font-size: 15px; color: #A2ACBA; text-align: center;font-weight: bold;}" );

$pie = new pie();
$pie->set_alpha(0.6);
$pie->set_start_angle( 35 );
$pie->add_animation( new pie_fade() );
$pie->set_tooltip( '#val# de #total#<br>#percent# de 100%' );
$pie->set_colours( array('#2929B5','#BF3B69','#785650','#79CD6F','#B28912','#356AA0') );
//$pie->set_values( array(2,3,4,new pie_value(6.5, "hello (6.5)")) );
$pie->set_values($data_pie);
$chart_1 = new open_flash_chart();
$chart_1->set_title( $title );
$chart_1->add_element( $pie );
$chart_1->x_axis = null;
$data_2 = $chart_1->toPrettyString();

//////////////////////////////////////TORTA///////////////////////////////

$title = new title("DEUDAS EN PORCENTAJE");
$title->set_style( "{font-size: 15px; color: #A2ACBA; text-align: center;font-weight: bold;}" );

$pie = new pie();
$pie->set_alpha(0.6);
$pie->set_start_angle( 35 );
$pie->add_animation( new pie_fade() );
$pie->set_tooltip( '#val# de #total#<br>#percent# de 100%' );
$pie->set_colours( array('#2929B5','#BF3B69','#785650','#79CD6F','#B28912','#356AA0') );
//$pie->set_values( array(2,3,4,new pie_value(6.5, "hello (6.5)")) );
$pie->set_values($data_pie1);
$chart_1 = new open_flash_chart();
$chart_1->set_title( $title );
$chart_1->add_element( $pie );
$chart_1->x_axis = null;
$data_3 = $chart_1->toPrettyString();

//////////////////////////////////////PROMEDIO TORTA///////////////////////////////

@$act=$total_ing/$num_k;
@$cor=$total_deu/$num_k;
//echo "<br>$total_ing:$act:::$total_deu:$cor:$num_k";
$total_c=$act+$cor;
$data_prom=array();

@$porc=($act*100)/$total_c;
$porcentaje_a=number_format($porc, 2, ',','.');
$act_c=number_format($act, 2, ',','.');
$data_prom[0] = new pie_value($act, "INGRESOS $act_c ($porcentaje_a%)");

@$porc=($cor*100)/$total_c;
$porcentaje_c=number_format($porc, 2, ',','.');
$cor_c=number_format($cor, 2, ',','.');
$data_prom[1] = new pie_value($cor, "DEUDAS $cor_c ($porcentaje_c%)");

$title = new title("PROMEDIO DE INGRESOS Y EGRESOS");
$title->set_style( "{font-size: 15px; color: #A2ACBA; text-align: center;font-weight: bold;}" );

$pie = new pie();
$pie->set_alpha(0.6);
$pie->set_start_angle( 35 );
$pie->add_animation( new pie_fade() );
$pie->set_tooltip( '#val# de #total#<br>#percent# de 100%' );
$pie->set_colours( array('#2929B5','#BF3B69','#785650','#79CD6F','#B28912','#356AA0') );
//$pie->set_values( array(2,3,4,new pie_value(6.5, "hello (6.5)")) );
$pie->set_values($data_prom);
$chart_1 = new open_flash_chart();
$chart_1->set_title( $title );
$chart_1->add_element( $pie );
$chart_1->x_axis = null;
$data_4 = $chart_1->toPrettyString();
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
  "375", "250", "9.0.0", "expressInstall.swf",
  {"get-data":"get_data_2"} );
  
swfobject.embedSWF(
  "../include/openflashchart/open-flash-chart.swf", "div_chart_3",
  "380", "250", "9.0.0", "expressInstall.swf",
  {"get-data":"get_data_3"} );
  
 swfobject.embedSWF(
  "../include/openflashchart/open-flash-chart.swf", "div_chart_4",
  "760", "250", "9.0.0", "expressInstall.swf",
  {"get-data":"get_data_4"} );
 
 
function ofc_ready()
{
}
 
 
function get_data_1()
{
	return JSON.stringify(data_1);
}
 
function get_data_2()
{
	return JSON.stringify(data_2);
}

function get_data_3()
{
	return JSON.stringify(data_3);
}
function get_data_4()
{
	return JSON.stringify(data_4);
}
 
var data_1 = <?php echo $data_1 ?>;
var data_2 = <?php echo $data_2 ?>;
var data_3 = <?php echo $data_3 ?>;
var data_4 = <?php echo $data_4 ?>;
function chart(name) {
	this.name = name;
	this.image_saved = function(id) {
	//	alert('saved:'+this.name+', id:'+id );
	};
}

var div_chart_1 = new chart('chart 1');
var div_chart_2 = new chart('chart 2');
var div_chart_3 = new chart('chart 3');
var div_chart_4 = new chart('chart 4');

function post_image(debug)
{
	url = "../include/openflashchart/php-ofc-library/ofc_upload_image.php?name=grafico1.png";
	var ofc = findSWF("div_chart_1");
 	x = ofc.post_image( url, 'done', debug );
	
	url = "../include/openflashchart/php-ofc-library/ofc_upload_image.php?name=grafico2.png";
	var ofc = findSWF("div_chart_2");
 	x = ofc.post_image( url, 'done', debug );
	
	url = "../include/openflashchart/php-ofc-library/ofc_upload_image.php?name=grafico3.png";
	var ofc = findSWF("div_chart_3");
 	x = ofc.post_image( url, 'done', debug );
	
	url = "../include/openflashchart/php-ofc-library/ofc_upload_image.php?name=grafico4.png";
	var ofc = findSWF("div_chart_4");
 	x = ofc.post_image( url, 'done', debug );
}

function findSWF(movieName) {
	if (navigator.appName.indexOf("Microsoft")!= -1) {
		return window[movieName];
	} else {
		return document[movieName];
	}
}

function llamarGrafico(){
	location.href="est_m_i_zona.php?&tipoGrafico="+document.f1.tipoGrafico.value+"&id_zona="+document.f1.id_zona.value+"&inicio_a="+document.f1.anio_i.value+"&";
	
}

function imprimirGrafico(){
	post_image(false);
	location.href="est_m_i_zona_impreso.php?&tipoGrafico="+document.f1.tipoGrafico.value+"&id_zona="+document.f1.id_zona.value+"&inicio_a="+document.f1.anio_i.value+"&";
	
}
</script>



</head>
<body>


<form name="f1" >
<table border="0" width="760px" align="center"> 
	<tr>
		<td colspan="2" ALIGN="CENTER">
			<div class="cabe">ESTADISTICAS MENSUALES DE INGRESOS Y DEUDAS POR ZONAS</div>
		</td>
	</tr>
	<tr>
			<td colspan="2" ALIGN="CENTER" class="estilocabeN">
				<table border="0" width="760px" align="center" cellspacing="2" cellpadding="2"> 
					
					<tr>
						<td class="estilocabeN">
							A&ntilde;o
						</td>
						<td class="estilocabeN">
							<select name="anio_i" id="anio_i" onchange="llamarGrafico()" style="width: 80px;">
								<?php echo verAnios($acceso);?>
							</select>
						</td>
						
						<td class="estilocabeN">
							Tipo de Grafico
						</td>
						<td class="estilocabeN">
							<select name="tipoGrafico" id="tipoGrafico" onchange="llamarGrafico()" style="width: 150px;">
								<option value="BARRA">Grafico de Barra</option>
								<option value="LINEA">Grafico de Linea</option>
								<option value="AREA">Grafico de Area</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="estilocabeN">
							Franquicia
						</td>
						<td class="estilocabeN">
							<select name="id_franq" id="id_franq" onchange="" style="width: 150px;">
								<?php echo verFranquicia($acceso);?>
							</select>
						</td>
						<td class="estilocabeN">
							Zona
						</td>
						<td>
							<select name="id_zona" id="id_zona" onchange="llamarGrafico()" style="width: 150px;">
								<?php echo utf8_decode(verZonaEst($acceso));?>
							</select>
						</td>
						
					</tr>
					
				</table>
				
				
			</td>
		</tr>
	<tr>
		<td colspan="2" ALIGN="CENTER">
			<div id="div_chart_1"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2" ALIGN="CENTER">
			<div id="div_chart_4"></div>
		</td>
	</tr>
	<tr>
		<td  ALIGN="CENTER">
			<div id="div_chart_2"></div>
		</td>
		
		<td  ALIGN="CENTER">
			<div id="div_chart_3"></div>
		</td>
				
		</td>
		
	</tr>
	<tr>
		<td  ALIGN="CENTER" valign="top" colspan="2">
		<table border="1" width="600px" align="center" cellpadding="4" cellspacing="0"> 
			<tr>
				<td colspan="5" ALIGN="CENTER">
					<span class="estilocabeN">RESUMEN DE INGRESOS Y DEUDAS
					</span>
				</td>
			</tr>
			<tr><td width="150px" class="estilocabeN">
					Descripci&oacute;n
				</td>
				<td width="100px" class="estilocabeN"  align="center">
					Ingreso (%).
				</td>
				
				<td width="100px" align="right" class="estilocabeN">
					Ingresos (Bs)
				</td>
				<td width="100px" class="estilocabeN" align="center">
					Deuda (%).
				</td>
				
				<td width="100px" align="right" class="estilocabeN">
					Deuda (Bs)
				</td>
			</tr>
			<?php echo $resumen;?>
			<tr>
				<td width="150px" colspan="1">
					<span class="estilocabeN">TOTAL
					</span>
				</td>
				
				<td width="150px" align="right" colspan="2">
					<span class="estilocabeN"> <?php echo $total_ingreso;?>
					</span>
				</td>
				<td width="150px" align="right" colspan="2">
					<span class="estilocabeN"> <?php echo $total_deuda;?>
					</span>
				</td>
			</tr>
			<tr><td width="150px" class="estilocabeN">
					PROMEDIO
				</td>
				<td width="100px" class="estilocabeN"  align="center">
					<?php echo $porcentaje_a;?>%
				</td>
				
				<td width="100px" align="right" class="estilocabeN">
					<?php echo $act_c;?>
				</td>
				<td width="100px" class="estilocabeN" align="center">
					<?php echo $porcentaje_c?>%
				</td>
				
				<td width="100px" align="right" class="estilocabeN">
					<?php echo $cor_c;?>
				</td>
			</tr>
			
		</table>
			<BR>
			<input onClick="imprimirGrafico()" value="IMPRIMIR REPORTE" type="BUTTON"> 
		</td>
		
	</tr>
</table>
</form>
<script>
	document.f1.tipoGrafico.value='<?php echo $tipoGrafico;?>'
	document.f1.id_zona.value='<?php echo $id_zona;?>';
	document.f1.anio_i.value='<?php echo $anio;?>';
</script>
</body>
</html>

<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="../imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="parent.conexionPHP(\'formulario.php\',\'Sesion\');">&nbsp;
				</div>
		';
	}
?>