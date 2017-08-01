<?php
	session_start();
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_orden=trim($_GET['id_orden']);
$id_gt=trim($_GET['id_gt']);
class PDF extends FPDF
{
	//Titulo del reporte
	function Titulo($titulo,$id_orden)
	{
		$this->SetTextColor(0,0,0);
		$this->SetXY(58,12);
		$this->SetFont('Arial','',12);
		$this->MultiCell(100,6,strtoupper(_("   orden de servicio no")).". "."    $id_orden",'1','L');
		
		
	}
	//Titulo del reporte
	
	//muestra el listado de los reportes 
	function orden($acceso,$id_orden,$id_gt){
		$valor=explode("=@",$id_orden);
		$tam=count($valor)-1;
		//echo ":$tam:";
		$cad='';
					require_once "../Clases/trans_pago.php";
					$obj_trans=new trans_pago();
					$obj_trans->begin($acceso);	
			
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
			//if($i%2==0){
				$this->AddPage('P','letter');
			/*	$x=5;
			}else{
				$x=145;
			}
			*/
			$this->Cuerpo($acceso,$valor[$i],$x);
		//	$this->materiales($acceso,$id_orden);
			$this->mas_datos($acceso,$id_orden);
		}
		$obj_trans->commit($acceso);	
	}
	function Cuerpo($acceso,$id_orden)
	{
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_orden where id_orden='$id_orden'  LIMIT 1 offset 0");
		if($row=row($acceso)){
			$nombre_tipo_orden=utf8_decode(trim($row['nombre_tipo_orden']));
			$nombre_det_orden=utf8_decode(trim($row['nombre_det_orden']));
			$detalle_orden=utf8_decode(trim($row['detalle_orden']));
			$comentario_orden=utf8_decode(trim($row['comentario_orden']));
			
			$this->Titulo($nombre_tipo_orden,$id_orden);
			$fecha_orden=formatofecha(trim($row['fecha_orden']));
			$nombre_tec=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
			
			$nombre_tipo_orden=utf8_decode(trim($row['nombre_tipo_orden']));
			$nombrecli=utf8_decode(trim($row['nombrecli'])." ".trim($row['apellidocli']));
			$etiqueta=utf8_decode(trim($row['etiqueta']));
			$cedulacli=utf8_decode(trim($row['cedulacli']));
			
			$nro_contrato=trim($row['nro_contrato']);
			$id_contrato=trim($row['id_contrato']);
			
			$fecha_orden=formatofecha(trim($row['fecha_orden']));
			$fecha_imp=formatofecha(trim($row['fecha_imp']));
			$login=trim($row['login_emi']);
			$login_imp=trim($row['login_imp']);
			$hora_emi=trim($row['hora_emi']);
			$hora_imp=trim($row['hora_imp']);
			
		
		}
		
		$acceso->objeto->ejecutarSql("SELECT telefono,telf_casa FROM vista_contrato where id_contrato='$id_contrato'  LIMIT 1 offset 0 ");
		
		if($row=row($acceso)){
			$telefono=utf8_decode(trim($row['telefono']));
			$telf_casa=utf8_decode(trim($row['telf_casa']));
			
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
		/*
		$acceso->objeto->ejecutarSql("SELECT login, hora FROM ordenes_tecnicos where id_contrato='$id_contrato'  LIMIT 1 offset 0 ");
		if($row=row($acceso)){
			$login=utf8_decode(trim($row['login']));
			$hora=utf8_decode(trim($row['hora']));
			$acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM personausuario where login='$login'  LIMIT 1 offset 0 ");
			if($row=row($acceso)){
				$atendido=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
			
			}
		}
		*/
			$acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM personausuario where login='$login'  LIMIT 1 offset 0 ");
			if($row=row($acceso)){
				$atendido_por=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
			
			}
		
			$acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM personausuario where login='$login_imp'  LIMIT 1 offset 0 ");
			if($row=row($acceso)){
				$impreso_por=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
			
			}
			
		
		$acceso->objeto->ejecutarSql("SELECT postel,taps,pto,edificio
		FROM contrato where id_contrato='$id_contrato'  LIMIT 1 offset 0 ");
		
		if($row=row($acceso)){
			$postel=utf8_decode(trim($row['postel']));
			$taps=utf8_decode(trim($row['taps']));
			$pto=utf8_decode(trim($row['pto']));
			
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
		$this->SetXY($x_izq,19);
		$this->Cell(25,6,strtoupper(_('ABONADO')).": ","1",0,"C");
		$this->SetXY($x_izq,25);
		$this->SetFont('Arial','',9);
		$this->Cell(25,6,$nro_contrato,"1",0,"C"); 
		
		$this->SetXY($x_izq+25,19);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,6,strtoupper(_('cedula')).": ","1",0,"C");
		$this->SetXY($x_izq+25,25);
		$this->SetFont('Arial','',9);
		$this->Cell(25,6,$cedulacli,"1",0,"C");
		
		$this->SetXY($x_izq+50,19);
		$this->SetFont('Arial','B',9);
		$this->Cell(140,6,strtoupper(_('suscriptor')).":                                                          CONTRATO: $status_contrato","1",0,"L");
		$this->SetXY($x_izq+50,25);
		$this->SetFont('Arial','',9);
		$this->Cell(140,6,$nombrecli,"1",0,"L");
		
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,6,_("CELULAR")." ","1",0,"C");
		
		$this->SetX($x_izq+25);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,6,strtoupper(_("telefono"))." ","1",0,"C");
		

		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('Arial','',9);
		$this->Cell(25,6," $telefono","1",0,"C");
		
		$this->SetX($x_izq+25);
		$this->SetFont('Arial','',9);
		$this->Cell(25,6," $telf_casa","1",0,"C");
		
		$this->SetXY($x_izq+50,31);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,4,strtoupper(_("direccion")).": ","0",0,"L");
		
		$this->SetXY($x_izq+75,31);
		$this->SetFont('Arial','',9);
		$this->MultiCell(120,4,"$nombre_mun, $nombre_zona,  $nombre_sector $urbanizacion,  $nombre_calle $edificio,  $numero_casa ","0","L");
		
		
		$this->Ln();
		$this->SetXY($x_izq,43);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,6,strtoupper(_('Precinto ')),"1",0,"C");
		
		$this->SetXY($x_izq+25,43);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,6,strtoupper(_('Poste ')),"1",0,"C");
		
		$this->SetXY($x_izq+50,40);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,4,strtoupper(_('referencia')).": ","0",0,"L");
		
		
		$this->SetXY($x_izq+50,40);
		$this->SetFont('Arial','',9);
		$this->MultiCell(140,4,"                            ".$direc_adicional."","0","L");
		
			$fecha_act=date("Y-m-d");
			 $meses=lectura($acceso,"SELECT distinct fecha_inst  FROM contrato_servicio_deuda where   fecha_inst <= '$fecha_act' and id_contrato='$id_contrato'  and status_con_ser='DEUDA' order by fecha_inst");
			 $dato1=array();
			 $ind=0;
			 
			 for($k=0;$k<count($meses);$k++){
				$fecha_inst=trim($meses[$k]["fecha_inst"]);
				list($ano,$mes,$dia)=explode("-",$fecha_inst);
				$fecha1="$ano-$mes";
				//echo $fecha1;
				if(!in_array($fecha1,$dato1)){
					$dato1[$ind]=$fecha1;
					$ind++;
				}
			 }
			 $det_deuda="";
			for($k=0;$k<count($dato1);$k++){
				$fecha_inst=trim($dato1[$k]);
				list($ano,$mes)=explode("-",$fecha_inst);
				$anio=substr($ano, -2);
				$mes_l = "$mes/$anio";
				$ult_dia_mes=date("t",mktime( 0, 0, 0, $mes, 1, $ano ));
				
				$fec_ini="$ano-$mes-01";
				$fec_fin="$ano-$mes-$ult_dia_mes";
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro  FROM contrato_servicio_deuda,servicios where contrato_servicio_deuda.id_serv=servicios.id_serv and id_tipo_servicio='TSE00001' AND id_contrato='$id_contrato' and status_con_ser='DEUDA' and fecha_inst between '$fec_ini' and '$fec_fin' ");
				
				$row=row($acceso);
				$costo_cobro=trim($row["costo_cobro"])+0;
				//$costo_cobro=number_format(trim($row["costo_cobro"])+0, 2, ',', '.');
				if($costo_cobro>0){
					$det_deuda = $det_deuda."C $mes_l:  $costo_cobro;  ";
				}
				
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro  FROM contrato_servicio_deuda,servicios where contrato_servicio_deuda.id_serv=servicios.id_serv and id_tipo_servicio='AP00001' AND id_contrato='$id_contrato' and status_con_ser='DEUDA' and fecha_inst between '$fec_ini' and '$fec_fin' ");
				
				$row=row($acceso);
				$costo_cobro=trim($row["costo_cobro"])+0;
				//$costo_cobro=number_format(trim($row["costo_cobro"])+0, 2, ',', '.');
				if($costo_cobro>0){
					$det_deuda = $det_deuda."I $mes_l:  $costo_cobro;  ";
				}
			}
			$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as total  FROM contrato_servicio_deuda where id_contrato='$id_contrato' and status_con_ser='DEUDA' and  fecha_inst <= '$fecha_act'");
				
				$row=row($acceso);
				$total=trim($row["total"])+0;	
				$total=number_format($total+0, 2, ',', '.');
				
		$this->SetXY($x_izq+50,48);
		$this->SetFont('Arial','B',8);
		$this->Cell(12,3,strtoupper(_('deuda')).": $total DET. ","0",0,"L");
		$this->SetFont('Arial','',8);
	//	$this->Cell(105,4,$det_deuda,"0",0,"L");
		$this->SetXY($x_izq+50,48);
		$this->MultiCell(140,3,"                                         ".$det_deuda,"T","L");
		
		
		
		
		$this->SetXY($x_izq+50,31);
		$this->Cell(140,24,"","1",0,"C");
		$this->SetFont('Arial','',9);
		$this->Ln();
		$this->SetXY($x_izq,49);
		$this->Cell(25,6,$etiqueta,"1",0,"J");
		$this->SetFont('Arial','',9);
		$this->SetXY($x_izq+25,49);
		$this->Cell(25,6,$postel,"1",0,"J");
		
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,5,strtoupper(_('tipo de servicio')).":","0",0,"J");
		$this->SetFont('Arial','',9);
		
		$this->Cell(60,5,$nombre_tipo_orden,"0",0,"J");
		
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
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,5,strtoupper(_('asignada a')).": ","0",0,"J");
		
		$this->SetFont('Arial','',9);
		$this->Cell(100,5,''.$nombre_grupo,"0",0,"J");
		
		$this->SetFont('Arial','B',9);
		$this->Cell(60,5,"PUNTO ADICIONAL: $pto","0",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,5,strtoupper(_('observacion')).": ","0",0,"J");
		
		$this->SetFont('Arial','',9);
		$y=$this->GetX();
		$this->MultiCell(167,5,$detalle_orden,"0","J");
		
		
		
		
		$this->SetXY($x_izq,70);
		//$this->SetFont('Arial','B',9);
		//$this->Cell(190,6,strtoupper(_('departamento de atencion al cliente')).": ","1",0,"C");
		
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,6,strtoupper(_('creada por')).": ","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(60,6,$atendido_por,"RTB",0,"L");
		$this->SetFont('Arial','B',9);
		$this->Cell(15,6,strtoupper(_('fecha')).": ","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(35,6,$fecha_orden,"RTB",0,"L");
		$this->SetX($x_izq+140);
		$this->SetFont('Arial','B',9);
		$this->Cell(15,6,strtoupper(_('hora')).": ","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(35,6,$hora_emi,"RTB",0,"L");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,6,strtoupper(_('impresa por')).": ","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(60,6,$impreso_por,"RTB",0,"L");
		$this->SetFont('Arial','B',9);
		$this->Cell(15,6,strtoupper(_('fecha')).": ","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(35,6,$fecha_imp,"RTB",0,"L");
		$this->SetX($x_izq+140);
		$this->SetFont('Arial','B',9);
		$this->Cell(15,6,strtoupper(_('hora')).": ","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(35,6,$hora_imp,"RTB",0,"L");
		
		
		$acceso->objeto->ejecutarSql("SELECT  nombre_servicio, cant_serv FROM contrato_servicio,servicios where contrato_servicio.id_serv=servicios.id_serv and  id_contrato='$id_contrato' ");
		$paquete='';
		
		while ($row=row($acceso)){
				$paquete=$paquete.utf8_decode(trim($row["nombre_servicio"])).": ".utf8_decode(trim($row["cant_serv"]))."; ";
			//	echo $paquete;
		}
		
		$this->Ln(6);
		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,4,strtoupper(_('paquetes')).": ","0",0,"L");
		$this->SetFont('Arial','',9);
		$this->MultiCell(160,4,$paquete,"0","J");
		
		
		//fin celda de los atendido por, fecha y hora
		
		
		
		
		$acceso->objeto->ejecutarSql("SELECT *FROM cablemodem where id_contrato='$id_contrato'  LIMIT 1 offset 0");
		if($row=row($acceso)){
			$codigo_cm=utf8_decode(trim($row['codigo_cm']));
			$status_cm=utf8_decode(trim($row['status_cm']));
			$marca_cm=utf8_decode(trim($row['marca_cm']));
			
		}
		$this->Ln(2);
		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(190,6,strtoupper(_('CABLE MODEM')).": ","1",0,"C");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,6,strtoupper(_(' cable moden')).": ","LTB",0,"C");
		
		$this->SetFont('Arial','',9);
		$this->Cell(50,6,$codigo_cm,"TB",0,"L");
		$this->SetFont('Arial','B',9);
		$this->Cell(15,6,"STATUS:","TB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(30,6,$status_cm,"TB",0,"L");
		$this->SetFont('Arial','B',9);
		$this->Cell(15,6,"MARCA:","TB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(55,6,$marca_cm,"TBR",0,"L");
		
		
                $this->Ln();
                
                $this->SetX($x_izq);
                $this->SetFont('Arial','B',9);
                $this->Cell(100,6,strtoupper(_('observaciones')).": ","0",0,"L");
                $this->SetX($x_izq);
                $this->Cell(100,20,'',"1",0,"L");
                $this->Cell(90,20,'',"1",0,"L");
                $this->SetX($x_izq+100);
                
                $this->SetFont('Arial','B',8);          
                $this->Cell(110,7,strtoupper(_('realizado por')).": ".' ________________________________________',"0",0,"J");
                $this->Ln();
                $this->SetX($x_izq+100);
                $this->Cell(110,7,strtoupper(_('Ayudante')).     ": ".' _____________________________________________',"0",0,"J");
                $this->Ln();
                $this->SetX($x_izq+100);
                $this->Cell(25,7,strtoupper(_('fecha y hora')).": ","0",0,"J");
                $this->Cell(40,7,' ______/______/_________',"0",0,"J");
                $this->Cell(30,7,' _______:_______',"0",0,"J");
                
                
                        $this->Ln(7);
                
		 $this->materiales($acceso,$id_orden);
	}
	
	function materiales($acceso,$id_orden)
        {
                $acceso->objeto->ejecutarSql("select hab_imp_mat from config_mat");
                if($row=row($acceso)){
                        $hab_imp_mat=trim($row["hab_imp_mat"]);
                }
                if($hab_imp_mat=="t"){
					$acceso->objeto->ejecutarSql("select id_m,cant_mov from movimiento, mov_mat,materiales where mov_mat.id_mat=materiales.id_mat and movimiento.id_mov = mov_mat.id_mov and referencia='$id_orden';");
					$mater=array();
					while ($row=row($acceso))
					{
						$id_m=trim($row['id_m']);
						$cant_mov=trim($row['cant_mov']);
						$mater[$id_m]=$cant_mov;
						//echo "<br>$id_m:$cant_mov";
					}
                        $acceso->objeto->ejecutarSql("SELECT nombre_mat,id_m FROM mat_padre where impresion='t' ORDER BY nombre_mat");
                        
                        $this->SetX(10);
                        $this->SetFont('Arial','B',10);
                        $this->Cell(85,6,strtoupper("materiales utilizados"),'0',0,'L'); 
                        $this->SetFont('Arial','B',8);
                        $this->Cell(100,6,strtoupper("inicio cable _______________  FIN CABLE _______________"),'0',0,'R'); 
                        
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
									$id_m=trim($row['id_m']);
										$cant=$mater[$id_m];
                                        $nombre_mat=substr(trim($row['nombre_mat']),0,30);
                                        $this->Cell(37,5,ucfirst(strtolower("$nombre_mat")),"0",0,"J");
										$this->Cell(22,4,"$cant","B",0,"C");
                                        $i++;
                        }
                }
                
                
        }
	function mas_datos($acceso,$id_orden)
	{
		$x_izq=10;
		$x_medio=100;
		$x_der=150;
		
		$this->Ln();
		$this->SetX(10);
		$this->SetFont('times','B',10);
		$this->MultiCell(195,6,strtoupper(_("visitas")),'0','C');
		$this->Ln(2);
			
		$this->SetFont('Arial','B',8);
		$this->Cell(7,6,strtoupper(_('nro')),"1",0,"C");
		$this->Cell(25,6,strtoupper(_('fecha')),"1",0,"C");
		$this->Cell(18,6,strtoupper(_('hora')),"1",0,"C");
		$this->Cell(140,6,strtoupper(_('notas')),"1",0,"C");
		
		$acceso->objeto->ejecutarSql("SELECT fecha_visita,hora,comenta_visita FROM visitas where id_orden='$id_orden'  LIMIT 1 offset 0 ");
		
		if($row=row($acceso)){
			$fecha_visita=formatofecha(trim($row['fecha_visita']));
			$comenta_visita=utf8_decode(trim($row['comenta_visita']));
			$hora=utf8_decode(trim($row['hora']));
			
			$valor=explode("-",trim($date));
			$fecha= $valor[2].'/'.$valor[1].'/'.$valor[0];
			$this->Ln();
			$this->SetFont('Arial','',8);
			$this->Cell(7,6,'1',"1",0,"C");
			$this->Cell(25,6,$fecha_visita,"1",0,"C");
			$this->Cell(18,6,$hora,"1",0,"C");
			$this->SetFont('Arial','',8);
			$this->Cell(140,6,strtolower($comenta_visita),"1",0,"J");
		}
		else{
			$this->Ln();
			$this->SetFont('Arial','B',7);
			$this->Cell(7,6,'1',"1",0,"C");
			$this->Cell(25,6,'    /          /           ',"1",0,"C");
			$this->Cell(18,6,'    :    ',"1",0,"C");
			$this->Cell(140,6,'',"1",0,"J");
		}
		
		$acceso->objeto->ejecutarSql("SELECT fecha_visita,hora,comenta_visita FROM visitas where id_orden='$id_orden'  LIMIT 1 offset 1 ");
		
		if($row=row($acceso)){
			$fecha_visita=formatofecha(trim($row['fecha_visita']));
			$comenta_visita=utf8_decode(trim($row['comenta_visita']));
			$hora=utf8_decode(trim($row['hora']));
			
			$valor=explode("-",trim($date));
			$fecha= $valor[2].'/'.$valor[1].'/'.$valor[0];
			$this->Ln();
			$this->SetFont('Arial','',8);
			$this->Cell(7,6,'2',"1",0,"C");
			$this->Cell(25,6,$fecha_visita,"1",0,"C");
			$this->Cell(18,6,$hora,"1",0,"C");
			$this->SetFont('Arial','',8);
			$this->Cell(140,6,strtolower($comenta_visita),"1",0,"J");
		}
		else{
			$this->Ln();
			$this->SetFont('Arial','B',7);
			$this->Cell(7,6,'2',"1",0,"C");
			$this->Cell(25,6,'    /          /           ',"1",0,"C");
			$this->Cell(18,6,'    :    ',"1",0,"C");
			$this->Cell(140,6,'',"1",0,"J");
		}
		
		$this->SetFont('Arial','B',8);		
		
		$this->Ln(10);
		$this->SetX($x_izq);
		$this->Cell(85,5,strtoupper(_('realizado por: ')).": ".'_____________________________________',"0",0,"J");
		$this->Cell(73,5,strtoupper(_('fecha de atencion')).": ".' ________/________/___________',"0",0,"J");
		
		$this->Cell(30,5,strtoupper(_('hora')).": ".' ______:______',"0",0,"J");
		$this->Ln(8);
		$this->SetX($x_izq);
		$this->Cell(190,5,strtoupper(_('conformidad del cliente ')).": ","1",0,"C");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->Cell(100,10,strtoupper(_('nombre legible ')).": ","1",0,"J");
		$this->Cell(50,10,strtoupper(_('cedula')).": ","1",0,"J");
		$this->Cell(40,10,strtoupper(_('firma: ')),"1",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->Cell(150,10,strtoupper(_('observaciones ')).": ","1",0,"J");
		$this->Cell(40,10,strtoupper(_(''))." ","1",0,"C");
		
		/*
		$this->SetX($x_izq+150);
		$this->Cell(40,5,strtoupper(_('punto adicionales'))." ","0",0,"C");
		
		$this->Ln();
		$this->SetX($x_izq+150);
		$this->Cell(40,5,$pto."1",0,"C");
		*/
		/*
		$this->SetXY($x_izq+150,258);
		$this->Cell(40,10,"","1",0,"C");
		*/
	
		
	}
	function estado_cuenta_con($acceso,$id_contrato,$titulo,$sety)
	{
		
		
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_contrato_auditoria where id_contrato='$id_contrato'");
		
		
		if($row=row($acceso))
		{
			$nro_contrato=trim($row["nro_contrato"]);
			$cedula=trim($row["cedula"]);
			$nombre=utf8_d(trim($row["nombre"]));
			$apellido=utf8_d(trim($row["apellido"]));
			$telefono=trim($row["telefono"]);
			$telf_casa=trim($row["telf_casa"]);
			$email=trim($row["email"]);
			$direc_adicional=utf8_d(trim($row["direc_adicional"]));
			$numero_casa=trim($row["numero_casa"]);
			$nombre_calle=utf8_d(trim($row["nombre_calle"]));
			$nombre_sector=utf8_d(trim($row["nombre_sector"]));
			
			$nombre_franq=utf8_d(trim($row["nombre_franq"]));
			$edificio=utf8_d(trim($row["edificio"]));
			$numero_piso=trim($row["numero_piso"]);
			$telf_adic=trim($row["telf_adic"]);
			$telefono ="$telefono / $telf_casa / $telf_adic"; 
			$fecha_contrato=formatofecha(trim($row["fecha_contrato"]));
			$status_contrato=trim($row["status_contrato"]);
			$status_contrato=trim($row["status_contrato"]);
			$etiqueta=utf8_d(trim($row["etiqueta"]));
		
			$nombre_zona=utf8_d(trim($row["nombre_zona"]));
			$nombre_mun=utf8_d(trim($row["nombre_mun"]));
			$nombre_sector=utf8_decode(trim($row["nombre_sector"]));
			$edificio=utf8_decode(trim($row["edificio"]));
			$numero_piso=utf8_decode(trim($row["numero_piso"]));
			$urbanizacion=utf8_decode(trim($row["urbanizacion"]));
			$nombre_calle=utf8_decode(trim($row["nombre_calle"]));
			$urbanizacion=utf8_decode(trim($row["urbanizacion"]));
			$direc_adicional=utf8_decode(trim($row["direc_adicional"]));
			
			
			if($edificio!=''){
				$edificio=",  Edif: $edificio, piso: $numero_piso ";
			}
			if($urbanizacion!=''){
				$urbanizacion=", Urb: $urbanizacion ";
			}
			$dir ="$nombre_mun, $nombre_zona, $nombre_sector, $urbanizacion,  $nombre_calle $edificio,  $numero_casa ; REF. $direc_adicional";
			
			
		}
		
			
			$this->Ln(7);
			$this->SetX(10);
			$this->SetFont('Times','B',12);
			$this->Cell(70,6,strtoupper(_($titulo)),"1",0,"C");
		
			$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as deuda FROM contrato_servicio_deuda where id_contrato='$id_contrato'  AND costo_cobro>0");
			$row=row($acceso);
			$deuda=trim($row["deuda"]);
		
		$this->SetFont('Times','B',12);
		$this->Cell(50,6,"","0",0,"R",$fill);
		$this->Cell(70,6,strtoupper(_('monto pendiente')).": ".number_format($deuda+0, 2, ',', '.'),"1",0,"C",$fill);
		
		
		$this->Ln(7);
		
		$this->SetFillColor(244,249,255);
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(171,171,171);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(15,30,65,40,40);
		$header=array(strtoupper(_('nro')), strtoupper(_('aviso nro')),strtoupper(_('servicio')),strtoupper(_('periodo')),strtoupper(_('monto bs.f')));
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_contratodeu where id_contrato='$id_contrato' order by fecha_inst asc");
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$suma=0.00;
		while ($row=row($acceso))
		{
			$tipo_costo=trim($row["tipo_costo"]);
			$total=0.00;
			$cant=trim($row["cant_serv"]);
			$tar=trim($row["costo_cobro"]);
			$total=($cant*$tar);
			$suma=$suma+$total;
			$fecha_inst=trim($row["fecha_inst"]);
			
							$fec = explode ("-",$fecha_inst);
							$me=$fec[1];
							$anio=$fec[0];
							$mes=array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
							$f_mes=$mes[$me];
							if($tipo_costo=="COSTO MENSUAL"){
								$fecha=strtoupper("$f_mes $anio");
							}
							else{
								$fecha = date("d/m/Y", strtotime($value));
							}
			
			$fill=0;
			$this->SetX(10);
			$this->Cell($w[0],5,$cont,"L",0,"J",$fill);
			$this->Cell($w[1],5,utf8_d(trim($row["id_cont_serv"])),"0",0,"J",$fill);
			$this->Cell($w[2],5,utf8_d(trim($row["nombre_servicio"])),"0",0,"J",$fill);
			$this->Cell($w[3],5,$fecha,"0",0,"J",$fill);
			$this->Cell($w[4]-15,5,number_format(utf8_d(trim($row["costo_cobro"]))+0, 2, ',', '.'),"0",0,"R",$fill);
			$this->Cell(15,5,'',"R",0,"R",$fill);
			


			$this->Ln();
			//$fill=!$fill;
			$cont++;
		}
		
		$this->SetX(10);
		$this->Cell(array_sum($w),5,'','T');
		
			$this->Ln();	
			
			$acceso->objeto->ejecutarSql("SELECT fecha_pago,fecha_inst,monto_pago, nro_factura  FROM vista_pago_ser where  id_contrato='$id_contrato'  order BY fecha_inst desc LIMIT 1");
				$row=row($acceso);
					$fecha_pago=formatofecha(trim($row["fecha_pago"]));
					$fecha_inst=trim($row["fecha_inst"]);
					list($ano,$mes,$dia)=explode("-",$fecha_inst);
					$periodo = formato_mes_com1($mes)." $ano";
					$nro_factura=trim($row["nro_factura"]);
					$monto_pago=trim($row["monto_pago"])+0;
					$monto_pago=number_format(trim($row["monto_pago"])+0, 2, ',', '.');
					$this->SetFont('Arial','B',9);
					$this->Cell(30,5,"ULTIMO PAGO","LBT",0,"J",$fill);
					$this->Cell(15,5,"FECHA: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(20,5,"$fecha_pago","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(18,5,"FACTURA: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(20,5,"$nro_factura","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(17,5,"PERIODO: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,"$periodo","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(20,5,"PAGADO: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(20,5,"$monto_pago","TBR",0,"J",$fill);
					
			$this->Ln();
			 $meses=lectura($acceso,"SELECT distinct fecha_inst  FROM contrato_servicio_deuda where   id_contrato='$id_contrato'  and status_con_ser='DEUDA' AND costo_cobro>0 order by fecha_inst");
			 $dato1=array();
			 $ind=0;
			 
			 for($k=0;$k<count($meses);$k++){
				$fecha_inst=trim($meses[$k]["fecha_inst"]);
				list($ano,$mes,$dia)=explode("-",$fecha_inst);
				$fecha1="$ano-$mes";
				//echo $fecha1;
				if(!in_array($fecha1,$dato1)){
					$dato1[$ind]=$fecha1;
					$ind++;
				}
			 }
			$meses_vencido=count($dato1);
			 $this->SetFont('Arial','B',9);
					$this->Cell(40,5,"MESES VENCIDOS","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(25,5,"$meses_vencido","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(20,5,"ETIQUETA: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(18,5,"$etiqueta","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(20,5,"TELEFONO: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(67,5,"$telefono","TBR",0,"J",$fill);
	
	}
	
}
//crea el objeto pdf
$pdf=new PDF();              
$pdf->SetAutoPageBreak(true,5);
//agrega una nueva pagina


$pdf->orden($acceso,$id_orden,$id_gt);

$pdf->Output('reporte.pdf','D');
?> 