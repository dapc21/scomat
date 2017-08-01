<?php
require('../include/FPDF/fpdf.php');

require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 


$desde = formatfecha($_GET['desde']);
$hasta = formatfecha($_GET['hasta']);


$id_f=$_GET['id_franq'];
session_start();
	//$_SESSION["id_franq"] = $id_f; 
	
	if($id_f!='0'){
		$acceso->objeto->ejecutarSql("SELECT nombre_franq FROM franquicia where id_franq='$id_f' ");
		if($row=row($acceso)){
			$nombre_franq=trim($row["nombre_franq"]);
		}
		$titulo_cierre="RESUMEN TECNICO DE $nombre_franq";
	}
	else{
		$titulo_cierre='RESUMEN TECNICO GENERAL';
	}
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$logo=logo();
		$ancho_logo=ancho_logo();
		$direc_fiscal=direc_fiscal();
		$telef_emp=telef_emp();
		
		$this->Image("../imagenes/$logo",15,10,$ancho_logo);
		$this->SetFont('Arial','',12);
		$this->SetXY(70,15)	;
		$this->MultiCell(190,5,nombre_empresa(),'0','L');
	//	$this->MultiCell(190,5,"CABLE, C.A.",'0','L');
		$this->SetFont('Arial','',10);
		$this->SetX(70)	;
		$this->MultiCell(190,5,strtoupper(_(tipo_serv())),'0','L');
		//$this->Ln(8);
	}
	
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
		$this->SetFont('Arial','B',8);
		$this->SetX(133);
		$this->Cell(12,5,strtoupper(_('fecha')).": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).": ",0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
	}
	//Titulo del reporte
	function Titulo($titulo_cierre)
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->SetX(70)	;
		$this->MultiCell(190,7,strtoupper(_("$titulo_cierre")),'0','L');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,70,25,20,20,25,80);
		$header=array(strtoupper(_('nro')),strtoupper(_('Estacion de trabajo')),strtoupper(_('reporte z')),strtoupper(_('fecha')),strtoupper(_('hora')),strtoupper(_('TOTAL')),strtoupper(_('OBSERVACION')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		return $w;
	}
	//muestra el listado de los reportes 
	function ordenes($acceso,$desde,$hasta,$id_f)
	{
		
		if($id_f!='0'){
			$consult=" and  id_franq='$id_f'";
			$consult_g=" and  (id_franq='$id_f' or id_franq='0') ";
			$consult_fw=" where id_franq='$id_f'";
		}
		else{
		//	echo ":$id_f:";
			$consult_g=" and  id_franq='0'";
		}
		
		if($fecha==""){
			$fecha=date("Y-m-d");
			//c
		}
		else{
			$fecha=formatfecha($fecha);
		}
		$right=10;
			
		//$this->Ln(2);
			
			
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('RESUMEN POR FRANQUICIAS')),"0",0,"L");
			$right=10;
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell(50,6,strtoupper(_("Franquicia")),"0",0,"L");
				$dato=lectura($acceso,"SELECT * FROM statuscont WHERE  status='ACTIVO'");
				for($j=0;$j<count($dato);$j++){
						$nombrestatus=substr(trim($dato[$j]["nombrestatus"]),0,13);
						$this->Cell(25,6,$nombrestatus,"0",0,"L");
				}
				$this->Cell(25,6,strtoupper(_("total")),"0",0,"L");
				
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato_franq=lectura($acceso,"SELECT *FROM franquicia $consult_fw order by id_franq ");
			$suma_s=array();
				$suma=0;
			for($k=0;$k<count($dato_franq);$k++){
				$id_franq=trim($dato_franq[$k]["id_franq"]);
				$nombre_franq=trim($dato_franq[$k]["nombre_franq"]);
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','',7);
				$this->Cell(50,4,substr($nombre_franq,0,13),"0",0,"L");
				for($j=0;$j<count($dato);$j++){
						$nombrestatus=trim($dato[$j]["nombrestatus"]);
						$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_contrato_status where  status_contrato='$nombrestatus' and id_franq='$id_franq'");
						$row=row($acceso);
						$cant=trim($row["cant"]);
						$this->Cell(25,4," $cant","0",0,"L");
						$suma+=$cant;
							$suma_s[$nombrestatus]=$suma_s[$nombrestatus]+$cant;
				}
				$this->SetFont('Arial','B',7);
					$this->Cell(25,4,"$suma","0",0,"L");
			}
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',7);
						$this->Cell(50,5,"TOTAL","0",0,"L");
				
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]["nombrestatus"]);
							$cant=$suma_s[$nombrestatus];
							$this->Cell(25,5," $cant","0",0,"L");
							
					}
		/*
		
		$this->Ln(8);
			
		
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen de clientes por tipos de servicios')),"0",0,"L");
			$right=10;
			$this->SetX($right)	;
			
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell(50,6,strtoupper(_("tipo de servicio")),"0",0,"L");
				
				$dato=lectura($acceso,"SELECT * FROM statuscont WHERE  status='ACTIVO'");
				for($j=0;$j<count($dato);$j++){
						$nombrestatus=trim($dato[$j]["nombrestatus"]);
						$this->Cell(25,6,substr($nombrestatus,0,13),"0",0,"L");
				}
				$this->Cell(25,6,strtoupper(_("total")),"0",0,"L");
				$tipo_serv=lectura($acceso,"SELECT * FROM tipo_servicio WHERE  status_servicio='ACTIVO'");
				
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
		 $dato_franq=lectura($acceso,"SELECT *FROM franquicia $consult_fw order by id_franq ");
			
				$suma_s=array();
				$suma=0;
				for($ij=0;$ij<count($tipo_serv);$ij++){
					$id_tipo_servicio=trim($tipo_serv[$ij]["id_tipo_servicio"]);
					$tipo_servicio=trim($tipo_serv[$ij]["tipo_servicio"]);
					$this->Ln();
					$this->SetX($right);
					$this->SetFont('Arial','',7);
					$this->Cell(50,4,$tipo_servicio,"0",0,"L");
					$suma=0;
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]["nombrestatus"]);
							
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_servicio_status where id_tipo_servicio='$id_tipo_servicio' and status_contrato='$nombrestatus' ");
							$row=row($acceso);
							$cant=trim($row["cant"]);
							$this->Cell(25,4," $cant","0",0,"L");
							$suma+=$cant;
							$suma_s[$nombrestatus]=$suma_s[$nombrestatus]+$cant;
					}
					
					$this->SetFont('Arial','B',7);
					$this->Cell(25,4,"$suma","0",0,"L");
				}
			
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',7);
						$this->Cell(50,5,"TOTAL","0",0,"L");
					
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]["nombrestatus"]);
							$cant=$suma_s[$nombrestatus];
							$this->Cell(25,5," $cant","0",0,"L");
					}
		*/
			/*
		$this->Ln(4);
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_('resumen de ordenes de servicios por franquicias')),"0",0,"L");
			$right=10;
		*/
		
		if($id_f=='0'){
			
			
			$this->Ln(10);
				$this->SetX($right);
				$this->SetFont('Arial','BIU',9);
				$this->Cell(50,6,strtoupper(_("resumen de ordenes de servicios general")),"0",0,"L");

		$this->SetX($right)	;

				$dato=array("CREADO","IMPRESO","FINALIZADO","DEVUELTA","CANCELADA");
				$fechas=array("fecha_orden","fecha_imp","fecha_cierre","fecha_dev","fecha_canc");
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell(50,6,strtoupper(_("detalle orden")),"0",0,"L");
				$this->Cell(40,6,strtoupper(_("Tipo de orden")),"0",0,"L");
				for($j=0;$j<count($dato);$j++){
						$nombrestatus=trim($dato[$j]);
						$this->Cell(30,6,substr($nombrestatus,0,13),"0",0,"C");
				}
				
				$this->Cell(30,6,strtoupper(_("TOTAL")),"0",0,"L");
				
				
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
				
			//	echo "SELECT * FROM vista_detalleorden WHERE  status_tipord='ORDEN'";
				$tipo_serv=lectura($acceso,"SELECT * FROM vista_detalleorden WHERE  status_tipord='ORDEN' ORDER BY nombre_tipo_orden");
			
				$suma_s=array();
				$suma_s1=array();
				$suma=0;
				$suma1=0;
				for($ij=0;$ij<count($tipo_serv);$ij++){
					$id_det_orden=trim($tipo_serv[$ij]["id_det_orden"]);
					$nombre_det_orden=utf8_decode(trim($tipo_serv[$ij]["nombre_det_orden"]));
					$nombre_tipo_orden=utf8_decode(trim($tipo_serv[$ij]["nombre_tipo_orden"]));
					$this->Ln();
					$this->SetX($right);
					$this->SetFont('Arial','',7);
					
					$this->Cell(50,4,$nombre_det_orden,"0",0,"L");
					$this->Cell(40,4,$nombre_tipo_orden,"0",0,"L");
					$suma=0;
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$fecha_orden=$fechas[$j];
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_det_orden='$id_det_orden'  and $fecha_orden between '$desde' and '$hasta' ");
							$row=row($acceso);
							$cant1=trim($row["cant"]);
							$this->Cell(15,4," $cant1","R",0,"L");
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where   id_det_orden='$id_det_orden' AND status_orden='$nombrestatus'");
							$row=row($acceso);
							$cant=trim($row["cant"]);
							$this->Cell(15,4," $cant","0",0,"L");
							
							$suma+=$cant;
							$suma_s[$nombrestatus]=$suma_s[$nombrestatus]+$cant;
					}
					
					$this->SetFont('Arial','B',7);
					$this->Cell(15,4,"$suma","0",0,"L");
					//$this->Cell(15,4,"$suma1","0",0,"L");
				}
			
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',7);
						$this->Cell(90,5,"TOTAL","0",0,"L");
					
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$cant1=$suma_s1[$nombrestatus];
							$this->Cell(15,5," $cant1","0",0,"L");
							
							$cant=$suma_s[$nombrestatus];
							$this->Cell(15,5," $cant","0",0,"L");
							
					}
				/*	
				$this->Ln(8);	
				$this->SetFont('Arial','B',8);
				$this->Cell(15,4,"NOTA: LA PRIMERA COLUMNA DE CADA ESTATUS REPRESENTA LO QUE SE HIZO Y LA SEGUNDA LO QUE QUEDA ACTUALMENTE","0",0,"L");	
		*/
		
			//$this->AddPage('L','letter');
		$this->Ln(10);
			
			
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_("resumen de RECLAMOS de servicios GENERAL ")),"0",0,"L");
			$right=10;
			$this->SetX($right)	;
			
				$dato=array("CREADO","IMPRESO","FINALIZADO","DEVUELTA","CANCELADA");
				$fechas=array("fecha_orden","fecha_imp","fecha_cierre","fecha_dev","fecha_canc");
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell(50,6,strtoupper(_("detalle orden")),"0",0,"L");
				$this->Cell(40,6,strtoupper(_("Tipo de orden")),"0",0,"L");
				for($j=0;$j<count($dato);$j++){
						$nombrestatus=trim($dato[$j]);
						$this->Cell(30,6,substr($nombrestatus,0,13),"0",0,"C");
				}
				
				$this->Cell(30,6,strtoupper(_("TOTAL")),"0",0,"L");
				
				
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
				
			//	echo "SELECT * FROM vista_detalleorden WHERE  status_tipord='ORDEN'";
				$tipo_serv=lectura($acceso,"SELECT * FROM vista_detalleorden WHERE  status_tipord='RECLAMO' ORDER BY nombre_tipo_orden");
			
				$suma_s=array();
				$suma_s1=array();
				$suma=0;
				$suma1=0;
				for($ij=0;$ij<count($tipo_serv);$ij++){
					$id_det_orden=trim($tipo_serv[$ij]["id_det_orden"]);
					$nombre_det_orden=utf8_decode(trim($tipo_serv[$ij]["nombre_det_orden"]));
					$nombre_tipo_orden=utf8_decode(trim($tipo_serv[$ij]["nombre_tipo_orden"]));
					$this->Ln();
					$this->SetX($right);
					$this->SetFont('Arial','',7);
					
					$this->Cell(50,4,$nombre_det_orden,"0",0,"L");
					$this->Cell(40,4,$nombre_tipo_orden,"0",0,"L");
					$suma=0;
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$fecha_orden=$fechas[$j];
							//echo "SELECT count(*) as cant FROM vista_orden where id_det_orden='$id_det_orden'  and $fecha_orden between '$desde' and '$hasta' ";
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where   id_det_orden='$id_det_orden'  and $fecha_orden between '$desde' and '$hasta' ");
							$row=row($acceso);
							$cant1=trim($row["cant"]);
							$this->Cell(15,4," $cant1","R",0,"L");
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where   id_det_orden='$id_det_orden' AND status_orden='$nombrestatus'");
							$row=row($acceso);
							$cant=trim($row["cant"]);
							$this->Cell(15,4," $cant","0",0,"L");
							
							$suma+=$cant;
							$suma_s[$nombrestatus]=$suma_s[$nombrestatus]+$cant;
					}
					
					$this->SetFont('Arial','B',7);
					$this->Cell(15,4,"$suma","0",0,"L");
					//$this->Cell(15,4,"$suma1","0",0,"L");
				}
			
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',7);
						$this->Cell(90,5,"TOTAL","0",0,"L");
					
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$cant1=$suma_s1[$nombrestatus];
							$this->Cell(15,5," $cant1","0",0,"L");
							
							$cant=$suma_s[$nombrestatus];
							$this->Cell(15,5," $cant","0",0,"L");
							
					}
					
					
					
		}//IF GENERAL
		
		$dato_franq=lectura($acceso,"SELECT *FROM franquicia  $consult_fw  order by id_franq ");
			$suma_s=array();
				$suma=0;
			for($k=0;$k<count($dato_franq);$k++){
				$id_franq=trim($dato_franq[$k]["id_franq"]);
				$nombre_franq=trim($dato_franq[$k]["nombre_franq"]);
				$this->Ln(10);
				$this->SetX($right);
				$this->SetFont('Arial','BIU',9);
				$this->Cell(50,6,strtoupper(_("resumen de ordenes de servicios franquicia $nombre_franq")),"0",0,"L");

		$this->SetX($right)	;

				$dato=array("CREADO","IMPRESO","FINALIZADO","DEVUELTA","CANCELADA");
				$fechas=array("fecha_orden","fecha_imp","fecha_cierre","fecha_dev","fecha_canc");
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell(50,6,strtoupper(_("detalle orden")),"0",0,"L");
				$this->Cell(40,6,strtoupper(_("Tipo de orden")),"0",0,"L");
				for($j=0;$j<count($dato);$j++){
						$nombrestatus=trim($dato[$j]);
						$this->Cell(30,6,substr($nombrestatus,0,13),"0",0,"C");
				}
				
				$this->Cell(30,6,strtoupper(_("TOTAL")),"0",0,"L");
				
				
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
				
			//	echo "SELECT * FROM vista_detalleorden WHERE  status_tipord='ORDEN'";
				$tipo_serv=lectura($acceso,"SELECT * FROM vista_detalleorden WHERE  status_tipord='ORDEN' ORDER BY nombre_tipo_orden");
			
				$suma_s=array();
				$suma_s1=array();
				$suma=0;
				$suma1=0;
				for($ij=0;$ij<count($tipo_serv);$ij++){
					$id_det_orden=trim($tipo_serv[$ij]["id_det_orden"]);
					$nombre_det_orden=utf8_decode(trim($tipo_serv[$ij]["nombre_det_orden"]));
					$nombre_tipo_orden=utf8_decode(trim($tipo_serv[$ij]["nombre_tipo_orden"]));
					$this->Ln();
					$this->SetX($right);
					$this->SetFont('Arial','',7);
					
					$this->Cell(50,4,$nombre_det_orden,"0",0,"L");
					$this->Cell(40,4,$nombre_tipo_orden,"0",0,"L");
					$suma=0;
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$fecha_orden=$fechas[$j];
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and id_det_orden='$id_det_orden'  and $fecha_orden between '$desde' and '$hasta' ");
							$row=row($acceso);
							$cant1=trim($row["cant"]);
							$this->Cell(15,4," $cant1","R",0,"L");
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where id_franq='$id_franq' and  id_det_orden='$id_det_orden' AND status_orden='$nombrestatus'");
							$row=row($acceso);
							$cant=trim($row["cant"]);
							$this->Cell(15,4," $cant","0",0,"L");
							
							$suma+=$cant;
							$suma_s[$nombrestatus]=$suma_s[$nombrestatus]+$cant;
					}
					
					$this->SetFont('Arial','B',7);
					$this->Cell(15,4,"$suma","0",0,"L");
					//$this->Cell(15,4,"$suma1","0",0,"L");
				}
			
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',7);
						$this->Cell(90,5,"TOTAL","0",0,"L");
					
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$cant1=$suma_s1[$nombrestatus];
							$this->Cell(15,5," $cant1","0",0,"L");
							
							$cant=$suma_s[$nombrestatus];
							$this->Cell(15,5," $cant","0",0,"L");
							
					}
				/*	
				$this->Ln(8);	
				$this->SetFont('Arial','B',8);
				$this->Cell(15,4,"NOTA: LA PRIMERA COLUMNA DE CADA ESTATUS REPRESENTA LO QUE SE HIZO Y LA SEGUNDA LO QUE QUEDA ACTUALMENTE","0",0,"L");	
		*/
		
			//$this->AddPage('L','letter');
		$this->Ln(10);
			
			
			$this->SetFont('Arial','BIU',9);
			$this->Cell($right,6,strtoupper(_("resumen de RECLAMOS de servicios  franquicia $nombre_franq ")),"0",0,"L");
			$right=10;
			$this->SetX($right)	;
			
				$dato=array("CREADO","IMPRESO","FINALIZADO","DEVUELTA","CANCELADA");
				$fechas=array("fecha_orden","fecha_imp","fecha_cierre","fecha_dev","fecha_canc");
				$this->Ln();
				$this->SetX($right);
				$this->SetFont('Arial','B',7);
				$this->Cell(50,6,strtoupper(_("detalle orden")),"0",0,"L");
				$this->Cell(40,6,strtoupper(_("Tipo de orden")),"0",0,"L");
				for($j=0;$j<count($dato);$j++){
						$nombrestatus=trim($dato[$j]);
						$this->Cell(30,6,substr($nombrestatus,0,13),"0",0,"C");
				}
				
				$this->Cell(30,6,strtoupper(_("TOTAL")),"0",0,"L");
				
				
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			
				
			//	echo "SELECT * FROM vista_detalleorden WHERE  status_tipord='ORDEN'";
				$tipo_serv=lectura($acceso,"SELECT * FROM vista_detalleorden WHERE  status_tipord='RECLAMO' ORDER BY nombre_tipo_orden");
			
				$suma_s=array();
				$suma_s1=array();
				$suma=0;
				$suma1=0;
				for($ij=0;$ij<count($tipo_serv);$ij++){
					$id_det_orden=trim($tipo_serv[$ij]["id_det_orden"]);
					$nombre_det_orden=utf8_decode(trim($tipo_serv[$ij]["nombre_det_orden"]));
					$nombre_tipo_orden=utf8_decode(trim($tipo_serv[$ij]["nombre_tipo_orden"]));
					$this->Ln();
					$this->SetX($right);
					$this->SetFont('Arial','',7);
					
					$this->Cell(50,4,$nombre_det_orden,"0",0,"L");
					$this->Cell(40,4,$nombre_tipo_orden,"0",0,"L");
					$suma=0;
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$fecha_orden=$fechas[$j];
							//echo "SELECT count(*) as cant FROM vista_orden where id_det_orden='$id_det_orden'  and $fecha_orden between '$desde' and '$hasta' ";
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_franq='$id_franq' and id_det_orden='$id_det_orden'  and $fecha_orden between '$desde' and '$hasta' ");
							$row=row($acceso);
							$cant1=trim($row["cant"]);
							$this->Cell(15,4," $cant1","R",0,"L");
							
							$suma_s1[$nombrestatus]=$suma_s1[$nombrestatus]+$cant1;
							$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM vista_orden where  id_franq='$id_franq' and id_det_orden='$id_det_orden' AND status_orden='$nombrestatus'");
							$row=row($acceso);
							$cant=trim($row["cant"]);
							$this->Cell(15,4," $cant","0",0,"L");
							
							$suma+=$cant;
							$suma_s[$nombrestatus]=$suma_s[$nombrestatus]+$cant;
					}
					
					$this->SetFont('Arial','B',7);
					$this->Cell(15,4,"$suma","0",0,"L");
					//$this->Cell(15,4,"$suma1","0",0,"L");
				}
			
			
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX($right);
			$this->Cell(45,1,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------","0",0,"L");
			$this->Ln();
						$this->SetX($right);
						$this->SetFont('Arial','B',7);
						$this->Cell(90,5,"TOTAL","0",0,"L");
					
					for($j=0;$j<count($dato);$j++){
							$nombrestatus=trim($dato[$j]);
							$cant1=$suma_s1[$nombrestatus];
							$this->Cell(15,5," $cant1","0",0,"L");
							
							$cant=$suma_s[$nombrestatus];
							$this->Cell(15,5," $cant","0",0,"L");
							
					}
				}	
				$this->Ln(8);	
				$this->SetFont('Arial','B',8);
				$this->Cell(15,4,"NOTA: LA PRIMERA COLUMNA DE CADA ESTATUS REPRESENTA LO QUE SE HIZO Y LA SEGUNDA LO QUE QUEDA ACTUALMENTE","0",0,"L");	
		
	}
	function Footer()
	{
		//$this->Image('../imagenes/pie.jpg',15,250,170);
		$this->AliasNbPages();
		$this->SetY(-20);
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	}
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,15);
//agrega una nueva pagina
$pdf->AddPage('L','letter');
$pdf->Titulo($titulo_cierre);

$pdf->ordenes($acceso,$desde,$hasta,$id_f);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 