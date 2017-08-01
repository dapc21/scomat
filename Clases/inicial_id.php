<?php
class inicial_id
{
	private $id_inicial_id;
	private $id_servidor;
	private $inicial;
	private $status;
	private $dato;

	function __construct($id_inicial_id,$id_servidor,$inicial,$status,$dato)
	{
		$this->id_inicial_id = $id_inicial_id;
		$this->id_servidor = $id_servidor;
		$this->inicial = $inicial;
		$this->status = $status;
		$this->dato = $dato;
	}
	public function verid_inicial_id(){
		return $this->id_inicial_id;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus(){
		return $this->status;
	}
	public function verinicial(){
		return $this->inicial;
	}
	public function verid_servidor(){
		return $this->id_servidor;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from inicial_id where id_inicial_id='$this->id_inicial_id'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirinicial_id($acceso)
	{
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		$inicial_ini=$this->inicial[0];
		$inicial_fin=$this->inicial[1];
		$clase=$valor[0];
		$ini=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","[","]");	
		$fin=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","[","]");	
		$id_inicial_id=$this->id_inicial_id;
		$valido=false;
		for($i=0;$i<count($ini);$i++){
			if($inicial_ini==$ini[$i]){
				$valido=true;
			}
			if($valido==true){
				for($j=0;$j<count($fin);$j++){
					$inicial=$ini[$i].$fin[$j];
					$acceso->objeto->ejecutarSql("insert into inicial_id(id_inicial_id,id_servidor,inicial,status,dato) values ('$id_inicial_id','$this->id_servidor','$inicial','$this->status','$this->dato')");
					$id_inicial_id=$ini_u.verCoo_inc($acceso,$id_inicial_id);
				}
			}
			if($inicial_fin==$ini[$i]){
				return;
			}
			
		}	
	}
	public function modificarinicial_id($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update inicial_id Set id_servidor='$this->id_servidor', inicial='$this->inicial', status='$this->status', dato='$this->dato' Where id_inicial_id='$this->id_inicial_id'");	
	}
	public function eliminarinicial_id($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from inicial_id where id_inicial_id='$this->id_inicial_id'");
	}
}
?>