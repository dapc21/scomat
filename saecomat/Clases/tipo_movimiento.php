<?php
class tipo_movimiento
{
	private $id_tm;
	private $nombre_tm;
	private $tipo_ent_sal;
	private $uso_tm;
	private $status_tm;
	private $dato;

	function __construct($id_tm,$nombre_tm,$tipo_ent_sal,$uso_tm,$status_tm,$dato)
	{
		$this->id_tm = $id_tm;
		$this->nombre_tm = $nombre_tm;
		$this->tipo_ent_sal = $tipo_ent_sal;
		$this->uso_tm = $uso_tm;
		$this->status_tm = $status_tm;
		$this->dato = $dato;
	}
	public function verid_tm(){
		return $this->id_tm;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_tm(){
		return $this->status_tm;
	}
	public function veruso_tm(){
		return $this->uso_tm;
	}
	public function vertipo_ent_sal(){
		return $this->tipo_ent_sal;
	}
	public function vernombre_tm(){
		return $this->nombre_tm;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tipo_movimiento where id_tm='$this->id_tm'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirtipo_movimiento($acceso)
	{
	//echo "insert into tipo_movimiento(id_tm,nombre_tm,tipo_ent_sal,uso_tm,status_tm) values ('$this->id_tm','$this->nombre_tm','$this->tipo_ent_sal','$this->uso_tm','$this->status_tm')";
		return $acceso->objeto->ejecutarSql("insert into tipo_movimiento(id_tm,nombre_tm,tipo_ent_sal,uso_tm,status_tm) values ('$this->id_tm','$this->nombre_tm','$this->tipo_ent_sal','$this->uso_tm','$this->status_tm')");			
	}
	public function modificartipo_movimiento($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update tipo_movimiento Set nombre_tm='$this->nombre_tm', tipo_ent_sal='$this->tipo_ent_sal', uso_tm='$this->uso_tm', status_tm='$this->status_tm' Where id_tm='$this->id_tm'");	
	}
	public function eliminartipo_movimiento($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from tipo_movimiento where id_tm='$this->id_tm'");
	}
}
?>