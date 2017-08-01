<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

	session_start();
	$id_f = $_SESSION["id_franq"]; 
	$id_zona = $_GET["id_zona"]; 
	$id_sector = $_GET["id_sector"]; 
	$consult='';
	
		if($id_f!='0'){
			$consult=" and id_franq='$id_f'";
		}
		if($id_zona!='' && $id_zona!='0'){
			$consult=$consult. " and (id_zona ILIKE '%$id_zona%')";
		}
		if($id_sector!='' && $id_sector!='0'){
			$consult=$consult. " and (id_sector ILIKE '%$id_sector%')";
		}
		
	
	
		$ac='';
				$dato=lectura($acceso,"SELECT * FROM statuscont WHERE  status='ACTIVO'");
				for($j=0;$j<count($dato);$j++){
					$nombrestatus=trim($dato[$j]["nombrestatus"]);
					$abrev=trim($dato[$j]["abrev"]);
					$nombrest=str_replace(" ",'_',$nombrestatus);
					
					$ac=$ac." (select count(*) from vista_ubica,contrato where vista_ubica.id_calle=contrato.id_calle and  vista_ubica.id_calle=vista_calle1.id_calle and status_contrato='$nombrestatus' $consult) as $abrev ,";
				}


$total=" (select count(*) from vista_ubica,contrato where vista_ubica.id_calle=contrato.id_calle and  vista_ubica.id_calle=vista_calle1.id_calle $consult) as total";

$where="
select nombre_calle,nombre_sector,nombre_zona,nombre_franq, $ac $total from vista_calle1 where id_calle<>'' $consult
";
//echo ":$where:";
$x->setQuery("*","from vista_calle1","","");

$x->consultas($where);

$x->setQuery("nombre_franq","franquicia","","");
$x->setColumnHeader("nro_calle", _("Nº Calle"));
$x->setColumnHeader("nombre_sector", _("Sector"));
$x->setColumnHeader("nombre_calle", _("Calle"));
$x->setColumnHeader("nombre_zona", _("Zona"));
$x->setColumnHeader("nombre_franq", _("Franquicia"));

$x->setColumnHeader("total", _("Total"));

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