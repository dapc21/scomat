<?php
class movimiento
{
	private $id_mov;
	private $id_tm;
	private $fecha_ent_sal;
	private $hora_ent_sal;
	private $observacion;
	private $referencia;
	private $tipo_mov;
	private $id_persona;

	function __construct($id_mov,$id_tm,$fecha_ent_sal,$hora_ent_sal,$observacion,$referencia,$tipo_mov,$id_persona='ENT00001')
	{
		if($id_persona=='dato' || $id_persona==''){
			$id_persona='ENT00001';
		}
		$this->id_mov = $id_mov;
		$this->id_tm = $id_tm;
		$this->fecha_ent_sal = $fecha_ent_sal;
		$this->hora_ent_sal = $hora_ent_sal;
		$this->observacion = $observacion;
		$this->referencia = $referencia;
		$this->tipo_mov = $tipo_mov;
		$this->id_persona = $id_persona;
	}
	public function verid_mov(){
		return $this->id_mov;
	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function vertipo_mov(){
		return $this->tipo_mov;
	}
	public function verreferencia(){
		return $this->referencia;
	}
	public function verobservacion(){
		return $this->observacion;
	}
	public function verhora_ent_sal(){
		return $this->hora_ent_sal;
	}
	public function verfecha_ent_sal(){
		return $this->fecha_ent_sal;
	}
	public function verid_tm(){
		return $this->id_tm;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from movimiento where id_mov='$this->id_mov'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirmovimiento($acceso)
	{
		session_start();
		$login=$_SESSION["login"];
//		echo "insert into movimiento(id_mov,id_tm,fecha_ent_sal,hora_ent_sal,observacion,referencia,tipo_mov,id_persona,login) values ('$this->id_mov','$this->id_tm','$this->fecha_ent_sal','$this->hora_ent_sal','$this->observacion','$this->referencia','$this->tipo_mov','$this->id_persona','$login'); ";
		return $acceso->objeto->ejecutarSql("insert into movimiento(id_mov,id_tm,fecha_ent_sal,hora_ent_sal,observacion,referencia,tipo_mov,id_persona,login) values ('$this->id_mov','$this->id_tm','$this->fecha_ent_sal','$this->hora_ent_sal','$this->observacion','$this->referencia','$this->tipo_mov','$this->id_persona','$login')");			
	}
	public function modificarmovimiento($acceso)
	{
		session_start();
		$login=$_SESSION["login"];
		return $acceso->objeto->ejecutarSql("Update movimiento Set id_tm='$this->id_tm', fecha_ent_sal='$this->fecha_ent_sal', hora_ent_sal='$this->hora_ent_sal', observacion='$this->observacion', referencia='$this->referencia', tipo_mov='$this->tipo_mov', id_persona='$this->id_persona', login='$login' Where id_mov='$this->id_mov'");	
	}
	public function eliminarmovimiento($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from movimiento where id_mov='$this->id_mov'");
	}
}
?>