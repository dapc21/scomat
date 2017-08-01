<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["$ini_u"]; 

$id_orden=trim($_GET['id_orden']);
class PDF extends FPDF
{
	//Cabecera del Reporte aparecera en todas las paginas
	function Header()
	{
	}
	
	//Titulo del reporte
	function Titulo($titulo,$id_orden,$nombre_franq)
	{
		//$this->Image('../imagenes/'.logo(),10,3,ancho_logo()/2);
		session_start();
		$login=strtoupper($_SESSION['login']);

		$this->SetFont('times','B',12);
		$this->SetXY(10,8);
		$this->Cell(100,5,$nombre_franq,0,0,'L');
		
		$this->SetFont('Arial','',9);
		$this->Cell(91,5,"IMPRESION: $login ".date("d/m/Y h:i:s A"),0,0,'R');
		
		
		$this->SetTextColor(0,0,0);
		$this->SetXY(58,15);
		$this->SetFont('Arial','',12);
		$this->MultiCell(100,6,"ORDEN DE SERVICIO Nro.    $id_orden",'1','C');
		
		
	}
	
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$id_orden)
	{
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_orden where id_orden='$id_orden'  LIMIT 1 offset 0");
		if($row=row($acceso)){
			$nombre_tipo_orden=utf8_decode(trim($row['nombre_tipo_orden']));
			$nombre_det_orden=utf8_decode(trim($row['nombre_det_orden']));
			$detalle_orden=utf8_decode(trim($row['detalle_orden']));
			$comentario_orden=utf8_decode(trim($row['comentario_orden']));
			$nombre_franq=utf8_decode(trim($row['nombre_franq']));
			
			$this->Titulo($nombre_tipo_orden,$id_orden,$nombre_franq);
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
		
		$acceso->objeto->ejecutarSql("SELECT telefono,telf_casa,numero_casa,direc_adicional,edificio,numero_piso,urbanizacion,etiqueta,status_contrato,nombre_mun,nombre_zona,nombre_sector,nombre_calle,postel,taps,pto,update_saldo(id_contrato) as saldo FROM vista_contrato_auditoria where id_contrato='$id_contrato'  LIMIT 1 offset 0 ");
		
		if($row=row($acceso)){
			$telefono=utf8_decode(trim($row['telefono']));
			$telf_casa=utf8_decode(trim($row['telf_casa']));
			$numero_casa=utf8_decode(trim($row['numero_casa']));
			
			$direc_adicional=utf8_decode(trim($row['direc_adicional']));
			$urbanizacion=utf8_decode(trim($row['urbanizacion']));
			$numero_piso=utf8_decode(trim($row['numero_piso']));
			$edificio=utf8_decode(trim($row['edificio']));
			$etiqueta=utf8_decode(trim($row['etiqueta']));
			$status_contrato=utf8_decode(trim($row['status_contrato']));
			$saldo=utf8_decode(trim($row['saldo']));
			$saldo=number_format($saldo+0, 2, ',', '.');

			$postel=utf8_decode(trim($row['postel']));
			$taps=utf8_decode(trim($row['taps']));
			$pto=utf8_decode(trim($row['pto']));

			$nombre_mun=utf8_decode(trim($row['nombre_mun']));
			$nombre_zona=utf8_decode(trim($row['nombre_zona']));
			$nombre_sector=utf8_decode(trim($row['nombre_sector']));
			$nombre_calle=utf8_decode(trim($row['nombre_calle']));

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
			
		
		
		$fecha=date("d/m/Y");
		$x_izq=10;
		$x_medio=70;
		$x_medio1=120;
		$x_der=170;
		
		$this->SetXY($x_izq,23);
		 
        $this->SetFont('Arial','B',10);
        $this->Cell(85,6,"DATOS DEL CLIENTE",'0',0,'L'); 



		$this->SetFont('Arial','B',9);
		$this->SetXY($x_izq,29);
		$this->Cell(25,6,strtoupper(_('ABONADO')).": ","1",0,"C");
		$this->SetXY($x_izq,35);
		$this->SetFont('Arial','',9);
		$this->Cell(25,6,$nro_contrato,"1",0,"C"); 
		
		$this->SetXY($x_izq+25,29);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,6,strtoupper(_('cedula')).": ","1",0,"C");
		$this->SetXY($x_izq+25,35);
		$this->SetFont('Arial','',9);
		$this->Cell(25,6,$cedulacli,"1",0,"C");
		
		$this->SetXY($x_izq+50,29);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,6,"STATUS","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(65,6,$status_contrato,"RTB",0,"L");

		$this->SetFont('Arial','B',9);
		$this->Cell(15,6,"SALDO","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(35,6,$saldo,"RTB",0,"L");

		$this->SetXY($x_izq+50,35);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,6,"CLIENTE:","LTB",0,"L");
		
		$this->SetFont('Arial','',9);
		$this->Cell(115,6,$nombrecli,"RTB",0,"L");
		
		
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
		
		$this->SetXY($x_izq+50,41);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,4,strtoupper(_("direccion")).": ","0",0,"L");
		
		$this->SetXY($x_izq+75,41);
		$this->SetFont('Arial','',9);
		$this->MultiCell(120,4,"$nombre_mun, $nombre_zona,  $nombre_sector $urbanizacion,  $nombre_calle $edificio,  $numero_casa ","0","L");
		
		
		$this->Ln();
		$this->SetXY($x_izq,53);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,6,strtoupper(_('Precinto ')),"1",0,"C");
		
		$this->SetXY($x_izq+25,53);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,6,strtoupper(_('Poste ')),"1",0,"C");
		
		$this->SetXY($x_izq+50,50);
		$this->SetFont('Arial','B',9);
		$this->Cell(25,4,strtoupper(_('referencia')).": ","0",0,"L");
		
		
		$this->SetXY($x_izq+50,50);
		$this->SetFont('Arial','',9);
		$this->MultiCell(140,4,"                            ".$direc_adicional."","0","L");
		/*
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
			*/	
		$this->SetXY($x_izq+50,41);
		$this->Cell(140,24,"","1",0,"C");
		$this->SetFont('Arial','',9);
		$this->Ln();
		$this->SetXY($x_izq,59);
		$this->Cell(25,6,$etiqueta,"1",0,"J");
		$this->SetFont('Arial','',9);
		$this->SetXY($x_izq+25,59);
		$this->Cell(25,6,$postel,"1",0,"J");
		
		
		$this->Ln(8);
        $yy=$this->GetY();
                 
        $this->SetFont('Arial','B',10);
        $this->Cell(85,6,"DETALLES DE LA ORDEN",'0',0,'L'); 


		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,6,strtoupper(_('TIPO DE ORDEN')).":","LTB",0,"J");
		$this->SetFont('Arial','',9);
		
		$this->Cell(65,6,$nombre_tipo_orden,"RTB",0,"J");
		$this->Ln();
		$this->SetX($x_izq);

		$this->SetFont('Arial','B',9);
		$this->Cell(30,6,strtoupper(_('detalle orden')).": ","LTB",0,"J");
		
		$this->SetFont('Arial','',9);
		$this->Cell(65,6,$nombre_det_orden,"RTB",0,"J");
		
		
		
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
		$this->Cell(30,6,strtoupper(_('asignada a')).": ","LTB",0,"J");
		
		$this->SetFont('Arial','',9);
		$this->Cell(65,6,''.$nombre_grupo,"RTB",0,"J");
		
		$this->Ln();
		$this->SetFont('Arial','',8);
		$y=$this->GetY();
		$this->SetX($x_izq);
		$this->MultiCell(95,4,"$detalle_orden  ","0","J");

		$this->SetY($y);
		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(95,6,strtoupper(_(''))."","LTR",0,"J");
		$this->Ln();
		$this->SetX($x_izq);
		$this->Cell(95,6,"","LRB",0,"J");

		
		
		
		$this->SetY($yy);
		$this->SetX($x_izq+95);
		
        $this->SetFont('Arial','B',10);
        $this->Cell(85,6,"SERVICIOS SUSCRITOS",'0',0,'L'); 

        $this->SetFont('Arial','B',9);
        $this->Ln();
        $this->SetX($x_izq+95);
        $this->Cell(20,6,"Cantidad",'0',0,'L'); 
        $this->Cell(75,6,"Descripcion",'0',0,'L'); 
         $this->Ln(5);
        $this->SetFont('Arial','',8);
        $acceso->objeto->ejecutarSql("SELECT nombre_servicio,cant_serv FROM vista_cont_serv where id_contrato='$id_contrato' ");
		while($row=row($acceso)){
			$nombre_servicio=utf8_decode(trim($row['nombre_servicio']));
			$cant_serv=trim($row['cant_serv']);
			
			$this->SetX($x_izq+95);
			$this->Cell(20,4,$cant_serv."    ","0",0,"C");
			$this->Cell(75,4,$nombre_servicio,"0",0,"J");
			$this->Ln();
        	//$this->Cell(35,5,$ubicacion,"0",0,"J");
		}


        $this->SetY($yy+6);
        $this->SetX($x_izq+95);
		$this->Cell(95,30,"","1",0,"J");

        $this->Ln();


		
		
		
	//	$this->SetXY($x_izq,70);
		//$this->SetFont('Arial','B',9);
		//$this->Cell(190,6,strtoupper(_('departamento de atencion al cliente')).": ","1",0,"C");
		
		
		
		$acceso->objeto->ejecutarSql("SELECT  nombre_servicio, cant_serv FROM contrato_servicio,servicios where contrato_servicio.id_serv=servicios.id_serv and  id_contrato='$id_contrato' ");
		$paquete='';
		
		while ($row=row($acceso)){
				$paquete=$paquete.utf8_decode(trim($row["nombre_servicio"])).": ".utf8_decode(trim($row["cant_serv"]))."; ";
			//	echo $paquete;
		}
		
		
		$this->Ln(2);
                
        $this->SetFont('Arial','B',10);
        $this->Cell(85,6,"DATOS DE EQUIPOS",'0',0,'L'); 


		$this->Ln();
		$y=$this->GetY();
		
		$this->SetY($y);
		$this->Cell(95,20,"","1",0,"J");
		$this->Cell(95,20,"","1",0,"J");


		$this->SetY($y);

		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,6,"Numero","",0,"J");
		$this->Cell(30,6,"Modelo","",0,"J");
		$this->Cell(35,6,"Ubicacion","",0,"J");
		
		$this->Cell(30,6,"Numero","",0,"J");
		$this->Cell(30,6,"Modelo","",0,"J");
		$this->Cell(30,6,"Ubicacion","",0,"J");



		$this->SetFont('Arial','',9);

		$this->SetY($y);
		$this->SetX($x_izq);
		//echo "SELECT *FROM vista_equipo_sistema where id_contrato='$id_contrato'  LIMIT 3 offset 0";
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_equipo_sistema where id_contrato='$id_contrato'  LIMIT 3 offset 0");
		while($row=row($acceso)){
			$codigo_es=utf8_decode(trim($row['codigo_es']));
			$nombre_modelo=utf8_decode(trim($row['nombre_modelo']));
			$ubicacion="dormitorio";

			$this->Ln();
			$this->SetFont('Arial','',8);
			$this->Cell(30,5,$codigo_es,"0",0,"J");
			$this->Cell(30,5,$nombre_modelo,"0",0,"J");
			//$this->Cell(35,5,$ubicacion,"0",0,"J");
		}

		$this->SetY($y);
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_equipo_sistema where id_contrato='$id_contrato'  LIMIT 3 offset 3");
		while($row=row($acceso)){
			$codigo_es=utf8_decode(trim($row['codigo_es']));
			$nombre_modelo=utf8_decode(trim($row['nombre_modelo']));
			$ubicacion="dormitorio";
			$this->Ln();
			$this->SetX(105);
			$this->SetFont('Arial','',8);
			$this->Cell(30,5,$codigo_es,"0",0,"J");
			$this->Cell(30,5,$nombre_modelo,"0",0,"J");
			//$this->Cell(35,5,$ubicacion,"0",0,"J");
		}
		$this->SetY($y+14);

                $this->Ln(7);
                
                $this->SetFont('Arial','B',10);
                $this->Cell(85,6,"INFORMACION TECNICA",'0',0,'L'); 

		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,5,strtoupper(_('creado por')).": ","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(65,5,$atendido_por,"RTB",0,"L");
		$this->SetFont('Arial','B',9);
		$this->Cell(15,5,strtoupper(_('fecha')).": ","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(35,5,$fecha_orden,"RTB",0,"L");
		
		$this->SetFont('Arial','B',9);
		$this->Cell(15,5,strtoupper(_('hora')).": ","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(30,5,$hora_emi,"RTB",0,"L");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->SetFont('Arial','B',9);
		$this->Cell(30,5,strtoupper(_('impreso por')).": ","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(65,5,$impreso_por,"RTB",0,"L");
		$this->SetFont('Arial','B',9);
		$this->Cell(15,5,strtoupper(_('fecha')).": ","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(35,5,$fecha_imp,"RTB",0,"L");
		
		$this->SetFont('Arial','B',9);
		$this->Cell(15,5,strtoupper(_('hora')).": ","LTB",0,"L");
		$this->SetFont('Arial','',9);
		$this->Cell(30,5,$hora_imp,"RTB",0,"L");

 				$this->Ln();
                $this->SetX($x_izq);
                $this->SetFont('Arial','B',9);
                $this->Cell(95,6,strtoupper(_('observaciones')).": ","0",0,"L");
                $this->SetX($x_izq);
                $this->Cell(95,20,'',"1",0,"L");
                $this->Cell(95,20,'',"1",0,"L");
                $this->SetX($x_izq+95);

                $this->SetFont('Arial','B',8);          
                $this->Cell(110,7,strtoupper(_('realizado por')).": ".' __________________________________________',"0",0,"J");
                $this->Ln();
                $this->SetX($x_izq+95);
                $this->Cell(110,7,strtoupper(_('Ayudante')).":           ".' __________________________________________',"0",0,"J");
                $this->Ln();
                $this->SetX($x_izq+95);
                $this->Cell(25,7,strtoupper(_('fecha y hora')).": ","0",0,"J");
                $this->Cell(40,7,' ______/_______/__________',"0",0,"J");
                $this->Cell(30,7,' ________:________',"0",0,"J");

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
                        
                        $this->Ln(2);
                        $this->SetX(10);
                        $this->SetFont('Arial','B',10);
                        $this->Cell(85,6,strtoupper("materiales utilizados"),'0',0,'L'); 
                        
                        $this->Ln();
						$y=$this->GetY();
						

                        $this->SetFont('Arial','B',8);
                        $this->SetX(10);
                        $this->Cell(100,6,strtoupper("INICIO CABLE _______________  FIN CABLE _______________"),'0',0,'L'); 
                        
                        $this->Ln(4);
                        
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

                        $this->SetY($y);
                        $this->Cell(190,25,"","1",0,"C");
                        $this->Ln(20);
                }
        }
	function mas_datos($acceso,$id_orden)
	{
		$x_izq=10;
		$x_medio=100;
		$x_der=150;
		
		$this->Ln(7);
		$this->SetX(10);
		$this->SetFont('Arial','B',10);
		$this->MultiCell(195,6,"VISITAS",'0','L');



		
			
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
		
		$this->SetFont('Arial','B',10);
		$this->Ln(9);
		$this->SetX($x_izq);
		$this->Cell(190,5,strtoupper(_('conformidad del cliente ')).": ","0",0,"L");
		
		$this->SetFont('Arial','',8);	
		$this->Ln();
		$this->SetX($x_izq);
		$this->Cell(120,7,"CEDULA Y NOMBRE: ","1",0,"J");
		$this->Cell(70,7,"TELEFONO:","1",0,"J");
		
		$this->Ln();
		$this->SetX($x_izq);
		$this->Cell(190,7,strtoupper(_('observaciones ')).": ","LRT",0,"J");
		$this->Ln();
		$this->SetX($x_izq);
		$this->Cell(190,6,"","LRB",0,"J");
		

		$this->Ln(18);
		$this->SetX(25);
		$this->Cell(40,8,"FIRMA CLIENTE","T",0,"C");

		$this->SetX(85);
		$this->Cell(40,8,"FIRMA TECNICO","T",0,"C");

		$this->SetX(145);
		$this->Cell(40,8,"FIRMA SUPERVISOR","T",0,"C");

	}	
	function Footer(){
		$this->AliasNbPages();
		$this->SetXY(180,-8);
		
		$this->SetFont('Arial','I',8);
	    $this->Cell(0,7,'Pag. '.$this->PageNo().' / {nb}',0,1,'C');
	}
}
$pdf=new PDF();    
      
$pdf->SetDisplayMode("real");
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,3);
$pdf->AddPage('P','letter');
$pdf->Cuerpo($acceso,$id_orden);
$pdf->mas_datos($acceso,$id_orden);
$pdf->Output('reporte.pdf','D');

?> 