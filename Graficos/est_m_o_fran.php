
<?php
session_start();
require_once "metodosGraficos.php";

require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('EST_ORD')))
{
include '../include/openflashchart/php-ofc-library/open-flash-chart.php';
$tipoGrafico=$_GET['tipoGrafico'];
$anio=$_GET['inicio_a'];

$id_det_orden=$_GET['id_det_orden'];
$id_tipo_orden=$_GET['id_tipo_orden'];

if($id_det_orden==""){
	$id_det_orden='DEO00010';
}

if($anio==""){
	$anio=date("Y");
}

if($id_det_orden=="TODOS"){
	$acceso->objeto->ejecutarSql("SELECT nombre_tipo_orden FROM tipo_orden where id_tipo_orden='$id_tipo_orden'");
	$row=row($acceso);
	$nombre_det_orden = trim($row["nombre_tipo_orden"]);
	//echo ":SELECT nombre_tipo_orden FROM zona where id_tipo_orden='$id_tipo_orden':$nombre_det_orden:";
}
else{
	$acceso->objeto->ejecutarSql("SELECT nombre_det_orden,id_tipo_orden FROM detalle_orden where id_det_orden='$id_det_orden'");
	$row=row($acceso);
	$nombre_det_orden = trim($row["nombre_det_orden"]);
	$id_tipo_orden = trim($row["id_tipo_orden"]);

	$acceso->objeto->ejecutarSql("SELECT nombre_tipo_orden FROM tipo_orden where id_tipo_orden='$id_tipo_orden'");
	$row=row($acceso);
	$nombre_tipo_orden = trim($row["nombre_tipo_orden"]);
}


	
		$total_ing = 0;
		$total_deu = 0;
		
		$year = array();
		$data = array();
		$data2 = array();
		$data_pie = array();
		$data_pie1 = array();
		$rango = array();
		$resumen="";
		$k=0;
		
		
	
		$total_i = 0;
		$total_d = 0;
		$num_k=0;
		$meses=ver_meses($acceso,$anio);
		$mes_ini=$meses[0];
		$mes_fin=$meses[1];
		
		for($i=$mes_ini;$i<=$mes_fin;$i++){
			$ult_dia_mes=date("t",mktime( 0, 0, 0, $i, 1, $anio ));
			
			$fec_ini="$anio-$i-01";
			$fec_fin="$anio-$i-$ult_dia_mes";
			
			if($id_det_orden=='TODOS'){
				$corte=verCant($acceso,"select count(*)  as total from ordenes_tecnicos,detalle_orden where ordenes_tecnicos.id_det_orden=detalle_orden.id_det_orden and detalle_orden.id_tipo_orden='$id_tipo_orden' and fecha_orden between '$fec_ini' and '$fec_fin'");
			}
			else{
				$corte=verCant($acceso,"select count(*)  as total from ordenes_tecnicos where id_det_orden='$id_det_orden' and fecha_orden between '$fec_ini' and '$fec_fin'");
			}
			$total_ing += $corte;
			
			$year[$k] = "$i";
			$data[$k] = $corte;
			$k++;
			$num_k++;
		}
		

	$num_k=count($data);
	
		for($i=0;$i<count($data);$i++){
			
			$total=$data[$i];
			@$porc=($total*100)/$total_ing;
			$porcentaje=number_format($porc, 2, ',','.');
			$data_pie[$i] = new pie_value($total, "$year[$i] ($porcentaje%)");
		
			$mes_l=$year[$i];
			$resumen.='<tr><td width="180px" class="estilocabe"> '.$mes_letra[$mes_l].' '.$anio.'</td><td width="40px" class="estilocabe"  align="center">'.$porcentaje.'%</td<td width="120px" align="right" class="estilocabe">'.number_format($total, 0, ',', '.').'</td></tr>';
		}
		
		$total_ingreso=number_format($total_ing, 0, ',', '.');

$rango=rango_doble($data,$data2);



$title = new title("CANTIDAD DE $nombre_det_orden");
$title->set_style( "{font-size: 15px; color: #A2ACBA; text-align: center;font-weight: bold;}" );

$chart = new open_flash_chart();
$chart->set_title( $title );


/////////////////////////////////DATO VISUAL////////////////////////////////
$tags = new ofc_tags();
$tags->font("Verdana", 10);
$tags->colour("#000000");
$tags->align_x_center();

$tags->text('#y#');

$x=0;
foreach($data as $v)
{
    $tags->append_tag(new ofc_tag($x, $v));
    $x++;
}
$chart->add_element( $tags );

//////////////////////////////////////BARRA///////////////////////////////
if($tipoGrafico=="BARRA" || $tipoGrafico==""){
$bar = new bar_cylinder_outline();
$bar->key('ACTIVOS', 12);
$bar->set_values( $data );
$bar->set_on_show(new bar_on_show('grow-up', 0.3, 0));
$chart->add_element( $bar );


$bar2 = new bar_cylinder_outline();
$bar2->colour( '#5E0722' );
$bar2->key('CORTADOS', 12);
$bar2->set_values( $data2 );
$bar2->set_on_show(new bar_on_show('grow-up', 0.1, 0.1));
//$chart->add_element( $bar2 );

}
else if($tipoGrafico=="LINEA")
{
//////////////////////////////////////LINEA///////////////////////////////

$d = new solid_dot();
$d->size(3)->halo_size(1)->colour('#2929B5');
$line = new line();
$line->set_key( 'ACTIVOS', 12 );
$line->set_default_dot_style($d);
$line->set_values( $data );
$line->set_width( 2 );
$line->set_colour( '#2929B5' );
$chart->add_element( $line );

$d = new solid_dot();
$d->size(3)->halo_size(1)->colour('#5E0722');
$line = new line();
$line->set_key( 'CORTADOS', 12 );
$line->set_default_dot_style($d);
$line->set_values( $data2 );
$line->set_width( 2 );
$line->set_colour( '#5E0722' );
//$chart->add_element( $line );

}
else if($tipoGrafico=="AREA")
{
///////////////////////////////////////AREA//////////////////////////////
$d = new dot();
$d->colour('#9C0E57')->size(3)->halo_size(3);

$area = new area();
$area->set_key( 'ACTIVOS', 12 );
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
$area1->set_key( 'CORTADOS', 12 );
$area1->set_width( 2 );
$area1->set_default_dot_style($d1);
$area1->set_colour( '#A8686F' );
$area1->set_fill_colour( '#D8686F' );
$area1->set_fill_alpha( 0.7 );
$area1->on_show(new line_on_show('pop-up', 0.5, 0.1));
$area1->set_values( $data2 );

//$chart->add_element( $area1 );
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
$x->set_tick_height(25);
$x->set_grid_colour( '#D7E4A3' );
$x->set_labels($x_labels);
$chart->set_x_axis($x);


$y = new y_axis();
$y->set_range($rango[0], $rango[1], 0);
$y->set_label_text( "   #val# " );
$chart->set_y_axis($y);
$chart->set_number_format(2, false, false, false );

$data_1 = $chart->toPrettyString();

//////////////////////////////////////TORTA///////////////////////////////
$title = new title("$nombre_det_orden EN PORCENTAJE");
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
$data_4 = $chart_1->toPrettyString();


@$act=$total_ing/$num_k;
$porcentaje_a=number_format($act, 0, ',','.');
?>

<html>
<head>

		<!--AplicaTem-->
			<link rel="stylesheet" type="text/css" href="../estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="../estilos/css.css">
			<script language="JavaScript" type="text/javascript" src="ajaxGrafico.js"></script>
		<!--Fin AplicaTem-->
			
<script type="text/javascript" src="../include/openflashchart/js/json/json2.js"></script>
<script type="text/javascript" src="../include/openflashchart/js/swfobject.js"></script>
<script type="text/javascript">
swfobject.embedSWF(
  "../include/openflashchart/open-flash-chart.swf", "div_chart_1",
  "760", "350", "9.0.0", "expressInstall.swf",
  {"get-data":"get_data_1"} );
 

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


function get_data_4()
{
	return JSON.stringify(data_4);
}
 
var data_1 = <?php echo $data_1 ?>;

var data_4 = <?php echo $data_4 ?>;
function chart(name) {
	this.name = name;
	this.image_saved = function(id) {
	//	alert('saved:'+this.name+', id:'+id );
	};
}

var div_chart_1 = new chart('chart 1');

var div_chart_4 = new chart('chart 4');

function post_image(debug)
{
	url = "../include/openflashchart/php-ofc-library/ofc_upload_image.php?name=grafico1.png";
	var ofc = findSWF("div_chart_1");
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
		location.href="est_m_o_fran.php?&tipoGrafico="+document.f1.tipoGrafico.value+"&inicio_a="+document.f1.anio_i.value+"&id_det_orden="+document.f1.id_det_orden.value+"&id_tipo_orden="+document.f1.id_tipo_orden.value+"&";
}

function imprimirGrafico(){
	post_image(false);
		location.href="est_m_o_fran_impreso.php?&tipoGrafico="+document.f1.tipoGrafico.value+"&inicio_a="+document.f1.anio_i.value+"&id_det_orden="+document.f1.id_det_orden.value+"&id_tipo_orden="+document.f1.id_tipo_orden.value+"&";
}
</script>



</head>
<body>


<form name="f1" >
<table border="0" width="760px" align="center"> 
	<tr>
		<td colspan="2" ALIGN="CENTER">
			<div class="cabe">ESTADISTICAS MENSUALES DE <?php echo strtoupper(utf8_decode($nombre_det_orden));?> POR FRANQUICIAS</div>
		</td>
	</tr>
	<tr>
			<td colspan="2" ALIGN="CENTER" class="estilocabeN">
				<table border="0" width="760px" align="center" cellspacing="2" cellpadding="2"> 
					<tr>
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
						<td class="estilocabeN">
							A&ntilde;o
						</td>
						<td class="estilocabeN" colspan="3">
							<select name="anio_i" id="anio_i" onchange="llamarGrafico()" style="width: 80px;">
								<?php echo verAnios($acceso);?>
							</select>
						</td>
						<td class="estilocabeN" rowspan="2">
							<input onClick="llamarGrafico()" value="Buscar" type="BUTTON"> 
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
						<td>
							<span class="estilocabeN">Tipo de Orden
							</span>
						</td>
						<td>
							<select name="id_tipo_orden" id="id_tipo_orden" onchange="cargarDOE()" style="width: 146px;">
								<?php echo utf8_decode(verTipoOrdenEst($acceso));?>
							</select>
						</td>
						<td>
							<span class="estilocabeN">Detalle Orden</span>
						</td>
						<td>
							<select name="id_det_orden" id="id_det_orden" onchange="llamarGrafico()" style="width: 146px;">
								<?php echo utf8_decode(verDetalleOrdenEst($acceso));?>
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
		<td  ALIGN="CENTER" valign="top" colspan="2">
		<table border="1" width="650px" align="center" cellpadding="4" cellspacing="0"> 
			<tr>
				<td colspan="5" ALIGN="CENTER">
					<span class="estilocabeN">RESUMEN DE ORDENES DE SERVICIOS
					</span>
				</td>
			</tr>
			<tr><td width="150px" class="estilocabeN">
					Descripci&oacute;n
				</td>
				<td width="200px" class="estilocabeN"  align="center">
					<?php echo strtoupper(utf8_decode($nombre_det_orden));?> (%).
					
				</td>
				
				<td width="200px" align="right" class="estilocabeN">
					<?php echo strtoupper(utf8_decode($nombre_det_orden));?> (CANT)
				</td>
				
			</tr>
			<?php echo $resumen;?>
			<tr><td width="150px" class="estilocabeN">
					PROMEDIO
				</td>
				
				
				<td width="100px" align="right" class="estilocabeN" colspan="2">
					<?php echo $porcentaje_a;?>
				</td>
				
			</tr>
			<tr><td width="150px" class="estilocabeN">
					TOTAL
				</td>
				
				<td width="100px" align="right" class="estilocabeN" colspan="2">
					<?php echo $total_ingreso;?>
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
	document.f1.id_tipo_orden.value='<?php echo $id_tipo_orden;?>';
	document.f1.id_det_orden.value='<?php echo $id_det_orden;?>';
	document.f1.anio_i.value='<?php echo $anio;?>';
	//document.f1.anio_f.value='<?php echo $fin_a;?>';
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