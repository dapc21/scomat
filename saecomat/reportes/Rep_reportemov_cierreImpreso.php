<?php
require('../include/FPDF/fpdf.php');
require_once "../procesos.php";





$d_dep= $_GET['id_dep'];
$desde= formatfecha($_GET['desde']);
$hasta= formatfecha($_GET['hasta']);

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
		$this->MultiCell(190,7,strtoupper(_('historial de movimientos acumulados')),'0','C');
		
	}
	//muestra los titulos de los campos de los reportes
	function TituloCampos()
	{
		$this->Ln();
		$this->SetFillColor(244,249,255);
		$this->SetDrawColor(225,240,255);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(10,15,51,26,26,26,26);//12
		$header=array('#',strtoupper(_('num mat')),strtoupper(_('nombre mat')),strtoupper(_('stock ant')),strtoupper(_('entrada')),strtoupper(_('salida')),strtoupper(_('stock act.')));
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
	function Cuerpo($acceso,$id_dep,$desde,$hasta)
	{
				
		$campos="id_m,numero_mat,nombre_mat,c_uni_ent,c_uni_sal,
		(select sum(cant_mov) from vista_mov_materiales where tipo_ent_sal='SALIDA' and id_dep='$id_dep' and  vista_mov_materiales.fecha_ent_sal  between '$desde' and '$hasta' and vista_matpadre.id_m=vista_mov_materiales.id_m) as salida, 
		(select sum(cant_mov) from vista_mov_materiales where tipo_ent_sal='ENTRADA' and id_dep='$id_dep' and  vista_mov_materiales.fecha_ent_sal  between '$desde' and '$hasta' and vista_matpadre.id_m=vista_mov_materiales.id_m) as entrada, 
		(select sum(stock) from materiales where id_dep='$id_dep' and materiales.id_m=vista_matpadre.id_m) as stock 
		";

		$where="
		(select sum(cant_mov) from vista_mov_materiales where tipo_ent_sal='SALIDA' and id_dep='$id_dep' and  vista_mov_materiales.fecha_ent_sal  between '$desde' and '$hasta' and vista_matpadre.id_m=vista_mov_materiales.id_m)>0 or 
		(select sum(cant_mov) from vista_mov_materiales where tipo_ent_sal='ENTRADA' and id_dep='$id_dep' and  vista_mov_materiales.fecha_ent_sal  between '$desde' and '$hasta' and vista_matpadre.id_m=vista_mov_materiales.id_m)>0
		";

		$sql="select $campos from vista_matpadre where $where order by numero_mat";


		$acceso1=conexion();
		$acceso2=conexion();
		
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
		$acceso2->objeto->ejecutarSql("select * from deposito WHERE id_dep='$id_dep' LIMIT 1 offset 0");
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(225,240,255);
		$this->SetTextColor(0);
		
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
	//	$this->Cell(180,5,"DATOS GENERALES",1,0,'J',0);
		//$this->Ln();
		
		if($row=row($acceso2))
		{
			
			
			
			$this->SetX(15);
			$this->SetFont('Arial','B',9);
			
			
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
		$this->Cell(180,5,strtoupper(_("movimientos de materiales")),1,0,'J',0);
		

			//$this->Ln();

		$w=$this->TituloCampos();
	//	$acceso->objeto->ejecutarSql("SELECT *FROM vista_movimiento_mov_mat WHERE (id_dep='$id_dep' and fecha_ent_sal>='$desde' and fecha_ent_sal<='$hasta' and id_mat='$id_mat')");
		$acceso->objeto->ejecutarSql($sql);
		//echo "$sql";
		$this->SetFont('Arial','',8);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		while ($row=row($acceso))
		{
			$id_m=trim($row["id_m"]);
			$acceso1->objeto->ejecutarSql("select abreviatura,us_abre from vista_materiales_unid where id_m='$id_m'");
			if($rows=row($acceso1)){
			
			$abre1=trim($rows["abreviatura"]);
			$abre2=trim($rows["us_abre"]);
			//echo ",$abre1,$abre2,";
			}
			$c_uni_sal=trim($row["c_uni_sal"]);
			$c_uni_ent=trim($row["c_uni_ent"]);
			
			//echo "hola";
			$this->SetX(15);
			
			$this->Cell($w[0],5,$cont,1,0,"C",$fill);
			$this->Cell($w[1],5,utf8_decode(trim($row["numero_mat"])),"1",0,"C",$fill);
			
			$this->Cell($w[2],5,substr(utf8_decode(trim($row["nombre_mat"])),0,22),1,0,"J",$fill);
			$stock=trim($row["stock"])+0;
			$stock_sal=trim($row["salida"])+0;
			$stock_ent=trim($row["entrada"])+0;
			$stock_ant=($stock+$stock_sal)-$stock_ent;
				
			$this->Trans($stock_ant,$c_uni_sal,$abre1,$abre2,26,$fill);	
			$this->Trans($stock_ent,$c_uni_sal,$abre1,$abre2,26,$fill);	
			$this->Trans($stock_sal,$c_uni_sal,$abre1,$abre2,26,$fill);	
			$this->Trans($stock,$c_uni_sal,$abre1,$abre2,26,$fill);				
			$this->SetFont('Arial','',8);		
			$this->Ln();
			$fill=!$fill;
			$cont++;
		}
		$this->SetX(15);
		$this->SetFont('Arial','B',9);
	//	$this->Cell(134,5,"Stock Final",1,0,"R",$fill);
		$this->SetFont('Arial','',8);
		//$this->Cell(34,5,$resto,1,0,"R",$fill);
		$stock=trim($resto);
	//	$this->Trans($stock,$c_uni_sal,$abre1,$abre2,46,$fill);	
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
$pdf->Cuerpo($acceso,$d_dep,$desde,$hasta);
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 