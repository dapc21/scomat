<?php
require('../include/JavaPrint/JavaPrint.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_orden=trim($_GET['id_orden']);
$id_gt=trim($_GET['id_gt']);
class PDF extends JavaPrint
{
	//Titulo del reporte
	function Titulo($titulo,$id_orden,$y)
	{
		//$this->Image('../imagenes/cabecera.jpg',20,10,40);
		$this->SetFont('times','',13);
		$this->SetXY(10,$y);
		$this->MultiCell(195,4,nombre_empresa(),'0','L');
		$this->SetFont('times','I',9);
		$this->SetXY(90,$y);
		$this->MultiCell(115,4,tipo_serv(),'0','R');
		
		
		$this->SetFont('times','',9);
		$this->SetTextColor(0,0,0);
		$this->SetXY(10,$y+5);
		$this->MultiCell(195,4,utf8_decode("ORDEN DE SERVICIO DE: ".$titulo),'0','L');
		$this->SetXY(90,$y+5);
		$this->SetFont('times','B',10);
		$this->MultiCell(115,4,"ORDEN NRO: $id_orden",'0','R');
		$this->SetFont('times','',9);
		$this->SetX(10);
		$this->MultiCell(195,1,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",'0','C');
		
	}
	
	//muestra el listado de los reportes 
	function orden($acceso,$id_orden,$id_gt){
		$valor=explode("=@",$id_orden);
		$tam=count($valor)-1;
		//echo ":$tam:";
		$cad='';
		for($i=0;$i<$tam;$i++){
			
			
			$id_orden=$valor[$i];
			
			require_once "../Clases/orden_grupo.php";
			$obj=new orden_grupo($id_orden,$id_gt,"f");
			$obj->modif_orden_grupo_aut($acceso);
			$fecha_imp=date("Y-m-d");
			$login= $_SESSION["login"];
			$hora=date("H:i:s");
			$acceso->objeto->ejecutarSql("Update ordenes_tecnicos Set status_orden='IMPRESO',fecha_imp='$fecha_imp',login_imp='$login', hora_imp='$hora' Where id_orden='$id_orden'");
			//$this->Titulo($titulo,$id_orden);
			//echo "<br>:".$i%2;
			if($i%2==0){
				$this->AddPage('P','carta');
				$x=5;
			}else{
				$x=145;
			}
			$this->Cuerpo($acceso,$valor[$i],$x);
		//	$this->materiales($acceso,$id_orden);
			$this->mas_datos($acceso,$id_orden);
		}
	}
	
        function Cuerpo($acceso,$id_orden,$x)
        {
                $acceso->objeto->ejecutarSql("SELECT *FROM vista_orden where id_orden='$id_orden'  LIMIT 1 offset 0");
                if($row=row($acceso)){
                        $id_tipo_orden=utf8_decode(trim($row['id_tipo_orden']));
                        $nombre_tipo_orden=utf8_decode(trim($row['nombre_tipo_orden']));
                        $nombre_det_orden=utf8_decode(trim($row['nombre_det_orden']));
                        $detalle_orden=utf8_decode(trim($row['detalle_orden']));
                        $comentario_orden=utf8_decode(trim($row['comentario_orden']));
                        
                        $this->Titulo($nombre_det_orden,$id_orden,$x);
                        $fecha_orden=formatofecha(trim($row['fecha_orden']));
                        $fecha_imp=formatofecha(trim($row['fecha_imp']));
                        $login=trim($row['login_emi']);
                        $login_imp=trim($row['login_imp']);
                        $hora_emi=trim($row['hora_emi']);
                        $hora_imp=trim($row['hora_imp']);
                        
                        //$nombre_tec=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
                        
                        $nombre_tipo_orden=utf8_decode(trim($row['nombre_tipo_orden']));
                        $nombrecli=utf8_decode(trim($row['nombrecli'])." ".trim($row['apellidocli']));
                        $etiqueta=utf8_decode(trim($row['etiqueta']));
                        $cedulacli=utf8_decode(trim($row['cedulacli']));
                        
                        $nro_contrato=trim($row['nro_contrato']);
                        $id_contrato=trim($row['id_contrato']);
                
                }
                
                $acceso->objeto->ejecutarSql("SELECT contrato_fisico,taps,pto,edificio,telefono,postel,telf_casa,telf_adic,id_persona,cod_id_persona FROM vista_contrato where id_contrato='$id_contrato'  LIMIT 1 offset 0 ");
                
                if($row=row($acceso)){
                        $postel=utf8_decode(trim($row['postel']));
                        $telefono=utf8_decode(trim($row['telefono']));
                        $telf_casa=utf8_decode(trim($row['telf_casa']));
                        $telf_adic=utf8_decode(trim($row['telf_adic']));
                        $id_persona=utf8_decode(trim($row['id_persona']));
                        $cod_id_persona=utf8_decode(trim($row['cod_id_persona']));
                        $taps=utf8_decode(trim($row['taps']));
                        $pto=utf8_decode(trim($row['pto']));
                        $contrato_fisico=utf8_decode(trim($row['contrato_fisico']));
                }
                
                
                
                        $acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM vista_cobrador where id_persona='$cod_id_persona'  LIMIT 1 offset 0 ");
                        if($row=row($acceso)){
                                $cobrador=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
                        
                        }
                        //echo "SELECT nombre,apellido FROM vista_vendedor where id_persona='$id_persona'  LIMIT 1 offset 0 ";
                        $acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM vista_vendedor where id_persona='$id_persona'  LIMIT 1 offset 0 ");
                        if($row=row($acceso)){
                                $vendedor=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
                        
                        }
                
                $acceso->objeto->ejecutarSql("SELECT numero_casa,direc_adicional,edificio,numero_piso,urbanizacion,etiqueta,status_contrato FROM contrato where id_contrato='$id_contrato'  LIMIT 1 offset 0 ");

                if($row=row($acceso)){
                        
                        $numero_casa=utf8_decode(trim($row['numero_casa']));
                        
                        $direc_adicional=utf8_decode(trim($row['direc_adicional']));
                        $urbanizacion=utf8_decode(trim($row['urbanizacion']));
                        $numero_piso=utf8_decode(trim($row['numero_piso']));
                        $edificio=utf8_decode(trim($row['edificio']));
                        $etiqueta=utf8_decode(trim($row['etiqueta']));
                        $status_contrato=utf8_decode(trim($row['status_contrato']));
                }
                
                $acceso->objeto->ejecutarSql("select sum(costo_cobro) as deuda from contrato_servicio_deuda where contrato_servicio_deuda.id_contrato='$id_contrato'");
                
                if($row=row($acceso)){
                        $deuda=utf8_decode(trim($row['deuda']))+0;
                        
                        $deuda=number_format($deuda+0, 2, ',', '.');
                        
                }
                
                
                if($edificio!=''){
                        $edificio=",  Edif: $edificio, piso: $numero_piso ";
                }
                if($urbanizacion!=''){
                        $urbanizacion=", Urb: $urbanizacion ";
                }
                
                
                
                        $acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM personausuario where login='$login'  LIMIT 1 offset 0 ");
                        if($row=row($acceso)){
                                $atendido_por=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
                        
                        }
                
                        $acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM personausuario where login='$login_imp'  LIMIT 1 offset 0 ");
                        if($row=row($acceso)){
                                $impreso_por=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
                        
                        }
                
                
                
                $acceso->objeto->ejecutarSql("SELECT nombre_mun,nombre_zona,nombre_sector,nombre_calle
                FROM vista_contrato_dir where id_contrato='$id_contrato'  LIMIT 1 offset 0 ");
                
                if($row=row($acceso)){
                        
                        $nombre_mun=utf8_decode(trim($row['nombre_mun']));
                        $nombre_zona=utf8_decode(trim($row['nombre_zona']));
                        $nombre_sector=utf8_decode(trim($row['nombre_sector']));
                        $nombre_calle=utf8_decode(trim($row['nombre_calle']));
                }
                
                $fecha=date("d/m/Y");
                $x_izq=10;
                $x_medio=70;
                $x_medio1=120;
                $x_der=170;
                
                $this->Ln(10);
                
                $this->SetFont('Arial','B',9);
                $this->SetXY($x_izq,20+$x);
                $this->Cell(20,6,"NOMBRE:","0",0,"L");
				$this->SetFont('Arial','',9);
                $this->Cell(80,6,"$nombrecli","0",0,"L");
				
				$this->SetFont('Arial','B',9);
                $this->Cell(20,6,"CEDULA:","0",0,"L");
				$this->SetFont('Arial','',9);
                $this->Cell(30,6,"$cedulacli","0",0,"L");
				$this->SetFont('Arial','B',9);
				$this->Cell(20,6,"ABONADO: ","0",0,"L");
				$this->SetFont('Arial','',9);
				$this->Cell(30,6,"$nro_contrato","0",0,"L");
				
			    $this->Ln();
                $this->SetFont('Arial','B',9);
                $this->Cell(20,6,"STATUS : ","0",0,"L");
				$this->SetFont('Arial','',9);
                $this->Cell(30,6,"$status_contrato","0",0,"L");
				$this->SetFont('Arial','B',9);
                $this->Cell(20,6,"CELULAR:","0",0,"L");
				$this->SetFont('Arial','',9);
                $this->Cell(30,6,"$telefono  ","0",0,"L");
				$this->SetFont('Arial','B',9);
                $this->Cell(20,6,"TELEFONO:","0",0,"L");
				$this->SetFont('Arial','',9);
                $this->Cell(30,6,"$telf_casa  ","0",0,"L");
				$this->SetFont('Arial','B',9);
                $this->Cell(20,6,"TELF ADIC.:","0",0,"L");
				$this->SetFont('Arial','',9);
                $this->Cell(30,6,"$telf_adic  ","0",0,"L");
                $this->Ln();
				
				$this->SetFont('Arial','B',9);
				 $this->Cell(20,6,"PRECINTO: ","0",0,"L");
				 $this->SetFont('Arial','',9);
				 $this->Cell(30,6,"$etiqueta ","0",0,"L");
				 $this->SetFont('Arial','B',9);
				 $this->Cell(20,6,"POSTE:","0",0,"L");
				 $this->SetFont('Arial','',9);
				 $this->Cell(30,6,"$postel","0",0,"L");
				 $this->SetFont('Arial','B',9);
				 $this->Cell(20,6,"PUNTOS:","0",0,"L");
				 $this->SetFont('Arial','',9);
				 $this->Cell(30,6,"$pto","0",0,"L");
				 $this->SetFont('Arial','B',9);
				 $this->Cell(20,6,"DEUDA:","0",0,"L");
				 $this->SetFont('Arial','',9);
				 $this->Cell(30,6,"$deuda","0",0,"L");
                
				$this->Ln();
				$this->SetFont('Arial','B',9);
                $this->Cell(20,5,"DIRECCION:","0",0,"L");
				$this->SetFont('Arial','',9);
                $this->Cell(180,5,"$nombre_mun, $nombre_zona,  $nombre_sector $urbanizacion,  $nombre_calle $edificio,  $numero_casa ","0",0,"L");
                $this->Ln();
				$this->SetFont('Arial','',9);
				
				$direc_adic=substr($direc_adicional,0,110);
				$direc_adicional1=substr($direc_adicional,110,110);
                $this->Cell(200,5,"REF: $direc_adic","0",0,"L");
			//	if($direc_adicional1!=''){
					$this->Ln();
					$this->SetFont('Arial','',9);
					$this->Cell(200,5,"$direc_adicional1","0",0,"L");
			//	}
			
                $this->Ln(7);
                $this->SetX($x_izq);
                $this->SetFont('Arial','B',9);
               
                
                $this->SetFont('Arial','B',9);
                $this->Cell(30,5,strtoupper(_('detalle orden')).": ","0",0,"J");
                
                $this->SetFont('Arial','',9);
                $this->Cell(70,5,$nombre_det_orden,"0",0,"J");
                
                
                
                $acceso->objeto->ejecutarSql("SELECT *FROM orden_grupo where id_orden='$id_orden'  LIMIT 1 offset 0");
                if($row=row($acceso)){
                        $id_gt=utf8_decode(trim($row['id_gt']));
                }
                $acceso->objeto->ejecutarSql("SELECT *FROM grupo_trabajo where id_gt='$id_gt'  LIMIT 1 offset 0");
                if($row=row($acceso)){
                        $nombre_grupo=utf8_decode(trim($row['nombre_grupo']));
                }
                
                
                
                $this->SetFont('Arial','B',9);
                $this->Cell(30,5,strtoupper(_('asignada a')).": ","0",0,"J");
                
                $this->SetFont('Arial','',9);
                $this->Cell(75,5,''.$nombre_grupo,"0",0,"J");
                
                $this->Ln();
                $this->SetX($x_izq);
                $this->SetFont('Arial','B',9);
                $this->Cell(30,5,strtoupper(_('descripcion')).": ","0",0,"J");
                
                $this->SetFont('Arial','',9);
                $y=$this->GetX();
                $this->MultiCell(167,5,$detalle_orden,"0","J");
                
                
                
                
                
                $this->SetX($x_izq);
                $this->SetFont('Arial','B',9);
                $this->Cell(20,6,strtoupper(_('creada')).": ","0",0,"L");
                $this->SetFont('Arial','',9);
                $this->Cell(45,6,$atendido_por,"0",0,"L");
                $this->SetFont('Arial','B',9);
                $this->Cell(12,6,strtoupper(_('fecha')).": ","0",0,"L");
                $this->SetFont('Arial','',9);
                $this->Cell(23,6,$fecha_orden,"0",0,"L");
                
                
                $this->SetFont('Arial','B',9);
                $this->Cell(20,6,strtoupper(_('impresa')).": ","0",0,"L");
                $this->SetFont('Arial','',9);
                $this->Cell(45,6,$impreso_por,"0",0,"L");
                $this->SetFont('Arial','B',9);
                $this->Cell(12,6,strtoupper(_('fecha')).": ","0",0,"L");
                $this->SetFont('Arial','',9);
                $this->Cell(22,6,$fecha_imp,"0",0,"L");
                
                
        //      if($id_tipo_orden!="EA00001"){
                
                
                
                $this->Ln();
                $this->Ln();
                $this->Ln();
                $this->Ln();
               
                
                $this->SetX($x_izq);
                $this->Cell(100,20,'',"1",0,"L");
                $this->SetFont('Arial','B',9);
				
				$this->SetY(72+$x);
				$this->SetX($x_izq);
                $this->Cell(100,6,strtoupper(_('observaciones')).": ","0",0,"L");
                $this->SetX($x_izq);
                
                $this->SetX($x_izq+100);
                
                $this->SetFont('Arial','B',8);          
                $this->Cell(110,7,strtoupper(_('realizado por')).": ".' ______________________________________________',"0",0,"J");
                $this->Ln();
				$this->SetX($x_izq+100);
                $this->Cell(110,7,strtoupper(_('Ayudante')).": ".' ___________________________________________________',"0",0,"J");
                $this->Ln();
                $this->SetX($x_izq+100);
                $this->Cell(25,7,strtoupper(_('fecha y hora')).": ","0",0,"J");
                $this->Cell(43,7,' _______/_______/__________',"0",0,"J");
                $this->Cell(30,7,' _________:_________',"0",0,"J");
                
                
                        $this->Ln(7);
                
                $this->materiales($acceso);
        /*      
        }//if tipo de orden
        else{
                $this->estado_cuenta_con($acceso,$id_contrato,"ESTADO DE CUENTA",150);
        }
        */
                
        }
        function materiales($acceso)
        {
                $acceso->objeto->ejecutarSql("select hab_imp_mat from config_mat");
                if($row=row($acceso)){
                        $hab_imp_mat=trim($row["hab_imp_mat"]);
                }
                if($hab_imp_mat=="t"){
                        $acceso->objeto->ejecutarSql("SELECT nombre_mat FROM mat_padre where impresion='t' ORDER BY nombre_mat");
                        
                        $this->SetX(10);
                        $this->SetFont('Arial','B',10);
                        $this->Cell(100,6,strtoupper("materiales utilizados"),'0',0,'L'); 
                        $this->SetFont('Arial','B',8);
                        $this->Cell(100,6,strtoupper("inicio cable _______________  FIN CABLE ______________"),'0',0,'R'); 
                        
                        $this->Ln();
                        
                        $this->SetX(10);
                        $this->SetFont('Arial','',8);
                        $i=0;
                        while ($row=row($acceso))
                        {
                                if($i==3){
                                        $this->Ln();
                                        $this->SetX(10);
                                        $i=0;
                                }
                                        $nombre_mat=substr(trim($row['nombre_mat']),0,30);
                                        $this->Cell(37,5,ucfirst(strtolower("$nombre_mat")),"0",0,"J");
                                        $this->Cell(30,5,"______________","0",0,"J");
                                        $i++;
                        }
                }
                
                
        }
        function mas_datos($acceso,$id_orden)
        {
                $x_izq=10;
                $x_medio=100;
                $x_der=150;
                
                                
                $this->Ln(5);
                $this->SetX($x_izq);
                $this->SetFont('times','B',10);
                $this->Cell(200,5,strtoupper(_('conformidad del cliente ')).": ","0",0,"C");
                
				 $this->SetFont('times','',9);
                $this->Ln();
                $this->SetX($x_izq);
                $this->Cell(110,7,strtoupper(_('nombre legible : ___________________________________________'))."","0",0,"J");
                $this->Cell(50,7,strtoupper(_('cedula')).": _____________________","0",0,"J");
                $this->Cell(40,7,strtoupper(_('FIRMA')),"0",0,"C");
                
                $this->Ln();
                $this->SetX($x_izq);
                $this->Cell(160,7,strtoupper(_('observaciones ')).": ____________________________________________________________________________________________","0",0,"J");
                $this->SetFont('times','',9);
                $this->Ln(7);
                $this->SetX($x_izq);
                $this->MultiCell(196,5,"Estimado Suscriptor: su firma da conformidad de los trabajos realizados por nuestro personal","0","J");
                
                
        }
       
	
}
//crea el objeto pdf
$pdf=new PDF();              
$pdf->SetAutoPageBreak(true,10);
//agrega una nueva pagina


$pdf->orden($acceso,$id_orden,$id_gt);

$pdf->Output('reporte.pdf','D');
?> 