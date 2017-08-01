<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$tiempo = $_GET['tiempo']*30;
$gen_ubi = $_GET['gen_ubi'];

$gen_fec = $_GET['gen_fec'];
$status_contrato = $_GET['status_contrato'];

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

$id_franq = $_GET['id_franq'];


$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];

$where='';
if($gen_ubi!='GENERAL'){
		if($id_franq!='0'){
			$where=$where. " and (zona.id_franq = '$id_franq')";
			$tipo='id_franq';
		}
		else if($id_zona!='0'){
			$where=$where. " and (zona.id_zona ILIKE '%$id_zona%')";
			$tipo='id_zona';
		}
		else if($id_sector!='0'){
			$where=$where. " and (sector.id_sector ILIKE '%$id_sector%')";
			$tipo='id_sector';
		}
		else if($id_calle!='0'){
			$where=$where. " and (calle.id_calle ILIKE '%$id_calle%')";
			$tipo='id_calle';
		}
		
		if($tipo=='id_franq'){
			if($id_zona!='0'){
				$where=$where. " and (zona.id_zona ILIKE '%$id_zona%')";
			}
			if($id_sector!='0'){
				$where=$where. " and (sector.id_sector ILIKE '%$id_sector%')";
			}
			if($id_calle!='0'){
				$where=$where. " and (calle.id_calle ILIKE '%$id_calle%')";
			}
			
		}
		else if($tipo=='id_zona'){
			if($id_sector!='0'){
				$where=$where. " and (sector.id_sector ILIKE '%$id_sector%')";
			}
			if($id_calle!='0'){
				$where=$where. " and (calle.id_calle ILIKE '%$id_calle%')";
			}
			
		}
		else if($tipo=='id_sector'){
			if($id_calle!='0'){
				$where=$where. " and (calle.id_calle ILIKE '%$id_calle%')";
			}
			
		}

	}
if($status_contrato!=''){
	$where=$where. " and (status_contrato ILIKE '%$status_contrato%')";
}
$sql="";
if($gen_fec!='GENERAL'){
	$sql= " and fecha_final between '$desde' and '$hasta'";
}

$acceso->objeto->ejecutarSql("delete from recuperado");
	
//echo "select id_contrato from contrato where contrato.id_calle = calle.id_calle AND calle.id_sector = sector.id_sector and sector.id_zona = zona.id_zona and (id_contrato ILIKE '%0%') $where order by nro_contrato";
$dato=lectura($acceso,"select id_contrato from contrato,calle,sector,zona where contrato.id_calle = calle.id_calle AND calle.id_sector = sector.id_sector and sector.id_zona = zona.id_zona and (id_contrato ILIKE '%0%') $where order by nro_contrato");
$cant=count($dato);

for($i=0;$i<$cant;$i++){
	$id_contrato=trim($dato[$i]["id_contrato"]);
	$dato1=lectura($acceso,"select id_orden,fecha_final from ordenes_tecnicos where id_contrato='$id_contrato' and id_det_orden='DEO00010' and status_orden='FINALIZADO' order by id_orden");
	for($j=0;$j<count($dato1);$j++){
		$id_orden=trim($dato1[$j]["id_orden"]);
		$fecha_corte=trim($dato1[$j]["fecha_final"]);
		if($fecha_corte!=''){
			//echo "<br>select fecha_final from ordenes_tecnicos where id_orden>'$id_orden' and id_contrato='$id_contrato' and id_det_orden='DEO00003' and status_orden='FINALIZADO' $sql order by id_orden LIMIT 1 offset 0";
			$acceso->objeto->ejecutarSql("select fecha_final from ordenes_tecnicos where id_orden>'$id_orden' and id_contrato='$id_contrato' and id_det_orden='DEO00003' and status_orden='FINALIZADO' $sql order by id_orden LIMIT 1 offset 0");
			if($row=row($acceso))
			{
				$id_orden1=trim($row["id_orden"]);
				$fecha_recon=trim($row["fecha_final"]);
				if($fecha_recon!=''){
					$n_dias=dia_diferencia($fecha_corte,$fecha_recon);
						
					if($n_dias>$tiempo){
						$acceso->objeto->ejecutarSql("insert into recuperado(id_contrato,fecha_rec) values ('$id_contrato','$fecha_recon')");			
						//echo "<br>:::::$tiempo:$id_contrato:$fecha_corte:$fecha_recon:$n_dias:";
					}
				}
			}
		}
	}
}





$x->setQuery("id_contrato,fecha_rec,nro_contrato,cedula,nombre,apellido,status_contrato,etiqueta,telefono,  deuda  ,nombre_zona,nombre_sector,nombre_calle,numero_casa","vista_contratorec","","");
$x->hideColumn('id_contrato');
$x->setColumnHeader("nro_contrato", _("contrato"));
$x->setColumnHeader("cedula", _("cedula"));
$x->setColumnHeader("nombre", _("nombre"));
$x->setColumnHeader("apellido", _("apellido"));
$x->setColumnHeader("fecha_rec", _("fecha rec"));
$x->setColumnHeader("status_contrato", _("status"));
$x->setColumnHeader("etiqueta", _("precinto"));
$x->setColumnHeader("telefono", _("telefono"));
$x->setColumnHeader("deuda", _("total deuda"));
$x->setColumnHeader("nombre_zona", _("zona"));
$x->setColumnHeader("nombre_sector", _("sector"));
$x->setColumnHeader("nombre_calle", _("calle"));
$x->setColumnHeader("numero_casa", _("nro casa"));

$x->setColumnType('costo_dif_men', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('fecha_rec', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setClase("Rep_totalclientes");



$x->hideColumn('id_contrato');
$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "respRefActCont('%id_contrato%')");

//$x->hideOrder();
//$x->allowFilters();
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

echo '
<div align="center">
					<input  type="button" name="registrar" value="'. _('imprimir').'" onclick="ImprimirRep_recuperados()">&nbsp;
					<input  type="button" name="registrar" value="'. _('guardar').'" onclick="GuardarRep_recuperados()">&nbsp;
					</div>
';



?>
