<?php
require_once("../DataBase/Acceso.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$gen_ubi = $_GET['gen_ubi'];

$gen_fec = $_GET['gen_fec'];
$generado_por = $_GET['generado_por'];
$login = $_GET['login'];
$login_aut = $_GET['login_aut'];
$tipo_n = $_GET['tipo'];
$idmotivonota = $_GET['idmotivonota'];
$dir_ip = $_GET['dir_ip'];

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

$id_franq = $_GET['id_franq'];


$id_zona = $_GET['id_zona'];
$id_sector = $_GET['id_sector'];
$id_calle = $_GET['id_calle'];


$x->setQuery("id_nota,nro_contrato,login,login_aut,generado_por,tipo,dir_ip,fecha,hora,monto_anterior,monto_nota,monto_posterior,servicio,fecha_inst,nombremotivonota,comentario","FROM vista_notas","","");

if($gen_ubi!='GENERAL' || $gen_fec!='GENERAL' || $generado_por!='' || $login!='' || $login_aut!='' || $tipo_n!='' || $idmotivonota!='' || $dir_ip!=''){
	$where= "SELECT id_nota,nro_contrato,login,login_aut,generado_por,tipo,dir_ip,fecha,hora,monto_anterior,monto_nota,monto_posterior,servicio,fecha_inst,nombremotivonota,comentario FROM vista_notas where (id_contrato ILIKE '%0%') ";
  if($gen_ubi!='GENERAL'){
		if($id_franq!='0'){
			$where=$where. " and (id_franq = '$id_franq')";
			$tipo='id_franq';
		}
		else if($id_zona!='0'){
			$where=$where. " and (id_zona ILIKE '%$id_zona%')";
			$tipo='id_zona';
		}
		else if($id_sector!='0'){
			$where=$where. " and (id_sector ILIKE '%$id_sector%')";
			$tipo='id_sector';
		}
		else if($id_calle!='0'){
			$where=$where. " and (id_calle ILIKE '%$id_calle%')";
			$tipo='id_calle';
		}
		
		if($tipo=='id_franq'){
			if($id_zona!='0'){
				$where=$where. " and (id_zona ILIKE '%$id_zona%')";
			}
			if($id_sector!='0'){
				$where=$where. " and (id_sector ILIKE '%$id_sector%')";
			}
			if($id_calle!='0'){
				$where=$where. " and (id_calle ILIKE '%$id_calle%')";
			}
			
		}
		else if($tipo=='id_zona'){
			if($id_sector!='0'){
				$where=$where. " and (id_sector ILIKE '%$id_sector%')";
			}
			if($id_calle!='0'){
				$where=$where. " and (id_calle ILIKE '%$id_calle%')";
			}
		}
		else if($tipo=='id_sector'){
			if($id_calle!='0'){
				$where=$where. " and (id_calle ILIKE '%$id_calle%')";
			}
		}

	}
  
  
	if($gen_fec!='GENERAL'){
			$where=$where. " and fecha between '$desde' and '$hasta'";
	}
	
	if($generado_por!=''){
			$where=$where. " and (generado_por ILIKE '%$generado_por%')";
	}
	if($login!=''){
			$where=$where. " and (login ILIKE '%$login%')";
	}
	if($login_aut!=''){
			$where=$where. " and (login_aut ILIKE '%$login_aut%')";
	}
	if($tipo_n!=''){
			$where=$where. " and (tipo ILIKE '%$tipo_n%')";
	}
	if($idmotivonota!=''){
			$where=$where. " and (idmotivonota ILIKE '%$idmotivonota%')";
	}
	if($dir_ip!=''){
			$where=$where. " and (dir_ip ILIKE '%$dir_ip%')";
	}
	
	//echo $where;
	$x->consultas($where);
}
//,cedula,nombre,apellido,nombre_zona,nombre_sector,nombre_calle
$x->setQuery("id_nota,nro_contrato,login,login_aut,generado_por,tipo,dir_ip,fecha,hora,monto_anterior,monto_nota,monto_posterior,servicio,fecha_inst,nombremotivonota,comentario","vista_notas","","");
$x->hideColumn('id_nota');
$x->setColumnHeader("nro_contrato", "Contrato");

$x->setColumnHeader("comentario",_("detalle motivo"));
$x->setColumnHeader("nombremotivonota",_("motivo"));
$x->setColumnHeader("monto_nota",_("monto d/c"));
$x->setColumnHeader("monto_posterior",_("monto. pos."));
$x->setColumnHeader("monto_anterior",_("monto ant."));
$x->setColumnHeader("hora,",_("hora"));
$x->setColumnHeader("fecha",_("fecha"));
$x->setColumnHeader("dir_ip",_("ip equipo"));
$x->setColumnHeader("tipo",_("tipo"));
$x->setColumnHeader("generado_por",_("GENERADO POR "));
$x->setColumnHeader("login",_("Solicitado por"));
$x->setColumnHeader("login_aut",_("Autorizado por"));
$x->setColumnHeader("fecha_inst",_("fecha servicio"));


$x->setColumnType('monto_anterior', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('monto_posterior', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('monto_nota', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('fecha', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
$x->setClase("Rep_totalclientes");

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
					<input  type="button" name="registrar" value="'. _('imprimir').'" onclick="ImprimirRep_notas()">&nbsp;
					<input  type="button" name="registrar" value="'. _('guardar').'" onclick="GuardarRep_notas()">&nbsp;
					</div>
';
?>
