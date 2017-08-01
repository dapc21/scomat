<?php
class comentario_cliente
{
	private $id_comen;
	private $id_persona;
	private $nro_comen;
	private $fecha_comen;
	private $hora_comen;
	private $comentario;
	private $status_comen;
	private $dato;

	function __construct($id_comen,$id_persona,$nro_comen,$fecha_comen,$hora_comen,$comentario,$status_comen,$dato)
	{
		$this->id_comen = $id_comen;
		$this->id_persona = $id_persona;
		$this->nro_comen = $nro_comen;
		$this->fecha_comen = $fecha_comen;
		$this->hora_comen = $hora_comen;
		$this->comentario = $comentario;
		$this->status_comen = $status_comen;
		$this->dato = $dato;
	}
	public function verid_comen(){
		return $this->id_comen;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_comen(){
		return $this->status_comen;
	}
	public function vercomentario(){
		return $this->comentario;
	}
	public function verhora_comen(){
		return $this->hora_comen;
	}
	public function verfecha_comen(){
		return $this->fecha_comen;
	}
	public function vernro_comen(){
		return $this->nro_comen;
	}
	public function verid_persona(){
		return $this->id_persona;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from comentario_cliente where id_comen='$this->id_comen'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluircomentario_cliente($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into comentario_cliente(id_comen,id_persona,nro_comen,fecha_comen,hora_comen,comentario,status_comen) values ('$this->id_comen','$this->id_persona','$this->nro_comen','$this->fecha_comen','$this->hora_comen','$this->comentario','$this->status_comen')");			
	}
	public function modificarcomentario_cliente($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update comentario_cliente Set id_persona='$this->id_persona', nro_comen='$this->nro_comen', fecha_comen='$this->fecha_comen', hora_comen='$this->hora_comen', comentario='$this->comentario', status_comen='$this->status_comen' Where id_comen='$this->id_comen'");	
	}
	public function eliminarcomentario_cliente($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from comentario_cliente where id_comen='$this->id_comen'");
	}
}
?>