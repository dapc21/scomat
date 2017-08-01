
<?php
session_start();
require_once "metodosGraficos.php";

require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('EST_TEC')))
{
include '../include/openflashchart/php-ofc-library/open-flash-chart.php';
$tipoGrafico=$_GET['tipoGrafico'];
$anio=$_GET['inicio_a'];

$desde=$_GET['desde'];
$hasta=$_GET['hasta'];

$tipo=$_GET['id_tipo_orden'];
$cedula=$_GET['cedula'];

if($cedula==""){
	$cedula='TEC00001';
}

$acceso->objeto->ejecutarSql("SELECT *FROM vista_tecnico where id_persona='$cedula'");
if($row=row($acceso)){
	$id_persona=trim($row['id_persona']);
	$nombre=trim($row['apellido'])." ".trim($row['nombre']);
}


if($tipo==""){
	$tipo='TIPO';
}
if($desde==""){
	$desde=date("01/m/Y");
}
if($hasta==""){
	$ult_dia_mes=date("t",mktime( 0, 0, 0, date("m"), 1, date("Y") ));
	$hasta=date("$ult_dia_mes/m/Y");
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
		
		$fec_ini=formatfecha($desde);
		$fec_fin=formatfecha($hasta);
		
		if($tipo=="TIPO"){
			$dato=lectura($acceso,"select *from tipo_orden  order by nombre_tipo_orden");
		}
		else{
			$dato=lectura($acceso,"select *from detalle_orden  order by nombre_det_orden");
		}
		
		//echo "<br>".count($dato);
		
		for($i=0;$i<count($dato);$i++){
			
			if($tipo=="TIPO"){
				$id_tipo_orden=trim($dato[$i]['id_tipo_orden']);
				$nombre_orden=trim($dato[$i]['nombre_tipo_orden']);
				$where= " id_tipo_orden='$id_tipo_orden' ";
			}
			else{
				$id_det_orden=trim($dato[$i]['id_det_orden']);
				$nombre_orden=trim($dato[$i]['nombre_det_orden']);
				$where= " id_det_orden='$id_det_orden' ";
			}
		
			
			//echo "<br>$id_persona:$nombre:";
			$total_tec=0;
			$dato_t=lectura($acceso,"select *from vista_grupotecnico where id_persona='$id_persona'");
			//echo count($dato_t);
			for($j=0;$j<count($dato_t);$j++){
				$id_gt=trim($dato_t[$j]['id_gt']);
				
				$acceso->objeto->ejecutarSql("SELECT  *FROM grupo_tecnico where id_gt='$id_gt'");
				$integrantes=$acceso->objeto->registros;
				
				$acceso->objeto->ejecutarSql("select *from vista_ordengrupo where id_gt='$id_gt' and status_orden='FINALIZADO' and fecha_final between '$fec_ini' and '$fec_fin' and $where");
				//echo "<br>select *from vista_ordengrupo where id_gt='$id_gt' and status_orden='FINALIZADO' and fecha_final between '$fec_ini' and '$fec_fin' and $where";
				

				
				$cant_orden=$acceso->objeto->registros;
				@$total_tec=$total_tec+($cant_orden/$integrantes);
			}
			
			
			
			$total_ing += $total_tec;
			
			$year[$k] = $nombre_orden;
			$data[$k] = $total_tec;
			
			$k++;
			$num_k++;
		}
		

	$num_k=count($data);
	
		for($i=0;$i<count($data);$i++){
			
			$total=$data[$i];
			@$porc=($total*100)/$total_ing;
			$porcentaje=number_format($porc, 2, ',','.');
			//$data_pie[$i] = new pie_value($total, "$year[$i] ($porcentaje%)");
		
			$mes_l=$i+1;
			$resumen.='<tr><td width="180px" class="estilocabe"> '.$year[$i].'</td><td width="40px" class="estilocabe"  align="center">'.$porcentaje.'%</td<td width="120px" align="right" class="estilocabe">'.$total.'</td></tr>';
		}
		
		$total_ingreso=number_format($total_ing, 0, ',', '.');

$rango=rango_doble($data,$data2);



$title = new title("ORDENES REALIZADAS POR $nombre");
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
$x_labels->set_vertical();
$x_labels->set_steps(1);
$x_labels->set_size(12);
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
		<!--datepicker  -->
			<link type="text/css" href="../include/datepicker/themes/base/ui.all.css" rel="stylesheet" />
			<script type="text/javascript" src="../include/datepicker/jquery-1.3.2.js"></script>
			<script type="text/javascript" src="../include/datepicker/ui/ui.core.js"></script>
			<script type="text/javascript" src="../include/datepicker/ui/ui.datepicker.js"></script>
			<link type="text/css" href="../include/datepicker/demos.css" rel="stylesheet" />
		<!--fin datepicker -->
			
<script type="text/javascript" src="../include/openflashchart/js/json/json2.js"></script>
<script type="text/javascript" src="../include/openflashchart/js/swfobject.js"></script>
<script type="text/javascript">
swfobject.embedSWF(
  "../include/openflashchart/open-flash-chart.swf", "div_chart_1",
  "760", "500", "9.0.0", "expressInstall.swf",
  {"get-data":"get_data_1"} );
 
/*
swfobject.embedSWF(
  "../include/openflashchart/open-flash-chart.swf", "div_chart_4",
  "760", "250", "9.0.0", "expressInstall.swf",
  {"get-data":"get_data_4"} );
  */
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

//var div_chart_4 = new chart('chart 4');

function post_image(debug)
{
	url = "../include/openflashchart/php-ofc-library/ofc_upload_image.php?name=grafico1.png";
	var ofc = findSWF("div_chart_1");
 	x = ofc.post_image( url, 'done', debug );
	/*
	url = "../include/openflashchart/php-ofc-library/ofc_upload_image.php?name=grafico4.png";
	var ofc = findSWF("div_chart_4");
 	x = ofc.post_image( url, 'done', debug );
	*/
}

function findSWF(movieName) {
	if (navigator.appName.indexOf("Microsoft")!= -1) {
		return window[movieName];
	} else {
		return document[movieName];
	}
}
function llamarGrafico(){
		location.href="est_t_i.php?&tipoGrafico="+document.f1.tipoGrafico.value+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&id_tipo_orden="+document.f1.id_tipo_orden.value+"&cedula="+document.f1.cedula.value+"&";
}

function imprimirGrafico(){
	post_image(false);
		location.href="est_t_i_impreso.php?&tipoGrafico="+document.f1.tipoGrafico.value+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&id_det_orden="+document.f1.id_det_orden.value+"&id_tipo_orden="+document.f1.id_tipo_orden.value+"&";
}
</script>



</head>
<body>


<form name="f1" >
<table border="0" width="760px" align="center"> 
	<tr>
		<td colspan="2" ALIGN="CENTER">
			<div class="cabe">ESTADISTICAS POR TECNICOS</div>
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
						<td >
							<span class="estilocabeN">Desde</span>
						</td>
						<td>
							<input type="text" name="desde" id="desde" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
						</td>
						<td>
							<span class="estilocabeN">Hasta</span>
						</td>
						<td>
							<input type="text" name="hasta" id="hasta" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
						</td>

						
			
					
					</tr>
					<tr>
						<td >
							<span class="estilocabeN">Cedula Tecnico</span>
						</td>
						<td>
							
							<select name="cedula" id="cedula" onchange="llamarGrafico()" style="width: 146px;">
								<?php echo verTecnicos($acceso);?>
							</select>
						</td>
						</td>
						<td>
							<span class="estilocabeN">Ordenes de Servicios
							</span>
						</td>
						<td>
							<select name="id_tipo_orden" id="id_tipo_orden" onchange="llamarGrafico()" style="width: 146px;">
								<option value="TIPO">POR TIPO DE ORDEN</option>
								<option value="DETALLE">POR DETALLE DE ORDEN</option>
							</select>
						</td>
							<td class="estilocabeN" colspan="2" align="center">
							<input onClick="llamarGrafico()" value="Buscar" type="BUTTON"> 
						</td>
					</tr>
					
				</table>
				<br>
				
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
					<span class="estilocabeN">RESUMEN DE ORDENES REALIZADAS POR TIPO DE ORDENES
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
		<!--	<input onClick="imprimirGrafico()" value="IMPRIMIR REPORTE" type="BUTTON"> -->
		</td>
		
	</tr>
</table>
</form>
<script>
	document.f1.tipoGrafico.value='<?php echo $tipoGrafico;?>'
	document.f1.id_tipo_orden.value='<?php echo $tipo;?>';
	
	document.f1.desde.value='<?php echo $desde;?>';
	document.f1.hasta.value='<?php echo $hasta;?>';
	document.f1.cedula.value='<?php echo $cedula;?>';
	
	
	$(function() {$('#desde').datepicker({			changeMonth: true,			changeYear: true		});	});
	$(function() {$('#hasta').datepicker({			changeMonth: true,			changeYear: true		});	});
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