<?php
session_start(); $ini_u = $_SESSION["ini_u"];
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_orden=trim($_GET['id_orden']);
$id_gt=trim($_GET['id_gt']);
$id_franq=trim($_GET['id_franq']);
class PDF extends FPDF
{
		private $ancho_t;
		private $ancho;
		private $vacio;
		private $l;
		private $r;
		private $t;
		private $b;
		private $tbr;
		private $tbl;
		private $tblr;
		private $tb;
		private $lr;
		private $lrb;
		private $lb;
		private $rb;
		private $lrt;
		private $fondo_t;
	
	function config_style()
	{
	
		$this->SetFillColor(244,249,255);
		//$this->SetDrawColor(225,240,255);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.2);
		
		$this->ancho_t=5;
		$this->ancho=4;
		$this->fondo_t="1";
		
		$this->vacio="0";
		$this->l="L";
		$this->r="R";
		$this->t="T";
		$this->b="B";
		$this->tb="TB";
		$this->lr="LR";
		$this->lb="LB";
		$this->rb="RB";
		$this->tbr="TBR";
		$this->tbl="TBL";
		$this->lrb="LRB";
		$this->lrt="LRT";
		$this->tblr="1";
		
		
	}		
	function encabezado($acceso,$nombre_franq,$nombre_grupo){
		
		$x=7;
		$y=10;
		//echo ":$tam:";
		$cad='';
						
				$this->SetFont('Times','B',11);
                $this->SetXY($x,$y);
                $this->MultiCell(263,4,strtoupper(nombre_empresa()),'0','l');
                $this->SetFont('Times','B',10);
                $this->SetXY($x,$y);
                $this->SetFont('Arial','B',10);
                $this->MultiCell(263,4,strtoupper("Listado de Clientes para Corte por morocidad "),'0','R');
				
				$this->SetFont('Times','',10);
                $this->SetXY($x,15);
                $this->MultiCell(263,4,"Franquicia: $nombre_franq",'0','L');
                $this->SetXY($x,15);
                $this->SetFont('Arial','',10);
                $this->MultiCell(263,4,"Grupo de Trabajo: $nombre_grupo",'0','R');
				$this->Ln(4);
				
				
				
				$this->SetFillColor(244,249,255);
				$this->SetDrawColor(171,171,171);
				$this->SetLineWidth(.3);
				
				$w=array(8,22,35,15,15,17,22,22,35,72);
				$header=array(strtoupper(_('   #')),strtoupper(_('Abonado')),strtoupper(_('nombre y apellido')),strtoupper(_('DEUDA')),strtoupper(_('poste')),strtoupper(_('precinto')),strtoupper(_('celular')),strtoupper(_('telefono')),strtoupper(_('sector')),strtoupper(_('Referencia')));
				$this->SetFont('Arial','B',8);
				$this->SetX($x);
				for($k=0;$k<count($header);$k++)
					$this->Cell($w[$k],5,$header[$k],1,0,'J',1);
				$this->Ln();
				return $w;
	}		
	function orden($acceso,$id_orden,$id_gt,$id_franq){
		session_start(); $ini_u = $_SESSION["ini_u"];
		$valor=explode("=@",$id_orden);
		$tam=count($valor)-1;
		
		require_once "../Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);	
		$fecha_tc=date("Y-m-d");
		$acceso->objeto->ejecutarSql("select *from tabla_cortes where (id_tc ILIKE '$ini_u%') ORDER BY id_tc desc"); 
		$id_tc = $ini_u.verCo($acceso,"id_tc");
		
		$acceso->objeto->ejecutarSql("insert into tabla_cortes(id_tc,id_franq,fecha_tc,id_gt,obser_tc,status_tc,dato) values ('$id_tc','$id_franq','$fecha_tc','$id_gt','','REGISTRADO','')");	
		
		require_once "../Clases/orden_grupo.php";
				
		for($i=0;$i<$tam;$i++){
			
			
			$id_orden=$valor[$i];
		
			$acceso->objeto->ejecutarSql("SELECT id_det_orden FROM ordenes_tecnicos where id_orden='$id_orden' ");
			$row=row($acceso);
			$id_det_orden=trim($row['id_det_orden']);
			if($id_det_orden=="DEO00010"){
				
				$acceso->objeto->ejecutarSql("select * from orden_grupo where id_orden='$id_orden'");
				if($acceso->objeto->registros>0){
					$acceso->objeto->ejecutarSql("Update orden_grupo Set id_gt='$id_gt' Where id_orden='$id_orden'");	
				}
				else{
					$acceso->objeto->ejecutarSql("insert into orden_grupo(id_orden,id_gt) values ('$id_orden','$id_gt')");
				}

				$fecha_imp=date("Y-m-d");
				$login= $_SESSION["login"];
				$hora=date("H:i:s");
				$acceso->objeto->ejecutarSql("Update ordenes_tecnicos Set status_orden='IMPRESO',fecha_imp='$fecha_imp',login_imp='$login', hora_imp='$hora' Where id_orden='$id_orden'");

				$acceso->objeto->ejecutarSql("insert into orden_tabla_cortes(id_tc,id_orden,dato) values ('$id_tc','$id_orden','')");	
			}
		}
	
		$obj_trans->commit($acceso);	
		$this->imprimir_listado($acceso,$id_tc);
	}
	function imprimir_listado($acceso,$id_tc){
		$valor=explode("=@",$id_orden);
		$tam=count($valor)-1;
		//$tam=10;
		$x=7;
		$y=10;
		//echo ":$tam:";
		$cad='';
		
		$acceso->objeto->ejecutarSql("SELECT id_franq,id_gt FROM tabla_cortes where id_tc='$id_tc'");
		$row=row($acceso);
        $id_franq=trim($row['id_franq']);
        $id_gt=trim($row['id_gt']);
			
		$acceso->objeto->ejecutarSql("SELECT nombre_franq FROM franquicia where id_franq='$id_franq'");
		$row=row($acceso);
        $nombre_franq=utf8_decode(trim($row['nombre_franq']));
					
		$acceso->objeto->ejecutarSql("SELECT nombre_grupo FROM grupo_trabajo where id_gt='$id_gt'");
		$row=row($acceso);
        $nombre_grupo=utf8_decode(trim($row['nombre_grupo']));
		
		
		
		$w=$this->encabezado($acceso,$nombre_franq,$nombre_grupo);
		
				
				$fecha_act=date("Y-m-01");
					
			$cont=1;
			$cont_enc=1;
			$this->SetDrawColor(218,220,221);
			$this->SetLineWidth(.2);
			$this->SetFont('Arial','',8);
			$dato=lectura($acceso,"select * FROM vista_contrato_auditoria, orden_tabla_cortes,ordenes_tecnicos where orden_tabla_cortes.id_orden=ordenes_tecnicos.id_orden and vista_contrato_auditoria.id_contrato=ordenes_tecnicos.id_contrato and id_tc='$id_tc' and status_orden='IMPRESO' ");
			
		for($i=0;$i<count($dato);$i++){
			$id_contrato=trim($dato[$i]["id_contrato"]);
		
						$nro_contrato=trim($dato[$i]['nro_contrato']);
						$status_contrato=trim($dato[$i]['status_contrato']);
						$deuda=trim($dato[$i]['saldo'])+0;
						$nombre_sector=trim($dato[$i]['nombre_sector']);
						$direc_adicional=trim($dato[$i]['direc_adicional']);
						$postel=trim($dato[$i]['postel']);
						$celular=trim($dato[$i]['celular']);
						$telefono=trim($dato[$i]['telf_casa']);
						$nombrecli=utf8_decode(trim($dato[$i]['nombre'])." ".trim($dato[$i]['apellido']));
                        $precinto=utf8_decode(trim($dato[$i]['etiqueta']));
						
						$this->SetX($x);
						$this->Cell($w[0],5,$cont,"1",0,"C",$fill);
						$this->Cell($w[1],5,$nro_contrato,"1",0,"J",$fill);
						$this->Cell($w[2],5,substr(ucwords(strtolower($nombrecli)),0,23),"1",0,"J",$fill);
						$this->Cell($w[3],5,number_format($deuda+0, 2, ',', '.'),"1",0,"R",$fill);
						$this->Cell($w[4],5,$postel,"1",0,"J",$fill);
						$this->Cell($w[5],5,$precinto,"1",0,"J",$fill);
						$this->Cell($w[6],5,$celular,"1",0,"J",$fill);
						$this->Cell($w[7],5,$telefono,"1",0,"J",$fill);
						$this->Cell($w[8],5,substr(ucfirst(strtolower($nombre_sector)),0,23),"1",0,"J",$fill);
						$this->Cell($w[9],5,ucfirst(strtolower($direc_adicional)),"1",0,"J",$fill);
						$this->Ln();
               // }
				if($cont_enc==35){
					$this->AddPage('L','letter');
					$this->encabezado($acceso,$nombre_franq,$nombre_grupo);
					$this->SetFont('Arial','',8);
					$cont_enc=0;
				}
				$cont++;
				$cont_enc++;
						
				
		}
	
		$this->config_style();
		$w=array(50,25);	
		$right=50; 
		$this->Ln();
		$this->SetFont('Arial','BIU',8);
		$this->SetX($right);
		$this->Cell($right,6,strtoupper(_('RESUMEN DE LISTADO DE CORTES')),"0",0,"L");
			
		$this->Ln();
		$this->SetX($right);
		$this->SetFont('Arial','B',8);
		$this->Cell($w[0],$this->ancho_t,strtoupper(_("DESCRIPCION")),$this->tbl,0,"L",$this->fondo_t);
		$this->Cell($w[1],$this->ancho_t,strtoupper(_("CANTIDAD")),$this->tbr,0,"C",$this->fondo_t);
				
		$this->Ln();
		$this->SetFont('Arial','',8);
		$suma_t=0;
		
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM  orden_tabla_cortes,ordenes_tecnicos where orden_tabla_cortes.id_orden=ordenes_tecnicos.id_orden  AND status_orden='CREADO'  and id_tc='$id_tc' ");
					
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"ASIGNADAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM  orden_tabla_cortes,ordenes_tecnicos where orden_tabla_cortes.id_orden=ordenes_tecnicos.id_orden  AND status_orden='IMPRESO'  and id_tc='$id_tc' ");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"IMPRESAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM  orden_tabla_cortes,ordenes_tecnicos where orden_tabla_cortes.id_orden=ordenes_tecnicos.id_orden  AND status_orden='CANCELADA'  and id_tc='$id_tc' ");
					
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"CANCELADAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
					//ECHO "SELECT count(*) as cant FROM  orden_tabla_cortes,ordenes_tecnicos where orden_tabla_cortes.id_orden=ordenes_tecnicos.id_orden  AND status_orden='FINALIZADO'  and id_tc='$id_tc' ";
					$acceso->objeto->ejecutarSql("SELECT count(*) as cant FROM  orden_tabla_cortes,ordenes_tecnicos where orden_tabla_cortes.id_orden=ordenes_tecnicos.id_orden  AND status_orden='FINALIZADO'  and id_tc='$id_tc' ");
					$row=row($acceso);
					$cant=trim($row["cant"])+0;
					$suma_t+=$cant;
					$this->SetX($right);
					$this->Cell($w[0],$this->ancho,"FINALIZADAS",$this->l,0,'L');
					$this->Cell($w[1],$this->ancho,$cant,$this->r,0,'C');
					$this->Ln();
		
				
				$this->SetFont('Arial','B',8);
				$this->SetX($right);
				$this->Cell($w[0],$this->ancho_t,strtoupper(_('total')),$this->tbl,0,'J');	
				$this->Cell($w[1],$this->ancho_t,$suma_t,$this->tbr,0,'C');	
				
		

		
	}
	function Footer()
	{
		$this->AliasNbPages();
		$this->SetY(-15);
		
		$this->SetFont('Arial','B',9);
		$this->MultiCell(180,5,utf8_decode(''),'0','C');
		
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	}
}
//crea el objeto pdf
$pdf=new PDF();              
$pdf->SetAutoPageBreak(true,8);
//agrega una nueva pagina

$pdf->AddPage('L','letter');
$pdf->orden($acceso,$id_orden,$id_gt,$id_franq);

$pdf->Output('reporte.pdf','D');
?> 