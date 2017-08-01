<?php
require('../include/FPDF/fpdf.php');
require_once "../procesos.php";
$valor= $_GET['id_dep'];

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
		$this->Cell(12,5,strtoupper(_('fecha')).':',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',8);
		$this->Cell(12,5,strtoupper(_('hora')).':',0,0,'L');
		$this->SetFont('Arial','',8);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
	}
	//Titulo del reporte
	function Titulo()
	{
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(190,7, strtoupper(_('historial de movimientos')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		$this->Ln();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,15,15,42,26,26,46);//12
		$header=array(strtoupper(_('#mov')),strtoupper(_('fecha')),strtoupper(_('hora')),strtoupper(_('movimiento')),strtoupper(_('salida')),strtoupper(_('entrada')),strtoupper(_('total')));
		$this->SetFont('Arial','B',9);
		$this->SetX(15);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],6,$header[$k],1,0,'C',1);
		$this->Ln();
		return $w;
	}
	function Trans($stock,$c_uni_sal,$abre1,$abre2,$w,$fill)
	{
		if($abre1!=$abre2){					
			$stock1=explode('.',$stock/$c_uni_sal);
			$stock2=$stock%$c_uni_sal;
			$caden=$stock1[0];
			$caden2=$stock2;
			$this->SetFont('Arial','',8);			
			$this->Cell($w/3,5,$caden,1,0,"R",$fill);
			$this->SetFont('Arial','',5);
			$this->Cell($w/6,5,$abre1,1,0,"C",$fill);
			$this->SetFont('Arial','',8);
			$this->Cell($w/3,5,$caden2,1,0,"R",$fill);
			$this->SetFont('Arial','',5);
			$this->Cell($w/6,5,$abre2,1,0,"C",$fill);
		}else{
			$caden=utf8_decode(trim($stock));
			$this->SetFont('Arial','',8);	
			$this->Cell($w/1.5,5,$caden,1,0,"R",$fill);
			$this->SetFont('Arial','',5);
			$this->Cell($w/3,5,$abre1,1,0,"C",$fill);
					
		}
			
		//return $w;
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$valor)
	{
		$acceso1=conexion();
		$acceso2=conexion();
		$valor=explode("==",$valor);
		$id_dep=$valor[0];
		$desde=formatfecha($valor[1]);
		$hasta= formatfecha($valor[2]);
		$id_mat= $valor[3];
		$abre1="";
		$abre2="";
		$c_uni_ent=0;
		$c_uni_sal=0;
		$resto=0;
		
		
		
		$acceso1->objeto->ejecutarSql("select sum(cant_mov) as ent from vista_movimiento_mov_mat where tipo_ent_sal='ENTRADA' and id_mat='$id_mat' and fecha_ent_sal<'$desde'");
		$row=row($acceso1);
		$ent=trim($row["ent"])+0;
		$acceso1->objeto->ejecutarSql("select sum(cant_mov) as sal from vista_movimiento_mov_mat where  id_mov=id_mov and tipo_ent_sal='SALIDA' and id_mat='$id_mat' and fecha_ent_sal<'$desde' ");
		$row=row($acceso1);
		$sal=trim($row["sal"])+0;
		$resto=$ent-$sal;
		$acceso2->objeto->ejecutarSql("select * from vista_materiales_unid WHERE id_mat='$id_mat' LIMIT 1 offset 0");
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(225,240,255);
		$this->SetTextColor(0);
		
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(180,5,strtoupper(_("datos del material")),1,0,'J',0);
		$this->Ln();
		
		while ($row=row($acceso2))
		{
			$abre1=trim($row["abreviatura"]);
			$abre2=trim($row["us_abre"]);
			$c_uni_sal=trim($row["c_uni_sal"]);
			$c_uni_ent=trim($row["c_uni_ent"]);
			$this->SetX(15);
			$this->SetFont('Arial','B',9);
			$this->Cell(10,5,strtoupper(_('#mat')),1,0,'J',FALSE);
			$this->SetFont('Arial','',9);
			$this->Cell(20,5,utf8_decode(trim($row["numero_mat"])),1,0,'J',FALSE);
			$this->SetFont('Arial','B',9);
			$this->Cell(30,5,strtoupper(_('nombre')),1,0,'J',FALSE);
			$this->SetFont('Arial','',9);
			$this->Cell(120,5,utf8_decode(trim($row["nombre_mat"])),1,0,'J',FALSE);		
			$this->Ln();
			
			$this->SetX(15);
			$this->SetFont('Arial','B',9);
			$this->Cell(30,5,strtoupper(_('deposito')),1,0,'J',FALSE);
			$this->SetFont('Arial','',9);
			$this->Cell(60,5,utf8_decode(trim($row["nombre_dep"])),1,0,'J',FALSE);
			$this->SetFont('Arial','B',9);
			$this->Cell(25,5,strtoupper(_('fecha desde')),1,0,'J',FALSE);
			$this->SetFont('Arial','',9);
			$this->Cell(20,5,formatofecha($desde),1,0,'J',FALSE);	
			$this->SetFont('Arial','B',9);
			$this->Cell(25,5,strtoupper(_('fecha hasta')),1,0,'J',FALSE);
			$this->SetFont('Arial','',9);
			$this->Cell(20,5,formatofecha($hasta),1,0,'J',FALSE);		
		}
		$this->Ln();
		$this->Ln();
		
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(180,5,strtoupper(_("descripcion movimientos")),1,0,'J',0);
		$this->Ln();
				
		
		$fill=!$fill;		
		$this->SetX(15);
		$this->SetFont('Arial','B',7);
		$this->Cell(34,5,$c_uni_ent." ".$abre1."=".$c_uni_sal." ".$abre2,"LT",0,"L",$fill);
		$this->SetFont('Arial','B',9);
		$this->Cell(100,5,strtoupper(_("stock anterior")),"RT",0,"R",$fill);
		$this->SetFont('Arial','',8);
		//$this->Cell(34,5,$resto,1,0,"R",$fill);
		$stock=trim($resto);
		$this->Trans($stock,$c_uni_sal,$abre1,$abre2,46,$fill);			

			//$this->Ln();

		$w=$this->TituloCampos();
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_movimiento_mov_mat WHERE ( fecha_ent_sal>='$desde' and fecha_ent_sal<='$hasta' and id_mat='$id_mat')");
		
		$this->SetFont('Arial','',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$this->SetX(15);
			
			$this->Cell($w[0],5,trim($row["num_mov"]),1,0,"C",$fill);
			$this->Cell($w[1],5,utf8_decode(formatofecha(trim($row["fecha_ent_sal"]))),1,0,"C",$fill);
			$this->Cell($w[2],5,utf8_decode(trim($row["hora_ent_sal"])),"LR",0,"C",$fill);
			
			$this->Cell($w[3],5,substr(utf8_decode(trim($row["nombre_tm"])),0,22),1,0,"J",$fill);
			$stock=trim($row["cant_mov"]);
			if(trim($row["tipo_ent_sal"])!="ENTRADA"){
				$resto=$resto - $row["cant_mov"];
				//$this->Cell($w[4],5,"- ".utf8_decode(trim($row["cant_mov"])),1,0,"R",$fill);
				$this->Trans("-".$stock,$c_uni_sal,$abre1,$abre2,26,$fill);	
				//$this->Trans(0,$c_uni_sal,$abre1,$abre2,26,$fill);	
				$this->Cell($w[5],5,"",1,0,"R",$fill);
			}else{
				$resto=$resto + $row["cant_mov"];
				$this->Cell($w[4],5,"",1,0,"J",$fill);
				//$this->Trans(0,$c_uni_sal,$abre1,$abre2,46,$fill);	
				//$this->Cell($w[5],5,"".utf8_decode(trim($row["cant_mov"])),1,0,"R",$fill);
				$this->Trans($stock,$c_uni_sal,$abre1,$abre2,26,$fill);	
				
			}
			$stock=trim($resto);
			$this->Trans($stock,$c_uni_sal,$abre1,$abre2,46,$fill);				
			$this->SetFont('Arial','',8);		
			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
		$this->Cell(134,5,strtoupper(_("stock final")),1,0,"R",$fill);
		$this->SetFont('Arial','',8);
		//$this->Cell(34,5,$resto,1,0,"R",$fill);
		$stock=trim($resto);
		$this->Trans($stock,$c_uni_sal,$abre1,$abre2,46,$fill);	
		$this->SetX(15);
		$this->Cell(array_sum($w),5,'','T');
	}
	//muestra el pie de la pagina se repite en todas las paginas
	function Footer()
	{
		$this->pie_pred();
	}
}

$pdf=new PDF();
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,20);
//agrega una nueva pagina
$pdf->AddPage();
$pdf->Titulo();
$pdf->Fecha();
$pdf->Cuerpo($acceso,$valor);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 