<?php
class notas
{
	private $login_sol;
	private $login_sol;
	private $hora;
	private $tipo;
	private $status;
	private $dir_ip;
	private $comentario;
	private $id_cont_serv;
	private $monto_anterior;
	private $monto_posterior;
	private $idmotivonota;
	private $generado_por;
	private $id_contrato;

	function __construct()
	{
		session_start();
		$this->login_sol = strtoupper(trim($_SESSION["login"]));
		$this->login_sol = date("Y-m-d");
		$this->hora = date("H:i:s");
		$this->dir_ip = $_SERVER['REMOTE_ADDR'];
		$this->status = "ACTIVO";
	}
	public function incluirnotas($acceso,$tipo,$id_cont_serv,$monto_anterior,$monto_posterior,$idmotivonota,$comentario,$generado_por,$id_contrato)
	{
		$this->tipo = $tipo;
		$this->comentario = $comentario;
		$this->generado_por = $generado_por;
		$this->id_contrato = $id_contrato;
		$this->id_cont_serv = $id_cont_serv;
		$this->monto_anterior = $monto_anterior+0;
		$this->monto_posterior = $monto_posterior+0;
		$this->idmotivonota = $idmotivonota;
		
		//ECHO "select *from notas  where tipo='$this->tipo' ORDER BY nro_nota desc"; 
		 $acceso->objeto->ejecutarSql("select *from notas  where tipo='$this->tipo' AND nro_nota>0 ORDER BY nro_nota desc LIMIT 1 OFFSET 0"); 
		 $nro_nota=verNumero($acceso,"nro_nota");
		//echo "$this->monto_anterior : $this->monto_posterior";
		if($this->monto_anterior >= $this->monto_posterior){
			$this->tipo="NOTA DE CREDITO";
		}
		else {
			$this->tipo="NOTA DE DEBITO";
		}
	
		 if($this->tipo=="NOTA DE CREDITO"){
			$monto_nota=abs($this->monto_anterior - $this->monto_posterior);
		 }
		 else{
			$monto_nota=abs($this->monto_posterior - $this->monto_anterior);
		 }
		 
session_start();
$ini_u = $_SESSION["ini_u"]; 
$acceso->objeto->ejecutarSql("select  id_nota from notas  where (id_nota ILIKE '$ini_u%')   ORDER BY id_nota desc LIMIT 1 offset 0 ");
$id_nota=$ini_u.verCodLong($acceso,"id_nota");
		 
		return $acceso->objeto->ejecutarSql("insert into notas(id_nota,login_sol,id_cont_serv,tipo,dir_ip,login_sol,hora,monto_anterior,monto_posterior,idmotivonota,comentario,status,generado_por,id_contrato,nro_nota,monto_nota) values ('$id_nota','$this->login_sol','$this->id_cont_serv','$this->tipo','$this->dir_ip','$this->login_sol','$this->hora','$this->monto_anterior','$this->monto_posterior','$this->idmotivonota','$this->comentario','$this->status','$this->generado_por','$this->id_contrato','$nro_nota','$monto_nota')");
	}
	
	public function solicitar_notas($acceso,$tipo,$id_cont_serv,$monto_anterior,$monto_posterior,$idmotivonota,$comentario,$generado_por,$id_contrato,$monto_nota,$servicio,$fecha_inst)
	{
		$this->tipo = $tipo;
		$this->comentario = $comentario;
		$this->generado_por = $generado_por;
		$this->id_contrato = $id_contrato;
		$this->id_cont_serv = $id_cont_serv;
		$this->monto_anterior = $monto_anterior+0;
		$this->monto_posterior = $monto_posterior+0;
		$this->idmotivonota = $idmotivonota;
		$this->status = "SOLICITADO";
		//ECHO "select *from notas  where tipo='$this->tipo' ORDER BY nro_nota desc"; 
		 $acceso->objeto->ejecutarSql("select *from notas  where tipo='$this->tipo' AND nro_nota>0 ORDER BY nro_nota desc LIMIT 1 OFFSET 0"); 
		 $nro_nota=verNumero($acceso,"nro_nota");
		
		 
		 
session_start();
$ini_u = $_SESSION["ini_u"];  
$acceso->objeto->ejecutarSql("select  id_nota from notas  where (id_nota ILIKE '$ini_u%')   ORDER BY id_nota desc LIMIT 1 offset 0 ");
$id_nota=$ini_u.verCodLong($acceso,"id_nota");
		 
		return $acceso->objeto->ejecutarSql("insert into notas(id_nota,login_sol,id_cont_serv,tipo,dir_ip,login_sol,hora,monto_anterior,monto_posterior,idmotivonota,comentario,status,generado_por,id_contrato,nro_nota,monto_nota,servicio,fecha_inst) values ('$id_nota','$this->login_sol','$this->id_cont_serv','$this->tipo','$this->dir_ip','$this->login_sol','$this->hora','$this->monto_anterior','$this->monto_posterior','$this->idmotivonota','$this->comentario','$this->status','$this->generado_por','$this->id_contrato','$nro_nota','$monto_nota','$servicio','$fecha_inst')");
	}
	
	public function confirmar_notas($acceso,$tipo,$id_cont_serv,$monto_anterior,$monto_posterior,$idmotivonota,$comentario,$generado_por,$id_contrato,$monto_nota,$servicio,$fecha_inst)
	{
		$this->tipo = $tipo;
		$this->comentario = $comentario;
		$this->generado_por = $generado_por;
		$this->id_contrato = $id_contrato;
		$this->id_cont_serv = $id_cont_serv;
		$this->monto_anterior = $monto_anterior+0;
		$this->monto_posterior = $monto_posterior+0;
		$this->idmotivonota = $idmotivonota;
		$this->status = "SOLICITADO";
		//ECHO "select *from notas  where tipo='$this->tipo' ORDER BY nro_nota desc"; 
		 $acceso->objeto->ejecutarSql("select *from notas  where tipo='$this->tipo' AND nro_nota>0 ORDER BY nro_nota desc LIMIT 1 OFFSET 0"); 
		 $nro_nota=verNumero($acceso,"nro_nota");
		
		 
				 
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		$acceso->objeto->ejecutarSql("select  id_nota from notas  where (id_nota ILIKE '$ini_u%')   ORDER BY id_nota desc LIMIT 1 offset 0 ");
		$id_nota=$ini_u.verCodLong($acceso,"id_nota");
				 
		 $acceso->objeto->ejecutarSql("insert into notas(id_nota,login_sol,id_cont_serv,tipo,dir_ip,login_sol,hora,monto_anterior,monto_posterior,idmotivonota,comentario,status,generado_por,id_contrato,nro_nota,monto_nota,servicio,fecha_inst) values ('$id_nota','$this->login_sol','$this->id_cont_serv','$this->tipo','$this->dir_ip','$this->login_sol','$this->hora','$this->monto_anterior','$this->monto_posterior','$this->idmotivonota','$this->comentario','$this->status','$this->generado_por','$this->id_contrato','$nro_nota','$monto_nota','$servicio','$fecha_inst')");
		
		$this->confirmar_nota_cd($acceso,$id_nota);
	}
	
	public function confirmar_nota_cd($acceso,$id_nota){
		
		session_start();
			$login_aut = strtoupper(trim($_SESSION["login"]));
			$fecha_aut = date("Y-m-d");
			$hora_aut = date("H:i:s");
			
		$acceso->objeto->ejecutarSql("select id_cont_serv,monto_posterior from notas where id_nota='$id_nota'");
		if($row=row($acceso)){
			$monto_posterior=trim($row["monto_posterior"])+0;
			$id_cont_serv=trim($row["id_cont_serv"]);
			$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set costo_cobro='$monto_posterior' where id_cont_serv='$id_cont_serv'");
			$acceso->objeto->ejecutarSql("Update notas Set status='AUTORIZADO',login_aut='$login_aut', fecha_aut='$fecha_aut',hora_aut='$hora_aut' where id_nota='$id_nota'");
		}
		
	}
	
}
?>