<?php
session_start();
require_once("../DataBase/Acceso.php");

$acceso=conexion();
$cadena=$_POST['d'];
$valor=explode("=@",$cadena);
if($_SESSION["autenticacion"]!="On"){
	if($valor[0]=='Configuracion')
		echo Configuracion($valor,$acceso);
	else
		echo "SecurityFalse";
}
else{
	$clase=$valor[0];
	if(clase($valor[1]))
	{
		if($clase!="crearClase" && $clase!="EliminarCampo" && $clase!="AgregarCampo"  && $clase!="AgregarCampoClave"){
			require_once("../procesos.php");
		}
	 switch($clase)
	 {
		case GenerarReporte:
			echo GenerarReporte($cadena,$acceso);
			break;
		case Plantillas:
			echo aplicarPlantillas($valor);
			break;
		case Temas:
			echo aplicarTemas($valor);
			break;
		case Limpiador:
			echo Limpiador($valor,$acceso);
			break;
		case Configuracion:
			echo Configuracion($valor,$acceso);
			break;
		case restaurarDataBase:
			echo restaurarDataBase($valor,$acceso);
			break;
		case crearClase:
			crearClaseFormulario($valor);
			crearClaseControladora($valor);
			crearClaseValidacion($valor);
			echo crearClase($valor,$acceso);
			break;
		case modificarClase:
			modificarClaseFormulario($valor);
			modificarClaseControladora($valor);
			modificarClaseValidacion($valor);
			echo modificarClase($valor,$acceso);
			break;
		case EliminarClase:
			if (file_exists("../reportes/$valor[1].php"))
				echo eliminarReporte($valor,$acceso);
			else{
				eliminarClaseFormulario($valor);
				eliminarClaseControladora($valor);
				eliminarClaseValidacion($valor);
				echo eliminarClase($valor,$acceso);
			}
			break;
		case AgregarCampoClave:
			campoDataGrid($valor);
			agregarCampoFormulario($valor,'campoClave');
			agregarCampoControlador($valor,'campoClave');
			agregarCampoValidacion($valor,'campoClave');
			echo agregarCampoClave($valor,$acceso);
			break;
		case AgregarCampo:
			agregarCampoFormulario($valor,'campo');
			agregarCampoControlador($valor,'campo');
			agregarCampoValidacion($valor,'campo');
			agregarCampoAjax($valor,'campo');
			echo agregarCampo($valor,$acceso);
			break;
		case EliminarCampo:
			eliminarCampoFormulario($valor);
			eliminarCampoControlador($valor);
			eliminarCampoValidacion($valor);
			echo eliminarCampo($valor,$acceso);
			break;
		default:
			echo "metodo no creado:".$clase;
	}
	}//if
}//security
function aplicarPlantillas($cadena)
{
	$fp = fopen("Plantillas/".$cadena[1]."/".$cadena[1].".html","r");
	$id = fopen("../index.html","w+");
	while($linea= fgets($fp))
	{
		fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	
	$fp = fopen("Plantillas/".$cadena[1]."/".$cadena[1].".css","r");
	$id = fopen("../estilos/css.css","w+");
	while($linea= fgets($fp))
	{
		fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	return  'true';
}
function aplicarTemas($cadena)
{
	copy("Temas/".$cadena[1]."/botonhover.jpg","../imagenes/botonhover.jpg");
	copy("Temas/".$cadena[1]."/boton.jpg","../imagenes/boton.jpg");
	copy("Temas/".$cadena[1]."/fondo.jpg","../imagenes/fondo.jpg");
	
	return  'true';
}
function clase($clase)
{
	if($clase!='Modulo' && $clase!='Perfil' && $clase!='Usuario' && $clase!='CreaFormulario')
		return true;
	else
		return false;
}
function restaurarDataBase($cadena,$acceso)
{
	if($cadena[1]=='MySql')
	{
		if(conectar($cadena[1],$cadena[2],$cadena[3],$cadena[4],'test')!=false){
			$acceso=conectar($cadena[1],$cadena[2],$cadena[3],$cadena[4],'test');
			$sql= "DROP DATABASE IF EXISTS $cadena[5]";
			$acceso->objeto->ejecutarSql($sql);
			$sql= "CREATE DATABASE $cadena[5]";
			$acceso->objeto->ejecutarSql($sql);
			$reintento=false;
			$i=0;
			if($acceso=conectar($cadena[1],$cadena[2],$cadena[3],$cadena[4],$cadena[5])!=false){
				do{
					$acceso=conectar($cadena[1],$cadena[2],$cadena[3],$cadena[4],$cadena[5]);
					$fp = fopen("../DataBase/DataBaseMySql.sql","r");		
					while($linea= fgets($fp))
					{
						$acceso->objeto->ejecutarSql($linea);
					}
					fclose ($fp);
					
					$acceso->objeto->ejecutarSql("show tables");
					if($acceso->objeto->registros!=7){
						$reintento=true;
					}
					$i++;
					if($i==3){
						break;
					}
				}while($reintento==true);
			}
			else{
				echo "¡No se pudo restaurar la base de datos!";
			}
		}
		else{
			echo "¡Datos de Configuracion Incorrectos!";
		}
	}
	else if($cadena[1]=='Postgres')
	{
		if(conectar($cadena[1],$cadena[2],$cadena[3],$cadena[4],'postgres')!=false){
			$acceso=conectar($cadena[1],$cadena[2],$cadena[3],$cadena[4],'postgres');
			$sql= "DROP DATABASE IF EXISTS $cadena[5]";
			$acceso->objeto->ejecutarSql($sql);
			$sql= "CREATE DATABASE $cadena[5]";
			$acceso->objeto->ejecutarSql($sql);

			if($acceso=conectar($cadena[1],$cadena[2],$cadena[3],$cadena[4],$cadena[5])!=false){
				$acceso=conectar($cadena[1],$cadena[2],$cadena[3],$cadena[4],$cadena[5]);
				$fp = fopen("../DataBase/DataBasePostgres.sql","r");		
				while($linea= fgets($fp))
				{	
					$acceso->objeto->ejecutarSql($linea);
				}
				fclose ($fp);
			}
			else{
				echo "¡No se pudo restaurar la base de datos!";
			}
		}
		else{
			echo "¡Datos de Configuracion Incorrectos!";
		}
	}
}
function Configuracion($cadena,$acceso)
{
	copy("../DataBase/Acceso.php","copia");
	$fp = fopen("copia","r");
	$id = fopen("../DataBase/Acceso.php","w+");
	while ($linea= fgets($fp))
	{
		if(strstr($linea,'$manejador=')){
			fwrite($id,'    $manejador=\''.$cadena[1].'\';
');
		}
		else if(strstr($linea,'$host=')){
			fwrite($id,'    $host=\''.$cadena[2].'\';
');
		}
		else if(strstr($linea,'$usuario=')){
			fwrite($id,'    $usuario=\''.$cadena[3].'\';
');
		}
		else if(strstr($linea,'$clave=')){
			fwrite($id,'    $clave=\''.$cadena[4].'\';
');
		}
		else if(strstr($linea,'$data_base=')){
			fwrite($id,'    $data_base=\''.$cadena[5].'\';
');
		}
		else
			fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	SeleccionarManejador($cadena);
	if($cadena[6]=="true"){
		restaurarDataBase($cadena,$acceso);
	}
	return 'true';
}
function SeleccionarManejador($cadena)
{
	copy("defaultDataGrid.php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("defaultDataGrid.php","w+");
	while ($linea= fgets($fp))
	{	
		if($cadena[1]=="MySql")
			fwrite($id,str_replace("postgres",strtolower($cadena[1]),$linea));
		else if($cadena[1]=="Postgres")
			fwrite($id,str_replace("mysql",strtolower($cadena[1]),$linea));
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	
	copy("defaultDataGridReporte.php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("defaultDataGridReporte.php","w+");
	while ($linea= fgets($fp))
	{	
		if($cadena[1]=="MySql")
			fwrite($id,str_replace("postgres",strtolower($cadena[1]),$linea));
		else if($cadena[1]=="Postgres")
			fwrite($id,str_replace("mysql",strtolower($cadena[1]),$linea));
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	
	if (file_exists("../include/eyedatagrid/class.eyedatagrid.inc.php"))
		unlink("../include/eyedatagrid/class.eyedatagrid.inc.php");
	if (file_exists("../include/eyedatagrid/class.eyepostgresadap.inc.php"))
		unlink("../include/eyedatagrid/class.eyepostgresadap.inc.php");
	if (file_exists("../include/eyedatagrid/class.eyemysqladap.inc.php"))
		unlink("../include/eyedatagrid/class.eyemysqladap.inc.php");
		
	copy("../include/eyedatagrid/".$cadena[1]."/class.eyedatagrid.inc.php","../include/eyedatagrid/class.eyedatagrid.inc.php");
	copy("../include/eyedatagrid/".$cadena[1]."/class.eye".strtolower($cadena[1])."adap.inc.php","../include/eyedatagrid/class.eye".strtolower($cadena[1])."adap.inc.php");
	
}
function crearClase($cadena,$acceso)
{
	$fp = fopen("class.php","r");		
	$id = fopen("../Clases/".$cadena[1].".php","a+");		
	while($linea= fgets($fp))
	{	
		fwrite($id,str_replace("Clase",$cadena[1],$linea));
	}	
	fclose ($id);
	fclose ($fp);
	
	$acceso->objeto->ejecutarSql(strtolower('CREATE TABLE '.$cadena[1].'(dato character(10) null) ;'));
	$fp = fopen("sql.sql","a+");
	fwrite($fp,'
CREATE TABLE '.$cadena[1].'(
	dato character(10) null
);');
	fwrite($fp,'
case '.strtolower($cadena[1]).':
break;
');
	fclose ($fp);
	return  'true';
}
function crearDataGrid($cadena,$acceso)
{
	$fp = fopen("defaultDataGrid.php","r");		
	$id = fopen("../procesos/datagrid_".$cadena[1].".php","a+");		
	while($linea= fgets($fp))
	{	
		fwrite($id,str_replace("NameModulo",strtolower($cadena[1]),$linea));
	}	
	fclose ($id);
	fclose ($fp);
	return  'true';
}
function GenerarReporte($valor,$acceso)
{
	$cadena=explode("=@=",$valor);
	$tablas=explode("=@",$cadena[0]);
	
	if(count($tablas)>2){
		$select=explode("select ",$cadena[5]);
		$nombre =	"vista_".strtolower(str_replace(" ","",$cadena[6]));
		$sql="CREATE  VIEW $nombre AS select $select[1]";
		$acceso->objeto->ejecutarSql($sql);
		
		$fp = fopen("sql.sql","a+");
		fwrite($fp,$sql.'
);');
		fclose ($fp);
	}
	else{
		$nombre=strtolower($tablas[1]);
	}
  if($cadena[11]=="true")
  {
	
	$aliasCampos=explode("=@",$cadena[4]);
	$can="";
	$renombre="";
	$primero=true;
	for($i=0;$i<count($aliasCampos);$i++)
	{
		
		$camp=explode("->",$aliasCampos[$i]);
		$campo=explode('.',$camp[0]);
		$renombre.='$x->setColumnHeader("'.$campo[1].'", "'.$camp[1].'");
';
		if($primero)
			$can.=$campo[1];
		else
			$can.=",".$campo[1];
		$primero=false;
	}
	$query='$x->setQuery("'.$can.'","'.$nombre.'","","");
'.$renombre;
	
	$nombreRep =	"Rep_".str_replace(" ","",$cadena[6]);
	
	$fp = fopen("defaultDataGridReporte.php","r");		
	$id = fopen("../reportes/".$nombreRep.".php","w+");		
	
	while($linea= fgets($fp))
	{
		
		fwrite($id,str_replace('$x->setQuery("","","","");',$query,$linea));
	}	
	fclose ($id);
	fclose ($fp);
	
	$acceso->objeto->ejecutarSql(sql("modulo ORDER BY codigomodulo desc"));	
	$codigoModulo="MODU".verCodigo($acceso,"codigomodulo");
	$sql="INSERT INTO modulo VALUES ('$codigoModulo', '$cadena[6]', '$cadena[6]', 'Activo', '$nombreRep')";
	$acceso->objeto->ejecutarSql($sql);
	$sql="INSERT INTO moduloperfil VALUES ('PERF001', '$codigoModulo', 'true', 'true', 'true')";
	$acceso->objeto->ejecutarSql($sql);
	
	copy("../javascript/ajax.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/ajax.js","w+");
	while ($linea= fgets($fp))
	{
		if(strstr($linea,'if(clase=="NuevoModuloReporte"){}')){
			fwrite($id,'		if(clase=="'.$nombreRep.'"){
			archivoDataGrid="reportes/'.$nombreRep.'.php";
			updateTable();
		}
');
		}
		fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');

	copy("../formulario.php","copia");
	$fp = fopen("copia","r");
	$id = fopen("../formulario.php","w+");
	while ($linea= fgets($fp))
	{
		if(strstr($linea,'default:')){
			fwrite($id,'	case '.$nombreRep.':
		include "Formulario/'.$nombreRep.'.php";
		break;
');
		}
			fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);

	unlink('copia');

	$fp = fopen("defaultReporte.php","r");		
	$id = fopen("../Formulario/".$nombreRep.".php","w+");		

	while($linea= fgets($fp))
	{
		$linea=str_replace('-nombreReport-',$nombreRep,$linea);
		fwrite($id,str_replace('titulo',$cadena[7],$linea));
	}
	fclose ($id);
	fclose ($fp);
	
	$reg=count($aliasCampos);
	$resul=170/$reg;
	$tama=(int)$resul;
	$ultimo=$tama;
	//echo "<<".$tama*$reg;
	//echo ">>";
	if(($tama*$reg)!=170){
		$rest=170-($tama*$reg);
		//echo "<<$rest>>";
		$ultimo=$tama+$rest;
	}
	//echo "<<$ultimo>>";
	$w='$w=array(10';
	$prim=true;
	$renombre='$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);
';
	$titul="\$header=array('Nro'";
	for($i=0;$i<$reg;$i++){
		$camp=explode("->",$aliasCampos[$i]);
		$campo=explode('.',$camp[0]);
		
			if($i==$reg-1)
				$w.=",$ultimo";
			else
				$w.=",$tama";
			$x=$i+1;
			$renombre.='			$this->Cell($w['.$x.'],6,utf8_decode(trim($row["'.$campo[1].'"])),"LR",0,"J",$fill);
';
		$titul.=",'$camp[1]'";
		$prim=false;
	}
	$w.=");";
	$titul.=");";
	$fp = fopen("DefaultReporteImpreso.php","r");		
	$id = fopen("../reportes/".$nombreRep."Impreso.php","w+");
	while($linea= fgets($fp))
	{
		$linea=str_replace('-Titulo-',strtoupper($cadena[7]),$linea);
		$linea=str_replace('-Cabecera-',strtoupper($cadena[8]),$linea);
		$linea=str_replace('-nombreVista-',strtolower($nombre),$linea);
		$linea=str_replace('-Pie-',$cadena[9],$linea);
		$linea=str_replace('$w=array();',$w,$linea);
		$linea=str_replace('$header=array();',$titul,$linea);
		$linea=str_replace('$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);',$renombre,$linea);
		fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	
	
	copy("../javascript/controlador.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/controlador.js","w+");
	while ($linea= fgets($fp))
	{
		fwrite($id,$linea);
	}
	fwrite($id,'
function Imprimir'.$nombreRep.'(){
		location.href="reportes/'.$nombreRep.'Impreso.php";
}
');
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	
  }
	return  'true';
}
function EliminarReporte($cadena,$acceso)
{
		$nomb=explode("Rep_",$cadena[1]);
		
		$nombre =	"vista_".strtolower($nomb[1]);
		$sql="DROP VIEW $nombre";
		$acceso->objeto->ejecutarSql($sql);
		
		if (file_exists("../reportes/$cadena[1].php"))
			unlink("../reportes/$cadena[1].php");
		
		if (file_exists("../Formulario/$cadena[1].php"))
			unlink("../Formulario/$cadena[1].php");
		
		if (file_exists("../reportes/$cadena[1]Impreso.php"))
			unlink("../reportes/$cadena[1]Impreso.php");
	
	copy("../formulario.php","copia");
	$fp = fopen("copia","r");		
	$id = fopen("../formulario.php","w+");
	$x=false;
	while ($linea= fgets($fp))
	{
		if(strstr($linea,'case '.$cadena[1].':')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'break;'))
			{
				$x=false;
			}	
		}
		else{
			fwrite($id,$linea);
		}
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	
	$x=false;
	$y=false;
	copy("../javascript/controlador.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/controlador.js","w+");
	while($linea=fgets($fp))
	{
		$y=false;
		if(strstr($linea,"function Imprimir$cadena[1](){")){
			$x=true;
			$y=true;
		}
		if($x==true)
		{
			if(strstr($linea,'function ') && $y==false)
			{
				fwrite($id,$linea);
				$x=false;
			}
		}
		else{
			fwrite($id,$linea);
		}
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	
	$x=false;
	$y=false;
	copy("../javascript/ajax.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/ajax.js","w+");
	while($linea=fgets($fp))
	{
		$y=false;
		if(strstr($linea,'if(clase=="'.$cadena[1].'"){')){
			$x=true;
			$y=true;
		}
		if($x==true)
		{
			if(strstr($linea,'}') && $y==false)
			{
				$x=false;
			}
		}
		else{
			fwrite($id,$linea);
		}
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	
	return  'true';
	
}
function campoDataGrid($cadena)
{
	if (file_exists("../procesos/datagrid_".$cadena[1].".php"))
	{
		copy("../procesos/datagrid_".$cadena[1].".php","copia");		
		$fp = fopen("copia","r");		
		$id = fopen("../procesos/datagrid_".$cadena[1].".php","w+");
		while ($linea= fgets($fp))
		{	
			fwrite($id,str_replace("campoClave",strtolower($cadena[3]),$linea));
		}	
		fclose ($id);
		fclose ($fp);
		unlink('copia');
	}
}
function crearClaseValidacion($cadena)
{
	copy("../javascript/validacionAjax.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/validacionAjax.js","w+");
	while ($linea= fgets($fp))
	{	
		if(strstr($linea,'default:')){
			fwrite($id,'		case "'.strtolower($cadena[1]).'":
			document.f1.dato.value=cadena[1];
			break;
');
		}
		fwrite($id,$linea);
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
}
function crearClaseControladora($cadena)
{
	copy("../javascript/controlador.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/controlador.js","w+");
	while ($linea= fgets($fp))
	{	
		$x=true;
		if(strstr($linea,'function validarDato(){')){
			fwrite($id,'function validar'.$cadena[1].'(){ conexionPHP_cas("validarExistencia.php","1=@'.strtolower($cadena[1]).'","dato=@"+data());}
');
			$x=true;
		}
		else if(strstr($linea,'default:')){
			fwrite($id,'	case "'.$cadena[1].'":
		if(validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_cas(tipoDato,clase,data()))
				document.f1.reset();
		}
		break;
');
		}
		if($x==true)
		fwrite($id,$linea);
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	actualizarAjax($cadena);
}
function actualizarAjax($cadena)
{
	copy("../javascript/ajax.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/ajax.js","w+");
	while ($linea= fgets($fp))
	{
		$linea = str_replace('clase=="NuevoModulo"','clase=="'.$cadena[1].'" || clase=="NuevoModulo"',$linea);
		if (file_exists("../procesos/datagrid_".$cadena[1].".php"))
		{
			$linea = str_replace('clase=="NuevoModuloDataGrid"','clase=="'.$cadena[1].'" || clase=="NuevoModuloDataGrid"',$linea);
		}
		fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
}
function crearClaseFormulario($cadena)
{
	copy("creaFormulario.php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("creaFormulario.php","w+");
	while ($linea= fgets($fp))
	{
		if(strstr($linea,'default:')){
			fwrite($id,'	case '.$cadena[1].':
		$titulo=\'<?php require_once "procesos.php"; ?>
\'.titulo("Administracion de '.$cadena[1].'");
		return    $titulo.
		    cabecera().
			campoOculto("dato","dato").
			botones(registrar("'.$cadena[1].'"),modificar("'.$cadena[1].'"),eliminar("'.$cadena[1].'"),cancelar()).
			ultimo();
		break;
');
		}
			fwrite($id,$linea);
	}	
	fclose ($id);
	fclose ($fp);
	require_once("indentacion.php");
	include("creaFormulario.php");
	$valor=explode("=@",$cadena[1]);
	$cad=creaForm($acceso,$valor);
	$cad=indentacion($cad);
	
	$id = fopen("../Formulario/".$cadena[1].".php","w+");
	fwrite($id,$cad);
	fclose ($id);
	copy("../formulario.php","copia");
	$fp = fopen("copia","r");		
	$id = fopen("../formulario.php","w+");
	while ($linea= fgets($fp))
	{
		if(strstr($linea,'default:')){		
			fwrite($id,'	case '.$cadena[1].':
		include "Formulario/'.$cadena[1].'.php";
		break;
');
		}
			fwrite($id,$linea);
	}	
	fclose ($id);
	fclose ($fp);
	
	unlink('copia');
	if(trim($cadena[2]=="true")){
		crearDataGrid($cadena,$acceso);
	}
	return  'true';
}
function modificarClaseFormulario($cadena)
{
	$x=false;
	copy("creaFormulario.php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("creaFormulario.php","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'case '.$cadena[1].':')){
			fwrite($id,str_replace($cadena[1],$cadena[2],$linea));
			$y=false;
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,' campoClave(')){
				fwrite($id,str_replace($cadena[1],$cadena[2],$linea));
				$y=false;
			}
			if(strstr($linea,'botones(registrar(')){
				fwrite($id,str_replace($cadena[1],$cadena[2],$linea));
				$y=false;
			}
			if(strstr($linea,'$titulo=titulo("Administracion')){
				fwrite($id,str_replace($cadena[1],$cadena[2],$linea));
				$y=false;
			}
			if(strstr($linea,'break;'))
			{
				$x=false;
			}	
		}
		if($y)
			fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	
	require_once("indentacion.php");
	require_once("creaFormulario.php");
	$valor=explode("=@",$cadena[2]);
	$cad=creaForm($acceso,$valor);
	$cad=indentacion($cad);
	
	if (file_exists("../Formulario/".$cadena[1].".php"))
		unlink("../Formulario/".$cadena[1].".php");
		
	$id = fopen("../Formulario/".$cadena[2].".php","w+");
	fwrite($id,$cad);
	fclose ($id);
	
	copy("../formulario.php","copia");
	$fp = fopen("copia","r");		
	$id = fopen("../formulario.php","w+");
	$x=false;
	while ($linea= fgets($fp))
	{
		$y=true;
		if(strstr($linea,'case '.$cadena[1].':')){
			fwrite($id,str_replace($cadena[1],$cadena[2],$linea));
			$y=false;
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'include "Formulario')){
				fwrite($id,str_replace($cadena[1],$cadena[2],$linea));
				$y=false;
			}
			if(strstr($linea,'break;'))
			{
				$x=false;
			}	
		}
		if($y)
			fwrite($id,$linea);
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	return  'true';
}
function modificarClaseControladora($cadena)
{
	$x=false;
	copy("../javascript/controlador.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/controlador.js","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'function validar'.$cadena[1].'(){')){
			$linea = str_replace($cadena[1],$cadena[2],$linea);
			fwrite($id,str_replace(strtolower($cadena[1]),strtolower($cadena[2]),$linea));
			$y=false;
		}
		if(strstr($linea,'case "'.$cadena[1].'":')){
			fwrite($id,str_replace($cadena[1],$cadena[2],$linea));
			$y=false;
		}
		if($y)
			fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	return  'true';
}
function modificarClaseValidacion($cadena)
{
	copy("../javascript/validacionAjax.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/validacionAjax.js","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'case "'.strtolower($cadena[1]).'":')){
			fwrite($id,str_replace(strtolower($cadena[1]),strtolower($cadena[2]),$linea));
			$y=false;
		}
		if($y)
			fwrite($id,$linea);
		
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	return  'true';
}
function modificarClase($cadena,$acceso)
{
	$tabla="";
	copy("../Clases/".$cadena[1].".php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../Clases/".$cadena[2].".php","w+");
	while ($linea=fgets($fp))
	{
		fwrite($id,str_replace($cadena[1],$cadena[2],$linea));
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	if (file_exists("../Clases/".$cadena[1].".php"))
		unlink("../Clases/".$cadena[1].".php");
	
	$x=false;
	copy("sql.sql","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("sql.sql","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'case '.($cadena[1]).':')){
			fwrite($id,str_replace($cadena[1],$cadena[2],$linea));
			$y=false;
		}
		if(strstr($linea,'CREATE TABLE '.($cadena[1]).'(')){
			//fwrite($id,str_replace($cadena[1],$cadena[2],$linea));
			$x=true;
		}
		if($x==true)
		{
			$y=false;
			$tabla=$tabla.str_replace($cadena[1],$cadena[2],$linea);
			fwrite($id,str_replace($cadena[1],$cadena[2],$linea));
			if(strstr($linea,');'))
			{
				$x=false;
			}
		}
		else if($y){
			fwrite($id,$linea);
		}
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	$acceso->objeto->ejecutarSql('DROP TABLE '.$cadena[1]);
	$acceso->objeto->ejecutarSql($tabla);
	return  'true';
}
function eliminarClaseValidacion($cadena)
{
	$x=false;
	copy("../javascript/validacionAjax.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/validacionAjax.js","w+");
	while ($linea=fgets($fp))
	{
		if(strstr($linea,'case "'.strtolower($cadena[1]).'":')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'break;'))
			{
				$x=false;
			}	
		}
		else{
			fwrite($id,$linea);
		}
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	return  'true';
}
function eliminarClase($cadena,$acceso)
{
	if (file_exists("../Clases/".$cadena[1].'.php'))
		unlink("../Clases/".$cadena[1].'.php');
		
	if (file_exists("../procesos/datagrid_".$cadena[1].".php"))
		unlink("../procesos/datagrid_".$cadena[1].".php");
		
	$acceso->objeto->ejecutarSql('DROP TABLE '.$cadena[1]);
	$x=false;
	$z=false;
	copy("sql.sql","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("sql.sql","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'CREATE TABLE '.strtolower($cadena[1]).'(')){
			$x=true;
		}
		if($x==true)
		{
			$y=false;
			if(strstr($linea,');'))
			{
				$x=false;
			}	
		}
		if(strstr($linea,'case '.strtolower($cadena[1]).':')){
			$z=true;
		}
		if($z==true)
		{
			$y=false;
			if(strstr($linea,'break;'))
			{
				$z=false;
			}
		}
		if($y){
			fwrite($id,$linea);
		}
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	return  'true';
}
function eliminarClaseFormulario($cadena)
{
	$x=false;
	copy("creaFormulario.php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("creaFormulario.php","w+");
	while ($linea=fgets($fp))
	{
		if(strstr($linea,'case '.$cadena[1].':')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'break;'))
			{
				$x=false;
			}	
		}
		else{
			fwrite($id,$linea);
		}
	}	
	fclose ($id);
	fclose ($fp);
	
	copy("../formulario.php","copia");
	$fp = fopen("copia","r");		
	$id = fopen("../formulario.php","w+");
	$x=false;
	while ($linea= fgets($fp))
	{
		if(strstr($linea,'case '.$cadena[1].':')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'break;'))
			{
				$x=false;
			}	
		}
		else{
			fwrite($id,$linea);
		}
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	if (file_exists("../Formulario/".$cadena[1].".php"))
		unlink("../Formulario/".$cadena[1].".php");
	return  'true';
}
function eliminarClaseControladora($cadena)
{
	$x=false;
	copy("../javascript/controlador.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/controlador.js","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'function validar'.$cadena[1].'(){')){
			$y=false;
		}
		if(strstr($linea,'case "'.$cadena[1].'":')){
			$x=true;
		}
		if($x==true)
		{
			$y=false;
			if(strstr($linea,'break;'))
			{
				$x=false;
			}	
		}		
		if($y==true)
			fwrite($id,$linea);
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	return  'true';
}
function agregarCampoClave($cadena,$acceso)
{
	copy("../Clases/".$cadena[1].".php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../Clases/".$cadena[1].".php","w+");
	while ($linea= fgets($fp))
	{	
		fwrite($id,str_replace("campoClave",$cadena[3],$linea));
	}	
	fclose ($id);	
	fclose ($fp);	
	unlink('copia');
	$acceso->objeto->ejecutarSql(strtolower('ALTER TABLE '.$cadena[1].' ADD '.$cadena[3].' '.tipoDat($cadena).' '.$cadena[12]));
	$acceso->objeto->ejecutarSql(strtolower('ALTER TABLE '.$cadena[1].' ADD CONSTRAINT pk_'.$cadena[1].' primary key ('.$cadena[3].')'));
	
	$x=false;
	$z=false;
	copy("sql.sql","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("sql.sql","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'CREATE TABLE '.($cadena[1]).'(')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'dato character(10) null'))
			{
				fwrite($id,'	'.trim($linea).',
');
				$y=false;
			}
			if(strstr($linea,');'))
			{
				fwrite($id,'	'.$cadena[3].' '.tipoDat($cadena).' '.$cadena[12].',
');
				fwrite($id,'	CONSTRAINT pk_'.$cadena[1].' primary key ('.$cadena[3].')
');
				$x=false;
			}	
		}
		if(strstr($linea,'case '.strtolower($cadena[1]).':')){
			$z=true;
		}
		if($z==true)
		{
			if(strstr($linea,'break'))
			{
				fwrite($id,'	'.$cadena[0].'=@'.$cadena[1].'=@'.$cadena[2].'=@'.$cadena[3].'=@'.$cadena[4].'=@'.$cadena[5].'=@'.$cadena[6].'=@'.$cadena[7].'=@'.$cadena[8].'=@'.$cadena[9].'=@'.$cadena[10].'=@'.$cadena[11].'=@'.$cadena[12].'=@'.$cadena[13].'
');
				$z=false;
			}	
		}
		if($y)
			fwrite($id,$linea);
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	return  'true';
}
function agregarCampoFormulario($cadena,$tipo)
{
	$x=false;
	copy("creaFormulario.php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("creaFormulario.php","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'case '.$cadena[1].':')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'cabecera().'))
			{
				if($tipo=='campoClave'){
					fwrite($id,$linea);
					if($cadena[14]=='true'){
						fwrite($id,'		    campoClave("'.$cadena[4].'","'.$cadena[3].'",'.$cadena[11].','.$cadena[10].',"onChange","validar'.$cadena[1].'()",\'<?php $acceso->objeto->ejecutarSql("select *from '.strtolower($cadena[1]).' ORDER BY '.strtolower($cadena[3]).' desc"); echo "COD".verCo($acceso,"'.strtolower($cadena[3]).'")?>\').
');
					}
					else{
						fwrite($id,'		    campoClave("'.$cadena[4].'","'.$cadena[3].'",'.$cadena[11].','.$cadena[10].',"onChange","validar'.$cadena[1].'()","'.$cadena[9].'").
');
					}
					$y=false;
				}				
			}
			else if(strstr($linea,'campoOculto("dato","dato").'))
			{
				if($tipo=='campo'){
				
					if($cadena[2]=='texto'){
						fwrite($id,'		    campo("'.$cadena[4].'","'.$cadena[3].'",'.$cadena[11].','.$cadena[10].',"'.$cadena[9].'","'.' '.$cadena[13].'").
');
					}
					else if($cadena[2]=='oculto'){
						fwrite($id,'		    campoOculto("'.$cadena[3].'","'.$cadena[9].'").
');
					}
					else if($cadena[2]=='archivo'){
						fwrite($id,'		    archivo("'.$cadena[4].'","'.$cadena[3].'",'.$cadena[11].','.$cadena[10].',"'.$cadena[9].'","'.' '.$cadena[13].'").
');
					}
					else if($cadena[2]=='password'){
						fwrite($id,'		    password("'.$cadena[4].'","'.$cadena[3].'",'.$cadena[11].','.$cadena[10].',"'.$cadena[9].'","'.' '.$cadena[13].'").
');
					}
					else if($cadena[2]=='area'){
						fwrite($id,'		    areaCorta("'.$cadena[4].'","'.$cadena[3].'",'.$cadena[10].','.$cadena[11].',"'.$cadena[9].'","'.$cadena[13].'").
');
					}
					else if($cadena[2]=='lista'){
						$valor=explode(";",$cadena[9]);
							$opcion='<option value="0">Seleccione...</option>';
							
							for($i=0;$i<count($valor);$i++)
							{
								$cad=explode(",",$valor[$i]);
								//$opcion=$opcion.opcion(trim($cad[0]),trim($cad[1]));
								$opcion=$opcion.'<option value="'.trim($cad[0]).'">'.trim($cad[1]).'</option>';
							}
						fwrite($id,'			menu("'.$cadena[4].'",select("'.$cadena[3].'",\''.$opcion.'\',null)).
');
					}
					else if($cadena[2]=='radio'){
						$valor=explode(";",$cadena[9]);
								$cad=explode(",",$valor[0]);
							$radio='"'.trim($valor[0]).'".input(tipo("radio").nombre("'.$cadena[3].'").valor("'.trim($valor[0]).'"). "CHECKED").';
							for($i=1;$i<count($valor);$i++)
							{
								$radio = $radio.'"&nbsp;&nbsp;&nbsp;'.trim($valor[$i]).'"'.'.input(tipo("radio").nombre("'.$cadena[3].'").valor("'.trim($valor[$i]).'")).';
							}
							$radio = $radio.'..';
							$radio = str_replace('...','',$radio);
							
						fwrite($id,'			fila(columna(fuente("'.trim($cadena[4]).'")).columna(fuente('.$radio.'))).
');
					}
					else if($cadena[2]=='casilla'){
						$valor=explode(";",$cadena[9]);
							$check='';
							
							for($i=0;$i<count($valor);$i++)
							{
								$cad=explode(",",$valor[$i]);
								$check = $check.'input(tipo("checkbox").nombre("'.$cadena[3].'").valor("'.trim($cad[1]).'")."'.trim($cad[2]).'").fuente("'.trim($cad[0]).'&nbsp;&nbsp;&nbsp;").';
							}
							$check = $check.',2,1';
							$check = str_replace('.,2,1',',2,1',$check);
						fwrite($id,'			fila(colspan(fuenteN("'.trim($cadena[4]).'"),2,1)).
			fila(colspan('.$check.')).
');
					}
					else if($cadena[2]=='fecha'){
						fwrite($id,'		    fechaepoch("'.$cadena[4].'","'.$cadena[3].'").
');
					}
					else
						echo ', El objeto no esta progrmado para ser visible';
				}
				
			}
			else if(strstr($linea,'break;'))
			{
				$x=false;
			}
		}
		if($y==true)
			fwrite($id,$linea);
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	
	require_once("indentacion.php");
	require_once("creaFormulario.php");
	$valor=explode("=@",$cadena[1]);
	$cad=creaForm($acceso,$valor);
	$cad=indentacion($cad);
//	echo "cad::$cad::";
	$id = fopen("../Formulario/".$cadena[1].".php","w+");
	fwrite($id,$cad);
	fclose ($id);
	
	return  'true';
}
function agregarCampoControlador($cadena,$tipo)
{
	$x=false;	
	copy("../javascript/controlador.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/controlador.js","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'function validar'.$cadena[1].'(){')){
				if($tipo=='campoClave'){
					fwrite($id,'function validar'.$cadena[1].'(){ conexionPHP_cas("validarExistencia.php","1=@'.strtolower($cadena[1]).'","'.$cadena[3].'=@"+'.$cadena[3].'());}
');
					$y=false;
				}
		}
		if(strstr($linea,'function data(){')){
			if(!buscar('copia',$cadena[3].'(){')){
				if($cadena[2]=='casilla'){
					fwrite($id,'function '.$cadena[3].'(){
	var cadena="",i=0;
	for(i=0;i<document.f1.'.$cadena[3].'.length;i++){
		if(document.f1.'.$cadena[3].'[i].checked == true)
			cadena=cadena+document.f1.'.$cadena[3].'[i].value+";";
	}
	return cadena;
}
');
				}
				
				else if($cadena[2]!='radio'){
					fwrite($id,'function '.$cadena[3].'(){return document.f1.'.$cadena[3].'.value;}
');
				}
				
			}
		}
		else if(strstr($linea,'case "'.$cadena[1].'":')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'confirmacion_cas(tipoDato,clase'))
			{
			  if($cadena[2]=='radio'){
				$linea = str_replace('data()','datos()+"=@"+data()',$linea);
				fwrite($id,str_replace("datos()",'verRadio'.$cadena[3].'()',$linea));	
			  }
			  else if($cadena[2]=='fecha'){
				$linea = str_replace('data()','datos()+"=@"+data()',$linea);
				fwrite($id,str_replace("datos()",'formatdate('.$cadena[3].'())',$linea));	
			  }
			  else{
				$linea = str_replace('data()','datos()+"=@"+data()',$linea);
				fwrite($id,str_replace("datos",$cadena[3],$linea));			
			  }
				$y=false;
			}
			if(strstr($linea,'document.f1.dato,isTexto'))
			{
			  if($cadena[2]!='casilla' && $cadena[2]!='radio'){
				if($cadena[2]!='fecha'){
					$linea = str_replace('validaCampo(document.f1.dato,isTexto)','validaCampo(document.f1.datos,'.$cadena[6].') && validaCampo(document.f1.dato,isTexto)',$linea);
					fwrite($id,str_replace('datos',$cadena[3],$linea));
				}
				else{
					$linea = str_replace('validaCampo(document.f1.dato,isTexto)','valdate('.$cadena[3].'()) && validaCampo(document.f1.dato,isTexto)',$linea);
					fwrite($id,$linea);
				}
				$y=false;
			  }
			}
			else if(strstr($linea,'break;'))
			{
				$x=false;
			}
		}
		if($y==true)
			fwrite($id,$linea);
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	return  'true';
}
function agregarCampoValidacion($cadena,$tipo)
{
	$x=false;
	$valor=1;
	copy("../javascript/validacionAjax.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/validacionAjax.js","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'case "'.strtolower($cadena[1]).'":')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'cadena['))
				$valor++;
			if(strstr($linea,'break;'))
			{
				if($cadena[2]=='lista'){
					fwrite($id,'			for(i=0;i<document.f1.'.$cadena[3].'.options.length;i++)
			{
				if(document.f1.'.$cadena[3].'.options[i].value==cadena['.$valor++.'])
					document.f1.'.$cadena[3].'.selectedIndex=i;	
			}
');
				}
				else if($cadena[2]=='radio'){
				fwrite($id,'			traeRadio'.$cadena[3].'(cadena['.$valor++.']);
');	
				}
				else if($cadena[2]=='casilla'){
				fwrite($id,'			asignarCheck(cadena['.$valor++.']);
');	
				}
				else if($cadena[2]=='fecha'){
				fwrite($id,'			document.f1.'.$cadena[3].'.value=formatdatei(cadena['.$valor++.']);
');	
				}
				else if($cadena[2]=='archivo')
				{
				}
				else{
				fwrite($id,'			document.f1.'.$cadena[3].'.value=cadena['.$valor++.'];
');				
				}
				$x=false;
			}
			
		}
		fwrite($id,$linea);
	}
	if($cadena[2]=='radio'){
		fwrite($id,'function traeRadio'.$cadena[3].'(cadena)
{
	for (i=0;i<document.f1.'.$cadena[3].'.length;i++){
			if(cadena==document.f1.'.$cadena[3].'[i].value)								
				document.f1.'.$cadena[3].'[i].click();
	}
}
function verRadio'.$cadena[3].'()
{
	for (i=0;i<document.f1.'.$cadena[3].'.length;i++){
			if(document.f1.'.$cadena[3].'[i].checked)								
				return document.f1.'.$cadena[3].'[i].value;
	}
}
');
	}
	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	return  'true';
}
function agregarCampoAjax($cadena,$tipo)
{
  if($cadena[2]=='fecha')
  {
	$x=false;
	$valor=1;
	copy("../javascript/ajax.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/ajax.js","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'case "formulario.php":')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'break;'))
			{
				if($cadena[2]=='fecha'){
				fwrite($id,"		if(clase=='".$cadena[1]."'){
			obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('".$cadena[3]."'),'',".$cadena[9].",".$cadena[8].");
		}	
");	
				}
				$x=false;
			}
			
		}
		fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
  }
  return  'true';
}
function agregarCampo($cadena,$acceso)
{
	copy("../Clases/".$cadena[1].".php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../Clases/".$cadena[1].".php","w+");		
	while ($linea= fgets($fp))
	{	
		if(strstr($linea,'public function verdato(){'))
		{
			fwrite($id,'	public function verdato(){
		return $this->dato;
	}
');
		}
		if(strstr($linea,'function __construct')){		
			$linea = str_replace(")",',,$dato)',$linea);
			fwrite($id,str_replace("dato,",$cadena[3],$linea));
		}
		else if(strstr($linea,'return $acceso->objeto->ejecutarSql("insert')){		
			$cad = str_replace(",dato",',datos,dato',$linea);
			$linea = str_replace(',\'$this->dato\'',',\'$this->datos\',\'$this->dato\'',$cad);
			fwrite($id,str_replace("datos",$cadena[3],$linea));
		}
		else if(strstr($linea,'return $acceso->objeto->ejecutarSql("Update')){			
			$linea = str_replace('dato=\'$this->dato\'','datos=\'$this->datos\', dato=\'$this->dato\'',$linea);
			fwrite($id,str_replace("datos",$cadena[3],$linea));
		}
		else if(strstr($linea,'$this->dato = $dato;')){			
			$linea = str_replace('$this->dato = $dato;','$this->datos = $datos;
		$this->dato = $dato;',$linea);
			fwrite($id,str_replace("datos",$cadena[3],$linea));
		}
		else{
			fwrite($id,str_replace("dato",$cadena[3],$linea));
		}
		if(strstr($linea,'private $dato;'))
		{
			fwrite($id,$linea);
		}
		
	}
	fclose ($id);	
	fclose ($fp);
	unlink('copia');
	//echo "SQL:".'ALTER TABLE '.$cadena[1].' ADD '.$cadena[3].' '.tipoDat($cadena).' '.$cadena[12].":";
	$acceso->objeto->ejecutarSql(strtolower('ALTER TABLE '.$cadena[1].' ADD '.$cadena[3].' '.tipoDat($cadena).' '.$cadena[12]));	/* default '.$cadena[6].''*/
	
	$x=false;
	$z==false;
	copy("sql.sql","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("sql.sql","w+");
	while ($linea=fgets($fp))
	{
		if(strstr($linea,'CREATE TABLE '.($cadena[1]).'(')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'CONSTRAINT pk_'.$cadena[1].' primary key'))
			{
				fwrite($id,'	'.$cadena[3].' '.tipoDat($cadena).' '.$cadena[12].',
');
				$x=false;
			}	
		}
		if(strstr($linea,'case '.strtolower($cadena[1]).':')){
			$z=true;
		}
		if($z==true)
		{
			if(strstr($linea,'break'))
			{
				fwrite($id,'	'.$cadena[0].'=@'.$cadena[1].'=@'.$cadena[2].'=@'.$cadena[3].'=@'.$cadena[4].'=@'.$cadena[5].'=@'.$cadena[6].'=@'.$cadena[7].'=@'.$cadena[8].'=@'.eliminarLinea($cadena[9]).'=@'.$cadena[10].'=@'.$cadena[11].'=@'.$cadena[12].'=@'.$cadena[13].'
');
				$z=false;
			}	
		}
			fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	return  'true';
}
function eliminarCampo($cadena,$acceso)
{
	$x=0;
	$verdadero=true;
	copy("../Clases/".$cadena[1].".php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../Clases/".$cadena[1].".php","w+");		
	while ($linea= fgets($fp))
	{
		$verdadero=true;
		if(strstr($linea,'private $'.$cadena[3].';'))
		{
			$verdadero=false;
		}
		else if(strstr($linea,'public function ver'.$cadena[3].'(){') || strstr($linea,'return $this->'.$cadena[3].';'))
		{
			$verdadero=false;
			$x++;
		}
		else if(strstr($linea,'function __construct')){
			$linea = str_replace(',$'.$cadena[3],'',$linea);
			fwrite($id,$linea);
			$verdadero=false;
		}
		else if(strstr($linea,'return $acceso->objeto->ejecutarSql("insert')){		
			$cad = str_replace(','.$cadena[3],'',$linea);
			$linea = str_replace(',\'$this->'.$cadena[3].'\'','',$cad);
			fwrite($id,$linea);
			$verdadero=false;
		}
		else if(strstr($linea,'return $acceso->objeto->ejecutarSql("Update')){			
			$linea = str_replace($cadena[3].'=\'$this->'.$cadena[3].'\',','',$linea);
			fwrite($id,$linea);
			$verdadero=false;
		}
		else if(strstr($linea,'$this->'.$cadena[3].' = $'.$cadena[3].';')){			
			$verdadero=false;
		}
		else if($verdadero==true && ($x<1 || $x>2)){
			fwrite($id,$linea);
				$x=0;
		}
		else{
			if($x==2)
				$x++;
			else if($x==3)
				$x=0;
		}
	}
	fclose ($id);	
	fclose ($fp);
	copy("sql.sql","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("sql.sql","w+");
	$x=false;
	$z=false;
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'CREATE TABLE '.$cadena[1].'(')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,$cadena[3]))
			{				
				$x=false;
				$y=false;			
			}
			if(strstr($linea,');'))
			{
				$y=false;			
				$x=false;
			}
		}
		if(strstr($linea,'case '.$cadena[1].':')){
			$z=true;
		}
		if($z==true)
		{
			if(strstr($linea,$cadena[3]))
			{				
				$z=false;
				$y=false;			
			}
			if(strstr($linea,'break;'))
			{
				$y=false;			
				$z=false;
			}
		}
		if($y==true)
			fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	$acceso->objeto->ejecutarSql('ALTER TABLE '.$cadena[1].' DROP COLUMN '.$cadena[3]);	
	return  'true';
}
function eliminarCampoFormulario($cadena)
{
	$x=false;
	$y=true;
	copy("creaFormulario.php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("creaFormulario.php","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'case '.$cadena[1].':')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,$cadena[3]))
			{				
				$x=false;
				$y=false;			
			}
			if($cadena[2]=='casilla')
			{
				if(strstr($linea,$cadena[4]))
				{				
					$y=false;			
				}
			}
		}
		if($y==true)
			fwrite($id,$linea);
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	
	require_once("indentacion.php");
	require_once("creaFormulario.php");
	$valor=explode("=@",$cadena[1]);
	$cad=creaForm($acceso,$valor);
	$cad=indentacion($cad);
	//echo "cad::$cad::";
	$id = fopen("../Formulario/".$cadena[1].".php","w+");
	fwrite($id,$cad);
	fclose ($id);
	return  'true';
}
function eliminarCampoControlador($cadena)
{
	$x=false;	
	copy("../javascript/controlador.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/controlador.js","w+");
	while ($linea=fgets($fp))
	{
		if(strstr($linea,'case "'.$cadena[1].'":')){
			$x=true;
		}
		if(strstr($linea,'function '.$cadena[3].'()')){
				//echo 'entro:'.$cadena[2];
				if($cadena[2]=='casilla')
				{
					fgets($fp);fgets($fp);fgets($fp);fgets($fp);fgets($fp);fgets($fp);fgets($fp);
					$linea=fgets($fp);
				}
		}
		if($x==true)
		{
			if(strstr($linea,'confirmacion_cas(tipoDato,clase'))
			{
				if($cadena[2]=='radio')
				{
					$linea = str_replace('+"=@"+verRadio()','',$linea);				
				}
				else
					$linea = str_replace('+"=@"+'.$cadena[3].'()','',$linea);				
				
			}
			if(strstr($linea,'if(validaCampo(document'))
			{
				$linea = str_replace(' && validaCampo(document.f1.'.$cadena[3].','.$cadena[6].')','',$linea);
			}
		}
			fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	return  'true';
}
function eliminarCampoValidacion($cadena)
{
	$x=false;
	$z=false;
	$y=true;
	$valor=-1;
	$valor1=-2;
	copy("../javascript/validacionAjax.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/validacionAjax.js","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'case "'.strtolower($cadena[1]).'":')){
			$x=true;
		}
		if($x==true)
		{
			$valor++;
			$valor1++;
			if($z==true)
			{
				fwrite($id,str_replace('cadena['.$valor.']','cadena['.$valor1.']',$linea));
				$y=false;
			}
			if($cadena[2]=='radio')
			{
				if(strstr($linea,'radio('))
				{
					$y=false;
					$z=true;
				}
			}
			if($cadena[2]=='casilla')
			{
				if(strstr($linea,'asignarCheck('))
				{
					$y=false;
					$z=true;
				}
			}
			if(strstr($linea,$cadena[3]))
			{
				//echo $linea.'<br>entro a eliminar<br>';				
				$y=false;
				$z=true;
				if($cadena[2]=='lista')
				{
					fgets($fp);fgets($fp);fgets($fp);fgets($fp);
				}
				
			}
			if(strstr($linea,'break;'))
			{
				$x=false;
			}
		}
		if($y==true)
			fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	return  'true';
}
function tipoDat($cadena)
{
	if($cadena[5]=='character' || $cadena[5]=='character varying')
		return $cadena[5].'('.$cadena[7].')';
	else if($cadena[5]=='numeric')
		return $cadena[5].'('.$cadena[7].','.$cadena[8].')';
	else
		return $cadena[5];
}
function buscar($archivo,$dato)
{
	copy($archivo,"copia.js");
	$fp1 = fopen("copia.js","r");
	while ($linea=fgets($fp1))
	{
		if(strstr($linea,$dato)){
			return true;
		}
	}
	fclose ($fp1);
	unlink('copia.js');
	return  false;
}
function eliminarLinea($dato)
{
	$valor=explode("\n",$dato);
	$cad='';
	for($i=0;$i<count($valor);$i++)
	{
		$cad=$cad.trim($valor[$i]);
	}
	return $cad;
}
function Limpiador($valor,$acceso)
{
	for($i=2;$i<count($valor);$i++)
	{
		switch($valor[$i])
		{
			case database:
				echo Limpiardatabase($valor[1],$acceso);
				break;
			case clase:
				echo Limpiarclase($valor[1]);
				break;
			case formulario:
				echo Limpiarformulario($valor[1]);
				break;
			case controlador:
				echo Limpiadorcontrolador($valor[1]);
				break;
			case validacion:
				echo Limpiarvalidacion($valor[1]);
				break;
			case Arccreaformulario:
				echo LimpiarArccreaformulario();
				break;
			case Arcformulario:
				echo LimpiarArcformulario();
				break;
			case Arcinformacion:
				echo LimpiarArcinformacion();
				break;
			case Arccontrolador:
				echo LimpiarArccontrolador();
				break;
			case ArcAjax:
				echo LimpiarArcAjax();
				break;
			case ArcvalidacionAjax:
				echo LimpiarArcvalidacionAjax();
				break;
			case tablas:
				echo Limpiartablas($acceso);
				break;
			case respaldo:
				echo Limpiarrespaldo();
				break;
			case manejador:
				echo Limpiarmanejador();
				break;
			case imagenes:
				echo Limpiarimagenes();
				break;
			case archivo:
				echo Limpiararchivo();
				break;
			default:
				echo "metodo no creado seleccione otro";
		}
	}
	echo 'true';
}
function Limpiartablas($acceso)
{
	$acceso->objeto->ejecutarSql('delete from moduloperfil where codigomodulo=\'MODU001\'');
	$acceso->objeto->ejecutarSql('delete from moduloperfil where codigomodulo=\'MODU005\'');
	$acceso->objeto->ejecutarSql('delete from moduloperfil where codigomodulo=\'MODU006\'');
	$acceso->objeto->ejecutarSql('delete from moduloperfil where codigomodulo=\'MODU007\'');
	$acceso->objeto->ejecutarSql('delete from moduloperfil where codigomodulo=\'MODU008\'');
	$acceso->objeto->ejecutarSql('delete from modulo where nombremodulo=\'Modulo\'');
	$acceso->objeto->ejecutarSql('delete from modulo where nombremodulo=\'CreaFormulario\'');
	$acceso->objeto->ejecutarSql('delete from modulo where nombremodulo=\'VerDatos\'');
	$acceso->objeto->ejecutarSql('delete from modulo where nombremodulo=\'LimpiarProyecto\'');
	$acceso->objeto->ejecutarSql('delete from modulo where nombremodulo=\'GenerarReportes\'');
	
}
function LimpiarArcvalidacionAjax()
{
	$x=false;
	$y=false;
	copy("../javascript/validacionAjax.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/validacionAjax.js","w+");
	while($linea=fgets($fp))
	{
		if(strstr($linea,'case "modulo":') || strstr($linea,'case "Manejador":')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'break;'))
			{
				$x=false;
			}
		}
		else{
			fwrite($id,$linea);
		}
	}
	fclose ($id);
	fclose ($fp);
	
	
	
	unlink('copia');
}
function LimpiarArcAjax()
{
	$x=false;
	$y=false;
	copy("../javascript/ajax.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/ajax.js","w+");
	while($linea=fgets($fp))
	{
		if(strstr($linea,'case "Configuracion":')){
			$x=true;
		}
		else if(strstr($linea,'case "creaFormulario.php":')){
			$x=true;
		}
		else if(strstr($linea,'case "Programador/creaFormulario.php":')){
			$x=true;
		}
		else if(strstr($linea,'case "Programador/Programador.php":')){
			$x=true;
		}
		else if(strstr($linea,'case "Programador.php":')){
			$x=true;
		}
		else if(strstr($linea,'case "../informacion.php":')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'break;'))
			{
				$x=false;
			}
		}
		else{
			fwrite($id,$linea);
		}
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	LimpiarOtraArcAjax();
}
function LimpiarOtraArcAjax()
{
	$x=false;
	$y=false;
	copy("../javascript/ajax.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/ajax.js","w+");
	while($linea=fgets($fp))
	{
		if(strstr($linea,'if(clase=="Configuracion")') || strstr($linea,'if(clase=="CargaObjeto" || clase=="CargaRegistro")') || strstr($linea,'if(clase=="ObjetoFormulario")') || strstr($linea,'if(clase=="Manejador")') || strstr($linea,'if(clase=="TraerModulo1")') || strstr($linea,'if(clase=="Limpieza" || clase=="LimpiezaModulo")')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'}'))
			{
				$x=false;
			}
		}
		else{
			fwrite($id,$linea);
		}
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
}
function LimpiarArccontrolador()
{
	$x=false;
	$y=false;
	copy("../javascript/controlador.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/controlador.js","w+");
	while($linea=fgets($fp))
	{
		$y=false;
		if(strstr($linea,'function abreFormulario()') || strstr($linea,'function validarModulo()') || strstr($linea,'function verManejador()') || strstr($linea,'function database()') || strstr($linea,'function servidor()') || strstr($linea,'function cargarPlantilla()') || strstr($linea,'function cargarModulo()') || strstr($linea,'function cargarRegistro()') || strstr($linea,'function cargarDatos(cadena)') || strstr($linea,'function Limpieza()') || strstr($linea,'function verCheck()') || strstr($linea,'function data()') || strstr($linea,'function validarDato()')){
			$x=true;
			$y=true;
		}
		if($x==true)
		{
			if(strstr($linea,'function ') && $y==false)
			{
				fwrite($id,$linea);
				$x=false;
			}
		}
		else{
			fwrite($id,$linea);
		}
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	LimpiarArcOtracontrolador();
}
function LimpiarArcOtracontrolador()
{
	$x=false;
	$y=false;
	copy("../javascript/controlador.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/controlador.js","w+");
	while($linea=fgets($fp))
	{
		if(strstr($linea,'case "Modulo":') || strstr($linea,'case "Configuracion":') || strstr($linea,'case "Limpiador":')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'break;'))
			{
				$x=false;
			}
		}
		else if(strstr($linea,'var miFormulario="";') || strstr($linea,'var manejador="";')){
			$x=false;
		}
		else{
			fwrite($id,$linea);
		}
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
}
function LimpiarArcinformacion()
{
	$x=false;
	$y=false;
	copy("../informacion.php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../informacion.php","w+");
	while($linea=fgets($fp))
	{
		$y=false;
		if(strstr($linea,'function CargaRegistro($cadena,$acceso)') || strstr($linea,'CargaObjeto($cadena)') || strstr($linea,'function ObjetoForm($cadena)') || strstr($linea,'function verCantidad($cadena)') || strstr($linea,'function Manejador()') || strstr($linea,'function tipoDatos($cadena)')){
			$x=true;
			$y=true;
		}
		if($x==true)
		{
			if(strstr($linea,'function ') && $y==false)
			{
				fwrite($id,$linea);
				$x=false;
			}
		}
		else{
			fwrite($id,$linea);
		}
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	LimpiarArcOtrainformacion();
}
function LimpiarArcOtrainformacion()
{
	$x=false;
	$y=false;
	copy("../informacion.php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../informacion.php","w+");
	while($linea=fgets($fp))
	{
		if(strstr($linea,'case TraerModulo1:') || strstr($linea,'case Manejador:') || strstr($linea,'case ObjetoFormulario:') || strstr($linea,'case CargaObjeto:') || strstr($linea,'case CargaRegistro:') || strstr($linea,'case Limpieza:') || strstr($linea,'case LimpiezaModulo:')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'break;'))
			{
				$x=false;
			}
		}
		else{
			fwrite($id,$linea);
		}
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
}
function LimpiarArcformulario()
{
	$x=false;
	$y=false;
	copy("formulario.php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("formulario.php","w+");
	while ($linea=fgets($fp))
	{
		$y=false;
		if(strstr($linea,'function tipoValidacion()') || strstr($linea,'function tipoDato()') || strstr($linea,'function tipoCampo()') || strstr($linea,'function plantilla($tipo)') || strstr($linea,'function objetoFormulario($acceso,$clase)') || strstr($linea,'function modulosCreado($acceso)') || strstr($linea,'function Limpieza()') || strstr($linea,'function LimpiezaModulo()')){
			$x=true;
			$y=true;
		}
		
		if($x==true)
		{
			if(strstr($linea,'function ') && $y==false)
			{
				fwrite($id,$linea);
				$x=false;
			}	
		}
		else{
			fwrite($id,$linea);
		}
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
}
function LimpiarArccreaformulario()
{
	$x=false;
	copy("creaFormulario.php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("creaFormulario.php","w+");
	while ($linea=fgets($fp))
	{
		if(strstr($linea,'case Modulo:') || strstr($linea,'case CreaFormulario:') || strstr($linea,'case Plantilla:') || strstr($linea,'case Configuracion:') || strstr($linea,'case VerDatos:') || strstr($linea,'case LimpiarProyecto:')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'break;'))
			{
				$x=false;
			}
		}
		else{
			fwrite($id,$linea);
		}
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
}
function LimpiarIndex()
{
	copy("../index.html","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../index.html","w+");
	while($linea=fgets($fp))
	{
		if(strstr($linea,'Programador/script.js')){
			
		}
		else{
			fwrite($id,$linea);
		}
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
}
function Limpiararchivo()
{
	if (file_exists('Formulario.html'))
		unlink('Formulario.html');
	if (file_exists('class.php'))
		unlink('class.php');
	if (file_exists('cssFormulario.css'))
		unlink('cssFormulario.css');
	if (file_exists('Programador.php'))
		unlink('Programador.php');
	if (file_exists('creaFormulario.php'))
		unlink('creaFormulario.php');
	if (file_exists('sql.sql'))
		unlink('sql.sql');
	if (file_exists('indentacion.php'))
		unlink('indentacion.php');
	if (file_exists('copia'))
		unlink('copia');
		
	if (file_exists('copia.js'))
		unlink('copia.js');
	if (file_exists('defaultDataGrid.php'))
		unlink('defaultDataGrid.php');
	if (file_exists('defaultDataGridReporte.php'))
		unlink('defaultDataGridReporte.php');
	if (file_exists('defaultReporte.php'))
		unlink('defaultReporte.php');
	if (file_exists('DefaultReporteImpreso.php'))
		unlink('DefaultReporteImpreso.php');
	
	if (file_exists('script.js'))
		unlink('script.js');
		
	
	borrar_directorio('GeneradorReportes', true);
	borrar_directorio('Plantillas', true);
	borrar_directorio('Temas', true);
	
	LimpiarIndex();
}
function borrar_directorio($dir, $borrarme)
{
    if(!$dh = @opendir($dir)) return;
    while (false !== ($obj = readdir($dh))) 
    {
        if($obj=='.' || $obj=='..') continue;
        if (!@unlink($dir.'/'.$obj)) borrar_directorio($dir.'/'.$obj, true);
    }
    closedir($dh);
    if ($borrarme)
    {
        @rmdir($dir);
    }
}

function Limpiarimagenes()
{
	borrar_directorio('imagenes', true);
}
function Limpiarmanejador()
{
	$fp = fopen("../DataBase/Acceso.php","r");		
	while ($linea= fgets($fp))
	{
		if(strstr($linea,'$manejador=')){
			$valor=explode("'",$linea);
			if($valor[1]=='Postgres')
			{
				if (file_exists('../DataBase/MySql.php'))
				unlink('../DataBase/MySql.php');
			}
			else if($valor[1]=='MySql')
			{
				if (file_exists('../DataBase/Postgres.php'))
				unlink('../DataBase/Postgres.php');
			}
			break;
		}
	}
	fclose ($fp);
}
function Limpiarrespaldo()
{
	if (file_exists('../DataBase/DataBaseMySql.sql'))
		unlink('../DataBase/DataBaseMySql.sql');
	if (file_exists('../DataBase/DataBasePostgres.backup'))
		unlink('../DataBase/DataBasePostgres.backup');
}
function Limpiardatabase($valor,$acceso)
{
	$acceso->objeto->ejecutarSql('ALTER TABLE '.$valor.' DROP COLUMN dato');
}
function Limpiarclase($valor)
{
	$x=0;
	$verdadero=true;
	copy("../Clases/".$valor.".php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../Clases/".$valor.".php","w+");		
	while ($linea= fgets($fp))
	{
		$verdadero=true;
		if(strstr($linea,'private $dato;'))
		{
			$verdadero=false;
		}
		else if(strstr($linea,'public function verdato(){') || strstr($linea,'return $this->dato'))
		{
			$verdadero=false;
			$x++;
		}
		else if(strstr($linea,'function __construct')){
			$linea = str_replace(',$dato','',$linea);
			fwrite($id,$linea);
			$verdadero=false;
		}
		else if(strstr($linea,'return $acceso->objeto->ejecutarSql("insert')){		
			$cad = str_replace(',dato','',$linea);
			$linea = str_replace(',\'$this->dato\'','',$cad);
			fwrite($id,$linea);
			$verdadero=false;
		}
		else if(strstr($linea,'return $acceso->objeto->ejecutarSql("Update')){			
			$linea = str_replace(', dato=\'$this->dato\'','',$linea);
			fwrite($id,$linea);
			$verdadero=false;
		}
		else if(strstr($linea,'$this->dato = $dato;')){			
			$verdadero=false;
		}
		else if($verdadero==true && ($x<1 || $x>2)){
			fwrite($id,$linea);
				$x=0;
		}
		else{
			if($x==2)
				$x++;
			else if($x==3)
				$x=0;
		}
	}
	fclose ($id);	
	fclose ($fp);
}
function Limpiarformulario($valor)
{
	$x=false;
	$y=true;
	copy("creaFormulario.php","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("creaFormulario.php","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'case '.$valor.':')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'campoOculto("dato","dato").'))
			{				
				$x=false;
				$y=false;			
			}
		}
		if($y==true)
			fwrite($id,$linea);
	}	
	fclose ($id);
	fclose ($fp);
	
	
	
	
	unlink('copia');
}
function Limpiarvalidacion($valor)
{
	$x=false;
	copy("../javascript/validacionAjax.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/validacionAjax.js","w+");
	while ($linea=fgets($fp))
	{
		$y=true;
		if(strstr($linea,'case "'.strtolower($valor).'":')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'document.f1.dato.value'))
			{				
				fwrite($id,'			cadena=quitaDato(cade);
');
				$x=false;
				$y=false;
			}
		}
		if($y==true)
			fwrite($id,$linea);
	}	
	fclose ($id);
	fclose ($fp);
	unlink('copia');
}
function Limpiadorcontrolador($valor)
{
	$x=false;	
	copy("../javascript/controlador.js","copia");		
	$fp = fopen("copia","r");		
	$id = fopen("../javascript/controlador.js","w+");
	while ($linea=fgets($fp))
	{
		if(strstr($linea,'case "'.$valor.'":')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'confirmacion_cas(tipoDato,clase'))
			{
					$linea = str_replace('+"=@"+data()','',$linea);				
				
			}
			if(strstr($linea,'if(validaCampo(document'))
			{
				$linea = str_replace(' && validaCampo(document.f1.dato,isTexto)','',$linea);
			}
			if(strstr($linea,'break;')){
				$x=false;
			}
		}
			fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
}

?>