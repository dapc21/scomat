<?php
session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
class ordenes_tecnicos
{
	private $id_orden;
	private $fecha_imp;
	private $id_det_orden;
	private $fecha_orden;
	private $fecha_final;
	private $detalle_orden;
	private $comentario_orden;
	private $status_orden;
	private $id_contrato;
	private $prioridad;
	private $id_gt;
	private $asig_aut;
	private $dat;
	function __construct($dat)
	{
		$this->id_orden = $dat['id_orden'];
		$this->fecha_imp = $dat['fecha_imp'];
		$this->id_det_orden = $dat['id_det_orden'];
		$this->fecha_orden = $dat['fecha_orden'];
		$this->fecha_final = $dat['fecha_final'];
		$this->detalle_orden = $dat['detalle_orden'];
		$this->comentario_orden = $dat['comentario_orden'];
		$this->status_orden = $dat['status_orden'];
		$this->id_contrato = $dat['id_contrato'];
		$this->prioridad = $dat['prioridad'];
		$this->id_gt = $dat['id_gt'];
		$this->dat = $dat;
	}
	public function validaExistencia($acceso){
		$acceso->objeto->ejecutarSql("select * from ordenes_tecnicos where id_orden='$this->id_orden'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		if($this->id_gt==''){
			$acceso->objeto->ejecutarSql("select id_gt from grupo_trabajo"); 
			$row=row($acceso);
			$this->id_gt=trim($row['id_gt']);
			$this->dat['id_gt']=$this->id_gt;
		}
		
		$this->fecha_orden = date("Y-m-d");
		
		$login= $_SESSION["login"];
		$hora=date("H:i:s");
		// echo  "entro a incluir";
		$this->status_orden = "CREADO";
		//echo "insert into ordenes_tecnicos(id_orden,id_det_orden,fecha_orden,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad,login,hora) values ('$this->id_orden','$this->id_det_orden','$this->fecha_orden','$this->detalle_orden','$this->comentario_orden','$this->status_orden','$this->id_contrato','$this->prioridad','$login','$hora')";
		if($acceso->objeto->ejecutarSql("insert into ordenes_tecnicos(id_orden,id_det_orden,fecha_orden,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad,login,hora) values ('$this->id_orden','$this->id_det_orden','$this->fecha_orden','$this->detalle_orden','$this->comentario_orden','$this->status_orden','$this->id_contrato','$this->prioridad','$login','$hora')")){
		}
		$this->evento($acceso);
		$acceso->objeto->ejecutarSql("select id_tipo_orden from detalle_orden where id_det_orden='$this->id_det_orden'");
		$row=row($acceso);
		$id_tipo_orden=trim($row['id_tipo_orden']);
		if($id_tipo_orden=='EA00001' || $this->id_det_orden=='DEO00010' || $this->id_det_orden=='DEO00003' || $this->id_det_orden=='EA00053' ){
			$this->fecha_final = date("Y-m-d");
			$this->imprimir($acceso);
			$this->finalizar($acceso);
		}
			
	}
	public function imprimir($acceso)
	{
		require_once "orden_grupo.php";
		$obj=new orden_grupo($this->dat);
		$obj->incluir($acceso);

		$this->fecha_imp = date("Y-m-d");
		$login= $_SESSION["login"];
		$hora=date("H:i:s");
		 $acceso->objeto->ejecutarSql("Update ordenes_tecnicos Set status_orden='IMPRESO',fecha_imp='$this->fecha_imp',login_imp='$login', hora_imp='$hora' Where id_orden='$this->id_orden'");	
	}
	public function finalizar($acceso)
	{
		
		$ini_u = $_SESSION["ini_u"];
		$acceso->objeto->ejecutarSql("select * from ordenes_tecnicos where id_orden='$this->id_orden'");
		$row=row($acceso);
		$this->id_contrato=trim($row['id_contrato']);
		
		$fecha=date("Y-m-d");
		require_once "orden_grupo.php";
		$obj=new orden_grupo($this->dat);
		$obj->incluir($acceso);

		if($this->fecha_final==''){
			$this->fecha_final=date("Y-m-d");
		}
		//echo "fecha_final:$this->fecha_final:";
		$this->fecha_final=formatfecha($this->fecha_final);
		//echo "fecha_final:$this->fecha_final:";
		$login= $_SESSION["login"];
		$hora=date("H:i:s");
		$fecha_cierre=date("Y-m-d");
		$acceso->objeto->ejecutarSql("Update ordenes_tecnicos Set id_det_orden='$this->id_det_orden', fecha_final='$this->fecha_final', status_orden='FINALIZADO', comentario_orden='$this->comentario_orden',login_fin='$login', hora_fin='$hora', fecha_cierre='$fecha_cierre' Where id_orden='$this->id_orden'");
		$this->status_orden='FINALIZADO';
		$this->evento($acceso);
		
		if($this->id_det_orden=="DEO00010"){
		}

	}
	public function incluirordenes_tecnicos_clases($acceso)
	{
		
		$this->fecha_orden = date("Y-m-d");
		$this->fecha_imp = date("Y-m-d");
		$this->fecha_final = date("Y-m-d");
		
		
						session_start();
						$id_fr = $_SESSION["id_franq"]; 
						$serie='';
						if($id_fr!='0'){
							$cons=" and  id_franq='$id_fr'";
							$acceso->objeto->ejecutarSql("select serie from franquicia where id_franq='$id_fr'");
							$row=row($acceso);
							$serie= trim($row["serie"]);
						}
						else{
							$cons=" and  id_franq='1'";
						}
						
						
						session_start();
						$ini_u = $_SESSION["ini_u"];  
						$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos  where (id_orden ILIKE '$ini_u%')   ORDER BY id_orden desc LIMIT 1 offset 0 ");
						$this->id_orden=$ini_u.verCodLong($acceso,"id_orden");
						
						/*
						$acceso->objeto->ejecutarSql("select nro_orden from ordenes_tecnicos, contrato,vista_ubica where  ordenes_tecnicos.id_contrato = contrato.id_contrato and contrato.id_calle=vista_ubica.id_calle  ORDER BY num_o desc  LIMIT 1 offset 0 "); 
						$nro_orden = verNumero($acceso,"nro_orden");
						*/
		
		$login= $_SESSION["login"];
		$hora=date("H:i:s");
		// echo  "entro a incluir";
		if($acceso->objeto->ejecutarSql("insert into ordenes_tecnicos(id_orden,id_det_orden,fecha_orden,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad,login,hora) values ('$this->id_orden','$this->id_det_orden','$this->fecha_orden','$this->detalle_orden','$this->comentario_orden','$this->status_orden','$this->id_contrato','$this->prioridad','$login','$hora')")){
			
		}
		$this->status_orden = "CREADO";
		$this->evento($acceso);
		
	}
	public function solo_incluirordenes_tecnicos($acceso)
	{
		$this->fecha_orden = date("Y-m-d");
		$this->fecha_imp = date("Y-m-d");
		$this->fecha_final = date("Y-m-d");
		session_start();
						$id_fr = $_SESSION["id_franq"]; 
						$serie='';
						if($id_fr!='0'){
							$cons=" and  id_franq='$id_fr'";
							$acceso->objeto->ejecutarSql("select serie from franquicia where id_franq='$id_fr'");
							$row=row($acceso);
							$serie= trim($row["serie"]);
						}
						else{
							$cons=" and  id_franq='1'";
						}
						
						$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos, contrato,vista_ubica where  ordenes_tecnicos.id_contrato = contrato.id_contrato and contrato.id_calle=vista_ubica.id_calle  ORDER BY num_o desc  LIMIT 1 offset 0 "); 
						$this->id_orden = verNumero($acceso,"id_orden");
		
		$login= $_SESSION["login"];
		$hora=date("H:i:s");

		return $acceso->objeto->ejecutarSql("insert into ordenes_tecnicos(id_orden,id_det_orden,fecha_orden,detalle_orden,comentario_orden,status_orden,id_contrato,prioridad,login,hora) values ('$this->id_orden','$this->id_det_orden','$this->fecha_orden','$this->detalle_orden','$this->comentario_orden','$this->status_orden','$this->id_contrato','$this->prioridad','$login','$hora')");
	}

	public function modificar($acceso){
		$acceso->objeto->ejecutarSql("Update ordenes_tecnicos Set id_det_orden='$this->id_det_orden',  detalle_orden='$this->detalle_orden', comentario_orden='$this->comentario_orden', prioridad='$this->prioridad'  Where id_orden='$this->id_orden'");
	}
	public function mod_status_ordenes_tecnicos($acceso){
		$login= $_SESSION["login"];
		$hora=date("H:i:s");
		$fecha_imp=date("Y-m-d");
		
		 $acceso->objeto->ejecutarSql("Update ordenes_tecnicos Set fecha_final='$fecha_imp',login_imp='$login', hora_imp='$hora' status_orden='$this->status_orden'  Where id_orden='$this->id_orden'");	
			
	}
	public function reasignarordenes_tecnicos($acceso)
	{
		require_once "orden_grupo.php";
		
		$obj=new orden_grupo($this->id_orden,$this->id_gt,"f");
		$obj->modif_orden_grupo_aut($acceso);
		
	}
	public function revertirordenes_tecnicos($acceso)
	{
		
		require_once "orden_grupo.php";
		$obj=new orden_grupo($this->id_orden,$this->id_gt,"f");
		$obj->modif_orden_grupo_aut($acceso);
		 $acceso->objeto->ejecutarSql("Update ordenes_tecnicos Set status_orden='CREADO' Where id_orden='$this->id_orden'");	
			
	}
	public function eliminar($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("delete from ordenes_tecnicos where id_orden='$this->id_orden'");
			
	}
	public function evento($acceso){
		// echo  "entro a evento";
		$acceso->objeto->ejecutarSql("select * from detalle_orden where id_det_orden='$this->id_det_orden'");
		if($row=row($acceso)){
			$emite_status=trim($row['emite_status']);
			$final_status=trim($row['final_status']);
			$final_anula_status=trim($row['final_anula_status']);
			//$emite_cargo_tipo=trim($row['emite_cargo_tipo']);
			//$emite_cargo_id_serv=trim($row['emite_cargo_id_serv']);
			$reemplaza_act=trim($row['reemplaza_act']);
			// echo  "REEMPL:$reemplaza_act:";
			$final_cargo_tipo=trim($row['final_cargo_tipo']);
			//$final_cargo_id_serv=trim($row['final_cargo_id_serv']);
			$emite_deco=trim($row['emite_deco']);
			$final_deco=trim($row['final_deco']);
			$emite_cablemoden=trim($row['emite_cablemoden']);
			$final_cablemodem=trim($row['final_cablemodem']);
			$fecha_ult_id_det_orden=trim($row['fecha_ult_id_det_orden']);
			$final_agrega_id_serv=trim($row['final_agrega_id_serv']);
			
			// echo  "satus:$this->status_orden:";
			if($this->status_orden=="CREADO"){
				if($emite_status!=''){
					// echo  "Update contrato Set status_contrato='$emite_status' Where id_contrato='$this->id_contrato'";
					$acceso->objeto->ejecutarSql("Update contrato Set status_contrato='$emite_status' Where id_contrato='$this->id_contrato'");
				}
				if($emite_cargo_tipo!=''){
					if($emite_cargo_tipo=='COMPLETO'){
						// echo  "entro a cargar:$emite_cargo_id_serv:";
				//		$this->cargar_deuda_completo($acceso,$emite_cargo_id_serv);
					}
				}
			}
			else if($this->status_orden=="FINALIZADO"){
				// echo  ":$final_cargo_tipo:";
				if($final_status!=''){
					// echo  "ACTIVO ORDEN Update contrato Set status_contrato='$final_status' Where id_contrato='$this->id_contrato'";
					$acceso->objeto->ejecutarSql("Update contrato Set status_contrato='$final_status' Where id_contrato='$this->id_contrato'");	
				}
				if($final_cargo_tipo!=''){
					if($final_cargo_tipo=='COMPLETO'){
						$this->cargar_deuda_completo($acceso,$final_cargo_id_serv);
					}
					else if($final_cargo_tipo=='PRORRATEODESDE' || $final_cargo_tipo=='PRORRATEOHASTA'){
						// echo  "entro en la condicion";
						$this->registra_prorrateo($acceso,$final_cargo_tipo,$reemplaza_act);
					}
				}
				//echo ":$final_agrega_id_serv:";
				if($final_agrega_id_serv!=''){
			//		$this->cargar_deuda_completo($acceso,$final_agrega_id_serv);
				}
				if($final_deco!=""){
					$this->enviar_comando_interfaz($acceso,$final_deco);
				}
			}
			else if($this->status_orden=="CANCELADA"){
				if($final_anula_status!=''){
				//	// echo  "ANULO ORDEN Update contrato Set status_contrato='$final_anula_status' Where id_contrato='$this->id_contrato'";
					$acceso->objeto->ejecutarSql("Update contrato Set status_contrato='$final_anula_status' Where id_contrato='$this->id_contrato'");	
				}
			}

			
		}
	}
	public function cargar_deuda_completo($acceso,$emite_cargo_id_serv){
		require_once "cargar_deuda.php";

		$id_s=explode(";",$emite_cargo_id_serv);
			for($i=0;$i<count($id_s);$i++){
				$id_serv=trim($id_s[$i]);
				//	// echo  "ENTRO A CARGAR DEUDA COMPLETO:$id_serv:";
				$acceso->objeto->ejecutarSql("select tipo_costo from servicios where id_serv='$id_serv'");
				if($row=row($acceso)){
					$tipo_costo=trim($row['tipo_costo']);
					if($tipo_costo=="COSTO UNICO"){
						$acceso->objeto->ejecutarSql("select tarifa_ser from tarifa_servicio where id_serv='$id_serv' and status_tarifa_ser='ACTIVO'");
						if($row=row($acceso)){
							$tarifa_ser=trim($row['tarifa_ser'])+0;
							$fecha=date("Y-m-d");
							$obj=new cargar_deuda($this->id_contrato,$id_serv,"COSTO UNICO",$fecha,$tarifa_ser);
							$obj->cargarcargar_deuda($acceso);
						}
					}
					else if($tipo_costo=="COSTO MENSUAL"){
						$fecha=date("Y-m-01");
						$obj=new cargar_deuda($this->id_contrato,$id_serv,"COSTO MENSUAL",$fecha,0);
						$obj->cargar_deuda_mensual($acceso);
					}
				}
			}
	}
	public function enviar_comando_interfaz($acceso,$final_deco)
	{
		$status = "FALSE";
		$fecha = date("Y-m-d");
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		$login = strtoupper(trim($_SESSION["login"]));
		$acceso->objeto->ejecutarSql("select *from interfaz_equipos  where (id_inte ILIKE '$ini_u%') ORDER BY id_inte desc"); 
		$id_inte=$ini_u.verCoo($acceso,"id_inte");
			
		$comando=explode(";",$final_deco);
		//echo ":$final_deco:";
		for($i=0;$i<count($comando);$i++){
			$tipo_com=trim($comando[$i]);
			$cad='';
			$acceso1=conexion();
			$acceso1->objeto->ejecutarSql("select *from vista_equipo_sistema where id_contrato='$this->id_contrato'");
			while ($row1=row($acceso1))
			{
				$id_es=trim($row1["id_es"]);
				$id_tse=trim($row1["id_tse"]);
				$acceso->objeto->ejecutarSql("select *from comandos_interfaz WHERE status_com_int='ACTIVO' and id_tse='$id_tse' and tipo_com='$tipo_com' ");
				if ($row=row($acceso))
				{
					$id_com_int=trim($row["id_com_int"]);
					//ECHO "insert into interfaz_equipos(id_inte,id_com_int,id_es,status,fecha,login) values ('$id_inte','$id_com_int','$id_es','$status','now()','$login')";
					$acceso->objeto->ejecutarSql("insert into interfaz_equipos(id_inte,id_com_int,id_es,status,fecha,login) values ('$id_inte','$id_com_int','$id_es','$status','now()','$login')");
					 $id_inte=$ini_u.verCoo_inc($acceso,$id_inte);
				}
			}
		}
	}
	public function finalizarordenes_tecnicos_clases($acceso)
	{
		$ini_u = $_SESSION["ini_u"];
		$acceso->objeto->ejecutarSql("select * from ordenes_tecnicos where id_orden='$this->id_orden'");
		$row=row($acceso);
		if($this->id_det_orden==''){
			$this->id_det_orden=trim($row['id_det_orden']);
		}
	
		$this->id_contrato=trim($row['id_contrato']);
		if($this->prioridad!='ENGRUPO'){
			$acceso->objeto->ejecutarSql("Update contrato Set etiqueta='$this->status_orden' Where id_contrato='$this->id_contrato'");
		}

				
		$fecha=date("Y-m-d");
		
		require_once "orden_grupo.php";
		$obj=new orden_grupo($this->id_orden,$this->id_gt,'f');
		$obj->modif_orden_grupo_aut($acceso);

		if($this->fecha_final==''){
			$this->fecha_final=date("Y-m-d");
		}
		$login= $_SESSION["login"];
		$hora=date("H:i:s");
		$fecha_cierre=date("Y-m-d");
		$acceso->objeto->ejecutarSql("Update ordenes_tecnicos Set id_det_orden='$this->id_det_orden', fecha_final='$this->fecha_final', status_orden='FINALIZADO', comentario_orden='$this->comentario_orden',login_fin='$login', hora_fin='$hora', fecha_cierre='$fecha_cierre' Where id_orden='$this->id_orden'");
		$this->status_orden='FINALIZADO';
		$this->evento($acceso);
	}
	public function canceladafinalordenes_tecnicos($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from ordenes_tecnicos where id_orden='$this->id_orden'");
		if($row=row($acceso))
		{
				$this->id_det_orden=trim($row['id_det_orden']);
				$this->id_contrato=trim($row['id_contrato']);
		}
		
		/*
		if($this->id_det_orden=='DEO00001'){
			$acceso->objeto->ejecutarSql("Update contrato Set status_contrato='SUSPENDIDO' Where id_contrato='$this->id_contrato'");	
		}
		*/
		/*
		require_once "orden_grupo.php";
		$obj=new orden_grupo($this->id_orden,$this->id_gt,'f');
		$obj->modif_orden_grupo_aut($acceso);
		*/
		$login= $_SESSION["login"];
		$hora=date("H:i:s");
		$fecha = date("Y-m-d");
		$acceso->objeto->ejecutarSql("Update ordenes_tecnicos Set fecha_canc='$fecha', fecha_cierre='$fecha', fecha_final='$fecha', status_orden='CANCELADA', comentario_orden='$this->comentario_orden',login_fin='$login', hora_fin='$hora' Where id_orden='$this->id_orden'");	
		$this->status_orden='CANCELADA';
		$this->evento($acceso);
	}
	public function devolverordenes_tecnicos($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from ordenes_tecnicos where id_orden='$this->id_orden'");
		if($row=row($acceso))
		{
				$this->id_det_orden=trim($row['id_det_orden']);
				$this->id_contrato=trim($row['id_contrato']);
		}
		
		require_once "orden_grupo.php";
		$obj=new orden_grupo($this->id_orden,$this->id_gt,'f');
		$obj->modif_orden_grupo_aut($acceso);
		$login= $_SESSION["login"];
		$hora=date("H:i:s");
		$fecha_final=date("Y-m-d");
		// echo  "Update ordenes_tecnicos Set status_orden='DEVUELTA', comentario_orden='$this->comentario_orden',fecha_final='$fecha_final',login_fin='$login', hora_fin='$hora' Where id_orden='$this->id_orden'";
		$fecha = date("Y-m-d");
		return $acceso->objeto->ejecutarSql("Update ordenes_tecnicos Set status_orden='DEVUELTA', comentario_orden='$this->comentario_orden',fecha_dev='$fecha',login_fin='$login', hora_fin='$hora' Where id_orden='$this->id_orden'");	
	}
	function ultimo_corte($acceso,$fecha_ult_id_det_orden){
		/*
		$id_s=explode(";",$fecha_ult_id_det_orden);
			$detalle="";
			for($i=0;$i<count($id_s);$i++){
				$id=trim($id_s[$i]);
				if($i==0){
					$detalle=$detalle." id_det_orden='$id' ";
				}else{
					$detalle=$detalle." or id_det_orden='$id' ";
				}
			}
		$detalle=" and ( ".$detalle.")";
		*/
		$acceso->objeto->ejecutarSql("select fecha_final from ordenes_tecnicos where id_contrato='$this->id_contrato' $detalle order by fecha_final desc");
		if($row=row($acceso)){
			$f_corte=trim($row['fecha_final']);
		}
		if($f_corte==''){
			$f_corte = $this->fecha_final;
		}
		return $f_corte;
	}
	function dias_a_cobrar($acceso,$final_cargo_tipo){

		list($anio_final,$mes_final,$dia_final)=explode("-",$this->fecha_final);
		$dia_act = (int)$dia_final;
		$ult_dia_mes_act=date("t",mktime( 0, 0, 0, $mes_final, 1, $anio_final ));
			if($final_cargo_tipo=='PRORRATEODESDE'){
				$dias_a_cobrar=$ult_dia_mes_act-$dia_act+1;
			}
			if($final_cargo_tipo=='PRORRATEOHASTA'){
				$dias_a_cobrar=$dia_act-1;
			}
		return $dias_a_cobrar;
	}
	function registra_prorrateo($acceso,$final_cargo_tipo,$reemplaza_act){

		//echo  "<br>: registra_prorrateo :$final_cargo_tipo: fecha_final: $this->fecha_final :";
		$dias_a_cobrar=$this->dias_a_cobrar($acceso,$final_cargo_tipo);
			echo  "<br>: dias_cobrar : $dias_a_cobrar:";
		$dato=lectura($acceso,"select * from contrato_servicio,servicios where contrato_servicio.id_serv=servicios.id_serv and id_contrato='$this->id_contrato' and status_con_ser='CONTRATO' and tipo_costo='COSTO MENSUAL'");
		for($i=0;$i<count($dato);$i++){
			$id_serv=trim($dato[$i]['id_serv']);
			$costo_cobro=trim($dato[$i]['costo_cobro'])+0;
			$cant_serv=trim($dato[$i]['cant_serv'])+0;
			
			$tarifa_ser='';
			
			$tarifa_ser=verTarifa($acceso,$this->fecha_final,$id_serv);
			
			$acceso->objeto->ejecutarSql("select tarifa_esp from servicios where id_serv='$id_serv'"); 
			 if($row=row($acceso)){
				$tarifa_esp=trim($row['tarifa_esp']);
			 }
			if($tarifa_esp=="TRUE"){
					$tarifa_ser=$costo_cobro;
			}
			// echo  ":$tarifa_ser:tarifa: $tarifa_ser :";
			list($anio_final,$mes_final,$dia)=explode("-",$this->fecha_final);
			$ult_dia_mes_act=date("t",mktime( 0, 0, 0, $mes_final, 1, $anio_final ));
			//$fecha1 = "$anio_final-$mes_final-01";
			$fecha1 = $anio_final."-".$mes_final."-01";
			//echo ":$dias_a_cobrar:$tarifa_ser:$ult_dia_mes_act:";
			$restante=(($dias_a_cobrar*$tarifa_ser)/$ult_dia_mes_act)+0;
			$restante=number_format($restante, 0, '.', '');
			$this->registra_cargo_prorrateo($acceso,$restante,$fecha1,$id_serv,$cant_serv,$reemplaza_act);
		}
	}
	function registra_cargo_prorrateo($acceso,$restante,$fecha1,$id_serv,$cant_serv,$reemplaza_act){
		// echo  ": registra_cargo_prorrateo : ";
		$ini_u = $_SESSION["ini_u"]; 
		$monto_posterior=$restante;
		$generado_por='SISTEMA';
		require_once "notas.php";
		$objeto=new notas();
			
			$acceso->objeto->ejecutarSql("select idmotivonota from motivonotas; "); 
				if($row=row($acceso)){
					$motivo=trim($row['idmotivonota']);
					
				}
		
		$comentario='AJUSTE POR PRORRATEO';
						
			
					$acceso->objeto->ejecutarSql("select *from vista_contrato_servicio_deuda where id_contrato='$this->id_contrato' and fecha_inst='$fecha1' and id_serv='$id_serv'"); 
				if($row=row($acceso)){
					$id_cont_serv=trim($row['id_cont_serv']);
					$monto_anterior=trim($row["costo_cobro"]);
					
					if($monto_anterior>$monto_posterior){
						$tipo="NOTA DE CREDITO";
					}
					else if($monto_anterior<$monto_posterior){
						$tipo="NOTA DE DEBITO";
					}
					if($tipo!=""){
						// echo  "CONDICION:$reemplaza_act:";
						if($reemplaza_act=="AGREGA"){
							$restante=$restante+$monto_anterior;
							// echo  ":monto_anterior:$monto_anterior:$monto_anterior:Update contrato_servicio_deuda Set costo_cobro='$restante' Where id_cont_serv='$id_cont_serv' and status_con_ser='DEUDA'";
							$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set costo_cobro='$restante' Where id_cont_serv='$id_cont_serv' and status_con_ser='DEUDA'");
						}
						else if($reemplaza_act=="OMITE"){
							$restante=0;
						}
						else{
							$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set costo_cobro='$restante' Where id_cont_serv='$id_cont_serv' and status_con_ser='DEUDA'");
						}
					//	// echo  "Update contrato_servicio_deuda Set costo_cobro='$restante' Where id_cont_serv='$id_cont_serv' and status_con_ser='DEUDA'";
						$objeto->incluirnotas($acceso,$tipo,$id_cont_serv,$monto_anterior,$monto_posterior,$motivo,$comentario,$generado_por,$this->id_contrato);
					}
				}
				else{
						$tipo="NOTA DE DEBITO";
						$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
						$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
						$monto_anterior=0;
						// echo  "insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$this->id_contrato','$fecha1','$cant_serv','DEUDA','$restante','0','AUTOMATICO')";
						//esta pendiente
						/*
						$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$this->id_contrato','$fecha1','$cant_serv','DEUDA','$restante','0','AUTOMATICO')");
						$monto_posterior=$restante;
						$motivo='CC00002';
						$objeto->incluirnotas($acceso,$tipo,$id_cont_serv,$monto_anterior,$monto_posterior,$motivo,$comentario,$generado_por,$this->id_contrato);

						*/
				}
	}
	function restante_mes($acceso){
		$acceso->objeto->ejecutarSql("select * from ordenes_tecnicos where id_contrato='$this->id_contrato' order by fecha_final desc");
		while($row=row($acceso)){
			$id_det_orden=trim($row['id_det_orden']);
			if($this->id_det_orden=='DEO00001'){
				if($id_det_orden=='DEO00001'){
					$f_corte=trim($row['fecha_final']);
					if($f_corte==""){
						$f_corte=trim($row['fecha_orden']);
					}
					break;
				}
			}
			else{
				if($id_det_orden=='DEO00010' || $id_det_orden=='DEO00011' ){
					$f_corte=trim($row['fecha_final']);
					if($f_corte==""){
						$f_corte=trim($row['fecha_orden']);
					}
					break;
				}
			}
		}
		if($f_corte==''){
			$f_corte = date("Y-m-01");
		}
		//// echo  "f_corte=$f_corte:";
		$fec = explode ( "-", $f_corte );
		$dia=(int)$fec[2];
		$mes=$fec[1];
		$anio=$fec[0];
		
		$fecha_corte="$anio-$mes-01";
		$ult_dia_mes_corte=date("t",mktime( 0, 0, 0, $mes, 1, $anio ));
		
		$fec_final = explode ( "-", $this->fecha_final);

		$dia_final=$fec_final[2];
		$mes_final=$fec_final[1];
		$anio_final=$fec_final[0];
		$ult_dia_mes_act=date("t",mktime( 0, 0, 0, $mes_final, 1, $anio_final ));
		//echo "this->fecha_final=$this->fecha_final:";
		$fecha1 = $anio_final."-".$mes_final."-01";
		$anio_mes = $anio_final."-".$mes_final;
		$dia_act = (int)$dia_final;
		
		
			//echo "id_contrato=$this->id_contrato:id_det=$this->id_det_orden:";
			if($this->id_det_orden=='DEO00001'){
				$dias_a_cobrar=$ult_dia_mes_act-$dia_act;
			}
			else if($this->id_det_orden=='DEO00010' || $this->id_det_orden=='DEO00011'){
				$dias_a_cobrar=$dia_act;
			}
			else if($this->id_det_orden=='DEO00003'){
				if(trim($fecha_corte)==trim($fecha1)){
					$dias_a_cobrar=$dia+($ult_dia_mes_act-$dia_act);
				}
				else{
					$dias_a_cobrar=$ult_dia_mes_act-$dia_act;
				}
			}

			//echo "dias a cobrar=$dias_a_cobrar:";
			$dato=lectura($acceso,"select *from contrato_servicio where id_contrato='$this->id_contrato' and status_con_ser='CONTRATO'");
			for($i=0;$i<count($dato);$i++){
				$id_serv=trim($dato[$i]['id_serv']);
				$cant_serv=trim($dato[$i]['cant_serv']);
				$tarifa_ser=verTarifa($acceso,$fecha1,$id_serv);
				//echo "tarifa_ser=$tarifa_ser:";
				$restante=(($dias_a_cobrar*$tarifa_ser)/$ult_dia_mes_act)+0;
				$restante=number_format($restante, 0, '.', '');
				//echo "restante=$restante:";
				$this->registrarCobro($acceso,$restante,$fecha1,$id_serv,$cant_serv);
			}
	}
	function registrarCobro($acceso,$restante,$fecha1,$id_serv,$cant_serv){
		$ini_u = $_SESSION["ini_u"]; 
		$monto_posterior=$restante;
		$generado_por='SISTEMA';
		require_once "notas.php";
		$objeto=new notas();
		
		$acceso->objeto->ejecutarSql("select idmotivonota from motivonotas; "); 
				if($row=row($acceso)){
					$motivo=trim($row['idmotivonota']);
					
				}
		//$motivo='MOT00002';
		$comentario='AJUSTE POR INSTALACION, CORTE O SUSPENSION';
						
		
				$acceso->objeto->ejecutarSql("select *from vista_contratodeu where id_contrato='$this->id_contrato' and fecha_inst='$fecha1' and id_serv='$id_serv'"); 
				if($row=row($acceso)){
					$id_cont_serv=trim($row['id_cont_serv']);
					$monto_anterior=trim($row["costo_cobro"]);
					
					if($monto_anterior>$monto_posterior){
						$tipo="NOTA DE CREDITO";
					}
					else if($monto_anterior<$monto_posterior){
						$tipo="NOTA DE DEBITO";
					}
					if($tipo!=""){
						//echo "actualizar=$restante:";
						$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set costo_cobro='$restante' Where id_cont_serv='$id_cont_serv' and status_con_ser='DEUDA'");
						actualizarDeuda($acceso,$this->id_contrato);
						$motivo='CC00002';
						$objeto->incluirnotas($acceso,$tipo,$id_cont_serv,$monto_anterior,$monto_posterior,$motivo,$comentario,$generado_por,$this->id_contrato);
					}
				}
				else{
						$tipo="NOTA DE DEBITO";
						$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
						$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
						$monto_anterior=0;
						
					$acceso->objeto->ejecutarSql("select costo_cobro from contrato_servicio_pagado where id_contrato='$this->id_contrato' and fecha_inst='$fecha1' and id_serv='$id_serv'");
					if($row=row($acceso)){
						$costo_cobro=trim($row["costo_cobro"]);
						$restante=$restante-$costo_cobro;
						if($costo_cobro>0){
							$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$this->id_contrato','$fecha1','$cant_serv','DEUDA','$restante','0','AUTOMATICO')");
							$monto_posterior=$restante;
							//echo "cobrado menos facturado=$restante:$costo_cobro:";
							$motivo='CC00002';
							$objeto->incluirnotas($acceso,$tipo,$id_cont_serv,$monto_anterior,$monto_posterior,$motivo,$comentario,$generado_por,$this->id_contrato);
						}
					}
					else{
						//echo "registro nuevo=$restante:";
						$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$this->id_contrato','$fecha1','$cant_serv','DEUDA','$restante','0','AUTOMATICO')");
						$monto_posterior=$restante;
						$motivo='CC00002';
						$objeto->incluirnotas($acceso,$tipo,$id_cont_serv,$monto_anterior,$monto_posterior,$motivo,$comentario,$generado_por,$this->id_contrato);
					}
				}
	}
}
?>