<?php
class caja_cobrador
{
	private $id_caja_cob;
	private $id_caja;
	private $id_caja_esta;
	private $id_persona;
	private $fecha_caja;
	private $apertura_caja;
	private $cierre_caja;
	private $monto_acum;
	private $status_caja;
	private $id_est;
	private $fecha_sugerida;

	function __construct($dat)
	{
		$this->id_caja_cob = $dat['id_caja_cob'];		
		$this->id_caja = $dat['id_caja'];
		$this->id_persona = $dat['id_persona'];		
		$this->fecha_caja = formatfecha($dat['fecha_caja']);
		$this->apertura_caja = $dat['apertura_caja'];
		$this->cierre_caja = $dat['cierre_caja'];
		$this->monto_acum = $dat['monto_acum'];
		$this->status_caja = $dat['status_caja'];
		$this->id_est = $dat['id_est'];
		$this->fecha_sugerida = "1111-11-11";

	}
	public function verid_caja_cob(){
		return $this->id_caja_cob;
	}
	public function verid_est(){
		return $this->id_est;
	}
	public function verstatus_caja(){
		return $this->status_caja;
	}
	public function vermonto_acum(){
		return $this->monto_acum;
	}
	public function vercierre_caja(){
		return $this->cierre_caja;
	}
	public function verapertura_caja(){
		return $this->apertura_caja;
	}
	public function verfecha_caja(){
		return $this->fecha_caja;
	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function verid_caja(){
		return $this->id_caja;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from caja where id_caja='$this->id_caja'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function aperturar($acceso)
	{
		$fecha= date("Y-m-d");
		//ECHO "select * from vista_caja where id_persona='$this->id_persona' and fecha_caja='$fecha' and status_caja='Abierta'";
		$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$this->id_persona' and fecha_caja='$fecha' and status_caja_cob='Abierta'");
		if($acceso->objeto->registros>0)
			echo " El Cobrador ya tiene un Punto de Cobro Abierto\n";
		else{
			
			$acceso->objeto->ejecutarSql("Update caja Set status_caja='Abierta' Where id_caja='$this->id_caja'");		
			$acceso->objeto->ejecutarSql("insert into caja_cobrador(id_caja_cob,id_caja,id_persona,fecha_caja,apertura_caja,status_caja,id_est,fecha_sugerida) values ('$this->id_caja_cob','$this->id_caja','$this->id_persona','$this->fecha_caja','$this->apertura_caja','Abierta','$this->id_est','$this->fecha_sugerida')");
		}
	}
	public function cerrar($acceso)
	{
		
		$fecha= date("Y-m-d");
		
		$acceso->objeto->ejecutarSql("Update caja Set status_caja='Activa' Where id_caja='$this->id_caja'");
		$resp=$acceso->objeto->ejecutarSql("Update caja_cobrador Set cierre_caja='$this->cierre_caja', monto_acum='$this->monto_acum', status_caja='Cerrada' Where id_caja_cob='$this->id_caja_cob'");
		
		
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into caja_cobrador(id_caja_cob,id_caja,id_persona,fecha_caja,apertura_caja,cierre_caja,monto_acum,status_caja) values ('$this->id_caja_cob','$this->id_caja','$this->id_persona','$this->fecha_caja','$this->apertura_caja','$this->cierre_caja','$this->monto_acum','$this->status_caja')");					
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update caja_cobrador Set id_caja='$this->id_caja', id_persona='$this->id_persona', fecha_caja='$this->fecha_caja', apertura_caja='$this->apertura_caja', cierre_caja='$this->cierre_caja', monto_acum='$this->monto_acum', status_caja='$this->status_caja' Where id_caja_cob='$this->id_caja_cob'");	
	}
	public function cambiarfechacaja_cobrador($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update caja_cobrador Set fecha_sugerida='$this->fecha_sugerida' Where id_caja_cob='$this->id_caja_cob'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from caja_cobrador where id_caja_cob='$this->id_caja_cob'");
	}
}
?>