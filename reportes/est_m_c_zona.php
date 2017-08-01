
<?php
require_once "metodosGraficos.php";
include '../include/openflashchart/php-ofc-library/open-flash-chart.php' ;
$tipoGrafico=$_GET['tipoGrafico'];
$anio=$_GET['anio'];
if($anio==""){
	$anio=date("Y");
}
$fec_ini="$anio-01-01";
$fec_fin="$anio-12-31";
	
$total_ing = 0;
		$total_deu = 0;
		
		$year = array();
		$data = array();
		$data2 = array();
		$data_pie = array();
		$data_pie1 = array();
		$rango = array();
		//$total_ing=0;
		$resumen="";
		$k=0;
		
		for($i=1;$i<=3;$i++){
			if($i==2){
				$fec_ini="$anio-0$i-01";
				$fec_fin="$anio-0$i-28";
			}
			else{
				$fec_ini="$anio-0$i-01";
				$fec_fin="$anio-0$i-31";
			}
			
			$gen=verCant($acceso,"select count(DISTINCT id_contrato) as total from contrato_servicio where id_serv='SER00001' and fecha_inst = '$fec_ini'");
			$corte=verCant($acceso,"select count(DISTINCT id_contrato)  as total from contrato_servicio where id_serv='SER00002' and fecha_inst between '$fec_ini' and '$fec_fin'");
			$rec=verCant($acceso,"select count(DISTINCT id_contrato)  as total from ordenes_tecnicos where id_det_orden='DEO00003' and fecha_orden between '$fec_ini' and '$fec_fin'");
			$rec_mes=verCant($acceso,"select count(DISTINCT id_pago)  as total from vista_pago_ser where id_serv='SER00002' and fecha_inst between '$fec_ini' and '$fec_fin'");
			$inst=verCant($acceso,"select count(id_contrato)  as total from contrato where fecha_contrato > '$fec_fin'");
			$total=verCant($acceso,"select count(id_contrato)  as total from contrato");
			$activos=(($gen-$rec_mes)+$rec)-$corte;
			$cortados=($total-$inst)-$activos;
			
			$total_ing += $activos;
			$total_deu += $cortados;
			
			$year[$k] = "0$i/$anio";
			$data[$k] = $activos;
			$data2[$k]=$cortados;
			$k++;
		}

		for($i=0;$i<count($data);$i++){
			
			$total=$data[$i];
			$porc=($total*100)/$total_ing;
			$porcentaje=number_format($porc, 2, ',','.');
			$data_pie[$i] = new pie_value($total, "0$i/$anio ($porcentaje%)");
	
			
			
			$deuda = $data2[$i];
			$porc=($deuda*100)/$total_deu;
			$porcentaje1=number_format($porc, 2, ',','.');
			$data_pie1[$i] = new pie_value($deuda, "0$i/$anio ($porcentaje1%)");
			$mes_l=$i+1;
			$resumen.='<tr><td width="180px" class="estilocabe">'.$mes_letra[$mes_l].' '.$anio.'</td><td width="40px" class="estilocabe"  align="center">'.$porcentaje.'%</td<td width="120px" align="right" class="estilocabe">'.number_format($total+0, 2, ',', '.').'</td><td width="40px" class="estilocabe" align="center">'.$porcentaje1.'%</td<td width="120px" align="right" class="estilocabe">'.number_format($deuda+0, 2, ',', '.').'</td></tr>';
		}
		
		$total_ingreso=number_format($total_ing+0, 2, ',', '.');
		$total_deuda=number_format($total_deu+0, 2, ',', '.');
//$rango=rango($data);

$rango[0]=3000;
$rango[1]=8000;



$title = new title(_("cantidad de clientes activos y cortados"));
$title->set_style( "{font-size: 15px; color: #A2ACBA; text-align: center;font-weight: bold;}" );

$chart = new open_flash_chart();
$chart->set_title( $title );

//////////////////////////////////////BARRA///////////////////////////////
if($tipoGrafico=="BARRA" || $tipoGrafico==""){
$bar = new bar_cylinder_outline();
$bar->key(_('activo'), 12);
$bar->set_values( $data );
$bar->set_on_show(new bar_on_show('grow-up', 0.3, 0));
$chart->add_element( $bar );


$bar2 = new bar_cylinder_outline();
$bar2->colour( '#5E0722' );
$bar2->key(_('cortados'), 12);
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
$line->set_key( _('activos'), 12 );
$line->set_default_dot_style($d);
$line->set_values( $data );
$line->set_width( 2 );
$line->set_colour( '#2929B5' );
$chart->add_element( $line );

$d = new solid_dot();
$d->size(3)->halo_size(1)->colour('#5E0722');
$line = new line();
$line->set_key( _('cortados'), 12 );
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
$area->set_key( _('activo'), 12 );
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
$area1->set_key( _('cortados'), 12 );
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
$title = new title(_("clientes activos en porcentajes"));
$title->set_style( "{font-size: 15px; color: #A2ACBA; text-align: center;font-weight: bold;}" );

$pie = new pie();
$pie->set_alpha(0.6);
$pie->set_start_angle( 35 );
$pie->add_animation( new pie_fade() );
$pie->set_tooltip( '#val# de #total#<br>#percent# de 100%' );
$pie->set_colours( array('#2929B5','#BF3B69','#785650') );
//$pie->set_values( array(2,3,4,new pie_value(6.5, "hello (6.5)")) );
$pie->set_values($data_pie);
$chart_1 = new open_flash_chart();
$chart_1->set_title( $title );
$chart_1->add_element( $pie );
$chart_1->x_axis = null;
$data_2 = $chart_1->toPrettyString();

//////////////////////////////////////TORTA///////////////////////////////

$title = new title(_("clientes cortador en porcentajes"));
$title->set_style( "{font-size: 15px; color: #A2ACBA; text-align: center;font-weight: bold;}" );

$pie = new pie();
$pie->set_alpha(0.6);
$pie->set_start_angle( 35 );
$pie->add_animation( new pie_fade() );
$pie->set_tooltip( '#val# de #total#<br>#percent# de 100%' );
$pie->set_colours( array('#2929B5','#BF3B69','#785650') );
//$pie->set_values( array(2,3,4,new pie_value(6.5, "hello (6.5)")) );
$pie->set_values($data_pie1);
$chart_1 = new open_flash_chart();
$chart_1->set_title( $title );
$chart_1->add_element( $pie );
$chart_1->x_axis = null;
$data_3 = $chart_1->toPrettyString();



//////////////////////////////////////TORTA///////////////////////////////

$act=$total_ing/3;
$cor=$total_deu/3;
$total_c=$act+$cor;
$data_prom=array();

$porc=($act*100)/$total_c;
$porcentaje_a=number_format($porc, 2, ',','.');
$act_c=number_format($act, 0, ',','.');
$data_prom[0] = new pie_value($act, "._("activos")." $act_c ($porcentaje_a%)");

$porc=($cor*100)/$total_c;
$porcentaje_c=number_format($porc, 2, ',','.');
$cor_c=number_format($cor, 0, ',','.');
$data_prom[1] = new pie_value($cor, "._("cortados")." $cor_c ($porcentaje_c%)");

$title = new title(_("promedio de clientes activos y cortados"));
$title->set_style( "{font-size: 15px; color: #A2ACBA; text-align: center;font-weight: bold;}" );

$pie = new pie();
$pie->set_alpha(0.6);
$pie->set_start_angle( 35 );
$pie->add_animation( new pie_fade() );
$pie->set_tooltip( '#val# de #total#<br>#percent# de 100%' );
$pie->set_colours( array('#2929B5','#BF3B69','#785650') );
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
function llamarGraf_c_fran(){
	location.href="est_a_i_fran.php?&tipoGrafico="+document.f1.tipoGrafico.value+"&";
}
function llamarGraf_m_fran(){
	location.href="est_m_c_fran.php?&tipoGrafico="+document.f1.tipoGrafico.value+"&";
}
function imprimirGraf(){
	post_image(false);
	location.href="est_m_c_fran_impreso.php?&tipoGrafico="+document.f1.tipoGrafico.value+"&";
	
}
</script>



</head>
<body>


<form name="f1" >
<table border="0" width="760px" align="center"> 
	<tr>
		<td colspan="2" ALIGN="CENTER">
			<div class="cabe"><?php echo _("estadisticas mensuales de clientes activos y cortados  por franquicia");?></div>
		</td>
	</tr>
	<tr>
		<td colspan="2" ALIGN="CENTER" class="estilocabeN">
			<?php echo _("ano");?>
				<select name="anio" id="anio" onchange="llamarGraf_m_fran()" style="width: 150px;">
					<option value="2011">2011</option>
					
				</select>
			<?php echo _("tipo de grafico");?>
		
				<select name="tipoGrafico" id="tipoGrafico" onchange="llamarGraf_m_fran()" style="width: 150px;">
					<option value=""><?php echo _("seleccione....");?></option>
					<option value="BARRA"><?php echo _("grafico de barra");?></option>
					<option value="LINEA"><?php echo _("grafico de linea");?></option>
					<option value="AREA"><?php echo _("grafico de area");?></option>
				</select>
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
		<table border="1" width="650px" align="center" cellpadding="4" cellspacing="0"> 
			<tr>
				<td colspan="5" ALIGN="CENTER">
					<span class="estilocabeN"><?php echo _("resumen de clientes activos y cortados");?>
					</span>
				</td>
			</tr>
			<tr><td width="150px" class="estilocabeN">
					<?php echo _("descripcion");?>
				</td>
				<td width="100px" class="estilocabeN"  align="center">
					<?php echo _("activos")." (%).";?>
				</td>
				
				<td width="100px" align="right" class="estilocabeN">
					<?php echo _("activos")."(Cant) ";?>
				</td>
				<td width="120px" class="estilocabeN" align="center">
					<?php echo _("cortados")."(%). ";?>
				
				<td width="120px" align="right" class="estilocabeN">
					<?php echo _("cortados")."(Bs) ";?>
				</td>
			</tr>
			<?php echo $resumen;?>
			<tr><td width="150px" class="estilocabeN">
					<?php echo _("promedio");?>
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
			<input onClick="imprimirGraf()" value="<?php echo _("imprimir reporte");?>" type="BUTTON"> 
		</td>
		
	</tr>
	
</table>
</form>

</body>
</html>