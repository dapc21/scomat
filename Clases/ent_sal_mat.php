<?php
class ent_sal_mat
{
	private $id_ent_sal;
	private $id_mat;
	private $tipo_ent_sal;
	private $fecha_ent_sal;
	private $hora_ent_sal;
	private $cant_ent_sal;
	private $precio_compra;
	private $observacion;
	private $id_orden;

	function __construct($id_ent_sal,$id_mat,$tipo_ent_sal,$fecha_ent_sal,$hora_ent_sal,$cant_ent_sal,$precio_compra,$observacion,$id_orden)
	{
		$this->id_ent_sal = $id_ent_sal;
		$this->id_mat = $id_mat;
		$this->tipo_ent_sal = $tipo_ent_sal;
		$this->fecha_ent_sal = $fecha_ent_sal;
		$this->hora_ent_sal = $hora_ent_sal;
		$this->cant_ent_sal = $cant_ent_sal;
		$this->precio_compra = $precio_compra;
		$this->observacion = $observacion;
		$this->id_orden = $id_orden;
	}
	public function verid_ent_sal(){
		return $this->id_ent_sal;
	}
	public function verid_orden(){
		return $this->id_orden;
	}
	public function verobservacion(){
		return $this->observacion;
	}
	public function verprecio_compra(){
		return $this->precio_compra;
	}
	public function vercant_ent_sal(){
		return $this->cant_ent_sal;
	}
	public function verhora_ent_sal(){
		return $this->hora_ent_sal;
	}
	public function verfecha_ent_sal(){
		return $this->fecha_ent_sal;
	}
	public function vertipo_ent_sal(){
		return $this->tipo_ent_sal;
	}
	public function verid_mat(){
		return $this->id_mat;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from ent_sal_mat where id_ent_sal='$this->id_ent_sal'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirent_sal_mat($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from materiales where id_mat='$this->id_mat'");
		if($row=$acceso->objeto->devolverRegistro()){
			$cant=trim($row['cant_existencia']);
			if($this->tipo_ent_sal=="Entrada"){
				$total=$cant+$this->cant_ent_sal;
				$acceso->objeto->ejecutarSql("Update materiales Set cant_existencia='$total' Where id_mat='$this->id_mat'");	
			}
			else if($this->tipo_ent_sal=="Salida"){
				$total=$cant-$this->cant_ent_sal;
				$acceso->objeto->ejecutarSql("Update materiales Set cant_existencia='$total' Where id_mat='$this->id_mat'");	
			}
		}
			
	//	echo "insert into ent_sal_mat(id_ent_sal,id_mat,tipo_ent_sal,fecha_ent_sal,hora_ent_sal,cant_ent_sal,precio_compra,observacion,id_orden) values ('$this->id_ent_sal','$this->id_mat','$this->tipo_ent_sal','$this->fecha_ent_sal','$this->hora_ent_sal','$this->cant_ent_sal','$this->precio_compra','$this->observacion','$this->id_orden')";
		return $acceso->objeto->ejecutarSql("insert into ent_sal_mat(id_ent_sal,id_mat,tipo_ent_sal,fecha_ent_sal,hora_ent_sal,cant_ent_sal,precio_compra,observacion,id_orden) values ('$this->id_ent_sal','$this->id_mat','$this->tipo_ent_sal','$this->fecha_ent_sal','$this->hora_ent_sal','$this->cant_ent_sal','$this->precio_compra','$this->observacion','$this->id_orden')");			
	}
	public function modificarent_sal_mat($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update ent_sal_mat Set id_mat='$this->id_mat', tipo_ent_sal='$this->tipo_ent_sal', fecha_ent_sal='$this->fecha_ent_sal', hora_ent_sal='$this->hora_ent_sal', cant_ent_sal='$this->cant_ent_sal', precio_compra='$this->precio_compra', observacion='$this->observacion', id_orden='$this->id_orden' Where id_ent_sal='$this->id_ent_sal'");	
	}
	public function eliminarent_sal_mat($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from ent_sal_mat where id_ent_sal='$this->id_ent_sal'");
	}
}
?>