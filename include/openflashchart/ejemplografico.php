<?php
include 'php-ofc-library/open-flash-chart.php' ;

$title = new title( date("D M d Y") );
$data = array(9,8,7,6,5,4,3,2,1);
$bar = new bar_cylinder_outline();
$bar->set_values( $data );

$chart = new open_flash_chart();
$chart->set_title( $title );
$chart->add_element( $bar );

//echo $chart->toPrettyString();
?>

<html>
<head>

<script type="text/javascript" src="js/json/json2.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript">
swfobject.embedSWF("open-flash-chart.swf", "my_chart", "550", "450", "9.0.0");
</script>

 <script type="text/javascript">

function open_flash_chart_data()
{
//alert( 'reading data' );
return JSON.stringify(data);
}

function findSWF(movieName) {
	if (navigator.appName.indexOf("Microsoft")!= -1) {
		return window[movieName];
	} else {
		return document[movieName];
	}
}

var data = <?php echo $chart -> toPrettyString (); ?> ;

</script>

<script type="text/javascript">
 
// The chart object
function chart(name) {
	this.name = name;
	this.image_saved = function(id) {
	//	alert('saved:'+this.name+', id:'+id );
	};
}

var my_chart = new chart('chart 1');

function post_image(debug)
{
	url = "php-ofc-library/ofc_upload_image.php?name=tmpkk.jpg";
	var ofc = findSWF("my_chart");
 	x = ofc.post_image( url, 'done', debug );
}

</script>


</head>
<body>

<p>Hello World</p>

<div id="my_chart"></div>

<div id="test" style="font-weight: bold;"> 
	<input onClick="post_image(false)" value="Gueadar JPG" type="BUTTON">  
</div>
</body>
</html>