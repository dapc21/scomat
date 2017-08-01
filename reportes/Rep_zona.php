<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

	session_start();
	$id_f = $_SESSION["id_franq"]; 
	//echo ":$id_f:";
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
		$consult_w=" where vista_zona1.id_franq='$id_f'";
	}
	
		$ac='';
				$dato=lectura($acceso,"SELECT * FROM statuscont WHERE  status='ACTIVO'");
				for($j=0;$j<count($dato);$j++){
					$nombrestatus=trim($dato[$j]["nombrestatus"]);
					$abrev=trim($dato[$j]["abrev"]);
					$nombrest=str_replace(" ",'_',$nombrestatus);
					
					$ac=$ac." (select count(*) from vista_ubica,contrato where vista_ubica.id_calle=contrato.id_calle and  vista_ubica.id_zona=vista_zona1.id_zona and status_contrato='$nombrestatus' $consult) as $abrev ,";
				}


$total=" (select count(*) from vista_ubica,contrato where vista_ubica.id_calle=contrato.id_calle and  vista_ubica.id_zona=vista_zona1.id_zona $consult) as total";

$where="
select nombre_zona,nombre_franq, $ac $total from vista_zona1 $consult_w
";
//echo ":$where:";
$x->setQuery("id_zona,nombre_franq","from vista_zona1","","");
$x->consultas($where);

$x->setColumnHeader("nro_zona", _("nro"));
$x->setColumnHeader("nombre_franq", _("franquicia"));

$x->setColumnHeader("total", _("total"));

//$x->hideOrder();
$x->allowFilters();
$x->showRowNumber();

//mostrar resultados por pagina
if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$x->printTable();
?>
