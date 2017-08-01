<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

	session_start();
	$id_f = $_SESSION["id_franq"]; 
	//echo ":$id_f:";
	if($id_f!='0'){
		$consult=" where id_franq='$id_f'";
	}
		$ac='';
				$dato=lectura($acceso,"SELECT * FROM statuscont WHERE  status='ACTIVO'");
				for($j=0;$j<count($dato);$j++){
					$nombrestatus=trim($dato[$j]["nombrestatus"]);
					$abrev=trim($dato[$j]["abrev"]);
					$nombrest=str_replace(" ",'_',$nombrestatus);
					
					$ac=$ac." (select count(*) from vista_ubica,contrato where vista_ubica.id_calle=contrato.id_calle and  vista_ubica.id_franq=franquicia.id_franq and status_contrato='$nombrestatus') as $abrev ,";
				}


$total=" (select count(*) from vista_ubica,contrato where vista_ubica.id_calle=contrato.id_calle and  vista_ubica.id_franq=franquicia.id_franq) as total";

$where="
select id_franq, nombre_franq, $ac $total from franquicia $consult
";
echo ":$where:";

$x->setQuery("*","from franquicia","","");
$x->consultas($where);

$x->setQuery("id_franq,nombre_franq","franquicia","","");
$x->setColumnHeader("id_franq", _("Nº Franq."));
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
