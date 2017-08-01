<?php
//archivo destinado a procesar y devolver datos o informacion relaciona con la aplicacion
session_start();
require_once "procesos.php";
$cadena=$_POST['d'];
$valor=explode("=@",$cadena);
$clase=$valor[0];

if($_SESSION["autenticacion"]!="On"){
	
	if($clase=='Manejador')
		echo Manejador();
	else
		echo "SecurityFalse";
}
else{
require_once "procesos.php";
$cadena=$_POST['d'];
$valor=explode("=@",$cadena);
$clase=$valor[0];
switch($clase)
{
	case TraerModulo:
		echo traerModulo(acceso($acceso,sql(consulta("moduloperfil","codigoperfil",$valor[1],'ORDER BY codigomodulo'))),"codigomodulo");
		break;
	case TraerModulo1:
		echo traerModulo(acceso($acceso,sql(consulta("moduloperfil","codigomodulo",$valor[1],'ORDER BY codigoperfil'))),"codigoperfil");
		break;
	case Manejador:
		echo Manejador();
		break;
	case ObjetoFormulario:
		echo ObjetoForm($valor);
		break;
	case CargaObjeto:
		echo CargaObjeto($valor);
		break;
	case CargaRegistro:
		echo CargaRegistro($valor,acceso($acceso,sql($valor[1])));
		break;
	case Limpieza:
		echo Limpieza();
		break;
	case LimpiezaModulo:
		echo  LimpiezaModulo();
		break;
	case camposRep2:
		echo  camposRep2($acceso,$valor);
		break;
	case validarSQL:
		echo  validarSQL($acceso,$valor[1]);
		break;
	case traerLisMatProv:
		echo  traerLisMatProv($acceso,$valor[1]);
		break;
	case traerLisPedido:
		echo  traerLisPedido($acceso,$valor[1]);
		break;
	case traerLisInventario:
		echo  traerLisInventario($acceso,$valor[1]);
		break;
	case pasaPedidoAconfir:
		//echo  "valor:".$valor[1];
		//echo  traerLisPedido($acceso,$valor[1]);
		break;
	case traerGtPersona:
		//echo  "valor:".$valor[1];
		echo  traerGtPersona($acceso,$valor[1]);
		break;
	case traerTmovi:
		//echo  "valor:".$valor[1];
		echo  traerTmovi($acceso,$valor[1]);
		break;
	case traerTipomov:
		//echo  "valor:".$valor[1];
		echo  traerTipomov($acceso,$valor[1]);
		break;
	case traerTM:
		//echo  "valor:".$valor[1];
		echo  traerTM($acceso,$valor[1]);
		break;
	case traerTipocon:
		//echo  "valor:".$valor[1];
		echo  traerTipocon($acceso,$valor[1]);
		break;
	case traerTC:
		//echo  "valor:".$valor[1];
		echo  traerTC($acceso,$valor[1]);
		break;
	case traerDeposito02:
		//echo  "valor:".$valor[1];
		echo  traerDeposito02($acceso,$valor[1]);
		break;
	case traeValDep:
		//echo  "valor:".$valor[1];
		echo  traeValDep($acceso,$valor[1]);
		break;
	case agregar_mat_mov:
		echo  agregar_mat_mov($acceso,$valor[1]);
		break;
	case agregar_mat_mov_orden:
		echo  agregar_mat_mov_orden($acceso,$valor[1]);
		break;
	case traermat:
		echo  traermat($acceso,$valor[1]);
	case ver_config_mat:
		echo  ver_config_mat($acceso,$valor[1]);
	case traerDepMat:
		echo  traerDepMat($acceso,$valor[1],$valor[2]);
		break;
	case traerDepMatGen:
		echo  traerDepMatGen($acceso,$valor[1],$valor[2]);
		break;
	case traerDepMatOrd:
		echo  traerDepMatOrd($acceso,$valor[1],$valor[2]);
		break;
	default:
		echo titulo("El contenido de ".$clase." no esta Construdio Disculpe las molestias");
}
}//security

function traerTC($acceso,$id_persona){
	$acceso->objeto->ejecutarSql("select id_te from entidad where id_persona='$id_persona'");
	if($row=row($acceso)){				
		return trim($row['id_te']);
	}
}
function ver_config_mat($acceso,$id_gt){
	$acceso->objeto->ejecutarSql("select id_franq from grupo_trabajo where id_gt='$id_gt'");
	if($row=row($acceso)){				
		$id_franq=trim($row['id_franq']);
		
		
		$acceso->objeto->ejecutarSql("select * from config_mat where id_franq='$id_franq'");
		if($row=row($acceso)){
			$hab_desc_alm_gru=trim($row["hab_desc_alm_gru"]);
			$hab_desc_alm_gen=trim($row["hab_desc_alm_gen"]);
			$hab_mat_orden=trim($row["hab_mat_orden"]);
			$id_deposito=trim($row["id_deposito"]);
		}
		return "=@$hab_desc_alm_gru=@$hab_desc_alm_gen=@$hab_mat_orden=@$id_deposito=@";
		/*
		if($hab_desc_alm_gru=="t"){
			include "Formulario/movimiento_final_orden.php";
		}
		else if($hab_desc_alm_gen=="t"){
			include "Formulario/movimiento_final_orden_gen.php";
		}
		else if($hab_mat_orden=="t"){
			include "Formulario/movimiento_final_orden_mat.php";
		}
			*/
		
	}
}
function traerTM($acceso,$id_tm){
	$acceso->objeto->ejecutarSql("select tipo_ent_sal from tipo_movimiento where id_tm='$id_tm'");
	if($row=row($acceso)){				
		return trim($row['tipo_ent_sal']);
	}
}
function traerDepMat($acceso,$id_gt,$id_orden){
//echo "select id_dep,id_persona_enc from deposito where id_gt='$id_gt'";
	$acceso->objeto->ejecutarSql("select id_dep,id_persona_enc from deposito where id_gt='$id_gt'");
	if($row=row($acceso)){				
		$id_dep=trim($row['id_dep']);
		$id_persona_enc=trim($row['id_persona_enc']);
	
	
		$acceso->objeto->ejecutarSql("select id_mov from movimiento where tipo_mov='$id_dep' and referencia='$id_orden'");
		if($row=row($acceso)){				
			$id_mov=trim($row['id_mov']);
		}
		
		$acceso->objeto->ejecutarSql("select id_persona from entidad where id_persona='$id_persona_enc'");
		if($row=row($acceso)){				
			$entidad='true';
		}
		else{
			$entidad='false';
		}
		
		return $id_dep."=@".$id_persona_enc."=@".$id_mov."=@".$entidad;
	}
	return '';
}
function traerDepMatOrd($acceso,$id_gt,$id_orden){
		$acceso->objeto->ejecutarSql("select id_mov from movimiento_orden where tipo_mov='A0000001' and referencia='$id_orden'");
		if($row=row($acceso)){				
			$id_mov=trim($row['id_mov']);
		}
		
	return "=@=@".$id_mov."=@";
}
function traerDepMatGen($acceso,$id_gt,$id_orden){
	$acceso->objeto->ejecutarSql("select id_persona from grupo_tecnico where id_gt='$id_gt'");
	while($row=row($acceso)){				
		$id_persona=trim($row['id_persona']);
	
		$acceso->objeto->ejecutarSql("select * from config_mat where id_franq='1'");
		if($row=row($acceso)){
			$id_dep=trim($row["id_deposito"]);
		}
		$acceso->objeto->ejecutarSql("select id_mov from movimiento where tipo_mov='$id_dep' and referencia='$id_orden'");
		if($row=row($acceso)){
			$id_mov=trim($row['id_mov']);
		}
		
		$acceso->objeto->ejecutarSql("select id_persona from entidad where id_persona='$id_persona'");
		if($row=row($acceso)){				
			$entidad='true';
			return "=@".$id_persona."=@".$id_mov."=@".$entidad;
		}
		else{
			$entidad='false';
		}
	}
	return "=@".$id_persona."=@".$id_mov."=@".$entidad;
}
function agregar_mat_mov_orden($acceso,$val){
	$camp1="";
	$camp2="";
	$auxi=explode('==',$val);
	$sil=0;
	$id_mat=$auxi[0];
	$id_mov=$auxi[1];
	
	$acceso->objeto->ejecutarSql("select c_uni_sal,c_uni_ent,abreviatura,cant_mov,us_abre,id_mat,id_m,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock_min,stock,stock_min as min from vista_mov_mat_o where id_mat='$id_mat' and id_mov='$id_mov'");
	if($acceso->objeto->registros>0){
		$sil=1;
	}else{
		$acceso->objeto->ejecutarSql("select c_uni_sal,c_uni_ent,abreviatura,us_abre,id_mat,id_m,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock_min,stock,stock_min as min from vista_materiales_unid where id_mat='$id_mat'");
	}
	if($row=row($acceso))
	{
	
		/*foreach ($row as $key => $value)
		{*/
			
			$numero_mat=trim($row["numero_mat"]);
			$nombre_mat=trim($row["nombre_mat"]);
			$id_m=trim($row["id_m"]);
			$id_mat=trim($row["id_mat"]);
			$c_uni_sal=trim($row["c_uni_sal"]);
			$c_uni_ent=trim($row["c_uni_ent"]);
			$us_abre=trim($row["us_abre"]);
			$abreviatura=trim($row["abreviatura"]);
			 $value =$value. "<table width='100%' border='0' align='CENTER'cellpadding='1' cellspacing='1'> <TR><TD style='width: 10%;'>";
			$value =$value. '<input type="text" name="numero_mat" onChange="validarmat_padre_mov_mat02_orden();" id="numero_mat" value="'.$numero_mat.'"  maxlength="10" size="5">';
			$value =$value. '</TD><TD style="width: 25%;"><input type="text" name="nombre_mat" onChange="" id="nombre_mat" value="'.$nombre_mat.'"  maxlength="50" size="25">';

			$stock_min=trim($row["stock_min"]);
			$stock_min2=$stock_min*$c_uni_sal;
			$value =$value. "</TD><TD style='width: 25%;'>";
			$value =$value. '<input disabled type="hidden" name="id_m" id="id_m" value="'.$id_m.'"  maxlength="10" size="5">
			<input disabled type="hidden" name="min" id="min" value="'.$stock_min2.'"  maxlength="10" size="5">';
			
			if($sil==1){
				$cant_mov=trim($row["cant_mov"]);
				
				//$stock=trim($row["stock"]);
				$camp1=explode('.',$cant_mov/$c_uni_sal);
				$camp2=$cant_mov%$c_uni_sal;
			}
			
			
			//$value =$value. "</TD><TD>";
			if($abreviatura!=$us_abre){
				$value = $value. '<div  style="width: 100%;float:center;"><div  style="width: 50%;float:left;">
				<input disabled type="hidden" name="cantNew" id="cantNew" value="0"  maxlength="10" size="5">
				<input  type="text" onKeyPress="return validar_numeros(event);" onmousedown="habili(\''.$id_mat.'\');"onmouseover="habili(\''.$id_mat.'\');" onKeyUp="calcuSal(\''.$id_mat.'\',\''.$abreviatura.'\',\''.$us_abre.'\');"  onchange="validar_can_movimien_dos(\''.$id_mat.'\',\''.$cantindice.'\',\''.$c_uni_sal.'\',\''.$abreviatura.'\',\''.$us_abre.'\');" name="cant" id="cant"  maxlength="5" size="5" value="'.$camp1[0].'">'.strtolower($abreviatura).'</div>';
			
				
				
				$value = $value .'<div  style="width:  50%;float:right;">
				<input  type="text" onKeyPress="return validar_numeros(event);" onKeyUp="calcuSal02(\''.$id_mat.'\',\''.$abreviatura.'\',\''.$us_abre.'\');"  onchange="validar_can_movimien_dos(\''.$id_mat.'\',\''.$cantindice.'\',\''.$c_uni_sal.'\',\''.$abreviatura.'\',\''.$us_abre.'\');" name="cantabre" id="cantabre" value="'.$camp2.'"  maxlength="20" size="4">'.strtolower($us_abre).'</div>';
			}else{
			
				$value = $value. '<div  style="width: 100%;float:center;"><div  style="width: 90%;float:left;">
				<input disabled type="hidden" name="cantNew" id="cantNew" value="0"  maxlength="10" size="5">
				<input  type="text" onKeyPress="return validar_numeros(event);" onmousedown="habili(\''.$id_mat.'\');"onmouseover="habili(\''.$id_mat.'\');" onKeyUp="calcuSal(\''.$id_mat.'\',\''.$abreviatura.'\',\''.$us_abre.'\');"  onchange="validar_can_movimien_dos(\''.$id_mat.'\',\''.$cantindice.'\',\''.$c_uni_sal.'\',\''.$abreviatura.'\',\''.$us_abre.'\');" name="cant" id="cant"  maxlength="5" size="5" value="'.$camp1[0].'">'.strtolower($abreviatura).'</div>';
			
			
			}
			$cantindice++;
		
			$stock=trim($row["stock"]);
			$stock1=explode('.',$stock/$c_uni_sal);
			$stock2=$stock%$c_uni_sal;
			$value =$value. "";
			$value = $value.'<input disabled type="hidden" name="cent" id="cent" value="'.$c_uni_ent.'"  maxlength="10" size="5">
			<input disabled type="hidden" name="stockgen" id="stockgen" value="'.$stock.'"  maxlength="10" size="5">
			<input disabled type="hidden" name="csal" id="csal" value="'.$c_uni_sal.'"  maxlength="10" size="5">';
			if($abreviatura!=$us_abre){
				$value = $value.'<div  style="width:100%;float:center;"><div  style="width: 50%;float:left;">	
				<input disabled style="text-align:center;color:cian;text-shadow: #C3C3C3 10px 10px 10px ;" border="0" type="hidden" title="'.$c_uni_ent.' '.$abreviatura.' = '.$c_uni_sal.' '.$us_abre.'" onKeyPress="return validar_numeros(event)" name="stockver" id="stock" value="'.$stock1[0].'"  maxlength="20" size="6"></div>';
			
				
				$value =$value. "";
				$value = $value .'<div  style="width:  50%;float:right;">
				<input disabled style="text-align:center;color:cian;text-shadow: #C3C3C3 10px 10px 10px ;" border="0" type="hidden" onKeyPress="return validar_numeros(event)" name="stock2" id="stock2" value="'.$stock2.'"  maxlength="20" size="6"></div>';
			}else{
				$value = $value.'<div  style="width:100%;float:center;"><div  style="width: 90%;float:left;">	
				<input disabled style="text-align:center;color:cian;text-shadow: #C3C3C3 10px 10px 10px ;" border="0" type="hidden" title="'.$c_uni_ent.' '.$abreviatura.' = '.$c_uni_sal.' '.$us_abre.'" onKeyPress="return validar_numeros(event)" name="stockver" id="stock" value="'.$stock1[0].'"  maxlength="20" size="6"></div>';
			}
		$value =$value. '<input disabled type="hidden" onKeyPress="return validar_numeros(event)" name="minver" id="minver" value="'.$stock_min.'"  maxlength="10" size="5">';
								
		$value =$value. "<TR></TABLE>";
		echo $value;
	}else{
		echo '<table width="97%" cellspacing="1" cellpadding="1" border="0" align="CENTER">
				<tr>
					<td style="width: 10%;">
						<input id="numero_mat" onChange="validarmat_padre_mov_mat02_orden();" type="text" size="5" maxlength="10" value="" name="numero_mat">
					</td>
					<td style="width: 25%;">
						  <input id="nombre_mat" onChange="" type="text" size="25" maxlength="50" value="" name="nombre_mat">
					</td>
					<td style="width: 25%;">
						<input type="text" size="25" maxlength="30"  disabled>
					</td>
					
				</tr>

			</table>';
	
	
	}					
}

function agregar_mat_mov($acceso,$val){
	
	$camp1="";
	$camp2="";
	$auxi=explode('==',$val);
	$sil=0;
	$id_mat=$auxi[0];
	$id_mov=$auxi[1];
	//echo "select c_uni_sal,c_uni_ent,abreviatura,us_abre,id_mat,id_m,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock_min,stock,stock_min as min from vista_movimiento_mov_mat_uni where id_mat='$id_mat' and id_mov='$id_mov'";
	//$acceso->objeto->ejecutarSql("select c_uni_sal,c_uni_ent,abreviatura,us_abre,id_mat,id_m,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock_min,stock,stock_min as min from vista_materiales_unid where id_mat='$id_mat'");
	
	$acceso->objeto->ejecutarSql("select c_uni_sal,c_uni_ent,abreviatura,cant_mov,us_abre,id_mat,id_m,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock_min,stock,stock_min as min from vista_movimiento_mov_mat_uni where id_mat='$id_mat' and id_mov='$id_mov'");
	if($acceso->objeto->registros>0){
		$sil=1;
	}else{
		$acceso->objeto->ejecutarSql("select c_uni_sal,c_uni_ent,abreviatura,us_abre,id_mat,id_m,numero_mat,nombre_mat,nombre_dep,nombre_fam,nombre_unidad,stock_min,stock,stock_min as min from vista_materiales_unid where id_mat='$id_mat'");
	}
	if($row=row($acceso))
	{
	
		/*foreach ($row as $key => $value)
		{*/
			
			$numero_mat=trim($row["numero_mat"]);
			$nombre_mat=trim($row["nombre_mat"]);
			$id_m=trim($row["id_m"]);
			$id_mat=trim($row["id_mat"]);
			$c_uni_sal=trim($row["c_uni_sal"]);
			$c_uni_ent=trim($row["c_uni_ent"]);
			$us_abre=trim($row["us_abre"]);
			$abreviatura=trim($row["abreviatura"]);
			 $value =$value. "<table width='100%' border='0' align='CENTER'cellpadding='1' cellspacing='1'> <TR><TD style='width: 10%;'>";
			$value =$value. '<input type="text" name="numero_mat" onChange="validarmat_padre_mov_mat02();" id="numero_mat" value="'.$numero_mat.'"  maxlength="10" size="5">';
			$value =$value. '</TD><TD style="width: 25%;"><input type="text" name="nombre_mat" onChange="" id="nombre_mat" value="'.$nombre_mat.'"  maxlength="50" size="25">';

			$stock_min=trim($row["stock_min"]);
			$stock_min2=$stock_min*$c_uni_sal;
			$value =$value. "</TD><TD style='width: 25%;'>";
			$value =$value. '<input disabled type="hidden" name="id_m" id="id_m" value="'.$id_m.'"  maxlength="10" size="5">
			<input disabled type="hidden" name="min" id="min" value="'.$stock_min2.'"  maxlength="10" size="5">';
			
			if($sil==1){
				$cant_mov=trim($row["cant_mov"]);
				
				//$stock=trim($row["stock"]);
				$camp1=explode('.',$cant_mov/$c_uni_sal);
				$camp2=$cant_mov%$c_uni_sal;
			}
			
			
			//$value =$value. "</TD><TD>";
			if($abreviatura!=$us_abre){
				$value = $value. '<div  style="width: 100%;float:center;"><div  style="width: 50%;float:left;">
				<input disabled type="hidden" name="cantNew" id="cantNew" value="0"  maxlength="10" size="5">
				<input  type="text" onKeyPress="return validar_numeros(event);" onmousedown="habili(\''.$id_mat.'\');"onmouseover="habili(\''.$id_mat.'\');" onKeyUp="calcuSal(\''.$id_mat.'\',\''.$abreviatura.'\',\''.$us_abre.'\');"  onchange="validar_can_movimien_dos(\''.$id_mat.'\',\''.$cantindice.'\',\''.$c_uni_sal.'\',\''.$abreviatura.'\',\''.$us_abre.'\');" name="cant" id="cant"  maxlength="5" size="5" value="'.$camp1[0].'">'.strtolower($abreviatura).'</div>';
			
				
				
				$value = $value .'<div  style="width:  50%;float:right;">
				<input  type="text" onKeyPress="return validar_numeros(event);" onKeyUp="calcuSal02(\''.$id_mat.'\',\''.$abreviatura.'\',\''.$us_abre.'\');"  onchange="validar_can_movimien_dos(\''.$id_mat.'\',\''.$cantindice.'\',\''.$c_uni_sal.'\',\''.$abreviatura.'\',\''.$us_abre.'\');" name="cantabre" id="cantabre" value="'.$camp2.'"  maxlength="20" size="4">'.strtolower($us_abre).'</div>';
			}else{
			
				$value = $value. '<div  style="width: 100%;float:center;"><div  style="width: 90%;float:left;">
				<input disabled type="hidden" name="cantNew" id="cantNew" value="0"  maxlength="10" size="5">
				<input  type="text" onKeyPress="return validar_numeros(event);" onmousedown="habili(\''.$id_mat.'\');"onmouseover="habili(\''.$id_mat.'\');" onKeyUp="calcuSal(\''.$id_mat.'\',\''.$abreviatura.'\',\''.$us_abre.'\');"  onchange="validar_can_movimien_dos(\''.$id_mat.'\',\''.$cantindice.'\',\''.$c_uni_sal.'\',\''.$abreviatura.'\',\''.$us_abre.'\');" name="cant" id="cant"  maxlength="5" size="5" value="'.$camp1[0].'">'.strtolower($abreviatura).'</div>';
			
			
			}
			$cantindice++;
		
			$stock=trim($row["stock"]);
			$stock1=explode('.',$stock/$c_uni_sal);
			$stock2=$stock%$c_uni_sal;
			$value =$value. "</TD><TD style='width: 25%;'>";
			$value = $value.'<input disabled type="hidden" name="cent" id="cent" value="'.$c_uni_ent.'"  maxlength="10" size="5">
			<input disabled type="hidden" name="stockgen" id="stockgen" value="'.$stock.'"  maxlength="10" size="5">
			<input disabled type="hidden" name="csal" id="csal" value="'.$c_uni_sal.'"  maxlength="10" size="5">';
			if($abreviatura!=$us_abre){
				$value = $value.'<div  style="width:100%;float:center;"><div  style="width: 50%;float:left;">	
				<input disabled style="text-align:center;color:cian;text-shadow: #C3C3C3 10px 10px 10px ;" border="0" type="text" title="'.$c_uni_ent.' '.$abreviatura.' = '.$c_uni_sal.' '.$us_abre.'" onKeyPress="return validar_numeros(event)" name="stockver" id="stock" value="'.$stock1[0].'"  maxlength="20" size="6">'.strtolower($abreviatura).'</div>';
			
				
				$value =$value. "";
				$value = $value .'<div  style="width:  50%;float:right;">
				<input disabled style="text-align:center;color:cian;text-shadow: #C3C3C3 10px 10px 10px ;" border="0" type="text" onKeyPress="return validar_numeros(event)" name="stock2" id="stock2" value="'.$stock2.'"  maxlength="20" size="6">'.strtolower($us_abre).'</div>';
			}else{
				$value = $value.'<div  style="width:100%;float:center;"><div  style="width: 90%;float:left;">	
				<input disabled style="text-align:center;color:cian;text-shadow: #C3C3C3 10px 10px 10px ;" border="0" type="text" title="'.$c_uni_ent.' '.$abreviatura.' = '.$c_uni_sal.' '.$us_abre.'" onKeyPress="return validar_numeros(event)" name="stockver" id="stock" value="'.$stock1[0].'"  maxlength="20" size="6">'.strtolower($abreviatura).'</div>';
			
			
			}
		$value =$value. '</TD><TD style="width: 15%;"><input disabled type="text" onKeyPress="return validar_numeros(event)" name="minver" id="minver" value="'.$stock_min.'"  maxlength="10" size="5">'.strtolower($abreviatura).'</TD>';
								
		$value =$value. "<TR></TABLE>";
		echo $value;
	}else{
		echo '<table width="97%" cellspacing="1" cellpadding="1" border="0" align="CENTER">
				<tr>
					<td style="width: 10%;">
						<input id="numero_mat" onChange="validarmat_padre_mov_mat02();" type="text" size="5" maxlength="10" value="" name="numero_mat">
					</td>
					<td style="width: 25%;">
						  <input id="nombre_mat" onChange="" type="text" size="25" maxlength="50" value="" name="nombre_mat">
					</td>
					<td style="width: 25%;">
						<input type="text" size="25" maxlength="30"  disabled>
					</td>
					<td style="width: 25%;">
						<input type="text" size="25" maxlength="30"  disabled>
					</td>
					<td style="width: 15%;">
						<input id="minver" type="text" size="5" maxlength="10" value="0" name="minver" onkeypress="return validar_numeros(event)" disabled="">
					
					</td>
				</tr>

			</table>';
	
	
	}					
}

function validarSQL($acceso,$sql){
	if($acceso->objeto->validarSql($sql)==true)
		return 'true';
	else{
		return 'false';
	}
}
function camposRep2($acceso,$tabla){
	$manejador=$acceso->objeto->getManejador();
	$cad="";
	$primero=false;
	for($i=1;$i<count($tabla);$i++)
	{
		$table=$tabla[$i];
		$acceso->objeto->ejecutarSql("select * from $table");
		$num=$acceso->objeto->num_fields();
		for($j=0;$j<$num;$j++)
		{
			$meta = $acceso->objeto->fetch_field($j);
			if($manejador=="MySql")
			{
				if($primero==false)
					$cad='<option selected="selected" value="'.$table.'.'.$meta->name.'">'.$table.'.'.$meta->name.'</option>';
				else
					$cad.='<option value="'.$table.'.'.$meta->name.'">'.$table.'.'.$meta->name.'</option>';
			}
			else if($manejador=="Postgres"){
				if($primero==false)
					$cad='<option selected="selected" value="'.$table.'.'.$meta.'">'.$table.'.'.$meta.'</option>';
				else
					$cad.='<option value="'.$table.'.'.$meta.'">'.$table.'.'.$meta.'</option>';
			}
			
			$primero=true;
		}
	}
	return $cad;
}
//retorna los datos de un perfil para saber a que modulos tiene acceso

function traerModulo($acceso,$dato){
	$cadena="";
	while($row=row($acceso)){				
		$cadena=$cadena.trim($row[$dato]).','.trim($row[2]).','.trim($row[3]).','.trim($row[4]).'=@';
	}
	return $cadena;
}
///////////////////////////////////////////RICARDO /////////////////////////////
function traerLisMatProv($acceso,$dato){
	$cadena="";
	//echo "select id_mat from mat_prov where id_prov='$dato'";
	$acceso->objeto->ejecutarSql("select id_mat from mat_prov where id_prov='$dato'");
	while($row=row($acceso)){				
		$cadena=$cadena.trim($row['id_mat']).'=@';
	}
	return $cadena;
}
function traeValDep($acceso,$dato){
	$cadena="";
	
	//echo "select id_mat from mat_prov where id_prov='$dato'";
	$acceso->objeto->ejecutarSql("select tipo_mov from movimiento where id_mov='$dato'");
	if($row=row($acceso)){				
		$cadena=$cadena.trim($row['tipo_mov']);
	}
	return $cadena;
}
function traerLisPedido($acceso,$dato){
	$cadena="";
	//echo "select id_mat from mat_prov where id_prov='$dato'";
	$acceso->objeto->ejecutarSql("select id_mat,id_ped,cant_ped,cant_ent,precio from mat_ped where id_ped='$dato'");
	while($row=row($acceso)){				
		$cadena=$cadena.trim($row['id_mat'].','.$row['id_ped'].','.$row['cant_ped'].','.$row['cant_ent'].','.$row['precio']).'=@';
	}
	return $cadena;
}
function traerLisInventario($acceso,$dato){
	$cadena="";
	//echo "select id_mat from mat_prov where id_prov='$dato'";
	$acceso->objeto->ejecutarSql("select id_mat,id_inv,cant_sist,cant_real,justi_inv from inventario_materiales where id_inv='$dato'");
	while($row=row($acceso)){				
		$cadena=$cadena.trim($row['id_mat'].','.$row['id_inv'].','.$row['cant_sist'].','.$row['cant_real'].','.$row['justi_inv']).'=@';
	}
	return $cadena;
}

?>