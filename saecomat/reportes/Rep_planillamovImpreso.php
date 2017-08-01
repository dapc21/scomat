<?php
require('../include/FPDF/fpdf.php');
require_once "../procesos.php";
$id_mov=$_GET["id_mov"];
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
		$this->cabecera_esp();
		$this->Ln();
	}
	//para mostrar las fecha de impresion del reporte
	function Fecha()
	{
		$this->SetFont('Arial','B',8);
		$this->SetX(133);
		$this->Cell(12,5,strtoupper(_('fecha')).': ',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).': ',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
	}
	//Titulo del reporte
	function Titulo()
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,5,strtoupper(_('planilla de movimientos de materiales')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		$this->Ln();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,50,60,60);
		$header=array(strtoupper(_('#mat')),strtoupper(_('material')),strtoupper(_('familia')),strtoupper(_('cantidad')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],5,$header[$k],1,0,'C',1);
		$this->Ln();
		return $w;
	}
	
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$id_mov)
	{	
		$acceso1=conexion();
		$acceso2=conexion();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		
		$acceso->objeto->ejecutarSql("SELECT num_mov,login FROM movimiento where id_mov='$id_mov'");
		$row=row($acceso);
		$num_mov=trim($row["num_mov"]);
		$login=trim($row["login"]);
		
		$this->Ln();
		$acceso->objeto->ejecutarSql("select *,(SELECT tipo_mov FROM movimiento  where movimiento.referencia=a.id_mov) as destino from movimiento as a, tipo_movimiento as b  where a.id_mov='$id_mov' and a.id_tm=b.id_tm");
		$z=array(26,118,20,16);
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(array_sum($z),5,strtoupper(_("datos del movimiento        Nº $num_mov")),1,0,'J',0);
		$this->Ln();
		while ($row=row($acceso))
		{
			$id_persona=trim($row["id_persona"]);
			$this->SetX(15);
			$this->SetFont('Arial','B',9);
			$this->Cell($z[0],5,strtoupper(_('movimiento')),1,0,'J',FALSE);
			$this->SetFont('Arial','',9);
			$this->Cell($z[1],5,utf8_decode(trim($row["nombre_tm"])),1,0,'J',FALSE);
			$this->Cell($z[2],5,utf8_decode(formatofecha(trim($row["fecha_ent_sal"]))),1,0,'J',FALSE);
			$this->Cell($z[3],5,utf8_decode(trim($row["hora_ent_sal"])),1,0,'J',FALSE);
			
			$this->Ln();
			$this->SetX(15);
			$this->SetFont('Arial','B',9);
			$this->Cell($z[0],5,strtoupper(_('tipo')),1,0,'J',0);
			$this->SetFont('Arial','',9);
			$this->Cell($z[0],5,utf8_decode(trim($row["tipo_ent_sal"])),1,0,'J',FALSE);
			
			$this->SetFont('Arial','B',9);
			$this->Cell($z[0],5,strtoupper(_('deposito')),1,0,'J',0);
			$depo=$row["tipo_mov"];
			$this->SetFont('Arial','',9);
			$acceso1->objeto->ejecutarSql("select nombre_dep from deposito where id_dep='$depo' ");
			while ($row2=row($acceso1))
			{						
				$this->Cell(array_sum($z)-78,5,utf8_decode(trim($row2["nombre_dep"])),1,0,'J',FALSE);
				
			}
			$this->Ln();
			
			if($row["destino"]!=""){
				$this->SetX(15);
				$this->SetFont('Arial','B',9);
				$this->Cell($z[0],5,strtoupper(_('destino')),1,0,'J',0);
				$depo2=trim($row["destino"]);
				$this->SetFont('Arial','',9);
				$acceso1->objeto->ejecutarSql("select nombre_dep from deposito where id_dep='$depo2' ");
				while ($row2=row($acceso1))
				{						
					$this->Cell(array_sum($z)-26,5,utf8_decode(trim($row2["nombre_dep"])),1,0,'J',FALSE);
				}
				$this->Ln();
			}
			
			
			$this->SetX(15);
			$this->SetFont('Arial','B',9);
			$this->Cell(array_sum($z),5,strtoupper(_('observación')),1,1,'J',FALSE);
			//$this->Ln();
			$this->SetFont('Arial','',9);
			$this->SetX(15);
			$this->MultiCell(array_sum($z),5,utf8_decode(trim($row["observacion"])),"LR",'B',FALSE);			
			$fill=!$fill;//MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
		}		
		
		$this->SetX(15);
		$this->Cell(array_sum($z),5,'','T');
		
		////////////////////////////////////////////////////////////////////////////////
		$this->Ln();
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(array_sum($z),5,strtoupper(_("datos de materiales movidos")),1,0,'J',0);
		
		$w=$this->TituloCampos();
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_planillamov where id_mov='$id_mov'");
		$cont=1;
		$this->SetFont('Arial','',9);
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);	
		$fill=!$fill;		
		while ($row=row($acceso))
		{
			$caden="";
			$caden2="";
			$abre1="";
			$abre2="";
			$this->SetX(15);
			//$this->Cell($w[0],6,$cont,"LR",0,"C",$fill);
			$this->Cell($w[0],5,utf8_decode(trim($row["numero_mat"])),1,0,"J",$fill);
			$this->Cell($w[1],5,utf8_decode(trim($row["nombre_mat"])),1,0,"J",$fill);
			$this->Cell($w[2],5,utf8_decode(trim($row["nombre_fam"])),1,0,"J",$fill);
			$id_mat=trim($row["id_mat"]);
			$acceso2->objeto->ejecutarSql("select c_uni_sal,c_uni_ent,us_abre,abreviatura from vista_materiales_unid  where id_mat='$id_mat' LIMIT 1 offset 0");
				while ($row3=row($acceso2))
				{	
					$stock=trim($row["cant_mov"]);
					$caden='';$caden2='';$sw=0;
					if(trim($row["c_uni_ent"])!=trim($row["c_uni_sal"])){
						$stock1=explode('.',$stock/trim($row["c_uni_sal"]));
						$stock2=$stock%trim($row["c_uni_sal"]);
						//if($stock1[0]){
							$caden=$stock1[0];
					//		$sw++;
						//}
						//if($stock2!=0){
							$caden2=$stock2;
							$abre1=trim($row["abreviatura"]);
							$abre2=trim($row["us_abre"]);
						//	$sw++;
						//}
						
					}else{
						$caden=utf8_decode(trim($row["cant_mov"]));
						$abre1=trim($row["abreviatura"]);
					}
					//$this->Cell(29,5,$caden,"LR",0,"R",$fill);
					//$this->Cell(29,5,$caden2,"LR",0,"R",$fill);
					$this->Cell($w[2]/3,5,$caden,1,0,"R",$fill);
					$this->Cell($w[2]/6,5,$abre1,1,0,"C",$fill);
					$this->Cell($w[2]/3,5,$caden2,1,0,"R",$fill);
					$this->Cell($w[2]/6,5,$abre2,1,0,"C",$fill);
					
					
					//$this->Cell(array_sum($z)-26,7,utf8_decode(trim($row3["nombre_dep"])),1,0,'J',$fill);
				}
		//	$this->Cell($w[3],6,utf8_decode(trim($row["cant_mov"])),"LR",0,"J",$fill);

			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		
		$this->SetX(15);
		$this->Cell(array_sum($w),5,'','T');
		$this->Ln(2);
		$this->SetX(15);
		
		
		//$this->Cell($w[0],4,$cont-1,1,0,"J",1);
		$this->Cell(array_sum($w),4,strtoupper(_("total registros")).": ".($cont -1),1,0,"J",0);
		$this->SetFont('Arial','B',9);	
		$this->Ln(20);
		//$this->SetY(260);
		$this->SetX(15);
		$this->Cell(array_sum($w)/2,2,'________________________',0,0,'C','');
		$this->Cell(array_sum($w)/2,2,'________________________',0,1,'C','');
		$this->Ln(1);
		$this->SetX(15);
		$this->Cell(array_sum($w)/2,4,strtoupper(_('encargado')),0,0,'C','');
		$this->Cell(array_sum($w)/2,4,strtoupper(_('responsable')),0,1,'C','');
		
		session_start();
		
		
		$acceso->objeto->ejecutarSql("select nombre,apellido from vista_entidad where id_persona='$id_persona'");
		if($row=row($acceso)){
			$contraparte=utf8_decode(trim($row["nombre"])." ".trim($row["apellido"]));
		}
		
		$acceso->objeto->ejecutarSql("select nombre,apellido from personausuario where login='$login'");
		if($row=row($acceso)){
			$responsable=utf8_decode(trim($row["nombre"])." ".trim($row["apellido"]));
		}
		
		$this->SetFont('Arial','',8);
		$this->Ln(1);
		$this->SetX(15);
		$this->Cell(array_sum($w)/2,4,"($responsable)",0,0,'C','');
		$this->Cell(array_sum($w)/2,4,"($contraparte)",0,1,'C','');
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		$this->pie_pred();
	}
}

$pdf=new PDF();
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,15);
//agrega una nueva pagina
$pdf->AddPage();
$pdf->Titulo();
$pdf->Fecha();
$pdf->Cuerpo($acceso,$id_mov);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 